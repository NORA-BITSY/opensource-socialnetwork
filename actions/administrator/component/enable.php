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

$enable = new OssnComponents;
$com    = input('com');
$cache  = ossn_site_settings('cache');

if($enable->enable($com)) {
		ossn_trigger_message(ossn_print('com:enabled'), 'success');
		if($cache == false) {
				redirect(REF);
		} else {
				//redirect and flush cache
				$action = ossn_add_tokens_to_url("action/admin/cache/flush");
				redirect($action);
		}
}
