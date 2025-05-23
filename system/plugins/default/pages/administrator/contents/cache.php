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
<div>
	<?php
	echo ossn_view_form('admin/cache_settings', array(
    	'action' => ossn_site_url('action/admin/cache/create'),
    	'class' => 'ossn-admin-form',
	));
	?>
</div>
<div class="margin-top-10">
	<?php
	echo ossn_view_form('admin/dynamic_cache_settings', array(
    	'action' => ossn_site_url('action/admin/dynamic/cache'),
    	'class' => 'ossn-admin-form ossn-admin-dcache-settings-form',
	));
	?>
</div>	