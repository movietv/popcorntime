<?php
/* 
Template Name: contact us
*/
get_header();?>


<div id="slider_about" class="slider fadein" style="top: 0px; opacity: 1;"><div class="close"  onclick="window.location.href='<?php bloginfo('url'); ?>'"></div>

   
   <div class="legend">
      <a href="#" style="font-family:opensansbold;color:#fff;text-decoration:none">contact us</a><br>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
     <?php the_content(); ?> 
<?php endwhile; ?>						
<?php else : ?>
<?php endif; ?>
   </div>







</div>

<?php get_footer() ?>