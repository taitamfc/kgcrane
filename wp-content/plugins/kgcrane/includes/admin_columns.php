<?php
// Hiển thị cấp giá hiện tại cho người dùng
function ttfc_add_user_price_level_column($columns) {
    $columns['cong_ty']     = 'Công ty';
    $columns['price_level'] = 'Cấp giá';
    return $columns;
}
add_filter('manage_users_columns', 'ttfc_add_user_price_level_column');
function ttfc_show_price_level_column($value, $column_name, $user_id) {
    if ($column_name === 'price_level') {
        $current_prices = get_field('price_level', 'user_' . $user_id);
        $value = $current_prices ? count($current_prices) : 0;
        $value = 'Đã cấp '.$value.' sản phẩm';
    }
    if ($column_name === 'cong_ty') {
        $user_info = get_field('user_info', 'user_' . $user_id);
        $value = $user_info ? $user_info['ten_cong_ty'] : '';
    }
    return $value;
}
add_action('manage_users_custom_column', 'ttfc_show_price_level_column', 10, 3);

// Hiển thị cấp giá hiện tại cho sản phẩm
add_filter('manage_product_posts_columns','ttfc_admin_columns_product_filter_comlums');
function ttfc_admin_columns_product_filter_comlums($comlums){
    $comlums['price_setting']       = 'Cấp giá';
    return $comlums;
}
// Hiển thị giá trị các cột ra
add_action('manage_product_posts_custom_column','ttfc_admin_columns_product_render_comlums',10,2);
function ttfc_admin_columns_product_render_comlums($column, $post_id){
    switch ($column) {
        case 'price_setting':
            $price_settings = get_field('price_setting',$post_id);
            $html = '';
            if( $price_settings ){
                foreach( $price_settings as $price_setting ){
                    $html.= 'Cấp '.$price_setting['level'].' : '.number_format($price_setting['price']).'<br>';
                }
            }
            echo $html;
            break;
    }
}

// Hiển thị các cột báo giá
add_filter('manage_pricing_posts_columns','ttfc_admin_columns_pricing_filter_comlums');
function ttfc_admin_columns_pricing_filter_comlums($comlums){
    $comlums['cong_ty']       = 'Công ty';
    $comlums['author_id']       = 'Người lập';
    $comlums['export_btn']       = 'Xuất báo giá';
    $comlums['export_count']       = 'Số lần xuất';
    return $comlums;
}
// Hiển thị giá trị các cột ra
add_action('manage_pricing_posts_custom_column','ttfc_admin_columns_pricing_render_comlums',10,2);
function ttfc_admin_columns_pricing_render_comlums($column, $post_id){
    $export_url = admin_url('admin-ajax.php').'?action=kg_export&id='.$post_id;
    switch ($column) {
        case 'author_id':
            $author_id = get_post_field( 'post_author', $post_id );
            $authord = get_the_author_meta( 'display_name', $author_id);
            echo $authord;
            break;
        case 'cong_ty':
            $thong_tin_khach_hang = get_field('thong_tin_khach_hang');
            echo $thong_tin_khach_hang['to'];
            break;
        case 'export_count':
            $export_count = get_post_meta($post_id,'export_count',true);
            echo $export_count ? $export_count : 0;
            break;
        case 'export_btn':
            echo '<a class="button button-primary" href="'. $export_url .'"> Xuất báo giá </a>';
            break;
    }
}

// Hiển thị các cột phụ tùng ra bảng
add_filter('manage_phu_tung_posts_columns','ttfc_admin_columns_phu_tung_filter_comlums');
function ttfc_admin_columns_phu_tung_filter_comlums($column, $post_id){
    $comlums['key_no']      = 'Key no';
    $comlums['part_no']     = 'Part no';
    $comlums['part_name']   = 'Part name';
    $comlums['qty']         = 'Qty';
    $comlums['remarks']     = 'Remarks';
    $comlums['price']       = 'Price';
    return $comlums;
}
// Hiển thị ra màn hình
add_action('manage_phu_tung_posts_custom_column','ttfc_admin_columns_phu_tung_render_comlums',10,2);
function ttfc_admin_columns_phu_tung_render_comlums($column, $post_id){
    switch ($column) {
        case 'key_no':
            echo get_field( 'key_no', $post_id );
            break;
        case 'part_no':
            echo get_field( 'part_no', $post_id );
            break;
        case 'part_name':
            echo get_field( 'part_name', $post_id );
            break;
        case 'qty':
            echo get_field( 'qty', $post_id );
            break;
        case 'remarks':
            echo get_field( 'remarks', $post_id );
            break;
        case 'price':
            echo get_field( 'price', $post_id );
            break;
    }
}


