<aside id="sidebar" class="small-12 medium-4 large-3 columns" data-equalizer-watch>
	<?php do_action('foundationPress_before_sidebar'); ?>
	
	<article id="ntliveShows" class="row widget">
	
		<?php $args = array(
			'post_type' 			=> 'page',
			'post_parent'			=> '50',
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
			<h3 class="text-center"><a href="/tr/national-theatre-live/" title="National Theatre Live">National Theatre Live</a></h3>
			<div class="small-12 columns"><a href="https://thirdrailrep.secure.force.com/ticket#sections_a0Fo000000lnVGsEAM" class="button expand success"><i class="fa fa-ticket fa-lg"></i> NT Live Punch Card</a></div>
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
			
			<p><?php _e( 'Check back soon for upcoming NT Live shows.' ); ?></p>
			
		<?php endif; ?>
		
	</article>

	<?php do_action('foundationPress_after_sidebar'); ?>
</aside>