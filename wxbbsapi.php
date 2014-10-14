<?php
function bbs_logger($usrname,$passwd)
{
	//Comment
	$discuz_url = 'http://bbs.neupioneer.com/';
	$login_url = $discuz_url .'member.php?mod=logging&action=login&loginsubmit=yes&infloat=yes&lssubmit=yes';
	$post_fields = array();
	$post_fields['fastloginfield'] = 'username';
	$post_fields['quickforward'] = 'yes';
	$post_fields['handlekey']='ls';
	$post_fields['username'] = $usrname;
	$post_fields['password'] = $passwd;
	$ch=curl_init($login_url);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL,$login_url);
	$res=curl_exec($ch);
	curl_close($ch);
	//echo "UNAME=$usrname\nUPWD=$passwd\n";
	echo $res;
	if(!strstr($res,"301 Moved Permanently"))
	{
		return false;
	}
	else
	{
		return true;
	}
}


