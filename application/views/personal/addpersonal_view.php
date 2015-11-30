<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>添加用户</title>
<?php $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				用户注册
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li>添加用户</li>
				<li class="active">用户注册</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="col-md-4 col-md-offset-4">	
				<?php $this->load->view('tq_alerts'); ?>
			</div>
			<!-- Automatic element centering -->
			<div class="lockscreen-wrapper">
				<div class="lockscreen-item">
					<div class="lockscreen-image">
						<img src="<?php echo base_url(); ?>public/images/tq_logo.png" alt="User Image">
					</div>
					<!-- /.lockscreen-image -->
					<form class="lockscreen-credentials" action="<?php echo site_url('add_personal'); ?>" method="post">
						<div class="input-group">
							<input type="email" class="form-control" placeholder="申请注册邮箱"  id="re_user_email" name="re_user_email" required="required" AUTOCOMPLETE="off">
							<div class="input-group-btn">
								<button class="btn" type="submit"><i class="fa   fa-check text-muted"></i></button>
							</div>
						</div>
					</form><!-- /.lockscreen credentials -->
				</div><!-- /.lockscreen-item -->
			</div><!-- /.center -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php $this->load->view('tq_footer'); ?>

</body>
</html>

