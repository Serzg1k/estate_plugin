<?php

class WP_Widget_Estate extends WP_Widget {

    public function __construct() {
        $widget_ops  = array(
            'classname'                   => 'widget_estate',
            'description'                 => __( 'Widget Estate' ),
            'customize_selective_refresh' => true,
        );
        $control_ops = array(
            'width'  => 200,
            'height' => 200,
        );
        parent::__construct( 'text', __( 'Widget Estate' ), $widget_ops, $control_ops );
    }

    public function widget($args, $instance)
    {
        echo do_shortcode("[real_estate]");
    }
}

function estate_load_widget() {
    register_widget( 'WP_Widget_Estate' );
}
add_action( 'widgets_init', 'estate_load_widget' );