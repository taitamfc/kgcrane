<?php
// Controller
$acf_errors = [];
$msg = '';
if( count( $_POST ) ){
    $validated = acf_validate_save_post();
    if(!$validated){
        $acf_errors = acf_get_validation_errors();
    }
    if( count($acf_errors) == 0 ){
        
        $ten_cong_ty = $_REQUEST['acf']['field_649e6eb0222a0'];
        $dia_chi = $_REQUEST['acf']['field_649e6ec3222a1'];
        $so_dien_thoai = $_REQUEST['acf']['field_649e6ed2222a2'];
        $so_fax = $_REQUEST['acf']['field_649e6ee5222a3'];
        $email = $_REQUEST['acf']['field_649e6ef3222a4'];
        $giam_doc = $_REQUEST['acf']['field_649e6eff222a5'];
        $di_dong = $_REQUEST['acf']['field_649e6f0f222a6'];

        $company_info = [
            'ten_cong_ty' => $ten_cong_ty,
            'dia_chi' => $dia_chi,
            'so_dien_thoai' => $so_dien_thoai,
            'so_fax' => $so_fax,
            'email' => $email,
            'giam_doc' => $giam_doc,
            'di_dong' => $di_dong
        ];
        update_option('company_info',$company_info);

        $msg = 'Cập nhật thành công !';
    }

    
}

// View
$field_group = acf_get_field_group('group_649e6e9463f67');
$fields = acf_get_fields( $field_group );
$company_info = get_option('company_info');
foreach( $fields as $k => $field ){
    $key = $fields[$k]['key'];
    switch ($key) {
        case 'field_649e6eb0222a0':
            $fields[$k]['value'] = $company_info['ten_cong_ty'];
            break;
        case 'field_649e6ec3222a1':
            $fields[$k]['value'] = $company_info['dia_chi'];
            break;
        case 'field_649e6ed2222a2':
            $fields[$k]['value'] = $company_info['so_dien_thoai'];
            break;
        case 'field_649e6ee5222a3':
            $fields[$k]['value'] = $company_info['so_fax'];
            break;
        case 'field_649e6ef3222a4':
            $fields[$k]['value'] = $company_info['email'];
            break;
        case 'field_649e6eff222a5':
            $fields[$k]['value'] = $company_info['giam_doc'];
            break;
        case 'field_649e6f0f222a6':
            $fields[$k]['value'] = $company_info['di_dong'];
            break;
        default:
            # code...
            break;
    }
    
}
?>
<div class="wrap">
    <h1 class="wp-heading-inline">Cài đặt thông tin cửa hàng</h1>
    <hr class="wp-header-end">
    <?php if( count($acf_errors) ): ?>
        <div id="message" class="notice notice-error">
            <ul>
                <?php foreach( $acf_errors as $acf_error ):?>
                <li style="color:red;"><?= $acf_error['message'];?></li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if( $msg ): ?>
    <div id="message" class="notice notice-success">
        <p><?= $msg;?></p>
    </div>
    <?php endif; ?>

    <form class="acf-form" action="" method="POST">
        <?php 
            acf_render_fields( $fields, $args['post_id'], 'div', $field_group['instruction_placement'] );
        ?>
        <div class="acf-form-submit">
            <input type="submit" name="kg_submit_tool" class="acf-button button button-primary button-large" value="Cập nhật" />
            <span class="acf-spinner"></span>
        </div>
    </form>
</div>