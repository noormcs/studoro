<?
/***************************************************************************
*                            Dolphin Smart Community Builder
*                              -------------------
*     begin                : Mon Mar 23 2006
*     copyright            : (C) 2007 BoonEx Group
*     website              : http://www.boonex.com
* This file is part of Dolphin - Smart Community Builder
*
* Dolphin is free software; you can redistribute it and/or modify it under
* the terms of the GNU General Public License as published by the
* Free Software Foundation; either version 2 of the
* License, or  any later version.
*
* Dolphin is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
* without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
* See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with Dolphin,
* see license.txt file; if not, write to marketing@boonex.com
***************************************************************************/

$aConfig = array(
	/**
	 * Main Section.
	 */
	'title' => 'Profiles Map',
    'version' => '1.0.9',
	'vendor' => 'Boonex',
	'update_url' => '',
	
	'compatible_with' => array(
        '7.0.9'
    ),

    /**
	 * 'home_dir' and 'home_uri' - should be unique. Don't use spaces in 'home_uri' and the other special chars.
	 */
	'home_dir' => 'boonex/map_profiles/',
	'home_uri' => 'map_profiles',
	
	'db_prefix' => 'bx_map_',
	'class_prefix' => 'BxMap',
	/**
	 * Installation/Uninstallation Section.
	 */
	'install' => array(
		'show_introduction' => 0,
		'change_permissions' => 0,
		'execute_sql' => 1,
        'update_languages' => 1,
        'recompile_global_paramaters' => 1,
		'recompile_main_menu' => 1,
		'recompile_member_menu' => 0,
        'recompile_site_stats' => 0,		
		'recompile_page_builder' => 1,
		'recompile_profile_fields' => 0,
		'recompile_comments' => 0,
		'recompile_member_actions' => 0,
		'recompile_tags' => 0,
		'recompile_votes' => 0,
		'recompile_categories' => 0,
		'recompile_search' => 0,
		'recompile_injections' => 0,
		'recompile_permalinks' => 1,
        'recompile_alerts' => 1,
        'clear_db_cache' => 0,
		'show_conclusion' => 1,
	),
	'uninstall' => array (
		'show_introduction' => 0,
		'change_permissions' => 0,
		'execute_sql' => 1,
        'update_languages' => 1,
        'recompile_global_paramaters' => 1,
		'recompile_main_menu' => 1,
		'recompile_member_menu' => 0,
		'recompile_site_stats' => 0,
		'recompile_page_builder' => 1,
		'recompile_profile_fields' => 0,
		'recompile_comments' => 0,
		'recompile_member_actions' => 0,
		'recompile_tags' => 0,
		'recompile_votes' => 0,
		'recompile_categories' => 0,
		'recompile_search' => 0,
		'recompile_injections' => 0,
		'recompile_permalinks' => 1,
        'recompile_alerts' => 1,
        'clear_db_cache' => 0,
		'show_conclusion' => 0,
    ),

	/**
	 * Category for language keys.
	 */
	'language_category' => 'Boonex World Map',

	/**
	 * Permissions Section
	 */
	'install_permissions' => array(),
    'uninstall_permissions' => array(),

	/**
	 * Introduction and Conclusion Section.
	 */
	'install_info' => array(
		'introduction' => '',
		'conclusion' => 'how_to_complete_installation.html'
	),
	'uninstall_info' => array(
		'introduction' => '',
		'conclusion' => ''
	)
);
?>
