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
<div class="reset-notice"><?php echo ossn_print('enter:emai:reset:pwd'); ?></div>
<input type="text" name="email" />
<div>
		<?php echo ossn_fetch_extend_views('forms/resetlogin/before/submit'); ?>
</div>
<input type="submit" class="btn btn-primary btn-sm" value="<?php echo ossn_print('reset'); ?>"/>