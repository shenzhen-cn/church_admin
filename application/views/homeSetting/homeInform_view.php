<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>首页通知设置</title>
<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				首页通知设置
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">首页通知设置</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-4">
				<?php $this->load->view('tq_alerts'); ?>
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title">添加通知</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form action="<?php echo base_url('homeSetting'); ?>" method="post">
							
							<div class="box-body">
								<div class="form-group">
									<label for="home_inform_days">设置天数：</label>
									<input type="number" step="1" min="1" max="10" class="form-control" id="home_inform_days" name="home_inform_days" >
								</div>

								<div class="form-group">
									<label for="home_inform">通知：</label>
									<textarea type="textarea" class="form-control" id="home_inform" name="home_inform" style="height:100px" ></textarea>
								</div>


							</div><!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">提交</button>
								<button type="submit" class="btn btn-warning pull-left" onclick="window.history.back()">返回</button>
							</div>
						</form>
					</div><!-- /.box -->		  		
				</div>
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	<script type="text/javascript">
			
	</script>
	
</body>
</html>