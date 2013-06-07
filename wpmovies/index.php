<?php function sanitize_output($buffer){$search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');$replace = array('>','<','\\1');$buffer = preg_replace($search, $replace, $buffer);return $buffer;}ob_start("sanitize_output");require_once('config.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Wordpress Movie Clone by Wp Movies</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/structure.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />
<script type="text/javascript" src="scripts/wufoo.js"></script>
<style type="text/css">
body { font-family: Verdana; font-size: 12px; margin: 0 10px; background-color:#f1f1f1;}
a {text-decoration: none; outline: none; color: #205B87;} 
a:hover {text-decoration:underline;}
h2, h3 { padding: 5px 0; margin: 0; font-family: Cambria, Georgia, Helvetica; font-size: 17px; }
form { padding: 2px; border-bottom: solid 2px #ccc; }
p { margin: 0 2px; padding: 5px; }
input { padding: 4px; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;}
#container { padding: 4px; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;}
input[type=text] {width:350px;}
input.date {width:50px;}
.wrap { width: 780px; margin: 0 auto; margin-top:10px; background-color:#fff; padding: 10px; }
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

<body id="public">
<div id="container" class="wrap shadow">
<form id="form1" class="wufoo topLabel" autocomplete="off" enctype="multipart/form-data" method="POST" action="go.php">
<div class="info">
	<h1 style="text-align:center;"><a href="http://wpmovies.com" target="_blank">Wordpress Movie Clone by WP Movies</a></h1>
</div>
<ul>
	<li>
	<label class="desc" id="title8" for="Field8">[WPmovie] Script Password:</label>
	<div>
		<input id="Field8"	class="field text medium" name="pass" tabindex="15" type="password" maxlength="255" value="" />
	</div>
		<p class="instruct" id="instruct8"><small>Please enter your script password. [you can change on <strong>setting.php</strong>]</small></p>
	</li>
	
	<li id="fo1li16">	
			<label class="desc" id="title10" for="Field10">Put IMDb link, one per line :</label>
			<div>
				<textarea id="Field16" class="field textarea medium" name="link" rows="10" cols="50"></textarea>
			</div>
			<p class="instruct " id="instruct16"><small>Put IMDb link, one per line. Be sure to end with "/" slash<br />
			Ex:<br />
			http://www.imdb.com/title/tt1657507/<br/>
			http://www.imdb.com/title/tt0800369/<br/>
			http://www.imdb.com/title/tt1392170/<br/>
			----------------------<br />
			</small></p>
	</li>

	<li class="buttons">
		<input id="saveForm" class="btTxt" type="submit" value="Submit"/>
	</li>
</ul>
</form>
<div align="left">

<? $queryulo="SELECT url FROM ". $wpdb->prefix . "wizimdb order by id asc limit 5";
$queryulsum="SELECT count(*) FROM ". $wpdb->prefix . "wizimdb";$sisa = mysql_query($queryulsum)or die('Ups..Something went wrong..');$sisa = mysql_result($sisa , 0);
$film =  mysql_query($queryulo) or die('Ups..Something went wrong..');?>
<h3>You Have Next Queued Movie (total <?=$sisa;?>) &raquo; <a href="get.php">Post Now</a>:</h3><ul>
<? while($e=mysql_fetch_array($film))	{
$link= $e[url];
echo '<li>'.$link.'</li>';
}?>
</ul>
</div>
<?=$powered;?>
</div><!--container-->
<img id="bottom" src="images/bottom.png" alt=""/>
</body>
</html>