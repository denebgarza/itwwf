{extends file='layout.tpl'}
{block name=stylesheets}
    <link rel="stylesheet" type="text/css" href="css/check.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/calendarview.css" /> -->
    <link rel="stylesheet" href="css/jquery-ui.css" />
{/block}
{block name=content}
{if !$user_id}
<fb:login-button show-faces="false" max-rows="1" style="width: auto; float: center;" size="large" id="login-btn">Login to Facebook</fb:login-button>
{else}
  {block name=scripts}
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
      <!-- <script src="javascript/calendarview.js"></script> -->
      <script src="javascript/check.js"></script>
  {/block}
  {if $first_time}
        <strong>Welcome <a href="https://facebook.com/{$user_id}" target="top">{$user_name}</a></strong><br />
        It appears this is your first time here!<br /><br />
        <br /><a href="#" onclick="window.location.reload();">Continue</a>...
  {else}
        <a href="https://facebook.com/{$user_id}" target="top">{$user_name}'s</a> friend summary for <strong>{$date_display}</strong> <img src="images/refresh.gif" alt="refresh" id="refresh" />
        <br />
        <input type="text" id="date-val" />
        <!-- <span id="date" name="date">{$date_display}</span> <input type="hidden" id="date_val" name="date_val" /> -->
        <br /><br />
    {if $user_time - 24 * 60 * 60 > $time_date}
        You can't see dates from before you started using this application (<a href="?d={$date_join}">{$date_join_display}</a>)<br />
        <a href="?page=faq">Why?</a>
        
    {elseif $time_date >= $time_tomorrow}
        Predicting the future isn't possible yet. However, if the universe is completely <a href="https://en.wikipedia.org/wiki/Determinism" target="top">deterministic</a>, perhaps we will be able to predict the future someday.
    {else}
      {if $friends_changed|@count > 0}  
          <div id="friend-results-container">
          {foreach from=$friends_changed item=friend}
            <div id="friend-result" onclick="showFriend({$friend.id});" {if $friend.time_unix > $user_last_check} style="font-weight: bold;"{/if}>
              <div id="type">
            {if $friend.type == 1 || $friend.type == 3}
              {assign var="face" value=":)"}
              {assign var="face_class" value="happy"}
            {else}
              {assign var="face" value=":("}
              {assign var="face_class" value="sad"}
            {/if}
              <span class="{$face_class}">{$face}</span>
              </div>
              <div id="name" {if $face == ":("}style="text-decoration: line-through;"{/if}>
                <a href="#">{$friend.name}</a>
              </div>
              <div id="cause">
                {if $friend.type == 0}
                <span class="deleted">deleted</span>
                {elseif $friend.type == 1}
                <span class="added">added</span>
                {elseif $friend.type == 2}
                <span class="unknown">deactivated</span>
                {elseif $friend.type == 3}
                <span class="added">reactivated</span>
                {/if}
              </div>
              <div id="time">
                {$friend.time}
              </div>
            </div>
          {/foreach}
          </div>
      {else}
        {if $date_display != "Today"}
        There were no changes to your friends list on this day...
        {else}
        <strong>There's been no changes to your friends list today. Try again later!</strong>
        <br />
        <br />
        <em>For more accurate daily summaries, use the application at least once per day.
        <br />
        The more frequently you use the app., the more accurate the results will be.</em>
        {/if}
      {/if}
    {/if}
  {/if}
{/if}
{/block}