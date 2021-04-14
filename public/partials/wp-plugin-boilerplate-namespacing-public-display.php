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
 
 if ( isset($_POST['submit'] ) &&  ($_POST['submit'] === 'submit' )  ) {
     
    $input = array(
        'plugin_name' => !empty($_POST['plugin_name']) ? sanitize_text_field($_POST['plugin_name']) : 'Plugin Name',
        'plugin_slug' =>  !empty($_POST['plugin_slug']) ? sanitize_text_field($_POST['plugin_slug']) : 'plugin-name',
        'plugin_url' =>  !empty($_POST['plugin_url']) ? esc_url($_POST['plugin_url']) : ' http://example.com/plugin-name-uri/',
        'author_name' => !empty($_POST['author_name']) ? sanitize_text_field($_POST['author_name']) : 'Your Name',
        'author_email' => !empty($_POST['author_email']) ? sanitize_email($_POST['author_email']) : 'email@example.com',
        'author_url' => !empty($_POST['author_url']) ? esc_url($_POST['author_url']) : 'http://example.com/',
    );
     
    echo $this->download_file($input);
    
 } else {
 
?>

<h2> <?php _e('Generate Plugin Boilerplate', 'agenturallison'); ?>  </h2>

<form id="boilerplate_form_download" method="post" >
    
    <div>
    <label for="plugin_name"> <?php _e('Plugin Name', 'agenturallison'); ?> </label>
    <input name="plugin_name" />
    </div>
    
    <div>
    <label for="plugin_slug"> <?php _e('Plugin Slug', 'agenturallison'); ?> </label>
    <input name="plugin_slug" />
    </div>
    
    <div>
    <label for="plugin_url"> <?php _e('Plugin URL', 'agenturallison'); ?> </label>
    <input name="plugin_url" />
    </div>
    
    <div>
    <label for="author_name"> <?php _e('Author Name', 'agenturallison'); ?> </label>
    <input name="author_name" />
    </div>
    
    <div>
    <label for="author_email"> <?php _e('Author Email', 'agenturallison'); ?> </label>
    <input name="author_email" /> 
    </div>
    
    <div>
    <label for="author_url"> <?php _e('Author URL', 'agenturallison'); ?> </label>
    <input name="author_url" /> 
    </div>
    
    <div>
    <button id="boilerplate_generator_submit" type="submit" value="submit" name="submit"> <?php _e('Generate', 'agenturallison'); ?> </button>
    </div>
    
</form>

<?php } ?>
