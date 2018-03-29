<?php get_header(); ?>

<div class="row">
	<div class="small-12 columns" role="main">

	<?php do_action('foundationPress_before_content'); ?>

	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<?php do_action('foundationPress_page_before_entry_content'); ?>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php
  				$season_number =  (date("n") > 7 ? date("Y")-2005 : date("Y") - 2006);
  				$current_season = "Season " . $season_number;

				  // Create array of current company members
				  $args = array(
				    'post_parent'       => 46,
				    'post_type'         => 'page',
				    'posts_per_page'    => 50
				  );
					$company_query = new WP_Query( $args );
					$company_posts = $company_query->get_posts();
					$company_members = array();
					foreach($company_posts as $post) {
						array_push($company_members, basename( get_permalink() ));
					}
					wp_reset_query();
          
          $args = array(
  					'post_type' 			=> 'page',
  				  'post_parent'			=> '1634',
					  'meta_key' 				=> 'Close Date',
					  'orderby' 				=> 'meta_value',
					  'order' 					=> 'ASC',
						'meta_query' 			=> array(
							array(
								'key' 				=> 'Close Date',
								'value' 			=> current_time('mysql'),
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
  							<div class="medium-3 columns card">
  					  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
  					  			<?php the_post_thumbnail('header-medium'); ?>
  					  			<h4><?php the_title(); ?></h4>
  					  			<h6>by <?php echo $playwright; ?></h6>
  					  		</a>
  					  	</div>
  					  	<div class="medium-9 columns">
                  <header class="panel radius text-center">
                    <h3><?php echo the_title(); ?> <i class="fa fa-ellipsis-h"></i> <span class="subheader"><?php echo $playwright; ?></span></h5>
            			  <h6><?php echo $open_text . ' - ' . $close_text; ?> <i class="fa fa-ellipsis-h"></i> <span class="subheader"><?php echo get_post_custom_values('Show Times')[0]; ?></span></h3>
            			  <?php if ($venue == 'Winningstad Theater') {
	            			  $address = '1111 SW Broadway, Portland, OR 97205';
            			  } elseif ($venue == 'CoHo Theater') {
	            			  $address = '2257 NW Raleigh St, Portland, OR 97210';
            			  } elseif ($venue == 'Imago Theatre') {
              			  $address = '17 SE 8th Ave, Portland, OR 97214';
              		  } else {$address = '';}?>
            			  <h6><?php echo $venue ?> <i class="fa fa-ellipsis-h"></i> <span class="subheader"><?php echo $address ?></h6>
                  </header>
          				<?php
          					// Create arrays of roles in production
          					$roles = get_post_meta( $post->ID, 'Role');
          					$print_actors_3r = array();
          					$print_actors = array();
          					$print_creatives_3r = array();
          					$print_creatives = array();
          					foreach ( $roles as $role ) {
          					  $role_array = explode(' - ', $role);
          					  $role_slug = strtolower( str_replace("'", "", str_replace(' ', '-', $role_array[1]) ) );
          					  $print_name = $role_array[1];
          					  if ( isset($role_array[2]) ) { $role_name = $role_array[2]; }
          					  if ( in_array( $role_slug, $company_members) ) { // Person is Third Rail member
          					  	if ( $role_array[2] === 'Director' ) {
          						  	$print_director = '<li><h6>Director</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - Director - Core Company Member">' . $role_array[1] . '</a> <i class="fa fa-bolt"></i>';
          					  	}
          					  	elseif ( $role_array[2] === 'Playwright' ) {
          						  	$print_playwright = '<li><h6>Playwright</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - Playwright - Core Company Member">' . $role_array[1] . '</a> <i class="fa fa-bolt"></i>';
          					  	}
            					  elseif ( $role_array[0] === 'actor' ) { // Third Rail member is actor
            					    if ( isset($role_array[3]) ) { // Third Rail actor is Equity
              					    $print_name = $role_array[1] . '*';
            					    }
            					    else { // Third Rail actor isn't Equity
              					    $print_name = $role_array[1];
            					    }
            					    $print_actors_3r[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $role_array[1] . ' - ' . $role_array[2] . ' - Core Company Member">' . $print_name . '</a> <i class="fa fa-bolt"></i></li>';
            					  }
            					  elseif ( $role_array[0] === 'creative' ) { // Third Rail member is creative
            					    if ( isset($role_array[3]) ) { // Third Rail creative is Equity
              					    $print_name = $role_array[1] . '*';
            					    }
            					    else { // Third Rail creative isn't Equity
              					    $print_name = $role_array[1];
            					    }
            					    $print_creatives_3r[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - ' . $role_array[2] . ' - Core Company Member">' . $print_name . '</a> <i class="fa fa-bolt"></i></li>';
            					  }
          					  }
          					  else { // Person is guest artist
          					  	if ( $role_array[2] === 'Director' ) {
          						  	$print_director = '<li><h6>Director</h6></li><li><a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - Director - Core Company Member"> ' . $role_array[1] . '</a></li>';
          					  	}
          					  	elseif ( $role_array[2] === 'Playwright' ) {
          						  	$print_playwright = '<li><h6>Playwright</h6></li><li><a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - Playwright - Core Company Member"> ' . $role_array[1] . '</a></li>';
          					  	}
            					  elseif ( $role_array[0] === 'actor' ) { // Guest artist is actor
            					    if ( isset($role_array[3]) ) { // Guest actor is Equity
              					    $print_name = $role_array[1] . '*';
            					    }
            					    else { // Guest actor isn't Equity
              					    $print_name = $role_array[1];
            					    }
            					    $print_actors[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/actor/' . $role_slug . '/" title="' . $role_array[1] . ' - ' . $role_array[2] . ' - guest artist"> ' . $print_name . '</a></li>';
            					  }
            					  elseif ( $role_array[0] === 'creative' ) { // Guest artist is creative
            					    if ( isset($role_array[3]) ) { // Guest creative is Equity
              					    $print_name = $role_array[1] . '*';
            					    }
            					    else { // Guest creative isn't Equity
              					    $print_name = $role_array[1];
            					    }
            					    $print_creatives[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - ' . $role_array[2] . ' - guest artist"> ' . $print_name . '</a></li>';
            					  }
          					  }
          					}
                    sort($print_actors_3r);
          					sort($print_actors);
          					sort($print_creatives_3r);
          					sort($print_creatives);
          					$print_actors_3r = join(' ', $print_actors_3r);
          					$print_actors = join(' ', $print_actors);
          					$print_creatives_3r = join(' ', $print_creatives_3r);
          					$print_creatives = join(' ', $print_creatives);
          				?>
                  <div class="row">
                    <div class="medium-6 columns">
              				<?php if (isset($print_director) and isset($print_playwright) and isset($print_creatives_3r[0]) and isset($print_creatives[0])) { ?>
                				<h5 class="">Creatives</h5>
                				<ul class="creatives small-block-grid-2"><?php echo $print_director . $print_playwright . $print_creatives_3r . $print_creatives; ?></ul>
              				<?php } ?>
                    </div>
                    <div class="medium-6 columns">
              				<?php if (isset($print_actors_3r[0]) or isset($print_actors[0])) { ?>
                				<h5 class="">Cast</h5>
                				<ul class="actors small-block-grid-2"><?php echo $print_actors_3r . $print_actors; ?></ul>
              				<?php } ?>
                    </div>
                  </div>
          				<?php if (isset($print_director[0]) or isset($print_playwright[0]) or isset($print_actors_3r[0]) or isset($print_actors[0]) or isset($print_creatives_3r[0]) or isset($print_creatives[0])) { ?>
                    <p class="text-center"><small><i class="fa fa-bolt"></i> Third Rail core company member &nbsp; * Member of Actors Equity Association</small></p>
          				<?php } ?>
  					  	</div>
  					  	<div class="row>">
  					  	  <div class="large-12 columns">
                		<?php
                			$directory = '/home1/thirdrai/public_html/wp-content/themes/tr/assets/img/season-9/' . $post->post_name . '/';
                			$images = glob($directory . "*-small.jpg");
                			$imgCount = count($images);
                			if ($imgCount > 0) {
                				echo '<ul class="large-block-grid-6 medium-block-grid-4 small-block-grid-3" data-clearing>';
                				foreach($images as $image) {
                					$thumb = str_replace('/home1/thirdrai/public_html', get_site_url() , $image);
                					$image = str_replace('-small', '', $thumb);
                				  echo '<li><a href="' . $image . '" class="th" title=""><img src="' . $thumb . '" alt="" data-caption="Photo by Owen Carey"></a></li>';
                				}
                				echo '</ul>';
                			}
                		?>
  					  	  </div>
  					  	</div>
  						</article>
  				  	
  					<?php endwhile;
  					wp_reset_postdata();
  				
  				}
  				
  				 $args = array(
  					'post_type' 			=> 'page',
  				  'post_parent'			=> '18',
					  'meta_key' 				=> 'Close Date',
					  'orderby' 				=> 'meta_value',
					  'order' 					=> 'ASC',
						'meta_query' 			=> array(
							array(
								'key' 				=> 'Close Date',
								'value' 			=> current_time('mysql'),
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
              $roles = get_post_meta( $post->ID, 'Role');
              foreach ( $roles as $role ) {
  					  	$role_array = explode(' - ', $role);
              	if ($role_array[2] === 'Playwright') {$playwright = $role_array[1];}
              } ?>
              
  						<hr class="dashed">
  						
  						<article id="post-<?php the_ID(); ?>" class="row">
  							<div class="medium-3 columns card">
  					  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
  					  			<?php the_post_thumbnail('header-medium'); ?>
  					  			<h4><?php the_title(); ?></h4>
  					  			<h6>by <?php echo $playwright; ?></h6>
  					  		</a>
  					  	</div>
  					  	<div class="medium-9 columns">
                  <header class="panel radius text-center">
                    <h3><?php echo the_title(); ?> <i class="fa fa-ellipsis-h"></i> <span class="subheader"><?php echo $playwright; ?></span></h5>
            			  <h6><?php echo $open_text . ' - ' . $close_text; ?> <i class="fa fa-ellipsis-h"></i> <span class="subheader"><?php echo get_post_custom_values('Show Times')[0]; ?></span></h3>
            			  <?php if ($venue == 'Winningstad Theater') {
	            			  $address = '1111 SW Broadway, Portland, OR 97205';
            			  } elseif ($venue == 'CoHo Theater') {
	            			  $address = '2257 NW Raleigh St, Portland, OR 97210';
            			  } else {$address = '';}?>
            			  <h6><?php echo $venue ?> <i class="fa fa-ellipsis-h"></i> <span class="subheader"><?php echo $address ?></h6>
                  </header>
          				<?php
          					// Create arrays of roles in production
          					$roles = get_post_meta( $post->ID, 'Role');
          					$print_actors_3r = array();
          					$print_actors = array();
          					$print_creatives_3r = array();
          					$print_creatives = array();
          					foreach ( $roles as $role ) {
          					  $role_array = explode(' - ', $role);
          					  $role_slug = strtolower( str_replace("'", "", str_replace(' ', '-', $role_array[1]) ) );
          					  $print_name = $role_array[1];
          					  if ( isset($role_array[2]) ) { $role_name = $role_array[2]; }
          					  if ( in_array( $role_slug, $company_members) ) { // Person is Third Rail member
          					  	if ( $role_array[2] === 'Director' ) {
          						  	$print_director = '<li><h6>Director</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - Director - Core Company Member">' . $role_array[1] . '</a> <i class="fa fa-bolt"></i>';
          					  	}
          					  	elseif ( $role_array[2] === 'Playwright' ) {
          						  	$print_playwright = '<li><h6>Playwright</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - Playwright - Core Company Member">' . $role_array[1] . '</a> <i class="fa fa-bolt"></i>';
          					  	}
            					  elseif ( $role_array[0] === 'actor' ) { // Third Rail member is actor
            					    if ( isset($role_array[3]) ) { // Third Rail actor is Equity
              					    $print_name = $role_array[1] . '*';
            					    }
            					    else { // Third Rail actor isn't Equity
              					    $print_name = $role_array[1];
            					    }
            					    $print_actors_3r[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $role_array[1] . ' - ' . $role_array[2] . ' - Core Company Member">' . $print_name . '</a> <i class="fa fa-bolt"></i></li>';
            					  }
            					  elseif ( $role_array[0] === 'creative' ) { // Third Rail member is creative
            					    if ( isset($role_array[3]) ) { // Third Rail creative is Equity
              					    $print_name = $role_array[1] . '*';
            					    }
            					    else { // Third Rail creative isn't Equity
              					    $print_name = $role_array[1];
            					    }
            					    $print_creatives_3r[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - ' . $role_array[2] . ' - Core Company Member">' . $print_name . '</a> <i class="fa fa-bolt"></i></li>';
            					  }
          					  }
          					  else { // Person is guest artist
          					  	if ( $role_array[2] === 'Director' ) {
          						  	$print_director = '<li><h6>Director</h6></li><li><a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - Director - Core Company Member"> ' . $role_array[1] . '</a></li>';
          					  	}
          					  	elseif ( $role_array[2] === 'Playwright' ) {
          						  	$print_playwright = '<li><h6>Playwright</h6></li><li><a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - Playwright - Core Company Member"> ' . $role_array[1] . '</a></li>';
          					  	}
            					  elseif ( $role_array[0] === 'actor' ) { // Guest artist is actor
            					    if ( isset($role_array[3]) ) { // Guest actor is Equity
              					    $print_name = $role_array[1] . '*';
            					    }
            					    else { // Guest actor isn't Equity
              					    $print_name = $role_array[1];
            					    }
            					    $print_actors[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/actor/' . $role_slug . '/" title="' . $role_array[1] . ' - ' . $role_array[2] . ' - guest artist"> ' . $print_name . '</a></li>';
            					  }
            					  elseif ( $role_array[0] === 'creative' ) { // Guest artist is creative
            					    if ( isset($role_array[3]) ) { // Guest creative is Equity
              					    $print_name = $role_array[1] . '*';
            					    }
            					    else { // Guest creative isn't Equity
              					    $print_name = $role_array[1];
            					    }
            					    $print_creatives[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - ' . $role_array[2] . ' - guest artist"> ' . $print_name . '</a></li>';
            					  }
          					  }
          					}
                    sort($print_actors_3r);
          					sort($print_actors);
          					sort($print_creatives_3r);
          					sort($print_creatives);
          					$print_actors_3r = join(' ', $print_actors_3r);
          					$print_actors = join(' ', $print_actors);
          					$print_creatives_3r = join(' ', $print_creatives_3r);
          					$print_creatives = join(' ', $print_creatives);
          				?>
                  <div class="row">
                    <div class="medium-6 columns">
              				<?php if (isset($print_director) and isset($print_playwright) and isset($print_creatives_3r[0]) and isset($print_creatives[0])) { ?>
                				<h5 class="">Creatives</h5>
                				<ul class="creatives small-block-grid-2"><?php echo $print_director . $print_playwright . $print_creatives_3r . $print_creatives; ?></ul>
              				<?php } ?>
                    </div>
                    <div class="medium-6 columns">
              				<?php if (isset($print_actors_3r[0]) or isset($print_actors[0])) { ?>
                				<h5 class="">Cast</h5>
                				<ul class="actors small-block-grid-2"><?php echo $print_actors_3r . $print_actors; ?></ul>
              				<?php } ?>
                    </div>
                  </div>
          				<?php if (isset($print_director[0]) or isset($print_playwright[0]) or isset($print_actors_3r[0]) or isset($print_actors[0]) or isset($print_creatives_3r[0]) or isset($print_creatives[0])) { ?>
                    <p class="text-center"><small><i class="fa fa-bolt"></i> Third Rail core company member &nbsp; * Member of Actors Equity Association</small></p>
          				<?php } ?>
  					  	</div>
  					  	<div class="row>">
  					  	  <div class="large-12 columns">
                		<?php
                			$directory = '/home1/thirdrai/public_html/wp-content/themes/tr/assets/img/season-9/' . $post->post_name . '/';
                			$images = glob($directory . "*-small.jpg");
                			$imgCount = count($images);
                			if ($imgCount > 0) {
                				echo '<ul class="large-block-grid-6 medium-block-grid-4 small-block-grid-3" data-clearing>';
                				foreach($images as $image) {
                					$thumb = str_replace('/home1/thirdrai/public_html', get_site_url() , $image);
                					$image = str_replace('-small', '', $thumb);
                				  echo '<li><a href="' . $image . '" class="th" title=""><img src="' . $thumb . '" alt="" data-caption="Photo by Owen Carey"></a></li>';
                				}
                				echo '</ul>';
                			}
                		?>
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

