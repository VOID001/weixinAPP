<?php
function DB_write_brand($id,$brand)
{
	global $connstr;
    //$connstr=mysql_connect($db_host.":".$db_port,$db_user,$db_pass);
    //$connstr = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    if(!$connstr) return -1;									//连接错误返回-1
   	$err=mysql_select_db(SAE_MYSQL_DB,$connstr);
    if(!$err) return -2;
    $SQLQUERY="INSERT INTO reservation (UID,brand,type,date,ok)"."VALUES("."'".$id."','".$brand."','"."9"."','".date("Y-m-d")."','0')";
    $err=mysql_query($SQLQUERY,$connstr);
    echo mysql_error();
    //mysql_close($connstr);						Close the SQL Server when wxmain exit instead of function exit
    if(!$err) return 1; 
    return 0;
    
}

function DB_ifExist($id)
{
	global $connstr;
    //$connstr = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    $err=mysql_select_db(SAE_MYSQL_DB,$connstr);
    $SQLQUERY="SELECT * FROM reservation WHERE UID='".$id. "'";
    $ok=0;
    $queryResStr=mysql_query($SQLQUERY);
    $ok=0;
    //while($row=mysql_fetch_array($SQLQUERY))//这样写是错误的
    while($row=mysql_fetch_array($queryResStr))
    {
        $delta=abs(date("Y-m-d")-$row['date']);
		if($row['type']=='9')
		{
			return 0;
		}
		else
		{
			$ok=1;
			if($delta>7) return 0; 
		}
	}
	if(!$ok) return 0;
	return -1;
}

function DB_write_type($id,$type)
{
	global $connstr;
    if(!$connstr) return -1;									//连接错误返回-1
   	$err=mysql_select_db(SAE_MYSQL_DB,$connstr);
    if(!$err) return -2;
	$SQLQUERY="UPDATE reservation SET type=".$type." WHERE UID ='".$id."' AND type=9"; 
    $err=mysql_query($SQLQUERY,$connstr);
    echo mysql_error();
    if(!$err) return 1; 
    return 0;
    
}
