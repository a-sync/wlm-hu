<?PHP
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$page = "view";
require('./../variables.php');
require('./../variablesdb.php');
require('./../functions.php');
require('./../top.php');
?>
<?php
$var = 'username';
$username = GetInfo($idcontrol,$var);
$var = 'password';
$password = GetInfo($idcontrol,$var);
$sql="SELECT * FROM $admintable WHERE name = '$username' AND password = '$password'";
$result=mysql_query($sql,$db);
$number = mysql_num_rows($result);
if (($number == "1") && ($adminpowerpageview == 'yes')) {
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
if(! empty($_POST['edit']))
	{
	$edit = $_POST['edit'];
	}
	elseif(! empty($_GET['edit']))
		{
		$edit = $_GET['edit'];
		}
		else
			{
			$edit = '1';
			}
if ($submit == 1) {
if(! empty($_POST['titlepage']))
	{
	$titlepage = $_POST['titlepage'];
	}
	else
		{
		$titlepage = 'Titre';
		}
if(! empty($_POST['news']))
	{
	$news = $_POST['news'];
	}
	else
		{
		$news = 'Enter your text here.';
		}	
$sql = "UPDATE $pagestable SET title = '$titlepage', page = '$news' WHERE page_id = '$edit'";
$result = mysql_query($sql);
echo "<p class='header'>Page edited.</p>";
}
else {
$sortby = "page_id DESC";
$start = "0";
$finish = "1";
$sql="SELECT * FROM $pagestable WHERE page_id = '$edit' ORDER BY $sortby LIMIT $start, $finish";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$contentold = $row["page"];
$titleold = $row["title"];
?>
<p class="header">Edit page.</p>
<form name="form1" method="post" action="edit.php?submit=1">
<table border="0" cellpadding="0" width="100%">
<tr>
<td><p class="text">Title:</p></td>
</tr>
<tr>
<td><input type="Text" size="45" name="titlepage" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text" value="<?php echo "$titleold" ?>"></td>
</tr>
<tr>
<td><p class="text">Text:</p></td>
</tr>
<tr>
<td><textarea name="news" cols="45" rows="10" wrap="VIRTUAL" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><?php echo "$contentold" ?></textarea></td>
</td>
</tr>
<tr>
<td>
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
</table>
<p class="text">
<input type='hidden' name='edit' value="<?php echo "$edit" ?>">
<input type="Submit" name="submit" value="Edit." style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text"><br>
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
require('./../bottom.php');
?>