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
$component = new OssnComponents();
$modes     = array(
		'off',
		'on',
);
$close_anywhere = input('close_anywhere');
if(in_array($close_anywhere, $modes)) {
		$autocheck_time = input('autocheck_time');
		$settings       = array(
				'close_anywhere' => $close_anywhere,
				'autocheck_time' => $autocheck_time,
		);
		if($component->setSettings('OssnNotifications', $settings)) {
				ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
				redirect(REF);
		}
}
ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
redirect(REF);