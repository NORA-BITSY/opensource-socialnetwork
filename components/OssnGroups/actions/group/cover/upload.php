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
header('Content-Type: application/json');
$group = input('group');
$group = ossn_get_group_by_guid($group);
if(ossn_loggedin_user()->guid !== $group->owner_guid && !ossn_isAdminLoggedin()) {
		echo json_encode(array(
				'success' => 0,
				'error' => ossn_print('group:delete:cover:error')
		));
		exit;
}
if($group->UploadCover()) {
		//get group again to get newly assigned cover
		$group = ossn_get_group_by_guid($group->guid);
		echo json_encode(array(
				'success' => 1,
				'url' => $group->coverURL()
		));
		exit;
} else {
		echo json_encode(array(
				'success' => 0,
				'error' => $group->OssnFile->getFileUploadError($group->OssnFile->error)
		));
		exit;
}
