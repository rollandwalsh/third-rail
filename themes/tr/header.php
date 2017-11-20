<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<title><?php if ( is_category() ) {
			echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_tag() ) {
			echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(''); echo ' Archive | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Search for &quot;'.esc_html($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
		}  elseif ( is_404() ) {
			echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} elseif ( is_single() ) {
			wp_title('');
		} else {
			echo wp_title( ' | ', 'false', 'right' ); bloginfo( 'name' );
		} ?></title>
		
		<meta property="og:title" content="<?php echo get_the_title(); ?> | <?php bloginfo('name'); ?>"> 
    <meta property="og:url" content="<?php echo get_permalink(); ?>">
    <?php if ( has_post_thumbnail( ) ) { ?>
      <meta property="og:image" content="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>">
    <?php } else { ?>
      <meta property="og:image" content="<?php echo get_stylesheet_directory_uri() . "/assets/img/logo.png"; ?>">
    <?php } ?>
		
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ; ?>/css/app.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">

		<link rel="icon" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/apple-touch-icon-144x144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/apple-touch-icon-114x114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/apple-touch-icon-72x72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/icons/apple-touch-icon-precomposed.png">
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
  	<?php do_action('foundationPress_after_body'); ?>
  	
  	<div class="off-canvas-wrap" data-offcanvas>
    	<div class="inner-wrap">
    	
      	<?php do_action('foundationPress_layout_start'); ?>

      	
      	<nav class="tab-bar show-for-small-only">
      		<section class="left-small">
      			<a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
      		</section>
      		<section class="middle tab-bar-section">
      			<a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/logo.png" alt="<?php bloginfo( 'name' ); ?>">
      		</section>
      		<section class="right-small">
      		  <a href="tel:15032351101" title="Call the Third Rail Box Office" class="phone-icon"><i class="fa fa-phone"></i></a>
      		</section>
      	</nav>
      
      	<?php get_template_part('parts/off-canvas-menu'); ?>
      
      	<?php get_template_part('parts/top-bar'); ?>
      	
        <?php
          if (isset($post->ID)) {
            if (has_post_thumbnail($post->ID)) {
              $fullhero = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full')[0];
      				$largehero = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'header-xlarge')[0];
      				$mediumhero = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'header-large')[0];
      				$smallhero = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'header-medium')[0];
      		  }
      		}
      		if (isset($fullhero) or isset($largehero)) {
        ?>

      		<header id="pageHeader">
	      		<?php if ( is_front_page() ) {?>
	      			<a href="/men-on-boats" style="display: block"><img src="<?php echo $largehero; ?>" alt="2017/2018 Season" id="hero"></a>
	      		<?php } else { ?>
	      			<img src="<?php echo $largehero; ?>" alt="<?php wp_title(); ?> Hero" id="hero">
	      		<?php } ?>
				</header>
    		<?php } else { ?>
      		<header style="position: relative">
	      		
      		</header>
    		<?php }	?>
      
      <section class="container" role="document">
      	<?php do_action('foundationPress_after_header'); ?>
      	<div class="text-center" style="padding: 8px 0"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/img/logo.png" class="show-for-medium-up"></a></div>
      	<hr class="dashed">