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
//on prend les droits de l'admin
$var = 'adminpowerpageview';
$adminpowerpageview = GetInfo($idcontrol,$var);
$var = 'adminpowernews';
$adminpowernews = GetInfo($idcontrol,$var);
$var = 'adminpowerpagepost';
$adminpowerpagepost = GetInfo($idcontrol,$var);
$var = 'adminpowersettings';
$adminpowersettings = GetInfo($idcontrol,$var);
$var = 'adminpoweraddadmin';
$adminpoweraddadmin = GetInfo($idcontrol,$var);
$var = 'adminpowerleague';
$adminpowerleague = GetInfo($idcontrol,$var);
?>

<p class="textalt">Go to: 
<a href="<?php echo"$directory"?>/Admin/index.php">
<?php if ($page =="index") {echo"<font color='$color4'>";}?>
index<?php if ($page =="index") {echo"</font>";}?></a> | 

<?php
if(isset($_GET['powerset']))
	{
?>
	<a href="<?php echo"$directory"?>/Admin/index.php">
	Admin panel access</a> | 
<?php
	}
	else
		{
if($adminpoweraddadmin == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/addadmin.php">
<?php if ($page =="addadmin") {echo"<font color='$color4'>";}?>
add admin<?php if ($page =="addadmin") {echo"</font>";}?></a> | 
<?php
	}
?>
<?php
if($adminpowernews == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/News/index.php">
<?php if ($page =="news") {echo"<font color='$color4'>";}?>
news<?php if ($page =="news") {echo"</font>";}?></a> | 
<?php
	}
?>
<?php
if($adminpowerleague == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/League/index.php">
<?php if ($page =="league") {echo"<font color='$color4'>";}?>
league management<?php if ($page =="league") {echo"</font>";}?></a> | 
<?php
	}
?>
<?php
if($adminpowersettings == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/settings.php">
<?php if ($page =="settings") {echo"<font color='$color4'>";}?>
settings<?php if ($page =="settings") {echo"</font>";}?></a> | 
<?php
	}
?>
<?php
if($adminpowerpagepost == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/post.php">
<?php if ($page =="post") {echo"<font color='$color4'>";}?>
add page<?php if ($page =="post") {echo"</font>";}?></a> | 
<?php
	}
?>
<?php
if($adminpowerpageview == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/view.php">
<?php if ($page =="view") {echo"<font color='$color4'>";}?>
view pages<?php if ($page =="view") {echo"</font>";}?></a> |
<?php
	}
		}
?>

</p>