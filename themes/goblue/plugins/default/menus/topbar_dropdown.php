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
$menus = $params['menu'];
if($menus){
    echo '<ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="dropdownMenu">';
	foreach($menus as $menu) {
			foreach($menu as $link) {
					$class = "dropdown-item menu-topbar-dropdown-" . $link['name'];
					if(isset($link['class'])) {
						$link['class'] = $class . ' ' . $link['class'];
					} else {
							$link['class'] = $class;
					}
					unset($link['name']);	
					echo "<li>".ossn_plugin_view('output/url', $link)."</li>";
			}
	}
	echo "</ul>";
}
