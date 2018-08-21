<?php /* Template Name: Company Member */ get_header(); ?>

<div class="row" data-equalizer>
	<div class="medium-9 small-12 columns" role="main" data-equalizer-watch>

	<?php do_action('foundationPress_before_content'); ?>
		<?php the_breadcrumb(); ?>

  	<?php while (have_posts()) : the_post(); ?>
  		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
  			<header>
  				<h1 class="entry-title"><?php the_title(); ?></h1>
  			</header>
  			<?php do_action('foundationPress_page_before_entry_content'); ?>
  			<div class="entry-content">
  				<?php the_content(); ?>
  			</div>
  			<footer>
  				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
  			</footer>
  		</article>
  	<?php endwhile;?>
		
  	<?php do_action('foundationPress_after_content'); ?>

	</div>
	
  <?php get_sidebar('company-member'); ?>

</div>

<?php get_sidebar('company-member-related'); ?>

<?php get_footer(); ?>
