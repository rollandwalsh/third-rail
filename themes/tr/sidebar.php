<?php do_action('foundationPress_before_sidebar'); ?>
<?php
if (isset($post->ID)) {
  $currentPost = $post->ID;
} else {
  $currentPost = 0;
}
$show = get_the_title();
$args = array(
	'post_type' 			=> 'post',
  'posts_per_page' 	=> 5,
  'order' 					=> 'DSC',
  'post__not_in'    => array($currentPost)
);
 
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>
<aside id="sidebar" class="small-12 large-4 columns" data-equalizer-watch>
  <h4 class="text-center">Recent News</h4>
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
  <div class="row">
  	<div class="small-12 columns card">
  		<a href="<?php  the_permalink(); ?>" title="<?php the_title(); ?>" class="th">
  			<?php the_post_thumbnail('header-medium'); ?>
  			<h4><?php the_title(); ?></h4>
  		</a>
  	</div>
  </div>
	<?php endwhile;
	wp_reset_postdata(); ?>
	<?php dynamic_sidebar("sidebar-widgets"); ?>
	<?php do_action('foundationPress_after_sidebar'); ?>
</aside>
<?php endif ?>
