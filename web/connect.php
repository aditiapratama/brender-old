<?php 
$my_server="localhost:8889";
#$my_server="192.168.1.54";
$my_user="root";
$my_password="root";
#print "dddd ----$my_server,$my_user,$my_password ----";

$link=mysql_connect($my_server,$my_user,$my_password) or die("unable to connect to mysql server");
@mysql_select_db("brender");
# print "connected to server $my_server\n";
?>