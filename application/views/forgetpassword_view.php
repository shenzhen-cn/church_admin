<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>忘记密码</title>
  <?php $this->load->view('tq_head'); ?>
</head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>使命</b>青年团契
      </div><!-- /.login-logo -->
      <?php $this->load->view('tq_alerts'); ?>
      <form id="f_p_chekc_admin" action="<?php echo site_url('forgetpassword'); ?>" method='post'>
        <div class="login-box-body">
          <p class="login-box-msg">找回密码</p>
            <div class="form-group has-feedback">
              <span class="fa fa-envelope-o  form-control-feedback"></span>
              <input type="email" class="form-control" name="f_user_email" id="f_user_email" placeholder="注册邮箱"  AUTOCOMPLETE="off" >
            </div>
            <div class="row">
              <div class="form-group col-xs-6">
                 <input type="text" class="form-control"  name="checkcode" id="checkcode" placeholder="验证码:"  AUTOCOMPLETE="off"/>
              </div><!-- /.col -->
              <div class="form-group col-xs-4 col-xs-offset-1">
                 <img id="checkpic1" onclick="changing()" src="<?php echo base_url(); ?>public/images/Checkcode.php">
              </div><!-- /.col -->
            </div>
          <br>
          <button type="submit" class="btn btn-primary btn-block btn-flat">申请找回</button><br>
          <a type="button" href="<?php echo site_url(); ?>" class="btn btn-info btn-block btn-flat">返回登录</a><br>
        </div><!-- /.login-box-body -->
       </form>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('public/plugins/js/jquery-2.1.4.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/js/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>public/js/f_p_chekc_admin.js"></script>
    <script type="text/javascript">
      function  changing() {
        document.getElementById('checkpic1').src="../public/images/checkcode.php?"+Math.random();
      }

    </script>
    <style type="text/css" >  

      input.error { border: 1px solid red; }
      label.error {

        padding-left: 16px;

        padding-bottom: 2px;

        font-weight: bold;

        color: #EA5200;
      }

    </style>
  </body>
</html>
