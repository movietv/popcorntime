<div id="watch_toolbox">
<div class="toolbox_content">
<div class="sep">
<div class="watch-btn">
<div class="icon2 play"></div>
<a href="<?=$noVideo?>" class="caption" id="link" rel="lightbox" data-lightbox-type="iframe"><?php echo watchtext; ?></a>
</div>
</div>
<div class="sep">
<?php if($values = get_post_custom_values("fullhd")) { ?><div id="link" onclick="setURL('<?php echo $values[0]; ?>')" class="quality_selector 1080p enabled activated" data-quality="1080p">&nbsp;</div><?php } else { ?><div id="link" class="quality_selector 1080p" style="pointer-events: none;" data-quality="1080p">&nbsp;</div><?php } ?>
<?php if($values = get_post_custom_values("hd")) { ?><div id="link" onclick="setURL('<?php echo $values[0]; ?>')" class="quality_selector enabled 720p" data-quality="720p">&nbsp;</div><?php } else { ?><div id="link" class="quality_selector 720p" style="pointer-events: none;" data-quality="720p">&nbsp;</div><?php } ?>
<?php if($values = get_post_custom_values("sd")) { ?><div id="link" onclick="setURL('<?php echo $values[0]; ?>')" class="quality_selector enabled 360p" data-quality="360p">&nbsp;</div><?php } else { ?><div id="link" class="quality_selector 360p" style="pointer-events: none;" data-quality="360p">&nbsp;</div><?php } ?>

<!--<div class="selector torrent_selector">
<div class="selector_cont" onmouseleave="$(this).children('.activated').insertBefore($(this).children('.item').first());this.scrollTop=0">
<div class="item torrent 1080p activated" data-idx="0" data-quality="1080p" style="display: block;"><div class="icon2 baterry bad"></div><div class="caption">218/424 Peers</div></div>
<div class="item torrent  1080p" data-idx="1" data-quality="1080p" style="display: block;"><div class="icon2 baterry good"></div><div class="caption">129/101 Peers</div></div>
<div class="item torrent  720p" data-idx="2" data-quality="720p" style="display: none;"><div class="icon2 baterry good"></div><div class="caption">109/121 Peers</div></div>
<div class="item torrent  720p" data-idx="3" data-quality="720p" style="display: none;"><div class="icon2 baterry bad"></div><div class="caption">10/23 Peers</div></div>
<div class="item torrent  1080p" data-idx="4" data-quality="1080p" style="display: block;"><div class="icon2 baterry bad"></div><div class="caption">12/24 Peers</div></div>	
</div>
<div class="icon2 down2"></div>
</div>-->
</div>
<div class="sep" style="color:rgba(255,255,255,0.7);">
<!--<div class="selector dubbed_selector">
<div class="selector_cont" onmouseover="if(this.querySelector('.dtitle')) this.querySelector('.dtitle').innerHTML = ' No Dubbing';" onmouseleave="this.style.height='';this.scrollTop=0;" onclick="$(this).children('.activated').insertBefore($(this).children('.item').first());this.scrollTop=0;this.style.height='100%';"></div>
<div class="icon2 down2"></div>
</div>-->
<div class="tools">
<div class="tool icon2">
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
</div>
<?php if($values = get_post_custom_values("youtube_id")) { ?><a href="<?=$YoutubeFinal?>" class="tool trailer" rel="lightbox" data-lightbox-type="iframe" style="display: block;">Trailer</a><?php } else { ?><?php } ?>
</div>
</div>
</div>
</div>


