const formatter = new Intl.NumberFormat('vi-VN', {
    style: 'decimal',
    useGrouping: true,
});

var admin_ajax = custom_js_object.ajaxurl;
jQuery(document).ready( function(){
    // User form
    var btn = jQuery('#acf-field_648f036c0a4b6-field_648f072c63d93-tim');
    btn.on('click',function(){
        const mst = jQuery('#acf-field_648f036c0a4b6-field_648f0599346d5');
        const mst_val = jQuery(mst[0]).val();
        let options = {
            url: admin_ajax+'?action=kg_check_mst&mst='+mst_val,
            method: 'GET',
            dataType:'json',
            success: function(res){
                jQuery('#acf-field_648f036c0a4b6-field_648f05bc346d6').val(res.title);
                jQuery('#acf-field_648f036c0a4b6-field_648f05cb346d7').val(res.address);
                jQuery('#acf-field_648f036c0a4b6-field_648f05e2346d8').val(res.user_name);
            }
        }
        jQuery.ajax( options );
    })
    // Bao gia form khach hang
    jQuery('#acf-field_6490295076487-field_649029b920605').on('change',function(){
        const user_id = jQuery(this).val();
        let options = {
            url: admin_ajax+'?action=kg_get_user&user_id='+user_id,
            method: 'GET',
            dataType:'json',
            success: function(res){
                jQuery('#acf-field_6490295076487-field_64902ae40bce9').val(res.ten_cong_ty)
                jQuery('#acf-field_6490295076487-field_64902b3b0bceb').val(res.dia_chi_cong_ty)
                jQuery('#acf-field_6490295076487-field_64902b280bcea').val(res.dai_dien_cong_ty)
                jQuery('#acf-field_6490295076487-field_64902b410bcec').val(res.mobile)
                jQuery('#acf-field_6490295076487-field_64902b4a0bced').val(res.fax)
                jQuery('#acf-field_6490295076487-field_64902b7d0bcee').val(res.email)
                jQuery('#acf-field_6490295076487-field_64902b8a0bcef').val(res.about)
            }
        }
        jQuery.ajax( options );
    });
    // Bao gia form san pham
    jQuery('body').on('click','.tim_sku',function(){
        const sku = jQuery(this).closest('div[data-name="ma_hieu"]').find('input').val();
        let parentElm = jQuery(this).closest('.acf-row');
        let options = {
            url: admin_ajax+'?action=kg_get_product_by_sku&sku='+sku,
            method: 'GET',
            dataType:'json',
            success: function(res){
                parentElm.find('div[data-name="product_id"] input').val(res.product_id);
                parentElm.find('div[data-name="ten_sp"] input').val(res.ten_goi);
                parentElm.find('div[data-name="mo_ta"] textarea').val(res.mo_ta);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_ban').attr('data-price',res.p_prices_values[1]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_giam').attr('data-price',res.p_prices_values[2]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_dai_ly').attr('data-price',res.p_prices_values[3]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_ban').text(res.p_prices_labels[1]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_giam').text(res.p_prices_labels[2]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_dai_ly').text(res.p_prices_labels[3]);

                let acfClone = jQuery('.acf-clone');
                acfClone.find('div[data-name="product_id"] input').val('')
                acfClone.find('div[data-name="ten_sp"] input').val('')
                acfClone.find('div[data-name="mo_ta"] textarea').val('')
                acfClone.find('div[data-name="gia_tham_khao"] .gia_ban').removeAttr('data-price');
                acfClone.find('div[data-name="gia_tham_khao"] .gia_giam').removeAttr('data-price');
                acfClone.find('div[data-name="gia_tham_khao"] .gia_dai_ly').removeAttr('data-price');
                acfClone.find('div[data-name="gia_tham_khao"] .gia_ban').text(0);
                acfClone.find('div[data-name="gia_tham_khao"] .gia_giam').text(0);
                acfClone.find('div[data-name="gia_tham_khao"] .gia_dai_ly').text(0);
            }
        }
        jQuery.ajax( options );
    });
    // Khi id sản phẩm thay đổi
    jQuery('body').on('change','div[data-name="product_id"] select',function(){
        let product_id = jQuery(this).val();
        let parentElm = jQuery(this).closest('.acf-row');
        let options = {
            url: admin_ajax+'?action=kg_get_product_by_id&product_id='+product_id,
            method: 'GET',
            dataType:'json',
            success: function(res){
                parentElm.find('div[data-name="ma_hieu"] input').val(res.ma_hieu);
                parentElm.find('div[data-name="ten_sp"] input').val(res.ten_goi);
                parentElm.find('div[data-name="mo_ta"] textarea').val(res.mo_ta);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_ban').attr('data-price',res.p_prices_values[1]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_giam').attr('data-price',res.p_prices_values[2]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_dai_ly').attr('data-price',res.p_prices_values[3]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_ban').text(res.p_prices_labels[1]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_giam').text(res.p_prices_labels[2]);
                parentElm.find('div[data-name="gia_tham_khao"] .gia_dai_ly').text(res.p_prices_labels[3]);

                let acfClone = jQuery('.acf-clone');
                acfClone.find('div[data-name="product_id"] input').val('')
                acfClone.find('div[data-name="ten_sp"] input').val('')
                acfClone.find('div[data-name="mo_ta"] textarea').val('')
                acfClone.find('div[data-name="gia_tham_khao"] .gia_ban').removeAttr('data-price');
                acfClone.find('div[data-name="gia_tham_khao"] .gia_giam').removeAttr('data-price');
                acfClone.find('div[data-name="gia_tham_khao"] .gia_dai_ly').removeAttr('data-price');
                acfClone.find('div[data-name="gia_tham_khao"] .gia_ban').text(0);
                acfClone.find('div[data-name="gia_tham_khao"] .gia_giam').text(0);
                acfClone.find('div[data-name="gia_tham_khao"] .gia_dai_ly').text(0);
            }
        }
        jQuery.ajax( options );
    })
    // Khi số lượng thay đổi
    jQuery('body').on('change','div[data-name="sl"] input',function(){
        let sl = jQuery(this).closest('.acf-fields').find('div[data-name="sl"] input');
        let don_gia = jQuery(this).closest('.acf-fields').find('div[data-name="don_gia"] input');
        let tong_gia = jQuery(this).closest('.acf-fields').find('div[data-name="tong_gia"] input');
        
        price_value = don_gia.val().replace(/\,/g, '')
        let sub_total = sl.val() * price_value;
        tong_gia.val( formatter.format(sub_total).replace(/\./g, ',') );
    });
    // Khi giá tham khảo thay đổi
    jQuery('body').on('click','div[data-name="gia_tham_khao"] .acf-input label',function(){
        let parentElm = jQuery(this).closest('.acf-row');
        let price_format = jQuery(this).find('span').text();
        let price_value = jQuery(this).find('span').data('price');
        let sl = parentElm.find('div[data-name="sl"] input');
        let tong_gia = parentElm.find('div[data-name="tong_gia"] input');
        let don_gia = parentElm.find('div[data-name="don_gia"] input');
        let sub_total = sl.val() * price_value;
        don_gia.val(price_format);
        tong_gia.val( formatter.format(sub_total).replace(/\./g, ',') );
    })

    // Khi tài liệu được tải lên, load giá tham khảo
    if(jQuery('body.post-type-pricing').length){
        let priceElms = jQuery('div[data-name="gia_tham_khao"]');
        priceElms.each( function(key,val){
            let parentElm = jQuery(val).closest('.acf-row');
            let product_id = parentElm.find('div[data-name="product_id"] select').val();
            let options = {
                url: admin_ajax+'?action=kg_get_product_by_id&product_id='+product_id,
                method: 'GET',
                dataType:'json',
                success: function(res){
                    parentElm.find('div[data-name="gia_tham_khao"] .gia_ban').attr('data-price',res.p_prices_values[1]);
                    parentElm.find('div[data-name="gia_tham_khao"] .gia_giam').attr('data-price',res.p_prices_values[2]);
                    parentElm.find('div[data-name="gia_tham_khao"] .gia_dai_ly').attr('data-price',res.p_prices_values[3]);
                    parentElm.find('div[data-name="gia_tham_khao"] .gia_ban').text(res.p_prices_labels[1]);
                    parentElm.find('div[data-name="gia_tham_khao"] .gia_giam').text(res.p_prices_labels[2]);
                    parentElm.find('div[data-name="gia_tham_khao"] .gia_dai_ly').text(res.p_prices_labels[3]);
                }
            }
            if(product_id){
                jQuery.ajax( options );
            }

            let acfClone = jQuery('.acf-clone');
            acfClone.find('div[data-name="product_id"] input').val('')
            acfClone.find('div[data-name="ten_sp"] input').val('')
            acfClone.find('div[data-name="mo_ta"] textarea').val('')
            acfClone.find('div[data-name="gia_tham_khao"] .gia_ban').removeAttr('data-price');
            acfClone.find('div[data-name="gia_tham_khao"] .gia_giam').removeAttr('data-price');
            acfClone.find('div[data-name="gia_tham_khao"] .gia_dai_ly').removeAttr('data-price');
            acfClone.find('div[data-name="gia_tham_khao"] .gia_ban').text(0);
            acfClone.find('div[data-name="gia_tham_khao"] .gia_giam').text(0);
            acfClone.find('div[data-name="gia_tham_khao"] .gia_dai_ly').text(0);
        })
    }
});