<?php
require_once('config.php');

$data = time();
$admin_check_pass= $_GET[key];


if(($categorie!="")&&($data!="")&&($authore!=""))
	{
$link = 'http://www.imdb.com/movies-in-theaters/';
$imdb_content = get_data($link);

//$opening = get_match('/<h3>Opening This Week<\/h3>(.*)<\/table>/isU',$imdb_content );
$opening = explode('In Theaters Now - Box Office Top Ten',$imdb_content);
$opening = explode('<h4 itemprop="name">',$opening[0]);

for($i=1;$i < count($opening);$i++){

$titleid = get_match('/href="\/title\/(.*)\/"/isU',$opening[$i]);
if($titleid!=""){
$idne .= 'http://www.imdb.com/title/'.$titleid.'/<br>';
}
}
//echo '<h2>This Week</h2>'.$idne;

$linkuri=$idne;
	$linkuri=explode("<br>",$linkuri);
	$table_name = $wpdb->prefix ."wizimdb";

   	 		if($wpdb->get_var("show tables like '$table_name'") != $table_name)
   			 {
   	 			  $sql = "CREATE TABLE ".$table_name." (
				  id mediumint(9) NOT NULL AUTO_INCREMENT,url tinytext NOT NULL,
				  data text NOT NULL,category text NOT NULL,author text NOT NULL,email varchar(255) NOT NULL,
				  UNIQUE KEY id (id)
				);";

   	 		  $results = $wpdb->query($sql);
			  }

	//echo '<div style="overflow:auto;max-height:600px;width:500px">';
	for($i=0;$i<sizeof($linkuri);$i++)
		{
		if(strlen($linkuri[$i])>=1)
			{
			$linkul=trim($linkuri[$i]);

			$insert = "INSERT INTO ".$table_name." (url, data, category,author,email) " ."VALUES('".$linkul."','".$data."','".$authore."','".$categorie."','".$email."')";
			$results = $wpdb->query($insert);
			echo '<p align="left">Link: <a href="'.$linkul.'" target="_blank" rel="nofollow">'.$linkul.'</a> <- success.</p>';

			}

		}
	echo 'Success submit '.$i.' IMDb link';

	}
else
	{

	echo 'All form must be filled or wrong information provided!!';

	}

?>