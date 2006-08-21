<?php

/************************************************************************
/  	SmileyConvert($content,$directory)									/
/	Convert smileys in a message										/
/	Command :															/
/	$newcontent = SmileyConvert($content,$directory);					/
/	$content is the message in wich smileys will be converted			/
/   $directory is set in variable.php (the primary dir of webleague)	/	
/***********************************************************************/

function SmileyConvert($content,$directory)								
	{
	$content = eregi_replace(quotemeta(":)"),"<img src='$directory/smileys/smile.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":("),"<img src='$directory/smileys/sad.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":D"),"<img src='$directory/smileys/biggrin.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":'("),"<img src='$directory/smileys/cry.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":o"),"<img src='$directory/smileys/bigeek.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(";)"),"<img src='$directory/smileys/wink.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta("(y)"),"<img src='$directory/smileys/yes.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta("(n)"),"<img src='$directory/smileys/no.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":p"),"<img src='$directory/smileys/bigrazz.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":@"),"<img src='$directory/smileys/mad.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":s"),"<img src='$directory/smileys/none.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":x"),"<img src='$directory/smileys/dead.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":b"),"<img src='$directory/smileys/cool.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":h"),"<img src='$directory/smileys/laugh.gif' border='0'>",$content);
	$content = eregi_replace(quotemeta(":r"),"<img src='$directory/smileys/rolleyes.gif' border='0'>",$content);
	return $content;
	}
	
/********************************************************************************
/	SendPrivmsg($sender,$senderpswd,$receiver,$message,$title)					/
/	Send a private message to another user (add it in $privmsgtable)			/
/	Command :																	/
/	$resultofsend = SendPrivmsg($sender,$senderpswd,$receiver,$message,$title);	/
/   $sender is the name of the sender											/
/	$senderpswd is the password of the sender									/
/	$receiver is the name of the receiver										/	
/	$message is the message 													/
/	$title is the title of the message											/
/*******************************************************************************/
	
function SendPrivmsg($sender,$senderpswd,$receiver,$message,$title)
	{
	require('variables.php');
	require('variablesdb.php');
	//require('functions.php');
	//récupère l'id de l'émetteur
	$querysender = "SELECT `player_id`,`passworddb` FROM `".$playerstable."` WHERE `name`='".$sender."'";
	$queryresultsender = mysql_query($querysender);
	$ressender = mysql_fetch_row($queryresultsender);
	$sender_id = $ressender[0];
	$senderpswd_db = $ressender[1];
	//si cet émetteur existe bien
	if($sender_id) 
		{
		//si le mot de passe est le bon
		if($senderpswd == $senderpswd_db)
			{
			//récupère l'id du receveur
			$queryreceiver = "SELECT `player_id` FROM `".$playerstable."` WHERE `name`='".$receiver."'";
			$queryresultreceiver = mysql_query($queryreceiver);
			$resreceiver = mysql_fetch_row($queryresultreceiver);
			$receiver_id = $resreceiver[0];
			//si il existe bien
			if($receiver_id) 
				{
				//supprime le code html
				$message = htmlentities($message);
				//converting smileys
				$message = SmileyConvert($message,$directory);
				//protège des bugs de guillemets/apostrophes
				$message = addslashes($message);
				//remplace les retour à la ligne par des balises <br>
				$message = nl2br($message);
				//ajout d'un retour à la ligne tout les 80 caractères (évite un mot trop long qui déforme la fenêtre
				$message = wordwrap($message, 80, "\n", 1);
				//insérer le message privé dans la table
				$queryprvmsg = "INSERT INTO `".$privmsgtable."` (`Id_sender` , `Id_receiver` , `Text` , `Title` , `Date` ) VALUES ('".$sender_id."', '".$receiver_id."', '".$message."', '".$title."', '".time()."')";
				$queryresultprvmsg = mysql_query($queryprvmsg) or die(mysql_error());
				//si réussi
				if($queryresultprvmsg)
					{
					//commande en cas de réussite
					$resultat = '<p class="text">Private message sent !</p>';
					}
					else
						{
						//commandes en cas d'échec
						$resultat = '<p class="text">Unable to send your message !</p>';
						}
				}
				else
					{
					//si l'id du receveur n'existe pas
					$resultat = '<p class="text">This receiver doesn\'t exist ! Unable to send your message !</p>';
					}
			}
			else
				{
				//si les mot de passe ne correspondent pas
				$resultat = '<p class="text">Wrong password ! Unable to send your message !</p>';
				}
		}
		else
			{
			//si l'id de l'émetteur n'existe pas
			$resultat = '<p class="text">Your user id doesn\'t exist ! Unable to send your message !</p>';
			}
	if(! isset($resultat)) //si $resultat n'existe pas
		{
		$resultat = '<p class="text">An unknown error happened, message wasn\'t sent.</p>';
		}
	return $resultat; 
	}
	
/************************************************************************
/  	function ReadPrivmsg($user,$password)								/
/	Read user's private messages										/
/	Command :															/
/	$readprivmsg = ReadPrivmsg($user,$password);							/
/	$user is the user's name											/
/   $password is the user's password									/	
/***********************************************************************/

function ReadPrivmsg($user,$password)
	{
	require('variables.php');
	require('variablesdb.php');
	//recupère l'id et le mot de passe du lecteur
	$queryreader = "SELECT `player_id`,`passworddb` FROM `".$playerstable."` WHERE `name`='".$user."'";
	$queryresultreader = mysql_query($queryreader);
	$resreader = mysql_fetch_row($queryresultreader);
	$reader_id = $resreader[0];
	$readerpswd_db = $resreader[1];
	//si l'id existe
	if($reader_id) 
		{
		//si le mot de passe est le bon
		if($readerpswd_db == $password)
			{
			//récupère tout les messages correspondant à cet utilisateur
			$queryread = "SELECT * FROM `".$privmsgtable."` WHERE `Id_receiver`='".$reader_id."'";
			$queryresultread = mysql_query($queryread);
			$num = mysql_num_rows($queryresultread);
			$cur = 1;
			while($num >= $cur)
			//traite tout les messages
				{
				$resread = mysql_fetch_array($queryresultread);
				//recupère le nom de l'émetteur
				$queryinfosender = "SELECT `name` FROM `".$playerstable."` WHERE `player_id`='".$resread['Id_sender']."'";
				$queryresultinfosender = mysql_query($queryinfosender);
				$resinfosender = mysql_fetch_row($queryresultinfosender);
				$sendername = $resinfosender[0];
				//retire la protection contre les guillemets et les apostrophes
				$message = stripslashes($resread['Text']);
				//affiche le message
				echo '<hr align="left" width="680" size="2"><br>';
				echo '<table width="700" border="0">
  						<tr> 
							<td><div align="left">Title : '.$resread['Title'].'</div></td>
							<td><div align="right">Sent the : '.date('d/m/Y', $resread['Date']).'</div></td>
  						</tr>
 						<tr> 
							<td colspan="2"><div align="center">'.$message.'</div></td>
  						</tr>
  						<tr> 
							<td><div align="left">From : '.$sendername.'</div></td>
							<td><div align="right">Message\'s id : '.$resread['Id_msg'].'</div></td>
						</tr>
					 </table>';
				echo '<br><hr align="left" width="680" size="2"><br>';
				$cur++;
				}
			}
			else
				{
				//si le mot de passe n'est pas le bon
				echo '<p class="text">Wrong password, unable to read your messages.</p>';
				}
		}
		else
			{
			//si l'id n'existe pas
			echo '<p class="text">Your user id doesn\'t exist, unable to read your messages.</p>';
			}
	}
	
/********************************************************************************
/	Get_ip()																	/
/	Return the ip of a visitor													/
/	Command :																	/
/	$ip = Get_ip();																/
/   If fail, $ip = false, else $ip = visitor's ip.								/											
/*******************************************************************************/
	
function Get_ip()
    {
        global $REMOTE_ADDR;
        global $HTTP_X_FORWARDED_FOR, $HTTP_X_FORWARDED, $HTTP_FORWARDED_FOR, $HTTP_FORWARDED;
        global $HTTP_VIA, $HTTP_X_COMING_FROM, $HTTP_COMING_FROM;
        global $HTTP_SERVER_VARS, $HTTP_ENV_VARS;
		
        if (empty($REMOTE_ADDR)) {
            if (!empty($_SERVER) && isset($_SERVER['REMOTE_ADDR'])) {
                $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
            }
            else if (!empty($_ENV) && isset($_ENV['REMOTE_ADDR'])) {
                $REMOTE_ADDR = $_ENV['REMOTE_ADDR'];
            }
            else if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['REMOTE_ADDR'])) {
                $REMOTE_ADDR = $HTTP_SERVER_VARS['REMOTE_ADDR'];
            }
            else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['REMOTE_ADDR'])) {
                $REMOTE_ADDR = $HTTP_ENV_VARS['REMOTE_ADDR'];
            }
            else if (@getenv('REMOTE_ADDR')) {
                $REMOTE_ADDR = getenv('REMOTE_ADDR');
            }
        }
        if (empty($HTTP_X_FORWARDED_FOR)) {
            if (!empty($_SERVER) && isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $HTTP_X_FORWARDED_FOR = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else if (!empty($_ENV) && isset($_ENV['HTTP_X_FORWARDED_FOR'])) {
                $HTTP_X_FORWARDED_FOR = $_ENV['HTTP_X_FORWARDED_FOR'];
            }
            else if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR'])) {
                $HTTP_X_FORWARDED_FOR = $HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR'];
            }
            else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_X_FORWARDED_FOR'])) {
                $HTTP_X_FORWARDED_FOR = $HTTP_ENV_VARS['HTTP_X_FORWARDED_FOR'];
            }
            else if (@getenv('HTTP_X_FORWARDED_FOR')) {
                $HTTP_X_FORWARDED_FOR = getenv('HTTP_X_FORWARDED_FOR');
            }
        } 
        if (empty($HTTP_X_FORWARDED)) {
            if (!empty($_SERVER) && isset($_SERVER['HTTP_X_FORWARDED'])) {
                $HTTP_X_FORWARDED = $_SERVER['HTTP_X_FORWARDED'];
            }
            else if (!empty($_ENV) && isset($_ENV['HTTP_X_FORWARDED'])) {
                $HTTP_X_FORWARDED = $_ENV['HTTP_X_FORWARDED'];
            }
            else if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_X_FORWARDED'])) {
                $HTTP_X_FORWARDED = $HTTP_SERVER_VARS['HTTP_X_FORWARDED'];
            }
            else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_X_FORWARDED'])) {
                $HTTP_X_FORWARDED = $HTTP_ENV_VARS['HTTP_X_FORWARDED'];
            }
            else if (@getenv('HTTP_X_FORWARDED')) {
                $HTTP_X_FORWARDED = getenv('HTTP_X_FORWARDED');
            }
        } 
        if (empty($HTTP_FORWARDED_FOR)) {
            if (!empty($_SERVER) && isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                $HTTP_FORWARDED_FOR = $_SERVER['HTTP_FORWARDED_FOR'];
            }
            else if (!empty($_ENV) && isset($_ENV['HTTP_FORWARDED_FOR'])) {
                $HTTP_FORWARDED_FOR = $_ENV['HTTP_FORWARDED_FOR'];
            }
            else if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_FORWARDED_FOR'])) {
                $HTTP_FORWARDED_FOR = $HTTP_SERVER_VARS['HTTP_FORWARDED_FOR'];
            }
            else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_FORWARDED_FOR'])) {
                $HTTP_FORWARDED_FOR = $HTTP_ENV_VARS['HTTP_FORWARDED_FOR'];
            }
            else if (@getenv('HTTP_FORWARDED_FOR')) {
                $HTTP_FORWARDED_FOR = getenv('HTTP_FORWARDED_FOR');
            }
        } 
        if (empty($HTTP_FORWARDED)) {
            if (!empty($_SERVER) && isset($_SERVER['HTTP_FORWARDED'])) {
                $HTTP_FORWARDED = $_SERVER['HTTP_FORWARDED'];
            }
            else if (!empty($_ENV) && isset($_ENV['HTTP_FORWARDED'])) {
                $HTTP_FORWARDED = $_ENV['HTTP_FORWARDED'];
            }
            else if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_FORWARDED'])) {
                $HTTP_FORWARDED = $HTTP_SERVER_VARS['HTTP_FORWARDED'];
            }
            else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_FORWARDED'])) {
                $HTTP_FORWARDED = $HTTP_ENV_VARS['HTTP_FORWARDED'];
            }
            else if (@getenv('HTTP_FORWARDED')) {
                $HTTP_FORWARDED = getenv('HTTP_FORWARDED');
            }
        } 
        if (empty($HTTP_VIA)) {
            if (!empty($_SERVER) && isset($_SERVER['HTTP_VIA'])) {
                $HTTP_VIA = $_SERVER['HTTP_VIA'];
            }
            else if (!empty($_ENV) && isset($_ENV['HTTP_VIA'])) {
                $HTTP_VIA = $_ENV['HTTP_VIA'];
            }
            else if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_VIA'])) {
                $HTTP_VIA = $HTTP_SERVER_VARS['HTTP_VIA'];
            }
            else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_VIA'])) {
                $HTTP_VIA = $HTTP_ENV_VARS['HTTP_VIA'];
            }
            else if (@getenv('HTTP_VIA')) {
                $HTTP_VIA = getenv('HTTP_VIA');
            }
        } 
        if (empty($HTTP_X_COMING_FROM)) {
            if (!empty($_SERVER) && isset($_SERVER['HTTP_X_COMING_FROM'])) {
                $HTTP_X_COMING_FROM = $_SERVER['HTTP_X_COMING_FROM'];
            }
            else if (!empty($_ENV) && isset($_ENV['HTTP_X_COMING_FROM'])) {
                $HTTP_X_COMING_FROM = $_ENV['HTTP_X_COMING_FROM'];
            }
            else if (!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_X_COMING_FROM'])) {
                $HTTP_X_COMING_FROM = $HTTP_SERVER_VARS['HTTP_X_COMING_FROM'];
            }
            else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_X_COMING_FROM'])) {
                $HTTP_X_COMING_FROM = $HTTP_ENV_VARS['HTTP_X_COMING_FROM'];
            }
            else if (@getenv('HTTP_X_COMING_FROM')) {
                $HTTP_X_COMING_FROM = getenv('HTTP_X_COMING_FROM');
            }
        }
        if (empty($HTTP_COMING_FROM)) {
            if (!empty($_SERVER) && isset($_SERVER['HTTP_COMING_FROM'])) {
                $HTTP_COMING_FROM = $_SERVER['HTTP_COMING_FROM'];
            }
            else if (!empty($_ENV) && isset($_ENV['HTTP_COMING_FROM'])) {
                $HTTP_COMING_FROM = $_ENV['HTTP_COMING_FROM'];
            }
            else if (!empty($HTTP_COMING_FROM) && isset($HTTP_SERVER_VARS['HTTP_COMING_FROM'])) {
                $HTTP_COMING_FROM = $HTTP_SERVER_VARS['HTTP_COMING_FROM'];
            }
            else if (!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_COMING_FROM'])) {
                $HTTP_COMING_FROM = $HTTP_ENV_VARS['HTTP_COMING_FROM'];
            }
            else if (@getenv('HTTP_COMING_FROM')) {
                $HTTP_COMING_FROM = getenv('HTTP_COMING_FROM');
            }
        } 

       
        if (!empty($REMOTE_ADDR)) {
            $direct_ip = $REMOTE_ADDR;
        }
       
        $proxy_ip     = '';
        if (!empty($HTTP_X_FORWARDED_FOR)) {
            $proxy_ip = $HTTP_X_FORWARDED_FOR;
        } else if (!empty($HTTP_X_FORWARDED)) {
            $proxy_ip = $HTTP_X_FORWARDED;
        } else if (!empty($HTTP_FORWARDED_FOR)) {
            $proxy_ip = $HTTP_FORWARDED_FOR;
        } else if (!empty($HTTP_FORWARDED)) {
            $proxy_ip = $HTTP_FORWARDED;
        } else if (!empty($HTTP_VIA)) {
            $proxy_ip = $HTTP_VIA;
        } else if (!empty($HTTP_X_COMING_FROM)) {
            $proxy_ip = $HTTP_X_COMING_FROM;
        } else if (!empty($HTTP_COMING_FROM)) {
            $proxy_ip = $HTTP_COMING_FROM;
        } 

        if (empty($proxy_ip)) {
          
            return $direct_ip;
        } else {
            $is_ip = ereg('^([0-9]{1,3}\.){3,3}[0-9]{1,3}', $proxy_ip, $regs);
            if ($is_ip && (count($regs) > 0)) {
               
                return $regs[0];
            } else {
                             
                return FALSE;
            }
        } 
    }
	
/********************************************************************************************
/	ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid)				/
/	Report a game in the database															/
/	Command :																				/
/	$report = ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid);	/
/   $winnername is the name of the winner													/
/	$losername is the name of the loser														/
/	$date is the date when the game is played												/
/	$comment is the commentary on the game													/
/	$replayname is the name of the replay in the database (and his real name)				/
/	$rec sets if the game is being recorded by admin ( = 'yes' / = 'no'	)					/
/	$gameid is the id of the game being recorded (isn't used if $rec != 'yes' )				/
/	$winnerresult is the result of the winner 												/
/	$loserresult is the result of the loser 												/								
/*******************************************************************************************/
	
function ReportGame($winnername,$losername,$date,$comment,$replayname,$rec,$gameid,$winnerresult,$loserresult)
	{
	require('variables.php');
	require('variablesdb.php');
	//supprime le code html
	$comment = htmlentities($comment);
	//protège des bugs de guillemets/apostrophes
	$comment = addslashes($comment);
	//remplace les retour à la ligne par des balises <br>
	$comment = nl2br($comment);
	//ajout d'un retour à la ligne tout les 80 caractères (évite un mot trop long qui déforme la fenêtre
	$comment = wordwrap($comment, 80, "\n", 1);
	// récupération des valeurs du gagnant
	$sql = "SELECT * FROM $playerstable WHERE name = '$winnername'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$ratingoldwinner = $row["rating"]; 
	$rankoldwinner = $row["rank"];
	$ra2oldwinner = $row["ra2ladder"];
	// récupération des valeurs du perdant
	$sql = "SELECT * FROM $playerstable WHERE name = '$losername'";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	$ratingoldloser = $row["rating"];
	$rankoldloser = $row["rank"];
	$ra2oldloser = $row["ra2ladder"];
	$constant = 32; 
	// <-- calcul du nouveau rating -->
		//pour le gagnant 
	/*	ancien calcul, regroupé en une ligne
	$rw1 = $ratingoldwinner - $ratingoldloser;
	$rw2 = -$rw1/400;
	$rw3 = pow(10,$rw2);
	$rw4 = $rw3 + 1;
	$rw5 = 1/$rw4;
	$rw6 = 1 - $rw5;
	$rw7 = $constant * $rw6;
	$rw8 = $rw7 + $ratingoldwinner;
	$ratingnewwinner = round($rw8); */
	$ratingnewwinner = round(($constant*(1-(1/ (pow(10,(-($ratingoldwinner-$ratingoldloser)/400))+1))))+$ratingoldwinner);
		//pour le perdant
	/*	ancien calcul, regroupé en une ligne
	$rl1 = $ratingoldloser - $ratingoldwinner;
	$rl2 = -$rl1/400;
	$rl3 = pow(10,$rl2);
	$rl4 = $rl3 + 1;
	$rl5 = 1/$rl4;
	$rl6 = -$rl5;
	$rl7 = $constant * $rl6;
	$rl8 = $rl7 + $ratingoldloser;
	$ratingnewloser = round($rl8); */
	$ratingnewloser = round(($constant*(-(1/((pow(10,(-($ratingoldloser-$ratingoldwinner)/400)))+1))))+$ratingoldloser);
	if ($rankoldwinner < 1) 
		//si l'ancien rang du gagnant est < 1, on le met au minimum
		{
		$sql="SELECT * FROM $playerstable ORDER BY rank DESC LIMIT 0,1";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		$rankoldwinner = $row["rank"];
		$rankoldwinner++;
		}
	if ($rankoldloser < 1) 
		// si l'ancien rang du perdant est < 1, on le met au minimum
		{
		$sql="SELECT * FROM $playerstable ORDER BY rank DESC LIMIT 0,1";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		$rankoldloser = $row["rank"];
		$rankoldloser++;
		}
	if ($rankoldwinner > $rankoldloser) 
		// si l'ancien rang du gagnant est > à celui du perdant
		{
		$difference = $rankoldwinner - $rankoldloser;
		$rise = $difference/2;
		$rise = round($rise);
		$ranknewwinner = $rankoldwinner - $rise;
		$ranknewloser = $rankoldloser;
		if ($ranknewwinner == $ranknewloser) 
				{
				// si après cela ils sont au même niveau, le perdant va en dessous
				$ranknewloser++;
				}
		// mise à jour des rang dans la base de donnée
		$sql = "UPDATE $playerstable SET rank = rank + 1 WHERE rank > $ranknewwinner - 1 AND rank < $rankoldwinner";
		$result = mysql_query($sql);
		}
		else if ($rankoldwinner == $rankoldloser) 
			// si l'ancien rang du gagnant est = à celui du perdant
			{
			$ranknewwinner = $rankoldwinner;
			$ranknewloser = $rankoldloser + 1;
			}
			else 
				// si l'ancien rang du gagnant est < à celui du perdant
				{
				$ranknewwinner = $rankoldwinner;
				$ranknewloser = $rankoldloser;
				}
	// <-- Calcul des points ladder Ra2 -->
		// pour le gagnant
	$ra2newwinneradd = round(64*(1 - (1/(pow(10, ($ra2oldloser-$ra2oldwinner)/400)+1)))); 
	$ra2newwinner = $ra2oldwinner + $ra2newwinneradd;
		// pour le perdant 
	$ra2newloserrem = round(64*(1 - (1/(pow(10, ($ra2oldwinner-$ra2oldloser)/400)+1))));
	$ra2newloser = $ra2oldloser - $ra2newloserrem;
	if($ra2ladderneg = 'no')
		{
		if($ra2newloser < 0)
			{
			$ra2newloser = 0;
			}
		}
	// mise a jour des infos du perdant
	$sql = "UPDATE $playerstable SET wins = wins, losses = losses + 1, totalwins = totalwins, totallosses = totallosses + 1, points = points + $pointsloss, totalpoints = totalpoints + $pointsloss, games = games + 1, totalgames = totalgames + 1, streakwins = 0, streaklosses = streaklosses + 1, rating = $ratingnewloser, ra2ladder = $ra2newloser, rank = $ranknewloser WHERE name='$losername'";
	$result = mysql_query($sql);
	// mise a jour des infos du gagnant
	$sql = "UPDATE $playerstable SET wins = wins + 1, losses = losses, totalwins = totalwins + 1, totallosses= totallosses, points = points + $pointswin, totalpoints = totalpoints + $pointswin, games = games + 1, totalgames = totalgames + 1, streakwins = streakwins + 1, streaklosses = 0, rating = $ratingnewwinner, ra2ladder = $ra2newwinner, rank = $ranknewwinner WHERE name='$winnername'";
	$result = mysql_query($sql);
	// ajout de la partie dans la base de donnée
	if($rec == 'yes')
		{
		// ajout du résultat dans la base de donnée avec replay
		$sql = "UPDATE $gamestable SET recorded = 'yes' WHERE game_id = '$gameid'";
		$result = mysql_query($sql);
		}
		else
			{
			if($uplfichierreport == 'yes')
				{
				// ajout du résultat dans la base de donnée avec replay
				$sql = "INSERT INTO $gamestable (winner, loser, date, winnerresult, loserresult, comment, relatedreplay, recorded) VALUES ('$winnername', '$losername', '$date', '$winnerresult', '$loserresult', '$comment', '$replayname', 'yes')";
				$result = mysql_query($sql);
				}
				else
					{
					// ajout du résultat dans la base de donnée sans replay
					$sql = "INSERT INTO $gamestable (winner, loser, date, winnerresult, loserresult, comment, recorded) VALUES ('$winnername', '$losername', '$date', '$winnerresult', '$loserresult', '$comment', 'yes')";
					$result = mysql_query($sql);
					}
			}
	}
	
/****************************************************************************************
/  	GetInfo($idcontrol,$var)															/
/	Allow you to get back info from cookies/sessions									/
/	Command :																			/
/	$var = 'what_you_need';																/
/ 	$what_you_need = GetInfo($idcontrol,$var);											/
/	$idcontrol is to know if you are using sessions or cookies (set in variabledb.php	/
/   $var is to know what you want to get back (ex : 'username')							/
/	$what_you_need will contain the value 												/	
/***************************************************************************************/	
	
function GetInfo($idcontrol,$var)
	{
	if($idcontrol == 'sessions')
		{
		if(isset($_SESSION[$var]))
			{
			return $_SESSION[$var];
			}
			else
				{	
				return 'null';
				}
		}
	if($idcontrol == 'cookies')
		{
		if(isset($_COOKIE[$var]))
			{
			return $_COOKIE[$var];
			}
			else
				{	
				return 'null';
				}
		}
	}
	
/****************************************************************************************
/   DB_size($database)																	/
/	Get the whole database size															/
/	Command :																			/
/	$dbsize = DB_size($database)														/
/ 	$database is the targeted database name												/
/	$dbsize is the targeted database size												/
/	(this script suppose you have selected the database already)						/	
/***************************************************************************************/	

function DB_size($database)
	{
	$sql = "SHOW TABLE STATUS FROM " .$database;
   	$result = mysql_query($sql);
	if($result) 
		{
   		$size = 0;
    	while ($data = mysql_fetch_array($result)) 
			{
   		  	$size = $size + $data["Data_length"] + $data["Index_length"];
   		   	}
   		    return $size;
   		}
   		else 
			{
       		return FALSE;
   			}
	}	
	
/****************************************************************************************
/   ShowMenu($pagescreename, $pageurl, $pagename, $page)								/
/	Show an element in the menu															/
/	Command :																			/
/	ShowMenu($pagescreename, $pageurl, $pagename, $page)								/
/ 	$pagescreename is the text on the link												/
/	$pageurl is the targeted url (after $directory)										/
/	$pagename is the php name of this page (set by $page = 'xxx'						/
/	$page is the actual page php name													/	
/***************************************************************************************/

function ShowMenu($pagescreename, $pageurl, $pagename, $page)
	{
	require('variables.php');
	require('variablesdb.php');
	if($pagename == 'custpage')
		//if the requested link is the added pages links
		{
		$sortby = "page_id DESC";
		$start = "0";
		$finish = "100000";
		$sql="SELECT * FROM $pagestable ORDER BY $sortby LIMIT $start, $finish";
		$result=mysql_query($sql);
		$num = mysql_num_rows($result);
		$cur = 1;
		while ($num >= $cur) 
			//repeat for every page
			{
			$row = mysql_fetch_array($result);
			$title = $row["title"];
			$title = strtolower($title);
			$id = $row["page_id"];
			echo "<span class='menu'><a href='".$directory."/pages.php?number=".$id."'>";
			if(! empty($_GET['number']))
				{
				$number = $_GET['number'];
				}
				else
					{
					$number = '0';
					}
			if ($number == "$id") {echo"<font color='$color4'>";}
			echo $title;
			if ($number == "$id") {echo"</font>";}
			echo "</a></span> | ";
			$cur++;
			}
		}
		else
			//else, others link
			{
			echo "<span class='menu'><a href='".$directory."/".$pageurl.".php";
			if($pageurl == "players") {echo "?startplayers=0&finishplayers=".$numplayerspage;}
			if($pageurl == "playedgames") {echo "?startplayed=0&finishplayed=".$numgamespage;}
			echo "'>";
			if($page == "".$pagename."") {echo "<font color='".$color4."'>";}
			echo $pagescreename;
			if($page == "".$pagename."") {echo "</font>";}
			echo "</a></span> | ";
			}
	}
?>
