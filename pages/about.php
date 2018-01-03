<?php
/* 
Template Name: about
*/
get_header();?>



<div id="slider_about" class="slider fadein" data-id="about" style="top: 0px; opacity: 1;"><div class="close"  onclick="window.location.href='<?php bloginfo('url'); ?>'"></div>

   <div class="cover" style="background:url(<?php echo get_template_directory_uri(); ?>/css/images/about.png) no-repeat center center;background-size:cover;width:100%;height:100%;position:absolute;top:0;left:0;"></div>
   <div class="legend">
      <a href="http://filmhd.me/" style="font-family:opensansbold;color:#fff;text-decoration:none">About <?php bloginfo('name'); ?></a><br>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
     <?php the_content(); ?>
<?php endwhile; ?>						
<?php else : ?>
<?php endif; ?>
   </div>


   <div class="shortcuts_cont">
      <table>
         <tbody><tr>
            <td><span class="key">←</span> <span class="key">↑</span> <span class="key">→</span> <span class="key">↓</span></td>
            <td>Navigate</td>
         </tr>
         <tr>
            <td><span class="key">ENTER</span><span class="sep">/</span><span class="key">&nbsp; &nbsp; &nbsp; SPACE &nbsp; &nbsp; &nbsp;</span>
            </td>
            <td>Choose / Play</td>
         </tr>
         <tr>
            <td><span class="key">CTRL</span><span class="sep">+</span><span class="key">+</span></td>
            <td>Enlarge Covers</td>
         </tr>
         <tr>
            <td><span class="key">CTRL</span><span class="sep">+</span><span class="key" style="padding:3px 9px">-</span></td>
            <td>Reduce Covers</td>
         </tr>
         <tr>
            <td><span class="key">CTRL</span><span class="sep">+</span><span class="key">F</span></td>
            <td>Search</td>
         </tr>
         <tr>
            <td><span class="key">&nbsp;TAB&nbsp;</span></td>
            <td>Toggle Movies / TV shows</td>
         </tr>
         <tr>
            <td><span class="key">SHIFT</span></td>
            <td>Open / Close Side menu</td>
         </tr>
         <tr>
            <td><span class="key">Esc</span></td>
            <td>Close</td>
         </tr>
         <tr>
            <td><span class="key">Q</span></td>
            <td>Toggle Quality</td>
         </tr>
         <tr>
            <td><span class="key">V</span></td>
            <td>Mark as watched</td>
         </tr>
         <tr>
            <td><span class="key">T</span></td>
            <td>Watch trailer</td>
         </tr>
         <tr>
            <td><span class="key">INSERT</span><span class="sep">/</span><span class="key">F</span></td>
            <td>Add to bookmarks</td>
         </tr>
         <tr>
            <td><span class="key">B</span></td>
            <td>Go to bookmarks</td>
         </tr>
         <tr>
            <td><span class="key">F5</span></td>
            <td>Reload Interface</td>
         </tr>
      </tbody></table>
   </div>


   <div class="social">
      <span class="icon2 facebook" onclick="window.location.href='http://filmhd.me/'"></span>
      <span class="icon2 twitter" onclick="window.location.href='<?php the_permalink() ?>'"></span>
      <span class="icon2 wordpress" onclick="window.location.href='<?php the_permalink() ?>'"></span>
   </div>

</div>

<?php get_footer() ?>