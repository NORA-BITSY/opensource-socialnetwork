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
$group = ossn_get_group_by_guid(input('guid'));
if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
    ossn_trigger_message(ossn_print('group:delete:cover:error'), 'error');
    redirect(REF);
}
$files = $group->groupCovers();
if($files) {
	foreach($files as $file) {
		if($file->isFile()){
			unlink($file->getPath());	
		}
		$file->deleteEntity();
	}
	
	$group->data->cover_guid = 0;
	$group->save();
	$group->ResetCoverPostition();
}
ossn_trigger_message(ossn_print('group:delete:cover:success'));
redirect(REF);
