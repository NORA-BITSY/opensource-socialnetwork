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
$users = $params['users'];
if (!isset($params['icon_size'])) {
    $avatar_size = 'large';
} else {
    $avatar_size = $params['icon_size'];
}
$sizes = array('large', 'larger', 'small', 'topbar');
foreach ($users as $user) {
	if(isset($avatar_size) && in_array($avatar_size, $sizes)){
		$icon = $user->iconURL()->$avatar_size;
	}	 else {
		$icon = $user->iconURL()->small;
	}
    ?>

    <div class="ossn-list-users">
        <img class="user-icon-<?php echo $avatar_size;?>" src="<?php echo $icon; ?>"/>

        <div class="uinfo">
            <?php
			echo ossn_plugin_view('output/user/url', array(
					'user' => $user,			
					'class' => 'userlink',
					'section' => 'output/users/list',
			));
			?>
        </div>
        <?php if (ossn_isLoggedIn()) { ?>
            <?php if (ossn_loggedin_user()->guid !== $user->guid) {
                if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) {
                    if (ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)) {
                        ?>
          <a href="<?php echo ossn_site_url("action/friend/remove?cancel=true&user={$user->guid}", true); ?>"
                               class='button-grey friendlink'>
                                <?php echo ossn_print('cancel:request'); ?>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo ossn_site_url("action/friend/add?user={$user->guid}", true); ?>"
                               class='button-grey friendlink'>
                                <?php echo ossn_print('add:friend'); ?>
                            </a>
                        <?php
                        }
                    } else {
                        ?>
                        <a href="<?php echo ossn_site_url("action/friend/remove?user={$user->guid}", true); ?>"
                           class='button-grey friendlink'>
                            <?php echo ossn_print('remove:friend'); ?>
                        </a>
                <?php
                }

            }
        }?>
    </div>


<?php } ?>