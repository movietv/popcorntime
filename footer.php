
<script>
var home = "<?php echo esc_url( home_url() ); ?>";
var genre = "<?php echo esc_url( home_url( '/' ) ); ?><?php echo genre; ?>/<?php echo tvseries; ?>/";
$(".icon2.film").click(function(){window.location.href=home}),$(".icon2.tv").click(function(){window.location.href=genre});
</script>
<?php if(is_single()){ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/api/movie.js"></script>
<?php }else{ ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/default/footer.js"></script>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>