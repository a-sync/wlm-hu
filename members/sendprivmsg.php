<?php
$page = 'sendprivmsg';
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
require('./../top.php');
?>
<?php
//<-- Récupere les information sur le membre dans la session et vérifie qu'il est bien enregistré -->
$var = 'editname';
$editname = GetInfo($idcontrol,$var);
$var = 'editnamepswd';
$editnamepswd = GetInfo($idcontrol,$var);
echo '<p class="header">Personnal area.</p>
	<hr align="left" width="500" size="2"><br>';
//on récupère le mot de passe pour le nom correspondant.
$querycheckpswd = "SELECT passworddb FROM $playerstable WHERE name='$editname'";
$queryresultcheckpswd = mysql_query($querycheckpswd);
$rowcheckpswd = mysql_fetch_row($queryresultcheckpswd);
$pswddb = $rowcheckpswd[0];
//$pswddb est le mot de passe correspondant a ce joueur dans la base de donnée
if(($pswddb != $editnamepswd) || ($editnamepswd == ''))
	//si les deux mots de passe ne correspondent pas où si il sont vides
	{
	echo "<p class='text'>Unable to log you in. Password seems to be incorrect. Try to log in again.</p>
		  <p class='text'><a href='$directory/members/index.php'><font color='$color1'>Back to the log page ...</font></a></p>";
	}
	else
		//ausinon, si mot de passe correct
		{
?>
<form name="form1" method="post" action="sendmsg.php?submit=1">
  <table width="618" height="128" border="0">
    <tr> 
      <td width="210" height="35"><p class='text'>Send the message to :</p></td>
      <td width="398"><select name="name">
<?php
//on affiche tout les noms de joueurs non bloqués/autorisés dans la liste
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
      <td><p class='text'>Title :</p></td>
      <td><input name="title" type="text" size="50"></td>
    </tr>
    <tr> 
      <td><p class='text'>Message :</p></td>
      <td><textarea name="text" cols="50" rows="10"></textarea>
	  <br>
	  <table border="1" cellspacing="1" cellpadding="2" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>">
<tr>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/smile.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/sad.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/biggrin.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/cry.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/none.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/mad.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/rolleyes.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/laugh.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/bigrazz.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/dead.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/wink.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/bigeek.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/cool.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/no.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/yes.gif" width="15" height="15"></td>
</tr>
<tr>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:)</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:(</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:d</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:'(</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:s</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:@</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:r</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:h</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:p</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:x</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">;)</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:o</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:b</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">(n)</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">(y)</td>
</tr>
</table>
	  </td>
    </tr>
    <tr>
      <td><br><input type="submit" name="Submit" value="Send your message"></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php
		}
require('./../bottom.php');
?>


