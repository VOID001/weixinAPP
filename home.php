<?php
session_start();
check_login(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd";>

<html>

 <head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	//Variant Defination
	$mapStrToNum=array("Mon"=>1,"Tue"=>2,"Wed"=>3,"Thu"=>4,"Fri"=>5,"Sat"=>6,"Sun"=>7); 
	$flag=0;					//Define the Status var 
	$status=$_POST['postchange'];
	echo "<h1>"."NEU Pioneer Online Repairing System"."</h1>";
	echo "<h3>"."东北大学先锋网络中心硬件部维修管理系统"."</h3>";
	if($status) set_ok($_POST['sub']);

	//Below will generate a sheet which will show this week's reservations
	//
	echo "<font color =blue>".date("Y-m-d-D")."</font>";
	$strtmp=date("Y-m-j-D");
	$data=explode("-",$strtmp);
	$data[3]=$mapStrToNum[$data[3]];

	//SQL OPREATION SEARCH
	//
	$connstr=mysql_connect(SAE_MYSQL_HOST_M.":".SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
	$err=mysql_select_db(SAE_MYSQL_DB,$connstr);
	if (!$err) $flag=-1;
	else
	{
		$SQLQUERY="SELECT * FROM reservation WHERE DateDiff(date,\"".date("Y-m-d")."\")<= 7 AND DateDiff(date,\"".date("Y-m-d")."\")>= 0 AND ok=0";
		//$SQLQUERY="SELECT * FROM reservation";
	//	echo $SQLQUERY."<br/>";
		$queryResStr=mysql_query($SQLQUERY);
		echo mysql_error();
		//OUTPUT THE HTTP SHEET
		echo '<form name="repair" action="home.php" method=post> ';
		$constructColStr="<table width=800 border=\"2\"><tr><td><b>用户ID</b></td><td>电脑(手机)型号</td><td>维修类型</td><td>预约时间</td><td>维修完毕戳这～</td>";
		echo $constructColStr;
		echo '<input type="hidden" name="postchange" value= 1>';
		while($row=mysql_fetch_array($queryResStr))
		{
			echo "<tr><td width=200><b>".$row['ID']."</b></td><td>".$row['brand']."</td><td>";
			switch($row['type'])
			{
			case 0:
				echo "<font color=green><b>清灰</b></font>";
				break;
			case 1:
				echo "<font color=red><b>装系统</b></font>";
				break;
			case 2:
				echo "<font color=purple><b>手机刷机</b></font>";
				break;
			}
			echo "</td><td>".$row['date'].'</td><td><input type="submit" name=sub value='.$row['ID'].'></td>';
			echo "</tr>";
		}
		echo "</table>";
		echo "</form>";
	}
		


	function set_ok($str)
	{
		$connstr=mysql_connect(SAE_MYSQL_HOST_M.":".SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		$err=mysql_select_db(SAE_MYSQL_DB,$connstr);
		if(!$err) return -1;
		else
		{
			$SQLQUERY="UPDATE reservation SET ok=1 WHERE ID=\"".$str."\" AND DateDiff(date,\"".date("Y-m-d")."\")<= 7 AND DateDiff(date,\"".date("Y-m-d")."\")>= 0";
			//echo "DEBUG SQLQUERY IN set_ok IS ".$SQLQUERY."<br/>";
			mysql_query($SQLQUERY);
			echo mysql_error();
		}
	}

	function check_login()
	{
		if(!isset($_SESSION['username']))
		{
			//echo "NO";
			header("Location:index.php");
			exit();
		}
		return ;
	}
?>

	</head>

 </html>
