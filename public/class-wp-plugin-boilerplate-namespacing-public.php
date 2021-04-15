<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://agentur-allison.at
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/public
 * @author     Edith Allison <plugins@agentur-allison.at>
 */
class Wp_Plugin_Boilerplate_Namespacing_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Plugin_Boilerplate_Namespacing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Plugin_Boilerplate_Namespacing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-plugin-boilerplate-namespacing-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Plugin_Boilerplate_Namespacing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Plugin_Boilerplate_Namespacing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 
		wp_enqueue_script( 'boilerplate_generator', plugin_dir_url( __FILE__ ) . 'js/wp-plugin-boilerplate-namespacing-public.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Shortcode processing function.
	 * Shortcode can take arguments like [plugin-name-shortcode argm='123']
	 */
	public function get_download_form() {
		
		ob_start();
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wp-plugin-boilerplate-namespacing-public-display.php'; 
		
		$output = ob_get_clean();
		
		return $output; 

	}

	/**
	* Copy a folder and all its content to a new destination 
	* Source: https://stackoverflow.com/a/2050909/9859790
	**/	
	public function recurseCopy($src,$dst, $childFolder='') { 
	
		$dir = opendir($src); 
		mkdir($dst);
		if ($childFolder!='') {
			mkdir($dst.'/'.$childFolder);
	
			while(false !== ( $file = readdir($dir)) ) { 
				if (( $file != '.' ) && ( $file != '..' )) { 
					if ( is_dir($src . '/' . $file) ) { 
						$this->recurseCopy($src . '/' . $file,$dst.'/'.$childFolder . '/' . $file); 
					} 
					else { 
						copy($src . '/' . $file, $dst.'/'.$childFolder . '/' . $file); 
					}  
				} 
			}
		}else{
				// return $cc; 
			while(false !== ( $file = readdir($dir)) ) { 
				if (( $file != '.' ) && ( $file != '..' )) { 
					if ( is_dir($src . '/' . $file) ) { 
						$this->recurseCopy($src . '/' . $file, $dst . '/' . $file); 
					} 
					else { 
						copy($src . '/' . $file, $dst . '/' . $file); 
					}  
				} 
			} 
		}
		
		closedir($dir); 
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
	* Inserts text into file 
	* Insert position default is "beginning"
	* Possible options are:
	* r+ append at beginning
	* a+ prepend at end
	* w+ overwrite
	* for full list see https://www.php.net/manual/en/function.fopen.php
	**/	
	public function insert_text($file, $text, $position = 'r+') {				
		$file = fopen($file, $position) or exit(); 
		fwrite($file, $text); 
		fclose($file);	 		
	}
	
	/**
	* Zip recursively
	**/
	function recurseZip($source, $destination) {
		
		if (!extension_loaded('zip') || !file_exists($source)) {
			return false;
		}
	
		$zip = new ZipArchive();
		if (!$zip->open($destination, ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE)) {
			return false;
		}
	
		$source = str_replace('\\', '/', realpath($source));
	
		if (is_dir($source) === true) {
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
	
			foreach ($files as $file) 	{
				$file = str_replace('\\', '/', $file);
	
				// Ignore "." and ".." folders
				if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
					continue;
	
				$file = realpath($file);
	
				if (is_dir($file) === true) 	{
					$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
				}
				else if (is_file($file) === true) {
					$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
				}
			}
		}
		else if (is_file($source) === true) {
			$zip->addFromString(basename($source), file_get_contents($source));
		}
	
		return $zip->close();
	}
	
	
	
	/**
	* Handles file download generation 
	**/
	public function download_file($input) {

		// Set variables
		$upload = wp_upload_dir();
		$identifier =  time() . '_' .rand(9,9999); // identifier for this download 
		$zipdst = $upload['basedir'] . '/boilerplate/zip/' . $identifier; // folder for zip file 
		mkdir($zipdst);
		$dst = $upload['basedir'] . '/boilerplate/' . $identifier; // temp folder. deleted after zip 
		$src = plugin_dir_path( dirname( __FILE__ ) ) . 'source/plugin-name';
		$html = '';

		// Before a new download, clean up zip files older than 1 day 
		$old_folders = glob($upload['basedir'] . '/boilerplate/zip/*' , GLOB_ONLYDIR);		
		foreach($old_folders as $old) {
			$age = time() - filemtime($old);
			if ($age > (60 * 60 * 24) ) {
				$this->recurseDelete($old);
			}
		}
		
		// Clone folder
		$copy = $this->recurseCopy($src, $dst);	
		
		// Rename files
		rename( $dst . '/plugin-name.php', $dst . '/' . $input['plugin_slug'] . '.php' );
		rename( $dst . '/languages/plugin-name.pot', $dst . '/languages/' . $input['plugin_slug'] . '.pot' );
		
		rename( $dst . '/includes/class-plugin-name-activator.php', $dst . '/includes/class-' . $input['plugin_slug'] . '-activator.php' );
		rename( $dst . '/includes/class-plugin-name-deactivator.php', $dst . '/includes/class-' . $input['plugin_slug'] . '-deactivator.php' );
		rename( $dst . '/includes/class-plugin-name-i18n.php', $dst . '/includes/class-' . $input['plugin_slug'] . '-i18n.php' );
		rename( $dst . '/includes/class-plugin-name.php', $dst . '/includes/class-' . $input['plugin_slug'] . '.php' );
				
		rename( $dst . '/admin/class-plugin-name-admin.php', $dst . '/admin/class-' . $input['plugin_slug'] . '-admin.php' );
		rename( $dst . '/admin/css/plugin-name-admin.css', $dst . '/admin/css/' . $input['plugin_slug'] . '-admin.css' );
		rename( $dst . '/admin/js/plugin-name-admin.js', $dst . '/admin/js/' . $input['plugin_slug'] . '-admin.js' );
		rename( $dst . '/admin/partials/plugin-name-admin-display.php', $dst . '/admin/partials/' . $input['plugin_slug'] . '-admin-display.php' );
		
		rename( $dst . '/public/class-plugin-name-public.php', $dst . '/public/class-' . $input['plugin_slug'] . '-public.php' );
		rename( $dst . '/public/css/plugin-name-public.css', $dst . '/public/css/' . $input['plugin_slug'] . '-public.css' );
		rename( $dst . '/public/js/plugin-name-public.js', $dst . '/public/js/' . $input['plugin_slug'] . '-public.js' );
		rename( $dst . '/public/partials/plugin-name-public-display.php', $dst . '/public/partials/' . $input['plugin_slug'] . '-public-display.php' );
		
		// Create additional variables
		$string = preg_replace('/\s+/', '_', $input['plugin_name']);
		$input['package'] = ucwords( $string, '_');
		$input['upper'] = strtoupper($string);
		$input['lower'] = strtolower($string);
		
		// Insert text
		$this->insert_text(  $dst . '/' . $input['plugin_slug'] . '.php', $this->get_content($input, 'plugin-name.php') , 'w+');
		$this->insert_text(  $dst . '/uninstall.php', $this->get_content($input, 'uninstall.php') , 'w+');
		
		$this->insert_text(  $dst . '/includes/class-' . $input['plugin_slug'] . '.php', $this->get_content($input, 'includes/class-plugin-name.php') , 'w+');
		$this->insert_text(  $dst . '/includes/class-' . $input['plugin_slug'] . '-i18n.php', $this->get_content($input, 'includes/class-plugin-name-i18n.php') , 'w+');
		$this->insert_text(  $dst . '/includes/class-' . $input['plugin_slug'] . '-activator.php' , $this->get_content($input, 'includes/class-plugin-name-activator.php') , 'w+');
		$this->insert_text(  $dst . '/includes/class-' . $input['plugin_slug'] . '-deactivator.php' , $this->get_content($input, 'includes/class-plugin-name-deactivator.php') , 'w+');

		$this->insert_text(  $dst . '/admin/class-' . $input['plugin_slug'] . '-admin.php' , $this->get_content($input, 'admin/class-plugin-name-admin.php') , 'w+');
		$this->insert_text(  $dst . '/admin/partials/' . $input['plugin_slug'] . '-admin-display.php', $this->get_content($input, 'admin/partials/plugin-name-admin-display.php') , 'w+');

		$this->insert_text(  $dst . '/public/class-' . $input['plugin_slug'] . '-public.php' , $this->get_content($input, 'public/class-plugin-name-public.php') , 'w+');
		$this->insert_text(  $dst . '/public/partials/' . $input['plugin_slug'] . '-public-display.php', $this->get_content($input, 'public/partials/plugin-name-admin-public.php') , 'w+');
			
		// ZIP
		$zipfile_path = $zipdst . '/' . $input['plugin_slug'] . '.zip';
		$zipfile_dir = $upload['baseurl'] . '/boilerplate/zip/' . $identifier . '/' . $input['plugin_slug'] . '.zip';
		$zipfile = $this->recurseZip( $dst , $zipfile_path); 	
				
		// Delete folder 
		$this->recurseDelete($dst); 
		
		if (is_file($zipfile_path) ) {
				
			// Output download button 
			
			ob_start(); ?>
			
			<h2> <?php _e('Your Plugin is ready!', 'agentur_allison'); ?> </h2>
			
			<p class="boilerplate_button_download"> <a class="button" href="<?php echo $zipfile_dir; ?>" download="<?php echo $input['plugin_slug'] . '.zip'; ?>" > <?php _e('Download Plugin ZIP file', 'agentur_allison'); ?></a> </p>
			
			<p> <a href="<?php echo get_permalink( get_the_ID() ); ?>"> <?php  _e('Generate a different plugin', 'agentur_allison'); ?> </a>
			
			<?php $html = ob_get_clean();
		
		} else {

			ob_start(); ?>
			
			<p> <?php  _e('Sorry, something went wrong. ', 'agentur_allison'); ?> <a href="<?php echo get_permalink( get_the_ID() ); ?>"> <?php  _e('Please try again.', 'agentur_allison'); ?> </a>
			
			<?php $html = ob_get_clean();			
			
		}
		
		return $html; 

	} // ends download_file()
	
	/**
	* Get content
	* Requires $input array from from
	**/
	public function get_content($input, $file  ) {
		
		$text = '';
		
		if (!empty($file) && !empty($input)) {
			
			switch ($file) {
				
				case 'plugin-name.php':  // PLUGIN-NAME.PHP
				
				ob_start();		?>

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              <?php echo $input['plugin_url'] . "\n"; ?>
 * @since             1.0.0
 * @package           <?php echo $input['package'] . "\n"; ?>
 *
 * @wordpress-plugin
 * Plugin Name:       <?php echo $input['plugin_name'] . "\n"; ?>
 * Plugin URI:        <?php echo $input['plugin_url'] . "\n"; ?>
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            <?php echo $input['plugin_author_name'] . "\n"; ?>
 * Author URI:        <?php echo $input['plugin_author_url'] . "\n"; ?>
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       <?php echo $input['lower'] . "\n"; ?>
 * Domain Path:       /languages
 */
 
 namespace <?php echo $input['plugin_namespace']; ?>;
 use <?php echo $input['plugin_namespace']; ?>\Inc;
 use <?php echo $input['plugin_namespace']; ?>\Activate;
 use <?php echo $input['plugin_namespace']; ?>\Deactivate;
 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( '<?php echo $input['upper']; ?>_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-<?php echo $input['plugin_slug']; ?>-activator.php
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-<?php echo $input['plugin_slug']; ?>-activator.php';
register_activation_hook( __FILE__, array( __NAMESPACE__ . '\Activate\<?php echo $input['package']; ?>_Activator', 'activate') );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-<?php echo $input['plugin_slug']; ?>-deactivator.php
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-<?php echo $input['plugin_slug']; ?>-deactivator.php';
register_deactivation_hook( __FILE__, array( __NAMESPACE__ . '\Deactivate\<?php echo $input['package']; ?>_Deactivator', 'deactivate') );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-<?php echo $input['plugin_slug']; ?>.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
call_user_func( array( new \<?php echo $input['plugin_namespace']; ?>\Inc\<?php echo $input['package']; ?>(), 'run' ) );


				<?php $text = '<?php' . "\n" . ob_get_clean(); 
				
				break; 
				
				case 'uninstall.php': // UNINSTALL.PHP
				
				ob_start();		?>

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
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 *
 * @package    <?php echo $input['package'] . "\n"; ?>
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
 *
 * @since    1.0.0
 */	 
if ( is_multisite() ) {
		
	// Get all blogs in the network and delete tables on each one
	$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
	 
	foreach ( $blog_ids as $blog_id ) {
		 
		switch_to_blog( $blog_id );
			 
		<?php echo $input['lower']; ?>_uninstall_plugin(); 
			 
		restore_current_blog();
	}
	 
} else {
	 
  <?php echo $input['lower']; ?>_uninstall_plugin(); 
	 
}
 
/**
* This function is used on plugin deletion. 
*
* Amend to include your own tasks such as 
* unschedule cron events with wp_unschedule_event()
* remove options with delete_option() 
* delete custom DB tables  
*
* For sample code see https://agentur-allison.at/how-to-write-a-multisite-compatible-wordpress-plugin/
**/
function <?php echo $input['lower']; ?>_uninstall_plugin() {
 
  global $wpdb; 
  
  // Add your own code here 
	 
}

				<?php $text = '<?php' . "\n" . ob_get_clean(); 				
				
				break; 
				
				case 'includes/class-plugin-name.php': // INCLUDES/CLASS-PLUGIN-NAME.PHP
				
				ob_start();		?>

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 * @package    <?php echo $input['package'] . "\n"; ?>
 * @subpackage <?php echo $input['package']; ?>/includes
 * @author     <?php echo $input['plugin_author_name']; ?> <<?php echo $input['plugin_author_email']; ?>>
 */
 
namespace <?php echo $input['plugin_namespace']; ?>\Inc;
use <?php echo $input['plugin_namespace']; ?>\Activate;
use <?php echo $input['plugin_namespace']; ?>\Deactivate;
use <?php echo $input['plugin_namespace']; ?>\i18n;
use <?php echo $input['plugin_namespace']; ?>\Admin;
use <?php echo $input['plugin_namespace']; ?>\Front;

class <?php echo $input['package']; ?> {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $<?php echo $input['lower']; ?>    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( '<?php echo $input['upper']; ?>_VERSION' ) ) {
			$this->version = <?php echo $input['upper']; ?>_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this-><?php echo $input['lower']; ?> = '<?php echo $input['plugin_slug']; ?>';

		$this->load_dependencies();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - <?php echo $input['package']; ?>_Loader. Orchestrates the hooks of the plugin.
	 * - <?php echo $input['package']; ?>_i18n. Defines internationalization functionality.
	 * - <?php echo $input['package']; ?>_Admin. Defines all hooks for the admin area.
	 * - <?php echo $input['package']; ?>_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-<?php echo $input['plugin_slug']; ?>-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-<?php echo $input['plugin_slug']; ?>-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-<?php echo $input['plugin_slug']; ?>-public.php';

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the <?php echo $input['package']; ?>_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new \<?php echo $input['plugin_namespace']; ?>\i18n\<?php echo $input['package']; ?>_i18n();
		add_action( 'plugins_loaded', array($plugin_i18n, 'load_plugin_textdomain') );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new \<?php echo $input['plugin_namespace']; ?>\Admin\<?php echo $input['package']; ?>_Admin( $this->get_plugin_name(), $this->get_version() );

		add_action( 'admin_enqueue_scripts', array($plugin_admin, 'enqueue_styles') );
		add_action( 'admin_enqueue_scripts', array($plugin_admin, 'enqueue_scripts') );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new \<?php echo $input['plugin_namespace']; ?>\Front\<?php echo $input['package']; ?>_Public( $this->get_plugin_name(), $this->get_version() );

		add_action( 'wp_enqueue_scripts', array($plugin_public, 'enqueue_styles') );
		add_action( 'wp_enqueue_scripts', array($plugin_public, 'enqueue_scripts') );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->set_locale();
		
		// Only fires admin hooks in admin; Public hooks in frontend. 
		// Modify as your project needs it.
		if ( is_admin() ) {
		  $this->define_admin_hooks();
		} else {
		  $this->define_public_hooks();
		}
		
		// if we have a new blog on a multisite let's set it up
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-<?php echo $input['plugin_slug']; ?>-activator.php';
		add_action( 'wp_insert_site', array( __NAMESPACE__ .  '\<?php echo $input['plugin_namespace']; ?>\Activate\<?php echo $input['package']; ?>_Activator', 'add_blog') );      
			 
		//if a blog is removed, let's remove the settings 
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-<?php echo $input['plugin_slug']; ?>-deactivator.php';
		add_action( 'wp_uninitialize_site', array( __NAMESPACE__ .  '\<?php echo $input['plugin_namespace']; ?>\Deactivate\<?php echo $input['package']; ?>_Deactivator', 'remove_blog') ); 
	   
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
				
				<?php $text = '<?php' . "\n" . ob_get_clean();
				break; 
				
				
				case 'includes/class-plugin-name-i18n.php': // INCLUDES/CLASS-PLUGIN-NAME-I18N.PHP
								
				ob_start();		?>

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 * @package    <?php echo $input['package'] . "\n"; ?>
 * @subpackage <?php echo $input['package']; ?>/includes
 * @author     <?php echo $input['plugin_author_name']; ?> <<?php echo $input['plugin_author_email']; ?>>
 */
 
namespace <?php echo $input['plugin_namespace']; ?>\i18n;

class <?php echo $input['package']; ?>_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'<?php echo $input['plugin-slug']; ?>',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}

				<?php $text = '<?php' . "\n" . ob_get_clean();
				break; 
				
				case 'includes/class-plugin-name-activator.php': // INCLUDES/CLASS-PLUGIN-NAME-ACTIVATOR.PHP
				ob_start();		?>
				
/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 * @package    <?php echo $input['package'] . "\n"; ?>
 * @subpackage <?php echo $input['package']; ?>/includes
 * @author     <?php echo $input['plugin_author_name']; ?> <<?php echo $input['plugin_author_email']; ?>>
 */
 
namespace <?php echo $input['plugin_namespace']; ?>\Activate;

class <?php echo $input['package']; ?>_Activator {

	/**
	* Database Version 
	*
	* @since    1.0.0
	* * @var      string    $<?php echo $input['lower']; ?>_db_version    Plugin database version
	*/
	public static $<?php echo $input['lower']; ?>_db_version = '1.0.0';

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
			  
			self::create_table();       
			self::set_options();            
			self::schedule_cron();    
		
			restore_current_blog();
		  }
				 
		} else {
				 
		  	self::create_table();     
		    self::set_options();      
		    self::schedule_cron(); 
				 
		} 

	}
	
	/**
	* This function demonstrates how database changes can be run on plugin activation. 
	*
	* Amend to include your own db changes eg creating tables 
	* For sample code see https://agentur-allison.at/how-to-write-a-multisite-compatible-wordpress-plugin/
	**/
	private static function create_table() {
		 
		global $wpdb;   
		$installed_ver = get_option( "<?php echo $input['lower']; ?>_db_version";
			 
		if ( empty($installed_ver) || $installed_ver != self::$<?php echo $input['lower']; ?>_db_version ) {
		 
		 	// Add here your own DB changes
				 
		  update_option( "<?php echo $input['lower']; ?>_db_version", self::$<?php echo $input['lower']; ?>_db_version);
			 
		}	 
  	}  
  
  	/**
	* This function demonstrates how to set options. 
	*
	* Amend to include your own options
	* For sample code see https://agentur-allison.at/how-to-write-a-multisite-compatible-wordpress-plugin/
	*
	* For usage of update_option() see https://developer.wordpress.org/reference/functions/update_option/
	* 
	**/
	private static function set_options() {
		   
	  // Add your own options with update_option()
		   
	} 
	
	/**
	* This function demonstrates how to set up a cron.
	*
	* Amend to include your own cron
	* For sample code see https://agentur-allison.at/how-to-write-a-multisite-compatible-wordpress-plugin/
	*
	* For usage of wp_schedule_event() see https://developer.wordpress.org/reference/functions/wp_schedule_event/ 
	**/
	
	private static function schedule_cron() { 
	
		// Add your own cron with wp_schedule_event() 
		 
  	}
	  
	/**
	*
	* Changes when new blog is added to network. 
	*
	* This function is used to run setup when plugin is activated network wide 
	* and a new blog is set up within the network
	*
	* For sample code see https://agentur-allison.at/how-to-write-a-multisite-compatible-wordpress-plugin/
	**/
	public static function add_blog( $params ) {
			 
		if ( is_plugin_active_for_network( '<?php echo $input['plugin_slug']; ?>/<?php echo $input['plugin_slug']; ?>.php' ) ) {
				 
		  switch_to_blog( $params->blog_id );
				 
		  self::create_table();     
		  self::set_options();      
		  self::schedule_cron(); 
				 
		  restore_current_blog();
				 
		 }
	}  	
	
}
							
				<?php $text = '<?php' . "\n" . ob_get_clean();
				break;
				
				case 'includes/class-plugin-name-deactivator.php': // INCLUDES/CLASS-PLUGIN-NAME-DEACTIVATOR.PHP
				ob_start();		?>

/**
 * Fired during plugin deactivation
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 * @package    <?php echo $input['package'] . "\n"; ?>
 * @subpackage <?php echo $input['package']; ?>/includes
 * @author     <?php echo $input['plugin_author_name']; ?> <<?php echo $input['plugin_author_email']; ?>>
 */
 
namespace <?php echo $input['plugin_namespace']; ?>\Deactivate;

class <?php echo $input['package']; ?>_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate( $network_wide ) {
	
		global $wpdb; 
				 
		if ( is_multisite() &&  $network_wide ) {
				 
		  // Get all blogs in the network and deactivate cron on each 
		  $blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
				 
		  foreach ( $blog_ids as $blog_id ) {
					 
			switch_to_blog( $blog_id );
					 
			  // if the plugin was previously activated locally we honour the local decision and leave it in place  
			  // this follows the same logic as deactivate_plugins() in /wp-admin/includes/plugin.php line 734 
			  if ( !in_array( 'foo/foo.php', (array) get_option( 'active_plugins', array() ) )  ) {                 
				self::unschedule_cron();                    
			  }
					 
			restore_current_blog();
		  }
				 
		} else {        
		  self::unschedule_cron();         
		} 
	
	}
	
	/**
	 * This function demonstrates how to unschedule cron on deactivation.
	 *
	 * Amend to include your own cron
	 * For sample code see https://agentur-allison.at/how-to-write-a-multisite-compatible-wordpress-plugin/
	 *
	 * For usage of wp_unschedule_event() see https://developer.wordpress.org/reference/functions/wp_unschedule_event/ 
	 *
	 * @since    1.0.0
	*/
	public static function unschedule_cron() {       
	
		// Add your own code using wp_unschedule_event()              
	}    
 
	 
	/**
	 * This function demonstrates how to delete content from DB when a blog is deleted.
	 *
	 * Amend to include your own db changes eg dropping tables 
	 * For sample code see https://agentur-allison.at/how-to-write-a-multisite-compatible-wordpress-plugin/
	 *
	 * Options and Cron Events are automatically deleted on blog deletion
	 * But custom tables need to be deleted by plugin 
	 * Always tidy up after yourself!
	 *
	 * @since    1.0.0
	*/
	public static function remove_blog( $params ) {
			 
		global $wpdb;
		switch_to_blog( $params->blog_id );      
		 
		// Add your own code to delete DB content such as custom tables      
			 
		restore_current_blog();
		 
	} 

}
				
				<?php $text = '<?php' . "\n" . ob_get_clean();
				break;
				
				case 'admin/class-plugin-name-admin.php': // ADMIN/CLASS-PLUGIN-NAME-ADMIN.PHP
				ob_start();		?>	
				
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 *
 * @package    <?php echo $input['package'] . "\n"; ?>
 * @subpackage <?php echo $input['package']; ?>/admin
 * @author     <?php echo $input['plugin_author_name']; ?> <<?php echo $input['plugin_author_email']; ?>>
 */
 
namespace <?php echo $input['plugin_namespace']; ?>\Admin;

class <?php echo $input['package']; ?>_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in <?php echo $input['package']; ?>_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The <?php echo $input['package']; ?>_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * You can use the $hook parameter to filter for a particular page,
		 * for more information see the codex,
		 * https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/<?php echo $input['plugin_slug']; ?>-admin.css', array(), filemtime( plugin_dir_path( __FILE__ ) . 'css/<?php echo $input['plugin_slug']; ?>-admin.css'), 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in <?php echo $input['package']; ?>_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The <?php echo $input['package']; ?>_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 *
		 * You can use the $hook parameter to filter for a particular page,
		 * for more information see the codex,
		 * https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/<?php echo $input['plugin_slug']; ?>-admin.js', array( 'jquery' ), filemtime( plugin_dir_path( __FILE__ ) . 'js/<?php echo $input['plugin_slug']; ?>-admin.js' ), false );

	}

}
			
				<?php $text = '<?php' . "\n" . ob_get_clean();
				break;	
				
				
				case 'admin/partials/plugin-name-admin-display.php': // ADMIN/PARTIALS/PLUGIN-NAME-ADMIN-DISPLAY.PHP
				ob_start();		?>	

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 *
 * @package    <?php echo $input['package'] . "\n"; ?>
 * @subpackage <?php echo $input['package']; ?>/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
	
				<?php $text = '<?php' . "\n" . ob_get_clean();
				break;	


				case 'public/class-plugin-name-public.php': // PUBLIC/CLASS-PLUGIN-NAME-PUBLIC.PHP
				ob_start();		?>	
				
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 *
 * @package    <?php echo $input['package'] . "\n"; ?>
 * @subpackage <?php echo $input['package']; ?>/public
 * @author     <?php echo $input['plugin_author_name']; ?> <<?php echo $input['plugin_author_email']; ?>>
 */
 
namespace <?php echo $input['plugin_namespace']; ?>\Front;

class <?php echo $input['package']; ?>_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/<?php echo $input['plugin_slug']; ?>-public.css', array(), filemetime( plugin_dir_path( __FILE__ ) . 'css/<?php echo $input['plugin_slug']; ?>-public.css' ), 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/<?php echo $input['plugin_slug']; ?>-public.js', array( 'jquery' ), filemtime( plugin_dir_path( __FILE__ ) . 'js/<?php echo $input['plugin_slug']; ?>-public.js' ), false );

	}

}
				
						
				<?php $text = '<?php' . "\n" . ob_get_clean();
				break;
				
				
				
				case 'public/partials/plugin-name-public-display.php': // CASE PUBLIC/PARTIALS/PLUGIN-NAME-PUBLIC-DISPLAY.PHP
				ob_start();		?>		
				
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       <?php echo $input['plugin_url'] . "\n"; ?>
 * @since      1.0.0
 *
 * @package    <?php echo $input['package'] . "\n"; ?>
 * @subpackage <?php echo $input['package']; ?>/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
				
					
				<?php $text = '<?php' . "\n" . ob_get_clean();
				break;				
							
				
			}
		}
		
		return $text; 
		
	} // ends get_content()

}
