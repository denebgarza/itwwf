<!DOCTYPE html>

<html>
  <head>
    <title>I Thought We Were Friends :'(</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    {block name=stylesheets}
    {/block}
    {block name=scripts}
    {/block}
  </head>
  <body>
    <div class="container">
      <a href="?page=check">
      <div class="header">
        I Thought We Were Friends :'(
      </div>
      </a>
      <div class="content">
        <div id="fb-root"></div>
        <script src="config/facebook/load_fb_js_sdk.js"></script>
        {block name=content}
        {/block}
      </div>
      <div class="container-footer">
        <a href="?page=about">About</a> | <a href="?page=privacy">Privacy policy</a> | <a href="?page=faq">FAQ</a> | <a href="?page=contact">Contact</a>
      </div>
      <div style="clear: both;"></div>
    </div>
    <div class="footer">
      This application has been used by {$user_count} people.<br />
      Created by Deneb Garza
    </div>
  </body>
</html>