<?php
/**
 * Boatable Technologies LLC
 *
 * @package   Boatable Technologies LLC
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Boatable Technologies LLC License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$query     = input('keyword');
$OssnGiphy = new OssnGiphy;
if($query){
	$data = $OssnGiphy->getSearch($query);
}  else {
	$data = $OssnGiphy->getTrending();	
}
if($data){
	$thumbs = $OssnGiphy->getThumbs($data);
	$OssnGiphy->setResponse($thumbs);
} else {
	$OssnGiphy->setResponse(array(
			'success' => false,							  
	));	
}