<?php
/**
 * Boatable Technologies LLC
 *
 * @package   Boatable Technologies LLC
 * @author    Boatable Technologies LLC Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Boatable Technologies LLC License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */


$guid = input('guid');
$group = ossn_get_group_by_guid($guid);

if(($group->owner_guid === ossn_loggedin_user()->guid) || ossn_isAdminLoggedin()){
	if ($group->deleteGroup($group->guid)) {
    	ossn_trigger_message(ossn_print('group:deleted'));
    	redirect();
	} 
}
ossn_trigger_message(ossn_print('group:delete:fail'), 'error');
redirect(REF);	
