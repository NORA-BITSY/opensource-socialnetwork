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
//[B] Wall is not visible for group member (other than creator) #2340 
//should be == instead of ===  as value can be either 1 or true ,  0 or false
if($params['ismember'] == true) {
		echo '<div class="ossn-wall-container">';
		echo ossn_view_form('group/container', array(
				'action' => ossn_site_url() . 'action/wall/post/g',
				'component' => 'OssnWall',
				'id' => 'ossn-wall-form',
				'params' => array(
						'group' => $params['group']
				)
		), false);
		echo '</div>';
}
echo '<div class="user-activity">';
$posts = new OssnWall;
$count = 0;
if($params['ismember'] == true || $params['membership'] == OSSN_PUBLIC) {
		$count = $posts->GetPostByOwner($params['group']['group']->guid, 'group', true);
		$posts = $posts->GetPostByOwner($params['group']['group']->guid, 'group');
}
if($posts) {
		foreach($posts as $post) {
				$vars = ossn_wallpost_to_item($post);
				//selecting a CLOSED group like MYSITE/group/123/ gives warning #663
				if(!empty($vars) && is_array($vars)){ 
					$vars['ismember'] = $params['ismember'];
					echo ossn_wall_view_template($vars);
				}
		}
}
echo ossn_view_pagination($count);

echo '</div>';
