<?php /* Template Name: Season */ get_header(); ?>

<style>
	#pageHeader {display: none}
</style>

<div class="row" data-equalizer>
	<div class="large-12" role="main" data-equalizer-watch>

  	<?php do_action('foundationPress_before_content'); ?>
		<?php the_breadcrumb(); ?>
  
  	<?php while (have_posts()) : the_post(); ?>
  		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
  			<header>
  				<h1 class="entry-title text-center"><?php the_title(); ?></h1>
  			</header>
  			<?php do_action('foundationPress_page_before_entry_content'); ?>
  			<div class="entry-content">
  				<?php if ( get_post_meta($post->ID, 'Tickets URL', true) != '' ) { ?>
	          <a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" class="button expand success"><i class="fa fa-ticket fa-lg"></i> Season Tickets</a>
          <?php } ?>
  				<?php the_content(); ?>
  				
  				<?php $args = array(
  					'post_type' 			=> 'page',
  				  'post_parent'			=> $posts[0]->ID,
						'posts_per_page' 	=> -1,
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
  				
  				if ( $query->have_posts() ) {
  					while ( $query->have_posts() ) : $query->the_post();
  					
    			    $open_date = new DateTime(get_post_custom_values('Open Date')[0]);
              $open_text = $open_date->format('F j, Y');
    			    $close_date = new DateTime(get_post_custom_values('Close Date')[0]);
              $close_text = $close_date->format('F j, Y');
              $venue = get_post_custom_values('Venue')[0];
              $tickets = get_post_custom_values('Tickets URL')[0];
              $show_times = get_post_custom_values('Show Times')[0];
              $roles = get_post_meta( $post->ID, 'Role');
              foreach ( $roles as $role ) {
  					  	$role_array = explode(' - ', $role);
              	if ($role_array[2] === 'Playwright') {$playwright = $role_array[1];}
              } ?>
              
  						<hr class="dashed">
  						
  						<article id="post-<?php the_ID(); ?>" class="row">
  							<div class="medium-5 columns card">
  					  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
  					  			<?php the_post_thumbnail('header-medium'); ?>
  					  		</a>
  					  		<?php if ($tickets) { ?>
	  					  		<a href="<?php echo $tickets; ?>" title="<?php the_title(); ?> Tickets" class="button success small"><i class="fa fa-ticket fa-lg"></i> Tickets</a>
  					  		<?php }; ?>
  					  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="button small"><i class="fa fa-info fa-lg"></i> More Info</a>
  					  	</div>
  					  	<div class="medium-7 columns">
    			  			<header>
                		<h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                		<h4 class="subheader text-center">by <?php echo $playwright ?></h4>
                	</header>
                  <div class="callout panel radius text-center">
            			  <h5><?php echo $open_text . ' - ' . $close_text; ?></h6>
            			  <h5 class="subheader"><?php echo $show_times; ?></h5>
            			  <h6>- <?php echo $venue ?> -</h6>
            			  <?php if ($venue == 'Winningstad Theater') {
	            			  $address = '1111 SW Broadway, Portland, OR 97205';
            			  } elseif ($venue == 'CoHo Theater') {
	            			  $address = '2257 NW Raleigh St, Portland, OR 97210';
            			  } elseif ($venue == 'Imago Theatre') {
              			  $address = '17 SE 8th Ave, Portland, OR 97214';
            			  } else {$address = '';}?>
            			  <h6 class="subheader"><?php echo $address ?></h6>
                  </div>
  					  	</div>
  						</article>
  				  	
  					<?php endwhile;
  					wp_reset_postdata();
  				
  				}
  				
  				 $args = array(
  					'post_type' 			=> 'page',
  				  'post_parent'			=> $posts[0]->ID,
						'posts_per_page' 	=> -1,
					  'meta_key' 				=> 'Close Date',
					  'orderby' 				=> 'meta_value',
					  'order' 					=> 'ASC',
						'meta_query' 			=> array(
							array(
								'key' 				=> 'Close Date',
								'value' 			=> date('Y-m-d'),
								'type' 				=> 'date',
								'compare' 		=> '<'
							)
						)
  				);
  				 
  				$query = new WP_Query( $args );
  				
  				if ( $query->have_posts() ) {
  					while ( $query->have_posts() ) : $query->the_post();
  					
    			    $open_date = new DateTime(get_post_custom_values('Open Date')[0]);
              $open_text = $open_date->format('F j, Y');
    			    $close_date = new DateTime(get_post_custom_values('Close Date')[0]);
              $close_text = $close_date->format('F j, Y');
              $venue = get_post_custom_values('Venue')[0];
              $show_times = get_post_custom_values('Show Times')[0];
              $roles = get_post_meta( $post->ID, 'Role');
              foreach ( $roles as $role ) {
  					  	$role_array = explode(' - ', $role);
              	if ($role_array[2] === 'Playwright') {$playwright = $role_array[1];}
              } ?>
              
  						<hr class="dashed">
  						
  						<article id="post-<?php the_ID(); ?>" class="row">
  							<div class="medium-5 columns card">
  					  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
  					  			<?php the_post_thumbnail('header-medium'); ?>
  					  		</a>
  					  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="button small"><i class="fa fa-info fa-lg"></i> More Info</a>
  					  	</div>
  					  	<div class="medium-7 columns">
    			  			<header>
                		<h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                		<h4 class="subheader text-center">by <?php echo $playwright ?></h4>
                	</header>
                  <div class="callout panel radius text-center">
            			  <h5><?php echo $open_text . ' - ' . $close_text; ?></h6>
            			  <h5 class="subheader"><?php echo $show_times; ?></h5>
            			  <h6>- <?php echo $venue ?> -</h6>
            			  <?php if ($venue == 'Winningstad Theater') {
	            			  $address = '1111 SW Broadway, Portland, OR 97205';
            			  } elseif ($venue == 'CoHo Theater') {
	            			  $address = '2257 NW Raleigh St, Portland, OR 97210';
            			  } elseif ($venue == 'Imago Theatre') {
              			  $address = '17 SE 8th Ave, Portland, OR 97214';
            			  } else {$address = '';}?>
            			  <h6 class="subheader"><?php echo $address ?></h6>
                  </div>
  					  	</div>
  						</article>
  				  	
  					<?php endwhile;
  					wp_reset_postdata();
  				
  				} ?>
  			</div>
  			<footer>
  				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
  				<p><?php the_tags(); ?></p>
  			</footer>
  		</article>
  	<?php endwhile;?>
  
  	<?php do_action('foundationPress_after_content'); ?>

	</div>
</div>
<?php get_footer(); ?>
