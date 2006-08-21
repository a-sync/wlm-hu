<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "page";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
?>
<?php
if(!empty($_GET['number']))
	{
	$number = $_GET['number'];
	}
	else
		{
		$number = 0;
		}
$sql="SELECT * FROM $pagestable WHERE page_id = '$number'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$title = $row["title"];
$content = $row["page"];
$content = nl2br($content);
$content = SmileyConvert($content,$directory);
echo "<p class='header'>$title.</p>
<p class='text'>$content</p>";
?>
<?php
require('bottom.php');
?>

