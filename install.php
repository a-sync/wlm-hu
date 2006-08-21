<?php 
if (! empty($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}
if ($submit == 1) 
	{
	echo 'Táblák létrehozása...<br><br>';
	include ('variables.php');
	$db = mysql_connect($databaseserver, $databaseuser, $databasepass)
		or die('Nem sikerült kapcsolódni a MySQL szerverhez<br>\n');
	$query = mysql_select_db($databasename)
		or die('Nem sikerült kapcsolódni az adatbázishoz<br>\n');
	
	$sql = "CREATE TABLE $playerstable (player_id int(10) NOT NULL auto_increment, name varchar(20) DEFAULT '' NOT NULL, passworddb varchar(10), approved  varchar(10) DEFAULT 'no', joindate INT, mail varchar(50), icq varchar(15), aim varchar(40), msn varchar (100), country varchar(40), rating int(10) DEFAULT '1500', ra2ladder int(11) DEFAULT '0', games int(10) DEFAULT '0', wins int(10) DEFAULT '0', losses int(10) DEFAULT '0', points int(10) DEFAULT '0', totalwins int(10) DEFAULT '0', totallosses int(10) DEFAULT '0', totalpoints int(10) DEFAULT '0', totalgames int(10) DEFAULT '0', rank int(10) DEFAULT '0', streakwins int(10) DEFAULT '0', streaklosses int(10) DEFAULT '0', ip varchar(100), PRIMARY KEY (player_id), UNIQUE(name))";
	$query = mysql_query($sql);
	echo 'Játékosok táblái<br><br>';
		
	$sql = "CREATE TABLE $gamestable (game_id int(10) NOT NULL auto_increment, winner varchar(40), loser varchar(40), date varchar(40), winnerresult VARCHAR(30), loserresult VARCHAR(30), comment varchar(255), relatedreplay VARCHAR( 255 ), recorded varchar(10), PRIMARY KEY (game_id))";
	$query = mysql_query($sql);
	echo 'Játékok táblái<br><br>';
	
	$sql = "CREATE TABLE $admintable (id int(10) NOT NULL auto_increment, name varchar(40), password varchar(40), adminpowerpageview VARCHAR( 3 ), adminpowerpagepost VARCHAR( 3 ), adminpowersettings VARCHAR( 3 ), adminpoweraddadmin VARCHAR( 3 ), adminpowerleague VARCHAR( 3 ), adminpowerleagueaddgame VARCHAR( 3 ), adminpowerleagueapprove VARCHAR( 3 ), adminpowerleagueblockuser VARCHAR( 3 ), adminpowerleaguedeletegame VARCHAR( 3 ), adminpowerleaguedeleteuser VARCHAR( 3 ), adminpowerleagueedituser VARCHAR( 3 ), adminpowerleagueip VARCHAR( 3 ), adminpowerleaguereport VARCHAR( 3 ), adminpowerleagueresetseason VARCHAR( 3 ), adminpowernews VARCHAR( 3 ), adminpowernewspost VARCHAR( 3 ), adminpowernewsview VARCHAR( 3 ), PRIMARY KEY (id))";
	$query = mysql_query($sql);
	echo 'Adminisztrátorok táblái<br><br>';
		
	$sql = "CREATE TABLE $newstable (news_id int(10) NOT NULL auto_increment, title varchar (100), date varchar (100), news text, PRIMARY KEY (news_id))";
	$query = mysql_query($sql);
	echo 'Hírek táblái<br><br>';

	$sql = "CREATE TABLE $pagestable (page_id int(10) NOT NULL auto_increment, title varchar (100), page text, PRIMARY KEY (page_id))";
	$query = mysql_query($sql);
	echo 'Lapok táblái<br><br>';

	$sql = "CREATE TABLE $varstable (vars_id int(10) NOT NULL auto_increment, color1 varchar(20), color2 varchar (20), color3 varchar (20), color4 varchar (20), color5 varchar (20), color6 varchar(20), color7 varchar(20), font varchar(80), fontweight varchar(40), fontsize varchar(20), numgamespage int(10), numplayerspage int(10),  statsnum int(10), hotcoldnum varchar(10), gamesmaxdayplayer int(10), gamesmaxday int(10), approve varchar(10), approvegames varchar(10), system varchar (40), pointswin int(10), pointsloss int(10), report varchar (20), leaguename varchar (100), titlebar varchar (100), newsitems int(10), copyright text, ra2ladderneg VARCHAR( 3 ), uplfichierreport VARCHAR( 3 ), uplfichierreportforce CHAR(3), maxsizereplayupl INT(11), extvalable1 VARCHAR(4), extvalable2 VARCHAR(4) , extvalable3 VARCHAR(4), idcontrol VARCHAR(10), reportresult VARCHAR(3), adminmail VARCHAR(50), allowpswdmail VARCHAR( 3 ), maxplayers INT, top5warriorsonindex VARCHAR(3), last5gamesonindex VARCHAR( 3 ), menuorder TEXT, maxgameslinkpage INT, PRIMARY KEY (vars_id))";
	$query = mysql_query($sql);
	echo 'Változók táblái<br><br>';
	
	$sql = "CREATE TABLE $privmsgtable (Id_msg int(11) NOT NULL auto_increment, Id_sender int(11) NOT NULL default '0', Id_receiver int(11) NOT NULL default '0', Text text NOT NULL,`Title` varchar(100) NOT NULL default '', Date int(11) NOT NULL default '0',PRIMARY KEY  (Id_msg))";
	$query = mysql_query($sql);
	echo 'Személyes üzenetek táblái<br><br>';
	
	$sql = "CREATE TABLE $replaystable ( replay_id INT NOT NULL auto_increment, titre VARCHAR( 255 ) NOT NULL , sender VARCHAR( 20 ) NOT NULL , size INT NOT NULL , date varchar(40), PRIMARY KEY (replay_id) )";
	$query = mysql_query($sql);
	echo 'Visszajátszások táblái<br><br><br>';
	
	$date = date('Y.m.d.');
	echo 'Alapértékek beállítása...<br><br>';
	$sql = "INSERT INTO $newstable (news, title, date) VALUES ('Congratulations, you have successfully installed WebLeague m0d edition a3p2.<br><br>Now, go to <a href=\"Admin/index.php\"><font color=\"#000000\">the admin section</font></a>, and adapt the settings to your needs.<br>If you have any suggestion, you found a bug, or if you want to speak about WebLeague m0d or to ask about coming features, <a href=\"http://kidlogis.com/lepidosteus/webleague/\"><font color=\"#000000\">WebLeague m0d\'s website</font></a> is the place you need ;)<br><br>You can edit and share this script as you want, as long as you don\'t edit the copyright notice at the bottom of the page.<br><br>Enjoy. :)', 'Web<i>League</i> m0d a3p2 install successfull !', '$date')";
	$query = mysql_query($sql);
	echo 'Hírek beillesztése...<br><br>';

	$sql = "INSERT INTO $varstable (color1, color2, color3, color4, color5, color6, color7, font, fontweight, fontsize, numgamespage, numplayerspage, statsnum, hotcoldnum, gamesmaxdayplayer, gamesmaxday, approve, approvegames, system, pointswin, pointsloss, report, leaguename, titlebar, newsitems, copyright, ra2ladderneg, uplfichierreport, uplfichierreportforce, maxsizereplayupl, extvalable1, extvalable2, extvalable3, idcontrol, reportresult, adminmail, allowpswdmail, maxplayers, top5warriorsonindex, last5gamesonindex, menuorder, maxgameslinkpage) VALUES ('#000000', '#FFFFFF', '#66CC66', '#339933', '#EEEEEE', '#000000', '#FFFFFF', 'Tahoma', 'normal', '11', 20, 30, 10, '5', 5, 30, 'no', 'no', 'Elorating', 2, -1, 'loser', 'Web<i>League</i> - m0d edition', 'WebLeague - m0d edition', 4, '<a href=\"http://kidlogis.com/lepidosteus/webleague/\">WebLeague - m0d edition</a> made by : <a href=\"mailto:masterofkill@hotmail.com\">Lepidosteus</a>, based on the version 2.0.1 of <a href=\"http://www.worms-league.com/WebLeague\">WebLeague</a>', 'no', 'yes', 'no', 1000000, 'jpg', 'gif', 'rep', '".$_POST['idcontrol']."', 'no', 'yourmail@yourhost.com', 'no', 300, 'yes', 'yes', 'News:index:index*Join:join:join*Members area:members/index:members*Players:players:players*Standings:standings:standings*Report:report:report*Played games:playedgames:playedgames*Statistics:statistics:statistics*custpage:custpage:custpage*Forum:forum/index:forum', 15)";
	$query = mysql_query($sql);
	echo 'Változók beillesztése...<br><br>';

	$sql = "INSERT INTO $admintable( name, PASSWORD, `adminpowerpageview`, `adminpowerpagepost`, `adminpowersettings`, `adminpoweraddadmin`, `adminpowerleague`, `adminpowerleagueaddgame`, `adminpowerleagueapprove`, `adminpowerleagueblockuser`, `adminpowerleaguedeletegame`, `adminpowerleaguedeleteuser`, `adminpowerleagueedituser`, `adminpowerleagueip`, `adminpowerleaguereport`, `adminpowerleagueresetseason`, `adminpowernews`, `adminpowernewspost`, `adminpowernewsview` ) VALUES ('".$_POST['name']."', '".$_POST['password']."', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes')";
	$result = mysql_query($sql);
	echo 'Adminisztrátori fiók létrehozva.<br><br>';
	echo 'Adminisztrátor neve : '.$_POST['name'].'<br>Adminisztrátor jelszó : '.$_POST['password'].'<br>Admin jogok kiosztása '.$_POST['name'].' ...<br><br>';
	echo 'A W<i>L</i>m HU 1.0 sikeresen feltelepült.';
	}
 else
 	{	
?>
	<form method="post" action="install.php?submit=1">
  <p align="center"><font size="4"><b>W<i>L</i>m HU 1.0 telepítés.</b></font></p>
  <table width="600" border="0" align="center">
    <tr bgcolor="navy"> 
      <td colspan="2"><div align="center">
          <p><font color="white"><b>Adminisztrátor létrehozása: </b></font></p>
        </div></td>
    </tr>
    <tr> 
      <td>Felhasználó név:</td>
      <td><div align="right">
          <input type="Text" name="name">
        </div></td>
    </tr>
    <tr> 
      <td>Jelszó:</td>
      <td><div align="right">
          <input type="password" name="password">
        </div></td>
    </tr>
    <tr> 
      <td colspan="2"><p>&nbsp;</p>
        <p align="center">Válaszd ki, hogy a felhasználók/adminok bejelentkezését <i>cookies</i>, vagy <i>sessions</i> módszerrel szeretnéd-e megoldani. 
        A <i>sessions</i> módszer biztonságosabb, de minden alkalommal meg kell adni a nevet/jelszót, míg a <i>cookies</i>-t használva csupán egyszer, és elmentõdik az adott gépen. 
        Ha nemtudod mit válassz és esetleg a <i>sessions</i> módszerrel valami hiba lenne, vagy csak egyszerûen telepíteni szeretnél már végre, akkor válaszd a <i>cookies</i>-t.</p>
        <p align="center">&nbsp;</p></td>
    </tr>
    <tr border="1"> 
      <td>Bejelentkezéshez <i>cookies</i> vagy <i>sessions</i> módszer legyen ?</td>
      <td> <div align="right">
          <select size="1" name="idcontrol">
            <option selected>cookies</option>
            <option>cookies</option>
            <option>sessions</option>
          </select>
        </div></td>
    </tr>
  </table>
  <div align="center">
	<center>
      <p>&nbsp;</p>
    </center>
	</div>
	<p align="center">
	<input type="Submit" name="submit" value="WLm HU 1.0 telepítése">
	</form>
<?php
	}
?>