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

$name = input('groupname');
$desc = input('groupdesc');
$memb = input('membership');

$group = ossn_get_group_by_guid(input('group'));
if ($group->owner_guid !== ossn_loggedin_user()->guid && !ossn_isAdminLoggedin()) {
    ossn_trigger_message(ossn_print('group:update:fail'), 'error');
    redirect(REF);
}

$edit = new OssnGroup;
$access = array(
    OSSN_PUBLIC,
    OSSN_PRIVATE
);

if (in_array($memb, $access)) {
    $edit->data = new stdClass;
    $edit->data->membership = $memb;
}

if ($edit->updateGroup($name, $desc, $group->guid)) {
    ossn_trigger_message(ossn_print('group:updated'));
    redirect("group/{$group->guid}");
} else {
    ossn_trigger_message(ossn_print('group:update:fail'), 'error');
    redirect(REF);
}
