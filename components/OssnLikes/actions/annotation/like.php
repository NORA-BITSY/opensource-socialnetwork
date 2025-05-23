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
$OssnLikes = new OssnLikes;
$anotation = input('annotation');
$reaction_type = input('reaction_type');

if ($OssnLikes->Like($anotation, ossn_loggedin_user()->guid, 'annotation', $reaction_type)) {
    if (!ossn_is_xhr()) {
        redirect(REF);
    } else {
		$likes_container = ossn_plugin_view('likes/annotation/likes', array(
					'annotation_id' => $anotation,																	
		));			
        header('Content-Type: application/json');
        echo json_encode(array(
                'done' => 1,
				'container' => $likes_container,
        ));
	exit;
    }
} else {
    if (!ossn_is_xhr()) {
        redirect(REF);
    } else {
		$likes_container = ossn_plugin_view('likes/annotation/likes', array(
					'annotation_id' => $anotation,																	
		));					
        header('Content-Type: application/json');
        echo json_encode(array(
                'done' => 0,
				'container' => $likes_container,
        ));
	exit;
    }
}
