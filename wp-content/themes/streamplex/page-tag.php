<?php
/*
Template Name: Tag List
*/
?><?php get_header(); ?>
<div id="main-content" class="rounded">
<div style="width:673px;float:right">	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
	
	<h1 class="entry-title"><a href="<? the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> By Genre or Year</h1>
	
	<h2>
					<?php $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
						  if (0 < $numposts) $numposts = number_format($numposts); ?>
					<?php echo 'We Have '.$numposts.' Movie title published since we online.'; ?>
				</h2>

				
				<?php
$tags = get_tags();
$tags_count = count($tags);
$percolumn = ceil($tags_count / 3);

for ($i = 0;$i < $tags_count;$i++):
if ($i < $percolumn):
$tag_left .= '
	<li><a title="Find Movies in ' . $tags[$i]->name .'" href="'. get_tag_link($tags[$i]->term_id) . '"rel="tag">' . $tags[$i]->name .'</a></li>
' . "\n";
elseif ($i >= $percolumn && $i < $percolumn*2):
$tag_mid .= '
	<li><a title="Find Movies in ' . $tags[$i]->name .'" href="'. get_tag_link($tags[$i]->term_id) . '"rel="tag">' . $tags[$i]->name .'</a></li>
' . "\n";
elseif ($i >= $percolumn*2):
$tag_right .= '
	<li><a title="Find Movies in ' . $tags[$i]->name .'" href="'. get_tag_link($tags[$i]->term_id) . '"rel="tag">' . $tags[$i]->name .'</a></li>
' . "\n";
endif;
endfor;
?>
<div style="float:left;width:32%;padding-right:5px">
<ul>
<?php echo $tag_left; ?>
</ul>
</div><div style="float:left;width:32%;padding-right:5px">
<ul>
<?php echo $tag_mid; ?>
</ul>
</div><div style="float:left;width:32%;padding-right:5px">
<ul>
<?php echo $tag_right; ?>
</ul>
</div>

	<?php edit_post_link('(Edit)', '<p>', '</p>'); ?>
	
	<?php endwhile; endif; ?>

</div>
<? get_sidebar();?>
</div>
<?php get_footer(); ?>