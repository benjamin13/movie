<?php require('wp-config.php');
$title = str_replace("_"," ",$_GET['title']); 
get_header();?>
<div id="main-content" class="rounded">
<div align="center">
<div id="playingnow"></div>
<h2>"<? echo str_replace("\'","",$title)?>" Theatrical Trailer</h2>
<?php if (get_theme_option('728t')) {echo get_theme_option('728t');}else{echo '<img src="http://images.fachrul.com/upload/images/NIIK.png"/>';} ?>
  <object width="873" height="400">
                                <param name="movie" value="http://d.yimg.com/nl/movies/site/player.swf?lang="></param>
                                <param name="wmode" value="opaque"></param>
                                <param node="allowFullScreen" value="true"></param>
                                <param name="flashVars" value="vid=<?=$_GET['v']?>&locale="></param>
                                <embed width="873" height="400"
                                    src="http://d.yimg.com/nl/movies/site/player.swf?lang="
                                    type="application/x-shockwave-flash"
                                    flashvars="vid=<?=$_GET['v']?>&amp;autoPlay=0&amp;volume=100&amp;enableFullScreen=1&amp;locale=&amp;mute=0&amp;embedCode=default&amp;repeat=0&amp;startScreenCarouselUI=hide&amp;browseCarouselUI=hide&amp;adRuleId=" wmode="opaque">
                                </embed>
                            </object>
							<div class="clear"></div>
<p style="padding:10px"><?php if (get_theme_option('336')) {echo get_theme_option('336');}else{echo '<img src="http://images.fachrul.com/upload/images/VL64.jpg"/>';} ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php if (get_theme_option('336')) {echo get_theme_option('336');}else{echo '<img src="http://images.fachrul.com/upload/images/VL64.jpg"/>';} ?></p>
<h3 class="yellow">Opening This Week</h3>
<?php imagescrollerfx_echo_embed_code(); ?>											
</div></div>
<? get_footer();?>