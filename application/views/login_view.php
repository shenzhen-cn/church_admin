<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>登录</title>
  <?php $this->load->view('tq_head'); ?>
</head>
  <body class="hold-transition login-page">

    <div class="login-box">
      <?php $this->load->view('tq_alerts'); ?>    
      <div class="login-logo">
        使命青年团契后台
      </div><!-- /.login-logo --> 
      <div class="login-box-body">
        <form action="<?php echo base_url('login'); ?>" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="账号：" id="admin_name" name="admin_name">
            <span class="fa fa-envelope-o  form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="密码："  id="admin_pwd" name="admin_pwd">
            <span class="fa fa-key form-control-feedback"></span>
          </div>
        <br>
        <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button><br>
        <a type="button" href="<?php echo base_url('forgetpassword'); ?>">忘记密码？</a><br>
        </form>        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>public/plugins/js/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
  </body>
</html>
