<? 
function sanitize_output($buffer)
{
    $search = array(
        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
        '/[^\S ]+\</s', //strip whitespaces before tags, except space
        '/(\s)+/s'  // shorten multiple whitespace sequences
        );
    $replace = array(
        '>',
        '<',
        '\\1'
        );
  $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
ob_start("sanitize_output");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11"><? if (get_theme_option('head')) {echo get_theme_option('head');}?>
<? $sv = substr($_SERVER['HTTP_REFERER'], strlen('http://'));
$sv = str_replace('www.','',$sv);
$sv = substr($sv, 0, strpos($sv, '.'));
if(($sv =='images'||$sv=='google')&&(get_theme_option('breaker')=='yes')):?>
<script language="JavaScript" type="text/javascript">function breakfree() { if ( top.location != self.location ) { top.location = self.location; } }window.onload = breakfree();</script>
<? endif;?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(); ?></title>
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/movieco.png" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if lt IE 7]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-ie6-brown.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 6]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-ie6.css" type="text/css" media="screen" />
<![endif]-->
<!--[if lt IE 8]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-ie7.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE]>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-ie.css" type="text/css" media="screen" />
<![endif]-->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/combine.js"></script>
<?php if(is_home()) { ?>
<script language="javascript" type="text/javascript">
var $s = jQuery.noConflict();
$s(document).ready(function(){
	$s("#myController").jFlow({
		slides: "#mySlides",
		width: "493px",
		height: "284px",
		duration: 500,
		prev: ".jFlowPrev",
		next: ".jFlowNext",		
		auto: true		
	});
});
</script>
<?php } ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );if(get_theme_option('style')=='light'||$_GET[style]=='light'): ?>
<style type="text/css">
body{color:#757;background:#E3E2DD url('/wp-content/themes/streamplex/images/back-noise-gradient-light.png')repeat-x scroll 0 0;}#page-wrap{box-shadow:0 0 100px #4169e1;background:#E3E2DD url('/wp-content/themes/streamplex/images/back-noise-gradient-light.png')repeat-x scroll 0 0;}#header,#footer{background:transparent;border:0;}.boxgrid a:hover img{box-shadow:0 0 15px #4169e1;}input,textarea,select,fieldset{color:#757;border:2px solid #ff4500;background:transparent;}#nav a,#nav-container,#slider-container-left,#feat{background:transparent;}#user-score-panel,#our-score-panel,#details,#details strong{background:pink;color:#4169e1;}.comment-meta .author,.comment-meta .author a,.feat-post a,#feat h2,a,.feat-post a:hover,.author,.author a,a:hover,.current_page_item a,.current-cat a,.current_page_parent a,.current-cat-parent a,.current_page_parent ul .page_item a:hover,.children .cat-item a:hover,.current_page_parent ul .current_page_item a,.children .current-cat a{color:#4169e1;}.comment-body{background:beige;}.comment-bubble{color:#bc8f8f;}#main-content{background:#CECECE;}#playingnow{background:url(/wp-content/themes/streamplex/images/title_box.jpg)-10px 0 no-repeat;height:60px;width:100%;}.cover{border:4px double #4169e1;}
</style>
<? endif;?>
</head>
<body>
<div id="page-wrap">		
	<div id="header">
		<div id="logo"><a href="<?php bloginfo('url') ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/blank.gif" border="0" alt="<? bloginfo('name');?>" /></a></div>
		<div id="searh"><? include('searchform.php')?></div>
		<div class="clear"></div>
		<?php if ( has_nav_menu( 'primary' ) ):wp_nav_menu( array( 'theme_location' => 'primary' ,'container_id'  => 'nav-container', 'container_class'  => 'rounded', 'menu_id'  => 'nav' ));else: ?>
		<div id="nav-container" class="rounded">
			<ul id="nav">				
				<li<?php if(is_home()) : ?> class="current-cat"<?php endif; ?>><a href="<?php bloginfo('url') ?>">Home</a></li>
				<?php wp_list_pages('orderby=menu_order&depth=3&title_li=');?>							
			</ul>
		<!--[if IE ]>
		<div id="nav-ie-fix" class="rounded"></div>
		<![endif]-->
		</div><? endif;?>
	</div>
	<div id="overall-container">	
		<div class="clear"></div>
<? if (is_home()&& get_query_var('paged') == 0):?>		
		<!--Begin Slider-->
		<div id="slider-container-outer">	
			<div id="slider-container-left">
				<div id="myController">
					<?php
					query_posts('showposts=3&cat=1');
					if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="jFlowControl">
						
							<div class="thumbnail">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/blank.gif" data-original="<? $dlink= get_post_meta($post->ID, "poster", true);echo $dlink; ?>" alt="<?php the_title(); ?>" />
								<noscript><img src="<? $dlink= get_post_meta($post->ID, "poster", true);echo $dlink; ?>" alt="<?php the_title(); ?>" /></noscript>
							</div>
						
						</div>
					<?php endwhile; endif; wp_reset_query(); ?>
				</div>
		
			<div id="mySlides">
				<?php
				query_posts('showposts=3&cat=1');
				if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div>
					<span class="slider-text">
						<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo slidertitle(get_the_title());?></a></h3>
					</span>
					
						<div class="slider-image">
							<img src="<?php bloginfo('stylesheet_directory'); ?>/images/blank.gif" data-original="<? $dlink= get_post_meta($post->ID, "poster", true);echo $dlink; ?>" alt="<?php the_title(); ?>" />		
							<noscript><img src="<? $dlink= get_post_meta($post->ID, "poster", true);echo $dlink; ?>" alt="<?php the_title(); ?>" /></noscript>	
						</div>
					
				</div>
				<?php endwhile; endif; wp_reset_query(); ?>
			</div><!--End mySlides-->
			
		</div><!--End slider-container-left-->
		
		<div id="feat" class="rounded">
			<h2>Box Office</h2><? include('boxoffice.php');?>
			
				<?php /*echo '<ul>';
				query_posts('showposts=7&orderby=rand');
				if (have_posts()) : while (have_posts()) : the_post(); ?>
				<li><div class="feat-post"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo feattitle(get_the_title());?></a></div>
				<div class="comment-bubble"><?php comments_number('0', '1', '%', 'comments-link', '-'); ?></div>
				<div class="dot"></div></li>
				<?php endwhile; endif; wp_reset_query();echo '</ul>';*/ ?>
				
		</div>
		<!--[if IE ]>
		<div id="feat-ie-fix" class="rounded"></div>
		<![endif]-->
	</div>
	<!--End Slider-->		
<? endif;?>
	<div class="clear"></div>