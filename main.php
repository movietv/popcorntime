<div class="container" id="catalog">
<div id="movies_catalog">
<div id="catalog_scroller">
<div class="spacer"></div>
<div class="item-container">
<?php  if (have_posts()) : while (have_posts()) : the_post(); get_template_part( 'item' ); endwhile; else : endif; ?>
</div>
<div id="pagination">
<div class="nav-previous"><?php next_posts_link( '' ); ?></div>
</div>
</div>
<!--<h1><?php bloginfo('name'); ?></h1>-->
<!--<p><?php bloginfo('description'); ?></p>-->
</div>