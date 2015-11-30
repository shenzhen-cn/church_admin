<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>密码重置</title>
  <?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php  $this->load->view('tq_header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        设置
        <small>IN GOD WE TRUST</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">修改密码</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="login-box">
          <div class="login-logo">
            <b>使命</b>青年团契
          </div>
          <div class="login-box-body">
          <?php $this->load->view('tq_alerts'); ?>
            <p class="login-box-msg">请注意密码修改后，将重新登录</p>
            <form id="checkform" action="<?php echo site_url('resetpassword'); ?>" method="post">
              <div class="form-group has-feedback">
                <input type="password" class="form-control  " placeholder="当前密码"  id="currentPwd" name="currentPwd"  AUTOCOMPLETE="off">
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control " placeholder="新密码" id="newPwd" name="newPwd"  AUTOCOMPLETE="off">
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control " placeholder="再次输入密码"  id="confirmNewPwd" name="confirmNewPwd" AUTOCOMPLETE="off">
              </div>
              <div class="row">
                <button type="submit" class="btn btn-primary btn-block btn-flat" >确定修改</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('tq_footer'); ?>
  <script src="<?php echo base_url(); ?>public/plugins/js/jquery.validate.js" type="text/javascript" ></script>
  <script src="<?php echo base_url(); ?>public/plugins/js/jquery.form.js" type="text/javascript" ></script>
  <script src="<?php echo base_url(); ?>public/plugins/js/messages_cn.js" type="text/javascript" ></script>
  
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