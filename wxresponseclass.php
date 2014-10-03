<?php
class WechatResponse{
    private $resSessObj;
    private $resUserObj;
    private $resCntObj;
	public function receive_wx_msg()
    {
		$contObj=new Wechatcontent();
       	
    }
    
    public function __construct($wuserObj,$wsessObj)
    {
        $this->resSessObj=$wsessObj;
       	$this->resUserObj=$wuserObj;
    }
    
    private function response_Welcome()
    {
        
    }
    
}