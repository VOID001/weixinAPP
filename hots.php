<?php
function getHot()
{
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

	$strres=NULL;
	for($i=1;$i<=$counts;$i++)
	{
		//cho $i;
		//echo "<a href=".$str_href[$i]." >".$str_title[$i];
		$strres=$strres. "<a href=\"".$str_href[$i]."\" >".$str_title[$i]."</a>\n";
	}
	$strres=iconv("gb2312","UTF-8//IGNORE",$strres);
	$strres=str_replace("&amp;","&",$strres);
	return $strres;
}
