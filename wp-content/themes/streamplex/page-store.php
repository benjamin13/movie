<?php
/*
Template Name: DVD Store
*/
?><?php get_header(); ?>
<div id="main-content" class="rounded">
<iframe src="http://astore.amazon.com/<? echo get_theme_option('amazon');?>" width="95%" height="850" frameborder="0" scrolling="yes"></iframe>
</div>
<?php get_footer(); ?>