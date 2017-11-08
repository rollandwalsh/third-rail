<?php /* Template Name: Core Company */ get_header(); ?>

<div class="row" data-equalizer>
	<div class="small-12 columns" role="main" data-equalizer-watch>

  	<?php do_action('foundationPress_before_content'); ?>
		<?php the_breadcrumb(); ?>
  
  	<?php while (have_posts()) : the_post(); ?>
  		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
  			<header>
  				<h1 class="entry-title text-center"><?php the_title(); ?></h1>
  			</header>
  			<?php do_action('foundationPress_page_before_entry_content'); ?>
  			<div class="entry-content">
  				<?php the_content();   				
    				// Create array of current company members
  				  $company_args = array(
  				    'post_parent'       => 46,
  				    'post_type'         => 'page',
  				    'posts_per_page'    => 50,
  				    'orderby'           => 'rand'
  				  );
  					$company_query = new WP_Query( $company_args );
  					$company_posts = $company_query->get_posts();
  					$company_members = array();
  					foreach($company_posts as $post) {
  					  $arr = array(get_the_title(), basename( get_permalink() ), get_permalink());
  						array_push( $company_members, $arr );
  					}
  					wp_reset_query();
  				?>
  					
					<ul class="small-block-grid-2 medium-block-grid-4 large-block-grid-5">
					
					<?php foreach ( $company_members as $arr ) { ?>
					  <li class="card">
				  		<a href="<?php echo $arr[2] ?>" title="<?php echo $arr[0]; ?>" class="th">
				  			<img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/company/<?php echo $arr[1]; ?>.jpg" alt="<?php echo $arr[0]; ?>">
				  			<h4><?php echo $arr[0]; ?></h4>
				  		</a>
					  </li>
					<?php } ?>
					</ul>
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
