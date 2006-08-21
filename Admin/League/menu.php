<?php
if(! empty($_GET['page']))
	{
	$page = $_GET['page'];
	}
	else
		{
		$page = '0';
		}
?>
<?php
$var = 'adminpowerleagueaddgame';
$adminpowerleagueaddgame = GetInfo($idcontrol,$var);
$var = 'adminpowerleagueapprove';
$adminpowerleagueapprove = GetInfo($idcontrol,$var);
$var = 'adminpowerleagueblockuser';
$adminpowerleagueblockuser = GetInfo($idcontrol,$var);
$var = 'adminpowerleaguedeletegame';
$adminpowerleaguedeletegame = GetInfo($idcontrol,$var);
$var = 'adminpowerleaguedeleteuser';
$adminpowerleaguedeleteuser = GetInfo($idcontrol,$var);
$var = 'adminpowerleagueedituser';
$adminpowerleagueedituser = GetInfo($idcontrol,$var);
$var = 'adminpowerleagueip';
$adminpowerleagueip = GetInfo($idcontrol,$var);
$var = 'adminpowerleaguereport';
$adminpowerleaguereport = GetInfo($idcontrol,$var);
$var = 'adminpowerleagueresetseason';
$adminpowerleagueresetseason = GetInfo($idcontrol,$var);
$var = 'adminpowerisset';
$adminpowerisset = GetInfo($idcontrol,$var);

?>
<p class="textalt">Go to: 
<?php
if($adminpowerisset == 'no')
	{
?>
	<a href="<?php echo"$directory"?>/Admin/index.php?powerset=1">
	Admin panel access</a> | 
<?php
	}
	else
		{
?>
<a href="<?php echo"$directory"?>/Admin/index.php">
<?php if ($page =="index") {echo"<font color='$color4'>";}?>
admin index<?php if ($page =="index") {echo"</font>";}?></a> | 
<?php
if($adminpowerleagueapprove == 'yes')
	{
?>
<?php if ($approve == "yes") {
?>
<a href="<?php echo"$directory"?>/Admin/League/adduser.php">
<?php if ($page =="approve") {echo"<font color='$color4'>";}?>
add player<?php if ($page =="approve") {echo"</font>";}?></a> | 
<?php
}
	}
?>
<?php
if($adminpowerleagueedituser == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/League/edituser.php">
<?php if ($page =="edituser") {echo"<font color='$color4'>";}?>
edit player<?php if ($page =="edituser") {echo"</font>";}?></a> | 
<?php
	}
if($adminpowerleagueblockuser == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/League/blockuser.php">
<?php if ($page =="blockuser") {echo"<font color='$color4'>";}?>
block player<?php if ($page =="blockuser") {echo"</font>";}?></a> | 
<?php
	}
if($adminpowerleaguedeleteuser == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/League/deleteuser.php">
<?php if ($page =="deleteuser") {echo"<font color='$color4'>";}?>
delete player<?php if ($page =="deleteuser") {echo"</font>";}?></a> | 
<?php
	}
if($adminpowerleaguereport == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/League/report.php">
<?php if ($page =="report") {echo"<font color='$color4'>";}?>
report game<?php if ($page =="report") {echo"</font>";}?></a> | 
<?php
	}
if($adminpowerleagueaddgame == 'yes')
	{
?>
<?php if ($approvegames == "yes") {
?>
<a href="<?php echo"$directory"?>/Admin/League/addgame.php">
<?php if ($page =="addgame") {echo"<font color='$color4'>";}?>
record game<?php if ($page =="addgame") {echo"</font>";}?></a> | 
<?php
}
?>
<?php
	}
if($adminpowerleaguedeletegame == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/League/deletegame.php?startgames=0&finishgames=<?php echo"$numgamespage"?>">
<?php if ($page =="deletegame") {echo"<font color='$color4'>";}?>
delete game<?php if ($page =="deletegame") {echo"</font>";}?></a> | 
<?php
	}
if($adminpowerleagueip == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/League/ip.php">
<?php if ($page =="ip") {echo"<font color='$color4'>";}?>
ip check<?php if ($page =="ip") {echo"</font>";}?></a> | 
<?php
	}
if($adminpowerleagueresetseason == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/League/resetseason.php">
<?php if ($page =="resetseason") {echo"<font color='$color4'>";}?>
reset season<?php if ($page =="reset season") {echo"</font>";}?></a> | 
<?php
	}
		}
?>
</p>