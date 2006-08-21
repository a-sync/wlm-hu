<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "approve";
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
if (($number == "1") && ($adminpowerleagueapprove == 'yes')) {
?>
<p class="header">Approve.</p>
<?php
$date = date("M d, Y");
if (isset($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}
if ($submit) {
if(! empty($_POST['name']));
	{
	$name = $_POST['name'];
	}
//	else
//		{
//		$name = 'null';
//		}
$sql = "UPDATE $playerstable SET approved = 'yes' WHERE name='$name'";
$result = mysql_query($sql);
echo "<p class='text'>Thank you! Information entered.<br><br><a href='$directory/Admin/League/adduser.php'><font color='$color1'>Add another player</font>.</a></p>";
}
else{
$appno = "no";
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable WHERE approved='$appno' ORDER BY $sortby";
$result=mysql_query($sql);
$num = mysql_num_rows($result);
if ($num > 0) {
?>
<form method="post" action="adduser.php?submit=1">
<table border="0" cellpadding="0">
<tr>
<td><p class="text">Name:</p></td>
<td><select size="1" name="name" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
<?php
$appno = "no";
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable WHERE approved='$appno' ORDER BY $sortby";
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
<p><input type="Submit" name="submit" value="Approve." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
</form>
<?php
}
else {
echo"<p class='text'>There are no blocked or unapproved players.</p>";
}
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

