<?php
class WechatUser{
	public $username;
	public $myname;
	public $timeStamp;
	public $text;
	public $msgType;
	public $content;
	public $rawmsg;
	public function __construct($xmlstr="")
	{
		$tmpObj = simplexml_load_string($xmlstr,'SimpleXMLElement',LIBXML_NOCDATA);	
		$this->username = $tmpObj->FromUserName;
		$this->myname = $tmpObj->ToUserName;
		$this->msgType = $tmpObj->MsgType;
		$this->content = $tmpObj->Content;
		$this->timeStamp = time(); 
		$this->rawmsg=$xmlstr;
	}
	
	public function debug_printInfo()
	{
		echo nl2br("=====================DEBUG INFO====================\nfromUsername=".$this->username."\ntoUsername=".$this->myname."\nmsgType=".$this->msgType."\ncontent=".$this->content."\ntime=".$this->timeStamp);
	}
}
