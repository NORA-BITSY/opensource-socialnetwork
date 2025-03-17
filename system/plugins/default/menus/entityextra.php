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
$entityextra = $params['menu'];
if($entityextra && ossn_isLoggedin()) {
		if(!empty($entityextra)) {
				foreach($entityextra as $menu) {
						foreach($menu as $link) {
								$class = "entity-menu-extra-" . $link['name'];
								if(isset($link['class'])) {
										$link['class'] = $class . ' ' . $link['class'];
								} else {
										$link['class'] = $class;
								}
								unset($link['name']);
								$link = ossn_plugin_view('output/url', $link);
								echo $link;
						}
				}
		}
}
