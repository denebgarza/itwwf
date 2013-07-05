<?php /* Smarty version Smarty-3.1.13, created on 2013-06-11 22:16:31
         compiled from "views\friends.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2530251a927da4baaf8-79798985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7c41b530562032fcf66e36d4de172479cc329b7' => 
    array (
      0 => 'views\\friends.tpl',
      1 => 1370988961,
      2 => 'file',
    ),
    'c26e6dbb95cf941a6d255ca1ba4f0455146467cf' => 
    array (
      0 => 'views\\layout.tpl',
      1 => 1370041723,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2530251a927da4baaf8-79798985',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51a927da54be30_32785860',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a927da54be30_32785860')) {function content_51a927da54be30_32785860($_smarty_tpl) {?><html>
  <head>
    <title>I Thought We Were Friends :'(</title>
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
  </head>
  <body>
    <div class="container">
      <div class="header">
        I Thought We Were Friends :'(
      </div>
      <div class="content">
        <div id="fb-root"></div>
        <script src="fb_sdk/load_fb_js_sdk.js"></script>
        
<?php if (!$_smarty_tpl->tpl_vars['user']->value){?>
<fb:login-button show-faces="false" max-rows="1" style="width: auto; float: center;" size="large">Login to Facebook</fb:login-button>
<?php }else{ ?>
        Welcome back <?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>

        <h3>Today</h3>
<?php }?>

      </div>
      <div style="clear: both;"></div>
    </div>
    <div class="footer">
      Created by Deneb Garza
    </div>
  </body>
</html><?php }} ?>