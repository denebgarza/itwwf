<?php /* Smarty version Smarty-3.1.13, created on 2013-07-05 19:44:12
         compiled from "views\about.tpl" */ ?>
<?php /*%%SmartyHeaderCode:698051d7682fbe6672-13440684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca421bab107b2b775730a59672b523b524b4180f' => 
    array (
      0 => 'views\\about.tpl',
      1 => 1370041134,
      2 => 'file',
    ),
    'c26e6dbb95cf941a6d255ca1ba4f0455146467cf' => 
    array (
      0 => 'views\\layout.tpl',
      1 => 1373071443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '698051d7682fbe6672-13440684',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51d7682fc47754_32842847',
  'variables' => 
  array (
    'user_count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d7682fc47754_32842847')) {function content_51d7682fc47754_32842847($_smarty_tpl) {?><!DOCTYPE html>

<html>
  <head>
    <title>I Thought We Were Friends :'(</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    
    
    
    
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
        
About page

      </div>
      <div class="container-footer">
        <a href="?page=about">About</a> _ <a href="?page=privacy">Privacy policy</a> _ <a href="?page=contact">Contact</a>
      </div>
      <div style="clear: both;"></div>
    </div>
    <div class="footer">
      This application has been used by <?php echo $_smarty_tpl->tpl_vars['user_count']->value;?>
 people.<br />
      Created by Deneb Garza
    </div>
  </body>
</html><?php }} ?>