<?php
//Add custom search box at edit.php?post_type=X
add_action( 'restrict_manage_posts', 'kg_restrict_manage_posts' );
function kg_restrict_manage_posts(){
    $type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
    $company_id = isset($_GET['company_id']) ? $_GET['company_id'] : '';
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
    if ( in_array($type,['pricing']) ){
        $companies = [];
        ?>
        <select name="company_id">
            <option value="">Chọn công ty</option>
            <?php foreach( $companies as $company ):?>
            <option <?= kg_selected($company_id == $company->ID);?> value="<?= $course->ID; ?>"><?= $course->post_title; ?></option>
            <?php endforeach;?>
        </select>
        <?php
    }
    if ( in_array($type,['pricing']) ){
        $users = [];
        ?>
        <select name="user_id">
            <option value="">Chọn người lập</option>
            <?php foreach( $users as $user ):?>
            <option <?= kg_selected($user_id == $user->ID);?> value="<?= $lesson->ID; ?>"><?= $lesson->post_title; ?></option>
            <?php endforeach;?>
        </select>
        <?php
    }
}

// Handle custom search in admin
add_filter( 'parse_query', 'kg_admin_posts_filter' );
function kg_admin_posts_filter($query){
    global $pagenow;
    $allow = is_admin() && $pagenow=='edit.php';
    $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : '';
    $lesson_id = isset($_GET['lesson_id']) ? $_GET['lesson_id'] : '';

    $type = isset($_GET['post_type']) ? $_GET['post_type'] : '';
    if ( in_array($type,['pricing']) && $allow && $course_id) {
        $query->query_vars['meta_key'] = 'course_id';
        $query->query_vars['meta_value'] = $_GET['course_id'];
    }
    if ( in_array($type,['pricing']) && $allow && $lesson_id) {
        $query->query_vars['meta_key'] = 'lesson_id';
        $query->query_vars['meta_value'] = $_GET['lesson_id'];
    }
    return $query;
}
