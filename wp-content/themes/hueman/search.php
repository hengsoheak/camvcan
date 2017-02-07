<?php get_header(); ?>

<section class="content">

	<?php hu_get_template_part('parts/page-title'); ?>

	<div class="pad group">

		<div class="notebox">
			<?php _e('For the term','hueman'); ?> "<span><?php echo get_search_query(); ?></span>".
			<?php if ( !have_posts() ): ?>
				<?php _e('Please try another search:','hueman'); ?>
			<?php endif; ?>
			<div class="search-again">
				<?php get_search_form(); ?>
			</div>
		</div>

		<?php if ( have_posts() ) : ?>

			<?php if ( hu_is_checked('blog-standard') ): ?>
				<?php while ( have_posts() ): the_post(); ?>
					<?php get_template_part('content-standard'); ?>
				<?php endwhile; ?>
			<?php else: ?>
			<div class="post-list group">
				<?php global $wp_query; echo '<div class="post-row">'; while ( have_posts() ): the_post(); ?>
          <?php get_template_part('content'); ?>
        <?php if( ( $wp_query->current_post + 1 ) % 2 == 0 ) { echo '</div><div class="post-row">'; }; endwhile; echo '</div>'; ?>
			</div><!--/.post-list-->
			<?php endif; ?>

			<?php get_template_part('parts/pagination'); ?>

		<?php endif; ?>

	</div><!--/.pad-->

</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>