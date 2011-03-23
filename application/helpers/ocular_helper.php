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
	 * Ocular Layout Helpers
	 *
	 * @package   Ocular Layout Library
	 * @subpackage	Helpers
	 * @category	Helpers
	 * @author		Lonnie Ezell
	 */

	/**
	 * Render Partial View
	 *
	 * Renders a view file into another view. This is intended to be called
	 * from a view file.
	 *
	 * @access	public
	 * @return  null
	 */
	function render_partial($partial = NULL)
	{
		// Do we have a partial to render?
		if (empty($partial) || (!is_string($partial)))
		{
			return false;
		}

		// Show the page.
		$obj =& get_instance();
		// Do we have a path specified?
		$loc = strchr($partial, "/");
		if ($loc)
		{
			// Replace the last / with /_
			$newLoc  = substr_replace($loc, "_", 1, 0);
			$partial = str_replace($loc, $newLoc, $partial);
			// Show the view
			$obj->load->view($obj->config->item('OCU_template_dir') . "/" . $partial);
		}
		else
		{
			// It's in the same directory!
			$obj->load->view(get_active_controller() . '/_' . $partial);
		}
	}

	/**
	 * Stylesheet Link Tag
	 *
	 * Returns a stylesheet link tag for the sources passed as arguments.
	 * If no extension is supplied, ".css" is automatically appended.
	 *
	 * If no argument is present, it will provide a link to 'application.css'
	 *
	 * Media types can be specified by prepending a colon to the media type.
	 * ie: stylesheet_link_tag("global.css", ":print");
	 *
	 * @access    public
	 * @return    string
	 */
	function stylesheet_link_tag()
	{
		// Our stylesheet tag
		$tag   = '';
		$media = 'all';

		// Do we have any arguments?
		if (func_num_args() == 0)
		{
			// No arguments. Return link to 'application.css'.
			$args = ocular::_default_stylesheets();
		}

		if (empty($args))
		{
			// Get our arguments from the parameters
			$args = func_get_args();
		}

		// Loop through each, adding to stylesheet string
		foreach ($args as $arg)
		{
			// Is it a media tag?
			if (stripos($arg, ":") === false)
			{
				// Add our tag to the list.
				if (!empty($tag))
				{
					$tag .= "/";
				}
				$tag .= $arg;
			}
			else
			{
				// It's a media tag.
				$arg   = trim($arg, ":");
				$media = $arg;
			}
		}

		$CI     = get_instance();
		$module = '';
		if ($CI->config->item('OCU_is_module'))
		{
			$module .= "/ocular";
		}

		return '<link rel="stylesheet" type="text/css" href="' . site_url() . $module . '/assets/stylesheets/' . $tag . '" media="' . $media . '" />' . "\n";
	}

	/**
	 * Javascript Include Tag
	 *
	 * Returns a javascript include link tag for the sources passed as arguments.
	 * If no extension is supplied, ".js" is automatically appended.
	 *
	 * If no argument is present, it will provide a link to the defaults from the
	 * config file.
	 *
	 * @access	public
	 * @return	string
	 */
	function javascript_include_tag()
	{
		// Our javascript tag
		$tag = '';

		// Do we have any arguments?
		if (func_num_args() == 0)
		{
			// No arguments. Return link to the defaults.
			$args = ocular::_default_javascripts();
		}

		if (empty($args))
		{
			// Get our arguments from the parameters
			$args = func_get_args();
		}

		// Loop through each, adding to stylesheet string
		foreach ($args as $arg)
		{
			// Add our tag to the list.
			if (!empty($tag))
			{
				$tag .= "/";
			}
			$tag .= $arg;
		}

		$CI     = get_instance();
		$module = '';
		if ($CI->config->item('OCU_is_module'))
		{
			$module .= "/ocular";
		}
		return '<script type="text/javascript" src="' . site_url() . $module . '/assets/javascripts/' . $tag . '"></script>' . "\n";
	}

	/**
	 * Image Tag
	 *
	 * Returns a link to an image from the string passed into the function.
	 *
	 * @access	public
	 * @param		string - the name of the image (including extension)
	 * @return	string
	 */
	function image_tag($name = '')
	{
		if (!empty($name))
		{
			$CI = get_instance();
			return $CI->config->item('OCU_images_path') . $name;
		}

		return '';
	}

	/**
	 * Get current controller
	 *
	 * Returns the name of the current controller.
	 *
	 * @access	public
	 * @return	string
	 */

	function get_active_controller($get_path = FALSE)
	{
		$CI = get_instance();
		$RTR =& load_class('Router');

		$controller = $RTR->fetch_class();

		if ($get_path)
		{
			$controller = $RTR->fetch_directory() . $CI->config->item('OCU_layout_dir') . $controller;			
		}

		return $controller;
	}

	/**
	 * Get current function
	 *
	 * Returns the name of the current function.
	 *
	 * @access	public
	 * @return	string
	 */

	function get_active_function()
	{
		$RTR =& load_class('Router');

		return $RTR->fetch_method();
	}

	// some of the layout helper function added into ocular
	/**
	 * Return path of file
	 * 
	 * @param <type> $file
	 * @param <type> $type
	 * @param <type> $exists
	 * @return <type>
	 */
	function getPath($file, $type = "images", $exists = false)
	{
		$object = get_instance();

		$existent = false;
		$path     = "";
		$filepath = "";

		switch ($type)
		{
			case "javascript":
				$path = $object->config->item('OCU_javascript_path');
				break;

			case "images":
				$path = $object->config->item('OCU_images_path');
				break;

			case "stylesheet":
				$path = $object->config->item('OCU_stylesheet_path');
				break;
		}

		if (file_exists("." . $path . $file))
		{
			$filepath = $path . $file;			
			return substr($filepath, 1, strlen($filepath) - 1);
		}
		else
		{
			return false;
		}
	}

	/**
	 * Display favicon
	 * 
	 * @param string $file
	 * @return string
	 */
	function favicon($file)
	{
		if (empty($file))
		{
			return;
		}

		$path = getPath($file, "images");

		if ($path !== false)
		{
			return '<link rel="shortcut icon" href="' . base_url() . $path . '" type="image/ico" />' . "\n";
		}
	}

	/**
	 * Return hyper links
	 * 
	 * @param string $location
	 * @param string $title
	 * @param string $target
	 * @param string $attributes
	 * @return string
	 */
	function hyperlink($location, $title, $target = 'self', $attributes = null)
	{
		if (empty($location) || empty($title))
		{
			return;
		}

		$retval = '<a href="' . $location . '" target="_' . $target . '" title="' . $title . '"';
		if (is_array($attributes))
		{
			foreach ($attributes as $key => $value)
				$retval .= " $key=\"$value\"";
		}
		$retval .= ">$title</a>\n";

		return $retval;
	}

	/**
	 * Return image tag
	 * 
	 * @param string $file
	 * @param string $alt
	 * @param string $attributes
	 * @return string
	 */
	function image($file, $alt = null, $attributes = null)
	{
		if (empty($file))
		{
			return;
		}
		
		$file   = getPath($file, 'images', true);
		$retval = false;

		if ($file !== false)
		{
			if (!isset($attributes['width']) && !isset($attributes['height']))
				list($width, $height, $type, $attr) = @getimagesize("./" . $file);

			$retval = '<img src="' . base_url() . $file . '"' . (isset($attr) ? " $attr" : null);
			if (is_array($attributes))
				foreach ($attributes as $key => $value)
					$retval .= "$key=\"$value\" ";
			if (!is_null($alt))
				$retval .= ' alt="' . $alt . '" title="' . $alt . '" ';
			$retval .= "/>";

		}
		return $retval;
	}

	/**
	 * Return script tag
	 *
	 * @param string $file
	 * @return string
	 */
	function script($file)
	{
		if (empty($file))
		{
			return;
		}

		$file = getPath($file, 'javascript');
		if ($file)
		{
			return '<script src="' . base_url() . $file . '" type="text/javascript" charset="utf-8"></script>' . "\n";
		}
	}

	/**
	 * Return style tag
	 * 
	 * @param string $file
	 * @param string $attributes
	 * @return string
	 */
	function style($file, $attributes = null)
	{
		if (empty($file))
		{
			return;
		}

		if (is_array($attributes))
		{
			$retval = '<link rel="stylesheet" href="' . base_url() . getPath($file, 'stylesheet') . '" type="text/css" ';
			foreach ($attributes as $key => $value)
			{
				$retval .= "$key=\"$value\" ";
			}
			$retval .= "/>\n";
		}
		else
		{
			$retval = '<link rel="stylesheet" href="' . base_url() . getPath($file, 'stylesheet') . '" type="text/css" media="all" />' . "\n";
		}

		return $retval;
	}