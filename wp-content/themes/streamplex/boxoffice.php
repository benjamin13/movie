<?
$file_cache = ABSPATH.'wp-content/themes/streamplex/boxoffice.txt';
$batas_umur_cache = 3600*24*3;
if (file_exists($file_cache) && (time() < (filemtime($file_cache)+$batas_umur_cache) )){
    include($file_cache);  echo "<br/><!–- Cached on ".date('d-m-Y H:i', filemtime($file_cache))." –>\n";
}else{ob_start();?>
<ul><?php
function get_match($regex,$content)
{
    preg_match($regex,$content,$matches);
    return $matches[1];
}
 
function get_data($url)
{
    $ch = curl_init();
    $timeout = 25;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    curl_setopt($ch, CURLOPT_REFERER, 'http://www.imdb.com/');
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaE51-1/100.34.20; Profile/MIDP-2.0 Configuration/CLDC-1.1 ) AppleWebKit/413 (KHTML, like Gecko) Safari/413");
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
 
$link = 'http://www.imdb.com/chart/';
$box_content = get_data($link);
$content = explode('<tbody>',$box_content);
$contente = explode('href="/title/tt',$content[1]);
for($i=1;$i<=7;$i++){
$item[$i] = trim(strip_tags(get_match('/>(.*)</isU',$contente[$i])));
if(strlen($item[$i]) > 20){$item[$i]= substr($item[$i], 0, 21). '...' ;}
 
$fun[$i] = trim(strip_tags(get_match('/<td style="text-align: right;">(.*)</isU',$contente[$i])));
?>
<li><div class="feat-post"><a href="#" rel="bookmark" onClick="window.open('/teaser.php?t=<?=str_replace(array("'"," "),array('','-'),$item[$i]);?>','mywindow','scrollable=0,resizable=0,width=495,height=345')" title="<?=$item[$i];?>"><?=$i;?>. <?=$item[$i]?></a></div><div class="comment-bubble"><?=$fun[$i];?></div><div class="dot"></div></li>
 
<? }?></ul>
<?  $fp = fopen($file_cache, 'w');
    fwrite($fp, ob_get_contents());
    fclose($fp);
    ob_end_flush();
}?>