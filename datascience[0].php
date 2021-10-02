<?php
Header("Content-Type: Application/JSON");
function access_token($_username = NULL,$_password = NULL){
	//
	$_login = curl_init();
	curl_setopt($_login,CURLOPT_URL,"https://b-api.facebook.com/method/auth.login?access_token=237759909591655%25257C0f140aabedfb65ac27a739ed1a2263b1&format=json&sdk_version=2&email=$_username&locale=en_US&password=$_password&sdk=ios&generate_session_cookies=1&sig=3f555f99fb61fcd7aa0c44f58f522ef6");
	curl_setopt($_login,CURLOPT_RETURNTRANSFER,true);
	$_output = json_decode(curl_exec($_login),true)["access_token"];
	curl_close($_login);
	return($_output);
}
function get_userid($_username = NULL,$_password = NULL){
	$_ssh = curl_init();
	curl_setopt($_ssh,CURLOPT_URL,"https://graph.facebook.com/me/friends?access_token=".(access_token($_username,$_password)));
	curl_setopt($_ssh,CURLOPT_RETURNTRANSFER,true);
	$_output = curl_exec($_ssh);
	$_friends = [];
	foreach(json_decode($_output,true) as $_token => $_coin){
		if(is_array($_coin)){
			foreach($_coin as $_nekot => $_nioc){
				if(!empty($_nioc["id"])){
					$_friends[] = "[ ".($_nioc["name"])." ]:[ ".$_nioc["id"]." ]";
				}else{
					continue;
				}
			}
		}else{
			continue;
		}
	}
	curl_close($_ssh);
	return($_friends);
}
//Reserved for Mutual Friends Only!
/*
function get_mutual($_username = NULL,$_password = NULL,$_friendid){
	$_ssh = curl_init();
	curl_setopt($_ssh,CURLOPT_URL,"https://graph.facebook.com/".($_friendid)."/mutualfriends?access_token=".(access_token($_username,$_password)));
	curl_setopt($_ssh,CURLOPT_RETURNTRANSFER,true);
	$_output = curl_exec($_ssh);
	curl_close($_ssh);
	return($_output);
}
*/
//
$_username = readline("Username: \r\n");
$_password = readline("Password: \r\n");
print_r(get_userid($_username,$_password));
?>
