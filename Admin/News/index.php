<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "news";
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
$var = 'adminpowernews';
$adminpowernews = GetInfo($idcontrol,$var);
$sql="SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
$result=mysql_query($sql,$db);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpowernews == 'yes')) {
?>
<p class="header">News management.</p>
<p class="text">This is where you can post, view, edit and delete news.</p>
<?php
}
else {
echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
}
require('./../../bottom.php');
?>

