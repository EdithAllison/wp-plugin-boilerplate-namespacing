<?php

/**
 * Fired during plugin activation
 *
 * @link       https://agentur-allison.at
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/includes
 * @author     Edith Allison <plugins@agentur-allison.at>
 */
class Wp_Plugin_Boilerplate_Namespacing_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate( $network_wide ) {
        
        global $wpdb; 
             
        if ( is_multisite() &&  $network_wide ) {
    
            // Get all blogs in the network and activate plugin on each one
            $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
                     
            foreach ( $blog_ids as $blog_id ) {           
                switch_to_blog( $blog_id ); 
                self::create_folders();          
                restore_current_blog();
            }
                 
        } else {
                 
            self::create_folders( );     
                 
        } 
        
    }
        
        
    /**
    * This function creates the necessary folders in /uploads/ 
    **/
    private static function create_folders( $folders ) {
        
        $upload = wp_upload_dir();
        $dir_boilerplate = $upload['basedir'] . '/boilerplate'; 
        $dir_zip = $upload['basedir'] . '/boilerplate/zip'; 
        
        if ( !is_dir( $dir_boilerplate ) ) {
            mkdir( $dir_boilerplate, 0755);
        }
        
        if ( !is_dir( $dir_zip ) ) {
            mkdir( $dir_zip, 0755);
        }

    }
    
    
    /**
    *
    * Changes when new blog is added to network. 
    *
    * This function is used to run setup when plugin is activated network wide 
    * and a new blog is set up within the network
    **/
    public static function add_blog( $params ) {
             
        if ( is_plugin_active_for_network( 'wp-plugin-boilerplate-namespacing.php' ) ) {
                 
          switch_to_blog( $params->blog_id );
          
            $upload = wp_upload_dir();
            $dir_boilerplate = $upload['basedir'] . '/boilerplate'; 
            $dir_zip = $upload['basedir'] . '/boilerplate/zip';
                 
            self::create_folders( array( $dir_boilerplate, $dir_zip) );     
                 
            restore_current_blog();
                 
         }
    } 


}
