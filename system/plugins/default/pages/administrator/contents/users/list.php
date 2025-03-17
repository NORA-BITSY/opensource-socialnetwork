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
echo ossn_view_form('admin/users/list_search', array(
    'action' => ossn_site_url('administrator/users'),
    'class' => 'ossn-admin-form',
));
echo ossn_view_form('admin/users/list', array(
    'action' => ossn_site_url('action/admin/users/delete'),
    'class' => 'ossn-admin-form',
));