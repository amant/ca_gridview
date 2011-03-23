<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
 * @version		0.20
 * @filesource
 */

// ------------------------------------------------------------------------

/*
|--------------------------------------------------------------------
| OCULAR LAYOUT LIBRARY SETTINGS
|--------------------------------------------------------------------
| This file will contain the settings necessary for the Ocular Layout
| library to function properly.
|
| Unless you want to store your views in a different location, or
| use a different default naming convention, you shouldn't need
| to edit this file.
|
*/

/*
|--------------------------------------------------------------------
| SITE NAME
|--------------------------------------------------------------------
| The name of the site. This is used for the page title, and is
| available for other's to use within the view.
|
| The site_name_divider is displayed between the page title and
| the site title. A default page title might look like:
|    Create a User | My Site
*/
$config['OCU_site_name'] = "Live to relax!";
$config['OCU_site_name_divider'] = " | ";
$config['OCU_site_name_placement'] = "append";

/*
|--------------------------------------------------------------------
| VIEW DIRECTORY
|--------------------------------------------------------------------
| The location of the application's views. Leave blank for:
|   /system/application/views/
|
| All other views must be located in the views directory, like so:
|   .../views/controller_name/function_name
|
*/
$config['OCU_view_dir'] = "application/views";

/*
|--------------------------------------------------------------------
| TEMPLATE DIRECTORY
|--------------------------------------------------------------------
| The location of the application's templates. Leave blank for:
|   /system/application/views/templates/
| 
| When Ocular goes to render a template, it first checks to see
| if a template exists for the controller being called. If it doesn't,
| it renders the system default template (Defined below). So, for
| an application with a URL of http://mysite.com/friends/1 the 
| controller being called is 'friends'. Ocular would look for a 
| view in the following location (assuming default settings):
|
| /views/templates/friends.php
|
*/
$config['OCU_template_dir'] = "templates";

/*
|--------------------------------------------------------------------
| DEFAULT TEMPLATE
|--------------------------------------------------------------------
| This is the name of the default template used if no others are
| specified.
|
| NOTE: do not include an ending ".php" extension.
|
*/
$config['OCU_default_template'] = "application";

/*
|--------------------------------------------------------------------
| IS A MODULE?
|--------------------------------------------------------------------
| Tells Ocular whether it's used as a module, or as a standard
|   part of the application. 
|
| this is primarily so the Assets controller can be found.
|
*/
$config['OCU_is_module'] = FALSE;

/*
|--------------------------------------------------------------------
| DEFAULT PATHS
|--------------------------------------------------------------------
| The location of the application's supporting files.
|
| Must have the trailing /.
*/
$config['OCU_stylesheet_path'] = "/public/stylesheets/";
$config['OCU_javascript_path'] = "/public/javascripts/";
$config['OCU_images_path'] = "/public/images/";

/*
|--------------------------------------------------------------------
| DEFAULT COLLECTIONS
|--------------------------------------------------------------------
| The collections that are loaded when using the "default" value.
|
| These files are loaded in the order they are listed, so be sure
| to include any files that others may depend on fist.
*/
$config['OCU_stylesheet_default_collection'] = "application";
$config['OCU_javascript_default_collection'] = "";

/*
|--------------------------------------------------------------------
| FAR FUTURE EXPIRES HEADER
|--------------------------------------------------------------------
| Allows you to use a far future expires header on stylesheets,
| javascripts to enhance page display performance.
|
| Note that this requires new versions of scripts and stylesheets to
| have unique names, so it is advised that all file names used
| include version numbers. 
|
| NOTE: Teh cache add date is added to the current time to determine
| the Expires header date.
|
| REFERENCE: http://developer.yahoo.com/performance/rules.html#expires
*/
$config['OCU_cache_javascripts'] = FALSE;
$config['OCU_cache_stylesheets'] = FALSE;

$config['OCU_cache_add_date'] = '1 month';


/*
|--------------------------------------------------------------------
| USE OCULAR PAGES?
|--------------------------------------------------------------------
| Determines whether the Ocular Pages functionality is to be used.  
|
|	Ocular Pages allows you to create/delete/edit pages that do not 
| otherwise existing within the system. If a page is not found and
| would normally kick out a 404, then Pages shows you a custom 404
| page that gives you options to create the page. When you create
| the page, it creates a new view in the path where it would normally
| be found by Ocular. Editing is done using Markdwon Extra syntax.
*/
$config['OCU_use_pages'] = FALSE;

?>
