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
if(!isset($params['user'])) {
		$params['user'] = '';
}
echo '<div class="ossn-wall-container">';
echo ossn_view_form('home/container', array(
		'action' => ossn_site_url() . 'action/wall/post/a',
		'component' => 'OssnWall',
		'id' => 'ossn-wall-form',
		'enctype' => 'multipart/form-data',
		'params' => array(
				'user' => $params['user']
		)
), false);

echo '</div>';
echo '<div class="user-activity">';
echo ossn_plugin_view('wall/siteactivity');
echo '</div>';
