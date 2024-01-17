<?php
$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["csv_file"]) && $_FILES["csv_file"]["error"] == UPLOAD_ERR_OK) {
        $file = $_FILES["csv_file"]["tmp_name"];
        $file_info = pathinfo($_FILES["csv_file"]["name"]);
        if ($file_info["extension"] == "csv") {
            $handle = fopen($file, "r");
            // Read the file line by line
            $rows = [];
            while (($data = fgetcsv($handle, 0, ",")) !== false) {
                $rows[] = $data;
            }
            fclose($handle);

            if( count($rows) ){
                foreach($rows as $key => $row){
                    if($key == 0) continue;
                    /*
                    [0] => 10           => Key No           => key_no
                    [1] => 013052       => Part No          => part_no
                    [2] => 스프링 와샤   => Part Name (KR)
                    [3] => Spring Washer=> Part Name (EN)   => part_name
                    [4] => 6            => QTY              => qty
                    [5] => M8           => Remarks          => remarks
                    */
                    foreach($row as $col => $value){
                        // Handle part no
                        if($col == 1){
                            $value = str_replace(' ','',$value);
                        }
                        $row[$col] = trim($value);
                    }
                    $rows[$key] = $row;
                }
            }

            foreach( $rows as $row ){
                $post_id = post_exists( $row[1],'','','phu_tung');
                if(!$post_id){
                    $post_data = array(
                        'post_title'   => $row[1],
                        'post_status'  => 'publish',
                        'post_type'    => 'phu_tung'
                    );
                    $post_id = wp_insert_post( $post_data );
                }
                update_post_meta($post_id,'key_no',$row[0]);
                update_post_meta($post_id,'part_no',$row[1]);
                update_post_meta($post_id,'part_name_kr',$row[2]);
                update_post_meta($post_id,'part_name',$row[3]);
                update_post_meta($post_id,'qty',$row[4]);
                update_post_meta($post_id,'remarks',$row[5]);
                if( !empty($row[6]) ){
                    update_post_meta($post_id,'price',$row[6]);
                }
            }
            $msg = 'Nhập phụ tùng thành công !';
        } else {
            $msg = 'Nhập phụ tùng thất bại !';
        }
    } else {
        $msg = 'Chưa có file tải lên !';
    }
}
?>
<div class="wrap js">
    <h1 class="wp-heading-inline">Import phụ tùng</h1>
    <hr class="wp-header-end">
    <?php if( $msg ): ?>
    <div id="message" class="notice notice-success">
        <p><?= $msg;?></p>
    </div>
    <?php endif; ?>

    <form class="acf-form" action="" method="POST" enctype="multipart/form-data">
        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label>File</label>
                    </th>
                    <td>
                        <input name="csv_file" type="file" id="blogname"  class="regular-text">
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="acf-form-submit">
            <input type="submit" name="kg_submit_tool" class="acf-button button button-primary button-large"
                value="Cập nhật" />
            <span class="acf-spinner"></span>
        </div>
    </form>

</div>