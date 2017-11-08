<div class="top-bar-container contain-to-grid show-for-medium-up" role="navigation">
	<nav class="top-bar" data-topbar="">
	  <ul class="title-area">
	    <li class="name">
	      <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
	    </li>
	  </ul>
	  <section class="top-bar-section">
      <?php foundationPress_top_bar_l(); ?>
      <?php foundationPress_top_bar_r(); ?>
      <ul class="right">
      	<li class="has-form">
					<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
						<?php do_action('foundationPress_searchform_top'); ?>
						<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'FoundationPress'); ?>">
						<?php do_action('foundationPress_searchform_before_search_button'); ?>
						<?php do_action('foundationPress_searchform_after_search_button'); ?>
					</form>
      	</li>
      </ul>
    </section>
  </nav>
</div>