<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "deletegame";
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
$result=mysql_query($sql);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpowerleaguedeletegame == 'yes')) {
?>
<p class="header">Delete a game.</p>
<?php
if(! empty($_GET['delete']))
	{
	$delete = $_GET['delete'];
	$delety = 1;
	}
	else
		{
		$delete = 0;
		$delety = 0;
		}
if(! empty($_GET['startgames']))
	{
	$startgames = $_GET['startgames'];
	}
	else
		{
		$startgames = 0;
		}
if(! empty($_GET['finishgames']))
	{
	$finishgames = $_GET['finishgames'];
	}
	else
		{
		$finishgames = 30;
		}
if(! empty($_POST['selectname']))
	{
	$selectname = $_POST['selectname'];
	}
	else
		{
		$selectname = '';
		}
if ($delety) {
$sql="SELECT * FROM $gamestable WHERE game_id = '$delete'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$game_id = $row["game_id"];
$winnername = $row["winner"];
$losername = $row["loser"];
$date = $row["date"];
$sql="SELECT * FROM $playerstable WHERE name = '$winnername'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$ratingoldwinner = $row["rating"];
$sql="SELECT * FROM $playerstable WHERE name = '$losername'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$ratingoldloser = $row["rating"];
$constant = 32;
$rw1 = $ratingoldwinner - $ratingoldloser;
$rw2 = -$rw1/400;
$rw3 = pow(10,$rw2);
$rw4 = $rw3 + 1;
$rw5 = 1/$rw4;
$rw6 = 1 - $rw5;
$rw7 = $constant * $rw6;
$ratingdiff = round($rw7);
$sql = "UPDATE $playerstable SET wins = wins, losses= losses - 1, totalwins = totalwins, totallosses = totallosses - 1, points = points - $pointsloss, totalpoints = totalpoints - $pointsloss, games = games - 1, totalgames = totalgames - 1, streakwins = 0, streaklosses = streaklosses - 1, rating = rating + $ratingdiff WHERE name='$losername'";
$result = mysql_query($sql);
$sql = "UPDATE $playerstable SET wins = wins - 1, losses= losses, totalwins = totalwins - 1, totallosses= totallosses, points = points - $pointswin, totalpoints = totalpoints - $pointswin, games = games - 1, totalgames = totalgames - 1, streakwins = streakwins - 1, streaklosses = 0, rating = rating - $ratingdiff WHERE name='$winnername'";
$result = mysql_query($sql);
$sql = "DELETE FROM $gamestable WHERE winner = '$winnername' AND loser = '$losername' AND date = '$date' AND game_id = '$delete'";
$result = mysql_query($sql);
echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/deletegame.php?startgames=0&finishgames=$numgamespage'><font color='$color1'>Delete another game</font></a>.</p>";
}
else {
?>
<form method="post" action="<?php echo"$directory"?>/Admin/League/deletegame.php">
<p class="text"><a href="<?php echo"$directory"?>/Admin/League/deletegame.php"><font color="<?php echo"$color1"?>">View all games</font></a> | 
View games from: <select size="1" name="selectname" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<option><?php echo"$selectname" ?></option>
<?php
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable ORDER BY $sortby";
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
</select> <input type="Submit" name="submit2" value="View." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
</form>
<?php
$sortby = "game_id DESC";
$sql="SELECT * FROM $gamestable ORDER BY $sortby LIMIT $startgames, $finishgames";
$result=mysql_query($sql);
$num = mysql_num_rows($result);
if ($num > 0) {
$sortby = "game_id DESC";
$sql="SELECT * FROM $gamestable ORDER BY $sortby";
$result=mysql_query($sql);
$yo = mysql_num_rows($result);
$number = 0;
$link = 1;
$finishnumber = $numgamespage;
$startnext = $startgames + $numgamespage;
$startprevious = $startgames - $numgamespage;
echo "<p class='text'>Go to page:";
if ($startprevious >= 0) {
echo " | <a href='$directory/Admin/League/deletegame.php?startgames=$startprevious&finishgames=$finishnumber'><font color='$color1'><</font></a> |";
}
while ($number < $yo) {
echo " <a href='$directory/Admin/League/deletegame.php?startgames=$number&finishgames=$finishnumber'><font color='$color1'>$link</font></a> | ";
$number = $number + $numgamespage;
$link = $link + 1;
}
if ($startnext < $yo - $numgamespage) {
echo "<a href='$directory/Admin/League/deletegame.php?startgames=$startnext&finishgames=$finishnumber'><font color='$color1'>></font></a> |";
}
?>
<br><br>
<table border="1" cellspacing="1" cellpadding="2" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>">
<tr>
<td align='center' bordercolor='<?php echo"$color7" ?>'><img border='1' src='<?php echo"$directory" ?>/icons/delete.gif' width='18' height='18' align='middle'></td>
<td bordercolor='<?php echo"$color7" ?>'><p class='text'><b>Game</b></p></td>
</tr>
<?php
$sortby = "game_id DESC";
if($selectname)
	{
	$sql="SELECT * FROM $gamestable WHERE winner = '$selectname' OR loser = '$selectname'ORDER BY $sortby LIMIT $startgames, $finishgames";
	}
	else
		{
		$sql="SELECT * FROM $gamestable ORDER BY $sortby LIMIT $startgames, $finishgames";
		}
$result=mysql_query($sql);
$num = mysql_num_rows($result);
$cur = 1;
while ($num >= $cur) {
$row = mysql_fetch_array($result);
$game_id = $row["game_id"];
$winner = $row["winner"];
$loser = $row["loser"];
$date = $row["date"];
?>
<?php echo"
<tr>
<td align='center' bordercolor='$color7'><a href='deletegame.php?delete=$game_id'><font color='$color1'>Delete.</a></td>
<td bordercolor='$color7'><p class='text'>$winner - $loser ($date)</p></td>
</tr>" ?>
<?php
$cur++;
} 
?>
</table>
<br>
<?php
}
else {
echo"<p class='text'>No games played yet.</p>";
}
}
}
else {
echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
}
require('./../../bottom.php');
?>