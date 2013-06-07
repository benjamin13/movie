<?php get_header();?>
<div id="main-content" class="rounded">
<div id="playingnow"></div>
	<?php
	if(is_home()&& get_query_var('paged') == 0){imagescrollerfx_echo_embed_code();query_posts('offset=3');}$i=0;
	if (have_posts()) : 
	while (have_posts()) : the_post(); 
	//while($i<18):
	$i++;if($i==2||$i==9||$i==18):?>
	<div class="ads336" align="center"><div class="rounded" style="box-shadow:0 0 20px lightblue;width:336px;padding:5px">
	<?php if (get_theme_option('336')) {echo get_theme_option('336');}else{echo '<img src="http://images.fachrul.com/upload/images/VL64.jpg"/>';} ?>
	</div>.:Advertisement:.</div>
	<? endif;?>

	<?php include('post.php'); endwhile; ?>
		
			<?php if(function_exists('wp_pagenavi')) { ?><?php wp_pagenavi(); ?>
			<?php } else { ?>
			<div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			<?php } ?>
		
		<?php else : ?>
		
			<?php if(is_search()) : ?>
				<h4>No search results found, try searching again</h4>
			<?php else : ?>
				<h4>No Content Yet</h4>
			<?php endif; ?>
			
		<?php endif; wp_reset_query(); ?>

</div>
<?php get_footer(); ?>