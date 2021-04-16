<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://agentur-allison.at
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Boilerplate_Namespacing
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb; 

/**
 * Check for Multisite.
 *
 * If Multisite, delete for all blogs (deletion at network level)
 * Otherwise, delete for current
 */	 
if ( is_multisite() ) {
        
    // Get all blogs in the network and delete tables on each one
    $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
     
    foreach ( $blog_ids as $blog_id ) {
         
        switch_to_blog( $blog_id );
             
        wp_plugin_boilerplate_namespacing_uninstall_plugin(); 
             
        restore_current_blog();
    }
     
} else {
     
  wp_plugin_boilerplate_namespacing_uninstall_plugin(); 
     
}
 
/**
* This function is used on plugin deletion. 
*
* Deletes custom upload folders 
*
**/
function wp_plugin_boilerplate_namespacing_uninstall_plugin() {
 
  global $wpdb; 
  
  $upload = wp_upload_dir();
  $dir_boilerplate = $upload['basedir'] . '/boilerplate/'; 
  
  wp_plugin_boilerplate_namespacing_recurseDelete( $dir_boilerplate ); 
     
}


function  wp_plugin_boilerplate_namespacing_recurseDelete($dirPath = '') {
    
    $upload = wp_upload_dir();
    
    if (empty($dirPath) || !is_dir($dirPath) || strpos($dirPath, $upload['basedir'] . '/boilerplate/' ) !== 0   ) {
        return false; // safety check to only run when we're in the right directory
    }
    
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::recurseDelete($file);
        } else {
            unlink($file);
        }
    }
    if ( self::is_dir_empty($dirPath) ) {
        rmdir($dirPath);
    }
    return true; 
}

function  wp_plugin_boilerplate_namespacing_is_dir_empty($dir) {
    $handle = opendir($dir);
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          closedir($handle);
          return FALSE;
        }
    }
    closedir($handle);
    return TRUE;
}
