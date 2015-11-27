<?php 
	$all_groups = isset($all_groups)   ?  $all_groups : "";
	
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>小组设置</title>
<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				小组设置
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">小组设置</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-6">
				<?php $this->load->view('tq_alerts'); ?>
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">编辑小组信息</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<div class="box-body">
						<?php if (!empty($all_groups)){ ?>
							<div class="table-responsive mailbox-messages">
							<table class="table table-hover table-striped" >
								<tr>
									<th>编号</th>
									<th>小组</th>
									<th>注册时间</th>
									<th>组长</th>
									<th>修改</th>
								</tr>
								<?php 	foreach ($all_groups as $k => $v) { 
									// var_dump($all_groups);exit();
										$group_id = $v->group_id;
										$nick = isset($v->nick) ? $v->nick : "";
										$group_name = $v->group_name;
										$group_leader_id = $v->group_leader_id;
										$created_at = $v->created_at;


										?>
								<tr>
									<td><?php 	echo $k+1; ?></td>
									<td><?php 	echo $group_name; ?></td>
									<td><?php 	echo   date("Y年m月d日",strtotime( $created_at)); ?></td>
									<?php 	if ( $group_leader_id > 0 ) { ?>
										<td><?php 	echo $nick; ?></td>
									<?php } else {?>
										<td>无</td>
									<?php 	} ?>
									<td>
										<a href='<?php 	echo base_url('group/groupEdit?group_id='."$group_id".'&group_leader_id='."$group_leader_id"); ?>' type="button" class="btn btn-success btn-xs">修改</a>
									</td>
									
								</tr>
								<?php } ?>
							</table>
							<div class="table-responsive mailbox-messages">
						<?php } ?>
						</div>
						<div class="box-body">	
		
						</div>
					</div><!-- /.box -->		  		
				</div>
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>

</body>
</html>