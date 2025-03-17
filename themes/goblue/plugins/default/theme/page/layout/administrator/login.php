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
<div class="ossn-layout-admin">
	<?php echo ossn_plugin_view('theme/page/elements/system_messages', array(
						'admin' => true
	  	  )); 
	?>    
	<div class="row">
    	<div class="col-lg-12 contents">
    	 	<?php echo $params['contents']; ?>
    	</div>
	</div>
</div>    