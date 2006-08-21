<?php
$page = 'sendmsg';
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
		if(! empty($_GET['submit']))
			{
			$submit = $_GET['submit'];
			}
			else
				{
				$submit = 0;
				}
		if($submit == 1)
			//si il y a submit
			{
			//récupère le texte du message ou prend ''
			if(! empty($_POST['text']))
				{
				$text = $_POST['text'];
				}
				else
					{
					$text = '';
					}
			//récupère le titre du message ou prend ''		
			if(! empty($_POST['title'])) 
				{
				$title = $_POST['title'];
				}
				else
					{
					$title = '';
					}
			//récupère le recepteur du message ou prend ''		
			if(! empty($_POST['name']))
				{
				$name = $_POST['name'];
				}
				else
					{
					$name = '';
					}
			//<-- Toute les variables récupérées, on les test -->
			if(! empty($name))
				//si le nom n'est pas vide
				{
				if(strlen($name) < 21)
					//si le nom fait moins de 21 caractères
					{
					if(! empty($title))
						//si le titre n'est pas vide
						{
						if(strlen($title) < 100)
							//si le titre fait moins de 100 caractères
							{
							if(! empty($text))
								//si le message n'est pas vide
								{
								//envoi le message dans la bdd
								$resultmsg = SendPrivmsg($editname,$editnamepswd,$name,$text,$title);
								echo $resultmsg;
								echo "<p class='text'><a href='$directory/members/memberspage.php'><font color='$color1'>Back to the members page ...</font></a></p>";
								}
								else
									{
									echo "<p class='text'>You must type a message !</p>
					 					 <p class='text'><a href='$directory/members/sendprivmsg.php'><font color='$color1'>Retry to send a message ...</font></a></p>";
					 				}
							}
							else
								{
								echo "<p class='text'>Your title is too long !</p>
					 					 <p class='text'><a href='$directory/members/sendprivmsg.php'><font color='$color1'>Retry to send a message ...</font></a></p>";
				 				}
						}
						else
							{
							echo "<p class='text'>You must type a title !</p>
								    <p class='text'><a href='$directory/members/sendprivmsg.php'><font color='$color1'>Retry to send a message ...</font></a></p>";
							}
					}
					else
						{
						echo "<p class='text'>The requested receiver doesn't exist !</p>
					 			<p class='text'><a href='$directory/members/sendprivmsg.php'><font color='$color1'>Retry to send a message ...</font></a></p>";
					 	}
				}
				else
					{
					echo "<p class='text'>No receiver specified !</p>
					 		<p class='text'><a href='$directory/members/sendprivmsg.php'><font color='$color1'>Retry to send a message ...</font></a></p>";
					}
			}
			else
				//si pas de submit
				{
				echo "<p class='text'>Sorry, you can't access to this page.</p>
					  <p class='text'><a href='$directory/members/memberspage.php'><font color='$color1'>Back to the members' page ...</font></a></p>";
				}
?>
<?php
		}
require('./../bottom.php');
?>