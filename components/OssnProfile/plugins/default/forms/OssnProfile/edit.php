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
$user = $params['user'];
?>
<div>
	<label> <?php echo ossn_print('first:name'); ?> </label>
	<input type='text' name="firstname" value="<?php echo $user->first_name; ?>"/>
</div>
<div>
	<label> <?php echo ossn_print('last:name'); ?> </label>
	<input type='text' name="lastname" value="<?php echo $user->last_name; ?>"/>
</div>
<div>
	<label> <?php echo ossn_print('username'); ?>  </label>
	<input type='text' name="username" value="<?php echo $user->username; ?>" style="background:#E8E9EA;" readonly="readonly"/>
</div>
<div>
	<label> <?php echo ossn_print('email'); ?> </label>
	<input type='text' name="email" value="<?php echo $user->email; ?>"/>
</div>
<div>
	<label> <?php echo ossn_print('password'); ?>  </label>
	<input type='password' name="password" value=""/>
</div>    
<?php
$fields = ossn_prepare_user_fields($user);
if($fields){
			$vars	= array();
			$vars['items'] = $fields;
			$vars['label'] = true;
			echo ossn_plugin_view('user/fields/item', $vars);
}
?>
<div>
<label><?php echo ossn_print('language');?></label>
<?php
	//profile edit form shows wrong default language #546
	$userlanguage = ossn_site_settings('language');
	echo ossn_plugin_view('input/dropdown', array(
				'name' => 'language',
				'value' => $userlanguage,
				'options' => ossn_get_installed_translations(false),
	));
?>
</div>
<input type="hidden" value="<?php echo $user->username; ?>" name="username"/>
<input type="submit" class="btn btn-primary btn-sm" value="<?php echo ossn_print('save'); ?>"/>
