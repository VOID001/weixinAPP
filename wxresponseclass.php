<?php
    function receive_wx_msg($postObj)
    {
		$contObj=new Wechatcontent();
		switch($postObj->msgType)
		{
			case "text":
            	$keyword=trim($postObj->Content);
				$explodeStr=explode(' ',$keyword);
                $contentStr=$explodeStr[0];
            	switch($explodeStr[0])
                {
					
                    case "维修":
                    	$contentStr="东大先锋技术部长期为东北大学学生提供免费的电脑维修服务\n请按照如下的格式输入相关信息：\n  WEX  先锋id   维修的电脑(手机)的牌子    维修项目编号(0.清灰 1.装系统 2.手机刷机）\n例 WEX VOID_133 ThinkPadT430 1 \n 信息核实正确无误之后即可在对应例行的维护时间到先锋办公室享受您要的服务\n";
                    	break;
                    case "WEX":
                    	$expss=explode(' ',$keyword);
                    	$nameid=(string)$expss[1];
                    	$brandid=(string)$expss[2];
                    	$numid=(string)$expss[3];
  						$repstr;
                    	if($nameid=="" || $brandid=="" || $numid=="" ) $contentStr=" $nameid $brandid $numid 请输入合法数据哦亲";
                    	else
                        {
                            if($numid=="0") $repstr="清灰";
                            else if($numid=="1") $repstr="装系统";
                            else if($numid=="2") $repstr="手机刷机";
                            else 
                            {
                                //$contentStr="$numid 请输入合法的数值哦亲～";
                                break;
                            }
                            $contentStr="先锋id:$nameid \n维修电脑(手机)品牌:$brandid \n维修服务类型:$repstr\n";
                            //$filewriteStr="$nameid#$brandid#$numid\n";
                            //$saeFileObj=new SaeStorage();
                            //$dest_file_name="neuprepair.db";
                            //$domain="storvoid";
                            //SAE Storage目前不支持追加写!!!!    
                            //改为SQL 代码即可
                            // $result=$saeFileObj->write($domain,$dest_file_name,$filewriteStr);  
                            //改为SQL代码
                            $eoo=DB_ifExist($nameid);
                            if($eoo) $contentStr="您在7天内已经预约过了呢～ 请完成该预约后再次预约"."DEBUG";
                            else
                            {
                            	$errno=DB_writeTo($nameid,$brandid,$numid);
                            
                            	if ($errno==0)
                            	{
                            		$contentStr=$contentStr."\n亲～您的预约成功了哦～\n请按照约定到先锋技术部办公室接受相应服务，如果因故不能到请回复 \n ER### + id \n 我们將取消这个帐号的所有预约\n谢谢亲的配合~"."DEBUG";
                            	}
                            	else
                            	{
                            	    $contentStr="哎呀！数据库君的心情不太好呢，稍后再试试吧  也可以联系管理员菌把下面的错误代码给他～ 错误代码：".$errno;
                            	       
                            	}
                            }
                        } 
                    	break;
                    default:
                          $contentStr = "欢迎关注东北大学先锋技术部官方微信 \n 网址：www.neupioneer.com\n 东大先锋论坛 ～ 东大人的心灵港湾 bbs.neupioneer.com\n微信正在紧锣密鼓的开发中 敬请期待！～";
					 
                }
				$contObj->textMsg=$contentStr;
				break;
			case "voice":
				$contentStr="You have sent A VOICE";
				break;
			case "image":
				$contentStr="You have sent An image";
				break;
			case "location":
				$contentStr="You have sent A Location INFO";
				break;
			case "link":
				$contentStr="You have sent A LINK";
				break;

		}
        //return $contentStr;
		return $contObj;
        //return showSESSID($contentStr);
    }
//}
