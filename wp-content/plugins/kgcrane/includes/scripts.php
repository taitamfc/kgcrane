<?php
add_action( 'admin_enqueue_scripts', 'kg_register_styles' );
add_action( 'admin_enqueue_scripts', 'kg_register_scripts' );
add_action( 'wp_enqueue_scripts', 'kg_register_scripts' );

function kg_register_styles(){
    $theme_version = '1.0';
    if (is_admin()) {
        wp_enqueue_style( 'kg-custom', KG_URI . 'admin/custom.css', null, $theme_version);
    }
}
function kg_register_scripts(){
    if (is_admin()) {
        wp_enqueue_script( 'kg-custom', KG_URI.'admin/custom.js', array('jquery'), $theme_version, true );
        wp_localize_script( 'kg-custom', 'custom_js_object',
            array( 
                'ajaxurl' => admin_url( 'admin-ajax.php' )
            )
        );
    }else{
        wp_enqueue_script( 'kg-custom', KG_URI.'public/custom.js', array('jquery'), $theme_version, true );
        wp_localize_script( 'kg-custom', 'custom_js_object',
            array( 
                'ajaxurl' => admin_url( 'admin-ajax.php' )
            )
        );
    }
}