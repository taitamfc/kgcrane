const formatter = new Intl.NumberFormat('vi-VN', {
    style: 'decimal',
    useGrouping: true,
});

var admin_ajax = custom_js_object.ajaxurl;
console.log(admin_ajax);
jQuery(document).ready( function(){
    // User form
    // var btn = jQuery('#acf-field_648f036c0a4b6-field_648f072c63d93-tim');
    // btn.on('click',function(){
    //     const mst = jQuery('#acf-field_648f036c0a4b6-field_648f0599346d5');
    //     const mst_val = jQuery(mst[0]).val();
    //     let options = {
    //         url: admin_ajax+'?action=kg_check_mst&mst='+mst_val,
    //         method: 'GET',
    //         dataType:'json',
    //         success: function(res){
    //             jQuery('#acf-field_648f036c0a4b6-field_648f05bc346d6').val(res.title);
    //             jQuery('#acf-field_648f036c0a4b6-field_648f05cb346d7').val(res.address);
    //             jQuery('#acf-field_648f036c0a4b6-field_648f05e2346d8').val(res.user_name);
    //         }
    //     }
    //     jQuery.ajax( options );
    // })
    // Bao gia form khach hang
    // jQuery('#acf-field_6490295076487-field_649029b920605').on('change',function(){
    //     const user_id = jQuery(this).val();
    //     let options = {
    //         url: admin_ajax+'?action=kg_get_user&user_id='+user_id,
    //         method: 'GET',
    //         dataType:'json',
    //         success: function(res){
    //             jQuery('#acf-field_6490295076487-field_64902ae40bce9').val(res.ten_cong_ty)
    //             jQuery('#acf-field_6490295076487-field_64902b3b0bceb').val(res.dia_chi_cong_ty)
    //             jQuery('#acf-field_6490295076487-field_64902b280bcea').val(res.dai_dien_cong_ty)
    //             jQuery('#acf-field_6490295076487-field_64902b410bcec').val(res.mobile)
    //             jQuery('#acf-field_6490295076487-field_64902b4a0bced').val(res.fax)
    //             jQuery('#acf-field_6490295076487-field_64902b7d0bcee').val(res.email)
    //             jQuery('#acf-field_6490295076487-field_64902b8a0bcef').val(res.about)
    //         }
    //     }
    //     jQuery.ajax( options );
    // });
    // Bao gia form san pham
    jQuery('body').on('click','.tim_sku',function(){
        const sku = jQuery(this).closest('div[data-name="ma_hieu"]').find('input').val();
        let parentElm = jQuery(this).closest('.acf-fields');
        let options = {
            url: admin_ajax+'?action=kg_get_product_by_sku&sku='+sku,
            method: 'GET',
            dataType:'json',
            success: function(res){
                parentElm.find('div[data-name="ten_sp"] input').val(res.ten_goi);
                parentElm.find('div[data-name="mo_ta"] textarea').val(res.mo_ta);
                parentElm.find('div[data-name="don_gia"] input').attr('data-price',res.p_prices_values[1]);
                parentElm.find('div[data-name="don_gia"] input').val(res.p_prices_labels[1]);

                let acfClone = jQuery('.acf-clone');
                acfClone.find('div[data-name="ten_sp"] input').val('')
                acfClone.find('div[data-name="mo_ta"] textarea').val('')

                jQuery('div[data-name="sl"] input').trigger('change');
                
            }
        }
        jQuery.ajax( options );
    })

    jQuery('body').on('change','div[data-name="sl"] input',function(){
        let sl = jQuery(this).closest('.acf-fields').find('div[data-name="sl"] input');
        let don_gia = jQuery(this).closest('.acf-fields').find('div[data-name="don_gia"] input');
        let tong_gia = jQuery(this).closest('.acf-fields').find('div[data-name="tong_gia"] input');
        
        price_value = don_gia.val().replace(/\,/g, '')
        let sub_total = sl.val() * price_value;
        tong_gia.val( formatter.format(sub_total).replace(/\./g, ',') );
    });
});