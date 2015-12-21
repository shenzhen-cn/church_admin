<?php
	$re_user_results = isset($re_user_results) ? $re_user_results : ""; 
	$re_user_id = isset($re_user_results->re_user_id) ? $re_user_results->re_user_id : ""; 
	$group_user_id = isset($re_user_results->group_user_id) ? $re_user_results->group_user_id : ""; 
	$user_nick = isset($re_user_results->user_nick) ? $re_user_results->user_nick : ""; 
	$sex = isset($re_user_results->sex) ? $re_user_results->sex : ""; 
	$user_group_id = isset($re_user_results->user_group_id) ? $re_user_results->user_group_id : ""; 
	$group_name = isset($re_user_results->group_name) ? $re_user_results->group_name : ""; 
	$user_name = isset($re_user_results->user_name) ? $re_user_results->user_name : ""; 
	$remark = isset($re_user_results->remark) ? $re_user_results->remark : ""; 
  	$group_info     = isset($group_info) ?  $group_info : "";

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>管理员管理</title>
	<?php  $this->load->view('tq_head'); ?>
	
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				查看用户
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li><a href="<?php echo site_url('user_registered'); ?>">用户管理</a></li>
				<li class="active">查看用户</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-6">				
				      <?php $this->load->view('tq_alerts'); ?>    						
					<div class="box box-primary">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">查看用户资料</h3>								
							</div><!-- /.box-header -->
							<!-- form start -->
							<form class="form-horizontal" action="<?php echo  site_url('personal/'); ?>">
							  <div class="box-body">
							    <div class="form-group">
							      <label for="inputEmail3" class="col-sm-2 control-label">用户邮箱：</label>
							      <div class="col-sm-10">
							      	<?php echo $user_name; ?>	
							      </div>
							    </div>
							    <div class="form-group">
							      <label for="inputPassword3" class="col-sm-2 control-label">昵称：</label>
							      <div class="col-sm-10">
								      <?php echo $user_nick; ?>
							      </div>
							    </div>	
							    <div class="form-group">
							      <label for="inputPassword3" class="col-sm-2 control-label">性别：</label>
							      <div class="col-sm-10">
								      <?php echo $sex; ?>
							      </div>
							    </div>							    
							    <div class="form-group">
							      <label for="inputPassword3" class="col-sm-2 control-label">小组：</label>
							      <div class="col-sm-10">	      	                	
	      	                		<?php 	echo $group_name; ?>
							      </div>
							    </div>	
							    <div class="form-group">
							      <label for="inputPassword3" class="col-sm-2 control-label">备注：</label>
							      <div class="col-sm-10">
							      	<?php echo $remark; ?>	
							      </div>
							    </div>	
							  </div>
							  <!-- /.box-body -->
							  <div class="box-footer">
							    <button class="btn btn-default" onclick="window.history.back()">返回</button>
							    <a href="<?php echo site_url('personal/edit_user_reg?re_user_id='.$re_user_id); ?>" class="btn btn-info pull-right">编辑</a>
							  </div>
							  <!-- /.box-footer -->
							</form>		
						</div><!-- /.box -->
					</div>		  		
				</div>
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
	<div class="clearfix"></div>


	<?php  $this->load->view('tq_footer'); ?>	
	
	<style type="text/css">
	td {
		text-align:center; /*设置水平居中*/
		vertical-align:middle;/*设置垂直居中*/
	}
	th {
		text-align:center; /*设置水平居中*/
		vertical-align:middle;/*设置垂直居中*/
	}
	</style>

</body>
</html>