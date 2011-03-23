<?php
	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	// TODO: refactor the code, make it simpler
	class CA_GridView
	{
		public $msg;
		public $params;
		public $sql;
		public $total_result = 0;

		public $set_export = false;
		public $set_print = false;
		public $set_debug = false;
		public $set_filter = false;
		public $set_action = false;
		public $set_multirow_selection = false;
		public $set_pagination = true;

		private $_offset = 0;
		private $_per_page = 10;

		private $ci;

		/**
		 * GridView Class initialization		 
		 */
		function __construct()
		{
			$this->ci = get_instance();
			$this->ci->load->database();
			$this->ci->load->library('table');
			$this->ci->load->helper('url');
			$this->ci->load->helper('form');
			$this->ci->load->library('pagination');
			$this->ci->load->library('ocular');
			$this->ci->lang->load('ca_gridview');

			// TODO: find out why using this function is not working for csv exporting
			//$this->CI->load->dbutil();

			$this->msg = array();
		}

		/**
		 * If there is no WHERE keyword in sql statement, we remove the first AND | OR keyword and replace with WHERE
		 *
		 * @param string $str_sql
		 * @param string $srch_type
		 * @return string	SQL statement
		 */
		private function _add_where_keyword($str_sql, $srch_type)
		{
			// Spilit the sql into array block, spilit by no. of WHERE ocurrance in SQL
			$arr     = preg_split('/(\(.*?where.*?\))/is', $str_sql, -1, PREG_SPLIT_DELIM_CAPTURE);
			$new_sql = '';

			foreach ($arr as $val)
			{
				// if SQL doesn't contain my WHERE keyword add WHERE keyword to it
				// by removing first occurance of srch_type ie. AND | OR keyword
				//if(!preg_match('/\bWHERE\b/i', $val))
				if (!preg_match('/\bWHERE\b/i', $val) && !preg_match('/\(/', $val))
				{
					$val = preg_replace('/\b' . $srch_type . '\b/i', 'WHERE', $val, 1);
				}
				$new_sql .= $val;
			}

			return $new_sql;
		}

		/**
		 * Checks the parameters that are send to grid
		 * and sets the default parameters
		 *
		 * @param array $params
		 * @return array
		 */
		private function _check_param($params)
		{
			// Add forward slash to url string
			if (isset($params['set_pagination']['initialize']['base_url']))
			{
				$params['set_pagination']['initialize']['base_url'] = $this->addfslash($params['set_pagination']['initialize']['base_url']);
			}

			// Default export setting
			if (!isset($params['set_export']['enable']))
			{
				$params['set_export']['enable'] = $this->set_export;
			}

			// Default print setting
			if (!isset($params['set_print']['enable']))
			{
				$params['set_print']['enable'] = $this->set_print;
			}

			// Default debug setting
			if (!isset($params['set_debug']['enable']))
			{
				$params['set_debug']['enable'] = $this->set_debug;
			}

			// Default filter setting
			if (!isset($params['set_filter']['enable']))
			{
				$params['set_filter']['enable'] = $this->set_filter;
			}

			// Default action setting
			if (!isset($params['set_action']['enable']))
			{
				$params['set_action']['enable'] = $this->set_action;
			}

			// Default multi row selection setting
			if (!isset($params['set_multirow_selection']['enable']))
			{
				$params['set_multirow_selection']['enable'] = $this->set_multirow_selection;
			}

			// Default pagination setting
			if (!isset($params['set_pagination']['enable']))
			{
				$params['set_pagination']['enable'] = $this->set_pagination;
			}

			return $params;
		}

		/**
		 * Check if SQL statement already has LIMIT and ORDER BY keyword in it
		 *
		 * @param string $sql
		 * @return  boolean
		 */
		private function _check_query($sql)
		{
			$pass = true;

			if (preg_match('/\bLIMIT\b/i', $sql))
			{
				$pass        = false;
				$this->msg[] = "SQL can't have LIMIT parameter";
			}

			if (preg_match('/\bORDER BY\b/i', $sql))
			{
				$pass        = false;
				$this->msg[] = "SQL can't have ORDER BY parameter";
			}

			return $pass;
		}

		/**
		 * Checks if the Format and Structure defined for Action Link are correct for not
		 *
		 * @return boolean
		 */
		private function _check_set_action_structure()
		{
			$pass        = true;
			$this->msg[] = "Checking, Set Action Structure.";

			// Check array structure
			foreach ($this->params['set_action'][0] as $value)
			{
				if (is_array($value['type']))
				{
					switch ($value['type'][0])
					{
						case 'image':
							if (!isset($value['type']['src']))
							{
								$this->msg[] = "Error! Image Source is not Define.";
								$pass        = false;
							}
							break;

						case 'link':
							break;
					}
				}
				else
				{
					switch ($value['type'])
					{
						case 'image':
							break;
					}
				}
			}

			return $pass;
		}

		/**
		 * find all string within {field} and replace with data
		 * eg: http://www.website.com/index.php/cms/edit/{cms_id}
		 * output: http://www.website.com/index.php/cms/edit/12
		 *
		 * @param string $str
		 * @param array $data
		 * @return string
		 */
		private function _field_to_data($str, $data)
		{
			$pattern     = '';
			$replacement = '';
			$fields      = '';

			preg_match_all('|{(.*)}|U', $str, $fields, PREG_PATTERN_ORDER);

			foreach ($fields[1] as $value)
			{
				$replacement[] = $data[$value];
				$pattern[]     = '|{' . $value . '}|U';
			}

			ksort($pattern);
			ksort($replacement);

			return preg_replace($pattern, $replacement, $str);
		}

		/**
		 * Define the TYPES of Search Options
		 * number, text, date or select option
		 *
		 * @param string $field
		 * @param string $type
		 * @param string $selected
		 * @return string 	HTML code
		 */
		private function _filter_input_type($field, $type, $selected = '')
		{
			$str = '';

			$str .= '<input type="hidden" name="flt_field[]" value="' . $field . '" />';
			switch ($type)
			{
				case 'number':
				case 'text':
					$str .= '<input type="text" name="flt_data[]" id="flt_' . $field . '" value="' . $selected . '" />';
					break;

				case 'date':
					$str .= '<input type="text" name="flt_data[]" id="flt_' . $field . '" value="' . $selected . '" />';
					break;

				case 'select':
					$str .= '<select name="flt_data[]" id="flt_' . $field . '">';
					$str .= '<option value="">- Select -</option>';

					$option = $this->params['set_filter'][0][$field]['type']['value'];
					foreach ($option as $key => $title)
					{
						if ($selected != '' && $key == $selected)
						{
							$str .= '<option value="' . $key . '" selected="selected">' . $title . '</option> name="flt_' . $field . '" id="flt_' . $field . '">';
						}
						else
						{
							$str .= '<option value="' . $key . '">' . $title . '</option> name="flt_' . $field . '" id="flt_' . $field . '">';
						}
					}
					$str .= '</select>';
					break;
			}

			return $str;
		}

		/**
		 * Get the opening HTML tag, closing HTML tag and HTML Attribute that has been defined along with the result to be displayed.
		 * We Append those HTML tags to Column result display
		 *
		 * @param string $field
		 * @return array
		 */
		private function _get_column_attributes($field)
		{
			$open_tag       = '';
			$close_tag      = '';
			$html_attribute = '';

			// Open tag
			if (isset($this->params['set_column'][$field]['type']['open_tag']))
			{
				$open_tag .= $this->params['set_column'][$field]['type']['open_tag'];
			}

			// Close tag
			if (isset($this->params['set_column'][$field]['type']['close_tag']))
			{
				$close_tag .= $this->params['set_column'][$field]['type']['close_tag'];
			}

			// Html attribute
			if (isset($this->params['set_column'][$field]['type']['html_attribute']))
			{
				foreach ($this->params['set_column'][$field]['type']['html_attribute'] as $key => $value)
				{
					$html_attribute .= " $key = \"$value\" ";
				}
			}

			return array(
				'open_tag' => $open_tag,
				'close_tag' => $close_tag,
				'html_attribute' => $html_attribute
			);
		}

		/**
		 * Parse the URL segment and create Parameter array
		 *
		 */
		private function _read_uri_segment()
		{
			// If uri segment contain default data, insert it into the param structure
			$uri_segment = $this->_uri_to_assoc();

			if (count($uri_segment) > 0)
			{
				foreach ($uri_segment as $key => $data)
				{
					if ($uri_segment[$key] != false)
					{
						$this->params['set_pagination'][$key] = $data;
					}
				}

				// If filter result is to be display then assign the filter query
				if (isset($uri_segment['search_result']))
				{
					if ($uri_segment['search_result'] == 'enable')
					{					
						$this->params['set_pagination']['search_result'] = 'enable';
					}
				}
			}
		}

		/**
		 * User can insert any type of HTML code in the column for display in grid for SQL result
		 *
		 * @param string $field
		 * @param array $data
		 * @return string 	HTML code
		 */
		private function _shape_column_type_custom($field, $data)
		{
			$str = $this->_field_to_data($this->params['set_column'][$field]['type']['html'], $data);
			return $str;
		}

		/**
		 * Image type column format display in grid for SQL result
		 *
		 * @param string $field
		 * @param array $data
		 * @return string	HTML code
		 */
		private function _shape_column_type_image($field, $data)
		{
			$str = '';

			$att = $this->_get_column_attributes($field);

			$img_src = $this->_field_to_data($this->params['set_column'][$field]['type']['src'], $data);

			$str .= $att['open_tag'] . '<img src="' . $img_src . '" ' . $att['html_attribute'] . '/>' . $att['close_tag'];

			return $str;
		}

		/**
		 * Hyperlink Text type column format display in grid for SQL result
		 *
		 * @param string $field
		 * @param array $data
		 * @return string HTML code
		 */
		private function _shape_column_type_link($field, $data)
		{
			$str = '';

			$att = $this->_get_column_attributes($field);

			$str .= $att['open_tag'] . '<a href="' . $this->_field_to_data($this->params['set_column'][$field]['type']['href'], $data) . '" ' . $att['html_attribute'] . ' >' . $data[$field] . '</a>' . $att['close_tag'];

			return $str;
		}

		/**
		 * Radio button type column format display in grid for SQL result
		 *
		 * @param string $field
		 * @param array $data
		 * @return string	HTML code
		 */
		private function _shape_column_type_radio($field, $data)
		{
			$str         = '';
			$att         = $this->_get_column_attributes($field);
			$primary_key = $data[$this->params['set_column'][$field]['type']['primary_key']];

			$str .= $att['open_tag'];

			foreach ($this->params['set_column'][$field]['type']['value'] as $key => $value)
			{
				if ($key == $data[$field])
				{
					$str .= '<input type="radio" name="' . $field . '_' . $primary_key . '" id="' . $field . '_' . $primary_key . '" value="' . $key . '" checked="checked" ' . $att['html_attribute'] . '/>' . $value . '&nbsp;';
				}
				else
				{
					$str .= '<input type="radio" name="' . $field . '_' . $primary_key . '" name="' . $field . '_' . $primary_key . '" value="' . $key . '" ' . $att['html_attribute'] . '/>' . $value . '&nbsp;';
				}
			}
			$str .= $att['close_tag'];

			return $str;
		}

		/**
		 * Dropdown select box type column format display in grid for SQL result
		 *
		 * @param string $field
		 * @param array $data
		 * @return string	HTML code
		 */
		private function _shape_column_type_select($field, $data)
		{
			$str         = '';
			$att         = $this->_get_column_attributes($field);
			$primary_key = $data[$this->params['set_column'][$field]['type']['primary_key']];

			$str .= $att['open_tag'];

			$str .= '<select name="' . $field . '_' . $primary_key . '" id="' . $field . '_' . $primary_key . '" ' . $att['html_attribute'] . '>';

			foreach ($this->params['set_column'][$field]['type']['value'] as $key => $value)
			{
				if ($key == $data[$field])
				{
					$str .= '<option value="' . $key . '" selected="selected" >' . $value . '</option>';
				}
				else
				{
					$str .= '<option value="' . $key . '">' . $value . '</option>';
				}
			}
			$str .= '</select>';

			$str .= $att['close_tag'];

			return $str;
		}

		/**
		 * Normal Text type column formt display in grid for SQL result
		 *
		 * @param string $field
		 * @param array $data
		 * @return string	HTML code
		 */
		private function _shape_column_type_text($field, $data)
		{
			$str = '';

			$att = $this->_get_column_attributes($field);

			$str .= $att['open_tag'] . $att['html_attribute'] . $data[$field] . $att['close_tag'];

			return $str;
		}

		/**
		 * TextField type column format display in grid for SQL result
		 *
		 * @param string $field
		 * @param array $data
		 * @return string	HTML code
		 */
		private function _shape_column_type_textfield($field, $data)
		{
			$str = '';

			$att         = $this->_get_column_attributes($field);
			$primary_key = $data[$this->params['set_column'][$field]['type']['primary_key']];

			$str .= $att['open_tag'] . '<input type="text" name="' . $field . '_' . $primary_key . '" id="' . $field . '_' . $primary_key . '" value="' . $data[$field] . '" ' . $att['html_attribute'] . '/>' . $att['close_tag'];

			return $str;
		}

		/**
		 * Define the SQL statement for Search operation
		 * we add LIKE, and WHERE statement to original SQL statement
		 *
		 * @return string	SQL statement
		 */
		private function _shape_filter_query()
		{
			$sql          = $this->ci->db->last_query();
			$srch_type    = $this->ci->input->post('flt_operator_search_type');
			$flt_operator = $this->ci->input->post('flt_operator');
			$flt_field    = $this->ci->input->post('flt_field');
			$flt_data     = $this->ci->input->post('flt_data');

			if (is_array($flt_operator))
			{
				foreach ($flt_operator as $key => $value)
				{
					if ($flt_data[$key] != "")
					{
						$flt_data[$key] = mysql_real_escape_string($flt_data[$key]);
						switch ($flt_operator[$key])
						{
							case 'like%':
								$sql .= " $srch_type {$flt_field[$key]} like '{$flt_data[$key]}%'";
								break;

							case '%like':
								$sql .= " $srch_type {$flt_field[$key]} like '%{$flt_data[$key]}'";
								break;

							case '%like%':
								$sql .= " $srch_type {$flt_field[$key]} like '%{$flt_data[$key]}%'";
								break;

							default:
								$sql .= " $srch_type {$flt_field[$key]} {$flt_operator[$key]} '{$flt_data[$key]}'";
						}
					}
				}

				/*
				 * If there is no WHERE keyword in sql statement,
				 * we remove the first AND | OR keyword and replace with WHERE
				 * other wise we concat AND | OR operatior along with WHERE statement
				 */
				$sql = $this->_add_where_keyword($sql, $srch_type);
			}

			// Total rows
			$query              = $this->ci->db->query($sql);
			$this->total_result = $query->num_rows();

			// Set order by
			$order_field = $this->params['set_pagination']['order_field'];
			$order_type  = $this->params['set_pagination']['order_type'];
			$sql .= " ORDER BY `$order_field` $order_type";
			
			// set up the limit and return the query for output
			$per_page = $this->params['set_pagination']['initialize']['per_page'];
			$offset   = $this->params['set_pagination']['offset'];

			// if no offset is define in Param, default offset to 0
			if (empty($offset))
			{
				$offset = $this->_offset;
			}

			// if no Per Page is defined in Param, default Per Page is 10
			if (empty($per_page))
			{
				$per_page = $this->_per_page;
			}

			// add LIMIT keyword
			$sql .= " LIMIT $offset, $per_page";

			$query = $this->ci->db->query($sql);

			return $query;
		}

		/**
		 * Define all the configuration setting for Pagination class
		 *
		 * @return array
		 */
		private function _shape_pagination_initializer()
		{
			$url_str = $this->_shape_uri_segment('', array(
				'offset'
			));
			$url_str .= '/offset/';

			$initialize['base_url']    = $url_str;
			$initialize['uri_segment'] = $this->ci->uri->total_segments();
			$initialize['total_rows']  = $this->total_result;
			$initialize['per_page']    = $this->params['set_pagination']['initialize']['per_page'];

			$initialize['next_link']      = 'next &raquo;';
			$initialize['next_tag_open']  = '<span class="next">';
			$initialize['next_tag_close'] = '</span>';

			$initialize['prev_link']      = '&laquo; prev';
			$initialize['prev_tag_open']  = '<span class="previous">';
			$initialize['prev_tag_close'] = '</span>';

			$initialize['first_link']      = 'first';
			$initialize['first_tag_open']  = '<span class="next">';
			$initialize['first_tag_close'] = '</span>';

			$initialize['last_link']      = 'last';
			$initialize['last_tag_open']  = '<span class="next">';
			$initialize['last_tag_close'] = '</span>';

			$initialize['cur_tag_open']  = '<span class="current">';
			$initialize['cur_tag_close'] = '</span>';

			return $initialize;
		}

		/**
		 * Re-Format Original SQL statement by adding keyword like ORDER BY.
		 * And we also add LIMIT for paginating the result
		 *
		 * @return string	SQL statement
		 */
		private function _shape_query()
		{
			$query = "";

			$this->msg[] = $this->ci->db->last_query();
			$sql         = $this->ci->db->last_query();

			// Check if SQL statement already has LIMIT and ORDER by in it
			if ($this->_check_query($sql))
			{
				$order_field = $this->params['set_pagination']['order_field'];
				$order_type  = $this->params['set_pagination']['order_type'];

				// Add ORDER BY keyword
				if (!empty($order_field))
				{
					$sql .= " ORDER BY `$order_field` $order_type";
				}

				// Query without limit
				$query              = $this->ci->db->query($sql);
				$this->total_result = $query->num_rows();

				// Set up the limit and return the query for output
				$per_page = $this->params['set_pagination']['initialize']['per_page'];
				$offset   = $this->params['set_pagination']['offset'];

				// If no offset is define in Param, default offset to 0
				if (empty($offset))
				{
					$offset = $this->_offset;
				}

				// If no Per Page is defined in Param, default Per Page is 10
				if (empty($per_page))
				{
					$per_page = $this->_per_page;
				}

				// Add LIMIT keyword
				$sql .= " LIMIT $offset, $per_page";

				return $this->ci->db->query($sql);
			}
			else
			{
				die("Error! SQL Error");
			}
		}

		/**
		 * Format the URI string, which are used at various shorting and paging link
		 * Removes uncessary segment or add segments that are necessary
		 *
		 * @param array $set_data
		 * @param array $remove_data
		 * @param array $add_data
		 * @return string
		 */
		private function _shape_uri_segment($set_data = '', $remove_data = '', $add_data = '')
		{
			$this->params['set_pagination']['search_result'] = isset($this->params['set_pagination']['search_result']) && $this->params['set_pagination']['search_result'] == 'enable' ? 'enable' : 'disable';

			// Uri structure
			$uri_segment = array(
				'search_result' => $this->params['set_pagination']['search_result'],
				'order_field' => $this->params['set_pagination']['order_field'],
				'order_type' => $this->params['set_pagination']['order_type'],
				'offset' => $this->params['set_pagination']['offset']
			);

			// Add the uri data
			if ($add_data)
			{
				foreach ($add_data as $key => $data)
				{
					$uri_segment[$key] = $data;
				}
			}

			// Set the uri data
			if ($set_data)
			{
				foreach ($set_data as $key => $value)
				{
					$uri_segment[$key] = $value;
				}
			}

			// Remove the uri
			if ($remove_data)
			{
				foreach ($remove_data as $key)
				{
					if (isset($uri_segment[$key]))
					{
						unset($uri_segment[$key]);
					}
				}
			}

			$uri_str = $this->params['set_pagination']['initialize']['base_url'] . $this->ci->uri->assoc_to_uri($uri_segment);

			return $uri_str;
		}

		/**
		 * Break the uri segment and return the association
		 * Similar to native codeigniter uri to assoc
		 * only difference is it is tailor to our need of segments.
		 *
		 * @return string
		 */
		private function _uri_to_assoc()
		{
			$uri_base   = $this->params['set_pagination']['initialize']['base_url'];
			$uri_string = site_url(substr($this->ci->uri->uri_string(), 0, strlen($this->ci->uri->uri_string())));
			$retvalue   = array();

			// Remove the uri base from uri string and we get grid native uri segment
			$matches = preg_split("@$uri_base@", $uri_string);

			if (count($matches) > 1)
			{
				$segment = explode('/', $matches[1]);

				// Save the uri segment to array and return
				for ($i = 0; $i < sizeof($segment); $i += 2)
				{
					// Incase for page one, offset value will be 0, 1 or '' empty string
					if($segment[$i] === 'offset' && isset($segment[$i + 1]) === false)
					{
						$retvalue[$segment[$i]] = 0;
					}
					else
					{
						$retvalue[$segment[$i]] = $segment[$i + 1];
					}
				}
			}

			return $retvalue;
		}

		/**
		 * Add forward slash to string
		 *
		 * @param string $str
		 * @return string
		 */
		public function addfslash($str)
		{
			if (substr($str, strlen($str) - 1, 1) != '/')
			{
				$str .= '/';
			}

			return $str;
		}

		/**
		 * Display the SQL result in View Page
		 *
		 * @param string $field
		 * @param array $data
		 * @return string	HTML tags
		 */
		public function display_column($field, $data)
		{
			$str = '';
			foreach ($this->params['set_column'] as $column => $value)
			{
				if ($column == $field)
				{
					switch (strtolower($value['type'][0]))
					{
						case "text":
							$str = $this->_shape_column_type_text($field, $data);
							break;

						case "link":
							$str = $this->_shape_column_type_link($field, $data);
							break;

						case "textfield":
							$str = $this->_shape_column_type_textfield($field, $data);
							break;

						case "radio":
							$str = $this->_shape_column_type_radio($field, $data);
							break;

						case "select":
							$str = $this->_shape_column_type_select($field, $data);
							break;

						case "image":
							$str = $this->_shape_column_type_image($field, $data);
							break;

						case "custom":
							$str = $this->_shape_column_type_custom($field, $data);
							break;

						default:
							$str = $this->_shape_column_type_text($field, $data);
					}
				}
			}
			return $str;
		}

		/**
		 * Fields that are to be displayed for Search Option in View Page
		 *
		 * @return string	HTML code
		 */
		public function display_filter_option()
		{
			$str          = "";
			$flt_operator = $this->ci->input->post('flt_operator');
			$flt_data     = $this->ci->input->post('flt_data');
			$i            = 0;

			foreach ($this->params['set_filter'][0] as $key => $value)
			{
				$selected_operator = ($flt_operator[$i] && $flt_operator[$i] != '') ? $flt_operator[$i] : '';
				$selected_data     = ($flt_data[$i] && $flt_data[$i] != '') ? $flt_data[$i] : '';

				$str .= '<tr>';
				$str .= '<td>' . $value['title'] . '</td>';
				$str .= '<td>' . $this->filter_operator($key, $value['type'][0], $selected_operator) . '</td>';
				$str .= '<td>' . $this->_filter_input_type($key, $value['type'][0], $selected_data) . '</td>';
				$str .= '</tr>';

				$i++;
			}

			return $str;
		}

		/**
		 * Display EDIT|DELETE link in the ACTION column field
		 *
		 * @param array $data
		 */
		public function display_set_action($data)
		{
			$str            = '';
			$str_value      = '';
			$html_attribute = '';

			if ($this->_check_set_action_structure())
			{
				$this->msg[] = "OK, Set Action Structure.";

				foreach ($this->params['set_action'][0] as $value)
				{
					$str            = '';
					$str_value      = '';
					$html_attribute = '';

					// Filter out the attributes
					if (isset($value['html_attribute']))
					{
						foreach ($value['html_attribute'] as $att => $att_value)
						{
							$html_attribute .= " $att = \"$att_value\" ";
						}
					}

					// Incase we have array
					if (is_array($value['type']))
					{
						switch ($value['type'][0])
						{
							case 'image':
								$str .= '<img src="' . $value['type']['src'] . '" alt="' . $value['title'] . '" title="' . $value['title'] . '"/>';
								break;

							case 'link':
								$str .= $value['title'];
								break;

							default:
								$str .= $value['title'];
						}
					}
					else 
					{
						// Without array
						switch ($value['type'])
						{
							case 'image':
							case 'link':
								$str .= $value['title'];
								break;

							default:
								$str .= $value['title'];
						}
					}

					$str_value .= '&nbsp;<a href="' . $this->_field_to_data($value['href'], $data) . '" ' . $html_attribute . '>' . $str . '</a>';
					echo $str_value;
				}
			}
		}

		/**
		 * Display ASC link Title Column
		 *
		 * @param string $field
		 * @return string
		 */
		public function display_url_asc($field)
		{
			$arr = array(
				'order_field' => $field,
				'order_type' => 'asc'
			);

			return $this->_shape_uri_segment($arr);
		}

		/**
		 * Display DESC link in Title Column
		 *
		 * @param unknown_type $field
		 * @return unknown
		 */
		public function display_url_desc($field)
		{
			$arr = array(
				'order_field' => $field,
				'order_type' => 'desc'
			);

			return $this->_shape_uri_segment($arr);
		}

		/**
		 * URL for search action attribute in View Page
		 *
		 * @return string	URL string
		 */
		public function display_url_filter()
		{
			$arr = array(
				'search_result' => 'enable',
				'offset' => 0
			);

			return $this->_shape_uri_segment($arr);
		}

		/**
		 * Export SQL result to CSV format data
		 *
		 */
		public function export_to_csv()
		{
			$query = $this->ci->db->query($this->ci->db->last_query());

			$data_csv = $this->ci->dbutil->csv_from_result($query);

			//plesae make sure that the profiler (benchmarking) is not activated in the controller.
			$now = date('Y-m-d');
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=exported_data_($now).csv");
			echo "$data_csv";
			die();
		}

		/**
		 * Display a simple table page which is used for printing purposes.
		 *
		 */
		public function export_to_print()
		{
			$headers = ''; // just creating the var for field headers to append to below
			$data    = ''; // just creating the var for field data to append to below

			$query = $this->ci->db->query($this->ci->db->last_query());

			$fields = $query->field_data();
			if ($query->num_rows() == 0)
			{
				echo '<p>The table appears to have no data.</p>';
			}
			else
			{
				foreach ($fields as $field)
				{
					$headers .= "<td>" . $field->name . "</td>";
				}

				foreach ($query->result() as $row)
				{
					$line = '';
					foreach ($row as $value)
					{
						if ((!isset($value)) OR ($value == ""))
						{
							$value = "<td>&nbsp;</td>";
						}
						else
						{
							$value = str_replace('"', '""', $value);
							$value = '<td>' . $value . '</td>' . "\t";
						}
						$line .= $value;
					}
					$data .= "<tr>" . trim($line) . "</tr>\n";
				}

				$data = str_replace("\r", "", $data);

				echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">
	          		<thead><tr>' . $headers . '</tr></thead>
	          		<tbody>' . $data . '</tbody>
					</table>
					';
			}
			die();
		}

		/**
		 * Export SQL result to XLS format data
		 *
		 */
		public function export_to_xls()
		{
			/*$this->CI->load->plugin('to_excel');
			$query = $this->CI->db->query( $this->CI->db->last_query() );

			$now = date('Y-m-d');
			to_excel($query, 'exported_data('.$now.')');
			die();*/
		}

		/**
		 * Export SQl result to XML format data
		 *
		 */
		public function export_to_xml()
		{
			$query    = $this->ci->db->query($this->ci->db->last_query());
			$data_csv = $this->ci->dbutil->xml_from_result($query);

			//plesae make sure that the profiler (benchmarking) is not activated in the controller.
			$now = date('Y-m-d');
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=exported_data_($now).xml");
			echo "$data_csv";
			die();
		}

		/**
		 * Display the type of operator valid for Search Type
		 * = > < != >= <=
		 *
		 * @param string $field
		 * @param string $type
		 * @param string $selected
		 * @return string	HTML code
		 */
		public function filter_operator($field, $type, $selected = '')
		{
			$str = '';
			$arr = '';

			$open_tag  = ($type == 'search_type') ? '<select name="flt_operator_' . $field . '" id="flt_operator_' . $field . '">' : '<select name="flt_operator[]" id="flt_operator_' . $field . '">';
			$close_tag = '</select>';

			switch ($type)
			{
				case 'number':
				case 'date':
					$arr = array(
						'=' => '=',
						'>' => '&gt;',
						'<' => '&lt;',
						'>=' => '&gt;=',
						'<=' => '&lt;=',
						'!=' => '!='
					);
					break;

				case 'text':
				case 'select':
					$arr = array(
						'%like%' => '%like%',
						'%like' => '%like',
						'like%' => 'like%',
						'like' => 'like',
						'not like' => 'not like',
						'=' => '='
					);
					break;

				case 'search_type':
					$arr      = array(
						'AND' => 'AND',
						'OR' => 'OR'
					);
					$selected = $this->ci->input->post('flt_operator_search_type');
					break;
			}

			if (count($arr) > 0)
			{
				foreach ($arr as $key => $value)
				{
					if ($selected != '' && $selected == $key)
					{
						$str .= '<option value="' . $key . '" selected="selected">' . $value . '</option>';
					}
					else
					{
						$str .= '<option value="' . $key . '">' . $value . '</option>';
					}
				}
			}

			return $open_tag . $str . $close_tag;
		}

		/**
		 * If column has Radio, Text field and select box menu
		 * we display Save Link for auto saving feature in grid
		 *
		 * @param string $field
		 * @return bool
		 */
		public function is_column_save($field)
		{
			$pass = false;
			switch (strtolower($this->params['set_column'][$field]['type'][0]))
			{
				case 'radio':
				case 'select':
				case 'textfield':
					$pass = true;
					break;
			}

			return $pass;
		}

		/**
		 * Checks if certain segment is present in URI string
		 *
		 * @param string $segment
		 * @return bool
		 */
		public function is_exist_uri_segment($segment)
		{
			$pass = false;

			$uri_segment = $this->_uri_to_assoc();

			if (count($uri_segment) > 0)
			{
				foreach ($uri_segment as $key => $data)
				{
					if ($key == $segment)
					{
						$pass = $data;
						break;
					}
				}
			}

			return $pass;
		}

		/**
		 * If order by field highlight
		 *
		 * @param bool $field
		 */
		public function is_order_by_field($field)
		{
			if ($this->params['set_pagination']['order_field'])
			{
				if ($this->params['set_pagination']['order_field'] == $field)
				{
					return (strtolower($this->params['set_pagination']['order_type']) == 'asc') ? image('ca_gridview/s_asc.png') : image('ca_gridview/s_desc.png');
				}
			}

			return false;
		}

		/**
		 * By Default Field Sorting is Enable
		 *
		 * @param string $field
		 * @return bool
		 */
		public function is_sortable($field)
		{
			$pass = true;

			if (isset($this->params['set_column'][$field]['sortable']))
			{
				$pass = ($this->params['set_column'][$field]['sortable'] === true) ? true : false;
			}
			return $pass;
		}

		/**
		 * Remove forward slash from string
		 *
		 * @param string $str
		 * @return string
		 */
		public function removefslash($str)
		{
			if (substr($str, strlen($str) - 1, 1) == '/')
			{
				$str = substr($str, 0, strlen($str) - 1);
			}

			return $str;
		}

		/**
		 * Call Render Grid method to render SQL result in Grid table
		 *
		 * @param Array $params
		 */
		public function render_grid($params)
		{
			// Check and set default value for parameters
			$this->params = $this->_check_param($params);

			// Read uri segment and set up default value
			$this->_read_uri_segment();

			// Multirow selection
			$set_multirow_selection = '';
			if ($this->params['set_multirow_selection']['enable'])
			{
				$set_multirow_selection = $this->params['set_multirow_selection']['primary_key'];
			}

			$this->ci->ocular->set_view_data('set_multirow_selection', $set_multirow_selection);

			// Column
			$set_column = $this->params['set_column'];
			$this->ci->ocular->set_view_data('set_column', $set_column);

			// Action
			$set_action = '';
			if ($this->params['set_action']['enable'])
			{
				$set_action = $this->params['set_action'][0];
			}
			$this->ci->ocular->set_view_data('set_action', $set_action);

			// Filter option
			$set_filter = '';
			if ($this->params['set_filter']['enable'])
			{
				$set_filter = $this->params['set_filter'];
			}

			$this->ci->ocular->set_view_data('set_filter', $set_filter);

			// Print
			$set_print = '';
			if ($this->params['set_print']['enable'])
			{
				$set_print = $this->params['set_print'][0];
			}

			$this->ci->ocular->set_view_data('set_print', $set_print);

			// Export
			$set_export = '';
			if ($this->params['set_export']['enable'])
			{
				$set_export = $this->params['set_export'][0];
			}

			$this->ci->ocular->set_view_data('set_export', $set_export);

			// set_debug
			$set_debug = '';
			if ($this->params['set_debug']['enable'])
			{
				$set_debug = $this->params['set_debug']['enable'];
			}

			$this->ci->ocular->set_view_data('set_debug', $set_debug);

			// query for
			// save option
			if ($this->is_exist_uri_segment('save') == 'enable')
			{
				$this->save();
			}

			// Execute the normal query or search query
			if ($this->is_exist_uri_segment('search_result') == 'enable')
			{
				$this->ci->ocular->set_view_data('set_query', $this->_shape_filter_query());
			}
			else
			{
				$this->ci->ocular->set_view_data('set_query', $this->_shape_query());
			}

			$this->msg[] = $this->ci->db->last_query();

			// Pagination
			if ($this->params['set_pagination']['enable'])
			{
				$this->ci->pagination->initialize($this->_shape_pagination_initializer());
			}

			$this->ci->ocular->set_view_data('set_pagination', $this->ci->pagination->create_links());

			// TODO: implement exporting functions
			$export = $this->is_exist_uri_segment('export');
			if ($export !== false)
			{
				switch ($export)
				{
					case 'csv':
						$this->export_to_csv();
						break;
					case 'xls':
						$this->export_to_xls();
						break;
					case 'xml':
						$this->export_to_xml();
						break;
					case 'print':
						$this->export_to_print();
						break;
				}
			}
		}

		/**
		 * Save values that are manipulated or filled in the column of the grid
		 * example: radio, select box value are auto save through use to this save() method
		 */
		public function save()
		{
			$primary_key = $this->ci->input->post('primary_key');
			$table_name  = $this->ci->input->post('table_name');
			$field       = $this->ci->input->post('field');
			$data        = "";

			if(is_array($this->ci->input->post('pk_' . $field)))
			{
				foreach ($this->ci->input->post('pk_' . $field) as $pk)
				{
					$data = array(
						$field => $this->ci->input->post($field . '_' . $pk)
					);

					$this->ci->db->where($primary_key, $pk);
					$this->ci->db->update($table_name, $data);
				}
			}

			header("Refresh:0;url=" . $_SERVER['HTTP_REFERER']);
			die();
		}
	}