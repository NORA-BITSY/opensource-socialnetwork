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
$user = input('email');
if (empty($user)) {
    ossn_trigger_message(ossn_print('password:reset:email:required'), 'error');
    redirect(REF);
}
$user = ossn_user_by_email($user);
if ($user && $user->SendResetLogin()) {
    ossn_trigger_message(ossn_print('passord:reset:email:success'), 'success');
    redirect();
} else {
    ossn_trigger_message(ossn_print('passord:reset:fail'), 'error');
    redirect(REF);
}
