<?
if($lebar==""){$lebar = '480';}
if($tinggi==""){$tinggi = '300';}
$titlee = str_replace('-',' ',$_GET[t]);
$titlee= strip_tags($titlee);
$titlee= preg_replace('/&.+?;/', '', $titlee);
$titlee= preg_replace('/\s+/', ' ', $titlee);
$titlee= preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $titlee);
$titlee= preg_replace('|-+|', '', $titlee);
$titlee= preg_replace('/&#?[a-z0-9]+;/i','',$titlee);
$titlee= preg_replace('/[^%A-Za-z0-9 _-]/', '', $titlee);
$titlee= trim($titlee);

$titleq = str_replace(' ','+',$titlee.'+trailer');
$feedUrl = 'http://gdata.youtube.com/feeds/base/videos?q='.$titleq.'&client=ytapi-youtube-search&alt=rss&v=2&max-results=1';
if($xml = simplexml_load_file($feedUrl)) {          
        $result["item"] = $xml->xpath("/rss/channel/item"); 
        foreach($result as $key => $attribute) { 
            $i=0; 
            foreach($attribute as $element) { 
				 $ret[$i]['link'] = (string)$element->link; 
                 $i++; 
            } 
        } 
}  
$i=0;
$p = 1;
$link= $ret[$i]['link'];
$link = substr($link, strlen('http://www.youtube.com/watch?v='));
$link = substr($link , 0, strpos($link , '&'));
echo $stream_video = '<iframe width="'.$lebar.'" height="'.$tinggi.'" src="http://www.youtube.com/embed/'.$link.'" frameborder="0" allowfullscreen></iframe>';
?>