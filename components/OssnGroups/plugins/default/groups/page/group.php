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
<div class="container">
       	<div class="ossn-layout-contents ossn-layout-group">
       		<?php echo ossn_plugin_view('theme/page/elements/system_messages'); ?>
       		<div class="row">
                 <div class="col-lg-12">
					 <?php echo $params['content']; ?>
                 </div>
             </div>    
        </div> 
	   <?php echo ossn_plugin_view('theme/page/elements/footer');?>                               
</div>
