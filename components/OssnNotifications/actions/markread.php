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
 $user = ossn_loggedin_user();
 $notification = new OssnNotifications;
 if($notification->clearAll($user->guid)){
	ossn_trigger_message(ossn_print('ossn:notification:mark:read:success'));
	redirect(REF);	 
 } else {
	ossn_trigger_message(ossn_print('ossn:notification:mark:read:error'), 'error');
	redirect(REF);	 
 }