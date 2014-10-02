<?php

// define the Wechat API such as vaild responseMsg

class Wechatapi
{
	public function valid()
	{
		$echoStr = $_GET["echostr"];

		//valid signature , option
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}
	public function responseMsg($userObj)
	{
		if (!empty($userObj->rawmsg)) 
		{
			//$contentStr=receive_wx_msg($userObj);
			$contentObj = receive_wx_msg($userObj);
			//$resultStr=$this->processMsg($userObj,$contentStr);
			$resultStr=$this->processMsg($userObj,$contentObj);
			echo $resultStr;
		}
		else
		{
			echo "Input something...";
		}
	}
	private function checkSignature()
	{
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];	

		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	private function processMsg($userObj,$contentStr)			//Put the contentStrInto A $contentObj
	{
		switch($userObj->msgType)
		{
		case "text":
			$textTp = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				</xml>";             
			$resultStr=sprintf($textTp, $userObj->myname, $userObj->username,$userObj->timeStamp, $userObj->msgType,$contentStr);
			break;
		}
		return $resultStr;
	}
}

