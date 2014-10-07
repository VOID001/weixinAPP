<?php

function writeToDB($id,$brand,$type)
{
    //$connstr=mysql_connect($db_host.":".$db_port,$db_user,$db_pass);
    $connstr = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    if(!$connstr) return -1;									//连接错误返回-1
   	$err=mysql_select_db(SAE_MYSQL_DB,$connstr);
    if(!$err) return -2;
    $SQLQUERY="INSERT INTO reservation (ID,brand,type,date,ok)"."VALUES("."'".$id."','".$brand."','".$type."','".date("Y-m-d")."','0')";
    echo $SQLQUERY."<br/>";
    $err=mysql_query($SQLQUERY,$connstr);
    echo mysql_error();
    mysql_close($connstr);
    if(!$err) return 1;
    return 0;
    
}

function ifExist($id)
{
    $connstr = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    $err=mysql_select_db(SAE_MYSQL_DB,$connstr);
    $SQLQUERY="SELECT * FROM reservation WHERE ID='".$id. "'";
    $ok=0;
    echo mysql_error();
    
    $queryResStr=mysql_query($SQLQUERY);
    //while($row=mysql_fetch_array($SQLQUERY))//这样写是错误的
    while($row=mysql_fetch_array($queryResStr))
    {
       echo $row['ID']." ".$row['brand']." ".$row['type']." ".$row['date'] ;
        echo "<br/>";
            
    }
    if($ok) return 888888;
    return 9999999;
}

//writeToDB("TEST","TEST","TEST");

ifExist("VOID");

?>