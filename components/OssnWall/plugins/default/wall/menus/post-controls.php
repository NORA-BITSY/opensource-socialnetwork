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
$postcontrols = $params['menu'];
if($postcontrols){
?>
<a role="button" data-bs-toggle="dropdown" class="btn btn-link" data-bs-target="#">
	<i class="fa fa fa-ellipsis-h"></i>
</a>
<ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="dropdownMenu">
            <?php
                foreach ($postcontrols as $menu) {
                    foreach ($menu as $link) {
					 	$class = "dropdown-item post-control-".$link['name'];
					 	if(isset($link['class'])){
							$link['class'] = $class.' '.$link['class'];	
						} else {
							$link['class'] = $class;
						}						
						unset($link['name']);
						$link = ossn_plugin_view('output/url', $link);						
                        ?>
                        <li><?php echo $link; ?></li>
                    <?php
                    }
                }
            ?>
    </ul>
<?php 
}
