<?php
/**
    * WHMCS Kullanıcı Adı Modülü
    *
    * Turkish: WHMCS için Kullanıcı Adı modülü.
    * English: Username module for WHMCS.
    * Version: 1.0.2 (1.0.2release.1)
    * BuildId: 20190527.001
    * Build Date: 27 May 2019
    * Email: bilgi[@]aponkral.net
    * Website: https://aponkral.net
    *
    * @license Apache License 2.0
*/
// Her şeyi sana yazdım!.. Her şeye seni yazdım!.. *Mustafa Kemal ATATÜRK

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly. This module was made by APONKRAL.");
exit();
}

require_once('helpers.php');
use Illuminate\Database\Capsule\Manager as Capsule;

// Get the module config
$conf = kullaniciadi_get_module_conf();
$username_field = $conf["username_field"];
$admin_username = $conf["admin_username"];
$reserve_usernames = $conf["reserve_usernames"];
$reserved_usernames = $conf["reserved_usernames"];
$unique_username_message = $conf["unique_username_message"];

add_hook('ClientDetailsValidation', 1, function ($vars) use ($username_field, $reserve_usernames, $reserved_usernames, $unique_username_message)
{
    if ($_SERVER["SCRIPT_NAME"] == '/creditcard.php')
    {
        return;
    }

    if (isset($vars["save"]))
    {
        $user_details = kullaniciadi_find_user_details($vars["email"]);
        
		if(isset($user_details["id"]) && !empty($user_details["id"]) && is_numeric($user_details["id"]))
			$vars["userid"] = $user_details["id"];
		else
			$vars["userid"] = $_SESSION['uid'];

        if (!isset($vars["firstname"]))
        {
            $vars["firstname"] = $user_details["firstname"];
        }

        if (!isset($vars["lastname"]))
        {
            $vars["lastname"] = $user_details["lastname"];
        }
    }
    
    $error_message = [];

	// Get the custom fields from vars
	$form_username = $vars["customfield"][$username_field];
    
if(isset($form_username) && !empty(trim($form_username))) {
    
    function kullaniciadi_validate_username($username) {
	return preg_match('/^[A-Za-z0-9_]+$/', $username);
}

function kullaniciadi_validate_unique_username($user_id, $username_field, $form_username)
		{
			if(!isset($user_id) || empty($user_id) || !is_numeric($user_id))
				$user_id = 0;
			
			$check_unique_username = Capsule::table('tblcustomfieldsvalues')
				->where('relid', '!=', $user_id)
				->where('fieldid', '=', $username_field)
				->where('value', '=', $form_username)
				->count();
		
	if($check_unique_username == 0)
		return true;
	else
		return false;
	}
		
	$user_id = $vars["userid"];
	if(kullaniciadi_validate_username($form_username) != true)
		$error_message[] = "Kullanıcı adınız kullanıcı adı standartlarına uymuyor. Sadece A-Z, a-z, 0-9 ve _ (alt çizgi) içeren kullanıcı adları kullanılabilir.";
		
if(strlen($form_username) < 2 || strlen($form_username) > 15)
	$error_message[] = "Kullanıcı adı uzunluğu en az 2 ve en fazla 15 olabilir.";
		
	if(kullaniciadi_validate_unique_username($user_id, $username_field, $form_username) != true)
		$error_message = $unique_username_message;
		
	if($reserve_usernames == "on") {
		
		$reserved_usernames_array = explode(",", trim($reserved_usernames, " "));

		if(in_array($form_username, $reserved_usernames_array))
			$error_message[] = "Rezerve edilmiş kullanıcı adı kullanılamaz.";
	}

}
else {
	$error_message[] = "Kullanıcı adı alanı boş olamaz.";
}

	if(empty($error_message))
			return;
		else
			return $error_message;
	
});

add_hook('ClientLoginShare', 1, function($vars) use ($username_field, $admin_username) {
$username = $vars['username'];
$password = $vars['password'];

$username_to_userid = Capsule::table('tblcustomfieldsvalues')
		->where("fieldid", "=", $username_field)
		->where("value", "=", $username)
		->value('relid');
		
$userid_to_email = Capsule::table('tblclients')
		->where("id", "=", $username_to_userid)
		->value('email');

if(empty(trim($admin_username)))
	return false;

$login_validation_results = localAPI("ValidateLogin", ["email" => $userid_to_email, "password2" => $password,], $admin_username);

if($login_validation_results['result'] == "success")
	return [
		'id' => $username_to_userid,
	];
else
	return false;
    
});

add_hook('ClientAreaFooterOutput', 1, function($vars) {
$filename = $vars['filename'];
$template = $vars['template'];
if($filename == "clientarea")
	return "<script type=\"text/javascript\">
$(document).ready(function(){
	$('[name=\"username\"]').each(function(){
		$(this).prop({type: \"text\", placeholder: \"Kullanıcı adı veya E-posta adresini girin\"});
	});
	$('[name=\"loginemail\"]').each(function(){
		$(this).prop({type: \"text\", placeholder: \"Kullanıcı adı veya E-posta adresini girin\"});
	});
});
</script>";
});