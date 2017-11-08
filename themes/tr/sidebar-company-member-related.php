<?php
$name = get_the_title();
$slug = basename(get_permalink());
$args = array(
	'post_type' 			=> 'page',
  'actor'		 				=> $name,
  'posts_per_page' 	=> 3,
  'post_parent'			=> 891,
  'meta_key'        => 'Close Date',
  'orderby'         => 'meta_value',
  'order' 					=> 'DESC'
);
 
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>
  <hr class="dashed">
  
  <div class="row">
  	<div class="large-12 columns">
  		<?php do_action('foundationPress_before_sidebar'); ?>
  		
  
			<article id="currentShows" class="row widget cards" data-equalizer>
				<h3 class="text-center">Shows Featuring <?php echo strtok($name, " "); ?> this Season</h3>
				<?php while ( $query->have_posts() ) : $query->the_post();
					if ( $query->found_posts == 1 ) {
  					$columnsClass = ' medium-centered';
					} else {$columnsClass = '';} ?>
				
					<div class="medium-4<?php echo $columnsClass ?> columns card" data-equalizer-watch>
			  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
			  			<?php the_post_thumbnail('header-medium'); ?>
			  			<h4><?php the_title(); ?></h4>
			  		</a>
			  		<?php if ( get_post_meta($post->ID, 'Tickets URL', true) && strtotime(get_post_meta($post->ID, 'Close Date', true)) >= strtotime(date('Y-m-d')) ) { ?> 
			  		  <a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" title="<?php the_title(); ?> Tickets" class="button success"><i class="fa fa-ticket fa-lg"></i> Tickets</a>
            <?php } ?>
			  	</div>
					
				<?php 
				endwhile;
				wp_reset_postdata(); ?>
			</article>
  	</div>
  </div>
  		
<?php endif; 

$args = array(
	'post_type' 			=> 'page',
  'creative'		 		=> $name,
  'posts_per_page' 	=> 3,
  'post_parent'			=> 891,
  'meta_key'        => 'Close Date',
  'orderby'         => 'meta_value',
  'order' 					=> 'DESC'
);
 
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>
  <hr class="dashed">
  
  <div class="row">
  	<div class="large-12 columns">
  		<?php do_action('foundationPress_before_sidebar'); ?>
  		
  
			<article id="currentShows" class="row widget cards" data-equalizer>
				<h3 class="text-center">Shows Featuring <?php echo strtok($name, " "); ?>'s Work This Season</h3>
				<?php while ( $query->have_posts() ) : $query->the_post();
					if ( $query->found_posts == 1 ) {
  					$columnsClass = ' medium-centered';
					} else {$columnsClass = '';} ?>
				
					<div class="medium-4<?php echo $columnsClass ?> columns card" data-equalizer-watch>
			  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
			  			<?php the_post_thumbnail('header-medium'); ?>
			  			<h4><?php the_title(); ?></h4>
			  		</a>
			  		<?php if ( get_post_meta($post->ID, 'Tickets URL', true) && strtotime(get_post_meta($post->ID, 'Close Date', true)) >= strtotime(date('Y-m-d')) ) { ?> 
			  		  <a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" title="<?php the_title(); ?> Tickets" class="button success"><i class="fa fa-ticket fa-lg"></i> Tickets</a>
            <?php } ?>
			  	</div>
					
				<?php 
				endwhile;
				wp_reset_postdata(); ?>
			</article>
  	</div>
  </div>
  		
<?php endif; ?>
		
<?php $args = array(
	'post_type' 			=> 'post',
  'tag'		 					=> $slug,
  'posts_per_page' 	=> 3
);
 
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>
	<hr class="dashed">
	
	<div class="row">
		<div class="large-12 columns">
			<article id="relatedPosts" class="row widget cards" data-equalizer>
				<h3 class="text-center">Recent News About <?php echo strtok($name, " "); ?></h3>
				<?php	while ( $query->have_posts() ) : $query->the_post();
					if ( $query->found_posts == 1 ) {
  					$columnsClass = ' medium-centered';
					} else {$columnsClass = '';} ?>
			
				<div class="medium-4<?php echo $columnsClass ?> columns card" data-equalizer-watch>
		  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
		  			<?php the_post_thumbnail('header-medium'); ?>
		  			<h4><?php the_title(); ?></h4>
		  		</a>
		  		<?php if ( get_post_meta($post->ID, 'Tickets URL', true) && strtotime(get_post_meta($post->ID, 'Close Date', true)) >= strtotime(date('Y-m-d')) ) { ?> 
		  		  <a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" title="<?php the_title(); ?> Tickets" class="button success"><i class="fa fa-ticket fa-lg"></i> Tickets</a>
          <?php } ?>
		  		
		  	</div>
					
				<?php endwhile;
				wp_reset_postdata(); ?>
			</article>
		
		<?php do_action('foundationPress_after_sidebar'); ?>
  	</div>
  </div>
<?php endif; ?>