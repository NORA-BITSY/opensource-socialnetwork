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
 
function ossn_themes_init(){
	ossn_register_plugins_by_path(ossn_default_theme() . 'plugins/');
}
ossn_register_callback('ossn', 'init', 'ossn_themes_init');
