	<aside id="sidebar" class="medium-3 small-12 columns" data-equalizer-watch>
		<?php dynamic_sidebar("sidebar-widgets"); ?>
		
		<?php
			$name = str_replace("’", "'", get_the_title());
			$slug = basename(get_permalink());
		?>
		<article id="showDetails" class="row widget">
			<div class="large-12 columns">
				<img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/company/<?php echo $slug ?>.jpg" alt="<?php echo $name ?>" class="th">
				<h4 class="text-center">Shows with Third Rail</h4>
				<ul id="thirdRailShows" class="fa-ul">
					<?php $args = array(
						'post_type' 			=> 'page',
					  'actor'		 				=> $name,
					  'meta_key'        => 'Close Date',
					  'orderby'         => 'meta_value',
					  'order' 					=> 'DESC'
					);
					$query = new WP_Query( $args );
					
					if ( $query->have_posts() ) : ?>
				    <li><h6>Actor</h6></li>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<li style="font-size: 12px"><i class="fa-li fa fa-bolt"></i><a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?> by <?php echo get_post_custom_values('Playwright')[0] ?>"><?php the_title(); ?> (<?php echo substr(get_post_custom_values('Open Date')[0], 0, 4); ?>)</a></li>
						<?php endwhile; 
						wp_reset_postdata();
					endif; 
						
					$args = array(
						'post_type' 			=> 'page',
					  'creative'		 		=> $name,
					  'order' 					=> 'DSC'
					);
					$query = new WP_Query( $args );
					
					if ( $query->have_posts() ) :?>
				    <li><h6>Creative</h6></li>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<li style="font-size:12px"><i class="fa-li fa fa-bolt"></i><a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?> by <?php echo get_post_custom_values('Playwright')[0] ?>"><?php the_title(); ?> (<?php echo substr(get_post_custom_values('Open Date')[0], 0, 4); ?>)</a></li>
						<?php endwhile; 
						wp_reset_postdata();
					endif; ?>
					
					<?php 
					
					?>
				</ul>
			</div>
		</article>
	</aside>
