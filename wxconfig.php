<?php

//This is the CONFIG FILE
define("TOKEN", "NEUVOID");
$db_host=SAE_MYSQL_HOST_M;
$db_user=SAE_MYSQL_USER;
$db_port=SAE_MYSQL_PORT;
$db_pass=SAE_MYSQL_PASS;

//Insert a comment here
$RAWPOSTDATA=$_GLOBALS['HTTP_RAW_POST_DATA'];
global $connstr;
$connstr=mysql_connect($db_host.':'.$db_port,$db_user,$db_pass);
echo mysql_error();
global $fromUsername;
