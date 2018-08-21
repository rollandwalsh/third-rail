<?php /* Template Name: Special */ get_header(); ?>
<style>
	@media screen and (min-width: 1025px) {
    #twentyFourDays li {height: 250px}
	}
	@media screen and (max-width: 1025px) and (min-width: 640px) {
    #twentyFourDays li {height: 320px}
	}
	@media screen and (max-width: 640px) {
    #twentyFourDays li {height: 300px}
	}
  #twentyFourDays li {position: relative}
  #twentyFourDays li.current div:first-child {cursor: pointer}
  #twentyFourDays li:not(.current) {opacity: .25}
  #twentyFourDays li div {position: absolute}
  #twentyFourDays li div:last-child {z-index: -1}
</style>

<div class="row">
	<div class="small-12 columns" role="main">

	<?php do_action('foundationPress_before_content'); ?>

	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title hide"><?php the_title(); ?></h1>
			</header>
			<?php do_action('foundationPress_page_before_entry_content'); ?>
			<div class="entry-content">
				<?php the_content(); ?>
				<ul id="twentyFourDays" class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
					<?php
						$date = 24;
						$iteration = 1;

						for ($x = $date; $x > 0; $x--) { ?>
							<li class="current"><div><img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/24-days-of-giving/<?php echo $x ; ?>-0.png"></div><div><img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/24-days-of-giving/<?php echo $x ; ?>-1.png"></div></li>
							<?php $iteration++;
						}
						for ($x = $iteration; $x <= 24; $x++) { ?>
							<li><div><img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/24-days-of-giving/<?php echo $x ; ?>-0.png"></div><div><img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/24-days-of-giving/<?php echo $x ; ?>-1.png"></div></li>
						<?php }
					?>
        </ul>
			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</footer>
		</article>
	<?php endwhile;?>

	<?php do_action('foundationPress_after_content'); ?>
<div class="text-center">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_donations"><input type="hidden" name="business" value="scott@thirdrailrep.org"><input type="hidden" name="lc" value="US"><input type="hidden" name="item_name" value="Third Rail Repertory Theatre"><input type="hidden" name="no_note" value="0"><input type="hidden" name="currency_code" value="USD"><input type="hidden" name="bn" value="PP-DonationsBF:donate-button-big.png:NonHostedGuest"><input type="image" src="http://thirdrailrep.org/wp-content/themes/tr/assets/img/donate-button-big.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
	</div>
</div>
    
<script>
  $('#twentyFourDays li.current div:first-child img').on('click', function() {
    $(this).fadeOut();
  });
</script>
<?php get_footer(); ?>
