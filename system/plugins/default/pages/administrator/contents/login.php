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

echo '<div class="ossn-admin-login">';
echo '<div class="page-title">' . ossn_print('administration') . '</div>';
echo ossn_view_form('admin/login', array(
    'action' => ossn_site_url('action/admin/login'),
    'class' => 'ossn-admin-form ossn-login-form',
));
echo '</div>';
