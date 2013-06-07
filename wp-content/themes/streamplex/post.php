	<div class="post">		
			<div class="boxgrid">
			<a href="<?php the_permalink(); ?>" title="<? the_title();?>"><img class="cover rounded" src="<?php bloginfo('stylesheet_directory'); ?>/images/blank.gif" data-original="/smallposter/<? echo str_replace(' ','',get_the_title());?>_183-<? $dlink= get_post_meta($post->ID, "poster", true);
echo str_replace('/wp-content/uploads/','',$dlink); ?>" alt="<? the_title();?> Movie Poster" width="175" onmouseover="ToolTip.create(this, '<? the_title();?>', 'width=100 borderWidth=1; fadeIn=500; ');"/>
			<noscript><img class="cover rounded" src="<?=st_thumb() ?>" alt="<? the_title();?> Movie Poster" width="175"/></noscript>
			</a><br class="clear"/>
			<strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo feattitle(get_the_title()); ?></a></strong>	
			</div>
	</div>