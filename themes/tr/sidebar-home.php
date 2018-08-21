<div class="row">
	<aside id="topbar" class="large-12 columns">
		<?php do_action('foundationPress_before_sidebar'); ?>
		
		<h3 class="text-center">Current Shows</h3>
		<article id="currentShows" class="row widget" data-equalizer>
		
			<?php $args = array('page_id' => 1011);
			 
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) : $query->the_post(); ?>
				
<!--
					<div class="medium-4 columns card" data-equalizer-watch>
						<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
							<?php the_post_thumbnail('header-medium'); ?>
							<h4><?php the_title(); ?></h4>
						</a>
						<a href="https://thirdrailrep.secure.force.com/donate/?dfId=a0no000000HByN7AAL" title="<?php the_title(); ?>" class="button success"><i class="fa fa-ticket fa-lg"></i> Join Now</a>
					</div>
-->
					
				<?php endwhile;
				wp_reset_postdata();
			
			else : ?>				
			<?php endif; ?>
		
			<?php $args = array(
				'post_type' 			=> 'page',
				'meta_key' 				=> 'Close Date',
				'posts_per_page'		=> 3,
				'post__not_in'			=> array(776, 61, 74, 69, 445, 768),
				'orderby' 				=> 'meta_value',
				'order' 					=> 'ASC',
					'meta_query' 			=> array(
						array(
							'key' 				=> 'Close Date',
							'value' 			=> date('Y-m-d'),
							'type' 				=> 'date',
							'compare' 			=> '>='
					)
				)
			);
			 
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) : $query->the_post(); 
				
					if ( get_post_custom_values('Subtitle')[0] === 'Summer-in-the-Winter Announcement Party!') {
						$buyTicketsText = 'Reservations';
					} else {
						$buyTicketsText = 'Tickets';
					} ?>
				
					<div class="medium-4 columns card" data-equalizer-watch>
			  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
			  			<?php the_post_thumbnail('header-medium'); ?>
			  			<h4><?php the_title(); ?></h4>
			  		</a>
			  		<?php if(get_post_custom_values('Tickets URL')[0]) { ?>
  			  		<a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" title="<?php the_title(); ?> Tickets" class="button success"><i class="fa fa-ticket fa-lg"></i> <?php echo $buyTicketsText; ?></a>
			  		<?php } ?>
			  	</div>
					
				<?php endwhile;
				wp_reset_postdata();
			
				else : ?>				
			<?php endif; ?>
			
		</article>
		<?php do_action('foundationPress_after_sidebar'); ?>
	</aside>
</div>
	
<hr class="dashed">
	