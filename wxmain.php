<?php ?>
<?php
/**
  * wechat php test
  */

//define your token

require('wxconfig.php');
require('wxapi.php');
require('wxdbapi.php');
require('wxsession.php');
require('wxresponseclass.php');
require('wxcontentclass.php');
require('wxuserinfoclass.php');
//DEBUG FIELD
//echo nl2br("DEBUG2\nUserName=".$userObj->username);		DEBUG Shows the Properties in the userObj can be used everywhere in the code
//$userResponse= new Response();

//END DEBUG


$wechatObj = new Wechatapi();
$userObj = new WechatUser($GLOBALS['HTTP_RAW_POST_DATA']);
$contentObj=new WechatContent();
$sessObj= new WechatSession($userObj->username);
// Need A Session Obj to maintain the session
$sessObj->get_session();
// Need A NEUP Obj to maintain the NEUPIONEER INFO
//$wechatObj->valid();
$wechatObj->responseMsg($userObj);



mysql_close($connstr);


 



