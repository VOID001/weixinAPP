<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd";>

<html>

 <head>

  <meta http-equiv="Content-Type" content="text/html; charset=gb2312">

<?php
$fp = fopen('http://bbs.neupioneer.com', 'r');
$t=0;

$str_title=array("");
$str_href=array("");
$counts=0;
while(!feof($fp))
{
	if($t)
	{break;}
	$a=fgets($fp);
	if(strstr($a,'hottiebox'))
	{
		while(1)
		{
			$a=fgets($fp);
			if(strstr($a,'</ul>'))
			{
				$t=1;
				break;
			}
			if(strstr($a,'a href='))
			{
				$w_array=explode('"',$a);
				$tmpstr="http://bbs.neupioneer.com/".$w_array[1];
				array_push($str_href,$tmpstr);
				//echo "HREF COUNTS=".$str_title[$counts];
			}
			if(strstr($a,'<strong>'))
			{
				$t_array=explode('<strong>',$a);
				$t1_array=explode('</strong',$t_array[1]);
				$tmpstr=$t1_array[0];
				array_push($str_title,$tmpstr);
				//printf("%s\n",$str_href[$counts]);
				$counts++;
			}
		}
	}
}

for($i=1;$i<=$counts;$i++)
{
	//cho $i;
	echo "<a href=".$str_href[$i]." >"."<h4><font color=blue>".$str_title[$i]."</font></h4>";
}
?> 
</head>
</html>