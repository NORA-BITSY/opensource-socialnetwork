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
$guid = input('guid');
$album = new OssnAlbums;
if($album->deleteAlbum($guid)){
        ossn_trigger_message(ossn_print('photo:album:deleted'));
        redirect();	
} else {
        ossn_trigger_message(ossn_print('photo:album:delete:error'), 'error');
        redirect(REF);	
}
