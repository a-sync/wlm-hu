<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "login";
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
if(isset($_GET['cksreg']))
	{
	if($_GET['cksreg'] == 1)
		{
		$timestamp_expire = time() + 14*24*3600; 
		setcookie('username', $_POST['username'], $timestamp_expire);
		setcookie('password', $_POST['password'], $timestamp_expire);
		}
	}
if(isset($_GET['powerset']))
	{
	if($_GET['powerset'] == 1)
		{
		$timestamp_expire = time() + 14*24*3600;
		//editer/supprimer les pages
		setcookie('adminpowerisset', 'yes', $timestamp_expire);
		//editer/supprimer les pages
		setcookie('adminpowerpageview', $_POST['adminpowerpageview'], $timestamp_expire);
		//ajouter une page
		setcookie('adminpowerpagepost', $_POST['adminpowerpagepost'], $timestamp_expire);
		//modifier les paramètres de la league
		setcookie('adminpowersettings', $_POST['adminpowersettings'], $timestamp_expire);
		//ajouter un admin
		setcookie('adminpoweraddadmin', $_POST['adminpoweraddadmin'], $timestamp_expire);
		//acceder à la zone league
		setcookie('adminpowerleague', $_POST['adminpowerleague'], $timestamp_expire);
		//accepter une game
		setcookie('adminpowerleagueaddgame', $_POST['adminpowerleagueaddgame'], $timestamp_expire);
		//accepter joueur
		setcookie('adminpowerleagueapprove', $_POST['adminpowerleagueapprove'], $timestamp_expire);
		//bloquer un joueur
		setcookie('adminpowerleagueblockuser', $_POST['adminpowerleagueblockuser'], $timestamp_expire);
		//supprimer une game
		setcookie('adminpowerleaguedeletegame', $_POST['adminpowerleaguedeletegame'], $timestamp_expire);
		//supprimer un joueur
		setcookie('adminpowerleaguedeleteuser', $_POST['adminpowerleaguedeleteuser'], $timestamp_expire);
		//editer un joueur
		setcookie('adminpowerleagueedituser', $_POST['adminpowerleagueedituser'], $timestamp_expire);
		//voir les conflits d'ip
		setcookie('adminpowerleagueip', $_POST['adminpowerleagueip'], $timestamp_expire);
		//reporter une game
		setcookie('adminpowerleaguereport', $_POST['adminpowerleaguereport'], $timestamp_expire);
		//redemarrer la saison
		setcookie('adminpowerleagueresetseason', $_POST['adminpowerleagueresetseason'], $timestamp_expire);
		//acceder à la zone news
		setcookie('adminpowernews', $_POST['adminpowernews'], $timestamp_expire);
		//poster une news
		setcookie('adminpowernewspost', $_POST['adminpowernewspost'], $timestamp_expire);
		//editer/supprimer une news
		setcookie('adminpowernewsview', $_POST['adminpowernewsview'], $timestamp_expire);
		}
	}
require('./../top.php');
?>
<p class="header">Admin section.</p>
<?php
$var = 'username';
$username = GetInfo($idcontrol,$var);
$var = 'password';
$password = GetInfo($idcontrol,$var);
if(($username != 'null') && ($password != 'null'))
	//si le nom est le mot de passe de session existent et ne sont pas vides
	{
?>
	<p class='text'>You are logged in as <b><?php echo $username ?></b>.</p>
<?php
	$var = 'adminpowerisset';
	$adminpowerisset = GetInfo($idcontrol,$var);
	if(($adminpowerisset == 'null') && ($idcontrol == 'cookies') && (! $_GET['powerset']))
		{
?>
		<form name="form1" method="post" action="index.php?powerset=1">
<?php
		$sql = "SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
		$query = mysql_query($sql);
		$row = mysql_fetch_array($query);
?>
		<input type="hidden" name="adminpowerpageview" value="<?php echo $row['adminpowerpageview'] ?>">
		<input type="hidden" name="adminpowerpagepost" value="<?php echo $row['adminpowerpagepost'] ?>">
		<input type="hidden" name="adminpowersettings" value="<?php echo $row['adminpowersettings'] ?>">
		<input type="hidden" name="adminpoweraddadmin" value="<?php echo $row['adminpoweraddadmin'] ?>">
		<input type="hidden" name="adminpowerleague" value="<?php echo $row['adminpowerleague'] ?>">
		<input type="hidden" name="adminpowerleagueaddgame" value="<?php echo $row['adminpowerleagueaddgame'] ?>">
		<input type="hidden" name="adminpowerleagueapprove" value="<?php echo $row['adminpowerleagueapprove'] ?>">
		<input type="hidden" name="adminpowerleagueblockuser" value="<?php echo $row['adminpowerleagueblockuser'] ?>">
		<input type="hidden" name="adminpowerleaguedeletegame" value="<?php echo $row['adminpowerleaguedeletegame'] ?>">
		<input type="hidden" name="adminpowerleaguedeleteuser" value="<?php echo $row['adminpowerleaguedeleteuser'] ?>">
		<input type="hidden" name="adminpowerleagueedituser" value="<?php echo $row['adminpowerleagueedituser'] ?>">
		<input type="hidden" name="adminpowerleagueip" value="<?php echo $row['adminpowerleagueip'] ?>">
		<input type="hidden" name="adminpowerleaguereport" value="<?php echo $row['adminpowerleaguereport'] ?>">
		<input type="hidden" name="adminpowerleagueresetseason" value="<?php echo $row['adminpowerleagueresetseason'] ?>">
		<input type="hidden" name="adminpowernews" value="<?php echo $row['adminpowernews'] ?>">
		<input type="hidden" name="adminpowernewspost" value="<?php echo $row['adminpowernewspost'] ?>">
		<input type="hidden" name="adminpowernewsview" value="<?php echo $row['adminpowernewsview'] ?>">
		<input name="submit" type="submit" value="Click here to finish your log-in.">
<?php
		}
		elseif((empty($_SESSION['adminpowerisset'])) && ($idcontrol == 'sessions'))
			{
			$sql = "SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
			$query = mysql_query($sql);
			$row = mysql_fetch_array($query);
			$_SESSION['adminpowerisset'] = 'yes';
			//editer/supprimer les pages
			$_SESSION['adminpowerpageview'] = $row['adminpowerpageview'];
			//ajouter une page
			$_SESSION['adminpowerpagepost'] = $row['adminpowerpagepost'];
			//modifier les paramètres de la league
			$_SESSION['adminpowersettings'] = $row['adminpowersettings'];
			//ajouter un admin
			$_SESSION['adminpoweraddadmin'] = $row['adminpoweraddadmin'];
			//acceder à la zone league
			$_SESSION['adminpowerleague'] = $row['adminpowerleague'];
			//accepter une game
			$_SESSION['adminpowerleagueaddgame'] = $row['adminpowerleagueaddgame'];
			//accepter joueur
			$_SESSION['adminpowerleagueapprove'] = $row['adminpowerleagueapprove'];
			//bloquer un joueur
			$_SESSION['adminpowerleagueblockuser'] = $row['adminpowerleagueblockuser'];
			//supprimer une game
			$_SESSION['adminpowerleaguedeletegame'] = $row['adminpowerleaguedeletegame'];
			//supprimer un joueur
			$_SESSION['adminpowerleaguedeleteuser'] = $row['adminpowerleaguedeleteuser'];
			//editer un joueur
			$_SESSION['adminpowerleagueedituser'] = $row['adminpowerleagueedituser'];
			//voir les conflits d'ip
			$_SESSION['adminpowerleagueip'] = $row['adminpowerleagueip'];
			//reporter une game
			$_SESSION['adminpowerleaguereport'] = $row['adminpowerleaguereport'];
			//redemarrer la saison
			$_SESSION['adminpowerleagueresetseason'] = $row['adminpowerleagueresetseason'];
			//acceder à la zone news
			$_SESSION['adminpowernews'] = $row['adminpowernews'];
			//poster une news
			$_SESSION['adminpowernewspost'] = $row['adminpowernewspost'];
			//editer/supprimer une news
			$_SESSION['adminpowernewsview'] = $row['adminpowernewsview'];
?>
			<form name="form1" method="post" action="index.php">
			<input name="submit" type="submit" value="Click here to finish your log-in.">
<?php
			}
			else
				{
				//page admin si tout est enregistré
?>
<?php
//récupération de toutes les valeurs du panel dans la base de donnée
//taille de la bdd
$dbsize = DB_size($databasename);
//nombre de membres
$sql = "SELECT * FROM $playerstable";
$query = mysql_query($sql);
$query2 = mysql_query($sql);
$howmanymembers = mysql_num_rows($query);
//nombre de membres ces 5 derniers jours
$timenow = time();
$time5daybefore = $timenow - 5*86400;
$howmanymemberslast5day = 0;
$compteur = 1;
while($howmanymembers >= $compteur) 
	{
	$row = mysql_fetch_array($query);
	if($row['joindate'] > $time5daybefore)
		{
		$howmanymemberslast5day++;
		}
	$compteur++;
	} 
//nombre de membre bloqués/non acceptés
$howmanynonapprovedplayer = 0;
$compteur = 1;
while($howmanymembers >= $compteur) 
	{
	$row = mysql_fetch_array($query);
	if($row['approved'] > $time5daybefore)
		{
		$howmanynonapprovedplayer++;
		}
	$compteur++;
	}
//nombre de messages privés
$sql = "SELECT * FROM $privmsgtable";
$query = mysql_query($sql);
$query2 = mysql_query($sql);
$howmanyprivmsg = mysql_num_rows($query);
//nombre de parties jouées
$sql = "SELECT * FROM $gamestable";
$query = mysql_query($sql);
$howmanyplayedgames = mysql_num_rows($query);
//nombre de parties ces 5 derniers jours
$howmanyplayedgameslast5day = 0;
$compteur = 1;
while($howmanyplayedgames >= $compteur) 
	{
	$row = mysql_fetch_array($query);
	$playeddate = $row['date'];
	$playeddateex = explode("/", $playeddate);
	$timestampplayeddate = mktime(0,0,0,$playeddateex[1],$playeddateex[0],$playeddateex[2]);
	if($timestampplayeddate > $time5daybefore)
		{
		$howmanyplayedgameslast5day++;
		}
	$compteur++;
	}
//nombre de parties non approuvées
$howmanynonapprovedgames = 0;
$compteur = 1;
while($howmanyplayedgames >= $compteur) 
	{
	$row = mysql_fetch_array($query2);
	if($row['recorded'] > $time5daybefore)
		{
		$howmanynonapprovedplayer++;
		}
	$compteur++;
	}
//nombre de replay dans la base de données
$sql = "SELECT * FROM $replaystable";
$query = mysql_query($sql);
$howmanyreplay = mysql_num_rows($query);
//nombre d'admins
$sql = "SELECT * FROM $admintable";
$query = mysql_query($sql);
$adminsnumber = mysql_num_rows($query);
//nombre de news postées
$sql = "SELECT * FROM $newstable";
$query = mysql_query($sql);
$newsposted = mysql_num_rows($query);
//nombre de page ajoutées
$sql = "SELECT * FROM $pagestable";
$query = mysql_query($sql);
$pageadded = mysql_num_rows($query);
//récupération de toutes les valeures sur la league
$sql = "SELECT * FROM $varstable";
$query = mysql_query($sql);
$row = mysql_fetch_array($query);
$pointsystem = $row['system'];
$approveplayers = $row['approve'];
$recordgames = $row['approvegames'];
$maxnumbers = $row['maxplayers'];
$whoreport = $row['report'];
$loginsystem = $row['idcontrol'];
$adminmail = $row['adminmail'];
?>
<br>
<hr align='center' width='75%' size='2'>
<table width="740" border="1" align="center" bordercolor="#666666" bgcolor="#CCCCCC">
  <tr> 
    <td><div align="center"><font size="5"><strong><?php echo $leaguename ?>'s 
        statistics panel</strong></font></div></td>
  </tr>
  <tr> 
    <td><table width="100%" border="0">
        <tr>
          <td width="40">&nbsp;</td>
          <td> <br>
		  <p class="text">- <font size="3" color="#000000">Database info : </font></p>
            <table width="80%" border="0" align="center">
              <tr> 
                <td width="365"><font size="3">Database name :</font></td>
                <td><?php echo $databasename ?></td>
              </tr>
              <tr> 
                <td><font size="3">Database size :</font></td>
                <td><?php echo $dbsize ?> octets</td>
              </tr>
            </table>
            <div align="center"></div>
            <p class="text">- <font color="#000000" size="3">Members info :</font></p>
            <table width="80%" border="0" align="center">
              <tr> 
                <td width="365"><font size="3">Number of members :</font></td>
                <td><?php echo $howmanymembers ?></td>
              </tr>
              <tr> 
                <td><font size="3">Number of members joining in the past 5 days 
                  :</font></td>
                <td><?php echo $howmanymemberslast5day ?></td>
              </tr>
              <tr> 
                <td><font size="3">Number of blocked/non approved (yet) members 
                  : </font></td>
                <td><?php echo $howmanynonapprovedplayer ?></td>
              </tr>
              <tr>
                <td><font size="3">Number of private messages in the database 
                  (not deleted) : </font></td>
                <td><?php echo $howmanyprivmsg ?></td>
              </tr>
            </table>
            <p class="text">- <font size="3" color="#000000">Games info :</font></p>
            <table width="80%" border="0" align="center">
              <tr> 
                <td width="365"><font size="3">Number of games played : </font></td>
                <td><?php echo $howmanyplayedgames ?></td>
              </tr>
              <tr> 
                <td><font size="3">Number of games played in the last 5 days :</font> 
                </td>
                <td><?php echo $howmanyplayedgameslast5day ?></td>
              </tr>
              <tr> 
                <td><font size="3">Number of non approved yet games :</font></td>
                <td><?php echo $howmanynonapprovedgames ?></td>
              </tr>
              <tr>
                <td><font size="3">Number of uploaded replay : </font></td>
                <td><?php echo $howmanyreplay ?></td>
              </tr>
            </table>
            <p class="text">- <font color="#000000" size="3">Other <?php echo $leaguename ?>'s 
              infos :</font></p>
            <table width="80%" border="0" align="center">
              <tr> 
                <td width="365">Number of admins :</td>
                <td><?php echo $adminsnumber ?></td>
              </tr>
              <tr> 
                <td>Number of news posted :</td>
                <td><?php echo $newsposted ?></td>
              </tr>
              <tr> 
                <td>Number of page added :</td>
                <td><?php echo $pageadded ?></td>
              </tr>
              <tr> 
                <td>Point system :</td>
                <td><?php echo $pointsystem ?></td>
              </tr>
              <tr> 
                <td>Approve players before they join :</td>
                <td><?php echo $approveplayers ?></td>
              </tr>
              <tr> 
                <td>Admin must record the game :</td>
                <td><?php echo $recordgames ?></td>
              </tr>
              <tr> 
                <td>Maximum number of members :</td>
                <td><?php echo $maxnumbers ?></td>
              </tr>
              <tr> 
                <td>Who report the games :</td>
                <td><?php echo $whoreport ?></td>
              </tr>
              <tr> 
                <td>Log-in system used :</td>
                <td><?php echo $loginsystem ?></td>
              </tr>
              <tr>
                <td>Main administrator's mail :</td>
                <td><?php echo $adminmail ?></td>
              </tr>
            </table>
            <p class="text"><br>
            </p></td>
        </tr>
      </table> </td>
  </tr>
</table><br><br><!-- those 2 <br> are for netscape navigators (at least opera) -->
<?php
				}
	}
	else
		{
		if(! empty($_POST['username']))
			{
			$username = $_POST['username'];
			}
			else
				{
				$username = '';
				}
		if(! empty($_POST['password']))
			{
			$password = $_POST['password'];
			}
			else
				{
				$password = '';
				}
		$sql="SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
		$result=mysql_query($sql);
		$number = mysql_num_rows($result);
		if ($number == "1") {
?>
		<p class='text'>You are logged in as <b><?php echo "$username" ?></b>.</p>
<?php
		if($idcontrol == 'cookies')
			{
?>
			<form name="form1" method="post" action="index.php?powerset=1">
<?php
			
			$row = mysql_fetch_array($result);
?>
			<input type="hidden" name="adminpowerpageview" value="<?php echo $row['adminpowerpageview'] ?>">
			<input type="hidden" name="adminpowerpagepost" value="<?php echo $row['adminpowerpagepost'] ?>">
			<input type="hidden" name="adminpowersettings" value="<?php echo $row['adminpowersettings'] ?>">
			<input type="hidden" name="adminpoweraddadmin" value="<?php echo $row['adminpoweraddadmin'] ?>">
			<input type="hidden" name="adminpowerleague" value="<?php echo $row['adminpowerleague'] ?>">
			<input type="hidden" name="adminpowerleagueaddgame" value="<?php echo $row['adminpowerleagueaddgame'] ?>">
			<input type="hidden" name="adminpowerleagueapprove" value="<?php echo $row['adminpowerleagueapprove'] ?>">
			<input type="hidden" name="adminpowerleagueblockuser" value="<?php echo $row['adminpowerleagueblockuser'] ?>">
			<input type="hidden" name="adminpowerleaguedeletegame" value="<?php echo $row['adminpowerleaguedeletegame'] ?>">
			<input type="hidden" name="adminpowerleaguedeleteuser" value="<?php echo $row['adminpowerleaguedeleteuser'] ?>">
			<input type="hidden" name="adminpowerleagueedituser" value="<?php echo $row['adminpowerleagueedituser'] ?>">
			<input type="hidden" name="adminpowerleagueip" value="<?php echo $row['adminpowerleagueip'] ?>">
			<input type="hidden" name="adminpowerleaguereport" value="<?php echo $row['adminpowerleaguereport'] ?>">
			<input type="hidden" name="adminpowerleagueresetseason" value="<?php echo $row['adminpowerleagueresetseason'] ?>">
			<input type="hidden" name="adminpowernews" value="<?php echo $row['adminpowernews'] ?>">
			<input type="hidden" name="adminpowernewspost" value="<?php echo $row['adminpowernewspost'] ?>">
			<input type="hidden" name="adminpowernewsview" value="<?php echo $row['adminpowernewsview'] ?>">
			<input name="submit" type="submit" value="Click here to finish your log-in.">
<?php
			}
		if($idcontrol == 'sessions')
			{
			$row = mysql_fetch_array($result);
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['adminpowerisset'] = 'yes';
			//editer/supprimer les pages
			$_SESSION['adminpowerpageview'] = $row['adminpowerpageview'];
			//ajouter une page
			$_SESSION['adminpowerpagepost'] = $row['adminpowerpagepost'];
			//modifier les paramètres de la league
			$_SESSION['adminpowersettings'] = $row['adminpowersettings'];
			//ajouter un admin
			$_SESSION['adminpoweraddadmin'] = $row['adminpoweraddadmin'];
			//acceder à la zone league
			$_SESSION['adminpowerleague'] = $row['adminpowerleague'];
			//accepter une game
			$_SESSION['adminpowerleagueaddgame'] = $row['adminpowerleagueaddgame'];
			//accepter joueur
			$_SESSION['adminpowerleagueapprove'] = $row['adminpowerleagueapprove'];
			//bloquer un joueur
			$_SESSION['adminpowerleagueblockuser'] = $row['adminpowerleagueblockuser'];
			//supprimer une game
			$_SESSION['adminpowerleaguedeletegame'] = $row['adminpowerleaguedeletegame'];
			//supprimer un joueur
			$_SESSION['adminpowerleaguedeleteuser'] = $row['adminpowerleaguedeleteuser'];
			//editer un joueur
			$_SESSION['adminpowerleagueedituser'] = $row['adminpowerleagueedituser'];
			//voir les conflits d'ip
			$_SESSION['adminpowerleagueip'] = $row['adminpowerleagueip'];
			//reporter une game
			$_SESSION['adminpowerleaguereport'] = $row['adminpowerleaguereport'];
			//redemarrer la saison
			$_SESSION['adminpowerleagueresetseason'] = $row['adminpowerleagueresetseason'];
			//acceder à la zone news
			$_SESSION['adminpowernews'] = $row['adminpowernews'];
			//poster une news
			$_SESSION['adminpowernewspost'] = $row['adminpowernewspost'];
			//editer/supprimer une news
			$_SESSION['adminpowernewsview'] = $row['adminpowernewsview'];
?>
			<form name="form1" method="post" action="index.php">
			<input name="submit" type="submit" value="Click here to finish your log-in.">
<?php
			}
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
		if($submit == 1) {
		$error = "";
		?>
		<p class='text'>Login failed.</p>
		<?php
		}
		?>
		<form name="form1" method="post" action="index.php?submit=1<?php if($idcontrol == 'cookies'){echo '&cksreg=1';} ?>">
		<table border="0" cellpadding="0">
		<tr>
		<td><p class='text'>Name:</p></td>
		<td><input type="text" name="username" size="20" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
		</tr>
		<tr>
		<td><p class='text'>Password:</p></td>
		<td><input type="password" name="password" size="20" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
		</tr>
		<tr>
		<td><input type="submit" value="Log in." name="submit" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
		</tr>
		</table>
		</form>
		<?php
		}
		}
?>
<?php
require('./../bottom.php');
?>