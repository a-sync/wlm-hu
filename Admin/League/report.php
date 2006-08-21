<?PHP
$page = "report";
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
if (($number == "1") && ($adminpowerleaguereport == 'yes')) {
?>
<p class="header">Report a game.</p>
<?php
if (isset($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}
if ($submit) 
	//si il y a submit
	{
	$date = date('d/m/Y');
	if (! empty($_POST['winnername']))
		{
		$winnername = $_POST['winnername'];
		}
		else
			{
			$winnername = 'null';
			}
	if (! empty($_POST['losername']))
		{
		$losername = $_POST['losername'];
		}
		else
			{
			$losername = 'null';
			}
	if (! empty($_POST['comment']))
		{
		$comment = $_POST['comment'];
		}
		else
			{
			$comment = '';
			}
	//récupère les résultats
	if($reportresult == 'yes')
		{
		if (! empty($_POST['loserresult']))
			{
			$loserresult = $_POST['loserresult'];
			}
			else
				{
				die ('You must give the result !');
				}
		if (! empty($_POST['winnerresult']))
			{
			$winnerresult = $_POST['winnerresult'];
			}
			else
				{
				die ('You must give the result !');
				}
		}
		else
			{
			$winnerresult = 1;
			$loserresult = 0;
			}
	if($uplfichierreport == 'yes')
		{
		//Pour savoir si le fichier a été uploadé, on vérifie que le fichier est bien dans le tableau des fichiers
		if (!empty($_FILES['replay']['size']))
			{
			if(! empty($_POST['replayname']))
				{
				$replayname = $_POST['replayname'];
				//On récupère la taille, le nom et le nom du fichier temporaire
				$f1_size = $_FILES['replay']['size'];
				$f1_name = $_FILES['replay']['name'];
				$f1_tmpname = $_FILES['replay']['tmp_name'];
				//Récupération de l'extension du fichier (on prend ce qui suit le dernier point et on le met en minuscule
				$ext = strtolower(substr($f1_name,strrpos($f1_name, ".")+1));
				//Création du tableau des extensions acceptées
				$valides = array($extvalable1,$extvalable2,$extvalable3);
				if ($f1_size < $maxsizereplayupl)
					{
					if (in_array($ext,$valides))
						{
						$replayname = $replayname.time().'.'.$ext;
						$copywork = move_uploaded_file($f1_tmpname, "./../../replays/$replayname");
						if ($copywork)
							{
							$sql = "INSERT INTO $replaystable (titre, sender, size, date) VALUES ('$replayname','Administrator','$f1_size','$date')";
							$sqlquery = mysql_query($sql);
							echo '<p class=\'text\'>Replay uploaded.</p>';
							$rec = 'no';
							$gameid = 'null';
							$report = ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid,$winnerresult,$loserresult);
							echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/report.php'><font color='$color1'>Report another game</font></a>.</p>";
							}
							else
								{
								echo 'Can\'t save the replay. Please contact the webmaster.<br>';
								}
						}
						else
							{
							echo '.'.$ext.' files aren\'t valid replay files.<br>';
							}
					}
					else
						{
						$maxsizereplayuplko = $maxsizereplayupl/100;
						echo 'Your replay is too big, he can\'t be more than '.$maxsizereplayuplko.' Ko<br>';
						}
				}
				else
					{
					echo 'You must give a name to the replay !<br>';		
					}
			}
			else
				{
				if($uplfichierreportforce == 'yes')
						{
						echo "<p class='text'>You must upload a replay.</p><br>";
						}
						else
							{
							$replayname = '';
							$rec = 'no';
							$gameid = 'null';
							$report = ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid,$winnerresult,$loserresult);
							echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/report.php'><font color='$color1'>Report another game</font></a>.</p>";
							}
				}
		
		}
		else
			{
			$replayname = '';
			$rec = 'no';
			$gameid = 'null';
			$report = ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid,$winnerresult,$loserresult);
			echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/report.php'><font color='$color1'>Report another game</font></a>.</p>";
			}
	} 
	else 
		//si pas de submit
		{
?>
		<form method="post" action="report.php?submit=1" enctype="multipart/form-data">
		<table border="0" cellpadding="0">
		<tr>
		<td><p class="text">Winner:</p></td>
		<td><select size="1" name="winnername" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">>
<?php
		$sortby = "name ASC";
		$sql="SELECT * FROM $playerstable ORDER BY $sortby";
		$result=mysql_query($sql,$db);
		$num = mysql_num_rows($result);
		$cur = 1;
		while ($num >= $cur) 
			{
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
		<td><p class="text">Loser:</p></td>
		<td><select size="1" name="losername" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<?php
		$sortby = "name ASC";
		$sql="SELECT * FROM $playerstable ORDER BY $sortby";
		$result=mysql_query($sql,$db);
		$num = mysql_num_rows($result);
		$cur = 1;
		while ($num >= $cur) 
			{
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
<?php
		if($uplfichierreport == 'yes')
			{
?>
			<tr>
			<td><p class="text">Replay:</p></td>
			<td><input type="File" size="30" name="replay" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
			</tr>
			<tr>
			<td><p class="text">Replay's name:</p></td>
			<td><input type="Text" size="30" name="replayname" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
			</tr>
<?php
			}
		if($reportresult == 'yes')
			{
?>
			<tr>
   				 <td><p class="text">Winner result :</p></td>
   				 <td><input type="text" name="winnerresult" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
			</tr>
 				 <tr>
  				 <td><p class="text">Loser result : </p></td>
  				 <td><input type="text" name="loserresult" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
  			</tr>
<?php
			}
?>			
		<tr>
		<td><p class="text">Comment:</p></td>
		<td><input type="Text" size="30" name="comment" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
		</tr>
		</table>
		<p><input type="Submit" name="submit" value="Report game." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
		</form>
<?php
		//fin de zone 'pas de submit'
		}
?>
<?php
	//fin de zone 'mot de passe correcte'
	}
	else 
		//si le mot de passe de session n'est pas bon
		{
		echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
		<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
		}
require('./../../bottom.php');
?>