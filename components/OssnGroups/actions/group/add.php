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
$add = new OssnGroup;
$params['owner_guid'] = ossn_loggedin_user()->guid;
$params['name'] = input('groupname');
$params['description'] = input('description');
$params['privacy'] = input('privacy');
if ($add->createGroup($params)) {
    ossn_trigger_message(ossn_print('group:added'), 'success');
    redirect("group/{$add->getGuid()}");
} else {
    ossn_trigger_message(ossn_print('group:add:fail'), 'error');
    redirect(REF);
}