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
 $timestamp = time();
 $token = ossn_generate_action_token($timestamp);
 ?>
 <input type="hidden" name="ossn_ts" value="<?php echo $timestamp;?>" />
 <input type="hidden" name="ossn_token" value="<?php echo $token;?>" />