<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "ip";
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
if (($number == "1") && ($adminpowerleagueip == 'yes')) {
?>
<p class="header">Ip-check.</p>
<?php
$count = 0;
$sql="SELECT * FROM $playerstable ORDER BY ip ASC, name ASC";
$result=mysql_query($sql);
$num = mysql_num_rows($result);
$cur = 1;
$ip3 = '';
$ip = '';
while ($num >= $cur) 
	{
	$row = mysql_fetch_array($result);
	$name = $row["name"];
	$ip2 = $row["ip"];
	if ($ip2 == $ip) 
		{
		$show = 'yes';
		$count++;
		}
		else 
			{
			$show = 'no';
			}
	$ip = $ip2;
?>
<?php
	if ($ip != "") 
		{
		if ($show == 'yes') 
			{
			if ($ip != $ip3) 
				{
				echo "<p class='text'><b>Same ip</b> ($ip):<br>";
				$sql2="SELECT * FROM $playerstable WHERE ip = '$ip'";
				$result2=mysql_query($sql2,$db);
				$num2 = mysql_num_rows($result2);
				$cur2 = 1;
				while ($num2 >= $cur2)
					{
					$row2 = mysql_fetch_array($result2);
					$name2 = $row2["name"];
					echo "$name2<br>";
					$cur2++;
					}
				$ip3 = $ip;
				echo"<br>";
				}
			}
		}
?>
<?php
		$cur++;
	}
?>
<?php
if ($count < 1) 
	{
?>
	<p class="text">There are no players with identical ip's.</p>
<?php
	}
}
else {
echo "<p class='header'>You are not allowed to view this part of the site.<br><br>
<p class='text'><a href='$directory/Admin/index.php'><font color='$color1'>Login.</font></a></p>";
}
require('./../../bottom.php');
?>