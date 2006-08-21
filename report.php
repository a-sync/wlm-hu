<?php
$page = "report";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
?>
<p class="header">Report.</p>
<p class="text">
<?php

// <-- Récupération des valeurs du formulaire de report si nécéssaire -->

if (! empty($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}

// <-- Si il y a report -->

if ($submit == 1) 
	{
	//récupère le mot de passe
	if (! empty($_POST['passworduser']))
		{
		$passworduser = $_POST['passworduser'];
		}
		else
			{
			$passworduser = 'null';
			}
	////récupère le nom du perdant
	if (! empty($_POST['losername']))
		{
		$losername = $_POST['losername'];
		}
		else
			{
			$losername = 'null';
			}
	//récupère le nom du gagnant
	if (! empty($_POST['winnername']))
		{
		$winnername = $_POST['winnername'];
		}
		else
			{
			$winnername = 'null';
			}
	//récupère les commentaires
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
	//récupère la date
	$date = date('d/m/Y');
	if ($report == "winner") 
		// Détermine si le gagnant ou le perdant reporte, d'après variabledb.php, ici, si le gagnant reporte
		{
		$reportname = "$winnername";
		}
		else 
			// Si le perdant reporte
			{
			$reportname = "$losername";
			}
	$sql="SELECT * FROM $playerstable WHERE name = '$reportname'";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	$name = $row["name"];
	$passworddb = $row["passworddb"];
	if ($passworddb == "$passworduser") 
		// Si le mot de passe du formulaire correspond à celui dans la base de donnée de celui qui doit reporter ...
		{
		if ($winnername == $losername) 
			// Si les noms de gagnant et perdant sont les mêmes
			{
			echo "You can't play against yourself.";
			}
			else 
				{
				// Récupère le nombre de match déjà joués entre ces deux joueurs à cette date là
				$sql="SELECT * FROM $gamestable WHERE winner = '$winnername' and loser = '$losername' and date = '$date'";
				$result=mysql_query($sql);
				$oneway = mysql_num_rows($result);
				// variation gagnant/perdant ...
				$sql="SELECT * FROM $gamestable WHERE winner = '$losername' and loser = '$winnername' and date = '$date'";
				$result=mysql_query($sql);
				$otherway = mysql_num_rows($result);
				$num = $oneway + $otherway; // $num = nombre total de match entre les 2 à la même date
				if ($num < $gamesmaxdayplayer) 
					// si il n'ont pas encore atteint la limite de match/jour fixé
					{
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
										$copywork = move_uploaded_file($f1_tmpname, "./replays/$replayname");
										if ($copywork)
											{
											$sql = "INSERT INTO $replaystable (titre, sender, size, date) VALUES ('$replayname','$reportname','$f1_size','$date')";
											$sqlquery = mysql_query($sql);
											echo 'Replay uploaded.<br>';
											if ($approvegames != "yes") 
												// si l'administrateur ne doit pas valider chaque match
												{
												$rec = 'no';
												$gameid = 'null';
												$report = ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid,$winnerresult,$loserresult);
												echo "Thank you! Information entered.";
												}
												else 
													// si l'admin doit valider les parties, la rajoute dans la table avec sa valeur 'recorded' à 'no'
													{
													$sql = "INSERT INTO $gamestable (winner, loser, date, winnerresult, loserresult, comment, relatedreplay, recorded) VALUES ('$winnername', '$losername', '$date', '$winnerresult', '$loserresult', '$comment', '$replayname', 'no')";
													$result = mysql_query($sql);
													echo "Thank you! Information entered.";
													}
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
									$replayname = 'null';
									}
							}
							else
								{
								if($uplfichierreportforce == 'yes')
									{
									echo 'You must upload a replay.<br>';
									}
									else
										{
										$replayname = '';
										if ($approvegames != "yes") 
											// si l'administrateur ne doit pas valider chaque match
											{
											$rec = 'no';
											$gameid = 'null';
											$report = ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid,$winnerresult,$loserresult);
											echo "Thank you! Information entered.";
											}
											else 
												// si l'admin doit valider les parties, la rajoute dans la table avec sa valeur 'recorded' à 'no'
												{
												$sql = "INSERT INTO $gamestable (winner, loser, date, winnerresult, loserresult, comment, relatedreplay, recorded) VALUES ('$winnername', '$losername', '$date', '$winnerresult', '$loserresult', '$comment', '$replayname', 'no')";
												$result = mysql_query($sql);
												echo "Thank you! Information entered.";
												}
										}
								}
						}
						else
							//si pas de replay
							{
							$replayname = '';
							if ($approvegames != "yes") 
								// si l'administrateur ne doit pas valider chaque match
								{
								$rec = 'no';
								$gameid = 'null';
								$report = ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid,$winnerresult,$loserresult);
								echo "Thank you! Information entered.";
								}
								else 
									// si l'admin doit valider les parties, la rajoute dans la table avec sa valeur 'recorded' à 'no'
									{
									$sql = "INSERT INTO $gamestable (winner, loser, date, comment, relatedreplay, recorded) VALUES ('$winnername', '$losername', '$date', '$comment', '$replayname', 'no')";
									$result = mysql_query($sql);
									echo "Thank you! Information entered.";
									}
							}
					// fin de la zone de report
					}
				else 
					// si le nombre maximum de match entre ces deux joueurs a été atteint pour la journée
					{
					echo "You can't play more than $gamesmaxdayplayer games a day against the same player.";
					}
				// fin de zone gagnant/perdant différents
				}
			// fin de zone 'mot de passe correct'
			}
			else 
				// si mot de passe incorrect ...
				{
				echo "Incorrect password. Try again.";
				}
		// fin de zone ' si submit = 1 '
		} 
		
	else 
		// <-- Formulaire de report de match commence ici !!! -->
		{
?>
		<form method="post" action="report.php?submit=1" enctype="multipart/form-data">
		<table border="0" cellpadding="0">
		<tr>
		<td><p class="text">Winner:</p></td>
		<td><select size="1" name="winnername" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<?php
		$sortby = "name ASC";
		$sql="SELECT * FROM $playerstable WHERE approved = 'yes' ORDER BY $sortby";
		$result=mysql_query($sql);
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
		<td><p class="text">Loser:</p></td>
		<td><select size="1" name="losername" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color3" ?>" class="text">
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
		<td><p class="text">Comment:</p></td>
		<td><input type="Text" size="30" name="comment" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
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
		<td><p class="text">Password:</p></td>
		<td><input type="password" size="15" name="passworduser" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
		</tr>
		</table>
		<p class="text"><input type="Submit" name="submit" value="Report." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br><br>
		</form>
		</p>
<?php
		}
?>
<?php
require('bottom.php');
?>