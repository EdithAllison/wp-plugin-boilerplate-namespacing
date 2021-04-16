<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://agentur-allison.at
 * @since             1.0.0
 * @package           Wp_Plugin_Boilerplate_Namespacing
 *
 * @wordpress-plugin
 * Plugin Name:       WP Plugin Boilerplate with Namespacing
 * Plugin URI:        https://agentur-allison.at/wppbn/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.10
 * Author:            Edith Allison
 * Author URI:        https://agentur-allison.at
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-plugin-boilerplate-namespacing
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_PLUGIN_BOILERPLATE_NAMESPACING_VERSION', '1.0.10' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-plugin-boilerplate-namespacing-activator.php
 */
function activate_wp_plugin_boilerplate_namespacing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-boilerplate-namespacing-activator.php';
	Wp_Plugin_Boilerplate_Namespacing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-plugin-boilerplate-namespacing-deactivator.php
 */
function deactivate_wp_plugin_boilerplate_namespacing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-boilerplate-namespacing-deactivator.php';
	Wp_Plugin_Boilerplate_Namespacing_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_plugin_boilerplate_namespacing' );
register_deactivation_hook( __FILE__, 'deactivate_wp_plugin_boilerplate_namespacing' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-boilerplate-namespacing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_plugin_boilerplate_namespacing() {

	$plugin = new Wp_Plugin_Boilerplate_Namespacing();
	$plugin->run();
    
    // if we have a new blog on a multisite let's create tables 
    add_action( 'wp_insert_site', '\wp_plugin_boilerplate_namespacing_run_multisite_new_site');		
    
    //if a blog is removed, let's delete the tables
    add_action( 'wp_uninitialize_site', '\wp_plugin_boilerplate_namespacing_run_multisite_delete');

}
run_wp_plugin_boilerplate_namespacing();

function wp_plugin_boilerplate_namespacing_run_multisite_new_site($params) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-boilerplate-namespacing-activator.php';	
    Wp_Plugin_Boilerplate_Namespacing_Activator:add_blog($params);
}


function wp_plugin_boilerplate_namespacing_run_multisite_delete($params) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-boilerplate-namespacing-deactivator.php';
    Wp_Plugin_Boilerplate_Namespacing_Deactivator::remove_blog($params);		
}

