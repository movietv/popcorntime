<?php
$Youtube = get_post_meta($post->ID, "youtube_id", $single = true);$YoutubeFinal = $Youtube;$arr = explode('[',$YoutubeFinal);$YoutubeFinal = implode('',$arr);$arr = explode(']',$YoutubeFinal);$YoutubeFinal = implode('',$arr);
$arr = explode('https://youtu.be/',$YoutubeFinal);$YoutubeFinal = implode('',$arr); $YoutubeFinal = "http://www.youtube.com/watch?v=".$YoutubeFinal;
$anno = $terms = strip_tags( $terms = get_the_term_list( $post->ID, ''.year.'' )); 
$poster_path = "https://image.tmdb.org/t/p/w780".get_post_meta($post->ID, "poster_path", $single = true);
$fakePlayer = "https://image.tmdb.org/t/p/original".get_post_meta($post->ID, "backdrop_path", $single = true);
$poster_null = "http://pichoster.net/images/2017/12/19/e9af8634b610dd342b6fd07c4405b03d.png";
$IMDbUrl = "http://www.imdb.com/title/".get_post_meta($post->ID, "imdb_id", $single = true)."/";
$Backdrop = get_template_directory_uri()."/images/ezgif.com-optimize.gif";
$Year = get_the_term_list($post->ID, ''.year.'', '', ', ', '');
$Runtime = get_post_meta($post->ID, "Runtime", $single = true);$arr = explode(' min',$Runtime); $Runtime = implode('',$arr); $arr = explode(' Min',$Runtime); $Runtime = implode('',$arr);
$Votes = get_post_meta($post->ID, "imdbVotes", $single = true);
$Plot = substr(get_the_excerpt(), 0,220);
$noVideo = "https://openload.co/embed/RAlnt677UCY/";
$imdbRating = get_post_meta($post->ID, "imdbRating", $single = true);
$originalTitle = get_post_meta($post->ID, "Title", $single = true);
if(empty($imdbRating)){$imdbRating = "N/A";}
?>