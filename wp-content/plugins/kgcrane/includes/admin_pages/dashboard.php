<?php
    $pricing = wp_count_posts('pricing');
    $product = wp_count_posts('product');
    $user = count_users();
?>
<div class="wrap js">
    <h1 class="wp-heading-inline">Trang tổng quan</h1>
    <hr class="wp-header-end">
    <div id="dashboard-widgets" class="metabox-holder" style="display: flex;gap: 10px;">
        <div class="postbox-container">
            <div class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle">Báo giá</h2>
                </div>
                <div class="inside">
                    <table class="custom-table">
                        <tr>
                            <td>Đã tạo</td>
                            <td> <strong><?= $pricing->publish; ?></strong> </td>
                        </tr>
                        <tr>
                            <td>Bản thảo</td>
                            <td> <strong><?= $pricing->draft; ?></strong> </td>
                        </tr>
                    </table>
                    <hr>
                    <a href="edit.php?post_type=pricing" class="button button-primary">Quản lý</a>
                </div>
            </div>
        </div>
        <div class="postbox-container">
            <div class="postbox">
                <div class="postbox-header">
                <h2 class="hndle">Tổng số sản phẩm</h2>
                </div>
                <div class="inside">
                    <table class="custom-table">
                        <tr>
                            <td>Đang bán</td>
                            <td> <strong><?= $product->publish; ?></strong> </td>
                        </tr>
                        <tr>
                            <td>Bản thảo</td>
                            <td> <strong><?= $product->draft; ?></strong> </td>
                        </tr>
                    </table>
                    <hr>
                    <a href="edit.php?post_type=product" class="button button-primary">Quản lý</a>
                </div>
            </div>
        </div>
        <div class="postbox-container">
            <div class="postbox">
                <div class="postbox-header">
                <h2 class="hndle">Tổng số khách hàng</h2>
                </div>
                <div class="inside">
                    <table class="custom-table">
                        <tr>
                            <td>Hoạt động</td>
                            <td> <strong><?= $user['total_users'];?></strong> </td>
                        </tr>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </table>
                    <hr>
                    <a href="users.php" class="button button-primary">Quản lý</a>
                </div>
            </div>
        </div>
    </div>
    <div id="dashboard-widgets" class="metabox-holder" style="display: flex;gap: 10px;">
        <div class="postbox-container">
            <div class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle">Công cụ</h2>
                </div>
                <div class="inside">
                    <table class="custom-table">
                        <tr>
                            <td>Cập nhật giá</td>
                            <td> <a href="admin.php?page=kg-tool">Đi tới</a> </td>
                        </tr>
                        <tr>
                            <td>Nhập sản phẩm</td>
                            <td> <a href="admin.php?page=kg-import">Đi tới</a> </td>
                        </tr>
                        <tr>
                            <td>Cài đặt hệ thống</td>
                            <td> <a href="admin.php?page=kg-setting">Đi tới</a> </td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

</div>