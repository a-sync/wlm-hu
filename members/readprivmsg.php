<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = 'readprivmsg';
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
require('./../top.php');
?>

<?php
//<-- R�cupere les information sur le membre dans la session et v�rifie qu'il est bien enregistr� -->
$var = 'editname';
$editname = GetInfo($idcontrol,$var);
$var = 'editnamepswd';
$editnamepswd = GetInfo($idcontrol,$var);
echo '<p class="header">Personnal area.</p>
	<hr align="left" width="500" size="2"><br>';
//on r�cup�re le mot de passe pour le nom correspondant.
$querycheckpswd = "SELECT passworddb FROM $playerstable WHERE name='$editname'";
$queryresultcheckpswd = mysql_query($querycheckpswd);
$rowcheckpswd = mysql_fetch_row($queryresultcheckpswd);
$pswddb = $rowcheckpswd[0];
//$pswddb est le mot de passe correspondant a ce joueur dans la base de donn�e
if(($pswddb != $editnamepswd) || ($editnamepswd == ''))
	//si les deux mots de passe ne correspondent pas o� si il sont vides
	{
	echo "<p class='text'>Unable to log you in. Password seems to be incorrect. Try to log in again.</p>
		  <p class='text'><a href='$directory/members/index.php'><font color='$color1'>Back to the log page ...</font></a></p>";
	}
	else
		//ausinon, si mot de passe correct
		{
		echo '<p class="text">Your personnal messages :</p>';
		$readprivmsg = ReadPrivmsg($editname,$editnamepswd);
?>
<?php
		}
require('./../bottom.php');
?>