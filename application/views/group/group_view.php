<?php 	
		$group_id 				= isset($results->id) ? $results->id : "";				
		$group_name 			= isset($results->group_name) ? $results->group_name : "";
		$group_leader_id 		= isset($results->group_leader_id) ? $results->group_leader_id : "";		
		$user_group_id          = isset($user_info->group_id) ? $user_info->group_id : "";
		$group_name 			= isset($group_name) ? $group_name : "" ;
		$week_firstday 			= isset($week_firstday) ? $week_firstday : "" ;
		$week_lastday 			= isset($week_lastday) ? $week_lastday : "" ;	
		$week_s_reports 		= isset($week_s_reports) ? $week_s_reports : ""; 
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

			<?php if(!empty($week_s_reports)){ ?>

				<div class="row">
					<div class="col-md-12 ">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">本周<?php echo $group_name; ?>灵修</h3>
								<div class="box-tools pull-right">
									<span class="label label-danger"><span class="total_users"><?php echo count($week_s_reports); ?></span>人小组</span>
								</div>
							</div><!-- /.box-header -->

							<div class="box-body no-padding">
								<div class="table-responsive mailbox-messages">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>编号</th>
												<th>昵称</th>
												<th>性别：</th>
											    <th>总灵修次数：</th>
												<th>本周灵修(天)</th>
												<th>完成进度</th>
												<th>本周灵修率</th>
												<th>本周小组排名</th>
											    <th>编辑：</th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$no =1;
											foreach ($week_s_reports as $k => $v) { 
												$group_user_id = $v['group_user_id'];
												$group_user_nick = $v['group_user_nick'];
												$group_user_sex = $v['sex'];
									  			$group_user_count_spirituality = $v['count_spirituality'];
												$this_week_count = $v['this_week_count'];
												$should_completed_counts = $v['should_completed_counts'];
												$progress = $v['progress'];
												$group_user_rank = $v['group_user_rank'];																							
												$use_status = $v['use_status'];
											?>

											<tr class="selected_<?php echo $group_user_id;?>">
												<td><?php echo $no; ?></td>
												<td>
													<a href="<?php echo site_url('group/get_user_data?id='."$group_user_id"); ?>">														
														<?php echo $group_user_nick; ?>
													</a>
												</td>
											    <td><?php echo $group_user_sex; ?></td>	
											    <td><span class="label label-success"><?php echo $group_user_count_spirituality; ?></span></td>											    											
												<td><?php echo $this_week_count; ?></td>
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
											    <td class="aa">
											    	<?php if($use_status == 'A'){ ?>
												    	<button class="btn btn-success frozen_user btn-sm frozen_status_<?php echo $group_user_id;?>" data-selected-id="<?php echo $group_user_id;?>">冻结</button>
											    	<?php }else{ ?>
												    	<button class="btn btn-warning frozen_user btn-sm frozen_status_<?php echo $group_user_id;?>" data-selected-id="<?php echo $group_user_id;?>">解冻</button>
											    	<?php } ?>
											    	<button class="btn btn-danger del_user btn-sm"  data-selected-id="<?php echo $group_user_id;?>">删除</button>
											    </td>

											</tr>
											
										<?php $no++ ; } ?>

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
					$.ajax({
						url: 'group/del',
						type: 'POST',
						dataType: 'json',
						data: {selectedId: selectedId},
					})
					.done(function(data) {
						if(data.status == '200'){
							var total_users = $(".total_users").text();
							$(".total_users").text(--total_users);
							$(".selected_"+selectedId).remove();
						};
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

			$(".frozen_user").click(function() {
				var selectedId =  $(this).attr("data-selected-id");
				var frozenText =  $(".frozen_status_"+selectedId).text();

				if($(this).hasClass("btn-success")){

					var t  = confirm("你确定要冻结此小组成员么？");

					if(t == true){

						$.ajax({
							url: 'group/frozen',
							type: 'POST',
							dataType: 'json',
							data: {selectedId: selectedId},
						})
						.done(function(data) {
							if(data.status = '200'){
								$(".frozen_status_"+selectedId).removeClass("btn-success").addClass("btn-warning");
							    $(".frozen_status_"+selectedId).text("解冻");
								console.log("success")
							}else{
								alert("异常错误！");
							}
						;
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

				}else{

					var t  = confirm("你确定要解冻此小组成员么？");

					if(t == true){

						$.ajax({
							url: 'group/frozen',
							type: 'POST',
							dataType: 'json',
							data: {selectedId: selectedId},
						})
						.done(function(data) {
							if(data.status = '200'){
								$(".frozen_status_"+selectedId).removeClass("btn-warning").addClass("btn-success");
							    $(".frozen_status_"+selectedId).text("冻结");

								console.log("success")
							}else{
								alert("异常错误！");
							}
						;
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
				}			

			});
		});
	</script>
	
</body>
</html>