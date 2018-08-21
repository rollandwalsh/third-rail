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
<script>

	$('#membershipJoin').on('click', function (e) {
  	e.preventDefault();
		$(this).replaceWith('<a href="https://thirdrailrep.secure.force.com/ticket#membership_a0So0000002BughEAC" class="button success large">$352/year</a> <a href="https://thirdrailrep.secure.force.com/donate/?dfId=a0no000000HByN7AAL" class="button success large">$29.33/month</a>');
	});	
</script>