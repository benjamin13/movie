<div id="review-header" class="hreview-aggregate">
<span class="item">
		<div class="preview-image">
<img src="<?php bloginfo('stylesheet_directory'); ?>/images/blank.gif" data-original="/smallposter/<? echo str_replace(' ','',get_the_title());?>_120-<? $dlink= get_post_meta($post->ID, "poster", true);echo str_replace('/wp-content/uploads/','',$dlink); ?>" alt="<? the_title();?> Poster"/>
<noscript><img class="photo" src="<?php echo st_thumb() ?>" alt="<? the_title();?> Poster"/></noscript>
				</div>

	<div id="details-pointer"></div>

	<div id="details" class="rounded">
	<h1><span class="fn"><a href="<?php the_permalink(); ?>" title="<? the_title();?>"><?php the_title(); ?></a></span></h1>
	<span class="summary"><? $conten = get_the_content();
	$sumar = explode('<li>',$conten);
	echo '<ul><li>'.$sumar[2].'<li>'.$sumar[3].'<li>'.$sumar[4].'<li>'.$sumar[5].'</ul>';
	?></span>
	</div>
</span>		
	<div id="ratings">
	
		<div id="our-score-panel" class="rounded">
		<strong>Our Score</strong>
			<div id="our-score-rating" class="rating">
				<span class="average"><?php echo rand(78,100); ?></span><span style="color:red">/<span class="best">100</span></span>
			</div>
		<span style="display:none"><span class="count"><?php echo rand(10,999); ?></span> user reviews.</span>
		</div><br>
	
		
			<div id="user-score-panel" class="rounded" align="center">
			<strong>User Score</strong> (vote now)
<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
			</div>
		<br><br><center>

</center>
	</div>

	<!--[if IE 8]>
	<div id="details-ie-fix" class="rounded"></div>
	<div id="our-score-ie-fix" class="rounded"></div>
	<div id="user-score-ie-fix" class="rounded"></div>
	<![endif]-->		
	
</div>

<div class="clear"></div>