<?php
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 */

$aConfig = array(
    /**
     * Main Section.
     */
    'vendor' => 'Boonex',
    'title' => 'Profile Customizer',
    'version' => '1.1.5',
    'update_url' => '',

    'compatible_with' => array(
        '7.1.5'
    ),

    /**
     * 'home_dir' and 'home_uri' - should be unique. Don't use spaces in 'home_uri' and the other special chars.
     */
    'home_dir' => 'boonex/profile_customize/',
    'home_uri' => 'profile_customize',

    'db_prefix' => 'bx_profile_custom_',
    'class_prefix' => 'BxProfileCustomize',
    /**
     * Installation/Uninstallation Section.
     */
    'install' => array(
        'check_dependencies' => 0,
        'show_introduction' => 1,
        'change_permissions' => 1,
        'execute_sql' => 1,
        'update_languages' => 1,
        'recompile_global_paramaters' => 1,
        'recompile_main_menu' => 0,
        'recompile_member_menu' => 0,
        'recompile_site_stats' => 0,
        'recompile_page_builder' => 0,
        'recompile_profile_fields' => 0,
        'recompile_comments' => 0,
        'recompile_member_actions' => 1,
        'recompile_tags' => 0,
        'recompile_votes' => 0,
        'recompile_categories' => 0,
        'recompile_search' => 0,
        'recompile_browse' => 0,
        'recompile_injections' => 0,
        'recompile_permalinks' => 1,
        'recompile_alerts' => 0,
        'show_conclusion' => 1
    ),
    'uninstall' => array (
        'check_dependencies' => 0,
        'show_introduction' => 1,
        'change_permissions' => 0,
        'execute_sql' => 1,
        'update_languages' => 1,
        'recompile_global_paramaters' => 1,
        'recompile_main_menu' => 0,
        'recompile_member_menu' => 0,
        'recompile_site_stats' => 0,
        'recompile_page_builder' => 0,
        'recompile_profile_fields' => 0,
        'recompile_comments' => 0,
        'recompile_member_actions' => 1,
        'recompile_tags' => 0,
        'recompile_votes' => 0,
        'recompile_categories' => 0,
        'recompile_search' => 0,
        'recompile_browse' => 0,
        'recompile_injections' => 0,
        'recompile_permalinks' => 1,
        'recompile_alerts' => 0,
        'show_conclusion' => 1
    ),
    /**
     * Dependencies Section
     */
    'dependencies' => array(
    ),
    /**
     * Category for language keys.
     */
    'language_category' => 'Boonex Profile Customize',
    /**
     * Permissions Section
     */
    'install_permissions' => array(
       'writable' => array('data/images')
    ),
    'uninstall_permissions' => array(),
    /**
     * Introduction and Conclusion Section.
     */
    'install_info' => array(
        'introduction' => 'inst_intro.html',
        'conclusion' => 'inst_concl.html'
    ),
    'uninstall_info' => array(
        'introduction' => 'uninst_intro.html',
        'conclusion' => 'uninst_concl.html'
    )
);
