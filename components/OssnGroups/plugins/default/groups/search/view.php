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
if ($params['groups']) {
	echo "<div class='group-search-items'>";
    foreach ($params['groups'] as $group) {
		$owner = ossn_user_by_guid($group->owner_guid);
        ?>
		
        <div class="row">
        	<div class="col-lg-2 col-sm-2 col-4">
	            <img src="<?php echo ossn_site_url("components/OssnGroups/images/search_group.png"); ?>" width="100" height="100"/>
            </div>
			<div class="col-lg-10 col-sm-10 col-8">
	            <div class="group-search-details">
    	            <a class="group-name" href="<?php echo ossn_site_url(); ?>group/<?php echo $group->guid; ?>"><?php echo $group->title; ?></a>
        	        <p class="ossn-group-search-by"><?php echo ossn_print('ossn:group:by');?><a href="<?php echo $owner->profileURL();?>"><?php echo $owner->fullname;?></a></p>
           	 	</div>
			</div>

        </div>


    <?php
    }
	echo "</div>";
}
?>
