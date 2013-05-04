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
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	// Show some statistics if stat info is off.
	if (!$settings['show_stats_index'])
		echo '
		
	<div id="index_common_stats">
		', $txt['members'], ': ', $context['common_stats']['total_members'], ' &nbsp;&#8226;&nbsp; ', $txt['posts_made'], ': ', $context['common_stats']['total_posts'], ' &nbsp;&#8226;&nbsp; ', $txt['topics'], ': ', $context['common_stats']['total_topics'], '
		', ($settings['show_latest_member'] ? ' ' . $txt['welcome_member'] . ' <strong>' . $context['common_stats']['latest_member']['link'] . '</strong>' . $txt['newest_member'] : '') , '
	</div>';

	// Show the news fader?  (assuming there are things to show...)
	if ($settings['show_newsfader'] && !empty($context['fader_news_lines']))
	{
		echo '
	<div id="newsfader">
		<div class="cat_bar">
			<h3 class="catbg">
				<img id="newsupshrink" src="', $settings['images_url'], '/collapse.gif" alt="*" title="', $txt['upshrink_description'], '" align="bottom" style="display: none;" />
				', $txt['news'], '
			</h3>
		</div>
		<ul class="reset" id="smfFadeScroller"', empty($options['collapse_news_fader']) ? '' : ' style="display: none;"', '>';

			foreach ($context['news_lines'] as $news)
				echo '
			<li>', $news, '</li>';

	echo '
		</ul>
	</div>
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/fader.js"></script>
	<script type="text/javascript"><!-- // --><![CDATA[

		// Create a news fader object.
		var oNewsFader = new smf_NewsFader({
			sSelf: \'oNewsFader\',
			sFaderControlId: \'smfFadeScroller\',
			sItemTemplate: ', JavaScriptEscape('<strong>%1$s</strong>'), ',
			iFadeDelay: ', empty($settings['newsfader_time']) ? 5000 : $settings['newsfader_time'], '
		});

		// Create the news fader toggle.
		var smfNewsFadeToggle = new smc_Toggle({
			bToggleEnabled: true,
			bCurrentlyCollapsed: ', empty($options['collapse_news_fader']) ? 'false' : 'true', ',
			aSwappableContainers: [
				\'smfFadeScroller\'
			],
			aSwapImages: [
				{
					sId: \'newsupshrink\',
					srcExpanded: smf_images_url + \'/collapse.gif\',
					altExpanded: ', JavaScriptEscape($txt['upshrink_description']), ',
					srcCollapsed: smf_images_url + \'/expand.gif\',
					altCollapsed: ', JavaScriptEscape($txt['upshrink_description']), '
				}
			],
			oThemeOptions: {
				bUseThemeSettings: ', $context['user']['is_guest'] ? 'false' : 'true', ',
				sOptionName: \'collapse_news_fader\',
				sSessionVar: ', JavaScriptEscape($context['session_var']), ',
				sSessionId: ', JavaScriptEscape($context['session_id']), '
			},
			oCookieOptions: {
				bUseCookie: ', $context['user']['is_guest'] ? 'true' : 'false', ',
				sCookieName: \'newsupshrink\'
			}
		});
	// ]]></script>';
	} 
	
	
	template_RecentPosts();
}

	function template_RecentPosts() {
		global $context, $settings, $options, $txt, $scripturl, $modSettings;

	
	// Has it outstanding posts for approval? 
	?>
    
    

	
	<div id="boardindex_table">
    <?php if (!empty($settings['number_recent_posts']) && (!empty($context['latest_posts']) || !empty($context['latest_post'])))
	{?>
    
		<h2 class="SectionName" id="CategoryName"><?php echo $txt['RecentTopicsOnBoardIndex_recenttopics'];?></h2>
        <div id="RecentPosts" class="SectionContainer">
				<table class="TopicList">
					<thead class="TopicListHead">
						<tr>
							<th class="TopicName">Topic</th>
							<th class="Posts">Posts</th>
							<th class="Views">Views</th>
							<th class="LastPost">Last Updated</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    foreach ($context['latest_posts'] as $post) {?>
						<tr id="Post<?php echo $post['id'];?>">
                        	<td class="TopicName">
                            	<a class="subject" href="<?php echo $post['topic']['href'];?>">
                                	<h3><a href="<?php echo $post['topic']['href'];?>"><?php echo $post['topic']['subject'];?></a></h3> <span class="FromBoard">started by <?php echo $post['topic']['name']. ' ' .$txt['in']. ' ' . $post['board']['link'];?></span>
                                </a>
                           </td>
                           <td class="Posts">
                             	<?php echo comma_format($post['topic']['posts']); ?><span></span>
                             </td>
                             <td class="Views">
                             	<?php echo comma_format($post['topic']['views']); ?>
                             </td>
                             <td class="LastPost">
                             	<span></span>
                             	<time datetime="<?php /* this might work @getdate($time)*/ echo $post['time']; ?>"><?php echo $post['time'] ?></time> 
                                <span class="Author">by <a href="<?php echo $post['href']; ?>"> <?php echo $post['poster']['name'] ?></a>
                                </span>
                                
                             </td>
                        
                        </tr>
                   
                   
				<?php } ?>
				</tbody>
             </table><!-- table.TopicList -->
            
		</div><!-- div.SectionContainer -->
        
			
	<?php	
	} // end if recent posts . . .
    
	?>
	<?php /* Each category in categories is made up of:
	id, href, link, name, is_collapsed (is it collapsed?), can_collapse (is it okay if it is?), new (is it new?), collapse_href (href to collapse/expand), collapse_image (up/down image), and boards. (see below.)  */
	foreach ($context['categories'] as $category)
	{
		// If theres no parent boards we can see, avoid showing an empty category (unless its collapsed)
		if (empty($category['boards']) && !$category['is_collapsed'])
			continue;
?>
			<h2 class="ForumName" id="CategoryName<?php echo $category['id'];?>"><?php echo $category['name'];?></h2>
			<div class="ForumContainer" id="Category<?php echo $category['id'];?>">
				<table class="Forum">
					<thead class="ForumHead">
						<tr>
							<th class="ForumName">Name</th>
							<th class="Topics">Topics</th>
							<th class="Posts">Posts</th>
							<th class="LastPost">Last Post</th>
						</tr>
					</thead>
					<tbody>
                    <?php 
					foreach ($category['boards'] as $board)
						{ 
					?>
                        <tr id="Board<?php echo $board['id'];?>">
                        	<td class="ForumName">
                            	<a class="subject" href="<?php echo $board['href'];?>" name="b<?php echo $board['id']?>">
                                	<h3> <?php echo $board['name']; ?></h3>
                                    <p class="desc"><?php echo $board['description']; ?></p>
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
                        
                        </tr>
                    <?php
					// tami deleting the childboard stuff, don't plan on using it. May need to re-add if we decide to use it at some point.
						}
					?>
					
					</tbody>		
				
				</table><!-- table.Forum -->
			</div><!-- div.ForumContainer -->
<?php
	} ?>
	
		
	</div><!-- div#boardindex_table -->
<?php
	
	

	template_info_center();
}

function template_info_center()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	// Here's where the "Info Center" starts...
	
	// "Users online" - in order of activity.
	echo '
			<div id="OnlineStats" class="SectionContainer">
				<div class="InnerCont">
					<h2 class="sectionName">',
						$txt['online_users'],
					 $context['show_who'] ? ' <a href="' . $scripturl . '?action=who' . '">' : '', '<img class="icon" src="', $settings['images_url'], '/icons/online.gif', '" alt="', $txt['online_users'], '" />', $context['show_who'] ? '</a>' : '', '
							
					</h2>
			
					<p>
				', $context['show_who'] ? '<a href="' . $scripturl . '?action=who">' : '', comma_format($context['num_guests']), ' ', $context['num_guests'] == 1 ? $txt['guest'] : $txt['guests'], ', ' . comma_format($context['num_users_online']), ' ', $context['num_users_online'] == 1 ? $txt['user'] : $txt['users'];

	// Handle hidden users and buddies.
	$bracketList = array();
	if ($context['show_buddies'])
		$bracketList[] = comma_format($context['num_buddies']) . ' ' . ($context['num_buddies'] == 1 ? $txt['buddy'] : $txt['buddies']);
	if (!empty($context['num_spiders']))
		$bracketList[] = comma_format($context['num_spiders']) . ' ' . ($context['num_spiders'] == 1 ? $txt['spider'] : $txt['spiders']);
	if (!empty($context['num_users_hidden']))
		$bracketList[] = comma_format($context['num_users_hidden']) . ' ' . $txt['hidden'];

	if (!empty($bracketList))
		echo ' (' . implode(', ', $bracketList) . ')';

		echo $context['show_who'] ? '</a><!-- what is this? -->' : '', '
			</p>';
			

	// Assuming there ARE users online... each user in users_online has an id, username, name, group, href, and link.
	if (!empty($context['users_online']))
	{
		echo '
				<h3>', sprintf($txt['users_active'], $modSettings['lastActive']), '</h3>', implode(' : ', $context['list_users_online']);
		echo '<p class="OnlineUsers">';
		// Showing membergroups?
		if (!empty($settings['show_group_key']) && !empty($context['membergroups']))
			echo '
				<br class="2ndbr"/>[' . implode(']&nbsp;&nbsp;[', $context['membergroups']) . ']';
	}

	echo '
			</p>
			<p class="last smalltext">
				', $txt['most_online_today'], ': <strong>', comma_format($modSettings['mostOnlineToday']), '</strong>.
				', $txt['most_online_ever'], ': ', comma_format($modSettings['mostOnline']), ' (', timeformat($modSettings['mostDate']), ')
			</p>';

	// If they are logged in, but statistical information is off... show a personal message bar.
	if ($context['user']['is_logged'] && !$settings['show_stats_index'])
	{
		echo '
			<div class="title_barIC">
				<h4 class="titlebg">
					<span class="ie6_header floatleft">
						', $context['allow_pm'] ? '<a href="' . $scripturl . '?action=pm">' : '', '<img class="icon" src="', $settings['images_url'], '/message_sm.gif" alt="', $txt['personal_message'], '" />', $context['allow_pm'] ? '</a>' : '', '
						<span>', $txt['personal_message'], '</span>
					</span>
				</h4>
			</div>
			<p class="pminfo">
				<strong><a href="', $scripturl, '?action=pm">', $txt['personal_message'], '</a></strong>
				<span class="smalltext">
					', $txt['you_have'], ' ', comma_format($context['user']['messages']), ' ', $context['user']['messages'] == 1 ? $txt['message_lowercase'] : $txt['msg_alert_messages'], '.... ', $txt['click'], ' <a href="', $scripturl, '?action=pm">', $txt['here'], '</a> ', $txt['to_view'], '
				</span>
			</p>';
	}

	echo '
	
			</div><!-- div.InnerCont -->	
		</div><!-- div#OnlineStats -->';

	   

	// Show information about events, birthdays, and holidays on the calendar.
	if ($context['show_calendar'])
	{
		echo '
			<div id="CalendarSum" class="SectionContainer">
				<div class="InnerCont">
					<h2 class="sectionName">'
					, $context['calendar_only_today'] ? $txt['calendar_today'] : $txt['calendar_upcoming'], '
						<a href="', $scripturl, '?action=calendar' . '"><img class="icon" src="', $settings['images_url'], '/icons/calendar.gif', '" alt="', $context['calendar_only_today'] ? $txt['calendar_today'] : $txt['calendar_upcoming'], '" /></a>
					</span>
				</h2>
			
			<p class="smalltext">';

		// Holidays like "Christmas", "Chanukah", and "We Love [Unknown] Day" :P.
		if (!empty($context['calendar_holidays']))
				echo '
				<span class="holiday">', $txt['calendar_prompt'], ' ', implode(', ', $context['calendar_holidays']), '</span><br />';

		// People's birthdays. Like mine. And yours, I guess. Kidding.
		if (!empty($context['calendar_birthdays']))
		{
				echo '
				<span class="birthday">', $context['calendar_only_today'] ? $txt['birthdays'] : $txt['birthdays_upcoming'], '</span> ';
		/* Each member in calendar_birthdays has:
				id, name (person), age (if they have one set?), is_last. (last in list?), and is_today (birthday is today?) */
		foreach ($context['calendar_birthdays'] as $member)
				echo '
				<a href="', $scripturl, '?action=profile;u=', $member['id'], '">', $member['is_today'] ? '<strong>' : '', $member['name'], $member['is_today'] ? '</strong>' : '', isset($member['age']) ? ' (' . $member['age'] . ')' : '', '</a>', $member['is_last'] ? '<br />' : ', ';
		}
		// Events like community get-togethers.
		if (!empty($context['calendar_events']))
		{
			echo '
				<span class="event">', $context['calendar_only_today'] ? $txt['events'] : $txt['events_upcoming'], '</span> ';
			/* Each event in calendar_events should have:
					title, href, is_last, can_edit (are they allowed?), modify_href, and is_today. */
			foreach ($context['calendar_events'] as $event)
				echo '
					', $event['can_edit'] ? '<a href="' . $event['modify_href'] . '" title="' . $txt['calendar_edit'] . '"><img src="' . $settings['images_url'] . '/icons/modify_small.gif" alt="*" /></a> ' : '', $event['href'] == '' ? '' : '<a href="' . $event['href'] . '">', $event['is_today'] ? '<strong>' . $event['title'] . '</strong>' : $event['title'], $event['href'] == '' ? '' : '</a>', $event['is_last'] ? '<br />' : ', ';
		}
		echo '
			</div><!-- div.InnerCont -->	
		</div><!-- div#CalendarSum -->
			
			';
	}
	// end calendar
	// Show statistical style information...
	if ($settings['show_stats_index'])
	{
		echo '
			<div id="ForumStats" class="SectionContainer">
				<div class="InnerCont">
					<h2 class="sectionName">
							', $txt['forum_stats'], '
							<a href="', $scripturl, '?action=stats"><img class="icon" src="', $settings['images_url'], '/icons/info.gif" alt="', $txt['forum_stats'], '" /></a>									
					</h2>
				
					<p>
						', $context['common_stats']['total_posts'], ' ', $txt['posts_made'], ' ', $txt['in'], ' ', $context['common_stats']['total_topics'], ' ', $txt['topics'], ' ', $txt['by'], ' ', $context['common_stats']['total_members'], ' ', $txt['members'], '. ', !empty($settings['show_latest_member']) ? $txt['latest_member'] . ': <strong> ' . $context['common_stats']['latest_member']['link'] . '</strong>' : '', '<br />
						', (!empty($context['latest_post']) ? $txt['latest_post'] . ': <strong>&quot;' . $context['latest_post']['link'] . '&quot;</strong>  ( ' . $context['latest_post']['time'] . ' )<br />' : ''), '
						<a href="', $scripturl, '?action=recent">', $txt['recent_view'], '</a>', $context['show_stats'] ? '<br />
						<a href="' . $scripturl . '?action=stats">' . $txt['more_stats'] . '</a>' : '', '
					</p>
				</div><!-- div.InnerCont -->
			</div><!-- div#ForumStats -->';
			
	}

	
	// Info center collapse object.
	echo '
	<script type="text/javascript"><!-- // --><![CDATA[
		var oInfoCenterToggle = new smc_Toggle({
			bToggleEnabled: true,
			bCurrentlyCollapsed: ', empty($options['collapse_header_ic']) ? 'false' : 'true', ',
			aSwappableContainers: [
				\'upshrinkHeaderIC\'
			],
			aSwapImages: [
				{
					sId: \'upshrink_ic\',
					srcExpanded: smf_images_url + \'/collapse.gif\',
					altExpanded: ', JavaScriptEscape($txt['upshrink_description']), ',
					srcCollapsed: smf_images_url + \'/expand.gif\',
					altCollapsed: ', JavaScriptEscape($txt['upshrink_description']), '
				}
			],
			oThemeOptions: {
				bUseThemeSettings: ', $context['user']['is_guest'] ? 'false' : 'true', ',
				sOptionName: \'collapse_header_ic\',
				sSessionVar: ', JavaScriptEscape($context['session_var']), ',
				sSessionId: ', JavaScriptEscape($context['session_id']), '
			},
			oCookieOptions: {
				bUseCookie: ', $context['user']['is_guest'] ? 'true' : 'false', ',
				sCookieName: \'upshrinkIC\'
			}
		});
	// ]]></script>';
}
?>