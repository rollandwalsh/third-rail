<?php /* Template Name: Home */ get_header(); ?>


<div class="row">
	<div class="large-12 columns">
		<?php the_content(); ?>
	</div>
</div>

<?php get_sidebar('home'); ?>

<!--
<div class="row">
	<div class="large-12 columns" role="main">

	<?php do_action('foundationPress_before_content'); ?>

  <?php query_posts( array ( 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC' ) ); ?>
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

			<?php do_action('foundationPress_page_before_entry_content'); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php if (isset(get_post_custom_values('Parent Show')[0]) and get_post_custom_values('Tickets URL')[0]) { ?>
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
        		    <a href="<?php echo get_site_url(); ?>/<?php echo get_post_custom_values('Parent Show')[0]; ?>/" class="button expand"><i class="fa fa-info fa-lg"></i> More Info</a>
        		  </div>
            <?php } ?>
      		</div>
    		<?php } ?>
			  <div class="text-center">
				  <a href="mailto:?subject=<?php the_title(); ?> - Third Rail Repertory Theater&amp;body=Take a look at this article from Third Rail - <?php the_permalink(); ?>" title="Share by Email" class="button tiny radius" style="vertical-align:top"><i class="fa fa-envelope"></i> Email</a> &nbsp; <div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="vertical-align:super"></div> &nbsp; <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			  </div>
				<?php $tag = get_the_tags(); if (!$tag) { } else { the_tags('<p class="tags text-center">', ' ', '</p>' ); } ?>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
			</footer>
		</article>
	<?php endwhile;?>
	<?php wp_reset_query(); ?>

	<?php do_action('foundationPress_after_content'); ?>
	</div>
</div>
	
<hr class="dashed">
-->

<div class="row cards" data-equalizer>
  <?php $pages = get_pages( array( 'include' => array( 1634, 197, 50 ) ) ); ?> 
	<?php foreach ( $pages as $page ) : ?>
		<div class="medium-4 columns card" data-equalizer-watch>
		  <a href="<?php echo get_permalink($page); ?>" title="<?php echo $page->post_title; ?>" class="th">
  			<?php echo get_the_post_thumbnail( $page->ID, 'header-medium' ); ?>
  			<h4><?php echo $page->post_title; ?></h4>
		  </a>
		</div>
	<?php endforeach; ?>
</div>

<div id="giftTheatre" class="reveal-modal text-center" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">  
	<h2 id="modalTitle">Give the Gift of Theatre!</h2>
	<p class="lead">It's local, sustainable, and (yes) gluten free...</p>
	
	<img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/third-rail-company-2016.jpg" alt="Give the Gift of Theatre">
	
	<p>Let's work together this holiday season to give gifts that excite, entertain and awaken the artistic senses.<br>Give an experience. Give the gift of theatre.</p>
	
	<p>Now until December 31st you can give your loved ones a GIFT MEMBERSHIP, which includes unlimited access to everything Third Rail produces through March 31, 2016. That’s over 3 months of Main Stage, NT Live, Wild Card productions, Bloody Sunday readings, and much more... for only $90!</p>
	
	<p>With so much going on, it's the perfect time to be generous!<br>Gift Memberships and Gift Certificates available through the Box Office.</p>
	
	<p class="lead">Call <a href="tel:15032351101">503-235-1101</a> or email <a href="mailto:boxoffice@thirdrailrep.org">boxoffice@thirdrailrep.org</a>.
	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<?php get_footer(); ?>

<script>
/*
	$(function() {
		$('#giftTheatre').foundation('reveal','open');
	});
*/
</script>
