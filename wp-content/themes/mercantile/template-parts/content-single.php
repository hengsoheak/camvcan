<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-feat clearfix">
		<?php
		$sidebar_layout = mercantile_sidebar_selection();
		if( has_post_thumbnail() ):
			$thumbnail = 'full';
			echo '<figure class="single-thumb single-thumb-full">';
			the_post_thumbnail( $thumbnail );
			echo "</figure>";
		endif;
		?>
	</div><!-- .single-feat-->
	<div class="content-wrapper">
		<header class="entry-header">
			<div class="entry-meta">
				<?php mercantile_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<!--post thumbnal options-->
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mercantile' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php mercantile_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->