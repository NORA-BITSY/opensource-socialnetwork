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
$type = input('cache');
if ($type == 1) {
    if (ossn_create_cache()) {
        ossn_trigger_message(ossn_print('cache:enabled'), 'success');
        redirect(REF);
    }
} elseif ($type == 0) {
    if (ossn_disable_cache()) {
        ossn_trigger_message(ossn_print('cache:disabled'), 'success');
        redirect(REF);
    }
}