<?php
// Hiển thị giá theo cấp
add_shortcode('kg_user_request_price','kg_user_request_price');
add_shortcode('ttfc_bao_gia','ttfc_bao_gia');

function kg_user_request_price(){
    ob_start();
    acf_enqueue_scripts();
    include_once KG_PATH.'includes/shortcodes/user_request_price.php';
    return ob_get_clean();
}
function ttfc_bao_gia(){
    $product_id = get_the_ID();
    $user_id = get_current_user_id();
    $price = 0;
    $level = 1;
    ob_start();
    if( $user_id ){
        $current_prices = get_field('price_level', 'user_' . $user_id);
        if($current_prices){
            foreach( $current_prices as $current_price ){
                if($current_price['product_id'] == $product_id){
                    $level = $current_price['level'];
                    break;
                }
            }
        }
        if($level){
            $product_prices = get_field('price_setting', $product_id);
            if($product_prices){
                $n_product_prices = [];
                foreach( $product_prices as $k => $product_price ){
                    $n_product_prices[$product_price['level']] = $product_price['price'];
                }
                if( isset($n_product_prices[$level]) ){
                    $price = $n_product_prices[$level];
                }
            }
        }
    }

    if($price){
        ?>
        <div class="bao-gia-nhanh">
            <div class="tieu-de">Giá: <br> <?= number_format($price); ?></div>
        </div>
        <?php
    }else{
        ?>
        <div class="bao-gia-nhanh">
            <div class="tieu-de">Báo giá nhanh</div>
            <a href="<?= get_the_permalink(235);?>" target="blank">Liên hệ ngay</a>
        </div>
        <?php
    }
    return ob_get_clean();
}