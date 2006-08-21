<?php
require('../variables.php');
require('../variablesdb.php');
?>
<?php
if($allowpswdmail == 'yes')
	{
if(! empty($_GET['submit']))
	{
	$submit = $_GET['submit'];
	}
	else
		{
		$submit = '0';
		}
if($submit)
	{
	if(! empty($_POST['editname']))
		{
		$editname = $_POST['editname'];
		}
		else
			{
			die('<p class="text">You must give your name !</p><p class="text"><a href="forgotpswd.php">Click here to reload the page</a></p>');
			}
	if(! empty($_POST['editmail']))
		{
		$editmail = $_POST['editmail'];
		}
		else
			{
			die('<p class="text">You must give your e-mail !</p><p class="text"><a href="forgotpswd.php">Click here to reload the page</a></p>');
			}
	$query = "SELECT * FROM $playerstable WHERE name='$editname' AND mail='$editmail'";
	$queryresult = mysql_query($query);
	$row = mysql_fetch_array($queryresult) 
		or die('<p class="text">Your account doesn\'t exist ! Check your e-mail.</p><p class="text"><a href="forgotpswd.php">Click here to reload the page</a></p>');
	$message =  "You have asked your account password from ".$leaguename.".\n
				--------------------------------------------------------\n
				\n
				Here are your info :\n
				\n
				- Name : ".$row['name']."\n
				- Password : ".$row['mail']."\n
				\n
				--------------------------------------------------------\n
				Your ".$leaguename." administrator.\n";
	$subject = "Your ".$leaguename." password !";
	$head = "From:".$adminmail."\r\nReply-To:".$adminmail."";
	$sendmail = @mail ($row['mail'],$subject,$message,$head);
	if($sendmail)
		{
		echo '<p class="text">The mail with your password has been sent to your mailbox.</p>';
		}
		else
			{
			echo '<p class="text">Unable to send the mail. <br>Please contact your league administrator at : '.$adminmail.' for more help.</p>';
			}
	}
	else
		{
?>
<form method="post" action="forgotpswd.php?submit=1">
<table width="404" border="0" cellpadding="0" cellspacing="0" bordercolor="#33CC33">
  <tr> 
    <td width="9" height="14"></td>
    <td width="70"></td>
    <td width="29"></td>
    <td width="4"></td>
    <td width="126"></td>
    <td width="65"></td>
    <td width="23"></td>
  </tr>
  <tr> 
    <td height="25"></td>
    <td colspan="2" valign="top"><font size="+2">Your name :</font></td>
    <td>&nbsp;</td>
    <td colspan="2" valign="top"><div align="right"><select name="editname" size="1" class="text" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>">
<?php
//on affiche tout les noms de joueurs non bloqués/autorisés dans la liste
$sortby = "name ASC";
$sql="SELECT * FROM $playerstable WHERE approved = 'yes' ORDER BY $sortby";
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
</select></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="23"></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr> 
    <td height="27"></td>
    <td colspan="2" valign="top"><font size="+2">Your e-mail :</font></td>
    <td></td>
    <td colspan="2" valign="top"> <div align="right">
        <input type="text" value="The mail you gave in your profile" size="30" name="editmail" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
      </div></td>
    <td></td>
  </tr>
  <tr> 
    <td height="18"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr> 
    <td height="22"></td>
    <td></td>
    <td colspan="3" valign="top"><div align="center">
        <input type="submit" name="Submit" value="Get back your password" style="background-color: <?php echo"$color5" ?>; border: 1 solid <?php echo"$color1" ?>" class="text">
      </div></td>
    <td></td>
    <td></td>
  </tr>
  <tr> 
    <td height="10"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<?php
		}
	}
	else
		{
		echo '<p class="text">You can\'t access this page.</p>';
		}
?>
