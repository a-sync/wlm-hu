<?php
$page = "memberspage";
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
		if(! empty($_POST['del']))
			{
			if($_POST['del'] == 'yes')
				{
				echo '<p class="text">Deleting your account ...</p>';
				$sortby = "name ASC";
				$sql="SELECT * FROM $playerstable WHERE name = '$editname' ORDER BY $sortby";
				$result=mysql_query($sql);
				$row = mysql_fetch_array($result);
				$rank = $row["rank"];
				if ($rank > 0) 
					{
					$sql = "UPDATE $playerstable SET rank = rank - 1 WHERE rank > $rank";
					$result = mysql_query($sql);
					}
				$sql = "DELETE FROM $playerstable WHERE name='$editname'";
				$result = mysql_query($sql);
				echo "<p class='text'>Your account is now deleted !<br><br><a href='$directory'><font color='$color1'>Go back to the league index.</font></a></p>";
				}
				else
					{
					echo '<p class="text">An error occured.</p><p class="text"><a href="$directory/members/index.php">Go back to the members page</a></p>';
					}
			}
			else
				{
				echo '<p class="text">Click on submit to confirm your account removal. You CAN\'T get it back after that.</p>';
?>
<form method="post" action="deleteyourself.php"><br>
<input type="hidden" name="del" value="yes"><br>
<input type="Submit" name="submit" value="Submit your account removal" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
<?php
				}
		}
require('./../bottom.php');
?>