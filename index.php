<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "index";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
?>
<table width="100%" border="0">
  <tr> 
    <td width="70%" height="456"> 
      <!-- big block content -->
      <?php
if (! empty($_GET['readnews']))
	{
	$readnews = $_GET['readnews'];
	$readnewsy = 1;
	}
	else
		{
		$readnewsy =0;
		}
if ($readnewsy) 
{
$sortby = "news_id DESC";
$start = "0";
$finish = $newsitems;
$sql="SELECT * FROM $newstable WHERE news_id = '$readnews' ORDER BY $sortby LIMIT $start, $finish";
$result=mysql_query($sql,$db);
$row = mysql_fetch_array($result);
$news = $row["news"];
$news = nl2br($news);
$news = SmileyConvert($news,$directory);
$date = $row["date"];
$title = $row["title"];
?>
<p class="header"><?php echo"$date - $title" ?></p>
<p class="text"><?php echo"$news" ?></p>
<hr size="1" color="<?php echo"$color1" ?>"><br>
<?php
}
else 
{
$sortby = "news_id DESC";
$start = "0";
$finish = $newsitems;
$sql="SELECT * FROM $newstable ORDER BY $sortby LIMIT $start, $finish";
$result=mysql_query($sql,$db);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) 
{
	$row = mysql_fetch_array($result);
	$news = $row["news"];
	$news = nl2br($news);
	$news = SmileyConvert($news,$directory);
	$date = $row["date"];
	$title = $row["title"];
?>
	<p class="header"><?php echo"$date - $title" ?></p>
	<p class="text"><?php echo"$news" ?></p>
	<hr size="1" color="<?php echo"$color1" ?>"><br>
<?php
	$cur++;
}
?>

<?php
//hány hír van összesen
$lek="SELECT * FROM $newstable ORDER BY news_id DESC LIMIT 0, 100000";
$ered=mysql_query($lek,$db);
$osszhir = mysql_num_rows($ered);
if ($osszhir > $newsitems)//kell e egyéb hírek listája
{
?>
<p class="header"><u>Egyéb hírek:</u></p>
<p class'text'>
<?php
$sortby = "news_id DESC";
$start = $newsitems;//csak nem kint lévõ hírek legyenek listázva
//$start = "0";
$finish = "100000";
$sql="SELECT * FROM $newstable ORDER BY $sortby LIMIT $start, $finish";
$result=mysql_query($sql);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) 
{
	$row = mysql_fetch_array($result);
	$date = $row["date"];
	$title = $row["title"];
	$readnews = $row["news_id"];
?>
	<?php echo"&nbsp;&nbsp;<font class='header'>$date&nbsp;-&nbsp;</font><font class='header'><a href='index.php?readnews=$readnews'>$title</a></font><br>" ?>
	<?php
	$cur++;
}
}
}
?>	

	</td>
    <td width="270" valign="top"><br>
<?php
if($last5gamesonindex == 'yes')
	{
?>
	  <table width="272" border="0" cellpadding="1" cellspacing="0" bordercolor="<?php echo"$color6" ?>">
        <tr> 
          <td width="268" colspan="7" bgcolor="<?php echo"$color6" ?>"> 

            <center><font class="tops"><b><u>Utolsó 5 küzdelem</u></b></font></center>
            </td></tr>
            <tr><td bgcolor="<?php echo"$color6" ?>" width="1"></td><td bgcolor="<?php echo"$color6" ?>" align="left"><font class="headeralt"><b>Nyertes</b><?php if($reportresult == 'yes'){echo "&nbsp;<i>(pont)</i>";} ?></font></td><td bgcolor="<?php echo"$color6" ?>" align=center></td><td bgcolor="<?php echo"$color6" ?>" align="right"><font class="headeralt"><b>Vesztes</b><?php if($reportresult == 'yes'){echo "&nbsp;<i>(pont)</i>";} ?></font></td><td bgcolor="<?php echo"$color6" ?>" width="1"></td></tr>

<?php
//last 5 games
$sql="SELECT * FROM $gamestable ORDER BY game_id DESC LIMIT 0, 5";
$result = mysql_query($sql);
$osszjat = mysql_num_rows($result);
if ($osszjat > 5){$osszjat = 5;}
$compteur = 1;
while ($osszjat >= $compteur) 
	{
	$row = mysql_fetch_array($result);
	echo "<tr><td bgcolor=$color6 width=1></td><td bgcolor=$color5 align=left><font class=text>".$row['winner']."</font>";
	if($reportresult == 'yes'){echo "&nbsp;<font class=text><b>(</b><i>".$row['winnerresult']."</i><b>)</b></font></td>";}
	echo "<td bgcolor=$color6 align=center><font onClick=\"MM_callJS('MM_openBrWindow(\'$directory/showgameinfo.php?id=".$row['game_id']."\',\'\',\'width=477,height=363\')')\"><a href=''><font class='textalt'><img src='$directory/icons/jatekinfo.gif' alt='ID:".$row['game_id']."' align='absmiddle' border='0'></font></a></font></td><td bgcolor=$color5 align=right><font class=text>".$row['loser']."</font>";
	if($reportresult == 'yes'){echo "&nbsp;<font class=text><b>(</b><i>".$row['loserresult']."</i><b>)</b></font></td><td bgcolor=$color6 width=1></td></tr>";}
	$compteur++;
	}
?>
			<tr><td bgcolor="<?php echo"$color6" ?>" height="1" colspan="7"></td></tr>
          </td>
        </tr>
      </table>
      <br>
<?php
	}

if($top5warriorsonindex == 'yes')
	{
?>
	  <table width="272" border="0" cellpadding="1" cellspacing="0" bordercolor="<?php echo"$color6" ?>">
        <tr> 
          <td width="268" colspan="4" bgcolor="<?php echo"$color6" ?>"> 
            <center><font class="tops"><b><u>Legjobb 5 játékos</u></b></font></center>
            </td></tr>
            <tr><td bgcolor="<?php echo"$color6" ?>"></td><td bgcolor="<?php echo"$color6" ?>" align="center"><font class="headeralt"><b>Játékos</b>&nbsp;<b>(</b><i>gyõzelem</i>&nbsp;/&nbsp;<i>vereség</i><b>)</b></font></td><td bgcolor="<?php echo"$color6" ?>"></td><td bgcolor="<?php echo"$color6" ?>" width="1"></td></tr>

<?php
//top 5 warriors
if ($system == "Elorating")
	{
	$sortby = "rating DESC, games DESC";
	}
else if ($system == "League point system") 
	{
	$sortby = "points DESC";
	}
else if ($system == "Peter Hendrix ladder") 
	{
	$sortby = "rank ASC";
	}
else if ($system == "Ra2 system ladder") 
	{
	$sortby = "ra2ladder DESC";
	}
$sql = "SELECT * FROM $playerstable WHERE games >= 1 ORDER BY $sortby, games ASC LIMIT 0, 5";
$result = mysql_query($sql);
$osszkuz = mysql_num_rows($result);
if ($osszkuz > 5){$osszkuz = 5;}
$compteur = 1;
while ($osszkuz >= $compteur)  
	{
	$row = mysql_fetch_array($result);
//	if(!empty($row["country"]))
//		{
//		$country = $row["country"];
//		}
//		else
//			{
//			$country = 'No country';
//			}
	if ($row['streakwins'] > 0) 
			{
			$streak = $row['streakwins'];
				}
				else if ($row['streaklosses'] > 0) 
					{
					$streak = -$row['streaklosses'];
					}
					else 
						{
						$streak = 0;
						}
	echo "<tr><td bgcolor=$color6 align=center><font class=headeralt><b>".$compteur.".</b></font></td><td bgcolor=$color5 align=center><font class=text>".$row['name']."&nbsp;<b>(</b><i>".$row['wins']."</i>&nbsp;/&nbsp;<i>".$row['losses']."</i><b>)</b></font></td><td bgcolor=$color5 align=right><font onClick=\"MM_callJS('MM_openBrWindow(\'$directory/profile.php?name=".$row['name']."\',\'\',\'\')')\"><a href=''><font class=text><img src='$directory/icons/jatekosinfo.gif' alt='ID:".$row['player_id']."' align='absmiddle' border='0'></font></a></font></td><td bgcolor=$color6 width=1></td></tr>";
	$compteur++;
	}
?>
			<tr><td bgcolor="<?php echo"$color6" ?>" height="1" colspan="4"></td></tr>
          </td>
        </tr>
      </table>
<?php
	}
?>
    </td>
  </tr>
</table>

<br>
<?php
require('bottom.php');
?>

