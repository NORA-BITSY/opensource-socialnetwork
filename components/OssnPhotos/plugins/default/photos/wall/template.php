<?php
/**
 * Boatable Technologies LLC
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

$album = ossn_get_object($params['post']->item_guid);
if(!$album) {
		return;
}
$photos_guid = $params['post']->photos_guids;
$count  	 = count(explode(',', $photos_guid));

$photos		 = new \OssnPhotos();
$photos      = $photos->searchPhotos(array(
		'wheres' => "e.guid IN({$photos_guid})",
		'page_limit' => 17,
));
$total       = count((array) $photos);
$container   = 'ossn-photos-wall';

if($total == 1) {
		$container = 'ossn-photos-wall-plain';
}
?>
<div class="ossn-wall-item" id="activity-item-<?php echo $params['post']->guid; ?>">
	<div class="row">
		<div class="meta">
			<img class="user-img user-icon-small" src="<?php echo $params['user']->iconURL()->small; ?>" />
			<div class="post-menu">
				<div class="dropdown">
                 <?php
           			if (ossn_is_hook('wall', 'post:menu') && ossn_isLoggedIn()) {
                		$menu['post'] = $params['post'];
               			echo ossn_call_hook('wall', 'post:menu', $menu);
            			}
            		?>   
				</div>
			</div>
			<div class="user">
           <?php if ($params['user']->guid == $params['post']->owner_guid) { ?>
                <?php
				echo ossn_plugin_view('output/user/url', array(
						'user' => $params['user'],		
						'section' => 'wall',
				));
				?>
                <div class="ossn-wall-item-type ossn-photos-wall-title"><a target="_blank" href="<?php echo ossn_site_url("album/view/{$album->guid}");?>"><i class="fa fa-camera"></i><?php echo $album->title;?></a></div>
            <?php } ?>
			</div>
			<div class="post-meta">
				<span class="time-created ossn-wall-post-time" title="<?php echo date('d/m/Y', $params['post']->time_created);?>" onclick="Ossn.redirect('<?php echo("post/view/{$params['post']->guid}");?>');"><?php echo ossn_user_friendly_time($params['post']->time_created); ?></span>
				<?php
					echo ossn_plugin_view('privacy/icon/view', array(
							'privacy' => $params['post']->access,
							'text' => '-',
							'class' => 'time-created',
					));
				?>                
			</div>
		</div>

       <div class="post-contents <?php echo $container;?>">
				<?php
					if($photos > 0){
							foreach($photos as $photo){
									$url  = $photo->getURL('album');		
									if($total > 2){
											$class = 'ossn-photo-wall-item-small';	
									} else {
											$class = 'ossn-photo-wall-item-medium';											
									}
									$view = "<a target='_blank' href='".ossn_site_url("photos/view/{$photo->guid}")."'><img class='img-thumbnail ossn-photos-wall-item {$class}' src='{$url}' /></a>";
									
									if($total == 1){
										$url  = $photo->getURL().'?size=view';
										$url  = ossn_add_cache_to_url($url);
										$view = "<a target='_blank' href='".ossn_site_url("photos/view/{$photo->guid}")."'><img class='img-thumbnail' src='{$url}' /></a>";
									}
									echo $view;
							}
							if($count > 17){
										$url  = ossn_site_url("/components/OssnPhotos/images/more.jpg");	
										$url  = ossn_add_cache_to_url($url);
										echo "<a target='_blank' href='".ossn_site_url("album/view/{$album->guid}")."'><img class='img-thumbnail ossn-photos-wall-item ossn-photo-wall-item-small' src='{$url}' /></a>";								
							}
					}
					if(!$photos){
								$url  = ossn_site_url("/components/OssnPhotos/images/nophoto-album.png");	
								$url  = ossn_add_cache_to_url($url);
								$view = "<img class='img-thumbnail' src='{$url}' />";		
								echo $view;
					}
				?>
    	</div>      
	</div>
</div>
