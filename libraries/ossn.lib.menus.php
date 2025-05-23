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
 * Register a menu;
 * @param string $name Name of menu;
 * @param string $text Text for menu;
 * @param string $link Link for menu;
 *
 * @return void
 */
function ossn_register_menu_link($name, $text, $link, $menutype = 'site') {
		ossn_register_menu_item($menutype, array(
				'name' => $name,
				'text' => $text,
				'href' => $link,
		));
}
/**
 * Register a menu item
 *
 * @param string $name menu name;
 * @param array  $options A link options;
 * @param string $menutype A menu name
 *
 * @return void
 */
function ossn_register_menu_item($menutype, array $options = array()) {
		$menu = new OssnMenu($menutype, $options);
		$menu->register();
}

/**
 * Unregister menu from system;
 * @param string $menu Menu name
 * @param string  $menutype MenuType
 *
 * @return void;
 *
 */
function ossn_unregister_menu($menu, $menutype = 'site') {
		global $Ossn;
		unset($Ossn->menu[$menutype][$menu]);
}
/**
 * Unregister Type -> Menu -> Menu Item
 *
 * @param string $name Name of Menu Item
 * @param string $menu Name of Menu
 * @param string $menutype The name of menutype
 *
 * @return void
 */
function ossn_unregister_menu_item($name, $menu, $menutype = 'site') {
		global $Ossn;
		if(isset($Ossn->menu[$menutype][$menu])) {
				foreach($Ossn->menu[$menutype][$menu] as $key => $item) {
						if($item['name'] == $name) {
								unset($Ossn->menu[$menutype][$menu][$key]);
						}
				}
		}
}
/**
 * View a menu
 *
 * @param string $menu Menu name
 * @param boolean $custom if the file path is custom
 *
 * @note This will fetch layout from defualt template that how menu should appear; check menu file for more info;
 *
 * @return string
 */
function ossn_view_menu($menu, $custom = false) {
		global $Ossn;
		if(!isset($Ossn->menu[$menu])) {
				return false;
		}
		$ossnmenu = new OssnMenu();
		$ossnmenu->sortMenu($menu);

		$params['menu'] = $Ossn->menu[$menu];
		if($custom == false) {
				$params['menuname'] = $menu;
				return ossn_plugin_view("menus/{$menu}", $params);
		} elseif($custom !== false) {
				$params['menuname'] = $menu;
				return ossn_plugin_view($custom, $params);
		}
}

/**
 * Register a section base menu
 *
 * @param string $menu A name of menu
 * $param array $params A option values
 *
 * @return false|null
 */
function ossn_register_sections_menu($menu = '', array $params = array()) {
		if(!isset($params['name'])) {
				//If not set section menu name #1479
				$params['name'] = md5($params['url']);
		}
		if(isset($params['url'])) {
				$params['href'] = $params['url'];
				unset($params['url']);
		}
		if(isset($params['section'])) {
				$params['parent'] = $params['section'];
				unset($params['section']);
		}
		ossn_register_menu_item($menu, $params);
}

/**
 * View section base menu
 *
 * @param string $type (frontend or backend(
 * @param string $menu
 *
 * @note This will fetch layout from defualt template that how menu should appear; check menu file for more info;
 *
 * @return mixed data
 *
 */
function ossn_view_sections_menu($menu, $type = 'frontend') {
		ossn_trigger_callback('menu', 'section:before:view', array(
				'menu' => $menu,
				'type' => $type,
		));
		return ossn_view_menu($menu, "menus/sections/{$menu}");
}

/**
 * Register sidebar menu
 *
 * @param string $name The name of the menu
 * @param string $text Link text
 * @param string $link Full url
 * @param string $section Menu section
 * @param string $for sidebar name
 *
 * @return void
 */
function ossn_register_admin_sidemenu($name, $text, $link, $section, $for = 'admin/sidemenu') {
		ossn_register_menu_item($for, array(
				'name' => $name,
				'text' => $text,
				'href' => $link,
				'parent' => $section
		));
}