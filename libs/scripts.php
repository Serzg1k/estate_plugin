<?php

add_action( 'wp_enqueue_scripts', 'estate_scripts_method' );
function estate_scripts_method(){
    $script_url = plugins_url( '/js/estate.js', dirname(__FILE__));
    wp_enqueue_script( 'jquery-js', 'https://code.jquery.com/jquery-3.4.1.min.js');
    wp_enqueue_style('bootstrap4.css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_script( 'estate-js', $script_url, 'jquery-js');
    wp_localize_script('estate-js', 'estateObj', ['ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce("estate-nonce")]);
}