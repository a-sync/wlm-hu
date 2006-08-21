<?php
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "standings";
require('variables.php');
require('variablesdb.php');
require('functions.php');
require('top.php');
?>
<p class="header">Standings.</p>
<table width="80%" border="1" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>" cellspacing="0" cellpadding="2">
<tr>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="left" nowrap><p class="text"><b>Player</b></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text"><b>Wins</b></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text"><b>Losses</b></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text"><b>Percentage</b></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text"><b>
<?php
if (($system == 'League point system') || ($system == 'Ra2 system ladder')) 
	{
	echo "Points";
	}
elseif (($system == "Elorating") || ($system == 'Peter Hendrix ladder'))
	{
	echo "Rating";
	}
?>
</b></p></td>
<td width="1" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">&nbsp;</p></td>
</tr>
<tr>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">&nbsp;</p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">&nbsp;</p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">&nbsp;</p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">&nbsp;</p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">&nbsp;</p></td>
<td width="1" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">&nbsp;</p></td>
</tr>
<?php
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
$sql = "SELECT * FROM $playerstable WHERE games >= 1 ORDER BY $sortby, games ASC";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) 
	{
	$row = mysql_fetch_array($result);
	$name = $row["name"];
	$mail = $row["mail"];
	$icq = $row["icq"]; 
	$aim = $row["aim"];
	$country = $row["country"];
	$approved = $row["approved"];
	if ($approved == "no") 
		{
		$namepage = "<font color='#FF0000'>$name</font>";
		}
		else 
			{
			$namepage = "<font color='$color1'>$name</font>";
			}
	$rating = $row["rating"];
	$ra2ladder = $row['ra2ladder'];
	$wins = $row["wins"];
	$losses = $row["losses"];
	$points = $row["points"];
	$games = $row["games"];
	if ($games <= 0) 
		{
		$percentage = 0.000;
		}
		else 
			{
			$percentage = $wins / $games;
			}	
	$streakwins = $row["streakwins"];
	$streaklosses = $row["streaklosses"];
	if ($streakwins >= $hotcoldnum) 
		{
		$picture = 'icons/streakplusplus.gif';
		$streak = $streakwins;
		}
		else if ($streaklosses >= $hotcoldnum) 
			{
			$picture = 'icons/streakminusminus.gif';
			$streak = -$streaklosses;
			}
			else if ($streakwins > 0) 
				{
				$picture = 'icons/streakplus.gif';
				$streak = $streakwins;
				}
				else if ($streaklosses > 0) 
					{
					$picture = 'icons/streakminus.gif';
					$streak = -$streaklosses;
					}
					else 
						{
						$picture = 'icons/streaknull.gif';
						$streak = 0;
						}
?>
<tr>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="left" nowrap>
<p class='text'><?php echo "$cur.<img src='$directory/flags/$country.bmp' alt='Streak: $streak' align='absmiddle' border='1'>&nbsp;<a href='$directory/profile.php?name=$name'>$namepage</a>&nbsp;</p>"?></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text"><?php echo "$wins" ?></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text"><?php echo "$losses" ?></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text"><?php printf("%.3f", $percentage); ?></p></td>
<td width="20%" bordercolor="<?php echo"$color7" ?>" align="center" nowrap><p class="text">
<?php
	if ($system == "League point system") 
		{
		echo $points;
		}
	elseif (($system == "Elorating") || ($system == 'Peter Hendrix ladder'))
		{
		echo $rating;
		}
	elseif ($system = 'Ra2 system ladder')
		{
		echo $ra2ladder;
		}
?>
</p></td>
<td width="1" bordercolor="<?php echo"$color7" ?>" align="left" nowrap>
<p class='text'><?php echo "<img src='$directory/$picture' alt='Streak: $streak' align='absmiddle' border='1'>"?></p></td>
</tr>
<?php
	$cur++;
	}
?>
</table>
<br>
<?php
require('bottom.php');
?>

