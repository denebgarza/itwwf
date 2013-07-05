<?php /* Smarty version Smarty-3.1.13, created on 2013-05-31 22:47:14
         compiled from "views\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1661951a9281696f7c9-16815596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c26e6dbb95cf941a6d255ca1ba4f0455146467cf' => 
    array (
      0 => 'views\\layout.tpl',
      1 => 1370040428,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1661951a9281696f7c9-16815596',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51a928169ea194_45616119',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a928169ea194_45616119')) {function content_51a928169ea194_45616119($_smarty_tpl) {?><html>
  <head>
    <title>I Thought We Were Friends :'(</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
  </head>
  <body>
    <div class="container">
      <div class="header">
        I Thought We Were Friends :'(
      </div>
      <div class="content">
        <div id="fb-root"></div>
        <script src="fb_sdk/load_fb_js_sdk.js"></script>
        
        <fb:login-button show-faces="false" max-rows="1" style="width: auto; float: center;" size="large">Login to Facebook</fb:login-button>
        
      </div>
      <div style="clear: both;"></div>
    </div>
  </body>
</html><?php }} ?>