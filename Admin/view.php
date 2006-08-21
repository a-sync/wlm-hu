<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "view";
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
require('./../top.php');
?>
<?php
$var = 'username';
$username = GetInfo($idcontrol,$var);
$var = 'password';
$password = GetInfo($idcontrol,$var);
$sql="SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
$result=mysql_query($sql);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpowerpageview == 'yes')) {
?>
<p class="header">Pages.</p>
<?php
if(isset($_GET['read']))
	{
	$ready = 1;
	$read = $_GET['read'];
	}
	else
		{
		$ready = 0;
		}
if ($ready) {
?>
<?php
$sortby = "page_id DESC";
$start = "0";
$finish = "1";
$sql="SELECT * FROM $pagestable WHERE page_id = '$read' ORDER BY $sortby LIMIT $start, $finish";
$result=mysql_query($sql,$db);
$row = mysql_fetch_array($result);
$content = $row["page"];
$content = nl2br($content);
$content = SmileyConvert($content,$directory);
$title = $row["title"];
?>
<p class="text"><b><?php echo"$title" ?></b></p>
<p class="text"><?php echo"$content" ?></p>
<hr size="1" color="<?php echo"$color1" ?>"><br>
<?php
}
?>
<table border="1" cellspacing="1" cellpadding="2" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>">
<tr>
<td align='center' bordercolor='<?php echo"$color7" ?>'><img border='1' src='<?php echo"$directory" ?>/icons/view.gif' width='18' height='18' align='middle'></td>
<td align='center' bordercolor='<?php echo"$color7" ?>'><img border='1' src='<?php echo"$directory" ?>/icons/edit.gif' width='18' height='18' align='middle'></td>
<td align='center' bordercolor='<?php echo"$color7" ?>'><img border='1' src='<?php echo"$directory" ?>/icons/delete.gif' width='18' height='18' align='middle'></td>
<td align='left' bordercolor='<?php echo"$color7" ?>'><p class='text'><b>Page<b></p></td></tr>
<?php
$sortby = "page_id DESC";
$start = "0";
$finish = "100000";
$sql="SELECT * FROM $pagestable ORDER BY $sortby LIMIT $start, $finish";
$result=mysql_query($sql,$db);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) {
$row = mysql_fetch_array($result);
$title = $row["title"];
$read = $row["page_id"];
?>
<?php echo"
<tr>
<td align='center' bordercolor='$color7'><a href='view.php?read=$read'><font color='$color1'>View.</a></td>
<td align='center' bordercolor='$color7'><a href='edit.php?edit=$read'><font color='$color1'>Edit.</a></td>
<td align='center' bordercolor='$color7'><a href='delete.php?edit=$read'><font color='$color1'>Delete.</a></td>
<td align='left' bordercolor='$color7'><p class='text'>$title</td></tr>
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
require('./../bottom.php');
?>