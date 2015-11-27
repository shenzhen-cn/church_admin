<?php  

  $get_admin_info = isset($get_admin_info) ? $get_admin_info :"";
  $get_admin_name = isset($get_admin_info->admin_name) ? $get_admin_info->admin_name : ''; 
  $admin_nick     = isset($get_admin_info->admin_nick) ? $get_admin_info->admin_nick: "";
  $admin_id       = isset($get_admin_info->admin_id) ? $get_admin_info->admin_id : "";
  $get_op         = isset($get_op) ? $get_op : "" ;

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>重置密码</title>
  <link href="<?php echo base_url(); ?>public/css/registerStyle.css" rel="stylesheet" />
  <?php $this->load->view('tq_head'); ?>
</head>
  <body class="hold-transition login-page">
   <div class="register-box">
  <?php if ( empty($get_op)){ ?>
     <?php $this->load->view('tq_alerts'); ?>
  <?php } ?>
     <div class="register-logo">
       <b>使命</b>青年团契
     </div>
     <div class="register-box-body">
       <p class="login-box-msg">重置密码</p>      
       <form action="<?php echo site_url('login/reset_admin_pwd'); ?>" method="post">
         <div class="form-group has-feedback">
           <input type="email" class="form-control" name="user_name" placeholder="<?php echo $get_admin_name; ?>" value="<?php echo $get_admin_name; ?>" disabled="disabled">
           <span class="fa fa-envelope-o form-control-feedback"></span>
         </div>
            <?php if ( empty($get_op)){ ?>
             <div class="form-group has-feedback">
               <input type="text" class="form-control"  id="admin_nick" name="admin_nick" placeholder="昵称" AUTOCOMPLETE="off"  >
               <span class="fa fa-male form-control-feedback"></span>
               <p class="msg"><i class="ati"></i></p><b id="count"></b>
             </div>
            <?php } else{ ?>
              <div class="form-group has-feedback">
                <input type="text" class="form-control"  id="admin_nick" name="admin_nick" placeholder="<?php echo $admin_nick; ?>" AUTOCOMPLETE="off"  disabled="disabled">
                <span class="fa fa-male form-control-feedback"></span>
                <p class="msg"><i class="ati"></i></p><b id="count"></b>
              </div>
            <?php  } ?>
           
        <div class="clearfix"></div>
        <div class="form-group has-feedback">
           <input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="密码" AUTOCOMPLETE="off"  >
           <span class="fa fa-key form-control-feedback"></span>
           <p class="msg"><i class="ati"></i></p>
         </div>
         <div class="clearfix"></div>
         <div>  
            <label>
                <span></span><em class="active">弱</em><em>中</em><em>强</em>
            </label>
         </div> 
         <div class="clearfix"></div>    
         <div class="form-group has-feedback">
           <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="确认密码" required="required" disabled="" />
           <span class="fa fa-key form-control-feedback"></span>
           <p class="msg"><i class="ati"></i>再输入一次</p>
         </div>
         <div class="clearfix"></div> 
        <div class="social-auth-links text-center">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id;?>">
            <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="if(!checkRegister()){return false;}">提交</button><br>
        </div>
       </form>  
     </div><!-- /.form-box -->
   </div><!-- /.register-box -->
   <!-- jQuery 2.1.4 -->
   <script src="<?php echo base_url(); ?>public/plugins/js/jQuery-2.1.4.min.js"></script>
   <!-- Bootstrap 3.3.5 -->
   <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url(); ?>public/js/formValidation.js"></script>
  </body>
</html>
