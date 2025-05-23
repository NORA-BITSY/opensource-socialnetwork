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
 * Ossn get object
 *
 * @param int $guid Guid of object
 *
 * @return object
 */
function ossn_get_object($guid){
		if(empty($guid)){
			return false;	
		}
		$object = new OssnObject;
		$object->object_guid = $guid;
		return $object->getObjectById();
}
/**
 * Get entities of object
 *
 * @param object $object Must be valid object
 * @param array $params Options
 *
 * @return object
 */
function ossn_get_object_entities($object, $params = array()){
	if(isset($object->guid)){
		$vars['owner_guid'] = $object->guid;
		$vars['type'] = 'object';
		$vars = array_merge($vars, $params);
		
		return ossn_get_entities($vars);	
	}
	return false;
}
/**
 * Get objects
 *
 * @param array $params Options
 * @param int $params['owner_guid'] object owner guid
 * @param string $params['type'] object type
 * @param string $params['subtype'] object subtype
 * @param string $params['limit'] limit of fetch data
 * @param string $params['order_by'] order fetch data
 *
 * @return object
 */
function ossn_get_objects(array $params){		
		$object = new OssnObject;
		return $object->searchObject($params);
}
/**
 * Get objects by type
 *
 * @param array $params Options
 * @param string $params['type'] object type
 * @param string $params['subtype'] object subtype
 * @param string $params['limit'] limit of fetch data
 * @param string $params['order_by'] order fetch data
 *
 * @return object
 */
function ossn_get_objects_by_type(array $params){
	return ossn_get_objects($params);
}
