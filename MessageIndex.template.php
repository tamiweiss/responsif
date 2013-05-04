<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.0
 */

function template_main()
{
	global $context, $settings, $options, $scripturl, $modSettings, $txt;

	echo '
	<a id="top"></a>';?>
	<h2 class="ForumName"><?php echo $context['name']; ?></h2>
	<?php 
	if (!empty($options['show_board_desc']) && $context['description'] != '')
		echo '
	<p class="desc OverallDesc">', $context['description'], '</p>';
	

	if (!empty($context['boards']) && (!empty($options['show_children']) || $context['start'] == 0))
	{
		?>
						
        <div class="SectionContainer" id="board_<?php echo $context['current_board'];?>_childboards">
            <table id="ChildForums" class="Forum">
                <thead class="TopicListHead">
                    <tr>
                        <th class="ForumName">Child Forums</th>
                        <th class="Topics">Topics</th>
						<th class="Posts">Posts</th>
						<th class="LastPost">Last Post</th>
					</tr>
					</thead>
                </thead>
                <tbody id="board_<?php $context['current_board'];?>_children">
                <?php
                foreach ($context['boards'] as $board)
                    {?>                                
                        <tr id="board_'<?php echo $board['id'];?>">
                            <td class="ForumName">
                                <a class="subject" href="<?php echo $board['href'];?>" name="b'<?php echo $board['id']?>">
                                    <h3> <?php echo $board['name']; ?></h3>
                                    <p class="desc"><?php echo $board['description']; ?> </p>
                                     <?php if (!empty($board['moderators']))
                                        echo '
                                            <!-- <p class="moderators">', count($board['moderators']) == 1 ? $txt['moderator'] : $txt['moderators'], ': ', implode(', ', $board['link_moderators']), '</p> -->'; /* commented out moderators, not sure if I want them showing here */ ?>
                                                        <?php // Has it outstanding posts for approval?
                                    if ($board['can_approve_posts'] && ($board['unapproved_posts'] || $board['unapproved_topics']))
                                        echo '
                                            <a href="', $scripturl, '?action=moderate;area=postmod;sa=', ($board['unapproved_topics'] > 0 ? 'topics' : 'posts'), ';brd=', $board['id'], ';', $context['session_var'], '=', $context['session_id'], '" title="', sprintf($txt['unapproved_posts'], $board['unapproved_topics'], $board['unapproved_posts']), '" class="moderation_link">(!)</a>'; ?>
                                </a>
                            </td>
                            <td class="Topics">
                                <?php echo comma_format($board['topics']); ?><span></span>
                            </td>
                            <td class="Posts">
                                <?php echo comma_format($board['posts']); ?>
                            </td>
                            <td class="LastPost">
                            	<span></span>
                                <?php if (!empty($board['last_post']['id'])) { ?>
                                <time datetime="<?php /* this might work @getdate($time)*/ echo $board['last_post']['time']; ?>"><?php echo $board['last_post']['time']; ?></time> <span class="Author">by <a href="<?php echo $board['last_post']['href'] ?>"> <?php echo $board['last_post']['member']['name']; ?></a>
                                </span>
                                <?php } ?>
                            </td>           
                        </tr><?php
                        if (!empty($board['children']))
			{
				// Sort the links into an array with new boards bold so it can be imploded.
				$children = array();
				/* Each child in each board's children has:
						id, name, description, new (is it new?), topics (#), posts (#), href, link, and last_post. */
				foreach ($board['children'] as $child)
				{
					if (!$child['is_redirect'])
						$child['link'] = '<a href="' . $child['href'] . '" ' . ($child['new'] ? 'class="new_posts" ' : '') . 'title="' . ($child['new'] ? $txt['new_posts'] : $txt['old_posts']) . ' (' . $txt['board_topics'] . ': ' . comma_format($child['topics']) . ', ' . $txt['posts'] . ': ' . comma_format($child['posts']) . ')">' . $child['name'] . ($child['new'] ? '</a> <a href="' . $scripturl . '?action=unread;board=' . $child['id'] . '" title="' . $txt['new_posts'] . ' (' . $txt['board_topics'] . ': ' . comma_format($child['topics']) . ', ' . $txt['posts'] . ': ' . comma_format($child['posts']) . ')"><img src="' . $settings['lang_images_url'] . '/new.gif" class="new_posts" alt="" />' : '') . '</a>';
					else
						$child['link'] = '<a href="' . $child['href'] . '" title="' . comma_format($child['posts']) . ' ' . $txt['redirects'] . '">' . $child['name'] . '</a>';

					// Has it posts awaiting approval?
					if ($child['can_approve_posts'] && ($child['unapproved_posts'] | $child['unapproved_topics']))
						$child['link'] .= ' <a href="' . $scripturl . '?action=moderate;area=postmod;sa=' . ($child['unapproved_topics'] > 0 ? 'topics' : 'posts') . ';brd=' . $child['id'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . sprintf($txt['unapproved_posts'], $child['unapproved_topics'], $child['unapproved_posts']) . '" class="moderation_link">(!)</a>';

					$children[] = $child['new'] ? '<strong>' . $child['link'] . '</strong>' : $child['link'];
				}
				echo '
				<tr id="board_', $board['id'], '_children"><td colspan="4" class="children windowbg"><strong>', $txt['parent_boards'], '</strong>: ', implode(', ', $children), '</td></tr>';
			}
                        
                 } ?>
                
                    </tbody>
                </table>
             </div><!-- div.SectionContainer -->
	<?php }  		

	
	
	
	

	// Create the button set...
	$normal_buttons = array(
		'new_topic' => array('test' => 'can_post_new', 'text' => 'new_topic', 'image' => 'new_topic.gif', 'lang' => true, 'url' => $scripturl . '?action=post;board=' . $context['current_board'] . '.0', 'active' => true),
		'post_poll' => array('test' => 'can_post_poll', 'text' => 'new_poll', 'image' => 'new_poll.gif', 'lang' => true, 'url' => $scripturl . '?action=post;board=' . $context['current_board'] . '.0;poll'),
		'notify' => array('test' => 'can_mark_notify', 'text' => $context['is_marked_notify'] ? 'unnotify' : 'notify', 'image' => ($context['is_marked_notify'] ? 'un' : ''). 'notify.gif', 'lang' => true, 'custom' => 'onclick="return confirm(\'' . ($context['is_marked_notify'] ? $txt['notification_disable_board'] : $txt['notification_enable_board']) . '\');"', 'url' => $scripturl . '?action=notifyboard;sa=' . ($context['is_marked_notify'] ? 'off' : 'on') . ';board=' . $context['current_board'] . '.' . $context['start'] . ';' . $context['session_var'] . '=' . $context['session_id']),
		'markread' => array('text' => 'mark_read_short', 'image' => 'markread.gif', 'lang' => true, 'url' => $scripturl . '?action=markasread;sa=board;board=' . $context['current_board'] . '.0;' . $context['session_var'] . '=' . $context['session_id']),
	);

	// They can only mark read if they are logged in and it's enabled!
	if (!$context['user']['is_logged'] || !$settings['show_mark_read'])
		unset($normal_buttons['markread']);

	// Allow adding new buttons easily.
	call_integration_hook('integrate_messageindex_buttons', array(&$normal_buttons));

	if (!$context['no_topic_listing'])
	{
		echo '
	<div class="buttonsection top">
		', template_button_strip($normal_buttons, 'left'), '
	</div>';
	
	

		// If Quick Moderation is enabled start the form.
		if (!empty($context['can_quick_mod']) && $options['display_quick_mod'] > 0 && !empty($context['topics']))
			echo '
	<form action="', $scripturl, '?action=quickmod;board=', $context['current_board'], '.', $context['start'], '" method="post" accept-charset="', $context['character_set'], '" class="clear" name="quickModForm" id="quickModForm">';

		?>
	<div class="SectionContainer" id="MessageIndex">
            <table id="TopicList" class="Forum">
                <thead class="TopicListHead">
                    <tr>
                     
                   
<?php 
		// Are there actually any topics to show?
		if (!empty($context['topics']))
		{?>
						<th class="TopicName">Topics</th>
                        <th class="Replies">Replies</th>
                        <th class="Views">Views</th>
                        <th class="LastPost">Last Updated</th>
			<?php
			// Show a "select all" box for quick moderation?
			/*if (empty($context['can_quick_mod']))
				echo '
					<th scope="col" class=""><a href="', $scripturl, '?board=', $context['current_board'], '.', $context['start'], ';sort=last_post', $context['sort_by'] == 'last_post' && $context['sort_direction'] == 'up' ? ';desc' : '', '">', $txt['last_post'], $context['sort_by'] == 'last_post' ? ' <img src="' . $settings['images_url'] . '/sort_' . $context['sort_direction'] . '.gif" alt="" />' : '', '</a></th>';
			else
				echo '
					<th scope="col" class=""><a href="', $scripturl, '?board=', $context['current_board'], '.', $context['start'], ';sort=last_post', $context['sort_by'] == 'last_post' && $context['sort_direction'] == 'up' ? ';desc' : '', '">', $txt['last_post'], $context['sort_by'] == 'last_post' ? ' <img src="' . $settings['images_url'] . '/sort_' . $context['sort_direction'] . '.gif" alt="" />' : '', '</a></th>'; 

			// Show a "select all" box for quick moderation?
			if (!empty($context['can_quick_mod']) && $options['display_quick_mod'] == 1)
				echo '
					<th scope="col" class="last_th" width="24"><input type="checkbox" onclick="invertAll(this, this.form, \'topics[]\');" class="input_check" /></th>';

			// If it's on in "image" mode, don't show anything but the column.
			elseif (!empty($context['can_quick_mod']))
				echo '
					<th class="last_th" width="4%">&nbsp;</th>';
		}*/
		// No topics.... just say, "sorry bub".
		}
		else
			echo '<th colspan="4"><strong>', $txt['msg_alert_none'], '</strong></th>';

		echo '
				</tr>
			</thead>
			<tbody>';
			
			
			
			

		if (!empty($settings['display_who_viewing']))
		{
			echo '
				<tr class="whos_viewing">
					<td colspan="', !empty($context['can_quick_mod']) ? '6' : '5', '" class="smalltext">';
			if ($settings['display_who_viewing'] == 1)
				echo count($context['view_members']), ' ', count($context['view_members']) === 1 ? $txt['who_member'] : $txt['members'];
			else
				echo empty($context['view_members_list']) ? '0 ' . $txt['members'] : implode(', ', $context['view_members_list']) . ((empty($context['view_num_hidden']) or $context['can_moderate_forum']) ? '' : ' (+ ' . $context['view_num_hidden'] . ' ' . $txt['hidden'] . ')');
			echo $txt['who_and'], $context['view_num_guests'], ' ', $context['view_num_guests'] == 1 ? $txt['guest'] : $txt['guests'], $txt['who_viewing_board'], '
					</td>
				</tr>';
		}







		// If this person can approve items and we have some awaiting approval tell them.
		/*if (!empty($context['unapproved_posts_message']))
		{
			echo '
				<tr class="windowbg2">
					<td colspan="', !empty($context['can_quick_mod']) ? '6' : '5', '">
						<span class="alert">!</span> ', $context['unapproved_posts_message'], '
					</td>
				</tr>';
		}*/

		foreach ($context['topics'] as $topic)
		{
			// Is this topic pending approval, or does it have any posts pending approval?
			if ($context['can_approve_posts'] && $topic['unapproved_posts'])
				$color_class = !$topic['approved'] ? 'approvetbg' : 'approvebg';
			// We start with locked and sticky topics.
			elseif ($topic['is_sticky'] && $topic['is_locked'])
				$color_class = 'stickybg locked_sticky';
			// Sticky topics should get a different color, too.
			elseif ($topic['is_sticky'])
				$color_class = 'stickybg';
			// Locked topics get special treatment as well.
			elseif ($topic['is_locked'])
				$color_class = 'lockedbg';
			// Last, but not least: regular topics.
			else
				$color_class = '';

			// Some columns require a different shade of the color class.
			$alternate_class = $color_class . '2';

			echo '
				<tr>';
					/*<td class="ForumName ', $color_class, '">
						<img src="', $settings['images_url'], '/topic/', $topic['class'], '.gif" alt="" />
					</td>
					<td class="icon2 ', $color_class, '">
						<img src="', $topic['first_post']['icon_url'], '" alt="" />
					</td>*/
            echo '	<td class="TopicName ', $color_class,'">'; ?>
						<a class="subject" href="<?php echo $topic['first_post']['href'] ?>">
                            <h3> <?php echo $topic['subject'] ?> 
                          <?php  if ($topic['new'] && $context['user']['is_logged'])
					echo '<img src="', $settings['lang_images_url'], '/new.gif" alt="', $txt['new'], '" />';?>
                            
                            </h3> 
                            <span class="TopicPoster">started by <?php echo $topic['first_post']['member']['name']; ?></span>
                        </a>

						
					</td>
                    <td class="Replies <?php echo $color_class;?>">
						<?php echo comma_format($topic['replies']); ?> <span></span>
                     </td>
                     <td class="Views <?php echo $color_class;?>">
                        <?php echo comma_format($topic['views']); ?>
                     </td>
                     <td class="LastPost <?php echo $color_class;?>"">
                     			<span></span>
                             	<time datetime="<?php /* this might work @getdate($time)*/ echo $topic['last_post']['time'] ?>"><?php echo $topic['last_post']['time']; ?></time> <span class="Author">by <a href="<?php echo $topic['last_post']['href']; ?>"> <?php echo $topic['last_post']['member']['name']; ?></a>
                        
                     </td>
                   
		<?php	// Show the quick moderation options?
		
			echo '
				</tr>';
		} ?>
				<tr class="Pages">
                	<td colspan="4">
        <?php echo            	'<div class="pagelinks">', $txt['pages'], ': ', $context['page_index'], !empty($modSettings['topbottomEnable']) ? $context['menu_separator'] . '&nbsp;&nbsp;<a href="#top"><strong>' . $txt['go_up'] . '</strong></a>' : '', '</div>'; ?>
                    </td>
                </tr>
		
			</tbody>
		</table>
	</div><!-- div.SiteContainer -->
	<a id="bot"></a>

		
        <?php
		echo '
	<div class="buttonsection bottom">
		', template_button_strip($normal_buttons, ''), '
		
	</div>';
	}

	// Show breadcrumbs at the bottom too.
	theme_linktree();

	echo '
	<div class="tborder" id="topic_icons">
		<div class="description">
			<p class="floatright" id="message_index_jump_to">&nbsp;</p>';

	echo '
			<script type="text/javascript"><!-- // --><![CDATA[
				if (typeof(window.XMLHttpRequest) != "undefined")
					aJumpTo[aJumpTo.length] = new JumpTo({
						sContainerId: "message_index_jump_to",
						sJumpToTemplate: "<label class=\"smalltext\" for=\"%select_id%\">', $context['jump_to']['label'], ':<" + "/label> %dropdown_list%",
						iCurBoardId: ', $context['current_board'], ',
						iCurBoardChildLevel: ', $context['jump_to']['child_level'], ',
						sCurBoardName: "', $context['jump_to']['board_name'], '",
						sBoardChildLevelIndicator: "==",
						sBoardPrefix: "=> ",
						sCatSeparator: "-----------------------------",
						sCatPrefix: "",
						sGoButtonLabel: "', $txt['quick_mod_go'], '"
					});
			// ]]></script>
			<br class="clear" />
		</div>
	</div>';

	// Javascript for inline editing.
	echo '
<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/topic.js"></script>
<script type="text/javascript"><!-- // --><![CDATA[

	// Hide certain bits during topic edit.
	hide_prefixes.push("lockicon", "stickyicon", "pages", "newicon");

	// Use it to detect when we\'ve stopped editing.
	document.onclick = modify_topic_click;

	var mouse_on_div;
	function modify_topic_click()
	{
		if (in_edit_mode == 1 && mouse_on_div == 0)
			modify_topic_save("', $context['session_id'], '", "', $context['session_var'], '");
	}

	function modify_topic_keypress(oEvent)
	{
		if (typeof(oEvent.keyCode) != "undefined" && oEvent.keyCode == 13)
		{
			modify_topic_save("', $context['session_id'], '", "', $context['session_var'], '");
			if (typeof(oEvent.preventDefault) == "undefined")
				oEvent.returnValue = false;
			else
				oEvent.preventDefault();
		}
	}

	// For templating, shown when an inline edit is made.
	function modify_topic_show_edit(subject)
	{
		// Just template the subject.
		setInnerHTML(cur_subject_div, \'<input type="text" name="subject" value="\' + subject + \'" size="60" style="width: 95%;" maxlength="80" onkeypress="modify_topic_keypress(event)" class="input_text" /><input type="hidden" name="topic" value="\' + cur_topic_id + \'" /><input type="hidden" name="msg" value="\' + cur_msg_id.substr(4) + \'" />\');
	}

	// And the reverse for hiding it.
	function modify_topic_hide_edit(subject)
	{
		// Re-template the subject!
		setInnerHTML(cur_subject_div, \'<a href="', $scripturl, '?topic=\' + cur_topic_id + \'.0">\' + subject + \'<\' +\'/a>\');
	}

// ]]></script>';
}

?>