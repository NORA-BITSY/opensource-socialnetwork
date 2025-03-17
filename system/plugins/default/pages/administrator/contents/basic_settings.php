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
?>

<?php
echo ossn_view_form('admin/basic_settings', array(
    'action' => ossn_site_url('action/admin/settings/save/basic'),
    'class' => 'ossn-admin-form'
));
?>

<?php
