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
<strong><?php echo $params['entity']->title;?></strong>
<a href="<?php echo $params['entity']->site_url;?>">
	<p class="text-black"><?php echo $params['entity']->description;?></p>
	<div class="ossn-ad-image" style="background:url('<?php echo $params['entity']->getPhotoURL();?>') no-repeat;background-size: contain;"></div>
</a>
