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

/**
 * Ossn Url Display
 * Displays a URL as a link
 *
 * @uses string $params['text']        The string between the <a></a> tags.
 * @uses string $params['href']        The unencoded url string
 * @uses bool   $params['action']   Is this a link to an action (false)
 */
if(isset($params['href'])){
		$url = $params['href'];
}
$text = $params['text'];

if(isset($params['action']) && $params['action'] == true){
		$url = ossn_add_tokens_to_url($url);
}
unset($params['text']);
unset($params['action']);
unset($params['href']);
if(isset($url)){
		$params['href'] = $url;
}
$attributes = ossn_args($params);

echo "<a {$attributes}>{$text}</a>";
