<?php echo '<h3><a href="https://www.google.com/search?q=site:'.str_replace('http://','',get_bloginfo('url')).' '.get_the_title().'" title="'.get_the_title().' Related Movie" target="_blank">'.get_the_title().'</a> Related Movie</h3><br class="clear"/>';
$category = get_the_category();
$category = $category[0];
$category = $category->cat_ID;
$posts = get_posts('numberposts=5&orderby=rand&category='.$category);
foreach($posts as $post) {
?>
      <div class="relatedpost">		
			<div class="relatedboxgrid">
			<a href="<?php the_permalink(); ?>" title="<? the_title();?>"><img class="rounded covers" src="<?php bloginfo('stylesheet_directory'); ?>/images/blank.gif" data-original="/smallposter/<? echo str_replace(' ','',get_the_title());?>_100-<? $dlink= get_post_meta($post->ID, "poster", true);
echo str_replace('/wp-content/uploads/','',$dlink); ?>" alt="<? the_title();?> Movie Poster" title="<? the_title();?> Movie Poster" width="100" onmouseover="ToolTip.create(this, '<? the_title();?>', 'width=100 borderWidth=1; fadeIn=500; ');"/></a>
			</div>
	</div>
<?php }wp_reset_query();?>