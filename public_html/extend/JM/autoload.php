<?php
namespace JM;

class autoload{
	
	//极光即时通讯---注册用户
	function JMessage($username,$password){
	import('JMessage.autoload',EXTEND_PATH);
	$client = new JMessage\JMessage('','');
	$user = new JMessage\IM\User($client);
	return $user->register($username, $password);
	}
}
