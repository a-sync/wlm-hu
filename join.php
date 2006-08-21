<?php
$page = "join";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
?>
<p class="header">Regisztráció</p>
<hr align="left" width="30%" size="1">
<p class="text">
<?php
if (! empty($_GET['submit']))
		{
		$submit = $_GET['submit'];
		}
		else
			{
			$submit = 0;
			}
if ($submit == 1) {
if ($bkod == $kodm) {
$name = $_POST['name'];
$name = strip_tags($name);
$name = trim($name);
$passworddb = $_POST['passworddb'];
$passworddb = strip_tags($passworddb);
$passworddb = trim($passworddb);
$passsec = $_POST['passsec'];
$passsec = strip_tags($passsec);
$passsec = trim($passsec);
$msn = $_POST['msn'];
$msn = strip_tags($msn);
$msn = trim($msn);
$icq = $_POST['icq'];
$icq = strip_tags($icq);
$icq = trim($icq);
$aim = $_POST['aim'];
$aim = strip_tags($aim);
$aim = trim($aim);
$mail = $_POST['mail'];
$mail = strip_tags($mail);
$mail = trim($mail);
$country = $_POST['country'];
if ($passworddb == "" || $passsec == "") {
echo "Add meg a jelszavad mindkét helyen.";
}
else if ($passworddb != $passsec) {
echo "A megadott két jelszó nem egyezik.";
}
else if ($name == "") {
echo "Add meg a neved.";
}
else if ($mail == "") {
echo "Add meg az E-Mail címed.";
}
else {
$length = strlen($name);
if ($length <= 12) {
$sql="SELECT * FROM $playerstable WHERE name = '$name'";
$result=mysql_query($sql,$db);
$samenick = mysql_num_rows($result);
if ($samenick < 1) {
if ($approve == 'yes') {
$approved = 'no';
}
else {
$approved = 'yes';
}
$ip = Get_ip();
$joindate = time();
$sql = "INSERT INTO $playerstable (name, passworddb, mail, icq, aim, msn, country, approved, ip, joindate) VALUES ('$name', '$passworddb', '$mail','$icq','$aim', '$msn', '$country', '$approved', '$ip', '$joindate')";
$result = mysql_query($sql);
echo "Az adatok el lettek mentve.";
if ($approve == 'yes') { 
echo "<br>A regisztrációd egy admin jóváhagyása után lesz végleges.";
}
}
else {
echo "A megadott név már foglalt.";
}
}
else {
echo "A megadott név túl hosszú.(max. 12 karakter)";
}
}
}
else {
echo "A biztonsági kód helytelenül lett megadva.";
}
}
else {
$sql = "SELECT * FROM `$playerstable`";
$query = mysql_query($sql);
$actualplayers = mysql_num_rows($result);
if($maxplayers > $actualplayers)
	{
?>
<form method="post" action="join.php?submit=1">
<table border="0" cellpadding="0" cellspacing="1">
<tr>
<td><p class="text"><b>Név:<font color="red">*</font></b></p></td>
<td>&nbsp;<input type="Text" name="name" maxlength="12" style="background-color: <?php echo"$color5" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text"><b>Jelszó:<font color="red">*</font></b></p></td>
<td>&nbsp;<input type="password" name="passworddb" maxlength="10" style="background-color: <?php echo"$color5" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text"><b>Jelszó ismét:<font color="red">*</font></b></p></td>
<td>&nbsp;<input type="password" name="passsec" maxlength="10" style="background-color: <?php echo"$color5" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text"><b>E-mail:<font color="red">*</font></b></p></td>
<td>&nbsp;<input type="Text" name="mail" maxlength="50" style="background-color: <?php echo"$color5" ?>" class="text"></td>
</tr>
<tr>
<td>
<p class="text"><b>ICQ:</b></p></td>
<td>&nbsp;<input type="Text" name="icq" maxlength="15" style="background-color: <?php echo"$color5" ?>" class="text"></td>
</tr>
<tr>
<td>
<p class="text"><b>Aim:</b></p></td>
<td>&nbsp;<input type="Text" name="aim" maxlength="40" style="background-color: <?php echo"$color5" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text"><b>Msn:</b></p></td>
<td>&nbsp;<input type="Text" name="msn" maxlength="100" style="background-color: <?php echo"$color5" ?>" class="text"></td>
</tr>
<?php /*<tr>
<td><p class="text">Város:</p></td>
<td>&nbsp;<select size="1" name="country" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
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
<tr height="16"><td></td></tr>
<tr>
<td colspan="2"><p class="text"><b>Biztonsági kód:&nbsp;&nbsp;&nbsp;&nbsp;</b><font style="background-color: <?php echo"$color5" ?>; color: <?php echo"$color1" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?>px; font-weight: bold; text-decoration: none">
<?
srand(time());
$bkod = (rand()%90000)+10000;
print("$bkod");
?></font></p>
</td></tr>
<tr><td colspan="2"><p class="text"><b>Kód megerõsítés:</b>&nbsp;<input type="Text" name="kodm" maxlength="5" size="1" style="background-color: <?php echo"$color5" ?>" class="text"></p></td>
</tr>
</table>
<input type="hidden" name="country" value="No country">
<input type="hidden" name="bkod" value="<?php echo"$bkod" ?>">
<p class="text"><input type="Submit" name="submit" value="Regisztrálok!" class="text">
</form>
</p>
<?php
	}
	else
		{
		echo "A regisztrálható felhasználók száma elérte a maximumot. Nem tudsz feliratkozni!";
		}		
}
?>
<?php
require('bottom.php');
?>
