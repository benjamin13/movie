</div>

	<div id="footer">
		<div class="left">
&copy; <? echo date('Y').' <a href="'.get_bloginfo('url').'" rel="home">'.get_bloginfo('name').'</a>';?> 
		</div>
		
		<div class="right">
		Powered by <a href="https://www.facebook.com/nightflighter27" target="_blank">Nightflighter 27</a> | <a href="http://muvii123.com" title="TV Series and Movies Database" target="_blank">TV Series and Movies Database</a> 
		</div>
		<br class="clear"/><div align="center"><?php wp_footer(); ?></div>
	</div>
</div>

<?php if (get_theme_option('footer')) {echo get_theme_option('footer');} ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery171.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/lazyload.js"></script>
<script type="text/javascript">$(function(){$("img").lazyload({event : "sporty",effect : "fadeIn"});});$(window).bind("load", function(){var timeout = setTimeout(function(){$("img").trigger("sporty")},500);});</script>
<? if (get_theme_option('trailer')=='yes' && is_single()) :?><script type="text/javascript" src="http://webplayer.yahooapis.com/player.js"></script><? endif;?>
</body>
</html>