<?php /* Smarty version Smarty-3.1.13, created on 2013-07-05 19:45:08
         compiled from "views\contact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1161851d768456917e4-84383362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '556cdfb01037f6bc8d5f25a63cac5c53d72c71f1' => 
    array (
      0 => 'views\\contact.tpl',
      1 => 1373071501,
      2 => 'file',
    ),
    'c26e6dbb95cf941a6d255ca1ba4f0455146467cf' => 
    array (
      0 => 'views\\layout.tpl',
      1 => 1373071443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1161851d768456917e4-84383362',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51d768456f4332_77095491',
  'variables' => 
  array (
    'user_count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d768456f4332_77095491')) {function content_51d768456f4332_77095491($_smarty_tpl) {?><!DOCTYPE html>

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
        
Contact page

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