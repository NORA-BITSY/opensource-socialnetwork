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
 $description = json_decode($params['post']->description);
 $description = $description->post;
 ?>
 <div>
 	<textarea id="post-edit" name="post"><?php echo $description;?></textarea>
    <input type="hidden"  name="guid" value="<?php echo $params['post']->guid;?>" />
    <input type="submit" class="hidden" id="ossn-post-edit-save" />
 </div>
