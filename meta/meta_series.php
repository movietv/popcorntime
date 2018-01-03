<?php
$Youtube = get_post_meta($post->ID, "youtube_id", $single = true);$YoutubeFinal = $Youtube;$arr = explode('[',$YoutubeFinal);$YoutubeFinal = implode('',$arr);$arr = explode(']',$YoutubeFinal);$YoutubeFinal = implode('',$arr);
$arr = explode('https://youtu.be/',$YoutubeFinal);$YoutubeFinal = implode('',$arr); $YoutubeFinal = "http://www.youtube.com/watch?v=".$YoutubeFinal;
$anno = $terms = strip_tags( $terms = get_the_term_list( $post->ID, ''.year.'' )); 
$poster_path = get_template_directory_uri()."/css/images/poster.png";
$IMDbUrl = "http://www.imdb.com/title/".get_post_meta($post->ID, "imdb_id", $single = true)."/";
$tvdb = "https://www.thetvdb.com/?tab=series&id=".get_post_meta($post->ID, "tvdb_id", $single = true)."/";
$FakeBackdrop = get_template_directory_uri()."/images/ezgif.com-optimize.gif";
$Year = get_the_term_list($post->ID, ''.year.'', '', ', ', '');
$Runtime = "&nbsp;".get_post_meta($post->ID, "episode_run_time", $single = true);
$Votes = get_post_meta($post->ID, "imdbVotes", $single = true);
$Plot = substr(get_the_excerpt(), 0,600);
$Openload = get_post_meta($post->ID, "embedurl", $single = true);
if(empty($Openload)){$Openload = "https://openload.co/embed/DnTNBixKeX4/";}
$imdbRating = get_post_meta($post->ID, "imdbRating", $single = true);
if(empty($imdbRating)){$imdbRating = "N/A";}
?>