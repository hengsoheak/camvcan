<?php
/**
 * Template part for displaying page content in page.php.
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
		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mercantile' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
				/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'mercantile' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->