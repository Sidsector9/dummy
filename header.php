<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Keynote
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link href="https://fonts.googleapis.com/css?family=Raleway:600,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<script src="https://use.fontawesome.com/64ea4760bf.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="row">
			<div class="site-branding large-3 small-12 column">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( get_header_image() ); ?>" alt="<?php echo get_bloginfo( 'title' ); ?>" />
				</a>
				<div class="ham-menu">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div><!-- .site-branding -->

			<div class="large-9 small-12 column">
				<nav id="site-navigation" class="main-navigation">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
				</nav><!-- #site-navigation -->
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
