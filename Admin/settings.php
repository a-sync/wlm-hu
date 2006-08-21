<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "settings";
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
require('./../top.php');
?>
<?php
$var = 'username';
$username = GetInfo($idcontrol,$var);
$var = 'password';
$password = GetInfo($idcontrol,$var);
$sql="SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
$result=mysql_query($sql,$db);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpowersettings == 'yes')) {
?>
<p class="header">Settings.</p>
<?php
if (isset($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}
if ($submit == 1) {
//récupération des valeurs du menu
$menuorder = "";
$arrayplacepage = array 
	("index" => $_POST['index'],
	"join" => $_POST['join'],
	"members" => $_POST['members'],
	"players" => $_POST['players'],
	"standings" => $_POST['standings'],
	"report" => $_POST['report'],
	"playedgames" => $_POST['playedgames'],
	"statistics" => $_POST['statistics'],
	"pages" => $_POST['pages']);
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 1) {$menuorder .= "$pagename*";}
	}
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 2) {$menuorder .= "$pagename*";}
	}
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 3) {$menuorder .= "$pagename*";}
	}
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 4) {$menuorder .= "$pagename*";}
	}
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 5) {$menuorder .= "$pagename*";}
	}
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 6) {$menuorder .= "$pagename*";}
	}
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 7) {$menuorder .= "$pagename*";}
	}
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 8) {$menuorder .= "$pagename*";}
	}
foreach($arrayplacepage as $pagename => $pagenumber)
	{
	if($pagenumber == 9) {$menuorder .= "$pagename*";}
	}
$arrayofreplacement = array
	("index" => "News:index:index",
	"join" => "Join:join:join",
	"members" => "Members area:members/index:members",
	"players" => "Players:players:players",
	"standings" => "Standings:standings:standings",
	"report" => "Report:report:report",
	"playedgames" => "Played games:playedgames:playedgames",
	"statistics" => "Statistics:statistics:statistics",
	"pages" => "custpage:custpage:custpage");
foreach($arrayofreplacement as $pagename => $code)
	{
	$menuorder = str_replace("$pagename", "$code", "$menuorder");
	}
$menuorder .= "forum:forum/index:forum";
//récuperation des autres valeurs du formulaire
$color11 = $_POST['color11'];
$color21 = $_POST['color21'];
$color31 = $_POST['color31'];
$color41 = $_POST['color41'];
$color51 = $_POST['color51'];
$color61 = $_POST['color61'];
$color71 = $_POST['color71'];
$fontweight1 = $_POST['fontweight1'];
$font1 = $_POST['font1'];
$fontsize1 = $_POST['fontsize1'];
$numgamespage1 = $_POST['numgamespage1'];
$numplayerspage1 = $_POST['numplayerspage1'];
$statsnum1 = $_POST['statsnum1'];
$hotcoldnum1 = $_POST['hotcoldnum1'];
$gamesmaxdayplayer1 = $_POST['gamesmaxdayplayer1'];
$gamesmaxday1 = $_POST['gamesmaxday1'];
$approve1 = $_POST['approve1'];
$approvegames1 = $_POST['approvegames1'];
$system1 = $_POST['system1'];
$pointswin1 = $_POST['pointswin1'];
$pointsloss1 = $_POST['pointsloss1'];
$report1 = $_POST['report1'];
$leaguename1 = $_POST['leaguename1'];
$titlebar1 = $_POST['titlebar1'];
$newsitems1 = $_POST['newsitems1'];
$ra2ladderneg = $_POST['ra2ladderneg'];
$uplfichierreport = $_POST['uplfichierreport'];
$uplfichierreportforce = $_POST['uplfichierreportforce'];
$maxsizereplayupl = $_POST['maxsizereplayupl'];
$extvalable1 = $_POST['extvalable1'];
$extvalable2 = $_POST['extvalable2'];
$extvalable3 = $_POST['extvalable3'];
$idcontrol = $_POST['idcontrol'];
$reportresult = $_POST['reportresult'];
$adminmail = $_POST['adminmail'];
$allowpswdmail = $_POST['allowpswdmail'];
$maxplayers = $_POST['maxplayers'];
$top5warriorsonindex = $_POST['top5warriorsonindex'];
$last5gamesonindex = $_POST['last5gamesonindex'];
$maxgameslinkpage = $_POST['maxgameslinkpage'];
$sql = "UPDATE $varstable SET 
color1 = '$color11', 
color2 = '$color21', 
color3 = '$color31', 
color4 = '$color41', 
color5 = '$color51', 
color6 = '$color61', 
color7 = '$color71', 
fontweight = '$fontweight1', 
font = '$font1', 
fontsize = '$fontsize1', 
numgamespage = '$numgamespage1', 
numplayerspage = '$numplayerspage1', 
statsnum = '$statsnum1', 
hotcoldnum = '$hotcoldnum1', 
gamesmaxdayplayer = '$gamesmaxdayplayer1', 
gamesmaxday = '$gamesmaxday1', 
approve = '$approve1', 
approvegames = '$approvegames1', 
system = '$system1',
pointswin = '$pointswin1',
pointsloss = '$pointsloss1',
report = '$report1',
leaguename = '$leaguename1',
titlebar = '$titlebar1',
newsitems = '$newsitems1',
ra2ladderneg = '$ra2ladderneg',
uplfichierreport = '$uplfichierreport',
uplfichierreportforce = '$uplfichierreportforce',
maxsizereplayupl = '$maxsizereplayupl',
extvalable1 = '$extvalable1',
extvalable2 = '$extvalable2',
extvalable3 = '$extvalable3',
idcontrol = '$idcontrol',
reportresult = '$reportresult',
adminmail = '$adminmail',
allowpswdmail = '$allowpswdmail',
maxplayers = '$maxplayers',
top5warriorsonindex = '$top5warriorsonindex',
last5gamesonindex = '$last5gamesonindex',
menuorder = '$menuorder',
maxgameslinkpage = '$maxgameslinkpage'
";
$result = mysql_query($sql) or die(mysql_error());
echo "<p class='text'>Thank you! Information entered.</p>";
} else{
?>
<form method="post" action="settings.php?submit=1">
<table border="0" cellpadding="0">
<?php
$sql="SELECT * FROM $varstable";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$color1 = $row["color1"];
$color2 = $row["color2"];
$color3 = $row["color3"];
$color4 = $row["color4"];
$color5 = $row["color5"];
$color6 = $row["color6"];
$color7 = $row["color7"];
$font1 = $row["font"];
$fontsize = $row["fontsize"];
$fontweight = $row["fontweight"];
$numplayerspage = $row["numplayerspage"];
$numgamespage = $row["numgamespage"];
$statsnum = $row["statsnum"];
$hotcoldnum = $row["hotcoldnum"];
$gamesmaxdayplayer = $row["gamesmaxdayplayer"];
$gamesmaxday = $row["gamesmaxday"];
$approve = $row["approve"];
$system = $row["system"];
$approvegames = $row["approvegames"];
$pointswin = $row["pointswin"];
$pointsloss = $row["pointsloss"];
$report = $row["report"];
$leaguename = $row["leaguename"];
$titlebar = $row["titlebar"];
$newsitems = $row["newsitems"];
$ra2ladderneg = $row['ra2ladderneg'];
$uplfichierreport = $row['uplfichierreport'];
$uplfichierreportforce = $row['uplfichierreportforce'];
$maxsizereplayupl = $row['maxsizereplayupl'];
$extvalable1 = $row['extvalable1'];
$extvalable2 = $row['extvalable2'];
$extvalable3 = $row['extvalable3'];
$idcontrol = $row['idcontrol'];
$reportresult = $row['reportresult'];
$adminmail = $row['adminmail'];
$allowpswdmail = $row['allowpswdmail'];
$maxplayers = $row['maxplayers'];
$top5warriorsonindex = $row['top5warriorsonindex'];
$last5gamesonindex = $row['last5gamesonindex'];
$menuorder = $row['menuorder'];
$maxgameslinkpage = $row['maxgameslinkpage'];
?>
<?php
//traitement info du menu
$arrayofreplacement = array
	("News:index:index" => "index",
	"Join:join:join" => "join",
	"Members area:members/index:members" => "members",
	"Players:players:players" => "players",
	"Standings:standings:standings" => "standings",
	"Report:report:report" => "report",
	"Played games:playedgames:playedgames" => "playedgames",
	"Statistics:statistics:statistics" => "statistics",
	"custpage:custpage:custpage" => "pages");
foreach($arrayofreplacement as $code => $pagename)
	{
	$menuorder = str_replace("$code", "$pagename", "$menuorder");
	}
list($pagename1, $pagename2, $pagename3, $pagename4, $pagename5, $pagename6, $pagename7, $pagename8, $pagename9, $pagename10) = explode("*", $menuorder);
?>
<tr>
<td width="400"><p class="text"><b>General league info</b></p></td>
<td><p class="text">&nbsp;</p></td>
</tr>
<tr>
<td><p class="text">League name:</p></td>
<td><input type="Text" name="leaguename1" value="<?php echo"$leaguename" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Title of pages:</p></td>
<td><input type="Text" name="titlebar1" value="<?php echo"$titlebar" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Administrator's mail:</p></td>
<td><input type="Text" name="adminmail" value="<?php echo"$adminmail" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Use cookies or sessions for log-in ?</p></td>
<td><select size="1" name="idcontrol" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo $idcontrol ?></option>
<option>cookies</option>
<option>sessions</option>
</select></td>
</tr>
<tr>
<td><p class="text"><br><b>Cosmetics</b></p></td>
<td><p class="text">&nbsp;</p></td>
</tr>
<tr>
<td><p class="text">Color 1 (text):</p></td>
<td><input type="Text" name="color11" value="<?php echo"$color1" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Color 2 (header text, menu links):</p></td>
<td><input type="Text" name="color21" value="<?php echo"$color2" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Color 3 (light bar):</p></td>
<td><input type="Text" name="color31" value="<?php echo"$color3" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Color 4 (dark bar):</p></td>
<td><input type="Text" name="color41" value="<?php echo"$color4" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Color 5 (table background, form fields):</p></td>
<td><input type="Text" name="color51" value="<?php echo"$color5" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Color 6: (header background, menu background)</p></td>
<td><input type="Text" name="color61" value="<?php echo"$color6" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Color 7: (page background)</p></td>
<td><input type="Text" name="color71" value="<?php echo"$color7" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Font:</p></td>
<td><input type="Text" name="font1" value="<?php echo"$font1" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<tr>
<td><p class="text">Font size (in points):</p></td>
<td><input type="Text" name="fontsize1" value="<?php echo"$fontsize" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Font weight:</p></td>
<td><select size="1" name="fontweight1" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$fontweight" ?></option>
<option>normal</option>
<option>bold</option>
</select></td>
</tr>
<tr>
<td><p class="text"><br></p><p class="text"><b>League settings</b></p></td>
<td><p class="text">&nbsp;</p></td>
</tr>
<tr>
<td><p class="text">Scoring system to use:</p></td>
<td><select size="1" name="system1" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$system" ?></option>
<option>League point system</option>
<option>Elorating</option>
<option>Peter Hendrix ladder</option>
<option>Ra2 system ladder</option>
</select></td>
</tr>
<tr>
<?php
if ($system == "Ra2 system ladder") {
?>
<td><p class="text">Allow negative results in the ladder ?</p></td>
<td><select size="1" name="ra2ladderneg" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$ra2ladderneg" ?></option>
<option>yes</option>
<option>no</option>
</select></td>
</tr>
<?php
}
else {
?>
<input type="hidden" name="ra2ladderneg" value="<?php echo"$ra2ladderneg" ?>">
<?php
}
?>
<?php
if ($system == 'League point system') {
?>
<tr>
<td><p class="text">Points for a win:</p></td>
<td><input type="Text" name="pointswin1" value="<?php echo"$pointswin" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Points for a loss:</p></td>
<td><input type="Text" name="pointsloss1" value="<?php echo"$pointsloss" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<?php
}
else {
?>
<input type="hidden" name="pointsloss1" value="<?php echo"$pointsloss" ?>">
<input type="hidden" name="pointswin1" value="<?php echo"$pointswin" ?>">
<?php
}
?>
<tr>
<td><p class="text">Replay uploading with a report ?</p></td>
<td><select size="1" name="uplfichierreport" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$uplfichierreport" ?></option>
<option>yes</option>
<option>no</option>
</select></td></tr>
<?php
if($uplfichierreport == 'yes')
	{
?>
	<tr>
	<td><p class="text">Max file size for the uploaded replay:</p></td>
	<td><input type="Text" name="maxsizereplayupl" value="<?php echo"$maxsizereplayupl" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
	</tr>
	<tr>
	<td><p class="text">Allowed files (exemple : 'jpg', NOT '.jpg'):</p></td>
	<td><input size="3" type="Text" name="extvalable1" value="<?php echo"$extvalable1" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
	<input size="3" type="Text" name="extvalable2" value="<?php echo"$extvalable2" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
	<input size="3" type="Text" name="extvalable3" value="<?php echo"$extvalable3" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
	</tr>
	<tr>
	<td><p class="text">Do players MUST upload a replay ?</p></td>
	<td><select size="1" name="uplfichierreportforce" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
	<option selected><?php echo "$uplfichierreportforce" ?></option>
	<option>yes</option>
	<option>no</option>
	</select></td></tr>
<?php
	}
	else
		{
?>
		<input type="hidden" name="maxsizereplayupl" value="<?php echo "$maxsizereplayupl" ?>">
		<input type="hidden" name="uplfichierreportforce" value="<?php echo "$uplfichierreportforce" ?>">
		<input type="hidden" name="extvalable1" value="<?php echo "$extvalable1" ?>">
		<input type="hidden" name="extvalable2" value="<?php echo "$extvalable2" ?>">
		<input type="hidden" name="extvalable3" value="<?php echo "$extvalable3" ?>">
<?php
		}
?>
<tr>
<td><p class="text">Who reports the game?</p></td>
<td><select size="1" name="report1" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$report" ?></option>
<option>winner</option>
<option>loser</option>
</select></td>
</tr>
<tr>
<td><p class="text">Give the result of the game (i.e. 2-0)?</p></td>
<td><select size="1" name="reportresult" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$reportresult" ?></option>
<option>yes</option>
<option>no</option>
</select></td>
</tr>
<tr>
<td><p class="text">Allow users to get back their password by mail:</p></td>
<td><select size="1" name="allowpswdmail" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
	<option selected><?php echo "$allowpswdmail" ?></option>
	<option>yes</option>
	<option>no</option>
	</select></td></tr>
<tr>
<td><p class="text">Max number of players in the league:</p></td>
<td><input type="Text" name="maxplayers" value="<?php echo"$maxplayers" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Number of news items on news page:</p></td>
<td><input type="Text" name="newsitems1" value="<?php echo"$newsitems" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Show the top 5 warriors on the news page:</p></td>
<td><select size="1" name="top5warriorsonindex" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
	<option selected><?php echo "$top5warriorsonindex" ?></option>
	<option>yes</option>
	<option>no</option>
	</select></td></tr>
<tr>
<td><p class="text">Show the last 5 games played on the news page:</p></td>
<td><select size="1" name="last5gamesonindex" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
	<option selected><?php echo "$last5gamesonindex" ?></option>
	<option>yes</option>
	<option>no</option>
	</select></td></tr>
<tr>
<td><p class="text">Numbers of players to display per page:</p></td>
<td><input type="Text" name="numplayerspage1" value="<?php echo"$numplayerspage" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Numbers of pages link to display (playedgames.php): </p></td>
<td><input type="Text" name="maxgameslinkpage" value="<?php echo"$maxgameslinkpage" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Numbers of games to display per page:</p></td>
<td><input type="Text" name="numgamespage1" value="<?php echo"$numgamespage" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Number of players to display in stats:</p></td>
<td><input type="Text" name="statsnum1" value="<?php echo"$statsnum" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Approve players first when they signed up:</p></td>
<td><select size="1" name="approve1" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$approve" ?></option>
<option>yes</option>
<option>no</option>
</select></td>
</tr>
<tr>
<td><p class="text">Approve games before they are recorded:</p></td>
<td><select size="1" name="approvegames1" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option selected><?php echo "$approvegames" ?></option>
<option>yes</option>
<option>no</option>
</select></td>
</tr>
<tr>
<td><p class="text">Games to win/lose in a row to get hot/cold:</p></td>
<td><input type="Text" name="hotcoldnum1" value="<?php echo"$hotcoldnum" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Max. number of games a day:</p></td>
<td><input type="Text" name="gamesmaxday1" value="<?php echo"$gamesmaxday" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
<tr>
<td><p class="text">Max. number of games a day against same player :</p></td>
<td><input type="Text" name="gamesmaxdayplayer1" value="<?php echo"$gamesmaxdayplayer" ?>" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></td>
</tr>
</table>
<br>
<p class="text" align="left">Select pages' link order in the menu :</p>
<table width="800" border="0">
  <tr> 
    <td><div align="center">News/Index</div></td>
    <td><div align="center">Join</div></td>
    <td><div align="center">Member's area</div></td>
    <td><div align="center">Players</div></td>
    <td><div align="center">Standings</div></td>
    <td><div align="center">Report</div></td>
    <td><div align="center">Played games</div></td>
    <td><div align="center">Statistics</div></td>
    <td><div align="center">Added pages</div></td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="1" <?php if($pagename1 == 'index'){echo 'checked';} ?>>
      Position : 1</label> </td>
    <td><label> 
      <input type="radio" name="join" value="1" <?php if($pagename1 == 'join'){echo 'checked';} ?>>
      Position : 1</label> </td>
    <td><label> 
      <input type="radio" name="members" value="1" <?php if($pagename1 == 'members'){echo 'checked';} ?>>
      Position : 1</label> </td>
    <td><label> 
      <input type="radio" name="players" value="1" <?php if($pagename1 == 'players'){echo 'checked';} ?>>
      Position : 1</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="1" <?php if($pagename1 == 'standings'){echo 'checked';} ?>>
      Position : 1</label> </td>
    <td><label> 
      <input type="radio" name="report" value="1" <?php if($pagename1 == 'report'){echo 'checked';} ?>>
      Position : 1</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="1" <?php if($pagename1 == 'playedgames'){echo 'checked';} ?>>
      Position : 1</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="1" <?php if($pagename1 == 'statistics'){echo 'checked';} ?>>
      Position : 1</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="1" <?php if($pagename1 == 'pages'){echo 'checked';} ?>>
      Position : 1</label> </td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="2" <?php if($pagename2 == 'index'){echo 'checked';} ?>>
      Position : 2</label> </td>
    <td><label> 
      <input type="radio" name="join" value="2" <?php if($pagename2 == 'join'){echo 'checked';} ?>>
      Position : 2</label> </td>
    <td><label> 
      <input type="radio" name="members" value="2" <?php if($pagename2 == 'members'){echo 'checked';} ?>>
      Position : 2</label> </td>
    <td><label> 
      <input type="radio" name="players" value="2" <?php if($pagename2 == 'players'){echo 'checked';} ?>>
      Position : 2</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="2" <?php if($pagename2 == 'standings'){echo 'checked';} ?>>
      Position : 2</label> </td>
    <td><label> 
      <input type="radio" name="report" value="2" <?php if($pagename2 == 'report'){echo 'checked';} ?>>
      Position : 2</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="2" <?php if($pagename2 == 'playedgames'){echo 'checked';} ?>>
      Position : 2</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="2" <?php if($pagename2 == 'statistics'){echo 'checked';} ?>>
      Position : 2</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="2" <?php if($pagename2 == 'pages'){echo 'checked';} ?>>
      Position : 2</label> </td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="3" <?php if($pagename3 == 'index'){echo 'checked';} ?>>
      Position : 3</label> </td>
    <td><label> 
      <input type="radio" name="join" value="3" <?php if($pagename3 == 'join'){echo 'checked';} ?>>
      Position : 3</label> </td>
    <td><label> 
      <input type="radio" name="members" value="3" <?php if($pagename3 == 'members'){echo 'checked';} ?>>
      Position : 3</label> </td>
    <td><label> 
      <input type="radio" name="players" value="3" <?php if($pagename3 == 'players'){echo 'checked';} ?>>
      Position : 3</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="3" <?php if($pagename3 == 'standings'){echo 'checked';} ?>>
      Position : 3</label> </td>
    <td><label> 
      <input type="radio" name="report" value="3" <?php if($pagename3 == 'report'){echo 'checked';} ?>>
      Position : 3</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="3" <?php if($pagename3 == 'playedgames'){echo 'checked';} ?>>
      Position : 3</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="3" <?php if($pagename3 == 'statistics'){echo 'checked';} ?>>
      Position : 3</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="3" <?php if($pagename3 == 'pages'){echo 'checked';} ?>>
      Position : 3</label> </td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="4" <?php if($pagename4 == 'index'){echo 'checked';} ?>>
      Position : 4</label> </td>
    <td><label> 
      <input type="radio" name="join" value="4" <?php if($pagename4 == 'join'){echo 'checked';} ?>>
      Position : 4</label> </td>
    <td><label> 
      <input type="radio" name="members" value="4" <?php if($pagename4 == 'members'){echo 'checked';} ?>>
      Position : 4</label> </td>
    <td><label> 
      <input type="radio" name="players" value="4" <?php if($pagename4 == 'players'){echo 'checked';} ?>>
      Position : 4</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="4" <?php if($pagename4 == 'standings'){echo 'checked';} ?>>
      Position : 4</label> </td>
    <td><label> 
      <input type="radio" name="report" value="4" <?php if($pagename4 == 'report'){echo 'checked';} ?>>
      Position : 4</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="4" <?php if($pagename4 == 'playedgames'){echo 'checked';} ?>>
      Position : 4</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="4" <?php if($pagename4 == 'statistics'){echo 'checked';} ?>>
      Position : 4</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="4" <?php if($pagename4 == 'pages'){echo 'checked';} ?>>
      Position : 4</label> </td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="5" <?php if($pagename5 == 'index'){echo 'checked';} ?>>
      Position : 5</label> </td>
    <td><label> 
      <input type="radio" name="join" value="5" <?php if($pagename5 == 'join'){echo 'checked';} ?>>
      Position : 5</label> </td>
    <td><label> 
      <input type="radio" name="members" value="5" <?php if($pagename5 == 'members'){echo 'checked';} ?>>
      Position : 5</label> </td>
    <td><label> 
      <input type="radio" name="players" value="5" <?php if($pagename5 == 'players'){echo 'checked';} ?>>
      Position : 5</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="5" <?php if($pagename5 == 'standings'){echo 'checked';} ?>>
      Position : 5</label> </td>
    <td><label> 
      <input type="radio" name="report" value="5" <?php if($pagename5 == 'report'){echo 'checked';} ?>>
      Position : 5</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="5" <?php if($pagename5 == 'playedgames'){echo 'checked';} ?>>
      Position : 5</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="5" <?php if($pagename5 == 'statistics'){echo 'checked';} ?>>
      Position : 5</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="5" <?php if($pagename5 == 'pages'){echo 'checked';} ?>>
      Position : 5</label> </td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="6" <?php if($pagename6 == 'index'){echo 'checked';} ?>>
      Position : 6</label> </td>
    <td><label> 
      <input type="radio" name="join" value="6" <?php if($pagename6 == 'join'){echo 'checked';} ?>>
      Position : 6</label> </td>
    <td><label> 
      <input type="radio" name="members" value="6" <?php if($pagename6 == 'members'){echo 'checked';} ?>>
      Position : 6</label> </td>
    <td><label> 
      <input type="radio" name="players" value="6" <?php if($pagename6 == 'players'){echo 'checked';} ?>>
      Position : 6</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="6" <?php if($pagename6 == 'standings'){echo 'checked';} ?>>
      Position : 6</label> </td>
    <td><label> 
      <input type="radio" name="report" value="6" <?php if($pagename6 == 'report'){echo 'checked';} ?>>
      Position : 6</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="6" <?php if($pagename6 == 'playedgames'){echo 'checked';} ?>>
      Position : 6</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="6" <?php if($pagename6 == 'statistics'){echo 'checked';} ?>>
      Position : 6</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="6" <?php if($pagename6 == 'pages'){echo 'checked';} ?>>
      Position : 6</label> </td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="7" <?php if($pagename7 == 'index'){echo 'checked';} ?>>
      Position : 7</label> </td>
    <td><label> 
      <input type="radio" name="join" value="7" <?php if($pagename7 == 'join'){echo 'checked';} ?>>
      Position : 7</label> </td>
    <td><label> 
      <input type="radio" name="members" value="7" <?php if($pagename7 == 'members'){echo 'checked';} ?>>
      Position : 7</label> </td>
    <td><label> 
      <input type="radio" name="players" value="7" <?php if($pagename7 == 'players'){echo 'checked';} ?>>
      Position : 7</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="7" <?php if($pagename7 == 'standings'){echo 'checked';} ?>>
      Position : 7</label> </td>
    <td><label> 
      <input type="radio" name="report" value="7" <?php if($pagename7 == 'report'){echo 'checked';} ?>>
      Position : 7</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="7" <?php if($pagename7 == 'playedgames'){echo 'checked';} ?>>
      Position : 7</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="7" <?php if($pagename7 == 'statistics'){echo 'checked';} ?>>
      Position : 7</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="7" <?php if($pagename7 == 'pages'){echo 'checked';} ?>>
      Position : 7</label> </td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="8" <?php if($pagename8 == 'index'){echo 'checked';} ?>>
      Position : 8</label> </td>
    <td><label> 
      <input type="radio" name="join" value="8" <?php if($pagename8 == 'join'){echo 'checked';} ?>>
      Position : 8</label> </td>
    <td><label> 
      <input type="radio" name="members" value="8" <?php if($pagename8 == 'members'){echo 'checked';} ?>>
      Position : 8</label> </td>
    <td><label> 
      <input type="radio" name="players" value="8" <?php if($pagename8 == 'players'){echo 'checked';} ?>>
      Position : 8</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="8" <?php if($pagename8 == 'standings'){echo 'checked';} ?>>
      Position : 8</label> </td>
    <td><label> 
      <input type="radio" name="report" value="8" <?php if($pagename8 == 'report'){echo 'checked';} ?>>
      Position : 8</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="8" <?php if($pagename8 == 'playedgames'){echo 'checked';} ?>>
      Position : 8</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="8" <?php if($pagename8 == 'statistics'){echo 'checked';} ?>>
      Position : 8</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="8" <?php if($pagename8 == 'pages'){echo 'checked';} ?>>
      Position : 8</label> </td>
  </tr>
  <tr> 
    <td><label> 
      <input type="radio" name="index" value="9" <?php if($pagename9 == 'index'){echo 'checked';} ?>>
      Position : 9</label> </td>
    <td><label> 
      <input type="radio" name="join" value="9" <?php if($pagename9 == 'join'){echo 'checked';} ?>>
      Position : 9</label> </td>
    <td><label> 
      <input type="radio" name="members" value="9" <?php if($pagename9 == 'members'){echo 'checked';} ?>>
      Position : 9</label> </td>
    <td><label> 
      <input type="radio" name="players" value="9" <?php if($pagename9 == 'players'){echo 'checked';} ?>>
      Position : 9</label> </td>
    <td><label> 
      <input type="radio" name="standings" value="9" <?php if($pagename9 == 'standings'){echo 'checked';} ?>>
      Position : 9</label> </td>
    <td><label> 
      <input type="radio" name="report" value="9" <?php if($pagename9 == 'report'){echo 'checked';} ?>>
      Position : 9</label> </td>
    <td><label> 
      <input type="radio" name="playedgames" value="9" <?php if($pagename9 == 'playedgames'){echo 'checked';} ?>>
      Position : 9</label> </td>
    <td><label> 
      <input type="radio" name="statistics" value="9" <?php if($pagename9 == 'statistics'){echo 'checked';} ?>>
      Position : 9</label> </td>
    <td><label> 
      <input type="radio" name="pages" value="9" <?php if($pagename9 == 'pages'){echo 'checked';} ?>>
      Position : 9</label> </td>
  </tr>
</table>
<br>
<p><input type="Submit" name="submit" value="Enter information" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
</form>
<?php
}
?>
<?php
}
else {
echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
}
require('./../bottom.php');
?>