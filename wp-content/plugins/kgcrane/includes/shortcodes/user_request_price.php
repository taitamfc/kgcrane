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
        // dd($_REQUEST);

        $company = $_REQUEST['acf']['field_649e8ce809f8c']['field_649e8ce815329'];
        $post_id = wp_insert_post([
            'post_author' => get_current_user_id(),
            'post_title' => '[Khách hàng] '.$company,
            'post_type' => 'pricing',
            'post_status' => 'draft'
        ]);

        update_field('field_649e8ce809f8c',$_REQUEST['acf']['field_649e8ce809f8c'],$post_id);
        update_field('field_649e8ce80da13',$_REQUEST['acf']['field_649e8ce80da13'],$post_id);

        $msg = 'Tạo báo giá thành công !';
    }

    
}

// View
$field_group = acf_get_field_group('group_649e8ce7ef3db');
$fields = acf_get_fields( $field_group );
?>
<style>
    .tim_sku {
    cursor: pointer;
}
</style>
<div class="wrap">
    <!-- <h1 class="wp-heading-inline">Tạo báo giá</h1> -->
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
    <?php else: ?>

    <form class="acf-form" action="" method="POST">
        <?php 
            acf_render_fields( $fields, $args['post_id'], 'div', $field_group['instruction_placement'] );
        ?>
        <div class="acf-form-submit">
            <input type="submit" name="kg_submit_tool" class="acf-button button button-primary button-large" value="Cập nhật" />
            <span class="acf-spinner"></span>
        </div>
    </form>

    <?php endif; ?>
</div>


<script>
    
</script>