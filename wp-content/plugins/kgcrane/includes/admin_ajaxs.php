<?php
include_once KG_PATH.'includes/lib/vendor/autoload.php';
add_action("wp_ajax_kg_check_mst", "kg_check_mst");
add_action("wp_ajax_nopriv_kg_check_mst", "kg_check_mst");

add_action("wp_ajax_kg_get_user", "kg_get_user");
add_action("wp_ajax_nopriv_kg_get_user", "kg_get_user");

add_action("wp_ajax_kg_get_product_by_sku", "kg_get_product_by_sku");
add_action("wp_ajax_nopriv_kg_get_product_by_sku", "kg_get_product_by_sku");

add_action("wp_ajax_kg_get_product_by_id", "kg_get_product_by_id");
add_action("wp_ajax_nopriv_kg_get_product_by_id", "kg_get_product_by_id");

add_action("wp_ajax_kg_export", "kg_export");
add_action("wp_ajax_nopriv_kg_export", "kg_export");

add_action("wp_ajax_kg_export_detail", "kg_export_detail");
add_action("wp_ajax_nopriv_kg_export_detail", "kg_export_detail");

function kg_export_detail(){
    include_once KG_PATH.'includes/classes/KGExport.php';
    $id = $_REQUEST['price_id'];
    $file_name = $_REQUEST['file_name'];
    $key = $_REQUEST['key'];
    $step = $_REQUEST['step'];
    $data = $_REQUEST['data'];
    $templateFile = KG_PATH.'tmp/'.$file_name;
    switch ($step) {
        case 'get_html_table':
            KGExport::get_html_table($id,$key,$file_name);
        case 'export_price_detail':
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load($templateFile);
            $spreadsheet = KGExport::export_price_detail($spreadsheet,$data,$id,$key);
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
            $writer->save(KG_PATH.'tmp/'.$file_name);
            echo json_encode([
                'key' => $key + 1,
                'step' => 'get_html_table',
            ]);
            die();
            break;
    }
    
}
function kg_export(){
    include_once KG_PATH.'includes/classes/KGExport.php';
    $id = $_REQUEST['id'];
    $export_count = get_post_meta($id,'export_count',true);
    update_post_meta($id,'export_count',(int)$export_count + 1);
    $templateFile = KG_PATH.'includes/export_templates/baogia.xlsx';

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load($templateFile);

    $spreadsheet = KGExport::exportPrice($spreadsheet,$id);
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    $file_name = $id.'-price-'.time().'.xlsx';
    $saved = $writer->save(KG_PATH.'tmp/'.$file_name);
    if( file_exists(KG_PATH.'tmp/'.$file_name) ){
        wp_redirect('admin.php?page=kg-export_price&price_id='.$id.'&file_name='.$file_name);
    }
    die();
}

function kg_get_product_by_sku(){
    $sku = $_REQUEST['sku'];
    $product_id = wc_get_product_id_by_sku( $sku );
    $product = wc_get_product( $product_id );
    $product_prices = get_field('price_setting',$product_id);
    $p_prices_values = [];
    $p_prices_labels = [];
    foreach( $product_prices as $k => $product_price ){
        $p_prices_values[$product_price['level']] = $product_price['price'];
        $p_prices_labels[$product_price['level']] = number_format($product_price['price']);
    }

    $mo_ta = $product->get_short_description();
    $mo_tas = explode("\n",$mo_ta);
    foreach( $mo_tas as $k => $v ){
        $v = trim($v);
        if(!$v || strpos($v, '&nb') !== false){
            unset($mo_tas[$k]);
        }
    }
    $mo_ta = implode("\n",$mo_tas);

    $data = [
        'ten_goi' => $product->get_name(),
        'xuat_xu' => '',
        'p_prices_values' => $p_prices_values,
        'p_prices_labels' => $p_prices_labels,
        'mo_ta' => $mo_ta,
        'product_id' => $product_id,
    ];
    echo json_encode($data);
    die();
}
function kg_get_product_by_id(){
    $product_id = $_REQUEST['product_id'];
    $product = wc_get_product( $product_id );
    $product_prices = get_field('price_setting',$product_id);
    $p_prices_values = [];
    $p_prices_labels = [];
    foreach( $product_prices as $k => $product_price ){
        $p_prices_values[$product_price['level']] = $product_price['price'];
        $p_prices_labels[$product_price['level']] = number_format($product_price['price']);
    }

    $mo_ta = $product->get_short_description();
    $mo_tas = explode("\n",$mo_ta);
    foreach( $mo_tas as $k => $v ){
        $v = trim($v);
        if(!$v || strpos($v, '&nb') !== false){
            unset($mo_tas[$k]);
        }
    }
    $mo_ta = implode("\n",$mo_tas);
    $mo_ta = strip_tags($mo_ta);

    $data = [
        'ten_goi' => $product->get_name(),
        'ma_hieu' => $product->get_sku(),
        'xuat_xu' => '',
        'p_prices_values' => $p_prices_values,
        'p_prices_labels' => $p_prices_labels,
        'mo_ta' => $mo_ta,
        'product_id' => $product_id,
    ];
    echo json_encode($data);
    die();
}
function kg_get_user(){
    $user_id = $_REQUEST['user_id'];
    $user_wp = get_user_by('id', $user_id);
    $user_info = get_field('user_info','user_'.$user_id);

    $data = [
        'ten_cong_ty' => $user_info['ten_cong_ty']  ? $user_info['ten_cong_ty'] : $user_wp->display_name,
        'dia_chi_cong_ty' => $user_info['dia_chi_cong_ty'],
        'dai_dien_cong_ty' => $user_info['dai_dien_cong_ty'],
        'chuc_vu_cong_ty' => $user_info['chuc_vu_cong_ty'],
        'phone' => $user_info['phone'],
        'email' => $user_info['email'] ? $user_info['email'] : $user_wp->user_email,
        'mobile' => $user_info['mobile'],
        'fax' => $user_info['fax'],
        'about' => 'Báo giá',
        'user_wp' => $user_wp,
    ];

    echo json_encode($data);
    die();
}
function kg_check_mst(){
    $mst = $_REQUEST['mst'];
    include_once KG_PATH.'includes/lib/simple_html_dom.php';

    $html = file_get_html('https://tracuumst.com/tim-kiem?q='.$mst.'&s=tax');
    $data = [];
    $data['title'] = $html->find('.card-header a',0)->innertext;
    $data['link'] = $html->find('.card-header a',0)->getAttribute('href');
    $data['user_name'] = $html->find('.card-text a',0)->innertext;
    $data['address'] = strip_tags($html->find('.card-body p',2)->innertext);

    echo json_encode($data);
    die();
}