<?php include("meta/meta_item.php"); ?>
<div class="movie">
<a href="<?php the_permalink() ?>" rel="bookmark">
<img src="<?php if($values = get_post_custom_values("poster_path")) { ?><?=$poster_path?><?php } else { ?><?=$poster_null?><?php } ?>" alt="<?php the_title(); ?>">
<div class="poster_slide">
<div class="poster_slide_cont">
<div class="poster_slide_bg"></div>
<div class="poster_slide_details">
<div class="title">    
<?php the_title(); ?>
<div class="year">
<?php echo $anno; ?>
</div>
</div>
<div class="details">
<div class="stars">
<span class="icon star_empty"></span>
<span class="rating"><?=$imdbRating?></span>
</div>
</div>
</div>
</div>
</div>
</a>
</div>
