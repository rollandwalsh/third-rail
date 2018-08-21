<?php /* Template Name: National Theater Live */ get_header(); ?>

<div class="row" data-equalizer>
	<div class="large-12 columns" role="main" data-equalizer-watch>

  	<?php do_action('foundationPress_before_content'); ?>
		<?php the_breadcrumb(); ?>
  
  	<?php while (have_posts()) : the_post(); ?>
  		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
  			<header>
  				<h1 class="entry-title text-center"><?php the_title(); ?></h1>
  			</header>
  			<?php do_action('foundationPress_page_before_entry_content'); ?>
  			<div class="entry-content">
	        <a href="https://thirdrailrep.secure.force.com/ticket#sections_a0F1N00000mZGrSUAW" class="button expand success"><i class="fa fa-ticket fa-lg"></i> NT Live Punch Card</a>
  				<?php the_content(); ?>
  				
  				<?php $args = array(
  					'post_type' 			=> 'page',
  				  	'post_parent'			=> $post->ID,
					'posts_per_page'		=> '15',
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
			      		  <a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" title="<?php the_title(); ?> Tickets" class="button success small"><i class="fa fa-ticket fa-lg"></i> Tickets</a>
  					  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="button small"><i class="fa fa-info fa-lg"></i> More Info</a>
  					  		<?php if (get_the_title() === 'JOHN') {echo '<h6 class="text-center">Suitable for 18yrs+</h6>';} ?>
  					  	</div>
  					  	<div class="medium-7 columns">
    			  			<header>
                		<h2 class="text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                		<h4 class="subheader text-center">by <?php echo $playwright ?></h4>
                	</header>
                  <div class="callout panel radius text-center">
            			  <h5><?php echo $open_text . ' - ' . $close_text; ?></h6>
            			  <h5 class="subheader"><?php echo get_post_custom_values('Show Times')[0]; ?></h5>
            			  <h6>- <?php echo $venue ?> -</h6>
 <?php 
	  			  if ($venue == 'Winningstad Theater') {
	    			  	$address = '1111 SW Broadway, Portland, OR 97205';
	  			  } elseif ($venue == 'CoHo Theater') {
	    			  	$address = '2257 NW Raleigh St, Portland, OR 97210';
	  			  } elseif ($venue == 'World Trade Center Theater') {
	  			  	$address = '121 SW Salmon Street Portland, OR 97204';
	  			  } elseif ($venue == 'Echo Theatre') {
  	  			  	$address = '1515 SE 37th Ave, Portland, OR 97214';
  	  			} elseif ($venue == 'Imago Theatre') {
    	  			$address = '17 SE 8th Ave, Portland, OR 97214';
				  } elseif ($venue == 'Lake Theater and Cafe') {
					  $address = '106 N State Street Lake Oswego, OR  97034';
	  			  } else { $address = ''; }
	  			 ?>
  			  <h6 class="subheader"><?php echo $address ?></h6>           			  
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
