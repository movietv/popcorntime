<?php
/* 
Template Name: random
*/
get_header();?>
<div class="container" id="catalog">
<div id="movies_catalog">
<div id="catalog_scroller" class="ui-sortable">
<div style="width:100%;height:65px;float:left"></div>
<div class="item-container">
<?php  $rand_posts = get_posts('numberposts=65&orderby=rand'); foreach( $rand_posts as $post ) : get_template_part( 'item' ); endforeach; ?>
</div>
</div>
</div>
</div>
<?php get_sidebar(); get_footer() ?>