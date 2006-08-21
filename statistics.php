<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "statistics";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
?>
<p class="header">Statistics.</p>
<form method="post" action="<?php echo"$directory"?>/statistics.php">
<p class="text"><select size="1" name="stat" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<?php
if(! empty($_POST['stat']))
	{
	$stat = $_POST['stat'];
	}
	else
		{
		$stat = 'select';
		}
if ($stat == 'select') {
?>
<option><?php echo"$stat" ?></option>
<?php
}
?>
<option>Best rating</option>
<option>Most games played</option>
<?php
if ($system == "points") {
?>
<option>Most points</option>
<?php
}
?>
<option>Most wins</option>
<option>Most losses</option>
<option>Best streak</option>
<option>Worst streak</option>
</select> <input type="Submit" name="submit" value="View." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
</form>
<p align="left" class="text">
<table width="40%" border="1" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>" cellspacing="0" cellpadding="1">
<tr>
<td bordercolor="<?php echo"$color7" ?>" align="left" nowrap><p class="text"><b>
<?php
if ($stat == "Best rating") {
$sortby = "rating DESC";
}
else if ($stat == "Most games played") {
$sortby = "totalgames DESC";
}
else if ($stat == "Most points") {
$sortby = "totalpoints DESC";
}
else if ($stat == "Most wins") {
$sortby = "totalwins DESC";
}
else if ($stat == "Most losses") {
$sortby = "totallosses DESC";
}
else if ($stat == "Best streak") {
$sortby = "streakwins DESC";
}
else if ($stat == "Worst streak") {
$sortby = "streaklosses DESC";
}
else {
$stat = "Best rating";
$sortby = "rating DESC";
}
echo "&nbsp;$stat:";
?>
</b></p>
</td>
<td bordercolor="<?php echo"$color7" ?>" align="left" nowrap><p class="text"></td>
</tr>
<tr>
<td bordercolor="<?php echo"$color7" ?>" align="left" nowrap><p class="text">&nbsp;</p></td>
   <td bordercolor="<?php echo"$color7" ?>" align="left" nowrap><p class="text">&nbsp;</p></td>
</tr>
<?php
$sql="SELECT * FROM $playerstable WHERE totalgames > 0 ORDER BY $sortby LIMIT 0,$statsnum";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) {
$row = mysql_fetch_array($result);
$name = $row["name"];
$approved = $row["approved"];
if ($approved == "no") {
$namepage = "<font color='#FF0000'>$name</font>";
}
else {
$namepage = "<font color='$color1'>$name</font>";
}
$country = $row["country"];
$wins = $row["wins"];
$losses = $row["losses"];
$totalwins = $row["totalwins"];
$totallosses = $row["totallosses"];
$streakwins = $row["streakwins"];
$streaklosses = $row["streaklosses"];
//$penalties = $row["penalties"];
$rating = $row ["rating"];
$totalgames = $row["totalgames"];
$totalpoints = $row["totalpoints"];
$totalwins = $row["totalwins"];
$totallosses = $row["totallosses"];
if ($totalgames <= 0) {
$totalpercentage = 0.000;
}
else {
$totalpercentage = $totalwins / $totalgames;
}
$streakwins = $row["streakwins"];
$streaklosses = $row["streaklosses"];
?>
<tr>
<td bordercolor="<?php echo"$color7" ?>" align="left" nowrap><p class='text'>&nbsp;<?php echo "<img src='$directory/flags/$country.bmp' align='absmiddle' border='1'>&nbsp;<a href='$directory/profile.php?name=$name'><font color='$color1'>$namepage</font></a>"?>&nbsp;</p></td>
<td bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">
<?php
if ($stat == "Best rating") {
echo "$rating";
}
if ($stat == "Most games played") {
echo "$totalgames";
}
if ($stat == "Most points") {
echo "$totalpoints";
}
if ($stat == "Most wins") {
echo "$totalwins";
}
if ($stat == "Most losses") {
echo "$totallosses";
}
if ($stat == "Best streak") {
echo "$streakwins";
}
if ($stat == "Worst streak") {
echo "$streaklosses";
}
?>
</p></td>
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

