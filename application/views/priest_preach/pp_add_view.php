<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>牧师讲道</title>
<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				牧师讲道
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">添加讲道分类</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-4">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">添加讲道分类</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form action="<?php echo site_url('PP_add'); ?>" method="post">
							
							<div class="box-body">
								<div class="form-group">
									<label for="course_class">类名称：</label>
									<input type="text" class="form-control" id="course_class" name="course_class" required=''>
								</div>

							</div><!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">提交</button>
								<button type="button" class="btn btn-warning pull-left" onclick="window.history.back()">返回</button>
							</div>
						</form>
					</div><!-- /.box -->		  		
				</div>
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	
</body>
</html>