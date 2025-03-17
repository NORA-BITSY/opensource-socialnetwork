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
 
echo ossn_view_form('administrator/settings', array(
    'action' => ossn_site_url() . 'action/wall/admin/settings',
    'component' => 'OssnWall',
    'class' => 'ossn-admin-form'	
), false);