<?php 
$show = get_the_title();
$args = array(
	'post_type' 			=> 'post',
  'meta_key' 				=> 'Parent Show',
  'meta_value'			=> $show,
  'posts_per_page' 	=> 3,
  'order' 					=> 'ASC',
);
 
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>

<hr class="dashed">

<div class="row">
	<div class="large-12 columns">
		<h3 class="text-center">Related Articles</h3>
		<?php do_action('foundationPress_before_sidebar'); ?>
		
		<article id="currentShows" class="row widget cards" data-equalizer>
		
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
				<div class="medium-4 columns card" data-equalizer-watch>
		  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
		  			<?php the_post_thumbnail('header-medium'); ?>
		  			<h4><?php the_title(); ?></h4>
		  		</a>
		  	</div>
				
			<?php endwhile;
			wp_reset_postdata(); ?>
			
		</article>
		
		<?php do_action('foundationPress_after_sidebar'); ?>
	</div>
</div>

<?php endif ?>
