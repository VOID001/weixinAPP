<?php
class WechatResponse{
    public $resSessObj;
    public $resUserObj;
	public $contObj;
	public function receive_wx_msg()
    {
		$contObj=new Wechatcontent();
		$sess_1=(int)$this->resSessObj->sessID[1];	
		$sess_2=(int)$this->resSessObj->sessID[2];	
		$sess_3=(int)$this->resSessObj->sessID[3];	
		if($sess_1==0)
		{
			echo "DEBUG\n".$resUserObj->content;
			switch($resUserObj->content)
			{
			case "1":
				break;
			case "2":
				break;
			case "3":
				break;
			case "9":
				break;
			default:
				$this->response_Welcome();
				break;
			}	
		}
		else if($sess_1==1)
		{
			
		}
		return $this->contObj;
    }
    
    public function __construct($wuserObj,$wsessObj)
    {
		$this->resSessObj=new WechatSession();
		$this->resUserObj=new WechatUser();
        $this->resSessObj=$wsessObj;
       	$this->resUserObj=$wuserObj;
    }
    
    private function response_Welcome()
    {
				$this->contObj->textMsg="您好，欢迎进入东北大学先锋网络中心服务区，请回复下列对应数字编号，接受我们的服务。 菜单:\n\n1.论坛中心\n2.免费维修\n3.每日热贴\n请回复相应的序号选择对应的服务 \n回复9是返回主菜单哦～";
				$this->resSessObj->set_session(1,0);
    }
    
}
