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
<div class="container">
	<div class="ossn-layout-media">
       <?php echo ossn_plugin_view('theme/page/elements/system_messages'); ?>    
			<div class="row">
				<div class="col-lg-8">
					<div class="content">
						<?php echo $params['content']; ?>
					</div>
				</div>
				<div class="col-lg-3">
					<?php if (ossn_is_hook( 'theme', 'sidebar:right')) { ?>
						<div class="page-sidebar">
						<?php
						$modules = ossn_call_hook('theme', 'sidebar:right', null); 
						echo implode( '', $modules);
						?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
 	 <?php echo ossn_plugin_view('theme/page/elements/footer');?> 
</div>
