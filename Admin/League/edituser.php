<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "edituser";
require('./../../variables.php');
require('./../../variablesdb.php');
require('./../../functions.php');
require('./../../top.php');
?>
<?php
$var = 'username';
$username = GetInfo($idcontrol,$var);
$var = 'password';
$password = GetInfo($idcontrol,$var);
$sql="SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
$result=mysql_query($sql,$db);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpowerleagueedituser == 'yes')) {
?>
<p class="header">Edit user.</p>
<?php
if(! empty($_POST['edituser']))
	{
	$edituser = $_POST['edituser'];
	$edity = 0;
	}
	else
		{
		$edity = 1;
		$edituser = 'null';
		}
if ($edity) {
?>
<form method="post" action="edituser.php">
<table border="0" cellpadding="0">
<tr>
<td><p class="text">Name:</p></td>
<td><select size="1" name="edituser" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
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
</select></td>
</tr>
</table>
<p class="text"><input type="Submit" name="submit2" value="Edit." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br><br>
</form>
</p>
<?php
}
else {
if (isset($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}
if ($submit) 
	{
	if (! empty($_POST['blocked']))
		{
		$blocked = $_POST['blocked'];
		}
		else
			{
			$blocked = 'no';
			}
	if (! empty($_POST['wins']))
		{
		$wins = $_POST['wins'];
		}
		else
			{
			$wins = 0;
			}
	if (! empty($_POST['mail']))
		{
		$mail = $_POST['mail'];
		}
		else
			{
			$mail = 'yourmail@yourisp.com';
			}
	if (! empty($_POST['icq']))
		{
		$icq = $_POST['icq'];
		}
		else
			{
			$icq = 'N/A';
			}
	if (! empty($_POST['aim']))
		{
		$aim = $_POST['aim'];
		}
		else
			{
			$aim = 'N/A';
			}
	if (! empty($_POST['msn']))
		{
		$msn = $_POST['msn'];
		}
		else
			{
			$msn = 'N/A';
			}
	if (! empty($_POST['country']))
		{
		$country = $_POST['country'];
		}
		else
			{
			$country = 'No country';
			}
	if (! empty($_POST['losses']))
		{
		$losses = $_POST['losses'];
		}
		else
			{
			$losses = 0;
			}
	if (! empty($_POST['totalwins']))
		{
		$totalwins = $_POST['totalwins'];
		}
		else
			{
			$totalwins = 0;
			}
	if (! empty($_POST['totallosses']))
		{
		$totallosses = $_POST['totallosses'];
		}
		else
			{
			$totallosses = 0;
			}
	if (! empty($_POST['points']))
		{
		$points = $_POST['points'];
		}
		else
			{
			$points = 0;
			}
	if (! empty($_POST['totalpoints']))
		{
		$totalpoints = $_POST['totalpoints'];
		}
		else
			{
			$totalpoints = 0;
			}
	if (! empty($_POST['games']))
		{
		$games = $_POST['games'];
		}
		else
			{
			$games = 0;
			}
	if (! empty($_POST['totalgames']))
		{
		$totalgames = $_POST['totalgames'];
		}
		else
			{
			$totalgames = 0;
			}
	if (! empty($_POST['streakwins']))
		{
		$streakwins = $_POST['streakwins'];
		}
		else
			{
			$streakwins = 0;
			}
	if (! empty($_POST['streaklosses']))
		{
		$streaklosses = $_POST['streaklosses'];
		}
		else
			{
			$streaklosses = 0;
			}
	if (! empty($_POST['rating']))
		{
		$rating = $_POST['rating'];
		}
		else
			{
			$rating = 0;
			}
	if (! empty($_POST['rank']))
		{
		$rank = $_POST['rank'];
		}
		else
			{
			$rank = 0;
			}
	if ($system == "ladder") 
		{
		if ($rank < $rankold) 
			{
			$sql = "UPDATE $playerstable SET rank = rank + 1 WHERE rank > $rank - 1 AND rank < $rankold";
			$result = mysql_query($sql);
			}
		if ($rank > $rankold) 
			{
			$sql = "UPDATE $playerstable SET rank = rank - 1 WHERE rank < $rank + 1 AND rank > $rankold";
			$result = mysql_query($sql);
			}
		}
	if ($blocked == "yes") 
		{
		$approved = "no";
		}
	if ($blocked == "no") 
		{
		$approved = "yes";
		}
	$sql = "UPDATE $playerstable SET approved = '$approved', wins = '$wins', mail = '$mail', icq = '$icq', aim = '$aim', msn = '$msn', country = '$country', losses = '$losses', totalwins = '$totalwins', totallosses = '$totallosses', points = '$points', totalpoints = '$totalpoints', games = '$games', totalgames = '$totalgames', streakwins = '$streakwins', streaklosses = '$streaklosses', rating = '$rating', rank = '$rank'  WHERE name='$edituser'";
	$result = mysql_query($sql);
	echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/edituser.php'><font color='$color1'>Edit another user</font></a>.</p>";
	} 
else
	{
?>
<?php
	$sortby = "name ASC";
	$sql="SELECT * FROM $playerstable WHERE name = '$edituser' ORDER BY $sortby";
	$result=mysql_query($sql,$db);
	$row = mysql_fetch_array($result);
	$mail = $row["mail"];
	$icq = $row["icq"]; 
	$aim = $row["aim"];
	$msn = $row["msn"];
	$country = $row["country"];
	$rating = $row["rating"];
	$wins = $row["wins"];
	$losses = $row["losses"];
	$points = $row["points"];
	$total = $wins + $losses;
	$totalwins = $row["totalwins"];
	$totallosses = $row["totallosses"];
	$totalpoints = $row["totalpoints"];
	$games = $row["games"];
	$rankold = $row["rank"];
	$rank = $row["rank"];
	$totalgames = $row["totalgames"];
	$streakwins = $row["streakwins"];
	$streaklosses = $row["streaklosses"];
	$approved = $row["approved"];
	if ($approved == "yes") 
		{
		$blocked = "no";
		}
	if ($approved == "no")
		{
		$blocked = "yes";
		}
?>
<form method="post" action="edituser.php?submit=1">
<table border="0" cellpadding="0">
<tr>
<td><p class="text"><b>General</b></p></td>
<td><p class="text">&nbsp;</p></td>
</tr>    
<tr>
<td><p class="text">Name:</p></td>
<td><select size="1" name="edituser" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option><?php echo "$edituser" ?></option>
</select>
</td>
</tr>
<tr>
<td><p class="text">Blocked:</p></td>
<td><select size="1" name="blocked" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">>
<option selected><?php echo "$blocked" ?></option>
<option>no</option>
<option>yes</option>
</select>
</td>
</tr>
<tr>
<td><p class="text">Mail:</p></td>
<td><input type="Text" name="mail" value="<?php echo "$mail" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Icq:</p></td>
<td><input type="Text" name="icq" value="<?php echo "$icq" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Aim:</p></td>
<td><input type="Text" name="aim" value="<?php echo "$aim" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Msn:</p></td>
<td><input type="Text" name="msn" value="<?php echo "$msn" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Country:</p></td>
<td><select size="1" name="country" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$country" ?></option>
<option>No country</option>
<option>Argentina</option>
<option>Australia</option>
<option>Austria</option>
<option>Belgium</option>
<option>Bosnia</option>
<option>Brazil</option>
<option>Bulgaria</option>
<option>Canada</option>
<option>Chile</option>
<option>Croatia</option>
<option>Cyprus</option>
<option>Czechoslavakia</option>
<option>Denmark</option>
<option>England</option>
<option>Finland</option>
<option>France</option>
<option>Georgia</option>
<option>Germany</option>
<option>Greece</option>
<option>Holland</option>
<option>Hong Kong</option>
<option>Hungary</option>
<option>Iceland</option>
<option>India</option>
<option>Indonesia</option>
<option>Iran</option>
<option>Iraq</option>
<option>Ireland</option>
<option>Israel</option>
<option>Italy</option>
<option>Japan</option>
<option>Leichenstein</option>
<option>Luxembourg</option>
<option>Malaysia</option>
<option>Malta</option>
<option>Mexico</option>
<option>Morocco</option>
<option>New Zealand</option>
<option>North Vietnam</option>
<option>Norway</option>
<option>Poland</option>
<option>Portugal</option>
<option>Puerto Rico</option>
<option>Qatar</option>
<option>Rumania</option>
<option>Russia</option>
<option>Scotland</option>
<option>Singapore</option>
<option>South Africa</option>
<option>Spain</option>
<option>Sweden</option>
<option>Switzerland</option>
<option>Turkey</option>
<option>United Kingdom</option>
<option>United States</option>
</select></td>
</tr>
<tr>
<td><br><p class="text"><b>Season<b></p></td>
<td><p class="text">&nbsp;</p></td>
</tr>
<tr>
<td><p class="text">Games:</p></td>
<td><input type="Text" name="games" value="<?php echo "$games" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Wins:</p></td>
<td><input type="Text" name="wins" value="<?php echo "$wins" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Losses:</p></td>
<td><input type="Text" name="losses" value="<?php echo "$losses" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<?php
	if ($system == "points") 
		{
?>
<tr>
<td><p class="text">Points (season):</p></td>
<td><input type="Text" name="points" value="<?php echo "$points" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<?php
		}
	else 
		{
?>
<input type="hidden" name="points" value="<?php echo "$points" ?>">
<?php
		}
?>
<tr>
<td><br><p class="text"><b>Total</b></p></td>
<td><p class="text">&nbsp;</p></td>
</tr>
<tr>
<td><p class="text">Games (total):</p></td>
<td><input type="Text" name="totalgames" value="<?php echo "$totalgames" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Wins (total):</p></td>
<td><input type="Text" name="totalwins" value="<?php echo "$totalwins" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Losses (total):</p></td>
<td><input type="Text" name="totallosses" value="<?php echo "$totallosses" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<?php
	if ($system == "points") 
		{
?>
<tr>
<td><p class="text">Points (total):</p></td>
<td><input type="Text" name="totalpoints" value="<?php echo "$totalpoints" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<?php
		}
	else 
		{
?>
<input type="hidden" name="totalpoints" value="<?php echo "$totalpoints" ?>">
<?php
		}
?>
<tr>
<td><p class="text">&nbsp;</p></td>
<td><p class="text">&nbsp;</p></td>
</tr>
<?php
	if ($system == "ladder") 
		{
?>
<tr>
<td><p class="text">Rank:</p></td>
<td><input type="Text" name="rank" value="<?php echo "$rankold" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<?php
		}
	else 
		{
?>
<input type="hidden" name="rank" value="<?php echo "$rankold" ?>">
<?php
		}
?>
<input type="hidden" name="rankold" value="<?php echo "$rankold" ?>">
<tr>
<td><p class="text">Rating:</p></td>
<td><input type="Text" name="rating" value="<?php echo "$rating" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Streak (wins):</p></td>
<td><input type="Text" name="streakwins" value="<?php echo "$streakwins" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Streak (losses):</p></td>
<td><input type="Text" name="streaklosses" value="<?php echo "$streaklosses" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
</table>
<p><input type="Submit" name="submit" value="Edit user." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
</form>
<?php
}
?>
<?php
}
}
else {
echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
}
require('./../../bottom.php');
?>