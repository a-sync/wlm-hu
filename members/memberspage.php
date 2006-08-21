<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "memberspage";
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
if(isset($_GET['cksreg']))
	{
	if($_GET['cksreg'] == 1)
		{
		$timestamp_expire = time() + 30*24*3600; 
		setcookie('editname', $_POST['editname'], $timestamp_expire);
		setcookie('editnamepswd', $_POST['editnamepswd'], $timestamp_expire);
		}
	}
elseif((isset($_COOKIE['editname'])) && (isset($_COOKIE['editnamepswd'])) && ($_COOKIE['editnamepswd'] != 'null') && ($_COOKIE['editname'] != 'null'))
	{
	$timestamp_expire = time() + 30*24*3600; 
	setcookie('editname', $_COOKIE['editname'], $timestamp_expire);
	setcookie('editnamepswd', $_COOKIE['editnamepswd'], $timestamp_expire);
	}
require('./../top.php');
?>
<?php
$var = 'editname';
$editname = GetInfo($idcontrol,$var);
$var = 'editnamepswd';
$editnamepswd = GetInfo($idcontrol,$var);
if($editname == 'null')
	{
	if(! empty($_POST['editname']))
		{
		$editname = $_POST['editname'];
		}
		else
			{
			$editname = '';
			}
	}
if($editnamepswd == 'null')
	{
	if(! empty($_POST['editnamepswd']))
		{
		$editnamepswd = $_POST['editnamepswd'];
		}
		else
			{
			$editnamepswd = '';
			}
	}
echo '<p class="header">Felhasználói zóna</p>
	<hr align="left" width="30%" size="1">';
$querycheckpswd = "SELECT passworddb FROM $playerstable WHERE name='$editname'";
$queryresultcheckpswd = mysql_query($querycheckpswd);
$rowcheckpswd = mysql_fetch_row($queryresultcheckpswd);
$pswddb = $rowcheckpswd[0];
if(($pswddb != $editnamepswd) || ($editnamepswd == ''))
	{
	if($idcontrol == 'cookies')
		{
		$timestamp_expire = time() + 1; 
		setcookie('editname', 'null', $timestamp_expire);
		setcookie('editnamepswd', 'null', $timestamp_expire);
		}
	if($idcontrol == 'sessions')
		{
		$_SESSION['editnamepswd'] = 'null';
		$_SESSION['editname'] = 'null';
		}
?>
	<p class='text'>Nem sikerült bejelentkezni. Própáld újra.<?php if($idcontrol == "cookies"){echo "<br><i>(A böngészõdben engedélyezned kell a sütiket!)</i>";} ?></p>
	<p class='text'><a href='<?php echo $directory ?>/members/index.php'><font color='$color1'>Bejelentkezés...</font></a></p>
<?php
	}
	else
		{
		if($idcontrol == 'sessions')
			{	
			$_SESSION['editnamepswd'] = $editnamepswd;
			$_SESSION['editname'] = $editname;
			}
		echo "<p class='text'>Be vagy jelentkezve, <b>".$editname."</b> néven!</p>";
		$queryreader = "SELECT `player_id`,`passworddb` FROM `".$playerstable."` WHERE `name`='".$editname."'";
		$queryresultreader = mysql_query($queryreader);
		$resreader = mysql_fetch_row($queryresultreader);
		$reader_id = $resreader[0];
		$queryread = "SELECT * FROM `".$privmsgtable."` WHERE `Id_receiver`='".$reader_id."'";
		$queryresultread = mysql_query($queryread);
		$num = mysql_num_rows($queryresultread);		
?>
<table width="60%" border="1" cellspacing="0" cellpadding="10" align="center" bordercolor="<?php echo"$color1" ?>" bgcolor="<?php echo"$color5" ?>">
  <tr> 
    <td bgcolor="<?php echo"$color6" ?>"><center><font class="tops"><b><u>Felhasználói panel</u></b></font></center></td>
  </tr>
	<tr>
	  <td>
		<p><font class='header'><a href="<?php echo $directory ?>/members/readprivmsg.php"><img src="../icons/readpms.png" border="0" align="middle" alt=""></a>&nbsp;&nbsp;<a href="<?php echo $directory ?>/members/readprivmsg.php">Beérkezõ üzenet<?php if($num > 1)echo 'ek'; ?> <b>[</b><i><?php echo $num ?>&nbsp;db</i><b>]</b></a></font></p>
 
        <p><font class='header'><a href="<?php echo $directory ?>/members/sendprivmsg.php"><img src="../icons/sendpms.png" border="0" align="middle" alt=""></a>&nbsp;&nbsp;<a href="<?php echo $directory ?>/members/sendprivmsg.php">Üzenet küldése</a></font></p>

        <p><font class='header'><a href="<?php echo $directory ?>/members/editprofile.php"><img src="../icons/options.png" border="0" align="middle" alt=""></a>&nbsp;&nbsp;<a href="<?php echo $directory ?>/members/editprofile.php">Beállítások</a></font></p>

		<p><font class='header'><a href="<?php echo $directory ?>/members/deleteyourself.php"><img src="../icons/deletembr.png" border="0" align="middle" alt=""></a>&nbsp;&nbsp;<a href="<?php echo $directory ?>/members/deleteyourself.php">Felhasználói fiók törlése</a></font></p>

        <p><font class='header'><a href="<?php echo $directory ?>/members/index.php"><img src="../icons/signout.png" border="0" align="middle" alt=""></a>&nbsp;&nbsp;<a href="<?php echo $directory ?>/members/index.php">Kijelentkezés</a></font></p>

	  </td>
	</tr>
</table>
<?php
		}
require('./../bottom.php');
?>