<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h2 class="entry-title text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<h4 class="subheader"><?php echo get_post_custom_values('Subtitle')[0]; ?></h4>
	</header>
	<div class="entry-content">
		<?php the_content(__('Continue reading...', 'FoundationPress')); ?>
	</div>
	<footer>
		<?php
			if (isset(get_post_custom_values('Parent Show')[0]) and isset(get_post_custom_values('Tickets URL')[0])) { 
				$parentID = get_page_by_title(get_post_custom_values('Parent Show')[0])->ID; ?>
	  		<div class="row">
	  		  <?php if ( get_post_custom_values('Close Date', $parentID)[0] >= current_time('mysql') ) { ?>
	    		  <div class="medium-6 columns">
	    		    <a href="<?php echo get_site_url() . "/" . sanitize_title(get_post_custom_values('Parent Show')[0]); ?>/" class="button expand"><i class="fa fa-info fa-lg"></i> More Info</a>
	    		  </div>
	    		  <div class="medium-6 columns">
	            <a href="<?php echo get_post_custom_values('Tickets URL')[0]; ?>" class="button success expand"><i class="fa fa-ticket fa-lg"></i> Tickets</a>
	    		  </div>
	        <?php } else { ?>
	    		  <div class="medium-6 medium-centered columns">
	    		    <a href="<?php echo get_site_url() . "/" . get_post_custom_values('Parent Show')[0]; ?>/" class="button expand"><i class="fa fa-info fa-lg"></i> More Info</a>
	    		  </div>
	        <?php } ?>
	  		</div>
			<?php }		
	    $tag = get_the_tags(); if (!$tag) { } else { the_tags('<p class="tags text-center">', ' ', '</p>' ); } 
    ?>
	</footer>
</article>
