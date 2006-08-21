<?php
//new showgameinfo.php made by n17r0
//should auto adapt it's style to your webleague design settings
//if not then ... you probably edit the layout and made some big change in color settings :P 
$gameid = $_GET['id'];
?>
<html>
<head>
<title>GameID <?php echo $gameid ?> - Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
<!--
td {color: <?php echo"$color1" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?> px; font-weight: <?php echo"$fontweight" ?>; text-decoration: none}
a 	     { color: <?php echo"$color1" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?> px; font-weight: <?php echo"$fontweight" ?>; text-decoration: none}
a:link       { color: <?php echo"$color2" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?> px; font-weight: <?php echo"$fontweight" ?>; text-decoration: underline}
a:visited    { color: <?php echo"$color2" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?> px; font-weight: <?php echo"$fontweight" ?>; text-decoration: underline}
a:hover      { color: <?php echo"$color3" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?> px; text-decoration: underline; font-weight: <?php echo"$fontweight" ?>}

-->
</style>

</head>
<?php
require('variables.php');
require('variablesdb.php');
require('functions.php');
$query = "SELECT * FROM $gamestable WHERE game_id = '$gameid'";
$queryresult = mysql_query($query);
$row = mysql_fetch_array($queryresult);
$winner = $row['winner'];
$loser = $row['loser'];
$date = $row['date'];
$winnerresult = $row['winnerresult'];
$loserresult = $row['loserresult'];
$comment = SmileyConvert($row['comment'],$directory);
$relatedreplay = $row['relatedreplay'];
$recorded = $row['recorded'];
?>

<body bgcolor="#4A739E" text="#FFFFFF">
<table border="0" width="80%" height="100%" bgcolor="<?php echo"$color6" ?>" cellpadding="5" cellspacing="2" align="center">
<tr>
    <td height="20" colspan="2" bgcolor="<?php echo"$color3" ?>" ><div align="center"><strong>Game's 
        id</strong> : <?php echo '<font  size="3" color="#FF9900">'.$gameid.'</font>' ?></div></td>
  </tr>
        <tr> 
    <td align="center" width="50%">Winner:</td>
        <td align="center">Loser:</td>
      </tr>
    <tr> 
        <td align="center" bgcolor="<?php echo"$color3" ?>" ><?php echo "($winnerresult) <strong>$winner</strong>" ?> </td>
    
    <td align="center" bgcolor="<?php echo"$color3" ?>" ><?php echo "<strong>$loser</strong> ($loserresult)" ?></td>
    </tr>

    <tr> 
    <td align="center" colspan="2">Date of the game: <?php echo "$date" ?></td>
      </tr>

    <tr> 

    <td colspan="2" align="center" bgcolor="<?php echo"$color3" ?>" >Replay:
<?php 
if(! empty($relatedreplay))
	{
?>
        <a href="
<?php
	echo $directory.'/replays/'.$relatedreplay;
?>
	"><img src="icons/replay.gif" width="16" height="16" border="0"></a> 
<?php
	}
	else
		{
		echo 'No replay uploaded';
		}
?>
      
      </td>
      </tr>

    <tr> 
        <td colspan="2" align="center">Comments: </td>
      </tr>

   <tr> 
    <td height="69" colspan="2" bgcolor="<?php echo"$color3" ?>" align="center"><?php echo "$comment" ?></td>
    </tr>

  </table>
</body>
</html>
