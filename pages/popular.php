<?php
/* 
Template Name: popular
*/
get_header();?>
<div class="container" id="catalog">
<style>#side_menu:hover{width:175px;position:fixed}#side_menu{position:absolute;position:fixed;top:0;bottom:0;height:100%;left:0;width:0;overflow:hidden;-webkit-transition:width .05s linear;transition:width .05s linear;-webkit-transform:translateZ(0) scale(1,1);z-index:1000}</style>
<div id="movies_catalog">
<div id="catalog_scroller" class="ui-sortable">
<div style="width:100%;height:65px;float:left"></div>
<div class="item-container">
<?php  if (have_posts()) : $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts( array('meta_key' => 'end_time','meta_compare' =>'>=','meta_value'=>time(),'meta_key' => 'popularity',
'post__not_in' => get_option( 'sticky_posts' ),'orderby' => 'meta_value_num', 'order' => 'DESC', 'paged' => $paged));
while ( have_posts() ) : the_post(); $popularity = get_post_meta($post->ID, "popularity", $single = true); get_template_part( 'item' ); endwhile; else : endif; ?>
</div>
<div id="pagination">
<div class="nav-previous"><?php next_posts_link( '' ); ?></div>
</div>
</div>
</div>
</div>
<div id="menu_teaser">
<div></div>
<div></div>
</div>
<div id="side_menu">
<div class="incont">
<div id="sidetools">
<div id="genres_box">
<?php echo is_home() ? '<li class="current-cat">' : '<li>'; ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Latest</a><?php echo is_home() ? '</li>' : '</li>'; ?>
<?php categorias(); ?>
</div>
<div id="sortby_box">
<div style="font-size:11px;color:#fff"><b>Sort By:</b>&nbsp;
<select tabindex="-1" id="select_sortby" onchange="if (this.value) window.location.href=this.value">
<?php if ( is_home() ) { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?>" selected='selected'><?php echo latest; ?></option><?php } else { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo latest; ?></option><?php } ?>
<?php if ( is_page('random') ) { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo random; ?>/" selected='selected'><?php echo random; ?></option><?php } else { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo random; ?>/"><?php echo random; ?></option><?php } ?>
<?php if ( is_page('top') ) { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo top; ?>/" selected='selected'>IMDb</option><?php } else { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo top; ?>/">IMDb</option><?php } ?>
<option value="<?php echo esc_url( home_url( '/' ) ); ?>?orderby=title&order=ASC"><?php echo title; ?></option>
<option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo popular; ?>/" selected='selected'><?php echo popular; ?></option>
</select>
</div>
</div>
</div>
<div id="mode_box">
<span class="activated">Home</span> &nbsp;·&nbsp; <span></span>
</div>
</div>
</div>
<?php get_footer() ?>