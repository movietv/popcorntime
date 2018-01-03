<?php get_header();?>
<div id="slider_settings" class="slider left"style="left: 0px; opacity: 1;">
<div class="close"></div>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<table cellspacing="0" cellpadding="0" class="settings_table">
<tbody>
<tr>
<td class="title">
<?php the_title(); ?>
</td>
<td style="border-bottom:0">&nbsp;</td>
</tr>
<tr>
<td>
&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/images/share_mascot.png">
</td>
<td>
<div class="entry-content">
<?php the_content(); ?>
</div>
</td>
</tr>
</tbody>
</table>
<?php endwhile; ?>						
<?php else : ?>
<?php endif; ?>
</div>
<?php get_footer() ?>


