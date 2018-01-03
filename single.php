<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); include("meta/meta_movies.php"); ?>
<?php include("watch/share.php"); ?>
<div id="slider_movie" class="slider fadein movie" style="top: 0px; opacity: 1;">
<style>#player{background-image: url('<?=$fakePlayer?>');}</style>
<div class="close"></div>
<div id="slideshow">
<div class="backdrop">
<div class="backdrop_img">
<div class='img' style='opacity:0.2;display:block;background-image: url(<?=$Backdrop?>);'></div>
</div>
</div>
</div>
<div class="bottom_toolbox"></div>
<?php include("watch/movies.php"); ?>
<div class="movie_cont">
<div class="incont">
<img class="poster_img fadein" src="<?php if($values = get_post_custom_values("poster_path")) { ?><?=$poster_path?><?php } else { ?><?=$poster_null?><?php } ?>">
<div class="content">
<h1 style="margin: 0;" class="title"><?php the_title(); ?></h1>
<div class="title_info_cont">
<div class="title_info genre"><?php $category = get_the_category(); if ( $category[0] ) { echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>'; } ?></div>
<div class="title_info year"><span class="icon2 date"></span> &nbsp;<?=$Year?></div>
<div class="title_info runtime"><span class="icon2 time"></span> <span class="runtime"><?=$Runtime?> min</span></div>
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
</div><?php edit_post_link( __('<div class="title_info">'), '&nbsp;&nbsp;', '</div>', 0, 'fa fa-pencil' ); ?>
</div>
<div class="synopsis fadein"><?=$Plot?>&hellip;</div>
<div class="actors"></div>
</div>
</div>
</div>
</div>
<script>
//var soundUrl = "http://thesoundtrackdb.com/titles?q=<?=$originalTitle ?>+&limit=1";
var watch = "http://lpg02.com/it/filmhdme/";
var site = "<?php echo esc_url( home_url() ); ?>";
var apiUrl = "https://api.themoviedb.org/3/movie/";
var apiKey = "<?php echo apikey; ?>";
var movie = <?php $values = get_post_custom_values("id"); echo $values[0]; ?>;
var response = "credits";
var actPerm = "<?php echo actors; ?>";
var dirPerm = "<?php echo director; ?>";
var tmdb=apiUrl+movie+"?api_key="+apiKey+"&append_to_response="+response,path=apiUrl+movie+"/"+response+"?&api_key="+apiKey,noImg="https://via.placeholder.com/54x75?text=no+image",images=apiUrl+movie+"/images?api_key="+apiKey,rllArgs={script:"nivo_lightbox",selector:"lightbox",custom_events:""},sponsor_url=watch;
</script>
<?php endwhile; else : endif; get_footer() ?>