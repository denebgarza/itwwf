<?php /* Smarty version Smarty-3.1.13, created on 2013-05-31 22:31:40
         compiled from "views\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1512951a3b3723a49d3-95930280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb3fd37e6f529e330906b3654bbe2b19ae9511a7' => 
    array (
      0 => 'views\\index.tpl',
      1 => 1370039497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1512951a3b3723a49d3-95930280',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51a3b372414fd3_47481569',
  'variables' => 
  array (
    'user_id' => 0,
    'user_name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a3b372414fd3_47481569')) {function content_51a3b372414fd3_47481569($_smarty_tpl) {?><html>
  <head>
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
        <?php if ($_smarty_tpl->tpl_vars['user_id']->value){?>
          Hello <?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
!
        <?php }else{ ?>
          <fb:login-button show-faces="false" max-rows="1" style="width: auto; float: center;" size="large">Login to Facebook</fb:login-button>
        <?php }?>
      </div>
      <div style="clear: both;"></div>
    </div>
  </body>
</html><?php }} ?>