<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "players";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
?>
<p class="header">Players.</p>
<?php
if (! empty($_GET['startplayers']))
	{
	$startplayers = $_GET['startplayers'];
	}
	else
		{
		$startplayers = 0;
		}		
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable ORDER BY $sortby";
$result=mysql_query($sql);
$yo = mysql_num_rows($result);
$number = 0;
$link = 1;
$finishnumber = $numplayerspage;
$startnext = $startplayers + $numplayerspage;
$startprevious = $startplayers - $numplayerspage;
echo "<p class='text'>Go to page:";
if ($startprevious >= 0) {
echo "&nbsp;|&nbsp;<a href='$directory/players.php?startplayers=$startprevious&finishplayers=$finishnumber'><font color='$color1'><</font></a>&nbsp;|";
}
while ($number < $yo) {
echo "&nbsp;<a href='$directory/players.php?startplayers=$number&finishplayers=$finishnumber'><font color='$color1'>$link</font></a>&nbsp;|&nbsp;";
$number = $number + $numgamespage;
$link = $link + 1;
}
if ($startplayers < $yo - $numplayerspage) {
echo "<a href='$directory/playersgames.php?startplayers=$startnext&finishplayers=$finishnumber'><font color='$color1'>></font></a>&nbsp;|";
}
?>
<br><br>
<table width="80%" border="1" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>" cellspacing="0" cellpadding="2">
<tr>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Player</b></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Mail</b></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Icq</b></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Aim</b></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><b>Msn</b></p></td>
</tr>
<tr>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text">&nbsp;</p></td>
</tr>
<?php
$sortby = "name ASC";
if (! empty($_GET['finishplayers']))
	{
	$finishplayers = $_GET['finishplayers'];
	}
	else
		{
		$finishplayers = $finishnumber;
		}
$sql="SELECT * FROM $playerstable ORDER BY $sortby, games ASC LIMIT $startplayers, $finishplayers";
$result=mysql_query($sql);
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
$mail = $row["mail"];
if ($mail == "n/a") {
$mailaddress = "n/a";
$mailpic = "";
}
else {
$mailaddress = "<a href='mailto:$mail'><font color='$color1'>mail</font></a>";
$mailpic = "<img border='1' src='icons/mail.gif' align='absmiddle'></a>";
}
$icq = $row["icq"];
if ($icq == "n/a") {
$icqnumber = "n/a";
$icqpic = "";
}
else {
$icqnumber = "<a href='http://web.icq.com/whitepages/add_me?uin=$icq&action=add'><font color='$color1'>add</font></a>";
$icqpic = "<img border='1' src='icons/icq.gif' align='absmiddle'></a>";
}
$aim = $row["aim"];
if ($aim == "n/a") {
$aimname = "n/a";
$aimpic = "";
}
else {
$aimname = "<a href='aim:AddBuddy?ScreenName=$aim'><font color='$color1'>add</font></a>";
$aimpic = "<img border='1' src='icons/aim.gif' align='absmiddle'></a>";
}
$msn = $row["msn"];
if ($msn == "n/a") {
$msnname = "n/a";
$msnpic = "";
}
else {
$msnname = "<a href='mailto:$msn'><font color='$color1'>mail</font></a>";
$msnpic = "<img border='1' src='icons/msn.gif' align='absmiddle'></a>";
}
$country = $row["country"];
?>
<tr>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="left" nowrap><p class='text'><?php echo "<img src='$directory/flags/$country.bmp' align='absmiddle' border='1'>&nbsp;<a href='$directory/profile.php?name=$name'><font color='$color1'>$namepage</font></a>"?></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo "$mailpic $mailaddress" ?></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo "$icqpic $icqnumber" ?></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo "$aimpic $aimname" ?></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" nowrap><p class="text"><?php echo "$msnpic $msnname" ?></p></td>
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