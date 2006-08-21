<?PHP
$page = "deleteuser";
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
if (($number == "1") && ($adminpowerleaguedeleteuser == 'yes')) {
?>
<p class="header">Delete user.</p>
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
if(! empty($_POST['deletename']))
	{
	$deletename = $_POST['deletename'];
	}
	else
		{
		$deletename = 'null';
		}
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable WHERE name = '$deletename' ORDER BY $sortby";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$rank = $row["rank"];
if ($rank > 0) {
$sql = "UPDATE $playerstable SET rank = rank - 1 WHERE rank > $rank";
$result = mysql_query($sql);
}
$sql = "DELETE FROM $playerstable WHERE name='$deletename'";
$result = mysql_query($sql);
echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/deleteuser.php'><font color='$color1'>Delete another user</font></a>.</p>";
} else{
?>
<form method="post" action="deleteuser.php?submit=1">
<table border="0" cellpadding="0">
<tr>
<td><p class="text">Name:</p></td>
<td><select size="1" name="deletename" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
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
</select></td>
</tr>
</table>
</center>
<p><input type="Submit" name="submit" value="Delete." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
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