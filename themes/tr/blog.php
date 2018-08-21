<?php /* Template Name: Blog */ get_header(); ?>

<div class="row">
	<div class="small-12 columns" role="main">
		<?php the_breadcrumb(); ?>

    <?php
      $args = array (
      	'post_type'              => 'post',
      	'pagination'             => true,
      	'posts_per_page'         => '5',
      );
      
      $blog = new WP_Query( $args );
    ?>
    
  	<?php if ( $blog->have_posts() ) : ?>
  
  		<?php do_action('foundationPress_before_content'); ?>
  
  		<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
  		  <a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
	  			<?php the_post_thumbnail('header-medium'); ?>
	  		</a>
  			<?php get_template_part( 'content', get_post_format() ); ?>
  			<hr class="dashed">
  		<?php endwhile; ?>
  
  		<?php else : ?>
  			<?php get_template_part( 'content', 'none' ); ?>
  
  		<?php do_action('foundationPress_before_pagination'); ?>
  
  	<?php endif;?>
  
  
  
  	<?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>
  		<nav id="post-nav">
  			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
  			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
  		</nav>
  	<?php } ?>
  
  	<?php do_action('foundationPress_after_content'); ?>

	</div>
</div>
<?php get_footer(); ?>