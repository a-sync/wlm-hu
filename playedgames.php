<?php
$page = "playedgames";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
if(! empty($_GET['startplayed']))
	{
	$startplayed = $_GET['startplayed'];
	}
	else
		{
		$startplayed = '0';
		}
if(! empty($_GET['finishplayed']))
	{
	$finishplayed = $_GET['finishplayed'];
	}
	else
		{
		$finishplayed = '30';
		}
if(! empty($_POST['selectname']))
	{
	$selectname = $_POST['selectname'];
	}
	else
		{
		$selectname = '';
		}
?>
<p class="header">Played games.</p>
<form method="post" action="<?php echo"$directory"?>/playedgames.php?startplayed=0&finishplayed=<?php echo"$numgamespage"?>">
<p class="text"><a href="<?php echo"$directory"?>/playedgames.php?startplayed=0&finishplayed=<?php echo"$numgamespage"?>"><font color="<?php echo"$color1"?>">View all games</font></a> | 
View games from: <select size="1" name="selectname" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<?php
if ($selectname == '') {
?>
<option><?php echo"$selectname" ?></option>
<?php
}
?>
<?php
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable ORDER BY $sortby";
$result=mysql_query($sql,$db);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) {
$row = mysql_fetch_array($result);
$name = $row["name"];
?>
<option><?php echo "$name" ?></option>
<?php
$cur++;
} 
?>
</select> <input type="Submit" name="submit2" value="View." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
</form>
<?php
$sortby = "game_id DESC";
$sql="SELECT * FROM $gamestable ORDER BY $sortby";
$result=mysql_query($sql);
$yo = mysql_num_rows($result);
if(!empty($_GET['number']))
	{
	$number = $_GET['number'];
	}
	else
		{
		$number = 0;
		}
if(!empty($_GET['link']))
	{
	$link = $_GET['link'];
	}
	else
		{
		$link = 1;
		}
$finishnumber = $numgamespage;
$startnext = $startplayed + $numgamespage;
$startprevious = $startplayed - $numgamespage;
$lastpage = $yo - $numgamespage;
$prevnumber = $number - $numgamespage;
$prevlink = $link - 1;
$nextnumber = $number + $numgamespage;
$nextlink = $link + 1; 
$compteur = 1;
$compteurgfx = 1;
$maxlink = 0;
$compteur2 = 0;
while ($compteur2 < $yo)
	{
	$compteur2 = $compteur2 + $numgamespage;
	$maxlink++;
	}
$maxnumber = ($maxlink - 1) * $numgamespage;
echo "<p class='text'>Go to page :";
if ($startprevious >= $numgamespage) {
echo " <a href='$directory/playedgames.php?startplayed=0&finishplayed=$finishnumber&number=0&link=1'><font color='$color1'><<</font></a> |";
}
if ($startprevious >= 0) {
echo " <a href='$directory/playedgames.php?startplayed=$startprevious&finishplayed=$finishnumber&number=$prevnumber&link=$prevlink'><font color='$color1'><</font></a> |";
}
while (($number < $yo) && ($compteur < $maxgameslinkpage)) {
echo " <a href='$directory/playedgames.php?startplayed=$number&finishplayed=$finishnumber&number=$number&link=$link'><font color='";
if($compteurgfx == 1)
	{
	echo $color3;
	}
	else
		{
		echo $color1;
		}
echo "'>$link</font></a> ";
$number = $number + $numgamespage;
if($startplayed < $lastpage) { echo "| ";}
$link++;
$compteur++;
$compteurgfx++;
}
if ($startplayed < $lastpage) {
echo "<a href='$directory/playedgames.php?startplayed=$startnext&finishplayed=$finishnumber&number=$nextnumber&link=$nextlink'><font color='$color1'>></font></a>";
}
if ($startplayed < ($yo - ($numgamespage*2))) {
echo " | <a href='$directory/playedgames.php?startplayed=$lastpage&finishplayed=$finishnumber&number=$maxnumber&link=$maxlink'><font color='$color1'>>></font></a> ";
}
if ($approvegames == "yes") {
$tablewidth = "90%";
$width = "20%";
}
else {
$width = "25%";
$tablewidth = "80%";
}
?>
<br><br>
<table width="<?php echo"$tablewidth" ?>" border="1" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>" cellspacing="0" cellpadding="2">
<tr>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Game id</b></p></td>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Winner</b></p></td>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Loser</b></p></td>
<?php
if ($reportresult == "yes") {
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Results</b></p></td>
<?php
}
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Date</b></p></td>
<?php
if ($approvegames == "yes") {
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Status</b></p></td>
<?php
}
?>
</tr>
<tr>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<?php
if ($reportresult == "yes") {
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<?php
}
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<?php
if ($approvegames == "yes") {
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<?php
}
?>
</tr>
<?php
$sortby = "game_id DESC";
if ($selectname) {
$sql="SELECT * FROM $gamestable WHERE winner = '$selectname' OR loser = '$selectname'  ORDER BY $sortby LIMIT $startplayed, $finishplayed";
}
else {
$sql="SELECT * FROM $gamestable ORDER BY $sortby LIMIT $startplayed, $finishplayed";
}
$result=mysql_query($sql);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) {
$row = mysql_fetch_array($result);
$gameid = $row["game_id"];
$winner = $row["winner"];
$loser = $row["loser"];
$winnerresult = $row["winnerresult"];
$loserresult = $row["loserresult"];
$date = $row["date"];
$recorded = $row["recorded"];
if ($recorded == "yes") {
$status = "recorded";
}
else {
$status = "pending";
}
?>
<tr>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p align="center"><input name="Submit" type="button" onClick="MM_openBrWindow('<?php echo $directory.'/showgameinfo.php?id='.$gameid ?>','','width=477,height=363')" value="<?php echo $gameid ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></p></td>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo "$winner" ?></p></td>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo "$loser" ?></p></td>
<?php
if ($reportresult == "yes") {
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo $winnerresult." - ".$loserresult ?></p></td>
<?php
}
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo "$date" ?></p></td>
<?php
if ($approvegames == "yes") {
?>
<td width="<?php echo"$width" ?>" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo "$status" ?></p></td>
<?php
}
?>
</tr>
<?php
$cur++;
}
?>
</table>
<br>
<?php
require('bottom.php');
?>