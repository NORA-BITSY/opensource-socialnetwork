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
?>
<div>
    <label><?php echo ossn_print('username'); ?> </label>
    <input type="text" name="username"/>
</div>

<div>
    <label> <?php echo ossn_print('password'); ?> </label>
    <input type="password" name="password" autocomplete="off" />
</div>

<input type="submit" value="<?php echo ossn_print('site:login');?>" class="ossn-button ossn-button-submit"/>
<br/>
<a href="<?php echo ossn_site_url('resetlogin'); ?>"><?php echo ossn_print('reset:password'); ?></a>
