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
$new_all    = ossn_chat()->getNewAll(array(
		'message_from'
));
$allfriends = OssnChat::AllNew();

$active_sessions = OssnChat::GetActiveSessions();

$construct_active = NULL;
$new_messages     = NULL;

if($active_sessions) {
		foreach($active_sessions as $friend) {
				$messages = ossn_chat()->getNew($friend, ossn_loggedin_user()->guid);
				if($messages) {
						foreach($messages as $message) {
								if(ossn_loggedin_user()->guid == $message->message_from) {
										$vars['message'] = $message->message;
										$vars['time']    = $message->time;
										$vars['id']      = $message->id;
										$vars['instance'] = (clone $message);
										$messageitem     = ossn_plugin_view('chat/message-item-send', $vars);
								} else {
										$vars['reciever'] = ossn_user_by_guid($message->message_from);
										$vars['message']  = $message->message;
										$vars['time']     = $message->time;
										$vars['id']       = $message->id;
										$vars['instance'] = (clone $message);
										$messageitem      = ossn_plugin_view('chat/message-item-received', $vars);
								}
								$new_messages[] = array(
										'fid' => $friend,
										'id' => $message->id,
										'message' => $messageitem,
										'total' => count($messages)
								);
						}
				}
				
				if(OssnChat::getChatUserStatus($friend, 10) == 'online') {
						$status = 'ossn-chat-icon-online';
				} else {
						$status = 'ossn-chat-icon-offline';
				}
				$construct_active[$friend] = array(
						'status' => $status
				);
		}
}
if(isset($new_messages)){
	foreach($new_messages as $item) {
		$messages_items[$item['fid']][] = array(
				'id' => $item['id'],
				'fid' => $item['fid'],
				'message' => $item['message'],
				'total' => $item['total']
		);
	}
}
$messages_combined = array();
if(isset($messages_items)){
	foreach($messages_items as $key => $mitem) {
		$messages_combined[] = array(
				'message' => $mitem,
				'total' => $mitem[0]['total'],
				'fid' => $key
		);
	}
}
$api = json_encode(array(
		'active_friends' => $construct_active,
		'allfriends' => $allfriends,
		'friends' => array(
				'online' => ossn_chat()->countOnlineFriends('', 10),
				'data' => ossn_plugin_view('chat/friendslist')
		),
		'newmessages' => $messages_combined,
		'all_new' => $new_all
		
));

echo 'var OssnChat = ';
echo preg_replace('/[ ]{2,}/', ' ', $api);
echo ';';
?>
/** <script> **/
/**
 * Count Online friends and put then in friends list
 *
 * @params OssnChat['friends'] Array
 */
$friends_online = $('.ossn-chat-online-friends-count').find('span');

//we can not relay on online friends count because what if user add one new firend and remove other the count is still same.
//resulting in not showing new friend so below three lines are not required will be removed from reference as well.
//if (OssnChat['friends']['online'] > $friends_online.text() || OssnChat['friends']['online'] < $friends_online.text()) {
//$('.friends-list').find('.data').html(OssnChat['friends']['data']);
//}
$friends_online.html(OssnChat['friends']['online']);

/**
 * Reset the user status
 *
 * @params OssnChat['active_friends'] Array
 */
if (OssnChat['active_friends']) {
	$.each(OssnChat['active_friends'], function(key, data) {
		$('#ossnchat-ustatus-' + key).attr('class', data['status']);
		if(data['status'] == 'ossn-chat-icon-online'){
			$('#ossn-inchat-status-' + key).attr('class', 'ossn-inchat-status-circle ossn-inchat-status-online');
		}
		if(data['status'] == 'ossn-chat-icon-offline'){
			$('#ossn-inchat-status-' + key).attr('class', 'ossn-inchat-status-circle ossn-inchat-status-offline');
		}		
	});
}
/**
 * Add all friends in sidebar
 *
 * @params OssnChat['active_friends'] Array
 */
if (OssnChat['allfriends']) {
	var prependata = '';
	$('.friends-list-item').remove();
	$.each(OssnChat['allfriends'], function(key, data) {
			prependata += '<div data-toggle="tooltip" title="' + data['name'] + '" class="friends-list-item" id="friend-list-item-' + data['guid'] + '" onClick="Ossn.ChatnewTab(' + data['guid'] + ');"><div class="friends-item-inner"><div class="icon"><img class="user-icon-small ustatus ossn-chat-icon-online" src="' + data['icon'] + '" /></div></div></div>';
	});
	
	//[B] online friends being removed from Chat tab #2309
	if(prependata){
		$('.friends-list').find('.data').html(OssnChat['friends']['data']);	
	}
	if(prependata != ''){
		$(".ossn-chat-windows-long .inner").find('.ossn-chat-none').hide();
			if ($('.ossn-chat-pling').length) {
					$(".ossn-chat-windows-long .inner .ossn-chat-pling").after(prependata);
			} else {
					$(".ossn-chat-windows-long .inner").prepend(prependata);
			}	
	}
	$('[data-toggle="tooltip"]').tooltip({
		placement: 'left',
	});
} else {
	$('.friends-list-item').remove();	
	$(".ossn-chat-windows-long .inner").find('.ossn-chat-none').show();	
}

/**
 * Check if there is new message then put them in tab
 *
 * @params OssnChat['newmessages'] Array
 */
if (OssnChat['newmessages']) {
	$.each(OssnChat['newmessages'], function(key, data) {
		if ($('.ossn-chat-base').find('#ftab-i' + data['fid']).length) {
			$totalelement = $('#ftab-i' + data['fid']).find('.ossn-chat-new-message');
			$texa = $('#ftab-i' + data['fid']).find('.ossn-chat-new-message').text();
			if (data['total'] > 0) {
				$.each(data['message'], function(ikey, item) {
					if ($('#ossn-message-item-' + item['id']).length == 0) {
						$('#ftab-i' + data['fid']).find('.data').append(item['message']);
					}
				})

				if ($('.ossn-chat-base').find('#ftab-i' + data['fid']).find('.tab-container').is(":not(:visible)")) {
					$('#ftab-i' + data['fid']).find('#ftab' + data['fid']).addClass('ossn-chat-tab-active');
					$totalelement.html(data['total']);
					$totalelement.show();
				} else {
					$totalelement.empty();
					Ossn.ChatMarkViewed(data['fid']);
				}
				if ($texa != data['total']) {
					Ossn.ChatplaySound();
				}
				Ossn.ChatScrollMove(data['fid']);

				//chat linefeed problem #278.
				// move scroll once again when div is loaded fully
				$("#ossn-chat-messages-data-" + data['fid']).on('load', function() {
					Ossn.ChatScrollMove(data['fid']);
				});

			}

		}
	});
}
/**
 * Open new tab on new message
 *
 * @params OssnChat['all_new'] Array
 */
if (OssnChat['all_new']) {
	$.each(OssnChat['all_new'], function(key, data) {
		if ($(".ossn-chat-containers").children(".friend-tab-item").length <= 2) {
			var $friend = data['message_from'];
			Ossn.ChatnewTab($friend);
			if (!$('#ftab-i' + $friend)) {
				Ossn.ChatplaySound();
				Ossn.ChatScrollMove(data['message_from']);
			}
		}
	});
}
