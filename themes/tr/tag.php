<?php get_header(); ?>
<div class="row" data-equalizer>
<!-- Row for main content area -->
	<div class="small-12 large-8 columns" role="main" data-equalizer-watch>
		<?php the_breadcrumb(); ?>
		<h1><span style="font-weight:100">Articles about</span> <?php single_tag_title(); ?></h1>
	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<hr class="dashed">
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; // end have_posts() check ?>

	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
		</nav>
	<?php } ?>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
