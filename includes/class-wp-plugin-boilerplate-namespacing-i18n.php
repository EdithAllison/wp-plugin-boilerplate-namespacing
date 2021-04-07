<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://agentur-allison.at
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/includes
 * @author     Edith Allison <plugins@agentur-allison.at>
 */
class Wp_Plugin_Boilerplate_Namespacing_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-plugin-boilerplate-namespacing',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
