<?php
error_reporting(E_ALL);
function DB_write_brand($userObj,$brand)
{
	global $connstr;
	$SQLQUERY="SELECT * FROM users where UID='".$userObj->username."'";
	echo $SQLQUERY;
    $err=mysql_select_db(SAE_MYSQL_DB,$connstr);
    $resStr=mysql_query($SQLQUERY,$connstr);
	$arr=mysql_fetch_array($resStr);	
    if(!$err) return -2;
	$SQLQUERY="INSERT INTO reservation (UID,neupID,brand,type,date,ok,reserhash)"."VALUES("."'".$userObj->username."','".$arr['neupID']."','".$brand."','"."9"."','".date("Y-m-d")."','0','".md5($userObj->username.$userObj->timeStamp/100)."')";
	echo $SQLQUERY;
    $err=mysql_query($SQLQUERY,$connstr);
    echo mysql_error();
    //mysql_close($connstr);						Close the SQL Server when wxmain exit instead of function exit
    if(!$err) return 1; 
    return 0;
    
}

function DB_ifExist($id)
{
	global $connstr;
    $err=mysql_select_db(SAE_MYSQL_DB,$connstr);
    $SQLQUERY="SELECT * FROM reservation WHERE UID='".$id. "'";
    $queryResStr=mysql_query($SQLQUERY);
    $ok=0;
    while($row=mysql_fetch_array($queryResStr))
    {
        $delta=abs(date("Y-m-d")-$row['date']);
		echo (int)$delta;
		if($row['type']!='9')
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
	$infostr=array("DEFAULT","清灰","装系统","手机刷机","数据恢复","DEFAULT");
    if(!$connstr) return -1;									//连接错误返回-1
   	$err=mysql_select_db(SAE_MYSQL_DB,$connstr);
    if(!$err) return -2;
	$SQLQUERY="SELECT * FROM reservation where UID='".$id."' AND type=9";
	$queryResStr=mysql_query($SQLQUERY,$connstr);
	$row=mysql_fetch_array($queryResStr);
	if($row['neupID']=="") $row['neupID']="NOT Registered";
	$returnStr="您的预约已经完成 ～ 信息如下：\n先锋ID:".$row['neupID']."\n维修产品品牌:".$row['brand']."\n服务类型:".$infostr[(int)$type]."\n预约日期:".$row['date']."\n维修码:(每个用户的每一次维修码都不同，供维护信息，提供凭证使用，请保存)\n".$row['reserhash']."\n请在7天内的周二到先锋网络中心(大活204)接受服务，如果临时有事不能到请在菜单中取消\n";
	$SQLQUERY="UPDATE reservation SET type=".$type." WHERE UID ='".$id."' AND type = 9"; 
    $flag=mysql_query($SQLQUERY,$connstr);
	echo mysql_error();
    if($flag) return $returnStr; 
    return 0;
}

function DB_users_register($uid,$neupid)
{
	global $connstr;
	$err=mysql_select_db(SAE_MYSQL_DB,$connstr);
	$SQLQUERY="SELECT * FROM users WHERE UID='".$uid."'";
	$resStr=mysql_query($SQLQUERY);
	//echo $resStr;
	$arr=mysql_fetch_array($resStr);
	echo (bool)$arr;
	if($arr['UID']=="")
	{
		$SQLQUERY="INSERT INTO users (UID,neupID)"." VALUES('".$uid."','".$neupid."')";
		$err=mysql_query($SQLQUERY,$connstr);
		echo mysql_error();
		echo "INSERTED";
	}
}
