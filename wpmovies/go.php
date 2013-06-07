<html>
<head>
  <meta charset="utf-8" />
  <title>Wordpress Movie Clone</title>
  <style type="text/css">
body { font-family: Verdana; font-size: 13px; margin: 0 10px; background-color:#f1f1f1;}
a {text-decoration: none; outline: none; color: #205B87;} 
a:hover {text-decoration:underline;}
h2, h3 { padding: 5px 0; margin: 0; font-family: Cambria, Georgia, Helvetica; font-size: 17px; }
form { padding: 2px; border-bottom: solid 2px #ccc; }
p { margin: 0 2px; padding: 5px; }
input { padding: 4px; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;}
input[type=text] {width:350px;}
input.date {width:50px;}
.wrap { width: 780px; margin: 0 auto; margin-top:10px; background-color:#fff; padding: 10px;text-align:center }
.movieInfo { width: 100%; line-height: 25px; padding-left: 5px; }
.shadow { -moz-box-shadow: 5px 5px 5px #ccc; -webkit-box-shadow: 5px 5px 5px #ccc; box-shadow: 5px 5px 5px #ccc;}	
/* Table */
.tabel {border-collapse: collapse; border-color:#ccc;}
.tabel tr {border:1px solid #ccc;}
.tabel td {border:1px solid #ccc;padding:2px 5px;}
.tabel th {border:1px solid #ccc;padding:2px 7px;}
.tabel td span {display:none;}
hr {clear:both;margin:20px 0;}
p.left{float:left;}
</style>
</head>
<body>
<div class="wrap shadow">
<h1><a href="http://wpmovie.com">Wordpress Movie Clone</a></h1>
<p><?php
require_once('config.php');
$email = $youremail;
$linkuri=$_POST[link];
$categorie=1;
$author=1;
$data = time();
$admin_check_pass = $_POST[pass];

if(($linkuri!="")&&($categorie!="")&&($data!="")&&($author!="")&&($admin_check_pass==$admin_pass))
	{
	$linkuri=explode("\n",$linkuri);
	$table_name = $wpdb->prefix . "wizimdb";
	
   	 		if($wpdb->get_var("show tables like '$table_name'") != $table_name)
   			 {
   	 			  $sql = "CREATE TABLE ".$table_name." (
				  id mediumint(9) NOT NULL AUTO_INCREMENT,url tinytext NOT NULL,
				  data text NOT NULL,category text NOT NULL,author text NOT NULL,email varchar(255) NOT NULL,
				  UNIQUE KEY id (id)
				);";

   	 		  $results = $wpdb->query($sql);
			  }
	
	echo '<div style="overflow:auto;max-height:600px;width:500px">';
	for($i=0;$i<sizeof($linkuri);$i++)
		{
		if(strlen($linkuri[$i])>=1)
			{
			$linkul=trim($linkuri[$i]);

						
			$insert = "INSERT INTO ".$table_name." (url, data, category,author,email) " ."VALUES('".$linkul."','".$data."','".$author."','".$categorie."','".$email."')";
			$results = $wpdb->query($insert);
			echo '<p align="left">Link: <a href="'.$linkul.'" target="_blank" rel="nofollow">'.trim($linkul).'</a> <- success.</p>';
							
			}

		}
	echo '</div><p align="left"><strong style="color:red">Success submit '.$i.' IMDb link</strong></p>';

	}
else
	{

	echo 'All form must be filled or wrong information provided!! Press back button..';

	}
?>
<div align="left">
<h3>Next Queued Movie:</h3><ul>
<? $queryulo="SELECT url FROM ". $wpdb->prefix . "wizimdb order by id asc limit 5";
$film =  mysql_query($queryulo);
while($e=mysql_fetch_array($film))	{
$link= $e[url];
echo '<li>'.$link.'</li>';
}?>
</ul>
</div>
<p>
<a href="get.php">Click Here to Post Next Movie</a> | <a href="index.php">Click Here to Post New Link</a>
</p>
<div class="movieInfo">
</div>
<?=$powered;?>
</div>

</body>
</html>