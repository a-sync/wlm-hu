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
$var = 'adminpowernewspost';
$adminpowernewspost = GetInfo($idcontrol,$var);
$var = 'adminpowernewsview';
$adminpowernewsview = GetInfo($idcontrol,$var);
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
if($adminpowernewspost == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/News/post.php">
<?php if ($page =="post") {echo"<font color='$color4'>";}?>
post news<?php if ($page =="post") {echo"</font>";}?></a> | 
<?php
	}
if($adminpowernewsview == 'yes')
	{
?>
<a href="<?php echo"$directory"?>/Admin/News/view.php">
<?php if ($page =="view") {echo"<font color='$color4'>";}?>
view news<?php if ($page =="view") {echo"</font>";}?></a> |
<?php
	}
		}
?>
</p>