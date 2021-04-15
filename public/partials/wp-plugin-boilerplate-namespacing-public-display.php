<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://agentur-allison.at
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Boilerplate_Namespacing
 * @subpackage Wp_Plugin_Boilerplate_Namespacing/public/partials
 */
 
 echo print_r($_POST, true);
 
 if ( isset($_POST['submit'] ) &&  ($_POST['submit'] === 'submit' )  ) {
     
    $input = array(
        'plugin_name' => !empty($_POST['plugin_name']) ? sanitize_text_field($_POST['plugin_name']) : 'Plugin Name',
        'plugin_slug' =>  !empty($_POST['plugin_slug']) ? sanitize_text_field($_POST['plugin_slug']) : 'plugin-name',
        'plugin_url' =>  !empty($_POST['plugin_url']) ? esc_url($_POST['plugin_url']) : 'http://example.com/plugin-name-uri/',
        'plugin_namespace' =>  !empty($_POST['plugin_namespace']) ? sanitize_text_field($_POST['plugin_namespace']) : 'PluginNamespace',
        'plugin_author_name' => !empty($_POST['plugin_author_name']) ? sanitize_text_field($_POST['plugin_author_name']) : 'Your Name',
        'plugin_author_email' => !empty($_POST['plugin_author_email']) ? sanitize_email($_POST['plugin_author_email']) : 'email@example.com',
        'plugin_author_url' => !empty($_POST['plugin_author_url']) ? esc_url($_POST['plugin_author_url']) : 'http://example.com/',
    );
     
    echo $this->download_file($input);
    
 } else {
 
?>

<h2> <?php _e('Generate Plugin Boilerplate', 'agenturallison'); ?>  </h2>

<form id="boilerplate_form_download" method="post" >
    
    <div>
    <label for="plugin_name"> <?php _e('Plugin Name', 'agenturallison'); ?> </label>
    <input name="plugin_name" />
    <p> <?php _e('The plugin name', 'agenturallison'); ?>  </p>
    </div>
    
    <div>
    <label for="plugin_slug"> <?php _e('Plugin Slug', 'agenturallison'); ?> </label>
    <input name="plugin_slug" />
    <p> <?php _e('The plugin slug. All lower case. Use hyphens between words. No spaces. Eg "plugin-slug".', 'agenturallison'); ?>  </p>
    </div>
    
    <div>
    <label for="plugin_url"> <?php _e('Plugin URL', 'agenturallison'); ?> </label>
    <input name="plugin_url" />
    <p> <?php _e('The full plugin URL eg https://example.com/plugin-name-uri/.', 'agenturallison'); ?>  </p>
    </div>
    
    <div>
    <label for="plugin_url"> <?php _e('Plugin Namespace', 'agenturallison'); ?> </label>
    <input name="plugin_namespace" />
    <p> <?php _e('The namespace used by your plugin. For help see <a href="https://www.php.net/manual/en/language.namespaces.php">PHP Manual: Namespaces</a>. Suggested format is YourName\Plugin. Use backward slashes. No trailing slash.', 'agenturallison'); ?>  </p>
    </div>    
    
    <div>
    <label for="plugin_author_name"> <?php _e('Author Name', 'agenturallison'); ?> </label>
    <input name="plugin_author_name" />
    <p> <?php _e('The author or company name.', 'agenturallison'); ?>  </p>
    </div>
    
    <div>
    <label for="plugin_author_email"> <?php _e('Author Email', 'agenturallison'); ?> </label>
    <input name="plugin_author_email" /> 
    <p> <?php _e('The author or company email.', 'agenturallison'); ?>  </p>
    </div>
    
    <div>
    <label for="plugin_author_url"> <?php _e('Author URL', 'agenturallison'); ?> </label>
    <input name="plugin_author_url" /> 
    <p> <?php _e('The full author URL eg https://example.com/.', 'agenturallison'); ?>  </p>
    </div>
    
    <div>
    <button id="boilerplate_generator_submit" type="submit" value="submit" name="submit"> <?php _e('Generate', 'agenturallison'); ?> </button>
    </div>
    
</form>

<?php } ?>
