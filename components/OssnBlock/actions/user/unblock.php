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
$block = new OssnBlock;
$user = input('user');
if ($block->removeBlock(ossn_loggedin_user()->guid, $user)) {
    ossn_trigger_message(ossn_print('user:unblocked'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('user:unblock:error'), 'error');
    redirect(REF);
}