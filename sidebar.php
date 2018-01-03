<div id="menu_teaser">
<div></div>
<div></div>
</div>
<div id="side_menu">
<div class="incont">
<div id="sidetools">
<div id="genres_box">
<?php if ( is_category(tvseries) ) { ?><li class="current-cat"><a href="<?php echo esc_url( home_url( '/' ) ); ?><?php echo genre; ?>/<?php echo tvseries; ?>"><?php echo latest; ?></a></li><?php } else { ?><?php echo is_home() ? '<li class="current-cat">' : '<li>'; ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo latest; ?></a><?php echo is_home() ? '</li>' : '</li>'; ?><?php } ?>
<?php categorias(); ?>
</div>
<div id="sortby_box">
<div style="font-size:11px;color:#fff"><b>Sort By:</b>&nbsp;
<select tabindex="-1" id="select_sortby" onchange="if (this.value) window.location.href=this.value">
<?php if ( is_home() ) { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?>" selected='selected'><?php echo latest; ?></option><?php } else { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo latest; ?></option><?php } ?>
<?php if ( is_page('random') ) { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo random; ?>/" selected='selected'><?php echo random; ?></option><?php } else { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo random; ?>/"><?php echo random; ?></option><?php } ?>
<?php if ( is_page('top') ) { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo top; ?>/" selected='selected'>IMDb</option><?php } else { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo top; ?>/">IMDb</option><?php } ?>
<option value="<?php echo esc_url( home_url( '/' ) ); ?>?orderby=title&order=ASC"><?php echo title; ?></option>
<?php if ( is_page('popular') ) { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo popular; ?>/" selected='selected'><?php echo popular; ?></option><?php } else { ?><option value="<?php echo esc_url( home_url( '/' ) ); ?><?php echo popular; ?>/"><?php echo popular; ?></option><?php } ?>
</select>
</div>
</div>
<?php //dynamic_sidebar( 'left_1' ); ?>
</div>
<div id="mode_box">
<span class="activated">Home</span> &nbsp;·&nbsp; <span></span>
</div>
</div>
</div>