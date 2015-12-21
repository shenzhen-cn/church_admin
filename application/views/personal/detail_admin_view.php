<?php
	$results = isset($results) ? $results : "";
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
				管理员管理
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">管理员管理</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">				
					<div class="box box-primary">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">管理员管理</h3>								
							</div><!-- /.box-header -->
							<div class="box-body">							

							<div class="table-responsive mailbox-messages">
								<?php $i=1;	if (!empty($results)) { ?>
									<table class="table table-bordered">
										<tr>
											<th>编号</th>
											<th>成员昵称</th>
											<th>最后一次登录时间</th>
										</tr>
										<?php  foreach ($results as $k => $v) {
											$admin_id = $v->id;
											$admin_nick = $v->nick;											
											$admin_level = $v->level;																				
											$last_login_at = $v->last_login_at;																															
										 		
										 	?>
											<tr>
												<td><?php 	echo $i; ?></td>
												<td><?php 	echo $admin_nick; ?></td>
												<td><?php 	echo $last_login_at; ?></td>																																												
											</tr>	
											<?php $i++; ?>										
									<?php	 }?>																			
									</table>
								<?php } ?>										
							</div>									
							</div><!-- /.box-body -->							
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