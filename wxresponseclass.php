<?php
class WechatResponse{
    private $resSessObj;
    private $resUserObj;
	private $contObj;
	public function receive_wx_msg()
    {
		$contObj=new Wechatcontent();
		$sess_1=(int)$this->resSessObj->sessID[1];	
		$sess_2=(int)$this->resSessObj->sessID[2];	
		$sess_3=(int)$this->resSessObj->sessID[3];	
		echo $sess_1.$sess_2.$sess_3;
		if($sess_1==0)
		{
			//echo "DEBUG\n".$this->resUserObj->content;
			switch($this->resUserObj->content)
			{
			case "1":
				break;
			case "2":
				$this->resSessObj->set_session(1,2);
				$this->responseRepair_0();
				break;
			case "3":
				break;
			default:
				$this->responseWelcome();
				break;
			}	
		}
		else if($sess_1==2)				//YOU SHOULD RESPONCE A STRING
		{
			if($sess_2==0)
			{
				if($sess_3==0)
				{
					//echo "DEBUG\n".$this->resUserObj->content;
					switch($this->resUserObj->content)
					{
					case "1":
						//echo "CASE1 \n\n";
						$this->resSessObj->set_session(2,1);
						$this->responseRepair_1();
						$this->resSessObj->set_session(3,1);
						break;
					case "9":
						$this->setBack();
						$this->responseWelcome();
						break;
					}
				}
			}
			else if($sess_2==1)
			{
				if($sess_3==1)
				{
					//Database Operation
					$this->responseRepair_2();	
					$this->resSessObj->set_session(3,2);
				}
				else if($sess_3==2)
				{
					//Update the latest message
					//SHOW RESPONCE IN DATABASE
					$this->setBack();
				}

			}
			else if($sess_2==2)
			{
			}
			else if($sess_2==3)
			{
			}
		}
		else if($sess_1==1)
		{

		}
		else if($sess_1==3)
		{

		}
		return $this->contObj;
	}

	public function __construct($wuserObj,$wsessObj)
	{
		$this->resSessObj=new WechatSession($wsessObj->userID);
		$this->resUserObj=new WechatUser($wuserObj->rawmsg);
		$this->resSessObj->get_session();
		//$wuserObj->debug_printInfo();
		//$this->resUserObj->debug_printInfo();
	}

	private function responseWelcome()
	{
		$this->contObj->textMsg="您好，欢迎进入东北大学先锋网络中心服务区，请回复下列对应数字编号，接受我们的服务。 菜单:\n\n1.论坛中心\n2.免费维修\n3.每日热贴\n请回复相应的序号选择对应的服务 \n回复9是返回主菜单哦～";
	}

	private function responseRepair_0()
	{
		$this->contObj->textMsg="先锋网络中心为东大的学生们提供免费的计算机维护，清灰，装系统，手机刷机等一系列服务 请回复相应序号进入菜单\n1.维修预约\n2.取消预约\n3.查看预约\n回复9是返回主菜单哦～";
	}

	private function responseRepair_1()
	{
		$this->contObj->textMsg="请回复你的笔记本牌子";
	}

	private function responseRepair_2()
	{
		$this->contObj->textMsg="请选择你要的服务编号:\n1.清灰\n2.装系统\n3.手机刷机\n4.数据恢复";
	}

	private function setBack()
	{
		$this->resSessObj->set_session(1,0);
		$this->resSessObj->set_session(2,0);
		$this->resSessObj->set_session(3,0);
	}

}
