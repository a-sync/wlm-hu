<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "addgame";
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
if (($number == "1") && ($adminpowerleagueaddgame == 'yes')) {
?>
<p class="header">Record a game.</p>
<?php
if(! empty($_GET['add']))
	{
	$add = $_GET['add'];
	$addy = 1;
	}
	else
		{
		$add = 0;
		$addy = 0;
		}
if ($addy) 
	{
	$rec = 'yes';
	$sql="SELECT * FROM $gamestable WHERE game_id = '$add'";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	$game_id = $row["game_id"];
	$winnername = $row["winner"];
	$losername = $row["loser"];
	$date = $row["date"];
	$winnerresult = $row["winnerresult"];
	$loserresult = $row["loserresult"];
	$comment = $row['comment'];
	$relatedreplay = $row['relatedreplay'];
	$report = ReportGame($winnername,$losername,$date,$comment,$relatedreplay,$rec,$add);
	echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/report.php'><font color='$color1'>Record another game</font></a>.</p>";
	} 
	else 
		//si pas de submit
		{
?>
<?php
$sortby = "game_id DESC";
$sql="SELECT * FROM $gamestable WHERE recorded = 'no' ORDER BY $sortby";
$result=mysql_query($sql,$db);
$num = mysql_num_rows($result);
if ($num < 1) {
echo"<p class='text'>There are no games to be recorded.</p>";
}
else {
?>
<table width="60%" border="1" cellspacing="0" cellpadding="2" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>">
<tr>
<td align='center' bordercolor='<?php echo"$color7" ?>'><img border='1' src='<?php echo"$directory" ?>/icons/add.gif' width='18' height='18' align='middle'></td>
<td bordercolor='<?php echo"$color7" ?>'><p class='text'><b>Winner</b></p></td>
<td bordercolor='<?php echo"$color7" ?>'><p class='text'><b>Loser</b></p></td>
<td bordercolor='<?php echo"$color7" ?>'><p class='text'><b>Date</b></p></td>
</tr>
<?php
}
$cur = 1;
while ($num >= $cur) {
$row = mysql_fetch_array($result);
$game_id = $row["game_id"];
$winner = $row["winner"];
$loser = $row["loser"];
$date = $row["date"];
?>
<?php echo"
<tr>
<td align='center' bordercolor='$color7'>
<a href='addgame.php?add=$game_id'><font color='$color1'>Add</a>.
</td>
<td bordercolor='$color7'><p class='text'>
$winner</p></td>
<td bordercolor='$color7'><p class='text'>
$loser</p></td>
<td bordercolor='$color7'><p class='text'>
$date</p></td>
</tr>" ?>
<?php
$cur++;
} 
if ($num > 0) {
?>
</table>
<br>
<?php
}
}
}
else {
echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
}
require('./../../bottom.php');
?>