<aside id="sidebar" class="small-12 medium-4 large-3 columns" data-equalizer-watch>
	<?php do_action('foundationPress_before_sidebar'); ?>
	
	<article id="ntliveShows" class="row">
	
		<?php $args = array(
			'post_type' 			=> 'page',
			'post_parent'			=> '18',
		  'meta_key' 				=> 'Close Date',
		  'orderby' 				=> 'meta_value',
		  'order' 					=> 'ASC',
			'meta_query' 			=> array(
				array(
					'key' 				=> 'Close Date',
					'value' 			=> date('Y-m-d'),
					'type' 				=> 'date',
					'compare' 		=> '>='
				)
			)
		);
		 
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) : ?>
			<h3 class="text-center"><a href="/tr/season-9/" title="Third Rail Season 9">Third Rail Season 9</a></h3>
			<div class="small-12 columns"><a href="https://thirdrailrep.secure.force.com/ticket/#details_a0So0000000prAKEAY" class="button expand success"><i class="fa fa-ticket fa-lg"></i> Season Tickets</a></div>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			
				<div class="small-12 columns card">
		  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
		  			<?php the_post_thumbnail('header-medium'); ?>
		  			<h4><?php the_title(); ?></h4>
		  		</a>
		  		<?php if ( get_post_custom_values('Close Date')[0] >= date('Y-m-d') ) { ?>
		  			<a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" title="<?php the_title(); ?> Tickets" class="button success"><i class="fa fa-ticket fa-lg"></i> Tickets</a>
		  		<?php } ?>
		  	</div>
				
			<?php endwhile;
			wp_reset_postdata();
		
		else : ?>
			
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			
		<?php endif; ?>
		
	</article>
	
	<?php $args = array(
		'post_type'				=> 'post',
		'category_name'		=> 'National Theatre Live',
		'posts_per_page'	=> 3
	);
	
	$query = new WP_query( $args );
	
	if ( $query->have_posts() ) { ?>
		
		<article id="ntlivePosts" class="row">
			<h3 class="text-center">NT Live News</h3>
			
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="small-12 columns card">
		  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
		  			<?php the_post_thumbnail('header-medium'); ?>
		  			<h4><?php the_title(); ?></h4>
		  		</a>
		  	</div>
		  <?php endwhile;
		  wp_reset_postdata();?>
		  
		</article>
	<?php } ?>

	<?php do_action('foundationPress_after_sidebar'); ?>
</aside>
