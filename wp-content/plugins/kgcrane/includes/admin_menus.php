<?php
add_action( 'admin_menu', 'wporg_options_page' );
function wporg_options_page() {
    $parrent_slug = 'kg';
    add_menu_page(
        'Kgcrane',//tiêu đề
        'Kgcrane',
        'manage_options',
        'kg',
        'kg_admin_page_dashboard',
        'dashicons-businessman',
        20
    );

    add_submenu_page($parrent_slug,
        'Báo giá',
        'Báo giá',
        'manage_options',
        'edit.php?post_type=pricing'
    );

    add_submenu_page($parrent_slug,
        'Phụ tùng',
        'Phụ tùng',
        'manage_options',
        'edit.php?post_type=phu_tung'
    );

    add_submenu_page($parrent_slug,
        'Sản Phẩm',
        'Sản Phẩm',
        'manage_options',
        'edit.php?post_type=product'
    );

    add_submenu_page($parrent_slug,
        'Khách hàng',
        'Khách hàng',
        'manage_options',
        'users.php'
    );

    add_submenu_page($parrent_slug,
        'Cập nhật giá',
        'Cập nhật giá',
        'manage_options',
        'kg-tool',
        'kg_admin_page_tool',
    );

    add_submenu_page($parrent_slug,
        'Nhập sản phẩm',
        'Nhập sản phẩm',
        'manage_options',
        'kg-import',
        'kg_admin_page_import',
    );

    add_submenu_page($parrent_slug,
        'Nhập phụ tùng',
        'Nhập phụ tùng',
        'manage_options',
        'kg-import_phu_tung',
        'kg_admin_page_import_phu_tung',
    );

    add_submenu_page($parrent_slug,
        'Cài đặt',
        'Cài đặt',
        'manage_options',
        'kg-setting',
        'kg_admin_page_setting',
    );
    add_submenu_page($parrent_slug,
        'Xử lý xuất báo giá',
        'Xử lý xuất báo giá',
        'manage_options',
        'kg-export_price',
        'kg_admin_page_export_price',
    );
}

function kg_admin_page_dashboard(){
    include_once KG_PATH.'includes/admin_pages/dashboard.php';
}
function kg_admin_page_import(){
    include_once KG_PATH.'includes/admin_pages/import.php';
}
function kg_admin_page_import_phu_tung(){
    include_once KG_PATH.'includes/admin_pages/import_phu_tung.php';
}

function kg_admin_page_tool(){
    acf_enqueue_scripts();
    include_once KG_PATH.'includes/admin_pages/tool.php';
}
function kg_admin_page_setting(){
    acf_enqueue_scripts();
    include_once KG_PATH.'includes/admin_pages/setting.php';
}
function kg_admin_page_export_price(){
    include_once KG_PATH.'includes/admin_pages/export_price.php';
}