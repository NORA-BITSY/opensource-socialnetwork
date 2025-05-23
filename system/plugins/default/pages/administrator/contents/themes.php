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
 ?>
<div class="panel-group" id="accordion">
   	<?php
	$themes = new OssnThemes;
	$list = $themes->getThemes();
	if($list){
		foreach ($list as $id) {
			$vars = array();
			$vars['OssnThemes'] = $themes;
			$vars['id'] = $id;
			$vars['theme'] = $themes->getTheme($id);;
			echo ossn_plugin_view("admin/themes/list/item", $vars);
		}
	}
	?>
</div> 