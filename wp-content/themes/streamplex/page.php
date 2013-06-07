<?php get_header(); ?>
<div id="main-content" class="rounded">
<div style="width:673px;float:right">	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
	
	<h1 class="entry-title"><a href="<? the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
	
	<?php the_content(); ?>

	<?php edit_post_link('(Edit)', '<p>', '</p>'); ?>
	
	<?php endwhile; endif; ?>

</div>
<? get_sidebar();?>
</div>
<?php get_footer(); ?>