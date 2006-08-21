<?PHP
$page = "resetseason";
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
$result=mysql_query($sql,$db);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpowerleagueresetseason == 'yes')) {
?>
<p class="header">Reset season.</p>
<?php
if (isset($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}
if ($submit) {
$sql = "UPDATE $playerstable SET wins = 0, losses = 0 , points = 0,  games = 0, streakwins = 0, streaklosses = 0, rank = 0, rating = 1500, ra2ladder = 0";
$result = mysql_query($sql);
$sql = "DELETE FROM $gamestable WHERE game_id > 0";
$result = mysql_query($sql);
echo "<p class='text'>Thank you! Information entered.</p>";
} else{
?>
<form method="post" action="resetseason.php?submit=1">
<p>  <input type="Submit" name="submit" value="Reset." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
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
require('./../../bottom.php');
?>