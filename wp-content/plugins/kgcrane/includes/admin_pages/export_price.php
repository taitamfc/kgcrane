<?php
$price_id = isset($_REQUEST['price_id']) ? $_REQUEST['price_id'] : 0;
$file_name = isset($_REQUEST['file_name']) ? $_REQUEST['file_name'] : 0;
if(!$price_id){
    wp_redirect('edit.php?post_type=pricing');
    exit;
}
 // Thông tin công ty
 $company_info = get_option('company_info');
//  $execl->setCellValue('X4', $company_info['ten_cong_ty']);
//  $execl->setCellValue('X5', $company_info['dia_chi']);
//  $execl->setCellValue('X6', $company_info['so_dien_thoai']);
//  $execl->setCellValue('X7', $company_info['so_fax']);
//  $execl->setCellValue('X8', $company_info['email']);
//  $execl->setCellValue('X9', $company_info['giam_doc']);
//  $execl->setCellValue('X10', $company_info['di_dong']);

 // Thông tin khách hàng
 $customer_info = get_field('thong_tin_khach_hang',$price_id);
//  $execl->setCellValue('E4', $customer_info['to']);
//  $execl->setCellValue('E5', $customer_info['attn']);
//  $execl->setCellValue('E6', $customer_info['add']);
//  $execl->setCellValue('E7', $customer_info['fax']);
//  $execl->setCellValue('E8', $customer_info['email']);
//  $execl->setCellValue('E9', $customer_info['about']);
//  $execl->setCellValue('E10', $customer_info['mobile']);
?>
<style>
div#table_html table {
    width: 60%;
}

div#table_html table td {
    border: 1px solid #ccc;
    padding: 5px;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
<p id="status_export">Đang xử lý xuất báo giá chi tiết</p>
<div id="table_html_wrapper">
    <table id="table_header" border="1" width="1000px">
        <tr>
            <td rowspan="2">  </td>
            <td rowspan="2" colspan="2">BẢNG CHÀO GIÁ CHI TIẾT</td>
            <td rowspan="2"> </td>
        </tr>
        <tr></tr>
        <tr>
            <td>Số</td>
            <td colspan="3">Ngày <?= date('d'); ?> tháng <?= date('m'); ?> năm <?= date('Y'); ?></td>
        </tr>
        <tr>
            <td>To</td>
            <td><?= $customer_info['to']; ?></td>
            <td>From</td>
            <td><?= $company_info['ten_cong_ty']; ?></td>
        </tr>
        <tr>
            <td>Add</td>
            <td><?= $customer_info['add']; ?></td>
            <td>Add</td>
            <td><?= $company_info['dia_chi']; ?></td>
        </tr>
        <tr>
            <td>Tell</td>
            <td><?= $customer_info['mobile']; ?></td>
            <td>Tell</td>
            <td><?= $company_info['so_dien_thoai']; ?></td>
        </tr>
        <tr>
            <td>Fax</td>
            <td><?= $customer_info['fax']; ?></td>
            <td>Fax</td>
            <td><?= $company_info['so_fax']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= $customer_info['email']; ?></td>
            <td>Email</td>
            <td>thinh@kgcrane.com.vn</td>
        </tr>
        <tr>
            <td>Attn</td>
            <td>GD</td>
            <td>Mobile</td>
            <td>024-39-125-125</td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>-</td>
            <td>Contact</td>
            <td>0912-185-779</td>
        </tr>
        <tr>
            <td>Kính gửi</td>
            <td colspan="3">Quý công ty</td>
        </tr>
        <tr>
            <td colspan="4">Chúng tôi trân trọng gửi tới Quý Công ty bản chào giá cho thiết bị cầu trục, chi tiết như
                sau:
            </td>
        </tr>
        <tr>
            <td colspan="4"></td>
        </tr>
    </table>
    <div id="table_html"></div>
    <table id="table_footer" border="1" width="1000px">
        <tr>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="2">PHƯƠNG THỨC GIAO NHẬN, THANH TOÁN</td>
            <td>Đơn giá</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan="2">1. Địa điểm giao hàng: Tại Kho bên bán</td>
            <td>Thuế VAT (10%)</td>
            <td>0</td>
        </tr>
        <tr>
            <td colspan="2">2. Địa điểm giao hàng: Tại Kho bên bán</td>
            <td>Thuế VAT (10%)</td>
            <td>0</td>
        </tr>
        <tr>
            <td colspan="2">3. Hiệu lực báo giá: 07 ngày kể từ ngày phát hành</td>
            <td>Thành tiền</td>
            <td>0</td>
        </tr>
        <tr>
            <td colspan="2">Thanh toán 100% trước khi giao hàng.</td>
            <td colspan="2">Bằng chữ: </td>
        </tr>
        <tr>
            <td colspan="2">Rất mong nhận được sự hợp tác của Quý khách hàng</td>
            <td colspan="2">CÔNG TY CỔ PHẦN THIẾT BỊ DINHNGUYEN</td>
        </tr>
        <tr>
            <td colspan="2">XÁC NHẬN BÊN MUA</td>
            <td colspan="2"></td>
        </tr>
    </table>
</div>
<script>
var admin_ajax = "<?= admin_url( 'admin-ajax.php' )?>";
jQuery(document).ready(function() {
    get_html_table(0)
    
    function get_html_table(index) {
        let options = {
            url: admin_ajax,
            method: 'POST',
            data: {
                action: 'kg_export_detail',
                key: index,
                price_id: '<?= $price_id; ?>',
                file_name: '<?= $file_name; ?>',
                step: 'get_html_table',
            },
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    jQuery('#table_html').html(res.table_html);
                    var table = jQuery('#table_html table');
                    table.prepend(jQuery('#table_header tbody').html());
                    table.append( jQuery('#table_footer tbody').html()) ;

                    jQuery('#table_header').hide();
                    jQuery('#table_footer').hide();
                    jQuery('#table_html table').html(table.html());
                    // jQuery('#table_html table').hide();

                    var table = document.getElementsByTagName('table')[1];
                    var json = XLSX.utils.table_to_sheet(table);
                    export_price_detail(json, res.key)
                } else {
                    if (res.link_file) {
                        jQuery('#status_export').remove();
                        jQuery('#table_html').html(`
                                <p>Quá trình xuất báo giá đã hoàn thành !</p>
                                <p><a class="button button-secondary" href="edit.php?post_type=pricing">Nhấn vào đây để trở lại</a></p>
                                <p><a class="button button-primary" href="${res.link_file}">Nhấn vào đây để tải file</a></p>
                            `);
                        setTimeout(() => {
                            alert('Xuất báo giá thành công. Nhấn OK để tải file');
                            window.location.href = res.link_file
                        }, 500);
                    }
                }
            }
        };
        jQuery.ajax(options);
    }

    function export_price_detail(json, index) {
        let options = {
            url: admin_ajax,
            method: 'POST',
            data: {
                action: 'kg_export_detail',
                key: index,
                data: json,
                price_id: '<?= $price_id; ?>',
                file_name: '<?= $file_name; ?>',
                step: 'export_price_detail',
            },
            dataType: 'json',
            success: function(res) {
                if (res.step = 'get_html_table') {
                    get_html_table(res.key);
                }
            }
        };
        jQuery.ajax(options);
    }
})
</script>