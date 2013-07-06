<?php /* Smarty version Smarty-3.1.13, created on 2013-07-05 19:59:48
         compiled from "views\check.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1234651d3c5c571c886-34280326%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b884f9c9949cd97ba2ffc57fdbaa3aadeff228a7' => 
    array (
      0 => 'views\\check.tpl',
      1 => 1373016994,
      2 => 'file',
    ),
    'c26e6dbb95cf941a6d255ca1ba4f0455146467cf' => 
    array (
      0 => 'views\\layout.tpl',
      1 => 1373072387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1234651d3c5c571c886-34280326',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51d3c5c58719c7_50901576',
  'variables' => 
  array (
    'user_count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d3c5c58719c7_50901576')) {function content_51d3c5c58719c7_50901576($_smarty_tpl) {?><!DOCTYPE html>

<html>
  <head>
    <title>I Thought We Were Friends :'(</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
    
    <link rel="stylesheet" type="text/css" href="css/check.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/calendarview.css" /> -->
    <link rel="stylesheet" href="css/jquery-ui.css" />

    
    
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
        
<?php if (!$_smarty_tpl->tpl_vars['user']->value){?>
<fb:login-button show-faces="false" max-rows="1" style="width: auto; float: center;" size="large">Login to Facebook</fb:login-button>
<?php }else{ ?>
  
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
      <!-- <script src="javascript/calendarview.js"></script> -->
      <script src="javascript/check.js"></script>
  
  <?php if ($_smarty_tpl->tpl_vars['first_time']->value){?>
        <strong>Welcome <a href="https://facebook.com/<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" target="top"><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</a></strong><br />
        It appears this is your first time here!<br /><br />
        Some introductory message is supposed to go here. I'll figure this out when it's released to the general public.
        <br /><a href="#" onclick="window.location.reload();">Aight</a>
  <?php }else{ ?>
        <a href="https://facebook.com/<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" target="top"><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
's</a> friend summary for <strong><?php echo $_smarty_tpl->tpl_vars['date_display']->value;?>
</strong> <img src="images/refresh.gif" alt="refresh" id="refresh" />
        <br />
        <input type="text" id="date-val" />
        <!-- <span id="date" name="date"><?php echo $_smarty_tpl->tpl_vars['date_display']->value;?>
</span> <input type="hidden" id="date_val" name="date_val" /> -->
        <br /><br />
    <?php if ($_smarty_tpl->tpl_vars['user_time']->value-24*60*60>$_smarty_tpl->tpl_vars['time_date']->value){?>
        You can't see dates from before you started using this application (<a href="?d=<?php echo $_smarty_tpl->tpl_vars['date_join']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['date_join_display']->value;?>
</a>)<br />
        
    <?php }elseif($_smarty_tpl->tpl_vars['time_date']->value>=$_smarty_tpl->tpl_vars['time_tomorrow']->value){?>
        Predicting the future isn't possible yet. However, if the universe is completely <a href="https://en.wikipedia.org/wiki/Determinism" target="top">deterministic</a>, perhaps we will be able to predict the future someday.
    <?php }else{ ?>
      <?php if (count($_smarty_tpl->tpl_vars['friends_changed']->value)>0){?>  
          <div id="friend-results-container">
          <?php  $_smarty_tpl->tpl_vars['friend'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['friend']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['friends_changed']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['friend']->key => $_smarty_tpl->tpl_vars['friend']->value){
$_smarty_tpl->tpl_vars['friend']->_loop = true;
?>
            <div id="friend-result" onclick="showFriend(<?php echo $_smarty_tpl->tpl_vars['friend']->value['id'];?>
);" <?php if ($_smarty_tpl->tpl_vars['friend']->value['time_unix']>$_smarty_tpl->tpl_vars['user_last_check']->value){?> style="font-weight: bold;"<?php }?>>
              <div id="type">
            <?php if ($_smarty_tpl->tpl_vars['friend']->value['type']==1||$_smarty_tpl->tpl_vars['friend']->value['type']==3){?>
              <?php $_smarty_tpl->tpl_vars["face"] = new Smarty_variable(":)", null, 0);?>
              <?php $_smarty_tpl->tpl_vars["face_class"] = new Smarty_variable("happy", null, 0);?>
            <?php }else{ ?>
              <?php $_smarty_tpl->tpl_vars["face"] = new Smarty_variable(":(", null, 0);?>
              <?php $_smarty_tpl->tpl_vars["face_class"] = new Smarty_variable("sad", null, 0);?>
            <?php }?>
              <span class="<?php echo $_smarty_tpl->tpl_vars['face_class']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['face']->value;?>
</span>
              </div>
              <div id="name" <?php if ($_smarty_tpl->tpl_vars['face']->value==":("){?>style="text-decoration: line-through;"<?php }?>>
                <a href="#"><?php echo $_smarty_tpl->tpl_vars['friend']->value['name'];?>
</a>
              </div>
              <div id="cause">
                <?php if ($_smarty_tpl->tpl_vars['friend']->value['type']==0){?>
                <span class="deleted">deleted</span>
                <?php }elseif($_smarty_tpl->tpl_vars['friend']->value['type']==1){?>
                <span class="added">added</span>
                <?php }elseif($_smarty_tpl->tpl_vars['friend']->value['type']==2){?>
                <span class="unknown">deactivated</span>
                <?php }elseif($_smarty_tpl->tpl_vars['friend']->value['type']==3){?>
                <span class="added">reactivated</span>
                <?php }?>
              </div>
              <div id="time">
                <?php echo $_smarty_tpl->tpl_vars['friend']->value['time'];?>

              </div>
            </div>
          <?php } ?>
          </div>
      <?php }else{ ?>
        <?php if ($_smarty_tpl->tpl_vars['date_display']->value!="Today"){?>
        There were no changes to your friends list on this day...
        <?php }else{ ?>
        There's been no changes to your friends list today...
        <?php }?>
      <?php }?>
    <?php }?>
  <?php }?>
<?php }?>

      </div>
      <div class="container-footer">
        <a href="?page=about">About</a> | <a href="?page=privacy">Privacy policy</a> | <a href="?page=contact">Contact</a>
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