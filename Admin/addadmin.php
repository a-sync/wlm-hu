<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "addadmin";
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
require('./../top.php');
?>
<?php
//récupération des infos
$var = 'username';
$username = GetInfo($idcontrol,$var);
$var = 'password';
$password = GetInfo($idcontrol,$var);
//verification de l'existance de l'admin
$sql="SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
$result=mysql_query($sql);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpoweraddadmin == 'yes')) {
?>
<p class="header">Add admin.</p>
<?php
if (isset($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}
if ($submit == 1) {
if(! empty($_POST['name']))
	{
	$name = $_POST['name'];
	}
	else
		{
		$name = $username;
		}
$sql="SELECT * FROM $admintable WHERE name = '$name'";
$result=mysql_query($sql);
$samenick = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$actualpswd = $row['password'];
$nopassword = 0;
if(! empty($_POST['password']))
	{
	$password = $_POST['password'];
	}
	else
		{
		$nopassword = 1;
		}
if ($samenick < 1) {
if(empty($_POST['adminpowerpageview']))
	{
	$adminpowerpageview = 'no';
	}
	else
		{
		$adminpowerpageview = 'yes';
		}
if(empty($_POST['adminpowerpagepost']))
	{
	$adminpowerpagepost = 'no';
	}
	else
		{
		$adminpowerpagepost = 'yes';
		}
if(empty($_POST['adminpowersettings']))
	{
	$adminpowersettings = 'no';
	}
	else
		{
		$adminpowersettings = 'yes';
		}
if(empty($_POST['adminpoweraddadmin']))
	{
	$adminpoweraddadmin = 'no';
	}
	else
		{
		$adminpoweraddadmin = 'yes';
		}
if(empty($_POST['adminpowerleague']))
	{
	$adminpowerleague = 'no';
	}
	else
		{
		$adminpowerleague = 'yes';
		}
if(empty($_POST['adminpowerleagueaddgame']))
	{
	$adminpowerleagueaddgame = 'no';
	}
	else
		{
		$adminpowerleagueaddgame = 'yes';
		}
if(empty($_POST['adminpowerleagueapprove']))
	{
	$adminpowerleagueapprove = 'no';
	}
	else
		{
		$adminpowerleagueapprove = 'yes';
		}
if(empty($_POST['adminpowerleagueblockuser']))
	{
	$adminpowerleagueblockuser = 'no';
	}
	else
		{
		$adminpowerleagueblockuser = 'yes';
		}
if(empty($_POST['adminpowerleaguedeletegame']))
	{
	$adminpowerleaguedeletegame = 'no';
	}
	else
		{
		$adminpowerleaguedeletegame = 'yes';
		}
if(empty($_POST['adminpowerleaguedeleteuser']))
	{
	$adminpowerleaguedeleteuser = 'no';
	}
	else
		{
		$adminpowerleaguedeleteuser = 'yes';
		}
if(empty($_POST['adminpowerleagueedituser']))
	{
	$adminpowerleagueedituser = 'no';
	}
	else
		{
		$adminpowerleagueedituser = 'yes';
		}
if(empty($_POST['adminpowerleagueip']))
	{
	$adminpowerleagueip = 'no';
	}
	else
		{
		$adminpowerleagueip = 'yes';
		}
if(empty($_POST['adminpowerleaguereport']))
	{
	$adminpowerleaguereport = 'no';
	}
	else
		{
		$adminpowerleaguereport = 'yes';
		}
if(empty($_POST['adminpowerleagueresetseason']))
	{
	$adminpowerleagueresetseason = 'no';
	}
	else
		{
		$adminpowerleagueresetseason = 'yes';
		}
if(empty($_POST['adminpowernews']))
	{
	$adminpowernews = 'no';
	}
	else
		{
		$adminpowernews = 'yes';
		}
if(empty($_POST['adminpowernewspost']))
	{
	$adminpowernewspost = 'no';
	}
	else
		{
		$adminpowernewspost = 'yes';
		}
if(empty($_POST['adminpowernewsview']))
	{
	$adminpowernewsview = 'no';
	}
	else
		{
		$adminpowernewsview = 'yes';
		}
$sql = "INSERT INTO $admintable ( `name` , `password` , `adminpowerpageview` , `adminpowerpagepost` , `adminpowersettings` , `adminpoweraddadmin` , `adminpowerleague` , `adminpowerleagueaddgame` , `adminpowerleagueapprove` , `adminpowerleagueblockuser` , `adminpowerleaguedeletegame` , `adminpowerleaguedeleteuser` , `adminpowerleagueedituser` , `adminpowerleagueip` , `adminpowerleaguereport` , `adminpowerleagueresetseason` , `adminpowernews` , `adminpowernewspost` , `adminpowernewsview` ) 
	VALUES ('$name', '$password', '$adminpowerpageview', '$adminpowerpagepost', '$adminpowersettings', '$adminpoweraddadmin', '$adminpowerleague', '$adminpowerleagueaddgame', '$adminpowerleagueapprove', '$adminpowerleagueblockuser', '$adminpowerleaguedeletegame', '$adminpowerleaguedeleteuser', '$adminpowerleagueedituser', '$adminpowerleagueip', '$adminpowerleaguereport', '$adminpowerleagueresetseason$', '$adminpowernews', '$adminpowernewspost', '$adminpowernewsview' )";
$result = mysql_query($sql);
echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/addadmin.php'><font color='$color1'>Add another admin</font>.</a></p>";
}
elseif($nopassword == 1)
	{
	echo "<p class='text'>You must enter a password.</p>";
	}
else {
echo "<p class='text'>The name you entered already exist.</p>";
if($actualpswd == $password)
	{
	echo "<p class='text'>Updating admin's power settings ...</p>";
if(empty($_POST['adminpowerpageview']))
	{
	$adminpowerpageview = 'no';
	}
	else
		{
		$adminpowerpageview = 'yes';
		}
if(empty($_POST['adminpowerpagepost']))
	{
	$adminpowerpagepost = 'no';
	}
	else
		{
		$adminpowerpagepost = 'yes';
		}
if(empty($_POST['adminpowersettings']))
	{
	$adminpowersettings = 'no';
	}
	else
		{
		$adminpowersettings = 'yes';
		}
if(empty($_POST['adminpoweraddadmin']))
	{
	$adminpoweraddadmin = 'no';
	}
	else
		{
		$adminpoweraddadmin = 'yes';
		}
if(empty($_POST['adminpowerleague']))
	{
	$adminpowerleague = 'no';
	}
	else
		{
		$adminpowerleague = 'yes';
		}
if(empty($_POST['adminpowerleagueaddgame']))
	{
	$adminpowerleagueaddgame = 'no';
	}
	else
		{
		$adminpowerleagueaddgame = 'yes';
		}
if(empty($_POST['adminpowerleagueapprove']))
	{
	$adminpowerleagueapprove = 'no';
	}
	else
		{
		$adminpowerleagueapprove = 'yes';
		}
if(empty($_POST['adminpowerleagueblockuser']))
	{
	$adminpowerleagueblockuser = 'no';
	}
	else
		{
		$adminpowerleagueblockuser = 'yes';
		}
if(empty($_POST['adminpowerleaguedeletegame']))
	{
	$adminpowerleaguedeletegame = 'no';
	}
	else
		{
		$adminpowerleaguedeletegame = 'yes';
		}
if(empty($_POST['adminpowerleaguedeleteuser']))
	{
	$adminpowerleaguedeleteuser = 'no';
	}
	else
		{
		$adminpowerleaguedeleteuser = 'yes';
		}
if(empty($_POST['adminpowerleagueedituser']))
	{
	$adminpowerleagueedituser = 'no';
	}
	else
		{
		$adminpowerleagueedituser = 'yes';
		}
if(empty($_POST['adminpowerleagueip']))
	{
	$adminpowerleagueip = 'no';
	}
	else
		{
		$adminpowerleagueip = 'yes';
		}
if(empty($_POST['adminpowerleaguereport']))
	{
	$adminpowerleaguereport = 'no';
	}
	else
		{
		$adminpowerleaguereport = 'yes';
		}
if(empty($_POST['adminpowerleagueresetseason']))
	{
	$adminpowerleagueresetseason = 'no';
	}
	else
		{
		$adminpowerleagueresetseason = 'yes';
		}
if(empty($_POST['adminpowernews']))
	{
	$adminpowernews = 'no';
	}
	else
		{
		$adminpowernews = 'yes';
		}
if(empty($_POST['adminpowernewspost']))
	{
	$adminpowernewspost = 'no';
	}
	else
		{
		$adminpowernewspost = 'yes';
		}
if(empty($_POST['adminpowernewsview']))
	{
	$adminpowernewsview = 'no';
	}
	else
		{
		$adminpowernewsview = 'yes';
		}
$sql = "UPDATE $admintable SET `adminpowerpageview` = '$adminpowerpageview',
`adminpowerpagepost` = '$adminpowerpagepost',
`adminpowersettings` = '$adminpowersettings',
`adminpoweraddadmin` = '$adminpoweraddadmin',
`adminpowerleague` = '$adminpowerleague',
`adminpowerleagueaddgame` = '$adminpowerleagueaddgame',
`adminpowerleagueapprove` = '$adminpowerleagueapprove',
`adminpowerleagueblockuser` = '$adminpowerleagueblockuser',
`adminpowerleaguedeletegame` = '$adminpowerleaguedeletegame',
`adminpowerleaguedeleteuser` = '$adminpowerleaguedeleteuser',
`adminpowerleagueedituser` = '$adminpowerleagueedituser',
`adminpowerleagueip` = '$adminpowerleagueip',
`adminpowerleaguereport` = '$adminpowerleaguereport',
`adminpowerleagueresetseason` = '$adminpowerleagueresetseason',
`adminpowernews` = '$adminpowernews',
`adminpowernewspost` = '$adminpowernewspost',
`adminpowernewsview` = '$adminpowernewsview' WHERE name = '$name'";
$update = mysql_query($sql);
echo "<p class='text'>Power settings for ".$name." were correctly updated.</p>";
	}
	else
		{
		echo "<p class='text'>Wrong password. <br>You must enter the actual password of this admin to update his power settings.<br>Power settings can't be updated for ".$name.".</p>";
		}
}
}
else{
?>
<form method="post" action="addadmin.php?submit=1">
<table border="0" cellpadding="0">
<tr>
<td><p class="text">Name:</p></td>
<td><input type="Text" name="name" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Password:</p></td>
<td><input type="password" name="password" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
</table>
  <p>To edit an existing account's power, fill the form with the existing name 
    and password of that account (with his new power settings)</p>
  <table width="70%" border="1">
    <tr>
      <td><font size="+1">Allow this account to :</td>
    </tr>
  </table>
  <table width="70%" border="1">
    <tr> 
      <td width="57%"><input type="checkbox" name="adminpoweraddadmin" value="yes">
        <font size="+1">Add admins</td>
      <td width="43%"><input type="checkbox" name="adminpowersettings" value="yes">
        <font size="+1">Edit the settings</td>
    </tr>
    <tr> 
      <td><input type="checkbox" name="adminpowerpageview" value="yes">
        <font size="+1">View/edit/delete added webpages</td>
      <td><input type="checkbox" name="adminpowerpagepost" value="yes">
        <font size="+1">Add new web pages</td>
    </tr>
  </table>
  <table width="70%" border="1">
    <tr> 
      <td colspan="3"><input type="checkbox" name="adminpowerleague" value="yes">
        <font size="+1">Reach the league management </td>
    </tr>
    <tr> 
      <td><input type="checkbox" name="adminpowerleagueaddgame" value="yes">
        <font size="+1">Approve games</td>
      <td><input type="checkbox" name="adminpowerleagueapprove" value="yes">
        <font size="+1">Approve players</td>
      <td><input type="checkbox" name="adminpowerleagueblockuser" value="yes">
        <font size="+1">Block players</td>
    </tr>
    <tr> 
      <td><input type="checkbox" name="adminpowerleagueedituser" value="yes">
        <font size="+1">Edit players' profile</td>
      <td><input type="checkbox" name="adminpowerleaguedeleteuser" value="yes">
        <font size="+1">Delete a member</td>
      <td><input type="checkbox" name="adminpowerleagueip" value="yes">
        <font size="+1">Check shared ips</td>
    </tr>
    <tr> 
      <td><input type="checkbox" name="adminpowerleaguedeletegame" value="yes">
        <font size="+1">Delete a game</td>
      <td><input type="checkbox" name="adminpowerleaguereport" value="yes">
        <font size="+1">Report a game</td>
      <td><input type="checkbox" name="adminpowerleagueresetseason" value="yes">
        <font size="+1">Reset the season</td>
    </tr>
  </table>
  <table width="70%" border="1">
    <tr> 
      <td colspan="2"><input type="checkbox" name="adminpowernews" value="yes">
        <font size="+1">Reach the news management </td>
    </tr>
    <tr> 
      <td width="57%"><input type="checkbox" name="adminpowernewsview" value="yes">
        <font size="+1">View/edit/delete existing news</td>
      <td width="43%"><input type="checkbox" name="adminpowernewspost" value="yes">
        <font size="+1">Post news</td>
    </tr>
  </table>
  <p>
    <input type="Submit" name="submit" value="Submit." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
    <br>
    <br>
  </p>
</form>
</p>
<?php
}
?>
<?php
}
else {
echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
}
require('./../bottom.php');
?>

