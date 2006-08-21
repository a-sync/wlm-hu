<?php
if($idcontrol == 'sessions')
	{	
	session_start();
	}
?>
<html>
<head>
<meta name="keywords" content="WLm HU 1.0">
<title><?php echo "$titlebar" ?></title>
<script type="text/javascript" language="javascript">
function ahref() {
                strSelection = document.selection.createRange().text
		if (strSelection == "") document.form1.news.focus()
		strHref = prompt("URL:","http://")
		if (strHref == null) return;
		strText = prompt("Text:","")
		if (strText == null) return;
		document.selection.createRange().text = "<a href='" + strHref + "'  target='_blank'><font color='<?php echo"$color1" ?>'>" + strText + "</font></a>"
		return;
	}


	function picture(from) {
	   document.form1.news.focus()
	  stPic = prompt("URL:","http://")
	   	 if (stPic == null) return;
	  strBorder = prompt("Border:","0")
		 if (strBorder == null) return;
		 document.selection.createRange().text = "<img border=\"" + strBorder + "\" align=\"absmiddle\" src=\"" + stPic + "\">"
	   return;
	   }

	function underlineThis(from) {
	 document.form1.news.focus()
		stQuotey = prompt("Text:","")
	 	 if (stQuotey == null) return;
		 document.selection.createRange().text = "<u>" + stQuotey + "</u>"
	  return;
	  }

	function italicThis(from) {
	 document.form1.news.focus()
		stQuotey = prompt("Text:","")
	 	 if (stQuotey == null) return;
		 document.selection.createRange().text = "<i>" + stQuotey + "</i>"
	  return;
	  }
	  
	function boldThis(from) {
	 document.form1.news.focus()
		stQuotey = prompt("Text:","")
	 	 if (stQuotey == null) return;
		 document.selection.createRange().text = "<b>" + stQuotey + "</b>"
	  return;
	  }
	  
	function MM_openBrWindow(theURL,winName,features) { 
      window.open(theURL,winName,features);
	  }
	  
	function MM_callJS(jsStr) { 
 	  return eval(jsStr)
	  }
	  
</script>
<style type=text/css> 
<!--
body { color: <?php echo"$color1" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?>px; }
a:link { color: <?php echo"$color1" ?>; font-weight: <?php echo"$fontweight" ?>; text-decoration: underline}
a:visited { color: <?php echo"$color1" ?>; font-weight: <?php echo"$fontweight" ?>; text-decoration: underline}
a:hover { color: <?php echo"$color4" ?>; text-decoration: overline underline; font-weight: <?php echo"$fontweight" ?>}
a:active { color: <?php echo"$color4" ?>; text-decoration: overline underline; font-weight: <?php echo"$fontweight" ?>}
.menu a:link { color: <?php echo"$color2" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?>px; font-weight: <?php echo"$fontweight" ?>; text-decoration: underline}
.menu a:visited { color: <?php echo"$color2" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?>px; font-weight: <?php echo"$fontweight" ?>; text-decoration: underline}
.menu a:hover { color: <?php echo"$color3" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?>px; text-decoration: overline; font-weight: <?php echo"$fontweight" ?>}
.menu a:active { color: <?php echo"$color3" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?>px; text-decoration: overline underline; font-weight: <?php echo"$fontweight" ?>}
.header a:link { color: <?php echo"$color1" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$header" ?>px; font-weight: bold; text-decoration: underline}
.header a:visited { color: <?php echo"$color1" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$header" ?>px; font-weight: bold; text-decoration: underline}
.header a:hover { color: <?php echo"$color4" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$header" ?>px; font-weight: bold; text-decoration: none}
.header a:active { color: <?php echo"$color4" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$header" ?>px; font-weight: bold; text-decoration: overline underline}
.text { color: <?php echo"$color1" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?>px; font-weight: <?php echo"$fontweight" ?>; text-decoration: none}
.textalt { color: <?php echo"$color2" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$fontsize" ?>px; font-weight: <?php echo"$fontweight" ?>; text-decoration: none}
.header { color: <?php echo"$color1" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$header" ?>px; font-weight: bold; text-decoration: none}
.headeralt { color: <?php echo"$color2" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$header" ?>px; font-weight: bold; text-decoration: none}
.tops { color: <?php echo"$color2" ?>; font-family: <?php echo"$font" ?>; font-size: <?php echo"$tops" ?>px; font-weight: bold; text-decoration: none}
.dots { color: <?php echo"$color2" ?>; font-family: arial-black; font-size: <?php echo"$fontsize" ?>px; font-weight: bolder; text-decoration: none}
-->
</style>
</head>
<body bgcolor="<?php echo"$color7" ?>" topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0">
<div align="center">
<table border="0" cellpadding="2" cellspacing="0" width="100%" height="100%">
<tr>
<td width="100%" height="60" bgcolor="<?php echo"$color6" ?>" valign="bottom">
<p align="left"><font color="<?php echo"$color2" ?>" size="6" face="<?php echo"$font" ?>"><?php echo "$leaguename" ?></font>
</td>
</tr>
<tr>
<td width="100%" height="10" bgcolor="<?php echo"$color3" ?>"></td>
</tr>
<tr>
<td width="100%" height="5" bgcolor="<?php echo"$color4"?>"></td>
</tr>
<tr>
<td width="100%" height="1" bgcolor="<?php echo"$color6" ?>">
<?php
require('menu.php');
?>
</td>
</tr>
<tr>
<td width="100%" height="5" bgcolor="<?php echo"$color3" ?>"></td>
</tr>
<tr>
<td width="100%" height="100%" bgcolor="<?php echo"$color7" ?>" valign="top">
<div align="center">
<table border="0" cellpadding="5" cellspacing="0" width="100%">
<tr>
<td width="100%" valign="top">