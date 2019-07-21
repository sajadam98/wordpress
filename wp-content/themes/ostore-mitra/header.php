<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oStore
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class('cms-index-index cms-home-page home'); ?>>
<div id="page" class="site">
		<!-- Header -->
		<header id="header" class="sticky-style-2 navbar-in-header">
			<?php do_action('ostore_top_header'); ?>
			<div id="header-wrap">
				<?php do_action('ostore_main_nav_menu'); ?>
			</div>
			<?php if (get_header_image()) : ?>
			<div class="header-image">
				<img src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
			</div>
			<?php endif; ?> 
		</header><!-- Osotre header end -->
	
	<div id="content" class="">