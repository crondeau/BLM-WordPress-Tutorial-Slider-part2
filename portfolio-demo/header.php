<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php wp_title() ?></title> 
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/favicon.ico" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<?php if (is_single()) { ?>
<script>
	jQuery(document).ready(function($){
		$('#slideshow').slides({
			preload: true,
			preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.gif',
			effect: 'fade',
			play:3000,
			crossfade: true,
			fadeSpeed: 500,
			generatePagination: false

		});
	});
</script>
<?php }?>
<?php if (is_front_page()) { ?>
<script>
	jQuery(document).ready(function($){
		$('#slides').slides({
			preload: true,
			preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.gif',
			play: 5000,
			pause: 2500,
			hoverPause: true,
			generatePagination: false
			
		});
	});
</script>
<?php } ?>

</head>
<body <?php body_class(); ?>>
<div id="wrap">
	<header id="branding">
		<div id="logo"><a href="<?php echo home_url() ?>"><?php bloginfo('name'); ?></a></div>
		<nav id="top_nav">
			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
		</nav>
	</header>