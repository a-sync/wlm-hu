<p class="textalt"><font class="dots">.:</font>&nbsp;|
<?php
list($pageinfo1, $pageinfo2, $pageinfo3, $pageinfo4, $pageinfo5, $pageinfo6, $pageinfo7, $pageinfo8, $pageinfo9, $pageinfo10) = explode("*", $menuorder);
list($pagescreename1, $pageurl1, $pagename1) = explode(":", $pageinfo1);
list($pagescreename2, $pageurl2, $pagename2) = explode(":", $pageinfo2);
list($pagescreename3, $pageurl3, $pagename3) = explode(":", $pageinfo3);
list($pagescreename4, $pageurl4, $pagename4) = explode(":", $pageinfo4);
list($pagescreename5, $pageurl5, $pagename5) = explode(":", $pageinfo5);
list($pagescreename6, $pageurl6, $pagename6) = explode(":", $pageinfo6);
list($pagescreename7, $pageurl7, $pagename7) = explode(":", $pageinfo7);
list($pagescreename8, $pageurl8, $pagename8) = explode(":", $pageinfo8);
list($pagescreename9, $pageurl9, $pagename9) = explode(":", $pageinfo9);
list($pagescreename10, $pageurl10, $pagename10) = explode(":", $pageinfo10);
ShowMenu($pagescreename1, $pageurl1, $pagename1, $page);
ShowMenu($pagescreename2, $pageurl2, $pagename2, $page);
ShowMenu($pagescreename3, $pageurl3, $pagename3, $page);
ShowMenu($pagescreename4, $pageurl4, $pagename4, $page);
ShowMenu($pagescreename5, $pageurl5, $pagename5, $page);
ShowMenu($pagescreename6, $pageurl6, $pagename6, $page);
ShowMenu($pagescreename7, $pageurl7, $pagename7, $page);
ShowMenu($pagescreename8, $pageurl8, $pagename8, $page);
ShowMenu($pagescreename9, $pageurl9, $pagename9, $page);
ShowMenu($pagescreename10, $pageurl10, $pagename10, $page);
?>
<font class="dots">:.</font></p>