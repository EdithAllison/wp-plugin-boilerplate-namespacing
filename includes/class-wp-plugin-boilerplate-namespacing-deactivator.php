<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://agentur-allison.at
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/includes
 * @author     Edith Allison <plugins@agentur-allison.at>
 */
class Wp_Plugin_Boilerplate_Namespacing_Deactivator {
    
    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function deactivate() {
        
    }
    
    /**
    * Recurse delete
    * Source: https://stackoverflow.com/a/3349792/9859790
    **/
    public static function recurseDelete($dirPath = '') {
        
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
    
    public static function is_dir_empty($dir) {
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
    
    /**
     * Delete uploads folder when blog is deleted
    */
    public static function remove_blog( $params ) {
             
        global $wpdb;
        switch_to_blog( $params->blog_id );      
         
        $upload = wp_upload_dir();
        $dir_boilerplate = $upload['basedir'] . '/boilerplate/'; 
        
        self::recurseDelete( $dir_boilerplate );     
             
        restore_current_blog();
         
    } 


}
