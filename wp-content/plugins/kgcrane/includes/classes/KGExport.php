<?php
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class KGExport {
    public static $abc = [];
    public static $shipping_info = [
        'giao_hang_1'   => 'Hà Nội: Khu Cầu Bươu, Thanh Trì, Hà Nội',
        'giao_hang_2'   => 'HCM: Bình Hưng Hòa, Bình Tân, HCM.',
        'giao_hang_3'   => 'Đồng Nai: Đường 25B, KCN Nhơn Trạch II, Nhơn Trạch, Đồng Nai.',
        'van_chuyen_1'  => 'Giao hàng tại kho Bên Bán: Thanh Trì, Hà Nội. | Vận chuyển: Bên Mua chịu trách nhiệm | Nâng hàng tại kho Bên Bán: Bên Bán chịu trách nhiệm',
        'van_chuyen_2'  => 'Giao hàng tại kho Bên Mua: Miễn phí vận chuyển. | Vận chuyển: Bên Bán chịu trách nhiệm | Hạ hàng tại kho Bên Mua: Bên Mua chịu trách nhiệm',
        'hang_hoa_1'    => '25~30 ngày làm việc.',
        'hang_hoa_2'    => 'Hàng có sẵn',
    ];

    public static function export_price_detail($spreadsheet,$jsonData,$post_id = 0,$key = 0){
        $worksheet = $spreadsheet->createSheet();
        $products = get_field('thong_tin_san_pham',$post_id);
        $products = isset($products['san_pham']) ? $products['san_pham'] : [];
        if( isset($products[$key]) ){
            $product = $products[$key];
            $ma_hieu = isset($product['ma_hieu']) ? $product['ma_hieu'] : get_the_title($product['product_id']);
        }

        $worksheet->setTitle('Chi tiết - '.$ma_hieu);
        $mergedCells = $jsonData['!merges'];
        $ref        = $jsonData['!ref'];
        $fullref    = $jsonData['!fullref'];
        unset($jsonData['!merges']);
        unset($jsonData['!ref']);
        unset($jsonData['!fullref']);
        // Merge the cells using the mergeCells method
        if( count($mergedCells) ){
            foreach ($mergedCells as $mergedCell) {
                $fromRow = $mergedCell['s']['r'] + 1; 
                $fromColumn = $mergedCell['s']['c'] + 1; 
                $toRow = $mergedCell['e']['r'] + 1;
                $toColumn = $mergedCell['e']['c'] + 1;
                $range = $worksheet->getCellByColumnAndRow($fromColumn, $fromRow)->getCoordinate() . ':' . $worksheet->getCellByColumnAndRow($toColumn, $toRow)->getCoordinate();
                $worksheet->mergeCells($range);
            }
        }
        
        if( isset($jsonData['data']) ){
            foreach( $jsonData['data'] as $rowIndex => $cols ){
                foreach( $cols as $colIndex => $colVal ){
                    $worksheet->setCellValueByColumnAndRow($colIndex,$rowIndex, $colVal);
                }
            }
        }else{
            $key = 0;
            foreach ($jsonData as $cellIndex => $row) {
                $worksheet->setCellValue($cellIndex,$row['v']);
                $worksheet->getColumnDimensionByColumn($key)->setAutoSize(true);
                $key++;
            }
        }

        // Insert logo left
        // A1: Logo trai
        $drawing = new Drawing();
        $drawing->setPath(KG_PATH.'includes/export_templates/images/image1.png');
        $drawing->setCoordinates('A1');
        $drawing->setWidth(160);
        $drawing->setHeight(30);
        $drawing->setWorksheet($worksheet);

        // B1: center and bold
        $B1 = $worksheet->getCell('B1');
        $B1->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $B1->getStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $B1->getStyle()->getFont()->setBold(true);
        // D1: Logo phai
        $drawing = new Drawing();
        $drawing->setPath(KG_PATH.'includes/export_templates/images/image2.png');
        $drawing->setCoordinates('D1');
        $drawing->setWidth(140);
        $drawing->setHeight(30);
        $drawing->setWorksheet($worksheet);
        
        // A4 - A10: bold
        for($i = 4; $i <= 12;$i++){
            $cell = $worksheet->getCell('A'.$i);
            $cell->getStyle()->getFont()->setBold(true);
        }
        // T4 - T10: bold
        for($i = 4; $i <= 12;$i++){
            $cell = $worksheet->getCell('C'.$i);
            $cell->getStyle()->getFont()->setBold(true);
        }

        if( $worksheet->getCell('A16')->getValue() == 'STT' ){
            $worksheet->getCell('A16')->getStyle()->getFont()->setBold(true);
            $worksheet->getCell('B16')->getStyle()->getFont()->setBold(true);
            $worksheet->getCell('C16')->getStyle()->getFont()->setBold(true);
            $worksheet->getCell('D16')->getStyle()->getFont()->setBold(true);
            $worksheet->getCell('E16')->getStyle()->getFont()->setBold(true);
        }

        if( $worksheet->getCell('A14')->getValue() == 'STT' ){
            $worksheet->getCell('A14')->getStyle()->getFont()->setBold(true);
            $worksheet->getCell('B14')->getStyle()->getFont()->setBold(true);
            $worksheet->getCell('C14')->getStyle()->getFont()->setBold(true);
            $worksheet->getCell('D14')->getStyle()->getFont()->setBold(true);
            $worksheet->getCell('E14')->getStyle()->getFont()->setBold(true);
        }
        
        
        return $spreadsheet;
    }
    public static function get_html_table($post_id,$key = 0,$file_name){
        // Thông tin sản phẩm
        $products = get_field('thong_tin_san_pham',$post_id);
        $products = isset($products['san_pham']) ? $products['san_pham'] : [];
        if( isset($products[$key]) ){
            $product = $products[$key];
            $product_id = $product['product_id'];
            $post_content = get_post($product_id)->post_content;
            include_once KG_PATH.'includes/lib/simple_html_dom.php';
            $htmlObj = new simple_html_dom($post_content);
            $table_html = $htmlObj->find('table',0)->outertext;
            $return = [
                'success' => true,
                'table_html' => $table_html,
                'key' => $key,
            ];
            echo json_encode($return);die();
        }
        $return = [
            'success' => false,
            'link_file' => KG_URI.'tmp/'.$file_name,
        ];
        echo json_encode($return);die();


    }
    public static function exportPrice($spreadsheet,$post_id){
        $execl = $spreadsheet->setActiveSheetIndex(0);
        // Thông tin công ty
        $company_info = get_option('company_info');
        $execl->setCellValue('X4', $company_info['ten_cong_ty']);
        $execl->setCellValue('X5', $company_info['dia_chi']);
        $execl->setCellValue('X6', $company_info['so_dien_thoai']);
        $execl->setCellValue('X7', $company_info['so_fax']);
        $execl->setCellValue('X8', $company_info['email']);
        $execl->setCellValue('X9', $company_info['giam_doc']);
        $execl->setCellValue('X10', $company_info['di_dong']);

        // Thông tin khách hàng
        $customer_info = get_field('thong_tin_khach_hang',$post_id);
        $execl->setCellValue('E4', $customer_info['to']);
        $execl->setCellValue('E5', $customer_info['add']);
        $execl->setCellValue('E6', $customer_info['mobile']);
        $execl->setCellValue('E7', $customer_info['fax']);
        $execl->setCellValue('E8', $customer_info['email']);
        $execl->setCellValue('E9', $customer_info['attn']);
        $execl->setCellValue('E10', $customer_info['about']);

        // Thông tin giao hàng
        $giao_hang  = get_field('giao_hang',$post_id);
        $van_chuyen = get_field('van_chuyen',$post_id);
        $hang_hoa   = get_field('hang_hoa',$post_id);
        if($hang_hoa){
            $hang_hoa = self::$shipping_info[$hang_hoa];
        }
        if($giao_hang){
            $giao_hang = self::$shipping_info[$giao_hang];
        }
        $execl->setCellValue('J29', $hang_hoa);
        $execl->setCellValue('J32', $giao_hang);
        if($van_chuyen){
            $van_chuyen = self::$shipping_info[$van_chuyen];
            $van_chuyen = explode('|',$van_chuyen);
            $execl->setCellValue('J32', $van_chuyen[0]);
            $execl->setCellValue('J33', $van_chuyen[1]);
            $execl->setCellValue('j34', $van_chuyen[2]);
        }

        // Thông tin sản phẩm
        $products = get_field('thong_tin_san_pham',$post_id);
        $products = isset($products['san_pham']) ? $products['san_pham'] : [];
        if( count($products) ){
            foreach( $products as $key => $product ){
                $mo_ta = $product['mo_ta'];
                $mo_tas = explode("\n",$mo_ta);
                foreach( $mo_tas as $k => $v ){
                    $v = trim($v);
                    // $mo_tas[$k] = strip_tags($mo_tas[$k]);
                    if(!$v || strpos($v, '&nb') !== false){
                        unset($mo_tas[$k]);
                    }
                }
                $mo_ta = implode("\n",$mo_tas);
                $mo_ta = strip_tags($mo_ta,"\n");
                $product['mo_ta'] = $mo_ta;
                $product['don_gia'] = str_replace(',','',$product['don_gia']);
                $product['tong_gia'] = str_replace(',','',$product['tong_gia']);

                $execl->setCellValue('A'.( 16 + $key ), $key + 1);// STT
                $execl->setCellValue('C'.( 16 + $key ), $product['ma_hieu']);
                $execl->setCellValue('J'.( 16 + $key ), $product['mo_ta']);
                $execl->setCellValue('V'.( 16 + $key ), $product['sl']);
                $execl->setCellValue('X'.( 16 + $key ), $product['don_vi']);
                $execl->setCellValue('Z'.( 16 + $key ), $product['don_gia']);
                $execl->setCellValue('AG'.( 16 + $key ), $product['tong_gia']);

                // $spreadsheet = self::exportSinglePrice($spreadsheet,$post_id,$product['product_id'],$key + 1);
                
            }
        } 
        
        return $spreadsheet;
    }
}