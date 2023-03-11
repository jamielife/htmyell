<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-K8LBR7N');</script>
		<!-- End Google Tag Manager -->		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>
			<?php
				if ( is_category() ) {
					echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
				} elseif ( is_tag() ) {
					echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
				} elseif ( is_archive() ) {
					wp_title( '' ); echo ' Archive | '; bloginfo( 'name' );
				} elseif ( is_search() ) {
					echo 'Search for &quot;'.esc_html( $s ).'&quot; | '; bloginfo( 'name' );
				} elseif ( is_home() || is_front_page() ) {
					bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
				} elseif ( is_404() ) {
					echo 'Error 404 Not Found | '; bloginfo( 'name' );
				} elseif ( is_single() ) {
					wp_title( '' );
				} else {
					echo wp_title( ' | ', 'false', 'right' ); bloginfo( 'name' );
				}
			?>
		</title>
		<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icons/favicon.png" type="image/x-icon">
		<meta name="p:domain_verify" content="4b70687dcccf842f96f03cb3d6602871"/>		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K8LBR7N"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->		
		<?php do_action( 'foundationpress_after_body' ); ?>
	
		<div class="off-canvas-wrap" data-offcanvas>
		<div class="inner-wrap">
		
		<?php do_action( 'foundationpress_layout_start' ); ?>
	    <header id="logo-container" class="top-bar-container show-for-medium-up">
	        <div id="logo" class="">
	            <a href="/"><img src="<?php bloginfo( 'template_url' ); ?>/assets/img/header-image.jpg" alt="Htmyell Design & Development Logo" /></a>
	        </div>
	    </header>
		<nav class="tab-bar">
			<section class="left-small">
				<a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
			</section>
			<section class="middle tab-bar-section">
	
				<h1 class="title">
					<?php bloginfo( 'name' ); ?>
				</h1>
	
			</section>
		</nav>
	
		<?php get_template_part( 'parts/off-canvas-menu' ); ?>
	
		<?php get_template_part( 'parts/top-bar' ); ?>
	
		<section class="container" role="document">
		<?php do_action( 'foundationpress_after_header' ); ?>
