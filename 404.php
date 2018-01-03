<?php get_header();?>
<div class="container" id="catalog">
<div id="movies_catalog">
<div id="catalog_scroller" class="ui-sortable">
<div style="width:100%;height:65px;float:left"></div>
<div class="item-container">
<div style="text-align:center;"><img id="404" src="<?php echo get_template_directory_uri(); ?>/images/404.png" width="90%" height="auto" alt="404" /></div>
</div>
</div>
</div>
<h1><?php bloginfo('name'); ?></h1>
<p><?php bloginfo('description'); ?></p>
</div>
<?php get_footer() ?>