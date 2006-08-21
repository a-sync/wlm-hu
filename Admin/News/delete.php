<?PHP
$page = "view";
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
if (($number == "1") && ($adminpowernewsview == 'yes')) {
?>
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
if(! empty($_POST['edit']))
	{
	$edit = $_POST['edit'];
	}
	else
		{
		$edit = '1';
		}
$sql = "DELETE FROM $newstable WHERE news_id = '$edit'";
$result = mysql_query($sql);
echo "<p class='header'>News deleted.</p>";
}
else {
if(! empty($_GET['edit']))
	{
	$edit = $_GET['edit'];
	}
	else
		{
		$edit = '1';
		}
?>
<p class="header">Delete news.</p>
<form name="form1" method="post" action="delete.php?submit=1">
<table border="0" cellpadding="0" width="100%">
<tr>
<td><p class="text">Delete news?</p></td>
</tr>
</table>
<p class="text">
<input type='hidden' name='edit' value="<?php echo "$edit" ?>">
<input type="Submit" name="submit" value="Delete." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
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