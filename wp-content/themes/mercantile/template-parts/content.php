<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Mercantile
 */
global $mercantile_customizer_all_values;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-wrapper">
		<?php
		if ( $mercantile_customizer_all_values['mercantile-blog-archive-layout'] == 'full-image' && has_post_thumbnail() ) {
			?>
			<!--post thumbnal options-->
			<a href="<?php the_permalink(); ?>" class="full-image">
				<?php
				the_post_thumbnail( 'full', array( 'class' => 'aligncenter' ) );
				?>
			</a>

			<?php
		}
		?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php
			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php mercantile_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
			endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			the_excerpt();
			?>
		</div><!-- .entry-content -->
		<div class="clearfix"></div>
		<footer class="entry-footer">
			<?php mercantile_entry_footer(); ?>
		</footer><!-- .entry-footer -->
		<?php
		$mercantile_blog_archive_read_more = mercantile_blog_archive_more_text();
		if( !empty( $mercantile_blog_archive_read_more )){
			?>
			<a class="read-more" href="<?php the_permalink(); ?> ">
				<?php echo $mercantile_blog_archive_read_more; ?>
			</a>
			<?php
		}
		?>
	</div>

</article><!-- #post-## -->