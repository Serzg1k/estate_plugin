<?php 

/**
 
Plugin Name: Real estate

*/

require_once( 'libs/post-type.php' );
require_once( 'libs/scripts.php' );
require_once( 'libs/functions.php' );
require_once( 'libs/acf-init.php' );
require_once( 'libs/shortcodes.php' );

add_filter( 'template_include', 'my_plugin_templates' );
function my_plugin_templates( $template ) {
    $post_types = array( 'real_estate' );

    if ( is_post_type_archive( $post_types ) && file_exists( plugin_dir_path(__FILE__) . '/archive-real_estate.php' ) ){
        $template = plugin_dir_path(__FILE__) . '/archive-real_estate.php';
    }

    if ( is_singular( $post_types ) && file_exists( plugin_dir_path(__FILE__) . '/single-real_estate.php' ) ){
        $template = plugin_dir_path(__FILE__) . '/single-real_estate.php';
    }

    return $template;
}

