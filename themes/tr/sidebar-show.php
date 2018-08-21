	<aside id="sidebar" class="medium-4 small-12 columns" data-equalizer-watch>
		<?php dynamic_sidebar("sidebar-widgets"); ?>
	
		<article id="showDetails" class="row widget">
			<div class="large-12 columns text-center">
				<?php
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
					
					// Create arrays of roles in production
					$roles = get_post_meta( $post->ID, 'Role');
					$print_director = array();
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
						  	$print_director[] = '<a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - Director - Core Company Member" class="button radius"><i class="fa fa-bolt"></i> ' . $role_array[1] . '</a>';
					  	}
					  	elseif ( $role_array[2] === 'Playwright' ) {
						  	$print_playwright = '<a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - Playwright - Core Company Member" class="button radius"><i class="fa fa-bolt"></i> ' . $role_array[1] . '</a>';
					  	}
					  	elseif ( $role_array[0] === 'actor' ) { // Third Rail member is actor
  					      if ( isset($role_array[3]) ) { // Third Rail actor is Equity
    					    $print_name = $role_array[1] . '*';
  					      }
  					      else { // Third Rail actor isn't Equity
    					    $print_name = $role_array[1];
  					      }
  					      $print_actors_3r[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $role_array[1] . ' - ' . $role_array[2] . ' - Core Company Member" class="tiny round button"><i class="fa fa-bolt"></i> ' . $print_name . '</a></li>';
  					    }
  					    elseif ( $role_array[0] === 'creative' ) { // Third Rail member is creative
  					      if ( isset($role_array[3]) ) { // Third Rail creative is Equity
    					    $print_name = $role_array[1] . '*';
  					      }
  					      else { // Third Rail creative isn't Equity
    					    $print_name = $role_array[1];
  					      }
  					      $print_creatives_3r[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/core-company/' . $role_slug . '/" title="' . $print_name . ' - ' . $role_array[2] . ' - Core Company Member" class="tiny round button"><i class="fa fa-bolt"></i> ' . $print_name . '</a></li>';
  					    }
					  }
					  else { // Person is guest artist
					  	if ( $role_array[2] === 'Director' ) {
						  	$print_director[] = '<a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - Director - Core Company Member" class="button secondary radius"><i class="fa fa-user"></i> ' . $role_array[1] . '</a>';
					  	}
					  	elseif ( $role_array[2] === 'Playwright' ) {
						  	$print_playwright = '<a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - Playwright - Core Company Member" class="button secondary radius"><i class="fa fa-user"></i> ' . $role_array[1] . '</a>';
					  	}
  					  elseif ( $role_array[0] === 'actor' ) { // Guest artist is actor
  					    if ( isset($role_array[3]) ) { // Guest actor is Equity
    					    $print_name = $role_array[1] . '*';
  					    }
  					    else { // Guest actor isn't Equity
    					    $print_name = $role_array[1];
  					    }
  					    $print_actors[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/actor/' . $role_slug . '/" title="' . $role_array[1] . ' - ' . $role_array[2] . ' - guest artist" class="tiny round secondary button"><i class="fa fa-user"></i> ' . $print_name . '</a></li>';
  					  }
  					  elseif ( $role_array[0] === 'creative' ) { // Guest artist is creative
  					    if ( isset($role_array[3]) ) { // Guest creative is Equity
    					    $print_name = $role_array[1] . '*';
  					    }
  					    else { // Guest creative isn't Equity
    					    $print_name = $role_array[1];
  					    }
  					    $print_creatives[] = '<li><h6>' . $role_array[2] . '</h6></li><li><a href="' . get_site_url() . '/creative/' . $role_slug . '/" title="' . $print_name . ' - ' . $role_array[2] . ' - guest artist" class="tiny round secondary button"><i class="fa fa-user"></i> ' . $print_name . '</a></li>';
  					  }
					  }
					}
					sort($print_actors_3r);
					sort($print_actors);
					sort($print_creatives_3r);
					sort($print_creatives);
					$print_director = join(' ', $print_director);
					$print_actors_3r = join(' ', $print_actors_3r);
					$print_actors = join(' ', $print_actors);
					$print_creatives_3r = join(' ', $print_creatives_3r);
					$print_creatives = join(' ', $print_creatives);
				?>
				<?php if (isset($print_director)) { ?>
  				<h4 class="">Directed by</h4>
  				<?php echo $print_director; ?>
				<?php } ?>
				<?php if (isset($print_playwright)) { ?>
  				<h4 class="">Written by</h4>
  				<?php echo $print_playwright; ?>
				<?php } ?>
				<?php if (isset($print_actors_3r[0]) or isset($print_actors[0])) { ?>
  				<h4 class="">Cast</h4>
  				<ul class="actors large-block-grid-2 medium-block-grid-1 small-block-grid-2"><?php echo $print_actors_3r . $print_actors; ?></ul>
				<?php } ?>
				<?php if (isset($print_creatives_3r[0]) or isset($print_creatives[0])) { ?>
  				<h4 class="">Creative</h4>
  				<ul class="creatives large-block-grid-2 medium-block-grid-1 small-block-grid-2"><?php echo $print_creatives_3r . $print_creatives; ?></ul>
				<?php } ?>
				<?php if (isset($print_director[0]) or isset($print_playwright[0]) or isset($print_actors_3r[0]) or isset($print_actors[0]) or isset($print_creatives_3r[0]) or isset($print_creatives[0])) { ?>
          <p><small><i class="fa fa-bolt"></i> Third Rail core company member<br><i class="fa fa-user"></i> Guest Artist<br>* Member of Actors Equity Association</small></p>
				<?php } ?>

			</div>
		</article>
		
		<script>
			$(function() {
				$('.tags a').addClass('tiny round secondary button');
			});
		</script>
	</aside>
