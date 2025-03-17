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
 
$files = ossn_get_upgrade_files();
if($files){	
	foreach($files as $upgrade){
		ossn_update_upgraded_files($upgrade);
	}
}

$ossn_xml = ossn_package_information();
$version = $ossn_xml->version;

ossn_update_db_version($version);
