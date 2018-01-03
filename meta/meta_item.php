<?php
$anno = $terms = strip_tags( $terms = get_the_term_list( $post->ID, ''.year.'' )); 
$poster_path = "https://process.filestackapi.com/ADNupMnWyR7kCWRvm76Laz/resize=width:185,height:278,fit:scale/https://image.tmdb.org/t/p/w185".get_post_meta($post->ID, "poster_path", $single = true);
//$poster_path = "https://image.tmdb.org/t/p/w185".get_post_meta($post->ID, "poster_path", $single = true);
$poster_null = "https://process.filestackapi.com/ADNupMnWyR7kCWRvm76Laz/resize=width:185,height:278,fit:scale/http://pichoster.net/images/2017/12/19/4355fc995bbdfe4f096a73b0290eb183.png";
$imdbRating = get_post_meta($post->ID, "imdbRating", $single = true);
if(empty($imdbRating)){$imdbRating = "N/A";}
$post_id = get_the_ID();
?>