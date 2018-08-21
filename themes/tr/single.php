<?php get_header(); ?>
<div class="row">
	<div class="small-12 columns" role="main">
		<?php the_breadcrumb(); ?>

  	<?php do_action('foundationPress_before_content'); ?>
  
  	<?php while (have_posts()) : the_post(); ?>
  		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
  			<header>
  				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
  				<h4 class="subheader"><?php echo get_post_custom_values('Subtitle')[0]; ?></h4>
  			</header>
        
  		  <?php
  			  if (isset( get_post_custom_values('Parent Show')[1]) and get_post_custom_values('Close Date', get_page_by_title(get_post_custom_values('Parent Show')[1])->ID)[0] >= date('Y-m-d') ) {
  				  $parentID = get_page_by_title(get_post_custom_values('Parent Show')[0])->ID;
  					$parent2ID = get_page_by_title(get_post_custom_values('Parent Show')[1])->ID;
  			?>
  					<div class="row">
  						<div class="medium-6 columns">
  							<a href="<?php echo get_post_meta($parentID, 'Tickets URL', true); ?>" class="button success expand"><i class="fa fa-ticket fa-lg"></i> <?php echo get_post_custom_values('Parent Show')[0]; ?> Tickets</a>
  						</div>
  						<div class="medium-6 columns">
  							<a href="<?php echo get_post_meta($parent2ID, 'Tickets URL', true); ?>" class="button success expand"><i class="fa fa-ticket fa-lg"></i> <?php echo get_post_custom_values('Parent Show')[1]; ?> Tickets</a>
  						</div>
  					</div>
  			<?php
  				} else if ( isset(get_post_custom_values('Parent Show')[0]) and get_post_custom_values('Close Date', get_page_by_title(get_post_custom_values('Parent Show')[0])->ID)[0] >= date('Y-m-d') ) {
  			  	$parentID = get_page_by_title(get_post_custom_values('Parent Show')[0])->ID;
  			?>
  					<div class="text-center"><a href="<?php echo get_post_meta($parentID, 'Tickets URL', true); ?>" class="button success"><i class="fa fa-ticket fa-lg"></i> <?php echo get_post_custom_values('Parent Show')[0]; ?> Tickets</a></div>
  			<?php } ?>
  			
  			<?php do_action('foundationPress_post_before_entry_content'); ?>
  			<div class="entry-content">
    			<?php the_content(); ?>
  			</div>
  			<footer>
  				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' ));
          if (isset(get_post_custom_values('Parent Show')[0]) and get_post_custom_values('Tickets URL')[0]) { ?>
        		<div class="row">
        		  <?php if ( get_post_custom_values('Close Date', $parentID)[0] >= date('Y-m-d') ) { ?>
          		  <div class="medium-6 columns">
          		    <a href="<?php echo get_site_url(); ?>/<?php echo sanitize_title(get_post_custom_values('Parent Show')[0]); ?>/" class="button expand"><i class="fa fa-info fa-lg"></i> More Info</a>
          		  </div>
          		  <div class="medium-6 columns">
                  <a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" class="button success expand"><i class="fa fa-ticket fa-lg"></i> Tickets</a>
          		  </div>
              <?php } else { ?>
          		  <div class="medium-6 medium-centered columns">
          		    <a href="<?php echo get_site_url(); ?>/<?php echo sanitize_title(get_post_custom_values('Parent Show')[0]); ?>/" class="button expand"><i class="fa fa-info fa-lg"></i> More Info</a>
          		  </div>
              <?php } ?>
        		</div>
      		<?php } ?>
  			  <div class="text-center">
  				  <a href="mailto:?subject=<?php the_title(); ?> - Third Rail Repertory Theater&amp;body=Take a look at this article from Third Rail - <?php the_permalink(); ?>" title="Share by Email" class="button tiny radius" style="vertical-align:top"><i class="fa fa-envelope"></i> Email</a> &nbsp; <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="vertical-align:super"></div> &nbsp; <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  			  </div>
      		<?php $tag = get_the_tags(); if (!$tag) { } else { the_tags('<p class="tags text-center">', ' ', '</p>' ); } ?>
  			</footer>
  		</article>
  	<?php endwhile;?>
  
  	<?php do_action('foundationPress_after_content'); ?>

	</div>
</div>
<?php get_footer(); ?>
