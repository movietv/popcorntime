<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="UTF-8">
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="x-dns-prefetch-control" content="on">
<link rel="dns-prefetch" href="//ajax.googleapis.com">
<link rel="dns-prefetch" href="//image.tmdb.org">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link rel="dns-prefetch" href="//www.google-analytics.com">
<link rel="dns-prefetch" href="//s.ytimg.com">
<link rel="dns-prefetch" href="//www.youtube.com">
<?php wp_head(); ?>
<?php if(is_single()){ ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/app.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/media.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/movie.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lightbox.css">
<?php }else{ ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/app.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/media.css">
<?php } ?>
<?php if(is_single()){ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/lightbox/lightbox.js"></script>
<?php }else{ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/scroll/jquery-ias.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scroll/callbacks.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/scroll/spinner.js"></script>
<?php } ?>
</head>
<body class="">
<div id="header">
<div id="toolbar" class="nav sections">
<?php if ( is_category(tvseries) ) { ?><div class="btn movies"><?php } else { ?><div class="btn movies activated"><?php } ?>
<div class="icon2 film"></div>
<span><?php echo movies; ?></span>
</div>
<?php if ( is_category(tvseries) ) { ?><div class="btn tv activated"><?php } else { ?><div class="btn tv"><?php } ?>
<div class="icon2 tv"></div>
<span><?php echo tvshows; ?></span>
</div>
</div>
<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="logo"><?php bloginfo('name'); ?></a></h1>
<div id="menu_panel">
<div class="icon info" onclick="window.location.href='<?php echo esc_url( home_url( '/' ) ); ?>about/'"></div>
<div class="icon unlocked vpn" onclick="window.location.href='<?php echo esc_url( home_url( '/' ) ); ?>privacy/'"></div>
<div class="icon heart favs" onclick="window.location.href='<?php echo esc_url( home_url( '/' ) ); ?>favorites/'"></div>
<?php get_template_part('searchform'); ?>
</div>
</div>