<?php /* Template Name: Show */ get_header(); ?>

<div class="row" data-equalizer>
	<div class="medium-8 small-12 columns" role="main" data-equalizer-watch>

  	<?php do_action('foundationPress_before_content'); ?>
		<?php the_breadcrumb(); ?>

  	<?php while (have_posts()) : the_post();
  	
	    $open_date = new DateTime(get_post_custom_values('Open Date')[0]);
      $open_text = $open_date->format('F j, Y');
	    $close_date = new DateTime(get_post_custom_values('Close Date')[0]);
      $close_text = $close_date->format('F j, Y');
      $venue = get_post_custom_values('Venue')[0];
      $runtime = get_post_custom_values('Runtime')[0];
      $subtitle = get_post_custom_values('Subtitle')[0];
      $tickets = get_post_custom_values('Tickets URL')[0];
      $roles = get_post_meta( $post->ID, 'Role');
      foreach ( $roles as $role ) {
		  	$role_array = explode(' - ', $role);
      	if ($role_array[2] === 'Playwright') {$playwright = $role_array[1];}
      } ?>
  	
  		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
  			<header>
  				<h1 class="entry-title text-center"><?php the_title(); ?></h1>
  				<h4 class="subheader text-center">by <?php echo $playwright ?></h4>
  			</heade&r>
  			<?php if ( get_post_custom_values('Close Date')[0] >= date('Y-m-d') && $tickets) { ?>
  				<a href="<?php echo $tickets; ?>" class="button success radius expand"><i class="fa fa-ticket fa-lg"></i> Buy Tickets</a>
  			<?php } ?>
  			<?php if ( $post->post_parent == 50 ) { ?>
  			  <div class="panel callout text-center">
  			    <p class="text-center">Third Rail's Hi-Definition Screenings feature amazing productions from London's National Theatre, captured live onstage and presented locally in high-definition video. NT Live Punch Card holders may use their cards for any Third Rail Hi-Definition Screening.</p>
  			  </div>
  			<?php } ?>
  			<div class="panel radius text-center">
  			  <h5><?php echo $open_text . ' - ' . $close_text; ?></h5>
  			  <h5 class="subheader"><?php echo get_post_custom_values('Show Times')[0]; ?></h5>
  			  <h6>- <?php echo $venue ?> -</h6>
  			  <?php 
	  			  if ($venue == 'Winningstad Theater') {
	    			  $address = '1111 SW Broadway, Portland, OR 97205';
	  			  } elseif ($venue == 'CoHo Theater') {
	    			  $address = '2257 NW Raleigh St, Portland, OR 97210';
	  			  } elseif ($venue == 'World Trade Center Theater') {
	  			  	$address = '25 SW Salmon St (2WTC), Portland, OR 97205';
	  			  } elseif ($venue == 'Echo Theatre') {
  	  			  $address = '1515 SE 37th Ave, Portland, OR 97214';
  	  			} elseif ($venue == 'Imago Theatre') {
    	  			$address = '17 SE 8th Ave, Portland, OR 97214';
	  			  } else { $address = ''; }
	  			 ?>
  			  <h6 class="subheader"><?php echo $address ?></h6>
  			</div>
  			
  			<?php if (isset($runtime)) { ?>
    			<div class="panel radius text-center">
    			  <p><strong>Runtime</strong>: <?php echo $runtime; ?></p>
    			</div>
  			<?php } ?>
  			
  			<?php
		  		$awards = get_post_meta( $post->ID, 'Award');
		  		if (isset($awards[0])) {
		  			echo '<div class="callout panel radius text-center">';
						echo '<h5>Awards</h5>';
						foreach ($awards as $award) {
							$award_array = explode(' - ', $award);
							$award_name = $award_array[0];
							$award_category = $award_array[1];
							if (isset($award_array[2])) {$award_person = $award_array[2];}
							if (isset($award_person)) {
								echo $award_category . ' - ' . $award_person . '<br>';
							} else {
								echo $award_category . '<br>';
							}
						}
						echo '</div>';
		  		}
		  	?>
  			
  			<?php if ( isset($subtitle) ) {echo '<h4 class="text-center">' . $subtitle . '</h4>';} ?>
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
  	
  	<?php
  		$reviews = get_post_meta( $post->ID, 'Review');
  		if (isset($reviews[0])) {
				echo '<hr class="dashed">';
				echo '<h3 class="text-center">Reviews</h3>';
				foreach ($reviews as $review) {
					$review_array = explode(' | ', $review);
					$review_text = $review_array[0];
					$review_source = $review_array[1];
					if (isset($review_array[2])) {$review_link = $review_array[2];}
					if (isset($review_link)) {
						echo '<blockquote>' . $review_text . ' ... <a href="' . $review_link . '" title="Read the full review">read more</a><cite>' . $review_source . '</cite></blockquote>';
					} else {
						echo '<blockquote>' . $review_text . '<cite>' . $review_source . '</cite></blockquote>';
					}
				}
  		}
  	?>

		<?php
			$parents = get_post_ancestors( $post->ID );
			if (isset($parents[count($parents)-2])) {
				$parentID = ($parents) ? $parents[count($parents)-2]: $post->ID;
			} else {
				$parentID = ($parents) ? $parents[count($parents)-1]: $post->ID;
			}
			$parent = get_page( $parentID );
			$directory = '/var/www/html/wp-content/themes/tr/assets/img/' . $parent->post_name . '/' . $post->post_name . '/';
			$images = glob($directory . "*-small.jpg");
			$imgCount = count($images);
			if ($imgCount > 0) {
				if ($imgCount % 3 === 0) {
	  			$num = 3;
				}
				elseif ($imgCount === 2) {
	  			$num = $imgCount;
				}
				else {
	  			$num = 4;
				}
				echo '<hr class="dashed">';
				echo '<h3 class="text-center">Production Images</h3>';
				echo '<ul class="large-block-grid-' . $num . ' medium-block-grid-3 small-block-grid-2" data-clearing>';
				foreach($images as $image) {
					$thumb = str_replace('/var/www/html', get_site_url() , $image);
					$image = str_replace('-small', '', $thumb);
				  echo '<li><a href="' . $image . '" class="th" title=""><img src="' . $thumb . '" alt="" data-caption="Photo by Owen Carey"></a></li>';
				}
				echo '</ul>';
				echo '<h6>Photos by Owen Carey</h6>';
			}
		?>

	</div>
	
  <?php get_sidebar('show'); ?>

</div>

<?php get_sidebar('show-related'); ?>

<?php get_footer(); ?>
