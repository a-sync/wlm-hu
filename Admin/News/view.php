<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "view";
require('./../../variables.php');
require('./../../variablesdb.php');
require('./../../functions.php');
require('./../../top.php');
?>
<?php
$var = 'username';
$username = GetInfo($idcontrol,$var);
$var = 'password';
$password = GetInfo($idcontrol,$var);
$sql="SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
$result=mysql_query($sql,$db);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpowernewsview == 'yes')) {
if(isset($_GET['read']))
	{
	$ready = 1;
	$read = $_GET['read'];
	}
	else
		{
		$ready = 0;
		}
?>
<p class="header">News articles.</p>
<?php
if ($ready) {
?>
<?php
$sortby = "news_id DESC";
$start = "0";
$finish = "1";
$sql="SELECT * FROM $newstable WHERE news_id = '$read'ORDER BY $sortby LIMIT $start, $finish";
$result=mysql_query($sql,$db);
$row = mysql_fetch_array($result);
$news = $row["news"];
$news = nl2br($news);
$news = SmileyConvert($news,$directory);
$date = $row["date"];
$title = $row["title"];
?>
<p class="text"><b><?php echo"$date</b> - <b>$title" ?></b></p>
<p class="text"><?php echo"$news" ?></p>
<hr size="1" color="<?php echo"$color1" ?>"><br>
<?php
}
?>
<table border="1" cellspacing="1" cellpadding="2" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>">
<tr>
<td align='center' bordercolor='<?php echo"$color7" ?>'><img border='1' src='<?php echo"$directory" ?>/icons/view.gif' width='18' height='18' align='middle'></td>
<td align='center' bordercolor='<?php echo"$color7" ?>'><img border='1' src='<?php echo"$directory" ?>/icons/edit.gif' width='18' height='18' align='middle'></td>
<td align='center' bordercolor='<?php echo"$color7" ?>'><img border='1' src='<?php echo"$directory" ?>/icons/delete.gif' width='18' height='18' align='middle'></td>
<td align='left' bordercolor='<?php echo"$color7" ?>'><p class='text'><b>Article<b></p></td></tr>
<?php
$sortby = "news_id DESC";
$start = "0";
$finish = "100000";
$sql="SELECT * FROM $newstable ORDER BY $sortby LIMIT $start, $finish";
$result=mysql_query($sql,$db);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) {
$row = mysql_fetch_array($result);
$date = $row["date"];
$title = $row["title"];
$read = $row["news_id"];
?>
<?php echo"
<tr>
<td align='center' bordercolor='$color7'><a href='view.php?read=$read'><font color='$color1'>View.</a></td>
<td align='center' bordercolor='$color7'><a href='edit.php?edit=$read'><font color='$color1'>Edit.</a></td>
<td align='center' bordercolor='$color7'><a href='delete.php?edit=$read'><font color='$color1'>Delete.</a></td>
<td align='left' bordercolor='$color7'><p class='text'>$date - $title</td></tr>
" ?>
<?php
$cur++;
}
?>
</table>
<br>
<?php
}
else {
echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
}
require('./../../bottom.php');
?>