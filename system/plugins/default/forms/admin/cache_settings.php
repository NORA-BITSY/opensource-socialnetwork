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
$cache = ossn_site_settings('cache');
if ($cache == 1) {
    $enabled = 'selected';
    $disabled = '';
} elseif ($cache == 0) {
    $disabled = 'selected';
    $enabled = '';
}
?>
<label><?php echo ossn_print('admin:basiccache');?></label>
<strong> Status : <?php echo ossn_print("cache:{$cache}"); ?> </strong>

<div class="margin-top-10">
	<select name="cache">
   	 	<option value="1" <?php echo $enabled; ?>> <?php echo ossn_print('cache:enable'); ?> </option>
   	 	<option value="0" <?php echo $disabled; ?>> <?php echo ossn_print('cache:disable'); ?>  </option>
	</select>
</div>
<div>
	<input type="submit" class="btn btn-primary btn-sm" value="<?php echo ossn_print('save'); ?>"/>
</div>    
<div class="alert alert-info page-botton-notice">
    <?php echo ossn_print('cache:notice'); ?>
</div>