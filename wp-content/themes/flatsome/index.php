<?php
/**
 * The blog template file.
 *
 * @package flatsome
 */

get_header();

?>
<h1 style="display:none">CÔNG TY CỔ PHẦN THIẾT BỊ DINHNGUYEN</h1>
<div id="content" class="blog-wrapper blog-archive page-wrapper">
		<?php get_template_part( 'template-parts/posts/layout', get_theme_mod('blog_layout','right-sidebar') ); ?>
</div><!-- .page-wrapper .blog-wrapper -->

<?php get_footer(); ?>