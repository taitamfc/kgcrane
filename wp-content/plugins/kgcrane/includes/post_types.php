<?php
// Register custom post type
add_action('init','noktali_custom_post_type');
function noktali_custom_post_type(){
    $post_types = [
        'pricing' => 'Báo giá'
    ];
    foreach( $post_types as $post_name => $post_label ){
        $args = array(
            'labels'      => array(
                'name'          => __('All '.$post_label, 'noktali-virgul'),
                'singular_name' => __($post_label, 'noktali-virgul'),
            ),
            'public'      => false,
            'has_archive' => false,
            'show_ui'      => true,
			'show_in_menu' => false,
            'rewrite'     => array( 'slug' => strtolower($post_name) ),
            'supports' => array( 'title'),
        );
        register_post_type($post_name,$args);
    }
    
}
