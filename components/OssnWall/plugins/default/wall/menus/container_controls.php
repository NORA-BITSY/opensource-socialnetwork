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
if(!empty($params['menu'])){ 
	foreach($params['menu'] as $item){
		$name = OssnTranslit::urlize($item[0]['name']);
		$class = '';
		if(isset($item[0]['class'])){
			$class = $item[0]['class'];	
		}
?><li class="<?php echo $class;?> ossn-wall-container-control-menu-<?php echo $name;?>"><?php echo $item[0]['text'];?></li>  
<?php
	}
}