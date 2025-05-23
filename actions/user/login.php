<?php
/**
 * Boatable Technologies LLC
 *
 * @package   Boatable Technologies LLC (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Boatable Technologies LLC License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

if(ossn_isLoggedin()) {
		redirect('home');
}
$username = input('username');
$password = input('password');

if(empty($username) || empty($password)) {
		ossn_trigger_message(ossn_print('login:error') , 'error');
		redirect();
}
$user = ossn_user_by_username($username);

//check if username is email
if(strpos($username, '@') !== false) {
		$user     = ossn_user_by_email($username);
		$username = $user->username;
}

if($user && !$user->isUserVALIDATED()) {
		$user->resendValidationEmail();
		ossn_trigger_message(ossn_print('ossn:user:validation:resend'), 'error');
		redirect(REF);
}
$vars = array(
		'user' => $user
);
ossn_trigger_callback('user', 'before:login', $vars);

$login           = new OssnUser;
$login->username = $username;
$login->password = $password;
if($login->Login()) {
		//One uneeded redirection when login #516
		ossn_trigger_callback('login', 'success', $vars);
		redirect('home');
} else {
		redirect('login?error=1');
}
