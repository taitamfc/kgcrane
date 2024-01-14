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
        $user_ids = $_REQUEST['acf']['field_648c0dad5528a'];
        $product_ids = $_REQUEST['acf']['field_648c0e095528b'];
        $level = $_REQUEST['acf']['field_648c0e86dd473'];
    
        foreach( $user_ids as $user_id ){
            $current_prices = get_field('price_level', 'user_' . $user_id);
            if( $current_prices && count($current_prices) ){
                foreach( $current_prices as $k => $current_price ){
                    $current_prices[$current_price['product_id']] = $current_price;
                    unset($current_prices[$k]);
                }
                sort($current_prices);
            }else{
                $current_prices = [];
            }
            if( $product_ids){
                foreach( $product_ids as $product_id ){
                    // Thay doi cap bac
                    if( isset($current_prices[$product_id]) ){
                        $current_prices[$product_id]['level'] = $level;
                    }else{
                        // Dua them bac vao user
                        $current_prices[$product_id] = [
                            'level' => $level,
                            'product_id' => $product_id,
                        ];
                    }
                }
                
                update_field('price_level', $current_prices, 'user_' . $user_id);
            }
        }

        $msg = 'Cập nhật thành công !';
    }

    
}

// View
$field_group = acf_get_field_group('group_648c0da3959c2');
$fields = acf_get_fields( $field_group );
?>
<div class="wrap">
    <h1 class="wp-heading-inline">Cập nhật giá</h1>
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