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
$type  = input('type');
$types = array(
		'friends',
		'public'
);
if(!in_array($type, $types)) {
		ossn_trigger_message(ossn_print('ossn:wall:settings:save:error'), 'error');
		redirect(REF);
}
if(ossn_set_homepage_wall_access($type)) {
		ossn_trigger_message(ossn_print('ossn:wall:settings:saved'));
} else {
		ossn_trigger_message(ossn_print('ossn:wall:settings:save:error'), 'error');
}
redirect(REF);