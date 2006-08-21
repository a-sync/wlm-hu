<?php
$page = "members";
require('../variables.php');
require('../variablesdb.php');
require('../functions.php');
if($idcontrol == 'cookies')
	{
	if(isset($_GET['cksreg']))
		{
		if($_GET['cksreg'] == 1)
			{
			$timestamp_expire = time() + 1; 
			setcookie('editname', 'null', $timestamp_expire);
			setcookie('editnamepswd', 'null', $timestamp_expire);
			}
		}
	}
if(isset($_GET['sesreg']))
	{
	if($_GET['sesreg'] == 1)
		{
		$_SESSION['editnamepswd'] = 'null';
		$_SESSION['editname'] = 'null';
		}
	}
require('../top.php');
?> 
 <p class="header">Felhasználói zóna</p>
 <hr align="left" width="30%" size="1">
<?php
$var = 'editname';
$editname = GetInfo($idcontrol,$var);
$var = 'editnamepswd';
$editnamepswd = GetInfo($idcontrol,$var);
if($editname == 'null')
	{
	$editname = '';
	}
if($editnamepswd == 'null')
	{
	$editnamepswd = '';
	}
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
		$editname = 'null';
		$editnamepswd = 'null';
		}
	if($idcontrol == 'sessions')
		{
		$_SESSION['editnamepswd'] = 'null';
		$_SESSION['editname'] = 'null';
		$editname = 'null';
		$editnamepswd = 'null';
		}
	}
//	elseif((isset($_COOKIE['editname'])) && (isset($_COOKIE['editnamepswd'])) && ($_COOKIE['editnamepswd'] != 'null') && ($_COOKIE['editname'] != 'null'))
//		{
//		$timestamp_expire = time() + 30*24*3600; 
//		setcookie('editname', $_COOKIE['editname'], $timestamp_expire);
//		setcookie('editnamepswd', $_COOKIE['editnamepswd'], $timestamp_expire);
//		}

if(($editname != 'null') && ($editnamepswd != 'null'))
	{
	if(isset($_GET['cksreg']))
		{
		if($_GET['cksreg'] == 1)
			{
			echo "<p class='text'>";
			if($idcontrol == 'cookies'){echo 'Az adataidat tartalmazó süti törlõdött. ';}
			echo "Sikeresen kijelentkeztél!</p>";
			}
		}
			else
				{
?>
				<p class='text'>Be vagy jelentkezve, <b><?php echo $editname; ?></b> néven!<br><?php if($idcontrol == 'sessions'){echo 'Kijelentkezéshez az is elég ha bezárod a böngészõdet.';} ?></p>
				<p class="text">
					<input type="button" value="Kijelentkezés" onclick="location.href='<?php echo $directory ?>/members/index.php<?php if($idcontrol == 'cookies'){echo '?cksreg=1';} ?><?php if($idcontrol == 'sessions'){echo '?sesreg=1';} ?>'"></p>
<?php
				}
	}
	else
		{
?>
<form method="post" action="<?php echo $directory; ?>/members/memberspage.php<?php if($idcontrol == 'cookies'){echo '?cksreg=1';} ?>">
  <table border="0">
  <tr>
    <td><p class="text"><b>Név:&nbsp;</b></p></td>
<td><select name="editname" size="1" class="text" style="background-color: <?php echo"$color5" ?>">
<?php
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable WHERE approved = 'yes' ORDER BY $sortby";
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
</select></td>
  </tr>
    <tr> 
      <td><p class="text"><b>Jelszó:&nbsp;</b></p></td>
      <td colspan="2"> <input type="password" size="15" name="editnamepswd" style="background-color: <?php echo"$color5" ?>" class="text" align="left"></td>
    </tr>
    <tr><td height="4" colspan="2"></td></tr>
    <tr> 
      <td colspan="2">
          <input type="Submit" name="submit2" value="Bejelentkezés" class="text">
<?php
if($allowpswdmail == 'yes')
	{
?>
	  &nbsp;<input type="button" value="Elfelejtett jelszó!" onclick="MM_callJS('MM_openBrWindow(\'<?php echo $directory.'/members/forgotpswd.php' ?>\',\'\',\'width=480,height=160\')')">
<?php
	}
?>
	  </td>
	</tr>
  </table>
</form>
<?php
		}
require('../bottom.php');
?>