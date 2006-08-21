<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = 'editprofile';
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
require('./../top.php');
?>

<?php
$var = 'editname';
$editname = GetInfo($idcontrol,$var);
$var = 'editnamepswd';
$editnamepswd = GetInfo($idcontrol,$var);
echo '<p class="header">Felhasználói zóna</p>
	<hr align="left" width="30%" size="1">';
$querycheckpswd = "SELECT passworddb FROM $playerstable WHERE name='$editname'";
$queryresultcheckpswd = mysql_query($querycheckpswd);
$rowcheckpswd = mysql_fetch_row($queryresultcheckpswd);
$pswddb = $rowcheckpswd[0];
if(($pswddb != $editnamepswd) || ($editnamepswd == ''))
	{
	echo "<p class='text'>Nem sikerült bejelentkezni. Própáld újra.";
	if($idcontrol == "cookies"){echo "<br><i>(A böngészõdben engedélyezned kell a sütiket!)</i>";}
	echo "</p><p class='text'><a href='$directory/members/index.php'><font color='$color1'>Bejelentkezés...</font></a></p>";
	}
	else
		{
		if (! empty($_POST['submit']))
			{
			$submit = $_POST['submit'];
			}
			else
				{
				$submit = 'null';
				}
		if ($submit == 'submit') 
			{
			if (! empty($_POST['passworddb']))
				{
				$passworddb = $_POST['passworddb'];
				}
				else
					{
					$passworddb = 'null';
					}
			$sql="SELECT * FROM $playerstable WHERE name='$editname' AND passworddb = '$passworddb'";
			$result=mysql_query($sql);
			$num = mysql_num_rows($result);
			if (($num > 0) && ($passworddb == $editnamepswd)) 
				{
				if ($passworddb1 != $passsec1) {
					echo "Az új jelszó helytelenül lett megismételve.";
				}
				else
					{
					$msn1 = $_POST['msn1'];
					$msn1 = strip_tags($msn1);
					$msn1 = trim($msn1);
					$icq1 = $_POST['icq1'];
					$icq1 = strip_tags($icq1);
					$icq1 = trim($icq1);
					$aim1 = $_POST['aim1'];
					$aim1 = strip_tags($aim1);
					$aim1 = trim($aim1);
					$mail1 = $_POST['mail1'];
					$mail1 = strip_tags($mail1);
					$mail1 = trim($mail1);
					$country1 = "No Country";//zászló kiiktatva
					//$country1 = $_POST['country1'];
					if ($passworddb1 == "") { $passworddb1 = $passworddb; }
					$sql = "UPDATE $playerstable SET passworddb = '$passworddb1', mail = '$mail1', icq = '$icq1', aim = '$aim1', msn = '$msn1', country = '$country1' WHERE name='$editname' AND passworddb = '$passworddb'";
					$result = mysql_query($sql);
					echo "<p class='text'>Az adatok el lettek mentve.</p>";
					}
				}
				else 
					{
					echo "<p class='text'>A megadott jelszó helytelen.<br><br><a href='$directory/members/editprofile.php'>Próbáld újra...</a></p>";
					}
		    }
			else 
				{
				if(($pswddb == $editnamepswd) && ($editnamepswd != ''))
					{
					echo '<p class="header"><u>Beállítások:</u></p>';
					$sortby = "name ASC";
					$sql="SELECT * FROM $playerstable WHERE name = '$editname' ORDER BY $sortby";
					$result=mysql_query($sql,$db);
					$row = mysql_fetch_array($result);
					$mail = $row["mail"];
					$icq = $row["icq"]; 
					$aim = $row["aim"];
					$msn = $row["msn"];
					$country = $row["country"];
					?>
					<form method="post" action="editprofile.php">
					<table border="0" cellpadding="0" cellspacing="1">
					<tr>
					<td><p class="text"><b>Név:</b></p></td>
					<td>&nbsp;<input type="Text" name="editname" maxlength="12" style="background-color: <?php echo"$color7" ?>; font-weight: bold" class="text" value="<?php echo"$editname" ?>" readonly></td>
					</tr>
					<tr>
					<td><p class="text"><b>Jelszó:</b></p></td>
					<td>&nbsp;<input type="password" name="passworddb" maxlength="10" style="background-color: <?php echo"$color5" ?>" class="text"></td>
					</tr>
					<tr height="8"><td></td></tr>
					<tr>
					<td><p class="text"><b>Új Jelszó:</b></p></td>
					<td>&nbsp;<input type="password" name="passworddb1" maxlength="10" style="background-color: <?php echo"$color5" ?>" class="text"></td>
					</tr>
					<tr>
					<td><p class="text"><b>Új Jelszó ismét:</b></p></td>
					<td>&nbsp;<input type="password" name="passsec1" maxlength="10" style="background-color: <?php echo"$color5" ?>" class="text"></td>
					</tr>
					<td><p class="text"><b>E-mail:</b></p></td>
					<td>&nbsp;<input type="Text" name="mail1" maxlength="50" value="<?php echo "$mail" ?>" style="background-color: <?php echo"$color5" ?>" class="text"></td>
					</tr>
					<tr>
					<td><p class="text"><b>ICQ:</b></p></td>
					<td>&nbsp;<input type="Text" name="icq1" maxlength="15" value="<?php echo "$icq" ?>" style="background-color: <?php echo"$color5" ?>" class="text"></td>
					</tr>
					<tr>
					<td><p class="text"><b>Aim:</b></p></td>
					<td>&nbsp;<input type="Text" name="aim1" maxlength="40" value="<?php echo "$aim" ?>" style="background-color: <?php echo"$color5" ?>" class="text"></td>
					</tr>
					<tr>
					<td><p class="text"><b>Msn:</b></p></td>
					<td>&nbsp;<input type="Text" name="msn1" maxlength="100" value="<?php echo "$msn" ?>" style="background-color: <?php echo"$color5" ?>" class="text"></td>
					</tr>
			<?php /*<tr>
					<td><p class="text">Country:</p></td>
					<td><select size="1" name="country1" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
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
					</tr>*/ ?>
					</table>
					<br><input type="Submit" name="submit" value="Mentés!" class="text">&nbsp;<input type="reset" value="Mégse!" class="text">
					</form>
<?php
					}
				}
		}
require('./../bottom.php');
?>