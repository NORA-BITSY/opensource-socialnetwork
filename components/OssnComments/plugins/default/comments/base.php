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
echo '<div class="comments-likes">';
if (ossn_is_hook('post', 'likes:entity')) {
    $entity['entity_guid'] = $params['entity_guid'];
    echo ossn_call_hook('post', 'likes:entity', $entity);
}
if (ossn_is_hook('post', 'comments:entity')) {
    $entity['entity_guid'] = $params['entity_guid'];
    echo ossn_call_hook('post', 'comments:entity', $entity);
}
echo '</div>';