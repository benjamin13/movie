<?php
register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'streamplex' )
	) );
//Custom excerpt length
function excerpt($num)
{
$limit = $num+1;
$excerpt = explode(' ', get_the_excerpt(), $limit);
array_pop($excerpt);
$excerpt = implode(" ",$excerpt)."...";
echo $excerpt;
}

//Replace excerpt ellipsis with text linking to the post  
function elpie_excerpt($text)  
{  
return str_replace('[...]', '...', $text);  
}  
add_filter('the_excerpt', 'elpie_excerpt');  
function st_thumb() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = get_bloginfo('stylesheet_directory')."/images/no-poster.jpg";
  }
  return $first_img;
}
function stream_video(){
if($lebar==""){$lebar = '800';}
if($tinggi==""){$tinggi = '450';}

$titlee = get_the_title();
$titlee= strip_tags($titlee);
$titlee= preg_replace('/&.+?;/', '', $titlee);
$titlee= preg_replace('/\s+/', ' ', $titlee);
$titlee= preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $titlee);
$titlee= preg_replace('|-+|', '', $titlee);
$titlee= preg_replace('/&#?[a-z0-9]+;/i','',$titlee);
$titlee= preg_replace('/[^%A-Za-z0-9 _-]/', '', $titlee);
$titlee= trim($titlee);

$titleq = str_replace(' ','+',$titlee.'+trailer');
$feedUrl = 'http://gdata.youtube.com/feeds/base/videos?q='.$titleq.'&client=ytapi-youtube-search&alt=rss&v=2&max-results=7';
if($xml = simplexml_load_file($feedUrl)) {          
        $result["item"] = $xml->xpath("/rss/channel/item"); 
        foreach($result as $key => $attribute) { 
            $i=0; 
            foreach($attribute as $element) { 
				 $ret[$i]['link'] = (string)$element->link; 
				 $ret[$i]['title'] = (string)$element->title; 
                 $i++; 
            } 
        } 
}  
$i=0;
$p = 1;
$link= $ret[$i]['link'];
$link = substr($link, strlen('http://www.youtube.com/watch?v='));
$link = substr($link , 0, strpos($link , '&'));
$stream_video = '<iframe width="'.$lebar.'" height="'.$tinggi.'" src="http://www.youtube.com/embed/'.$link.'" frameborder="0" allowfullscreen></iframe><br/>';
$i=1;while($i<7){
if($ret[$i]['link']!=NULL){
$links[$i]= $ret[$i]['link'];
$links[$i] = substr($links[$i], strlen('http://www.youtube.com/watch?v='));
$links[$i] = substr($links[$i] , 0, strpos($links[$i] , '&'));

$stream_video=$stream_video.'<a href="'.$ret[$i]['link'].'"><img style="border:1px solid white;width:120px;height:90px" src="http://img.youtube.com/vi/'.$links[$i].'/default.jpg" alt="'.$ret[$i]['title'].'" title="'.$ret[$i]['title'].'"/></a>&nbsp;';
}else{$i=6;}
$i++;}

echo $stream_video;
}
function stream_breadcrumb() {
	 $delimiter = ' &raquo; ';
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<span>';
  $currentAfter = '</span>';
	echo "You're here :";
 
    global $post;
    $home = get_bloginfo('url');
	if(is_home() && get_query_var('paged') == 0) 
		echo '<span class="home">' . $name . '</span>';
	else
		echo '<span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a class="home" href="' . $home . '" itemprop="url"><span itemprop="title">' . $name . '</span></a></span> '. $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore;
      single_cat_title();
      echo $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = '<span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.get_category_link($cat[0]->term_id).'" itemprop="url"><span itemprop="title">'.$cat[0]->cat_name.'</span></a></span>';
      //echo get_category_parents($cat[0], TRUE, ' ' . $delimiter . ' ');
	  echo $cat.' ' . $delimiter . ' ';
      echo $currentBefore;
	  echo substr(the_title($before = '', $after = '...', FALSE), 0, 90); 
     
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '" itemprop="url"><span itemprop="title">' . get_the_title($page->ID) . '</span></a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . '' . get_search_query() . $currentAfter;
 
    } elseif ( is_tag() ) {
      echo $currentBefore;
      single_tag_title();
      echo $currentAfter;
 
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_search() || is_tag() ) echo ' (';
      echo $currentBefore . __('Page') . ' ' . get_query_var('paged') . $currentAfter;
      if ( is_category() || is_search() || is_tag() ) echo ')';
    }
 echo "</span>";

}
// Sidebars
if ( function_exists('register_sidebar') )
    register_sidebar(array('name'=>'General Sidebar', 'id'=>'general',
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<strong>',
        'after_title' => '</strong>'
    ));

// Shorten any text you want
function feattitle($text)
{
$chars_limit = 30;

$chars_text = strlen($text);

$text = $text." ";

$text = substr($text,0,$chars_limit);

$text = substr($text,0,strrpos($text,' '));

if ($chars_text > $chars_limit)

{

$text = $text."...";

}

return $text;

}

function slidertitle($text)
{
$chars_limit = 30;

$chars_text = strlen($text);

$text = $text." ";

$text = substr($text,0,$chars_limit);

$text = substr($text,0,strrpos($text,' '));

if ($chars_text > $chars_limit)

{

$text = $text."...";

}

return $text;

}

function streamplex_amazon($aff){
$affiliateid = $aff;
if($affiliateid ==''){$affiliateid ='streamzon-20';}
$titleamazon = get_the_title();
$amazon = '<a href="http://www.amazon.com/s/?tag='.$affiliateid.'&amp;creative=392013&amp;campaign=212361&amp;link_code=wsw&amp;_encoding=UTF-8&amp;search-alias=dvd&amp;field-keywords='.$titleamazon.'&amp;Submit.x=15&amp;Submit.y=16&amp;Submit=Go" target="_blank" title="Buy now at Amazon with Special Price"><img height="200" border="0" src="'.get_bloginfo('stylesheet_directory').'/images/dvd-banner.jpg" alt="Buy DVD at amazon" title="Buy DVD at amazon"/></a>';
return $amazon;
}
function streamplex_content(){
$where = 1;
$content = apply_filters('the_content', get_the_content());
$content = explode('<div class="jwts_tabbertab" title="Gallery"><h2><a href="#Gallery">Gallery</a></h2>', $content);

$titlegambar= get_the_title();
$titlegambar= preg_replace('/&.+?;/', '', $titlegambar);
$titlegambar= preg_replace('/\s+/', ' ', $titlegambar);
$titlegambar= preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $titlegambar);
$titlegambar= preg_replace('|-+|', '', $titlegambar);
$titlegambar= preg_replace('/&#?[a-z0-9]+;/i','',$titlegambar);
$titlegambar= preg_replace('/[^%A-Za-z0-9 _-]/', '', $titlegambar);
$titlegambar= trim($titlegambar,'');
function pete_curl_get($url, $params){$post_params = array();
foreach ($params as $key => &$val) {
if (is_array($val)) $val = implode(',', $val);
$post_params[] = $key.'='.urlencode($val);
}
$post_string = implode('&', $post_params);
$fullurl = $url."?".$post_string;
$ch = curl_init();curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);curl_setopt($ch, CURLOPT_URL, $fullurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7) Gecko/20040608'); //kamu bisa pake user agent yang lain, lihat listnya di sini www.user-agents.org
$result = curl_exec($ch);curl_close($ch);
return $result;
}function perform_google_web_search($termstring)
{
$start = 0;
$result = array();
while ($start<4)
{
$searchurl = 'http://ajax.googleapis.com/ajax/services/search/images?userip='.rand(0,999).'.'.rand(0,999).'.'.rand(0,999).'.'.rand(0,999).'&v=1.0&key=ABQIAAAA93_vqg0YiC1IQ4wLIhQnlhQNkKV7csPsUyVzjJxGPrtgfYpcYxRungGjcinE57GC0hrb8JgJS6-Atw&start=0&rsz=8&imgsz=medium|large|xlarge&filter=0&q='.urlencode($termstring);
$response = pete_curl_get($searchurl, array());
$responseobject = json_decode($response, true);
if (count($responseobject['responseData']['results'])==0)
break;
$allresponseresults = $responseobject['responseData']['results'];
foreach ($allresponseresults as $responseresult)
{
$result[] = array(
'url' => $responseresult['unescapedUrl'],
'title' => $responseresult['titleNoFormatting'],
'thumbnail' => $responseresult['tbUrl'],
'desc' => $responseresult['contentNoFormatting'],
'width' => $responseresult['width'],
'height' => $responseresult['height'],
);
}
$start += 8;
}
return $result;
}
$termstring = $titlegambar;
function ubah_tanda($result) {
$result = strtolower($result);
$result = preg_replace('/&.+?;/', '', $result);
$result = preg_replace('/\s+/', '-', $result);
$result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '-', $result);
$result = preg_replace('|-+|', '-', $result);
$result = preg_replace('/&#?[a-z0-9]+;/i','',$result);
$result = preg_replace('/[^%A-Za-z0-9 _-]/', '-', $result);
$result = trim($result, '-');
return $result;
}
if ($termstring!='') {
$googleresults = perform_google_web_search($termstring);
foreach ($googleresults as $result) {
$tits= strip_tags($result['title']);
$tits= preg_replace('/&.+?;/', '', $tits); 
$tits= preg_replace('/\s+/', ' ', $tits);
$tits= preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $tits);
$tits= preg_replace('|-+|', ' ', $tits);
$tits= preg_replace('/&#?[a-z0-9]+;/i','',$tits);
$tits= preg_replace('/[^%A-Za-z0-9 _-]/', ' ', $tits);
$tits= trim($tits, ' ');

$gambarg.= '<p align="center"><img style="max-width:100%" src="'.get_bloginfo('stylesheet_directory').'/images/load.gif" data-original="'.$result['url'].'" title="'.$result['desc'].' '.$tits.' '.$result['width'].'x'.$result['height'].' Movie-index.com" alt="'.$result['desc'].' '.$tits.' '.$result['width'].'x'.$result['height'].' Movie-index.com"/><noscript><img style="max-width:100%" src="'.$result['url'].'" title="'.$result['desc'].' '.$tits.' '.$result['width'].'x'.$result['height'].' Movie-index.com" alt="'.$result['desc'].' '.$tits.' '.$result['width'].'x'.$result['height'].' Movie-index.com"/></noscript></p>';
}
$gambarg ='<div align="center">'.$gambarg.'</div>';
}

$content = $content[0].'<div class="jwts_tabbertab" title="Gallery"><h2><a href="#Gallery">Gallery</a></h2>'.$gambarg.$content[1];

$content = explode('<div class="jwts_tabber" id="jwts_tab">', $content);
$content = $content[0].'<div class="jwts_tabber" id="jwts_tab">'.$content[1];
return $content;
}

// Comment Template
function comment_template($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
	<div id="div-comment-<?php comment_ID(); ?>" class="comment-body rounded">
		<?php echo get_avatar($comment,$size='45'); ?>
		
		<div class="comment-meta">
			<font class="author"><?php printf(__('%s'), comment_author_link()) ?></font>
			<br/><?php comment_time('d M Y, g:i a'); ?>
		</div>
	
		<div class="clear"></div>
			
		<div class="comment-text">
			<?php if ($comment->comment_approved == '0') : ?>
			<div class="moderation">
				<?php _e('Your comment is awaiting moderation.') ?>
			</div>
			<?php endif; ?>
			<?php comment_text() ?>
		</div>
		<div class="comment-options">
			<?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply', 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?> <?php edit_comment_link('Edit','| ',''); ?>
		</div>
	</div>
	
<?php }

// Themes Options Menu
function get_theme_option($option)
{
	global $shortname;
	return stripslashes(get_option($shortname . '_' . $option));
}

function get_theme_settings($option)
{
	return stripslashes(get_option($option));
}
$themename = "Theme";
$shortname = "theme";
$options = array (
array(	"name" => "WPMovies.com SCRIPT Options",
      	"type" => "title"),
array(	"type" => "open"),
/*
        array( 
	"name" => "Email for License",
        "desc" => "Your Registered Email",
        "id" => $shortname."_licensemail",
        "std" => "",
        "type" => "text"),

	array(  
	"name" => "License Key",
        "desc" => "Your license key. Buy or Register Here",
        "id" => $shortname."_license",
        "std" => "",
        "type" => "text"),
*/
	array(  
	"name" => "WPMovies Script Password",
        "desc" => "This will secure your WPMovies Script",
        "id" => $shortname."_wpmoviepass",
        "std" => "",
        "type" => "text"),

array(	"type" => "closesci"),

array(	"name" => "General Options",
      	"type" => "title"),

array(	"type" => "open"),
	
		array(  
		"name" => "Select Style?",
        "desc" => "Choose your site style",
        "id" => $shortname."_style",
        "options" => array('light', 'dark'),
        "std" => "dark",
        "type" => "select"),

		array(  
		"name" => "Enable Frame Breaker?",
        "desc" => "Enable Frame Breaker?",
        "id" => $shortname."_breaker",
        "options" => array('yes', 'no'),
        "std" => "yes",
        "type" => "select"),
		
		array(  
		"name" => "Enable Video Trailer?",
        "desc" => "Enable Auto Generate Video from YouTube in Single Page?",
        "id" => $shortname."_trailer",
        "options" => array('yes', 'no'),
        "std" => "yes",
        "type" => "select"),
		
		array(  
		"name" => "Amazon affiliate ID",
        "desc" => "Enable amazon dvd sales with your affiliate id",
        "id" => $shortname."_amazon",
        "std" => "",
        "type" => "text"),

		array(
		"name" => "Ads Below Trailer Code",
        "desc" => "Enter the advertisement below trailer code, display on all single page",
        "id" => $shortname."_728t",
        "std" => "",
        "type" => "textarea"),

		array(
		"name" => "Ads 336x280 Code",
        "desc" => "Enter the advertisement 336x280 code, display on all page",
        "id" => $shortname."_336",
        "std" => "",
        "type" => "textarea"),
	
		array(
		"name" => "Header Code",
        "desc" => "Enter the content you want to display in < head >",
        "id" => $shortname."_head",
        "std" => "",
        "type" => "textarea"),
    

		array(
		"name" => "Footer Code",
        "desc" => "Enter the content you want to display in your theme's footer( good for tracker )",
        "id" => $shortname."_footer",
        "std" => "",
        "type" => "textarea"),
        
		array("type" => "close"),

);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {

        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>
<div class="wrap">
<h2><?php echo $themename; ?> Options</h2>

<form method="post">

<?php foreach ($options as $value) {

switch ( $value['type'] ) {

case "open":
?>
<table width="800" border="0" style="background-color:#f5f5f5;border:1px solid #dddddd;padding:10px;">

<?php break;

case "close":
?>

</table><br />

<?php break;

case "closesci":
?>
<tr><td colspan="2"><div style="clear:both" align="center">use Right click &raquo; reload frame to refresh this page<br/><iframe src="/wpmovies/index.php" width="100%" height="550" scrolling="no"></iframe></div></td></tr>
</table><br />
<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>


<?php break;

case "title":
?>
<table width="800" border="0" style="background-color:#eeeeee;border:1px solid #dddddd;padding:5px;"><tr>
    <td colspan="2"><h3 style="font-family:Arial; margin: 0;"><?php echo $value['name']; ?></h3></td>
</tr>

<?php break;

case 'text':
?>

<tr>
    <td width="20%" rowspan="2" valign="top"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'textarea':
?>

<tr>
    <td width="20%" rowspan="2" valign="top"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea></td>

</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case 'select':
?>

<tr>
    <td width="20%" rowspan="2" valign="top"><strong><?php echo $value['name']; ?></strong></td>
    <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>

<tr>
    <td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
break;

case "checkbox":
?>
    <tr>
    <td width="20%" rowspan="2" valign="top"><strong><?php echo $value['name']; ?></strong></td>
        <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                </td>
    </tr>

    <tr>
        <td><small><?php echo $value['desc']; ?></small></td>
   </tr><tr><td colspan="2" style="margin-bottom:5px;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php         break;

}
}
?>
<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin');
?>