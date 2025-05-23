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
?>
<div class="ossn-page-contents">
<?php
	$form = ossn_view_form('invite', array(
        'action' => ossn_site_url() . 'action/invite/friends',
        'component' => 'OssnInvite',
        'class' => 'ossn-edit-form',		
    ), false);
 	echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('com:ossn:invite:friends'),
						'contents' => $form,
	));
?>
</div>