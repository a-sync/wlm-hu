<?php
//configure your database info
 $databaseserver = "sql3.ultraweb.hu"; //the address of your server, usually localhost, change it if you use a distant mysql database
 $databasename = "karosfold"; //the name of your database on the mysql server (quite often it's the same as your database username)
 $databaseuser = "karosfold"; //the name of the database-user
 $databasepass = "k4R0s"; // the password to your database
 $directory = "http://karosfold.uw.hu/bhbajnoksag" ; //the location of your WebLeague directory, as an url (no trailing slash) on the web. Be sure to give the exact path.

//configure the tables in the database
 $playerstable = "weblm_players"; //the name of the table that contains information about the players
 $gamestable = "weblm_games"; //the name of the table that stores the played games
 $newstable = "weblm_news"; // the name of the table that stores the news
 $varstable = "weblm_vars"; //the name of the table that stores various information
 $admintable = "weblm_admin"; //the name of the table that stores the admin login information
 $pagestable = "weblm_pages"; //the name of the table that stores additional pages
 $privmsgtable = "weblm_privmsg"; //the name of the table that stores the private messages between players
 $replaystable = "weblm_replays"; //the name of the table that stores uploaded replays infos

//ok now go back to the read me and follow the nexts instructions ;)

?>