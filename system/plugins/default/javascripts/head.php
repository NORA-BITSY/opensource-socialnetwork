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
$timestamp = time();
$token     = ossn_generate_action_token($timestamp);

$token   = array(
		'ossn_ts' => $timestamp,
		'ossn_token' => $token
);
$configs = array(
		'token' => $token,
		'cache' => array(
				'last_cache' => hash('crc32b', ossn_site_settings('last_cache')),
				'ossn_cache' => ossn_site_settings('cache')
		),
		'lang' => ossn_site_settings('language'),
);
?> 	
	Ossn.site_url = '<?php echo ossn_site_url();?>';
	Ossn.Config = <?php echo json_encode($configs);?>;
	Ossn.Init();
