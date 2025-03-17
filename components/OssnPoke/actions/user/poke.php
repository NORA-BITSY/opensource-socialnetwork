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
$poke = new OssnPoke;
$user = input('user');
if ($poke->addPoke(ossn_loggedin_user()->guid, $user)) {
    $user = ossn_user_by_guid($user);
    ossn_trigger_message(ossn_print('user:poked', array($user->fullname)), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('user:poke:error'), 'error');
    redirect(REF);
}