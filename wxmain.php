<?php error_reporting(E_ALL); ?>
<?php
/**
  * wechat php test
  */

//define your token

require_once('wxconfig.php');
require_once('wxdbapi.php');
require_once('wxsession.php');
require_once('wxbbsapi.php');
require_once('wxresponseclass.php');
require_once('wxcontentclass.php');
require_once('wxuserinfoclass.php');
require_once('wxapi.php');
//DEBUG FIELD
//echo nl2br("DEBUG2\nUserName=".$userObj->username);		DEBUG Shows the Properties in the userObj can be used everywhere in the code
//$userResponse= new Response();

//END DEBUG

$wechatObj = new Wechatapi();
$userObj = new WechatUser($GLOBALS['HTTP_RAW_POST_DATA']);
$contentObj=new WechatContent();
$sessObj= new WechatSession($userObj->username);
// Use A Session Obj to maintain the session
//
// Need A NEUP Obj to maintain the NEUPIONEER INFO
//$wechatObj->valid();
$wechatObj->responseMsg($userObj,$sessObj);

mysql_close($connstr);


 



