<?php
	class Test extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Application_Model', 'app_model');
			$this->load->library('ca_gridview');
		}

		function index()
		{
			$this->ocular->set_view_data('page_title', 'Grid Example');
			$this->ocular->render();
		}

		function example_1()
		{
			$config = array(
				'set_query' => $this->app_model->get_country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_1'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region' => array(
						'title' => 'Region',
						'type' => array(
							'text'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'text'
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_2()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_2'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'type' => array(
							'text'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'textfield',
							'table_name' => 'country',
							'primary_key' => 'country_id',
							'html_attribute' => array(
								'size' => '20'
							)
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'type' => array(
							'textfield',
							'table_name' => 'country',
							'primary_key' => 'country_id',
							'html_attribute' => array(
								'size' => '20'
							)
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'textfield',
							'table_name' => 'country',
							'primary_key' => 'country_id',
							'html_attribute' => array(
								'size' => '20'
							)
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_3()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_3'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'type' => array(
							'radio',
							'value' => array(
								1 => 'Asia',
								2 => 'Europe',
								3 => 'North America',
								4 => 'South America',
								5 => 'Africa',
								6 => "Australia",
								7 => "Antartic"
							),
							'table_name' => 'country',
							'primary_key' => 'country_id',
							'open_tag' => '<span style="font-size:11px">',
							'close_tag' => '</span>'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'text'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'text'
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_4()
		{
			$config = array(
				'set_query' => $this->app_model->country(),
				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_4'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),
				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'type' => array(
							'select',
							'value' => array(
								1 => 'Asia',
								2 => 'Europe',
								3 => 'North America',
								4 => 'South America',
								5 => 'Africa',
								6 => "Australia",
								7 => "Antartic"
							),
							'table_name' => 'country',
							'primary_key' => 'country_id'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'text'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'text'
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_5()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_5'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'type' => array(
							'text'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'link',
							'href' => 'http://www.google.com/search?hl=en&q={country_name}'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'text'
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_6()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_6'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),					
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'custom',
							'html' => '<b>{country_name}</b> (<i>{country_2_code}</i>)'
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_7()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_7'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'sortable' => false,
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'sortable' => false,
						'type' => array(
							'text'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'sortable' => false,
						'type' => array(
							'text',
							'open_tag' => '<b>',
							'close_tag' => '</b>'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'sortable' => false,
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'sortable' => false,
						'type' => array(
							'text'
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_8()
		{
			// Configuration for grid
			$config     = '{
						"set_pagination": {
							"enable": true,
							"initialize": {
								"base_url": "' . site_url('test/example_8') . '",
								"per_page": 5,
								"num_links": 5
							},
							"order_field": "country_id",
							"order_type": "ASC",
							"offset": 0
						},
						"set_column": {
							"country_id": {
								"title": "Country-ID",
								"type": {"0":"text"}
							},
							"region_id": {
								"title": "Region-ID",
								"type": {"0":"text"}
							},
							"country_name": {
								"title": "Country",
								"type": {
									"0": "text",
									"open_tag": "<b>",
									"close_tag": "<\/b>"
								}
							},
							"country_3_code": {
								"title": "CODE 3",
								"type": {"0":"text"}
							},
							"country_2_code": {
								"title": "CODE 2",
								"type": {"0":"text"}
							}
						},
						"set_filter": {
							"enable": true,
							"0": {
								"country_id": {
									"title": "Country ID",
									"type": {"0":"number"}
								},
								"country_name": {
									"title": "Country Name",
									"type": {"0":"text", "open":"<b>"}
								},
								"region_id": {
									"title": "Region ",
									"type": {
										"0": "select",
										"value": {
											"1": "Asia",
											"2": "Europe",
											"3": "North America",
											"4": "South America",
											"5": "Africa",
											"6": "Australia",
											"7": "Antartic"
										}
									}
								}
							}
						},
						"set_debug": {
							"enable": false
						}
					}';
			// Query for grid
			$grid_query = array(
				'set_query' => $this->app_model->country()
			);

			// Grid output
			$config = array_merge($grid_query, json_decode($config, true));

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_9()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_9'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'type' => array(
							'text'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'text',
							'open_tag' => '<b>',
							'close_tag' => '</b>'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'text'
						)
					)
				),

				'set_action' => array(
					'enable' => true,
					array(
						'edit' => array(
							'title' => 'Edit',
							'type' => array(
								'image',
								'src' => base_url() . '/public/images/edit.gif'
							),
							'href' => site_url() . '/application/edit/{country_id}',
							'html_attribute' => array(
								'onclick' => "javascript: return fn_edit();"
							)
						),

						'delete' => array(
							'title' => 'Delete',
							'type' => array(
								'image',
								'src' => base_url() . '/public/images/delete.gif'
							),
							'href' => site_url() . '/application/delete/{country_id}',
							'html_attribute' => array(
								'onclick' => "javascript: return fn_delete();"
							)
						),

						'action' => array(
							'title' => 'Action',
							'type' => 'link',
							'href' => site_url() . '/application/action/{country_id}/{region_id}',
							'html_attribute' => array(
								'onclick' => "javascript: return fn_action();"
							)
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_10()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_10'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'sortable' => false,
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'sortable' => false,
						'type' => array(
							'image',
							'src' => base_url() . '/public/images/{region_id}.png'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'sortable' => false,
						'type' => array(
							'text'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'sortable' => false,
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'sortable' => false,
						'type' => array(
							'text'
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_11()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_multirow_selection' => array(
					'enable' => true,
					'primary_key' => 'country_id'
				),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_11'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'type' => array(
							'text'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'text'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'text'
						)
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_12()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_12'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'type' => array(
							'text'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'text'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'text'
						)
					)
				),

				'set_export' => array(
					'enable' => true,
					array(
						'enable_cvs' => true,
						'enable_xml' => true
					)
				),

				'set_print' => array(
					'enable' => true,
					array(
						'print_all' => true,
						'print_current' => true
					)
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}

		function example_13()
		{
			$config = array(
				'set_query' => $this->app_model->country(),

				'set_pagination' => array(
					'enable' => true,
					'initialize' => array(
						'base_url' => site_url('test/example_13'),
						'per_page' => 25,
						'num_links' => 5
					),
					'order_field' => 'country_id',
					'order_type' => 'ASC',
					'offset' => 0
				),

				'set_column' => array(
					'country_id' => array(
						'title' => 'Country-ID',
						'type' => array(
							'text'
						)
					),
					'region_id' => array(
						'title' => 'Region-ID',
						'type' => array(
							'text'
						)
					),
					'country_name' => array(
						'title' => 'Country',
						'type' => array(
							'text'
						)
					),
					'country_3_code' => array(
						'title' => 'CODE 3',
						'type' => array(
							'text'
						)
					),
					'country_2_code' => array(
						'title' => 'CODE 2',
						'type' => array(
							'text'
						)
					)
				),

				'set_debug' => array(
					'enable' => true
				)
			);

			$this->ca_gridview->render_grid($config);

			$this->ocular->render();
		}
	}