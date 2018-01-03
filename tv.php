<?php 
/*
Template Name Posts: tv
*/
?>
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
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/app.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/media.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/tv.css">
</head>
<body>
<div id="header">
<div id="toolbar" class="nav sections">
<div class="btn movies">
<div class="icon2 film"></div>
<span><?php echo movies; ?></span>
</div>
<div class="btn tv activated">
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
<?php if (have_posts()) : while (have_posts()) : the_post(); include("meta/meta_series.php"); ?>
<div id="slider_tvshow" class="slider fadein tvshow" style="top: 0px; opacity: 1;">
<div class="close"></div>
<div id="slideshow">
<div class="backdrop">
<div class="backdrop_img">
<div class='img' style='opacity:0.2;display:block;background-image: url(<?=$FakeBackdrop?>);'></div>
</div>
</div>
</div>
<div class="head">
<div class="incont">
<div class="poster_path"></div>
<div class="info_cont">
<h1 style="margin: 0;" class="title">
<?php the_title(); ?>
<br>
<div class="subtitle" style="font-size: 40%;">&nbsp;</div>
</h1>
<div class="title_info_cont">
<div class="title_info genre"><?php $category = get_the_category(); if ( $category[0] ) { echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>'; } ?></div>
<div class="title_info runtime_cont" style="display: block;"><span class="icon2 time"></span><span class="runtime"><?=$Runtime?> min</span></div>
<div class="title_info"><span class="icon2 date"></span> &nbsp;<span class="year">&nbsp;<?=$Year?></span></div>
<div class="title_info containerstar">
<a href="<?=$IMDbUrl ?>" rel="external nofollow" target="_blank">
<div class="star" title="<?=$imdbRating ?> / 10">
<div class="starcontainer">
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
</div>
<?php if(empty($imdbRating)){$Ratingstar = "0";}else{$Ratingstar = $imdbRating*10;} ?>
<div class="starcontainer2" style="width:<?=$Ratingstar ?>%">
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
<i class="fa fa-star-o"></i>
</div>
</div>
</a>
</div>
<div class="title_info"><?php edit_post_link( __(''), '', '', 0, 'fa fa-pencil' ); ?></div>
</div>
<div class="synopsis fadein"><?=$Plot?>&hellip;</div>
</div>
</div>
</div>
<div class="body">
<div class="column seasons"></div>
<div class='column episodes' style="overflow: auto;"></div>
<div class='column content'></div>
<script>
var genre = "<?php echo esc_url( home_url( '/' ) ); ?><?php echo genre; ?>/<?php echo tvseries; ?>/";
window.onload = function () {
seriesInfo(<?php if($values = get_post_custom_values("id")) { ?><?php echo $values[0]; ?><?php } ?>,1);
seriesShow(<?php if($values = get_post_custom_values("id")) { ?><?php echo $values[0]; ?><?php } ?>,1,1);};
var Home = "<?php echo esc_url( home_url( '/' ) ); ?>",
Excerpt = <?php echo json_encode(substr(get_the_excerpt(), 0,450)); ?>,
episodeSlug = "<?php echo episode; ?>",
seasonSlug = "<?php echo season; ?>",
PosterNull = "<?=$poster_path?>",
baseUrl = "https://api.themoviedb.org/3/tv/",
apikey = "?api_key=<?php echo apikey; ?>",
language = "&language=<?php echo apilanguage; ?>",
ImgLang = "&include_image_language=<?php echo apilanguage; ?>,null",
appendToResponse = "&append_to_response=images",
id = <?php if($values = get_post_custom_values("id")) { ?><?php echo $values[0]; ?><?php } ?>,
dataUrl = baseUrl + id + apikey + language + ImgLang + appendToResponse;
function seriesShow(e, s, a) {
    var i = baseUrl + e + "/season/" + s + "/episode/" + a + apikey + language + ImgLang;
    $.getJSON(i, function(e) {
        $(".content").empty();
        var a = e.name,
            i = e.episode_number;
        "" === a && (a = "" + episodeSlug + "&nbsp;" + i);
        var o = e.overview;
        e.still_path;
        $(".content").append("<div class='episode_name'>" + a + "</div><div class='episode_info'><b class='episode_number'>" + episodeSlug + " " + i + "</b></div><div class='episode_overview'>" + o + "<br/><br/><div class='openload" + s + "_" + i + "'><br/></div></div>"), $(".subtitle").empty(), $(".subtitle").append("<span>" + seasonSlug + " " + s + " " + episodeSlug + " " + i + " : " + a + "</span>");
		<?php get_template_part( 'watch/series' ); ?>
    })
};
$(".icon2.film").click(function(){
window.location.href=Home});
$(".icon2.tv").click(function(){
window.location.href=genre});
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/api/tv.js"></script>
<?php endwhile; else : endif; wp_footer(); ?>
</body>
</html>