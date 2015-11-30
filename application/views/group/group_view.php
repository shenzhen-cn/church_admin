<?php 	
		$group_id 				= isset($results->id) ? $results->id : "";				
		$group_name 			= isset($results->group_name) ? $results->group_name : "";
		$group_leader_id 		= isset($results->group_leader_id) ? $results->group_leader_id : "";		
		$user_group_id          = isset($user_info->group_id) ? $user_info->group_id : "";
		$group_users 			= isset($group_users) ? $group_users : "" ;
//var_dump($group_users);exit;
		$group_name 			= isset($group_name) ? $group_name : "" ;
		$week_s_report 			= isset($week_s_report) ? $week_s_report : "" ;
		// var_dump($week_s_report);exit;

		$week_firstday 			= isset($week_firstday) ? $week_firstday : "" ;
		$week_lastday 			= isset($week_lastday) ? $week_lastday : "" ;

 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>小组-使命青年团契</title>
<?php $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				小组
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">小组</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">

			<?php if (!empty($group_users)){ ?>
				<div class="row">
					<div class="col-md-12 ">
						<!-- USERS LIST -->
						<div class="box box-danger">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo $group_name; ?>成员列表</h3>
								<div class="box-tools pull-right">
									<span class="label label-danger"><span class="total_users"><?php echo count($group_users); ?></span>人小组</span>									
								</div>
							</div><!-- /.box-header -->
							<div class="box-body no-padding">
								<div class="table-responsive mailbox-messages">
									<table class="table table-hover table-striped">
									  <tr>
									    <th>编号：</th>
									    <th>昵称：</th>
									    <th>性别：</th>
									    <th>注册日期：</th>
									    <th>灵修次数：</th>
									    <th>删除：</th>
									  </tr>
									  <?php foreach ($group_users as $k => $v) {
									  		$group_user_id = $v->user_id;
									  		$group_user_nick = $v->nick;
									  		$group_user_sex = $v->sex;
									  		$group_user_created_at = $v->created_at;
									  		$group_user_count_spirituality = $v->count_spirituality; ?>
										  <tr class="selected_<?php echo $group_user_id;?>">
										    <td><?php echo $k+1; ?></td>
										    <td><?php echo $group_user_nick; ?></td>
										    <td><?php echo $group_user_sex; ?></td>
										    <td><?php echo $group_user_created_at; ?></td>
										    <td><span class="label label-success"><?php echo $group_user_count_spirituality; ?></span></td>
										    <td><button class="btn btn-danger del_user"  data-selected-id="<?php echo $group_user_id;?>">是</button></td>
										  </tr>
									  <?php } ?>
									  
									</table>
								</div>
							</div><!-- /.box-body -->
						</div><!--/.box -->
					</div><!-- /.col -->
				</div>   <!-- /.row -->
			<?php } ?>	

			<?php if(!empty($week_s_report)){ ?>

				<div class="row">
					<div class="col-md-12 ">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">本周<?php echo $group_name; ?>灵修</h3>
							</div><!-- /.box-header -->
							<div class="box-body no-padding">
								<div class="table-responsive mailbox-messages">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>编号</th>
												<th>昵称</th>
												<th>本周灵修(天)</th>
												<th>剩余灵修(天)</th>
												<th>完成进度</th>
												<th>灵修率</th>
												<th>本周小组排名</th>
											</tr>
										</thead>
										<tbody>
										<?php foreach ($week_s_report as $k => $v) { 
												$group_user_id = $v->group_user_id;
												$group_user_nick = $v->group_user_nick;
												$this_week_count = $v->this_week_count;
												$should_completed_counts = $v->should_completed_counts;
												$progress = $v->progress;
												$group_user_rank = $v->group_user_rank;											
											?>

											<tr class="selected_<?php echo $group_user_id;?>">
												<td><?php echo $k+1; ?></td>
												<td><?php echo $group_user_nick; ?></td>
												<td><?php echo $this_week_count; ?></td>
												<td><?php echo $should_completed_counts - $this_week_count; ?></td>
												<td>
													<div class="progress progress-xs">
													  <div class="progress-bar progress-bar-danger" style="width: <?php echo $progress; ?>"></div>
													</div>
												</td>
												<td><?php echo $progress; ?></td>
												<td>
												<?php if ($group_user_rank > 0) { ?>
													<p class="label label-success"><?php echo $group_user_rank; ?></p>	
												<?php } ?>
												</td>										
											</tr>
											
										<?php } ?>

										</tbody>
									</table><!-- /.table -->
								</div><!-- /.mail-box-messages -->
							</div><!-- /.box-body -->
							<div class="box-footer no-padding">
								<div class="mailbox-controls">
									<div class="box-tools pull-left">
										<div class="has-feedback">
											<i>(<?php echo date("Y/m/d",strtotime( $week_firstday)); ?>-<?php echo date("Y/m/d",strtotime($week_lastday)) ; ?>)</i>
										</div>
									</div><!-- /.box-tools -->
								</div>
								<br>
							</div>
						</div><!-- /. box -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			<?php } ?>		
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	<script>
		$(function() {
			$(".del_user").click(function() {
				var selectedId =  $(this).attr("data-selected-id");
				var t  = confirm("你确定要删除此小组成员么？");
				if(t == true){
					var total_users = $(".total_users").text();
					$(".total_users").text(--total_users);
					$(".selected_"+selectedId).remove();
					var AjaxUrl = 'group/del';
					$.ajax({
						url: AjaxUrl,
						type: 'POST',
						dataType: 'json',
						data: {selectedId: selectedId},
					})
					.done(function(data) {
						console.log(data);
						console.log("success");
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
						
						

				}else{
					return false;
				}
			});
		});
	</script>
	
</body>
</html>