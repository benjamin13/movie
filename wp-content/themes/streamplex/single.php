<?php get_header();?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<span>	<?php include('review-header.php');?>
		
<div id="main-content" class="rounded hentry" itemscope itemtype="http://schema.org/Movie"><? stream_breadcrumb();?>
<div id="playingnow"></div>
<? if (get_theme_option('trailer')=='yes') :?>
<div align="center" style="padding:20px">
<? stream_video();?>
</div>
<div align="center" style="padding-bottom:20px"><?php if (get_theme_option('728t')) {echo get_theme_option('728t');}else{echo '<img src="http://images.fachrul.com/upload/images/NIIK.png"/>';} ?></div>
<? endif;?>
		<!--Single Post-->	
<div style="width:673px;float:right">	
<h2 class="entry-title" itemprop="name"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<? if(function_exists('streamplex_content')&&class_exists('tabs_slides')){echo str_replace('<img align="right" ','<img itemprop="image" align="right" ',streamplex_content());}else{the_content();}?>
 <div align="center"><?php if (get_theme_option('336')) {echo get_theme_option('336');}else{echo '<img src="http://images.fachrul.com/upload/images/VL64.jpg"/>';} ?></div><br class="clear"/>

	<?php include_once('related.php');?>
	  <br class="clear"/>
<div style="float:left;font-weight:bold" class="prev">&laquo; <?php previous_post_link('%link') ?></div>
<div style="float:right;font-weight:bold" class="next"><?php next_post_link('%link') ?> &raquo;</div>
<br class="clear"/>

<div class="stt2"><?php if(function_exists('stt_terms_list')) echo stt_terms_list() ;?></div>         
			<div class="single-meta">
				Posted on <span class="updated"><? the_date();?></span> by <span class="vcard author"><span class="fn"><?php the_author(); ?></span></span> in <?php the_category(','); ?> <?php the_tags( '| Tags: ', ', ', '.' ); ?>
			</div>
			
			<div class="social-links"><?php edit_post_link('(Edit)'); ?></div>
			<div id="comments">
				<?php comments_template(); ?>
			</div>
		<?php endwhile;endif; ?>	
	</div>
	<? get_sidebar();?>
</div>
<?php get_footer(); ?>