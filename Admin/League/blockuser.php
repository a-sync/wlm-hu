<?PHP
$page = "blockuser";
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
if (($number == "1") && ($adminpowerleagueblockuser == 'yes')) {
?>
<p class="header">Block player.</p>
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
if(! empty($_POST['name']))
	{
	$name = $_POST['name'];
	}
	else
		{
		$name = 'null';
		}
$sql = "UPDATE $playerstable SET approved = 'no' WHERE name='$name'";
$result = mysql_query($sql);
echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/blockuser.php'><font color='$color1'>Block another user</font>.</a></p>";
}
else{
?>
<form method="post" action="blockuser.php?submit=1">
<table border="0" cellpadding="0">
<tr>
<td><p class="text">Name:</p></td>
<td><select size="1" name="name" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<?php
$appyes = "yes";
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable WHERE approved='$appyes' ORDER BY $sortby";
$result=mysql_query($sql,$db);
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
<p><input type="Submit" name="submit" value="Block." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
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