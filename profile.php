<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "profile";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
?>
<p class="header">Profile.</p><br>
<?php
if (! empty($_GET['name']))
	{
	$name = $_GET['name'];
	} 
	else
		{
		$name = 'null';
		}
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable WHERE name = '$name' ORDER BY $sortby";
$result=mysql_query($sql,$db);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) 
	{
	$row = mysql_fetch_array($result);
	$name = $row["name"];
	$approved = $row["approved"];
	if ($approved == "no") 
		{
		$blocked = "(<font color='#FF0000'>blocked or not added yet</font>)";
		}
	else 
		{
		$blocked = "";
		}
	$msn = $row["msn"];
	$mail = $row["mail"];
	$rank = $row["rank"];
	if ($mail == "n/a") 
		{
		$mailaddress = "n/a";
		$mailpic = "";
		}
	else 
		{
		$mailaddress = "<a href='mailto:$mail'><font color='$color1'>$mail</font></a>";
		$mailpic = "<img border='1' src='icons/mail.gif' align='absmiddle'></a>";
		}
	$icq = $row["icq"];
	if ($icq == "n/a") 
		{
		$icqnumber = "n/a";
		$icqpic = "";
		}
	else 
		{
		$icqnumber = "<a href='http://web.icq.com/whitepages/add_me?uin=$icq&action=add'><font color='$color1'>$icq</font></a>";
		$icqpic = "<img border='1' src='icons/icq.gif' align='absmiddle'></a>";
		}
	$aim = $row["aim"];
	if ($aim == "n/a") 
		{
		$aimname = "n/a";
		$aimpic = "";
		}
	else 
		{
		$aimname = "<a href='aim:AddBuddy?ScreenName=$aim'><font color='$color1'>$aim</font></a>";
		$aimpic = "<img border='1' src='icons/aim.gif' align='absmiddle'></a>";
		}
	$msn = $row["msn"];
	if ($msn == "n/a") 
		{
		$msnname = "n/a";
		$msnpic = "";
		}
	else 
		{
		$msnname = "$msn";
		$msnpic = "<img border='1' src='icons/msn.gif' align='absmiddle'></a>";
		}
	$country = $row["country"];
	$rating = $row["rating"];
	$wins = $row["wins"];
	$losses = $row["losses"];
	$points = $row["points"];
	$games = $row["games"];
	if ($games <= 0) 
		{
		$percentage = 0.000;
		}
	else 
		{
		$percentage = $wins / $games;
		}
	$total = $wins + $losses;
	$totalwins = $row["totalwins"];
	$totallosses = $row["totallosses"];
	$totalpoints = $row["totalpoints"];
	$totaltotal = $totalwins + $totallosses;
	if ($totaltotal <= 0) 
		{
		$totalpercentage = 0.000;
		}
	else 
		{
		$totalpercentage = $totalwins / $totaltotal;
		}
	$totalgames = $row["totalgames"];
	$streakwins = $row["streakwins"];
	$streaklosses = $row["streaklosses"];
	if ($streakwins >= 1) 
		{
		$streak = "+$streakwins";
		}
	else if($streaklosses >= 1) 
		{
		$streak = "-$streaklosses";
		}
	else 
		{
		$streak = 0;
		}
?>
<p class="text">Name: <?php echo "$name $blocked" ?><br></p>
<table border="0" cellspacing="0" cellpadding="2">
<tr>
<td nowrap><p class="text">From:</p></td>
<td nowrap><p class="text"><?php echo "<img src='$directory/flags/$country.bmp' align='absmiddle' border='1'> $country"?></p></td>
</tr>
<tr>
<td nowrap><p class="text">E-Mail:</p></td>
<td nowrap><p class="text"><?php echo "$mailpic $mailaddress" ?></p></td>
</tr>
<tr>
<td nowrap><p class="text">Icq:</p></td>
<td nowrap><p class="text"><?php echo "$icqpic $icqnumber"?></p></td>
</tr>
<tr>
<td nowrap><p class="text">Aim:</p></td>
<td nowrap><p class="text"><?php echo "$aimpic $aimname" ?></p></td>
</tr>
<tr>
<td nowrap><p class="text">Msn:</p></td>
<td nowrap><p class="text"><?php echo "$msnpic $msnname" ?></p></td>
</tr>
</table>
<p class="text">
<?php
	if ($system == "ladder") 
		{
		echo"Rank: $rank<br>";
		}
?>
Rating: <?php printf("%.0f", $rating); ?><br>
Streak: <?php echo "$streak" ?><br><br>
This season<br>
Games: <?php echo "$games" ?><br>
Wins: <?php echo "$wins" ?><br>
Losses: <?php echo "$losses" ?><br>
<?php
	if ($system == "points") 
		{
		echo"Points: $points<br>";
		}
?>
Percentage: <?php printf("%.3f", $percentage); ?><br><br>
Total<br>
Games: <?php echo "$totalgames" ?><br>
Wins: <?php echo "$totalwins" ?><br>
Losses: <?php echo "$totallosses" ?><br>
<?php
	if ($system == "points") 
		{
		echo"Points: $totalpoints<br>";
		}
?>
Percentage: <?php printf("%.3f", $totalpercentage); ?><br><br></p>
<?php
	$cur++;
	} 
?>
<?php
require('bottom.php');
?>

