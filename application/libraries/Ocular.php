<?php
	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	/**
	 * Ocular
	 *
	 * A layout system inspired by the Rails system.
	 *
	 * @package		Ocular Layout Library
	 * @author		Lonnie Ezell
	 * @copyright	Copyright (c) 2007, Lonnie Ezell
	 * @license		http://creativecommons.org/licenses/LGPL/2.1/
	 * @link			http://ocular.googlecode.com
	 * @version		0.25
	 * @filesource
	 */

	/**
	 * Ocular Layout Library
	 *
	 * This is the base class for the Ocular Layout Library.
	 *
	 * Ocular is a Rails-inspired layout library providing automatic
	 * view selection, helpers for stylesheet and javascript compression,
	 * and more.
	 *
	 * @package Ocular
	 * @author Lonnie Ezell
	 * @version 0.25
	 */
	class Ocular
	{
		private $ci;
		private $_view_data = array();
		public $full_active_controller;
		public $active_controller;
		public $active_function;
		private $_show_function;
		private $_show_controller;

		/**
		 * Constructor
		 *
		 * Loads the ocular config file.
		 *
		 * @return void
		 **/
		function Ocular()
		{
			// Get our applicaton instance.
			$this->ci =& get_instance();

			// Load our config file
			$this->ci->config->load('ocular');

			// Blank our controller and function vars.
			$this->full_active_controller = $this->active_controller = '';
			$this->active_function        = '';

			// Setup our title defaults
			$this->_show_function           = TRUE;
			$this->_show_controller         = TRUE;
			$this->_view_data['page_title'] = "";

			// Log the action
			log_message('debug', 'Ocular library loaded.');
		}

		/**
		 * Render
		 *
		 * The primary command that renders the layout that the viewer sees.
		 *
		 * @access	public
		 * @param		string (optional) the name of an alternate template to render.
		 * @return  null
		 */
		function render($name = '')
		{
			// Prep some variables
			$func = get_active_function();
			$cont = get_active_controller(TRUE);

			// Check to see if a layout was passed in
			if (empty($name))
			{
				// Check to see if a template exists for this controller
				$filepath = getcwd() . "/" . $this->ci->config->item('OCU_view_dir') . "/" . $this->ci->config->item('OCU_template_dir') . "/" . $cont . ".php";

				if (file_exists($filepath))
				{
					$template = $this->ci->config->item('OCU_template_dir') . "/" . $cont;
				}
				else
				{
					// Our default layout name
					$template = $this->ci->config->item('OCU_template_dir') . "/" . $this->ci->config->item('OCU_default_template');
				}
			}
			else
			{
				// Use the supplied name
				$template = $this->ci->config->item('OCU_template_dir') . "/" . $name;
			}

			// Is there a page name set?
			if (empty($this->_view_data['page_title']))
			{
				// Check for proper grammar
				$this->ci->load->helper('inflector');

				// Do we show the function?
				if ($this->_show_function)
				{
					$this->_view_data['page_title'] .= humanize($func);
				}

				// Do we show the controller?
				if ($this->_show_controller)
				{
					$this->_view_data['page_title'] .= " " . humanize($cont);
				}

			}

			// Attach the site name to the page title
			//---------------------------------------------------------------
			if (!empty($this->_view_data['page_title']))
			{
				if ($this->ci->config->item('OCU_site_name_placement') == "append")
				{
					// Make sure a site name has been supplied before attaching it.
					if ($this->ci->config->item('OCU_site_name') != " ")
					{
						$this->_view_data['page_title'] .= $this->ci->config->item('OCU_site_name_divider') . $this->ci->config->item('OCU_site_name');
					}
				}
				else
				{
					// Make sure a site name has been supplied before attaching it.
					if ($this->ci->config->item('OCU_site_name') != " ")
					{
						$this->_view_data['page_title'] = $this->ci->config->item('OCU_site_name') . $this->ci->config->item('OCU_site_name_divider') . $this->_view_data['page_title'];
					}
				}
			}
			else
			{
				// just show our site name
				$this->_view_data['page_title'] = $this->ci->config->item('OCU_site_name');
			}

			// Set our body_id and body_class variables
			//---------------------------------------------------------------

			/* BODY ID */
			if (empty($this->_view_data['body_id']))
			{
				$this->_view_data['body_id'] = ' id="' . $cont . '" ';
			}
			else
			{
				$this->_view_data['body_id'] = ' id="' . $this->_view_data['body_id'] . '"';
			}

			/* BODY CLASS */
			if (empty($this->_view_data['body_class']))
			{
				$this->_view_data['body_class'] = " ";
			}
			else
			{
				$this->_view_data['body_class'] = ' class="' . $this->_view_data['body_class'] . '" ';
			}

			// Display the view
			//---------------------------------------------------------------
			$this->ci->load->view($template, $this->_view_data);
		}		

		/**
		 * Yield
		 *
		 * Renders a view based upon the current controller/function being called.
		 *
		 * It enforces a strict view organization. Each controller must have a
		 * separate folder in the main views directory with a name matching the
		 * controller name. The view file itself should have the same name as the
		 * function it is working with, along with a .php file extension.
		 *
		 * @access	public
		 * @return  null
		 */

		function yields()
		{
			// Do we have a function name to use?
			if (isset($this->_view_data['view_name']))
			{
				$func = $this->_view_data['view_name'];
			}
			else
			{
				$func = get_active_function();
			}

			// Display our view
			//$this->ci->load->view(get_active_controller(TRUE) . "/" . $func . ".php");
			$this->ci->load->view($func . ".php");
		}


		/*function yield() {
		// Do we have a function name to use?
		if (isset($this->_view_data['view_name']) ) {
		$func = $this->_view_data['view_name'];
		} else {
		$func = get_active_function();
		}
		// Display our view
		$this->CI->load->view( $func . ".php");
		}*/

		/*-------------------------------------------------------------------
		| VIEW DATA FUNCTIONS
		+-------------------------------------------------------------------*/

		/**
		 * Set a view data attribute
		 *
		 * @access	public
		 * @param 	string	the name of variable being searched for
		 * @param		mixed 	the string or array to be stored in the variable.
		 * @return	boolean
		 */
		function set_view_data($name = '', $data = null)
		{
			if (isset($data) && !empty($name))
			{
				$this->_view_data[$name] = $data;
				return true;
			}
			return false;
		}

		/**
		 * Get a previously set view data attribute
		 *
		 * @access	public
		 * @param		string that is the name of the data to be retrieved.
		 * @return	boolean
		 */
		function get_view_data($name = '')
		{
			if (!empty($name))
			{
				if (isset($this->_view_data[$name]))
				{
					return $this->_view_data[$name];
				}
			}

			return false;
		}

		/*-------------------------------------------------------------------
		| UTILITY FUNCTIONS
		+-------------------------------------------------------------------*/

		/**
		 * Get stylesheet path
		 *
		 * Returns the path (with trailing /) to the stylesheet directory.
		 *
		 * @access	private
		 * @return	string
		 */

		function _stylesheet_path()
		{
			$CI =& get_instance();
			return $CI->config->item('OCU_stylesheet_path');
		}

		/**
		 * Get javscripts path
		 *
		 * Returns the path (with trailing /) to the javascripts directory.
		 *
		 * @access	private
		 * @return	string
		 */

		function _javascript_path()
		{
			$CI =& get_instance();
			return $CI->config->item('OCU_javascript_path');
		}		

		/**
		 * Get default stylesheets string
		 *
		 * Returns an array of stylesheet names. Used internally by the
		 * 'stylesheet_link_tag' function in ocular_helper.
		 *
		 * @access	private
		 * @return	array
		 */

		function _default_stylesheets()
		{
			$CI =& get_instance();
			return explode(", ", $CI->config->item('OCU_stylesheet_default_collection'));
		}		

		/**
		 * Get default javascripts string
		 *
		 * Returns an array of javascript names. Used internally by the
		 * 'javascript_include_tag' function in ocular_helper.
		 *
		 * @access	private
		 * @return	array
		 */

		function _default_javascripts()
		{
			$CI =& get_instance();
			return explode(", ", $CI->config->item('OCU_javascript_default_collection'));
		}		

		/**
		 * show_in_title()
		 *
		 * Tells which part of the title to show. Defaults to both.
		 * Options passed in tell whether to show the Controller or
		 * function name only in the page title.
		 *
		 * OPTIONS: 'function', 'controller', 'none'
		 *
		 * @access	public
		 * @param
		 * @return  null
		 */
		function show_in_title($part = NULL)
		{
			// Make sure we have data
			if (!isset($part))
			{
				return FALSE;
			}

			switch ($part)
			{
				case 'function':
					$this->_show_function   = TRUE;
					$this->_show_controller = FALSE;
					break;
				case 'controller':
					$this->_show_function   = FALSE;
					$this->_show_controller = TRUE;
					break;
				case 'none':
					$this->_show_function   = FALSE;
					$this->_show_controller = FALSE;
					break;
				default:
					$this->_show_function   = TRUE;
					$this->_show_controller = TRUE;
			}
		}
	}
