<?php
/**
 * The template part for displaying content
 *
 * @package shop-isle
 */
?>
<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
	/**
 	 * @hooked shop_isle_post_header() - 10
 	 * @hooked shop_isle_post_meta() - 20
 	 * @hooked shop_isle_post_content() - 30
	 */
	do_action( 'shop_isle_loop_post' );
	?>

</div><!-- #post-## -->