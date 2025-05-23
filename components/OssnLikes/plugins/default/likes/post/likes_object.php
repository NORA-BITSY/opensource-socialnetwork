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

$OssnLikes = new OssnLikes;

$object = $params['object_guid'];;
$count = $OssnLikes->CountLikes($object, 'object');

$user_liked = '';
if (ossn_isLoggedIn()) { 
            if ($OssnLikes->isLiked($object, ossn_loggedin_user()->guid, 'object')) {
                $user_liked = true;
            }
}
/* Likes and comments don't show for nonlogged in users */ 
if($count) {
	foreach($OssnLikes->__likes_get_all as $item){
		$last_three_icons[$item->subtype] = $item->subtype;
	}
	$last_three = array_slice($last_three_icons, -3);
	?>
    <div class="like-share">
<div class="ossn-reaction-list">
	<?php if(isset($last_three['like'])){ ?>
	<li>
		<div class="emoji  emoji--like">
			<div class="emoji__hand">
				<div class="emoji__thumb"></div>
			</div>
		</div>
	</li>
	<?php } ?>  
	<?php if(isset($last_three['dislike'])){ ?>
	<li>
		<div class="emoji  emoji--dislike">
			<div class="emoji__hand">
				<div class="emoji__thumb"></div>
			</div>
		</div>
	</li>
	<?php } ?>            
	<?php if(isset($last_three['love'])){ ?>
	<li>
		<div class="emoji emoji--love">
			<div class="emoji__heart"></div>
		</div>
	</li>
	<?php } ?>
	<?php if(isset($last_three['haha'])){ ?>
	<li>
		<div class="emoji  emoji--haha">
			<div class="emoji__face">
				<div class="emoji__eyes"></div>
				<div class="emoji__mouth">
					<div class="emoji__tongue"></div>
				</div>
			</div>
		</div>
	</li>
	<?php } ?> 
	<?php if(isset($last_three['yay'])){ ?>        
	<li>
		<div class="emoji  emoji--yay">
			<div class="emoji__face">
				<div class="emoji__eyebrows"></div>
				<div class="emoji__mouth"></div>
			</div>
		</div>
	</li>
	<?php } ?>
	<?php if(isset($last_three['wow'])){ ?>
	<li>
		<div class="emoji  emoji--wow">
			<div class="emoji__face">
				<div class="emoji__eyebrows"></div>
				<div class="emoji__eyes"></div>
				<div class="emoji__mouth"></div>
			</div>
		</div>
	</li>
	<?php } ?>
	<?php if(isset($last_three['sad'])){ ?>
	<li>
		<div class="emoji  emoji--sad">
			<div class="emoji__face">
				<div class="emoji__eyebrows"></div>
				<div class="emoji__eyes"></div>
				<div class="emoji__mouth"></div>
			</div>
		</div>
	</li>
	<?php } ?>
	<?php if(isset($last_three['angry'])){ ?>
	<li>
		<div class="emoji  emoji--angry">
			<div class="emoji__face">
				<div class="emoji__eyebrows"></div>
				<div class="emoji__eyes"></div>
				<div class="emoji__mouth"></div>
			</div>
		</div>
	</li>
	<?php } ?>
</div>
    	<span class="ossn-reaction-title-wholiked">
        <?php if ($user_liked == true && $count == 1) { ?>
            <?php echo ossn_print("ossn:liked:you"); ?>
        <?php
        } elseif ($user_liked == true && $count > 1) {
            $count = $count - 1;
            $total = 'person';
            if ($count > 1) {
                $total = 'people';
            }
            $link['onclick'] = "Ossn.ViewLikes({$object}, 'object');";
            $link['href'] = 'javascript:void(0);';
            $link['text'] = ossn_print("ossn:like:{$total}", array($count));
            $link = ossn_plugin_view('output/url', $link);
            echo ossn_print("ossn:like:you:and:this", array($link));
        } elseif (!$user_liked) {
            $total = 'person';
            if ($count > 1) {
                $total = 'people';
            }
            $link['onclick'] = "Ossn.ViewLikes({$object}, 'object');";
            $link['href'] = 'javascript:void(0);';
            $link['text'] = ossn_print("ossn:like:{$total}", array($count));
            $link = ossn_plugin_view('output/url', $link);
            echo ossn_print("ossn:like:this", array($link));
        }?>
        </span>
    </div>
<?php } ?>

