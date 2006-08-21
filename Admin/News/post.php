<?PHP
$page = "post";
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
if (($number == "1") && ($adminpowernewspost == 'yes')) {
if (isset($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = 0;
		}
if ($submit) {
if (! empty($_POST['date']))
	{
	$date = $_POST['date'];
	}
	else
		{
		$date = date('d/m/Y');
		}
if (! empty($_POST['titlenews']))
	{
	$titlenews = $_POST['titlenews'];
	}
	else
		{
		$titlenews = 'Title';
		}
if (! empty($_POST['news']))
	{
	$news = $_POST['news'];
	}
	else
		{
		$news = 'Insert your text here.';
		}
$sql = "INSERT INTO $newstable (date, title, news) VALUES ('$date', '$titlenews', '$news')";
$result = mysql_query($sql);
echo "<p class='header'>News posted.</p>";
}
else {
?>
<p class="header">Post news.</p>
<form name="form1" method="post" action="post.php?submit=1">
<table border="0" cellpadding="0" width="100%">
<tr>
<td><p class="text">Date:</p></td>
</tr>
<tr>
<td><input type="Text" size="45" name="date" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br></td>
</tr>
<tr>
<td><p class="text">Title:</p></td>
</tr>
<tr>
<td><input type="Text" size="45" name="titlenews" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br></td>
</tr>
<tr>
<td><p class="text">Text:</p></td>
</tr>
<tr>
<td valign="top"><textarea name="news" cols="45" rows="10" wrap="VIRTUAL" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"></textarea></td>
</td>
</tr>
<tr><td>
<p class="text"><br>
<table border="1" cellspacing="1" cellpadding="2" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>">
<tr>
<td bordercolor="<?php echo"$color7" ?>"><a onclick="picture()"><u>picture</u></a>  
</td>
<td bordercolor="<?php echo"$color7" ?>"><a onclick="ahref()"><u>link</u></a>
</td>
<td bordercolor="<?php echo"$color7" ?>"><a onclick="italicThis()"><u><i>italic</i></u></a>
</td>
<td bordercolor="<?php echo"$color7"?>"><a onclick="underlineThis()"><u>underline</u></a>
</td>
<td bordercolor="<?php echo"$color7" ?>"><a onclick="boldThis()"><u><b>bold<b></u></a>
</td>
</tr>
</table>
</td></tr>
<tr><td height="5"></td></tr>
<tr><td>
<table border="1" cellspacing="1" cellpadding="2" bgcolor="<?php echo"$color5" ?>" bordercolor="<?php echo"$color1" ?>">
<tr>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/smile.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/sad.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/biggrin.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/cry.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/none.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/mad.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/rolleyes.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/laugh.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/bigrazz.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/dead.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/wink.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/bigeek.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/cool.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/no.gif" width="15" height="15"></td>
<td align="center" bordercolor="<?php echo"$color7" ?>"><img border="0" src="<?php echo "$directory" ?>/smileys/yes.gif" width="15" height="15"></td>
</tr>
<tr>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:)</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:(</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:d</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:'(</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:s</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:@</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:r</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:h</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:p</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:x</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">;)</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:o</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">:b</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">(n)</td>
<td align="center" bordercolor="<?php echo"$color7" ?>" class="text">(y)</td>
</tr>
</table>
</td></tr>
<tr><td height="5"></td></tr>
</table>
<p class="text"><input type="Submit" name="submit" value="Post." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
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