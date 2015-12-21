<?php
	$results        = isset($results) ? $results : "";
  	$group_info     = isset($group_info) ?  $group_info : "";
  	$admins_info    = isset($admins_info) ? $admins_info : "";
  	$user_nick 		= $this->input->get("user_nick");
  	$user_group_id 	= $this->input->get("user_group_id");
  	$admins_id 		= $this->input->get('admins_id');
  	$user_email 	= $this->input->get('user_email');
  	$member_status 	= $this->input->get('member_status');
  	$reg_start_time = $this->input->get('start_time');
  	$reg_end_time 	= $this->input->get('end_time');

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>注册状态查询</title>
	<?php  $this->load->view('tq_head'); ?>
	<link href="<?php echo base_url(); ?>public/plugins/css/bootstrap-datetimepicker.css" rel="stylesheet" />
	<style type="text/css">
		.search_panel{
			padding-top: 5px;
			margin-bottom:20px; 
			background-color: #ECF0F5;
		}		
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				用户管理
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">用户管理</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">				
					<div class="box box-primary">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">用户管理</h3>								
							</div><!-- /.box-header -->
							<div class="box-body">
							<form class="form-horizontal" action="<?php echo site_url('personal/user_registered'); ?>" method="get">								
					            <div class="box-body search_panel">
					              <div class="row">					               
					                <div class="col-md-4">		
					                	<div class="form-group">
					                		<label class="col-md-4 control-label">成员昵称:</label>
					                		<div class="col-md-8">
					                			<input type="text"  name="user_nick" class="form-control" value="<?php echo $user_nick; ?>">
					                		</div>
					                	</div>
					                	<?php if (!empty($group_info)): ?>					                		
						                	<div class="form-group">
						                		<label class="col-md-4 control-label">所在小组:</label>
						                		<div class="col-md-8">
							                		<select class="form-control" name="user_group_id">
								                			<option value="0">全部</option>
							                			<?php foreach ($group_info as $k => $v) {
							                				$group_id = $v->id;
							                				$group_name = $v->group_name; 
							                			?>
								                			<option value="<?php echo $group_id; ?>" <?php if($group_id == $user_group_id )echo "selected"; ?>><?php echo $group_name; ?></option>
							                			<?php 	
							                			} ?>

							                		</select>
						                		</div>
						                	</div>	
					                	<?php endif ?>
					                	<div class="form-group">
					                		<label class="col-md-4 control-label">提交注册管理员:</label>
					                		<div class="col-md-8">
					                			<?php if (!empty($admins_info)): ?>
					                				<select class="form-control" name="admins_id">
							                			<option value="0">全部</option>					                					
							                			<?php foreach ($admins_info as $k => $v) {

							                				$admin_id = $v->id;
							                				$admin_nick = $v->nick; 
							                			?>
								                			<option value="<?php echo $admin_id; ?>" <?php if($admin_id == $admins_id )echo "selected"; ?>><?php echo $admin_nick; ?></option>
							                			<?php 	
							                			} ?>
							                		</select>
					                			<?php endif ?>
					                		</div>
					                	</div>				                				
					                </div>
					                <div class="col-md-4">		
					                	<div class="form-group">
					                		<label class="col-md-4 control-label">注册邮箱:</label>
					                		<div class="col-md-8">
					                			<input type="email"  name="user_email" class="form-control" value="<?php 	echo $user_email; ?>">
					                		</div>
					                	</div>					                	
					                	<div class="form-group">
					                		<label  class="col-md-4 control-label">注册时间(起):</label>
					                		<div class="col-md-8">
					                			<div class="input-group">
					                				<div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
					                	            <input type="text" class="form-control starttime" name="start_time"  value="<?php 	echo $reg_start_time; ?>">
					                	        </div>    
					                		</div>
					                	</div>				
					                </div>
					                <div class="col-md-4">		
					                	<div class="form-group">
					                		<label class="col-md-4 control-label">注册状态:</label>
					                		<div class="col-md-8">
						                		<select class="form-control" name="member_status">
						                			<option value="2" <?php if($member_status == "2") echo "selected";?> >全部</option>
						                			<option value="1" <?php if($member_status == "1") echo "selected";?> >已注册</option>
						                			<option value="0" <?php if($member_status == "0") echo "selected";?> >未注册</option>
						                		</select>
					                		</div>
					                	</div>
					                	<div class="form-group">
					                		<label  class="col-md-4 control-label">注册时间(终):</label>
					                		<div class="col-md-8">
					                			<div class="input-group">
					                				<div class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
					                	            <input type="text" class="form-control endtime" name="end_time"  value="<?php 	echo $reg_end_time; ?>">
					                	        </div>    
					                		</div>
					                	</div>						               						                				
					                </div>
					              </div>

				                	<div class="clearfix"></div>
				                	<div class="pull-right">
				                		<div class="col-md-offset-2 col-md-10">
				                      		<button type="submit" class="btn btn-primary">搜索</button>
				                	    </div>		
				                	</div>		                
					            </div>
							</form>
							<div class="clearfix"></div>

							<div class="table-responsive mailbox-messages">
								<?php $i=1;	if (!empty($results)) { ?>
									<table class="table table-bordered">
										<tr>
											<th>编号</th>
											<th>注册邮箱</th>
											<th>注册状态</th>
											<th>使用状态</th>
											<th>备注</th>
											<th>成员昵称</th>
											<th>所在小组</th>
											<th>成员性别</th>
											<th>申请注册时间</th>
											<th>注册链接失效时间</th>
											<th>提交注册管理员</th>
											<th>管理</th>
										</tr>
										<?php  foreach ($results as $k => $v) {
										 	$re_user_id 	= $v->re_user_id;
										 	$group_user_id  = $v->group_user_id;
										 	$user_nick      = $v->user_nick;
										 	$sex            = $v->sex;
										 	$user_name      = $v->user_name;
										 	$status         = $v->status;
										 	$user_deleted_at= $v->user_deleted_at;
										 	$remark         = $v->remark;

										 	$created_url_at = $v->created_url_at;
										 	$token_exptime  = $v->token_exptime; 
										 	$admin_nick     = $v->admin_nick;	
										 	$group_name     = $v->group_name;	
										 	?>
											<tr class="selected_<?php echo $group_user_id;?>">
												<td><?php 	echo $i+($page-1)*10; ?></td>
												<td><?php 	echo $user_name; ?></td>
												<?php 	if ($status == 1) { ?>
													<td><strong class="label label-info">已注册</strong></td>
													
												<?php  } else { ?> 

													<td><strong class="label label-warning">未注册</strong></td>
												<?php	} ?>
												<td>
													<?php 	if (!empty($status)) { ?>
													<?php if(!empty($user_deleted_at))
													{ ?>														
														<button type="button" class="btn btn-danger btn-xs">已删除</button>
													<?php }else{ ?>
														<button type="button" class="btn btn-success btn-xs">正在使用</button>
													<?php }?>														
													<?php } ?>	
												</td>
												<td><span id="re_id_<?php echo $re_user_id; ?>"><?php 	echo $remark; ?></span></td>
												<td><?php 	echo $user_nick; ?></td>
												<td><?php   echo $group_name; ?></td>
												<td><?php 	echo $sex; ?></td>
												<td><?php 	echo $created_url_at; ?></td>
												<td><?php 	echo $token_exptime; ?></td>
												<td><?php   echo $admin_nick; ?></td>											
												<td>
													<?php if (!empty($status)){ ?>
														<?php if (empty($user_deleted_at)): ?>																		
															<a href="<?php echo site_url('personal/detail_user_reg?re_user_id='."$re_user_id"); ?>" class="btn btn-primary  btn-xs">查看</a>
														<?php endif ?>			
													<?php }else{ ?>
														<button class="btn btn-primary add_remark btn-xs" data-reg-id="<?php echo $re_user_id; ?>">添加备注</button>		
													<?php } ?>	
												</td>											
											</tr>	
											<?php $i++; ?>										
									<?php	 }?>
									
									<tfoot>
									  <tr>
									    <td colspan="12"><span class="pull-left">总数量：
										    <?php if (isset($page)) echo ($page-1)*10+1; ?>
									      		-<?php if (isset($page) && isset($total) && $page*10 < $total ){
									           			echo $page*10;
										           }else {
										            echo $total ;
										        } ?>
									      	/<?php if (isset($total)) echo $total; ?>  </span>
								      	</td>
									  </tr>
									</tfoot>	
									</table>
								<?php } ?>										
							</div>									
							</div><!-- /.box-body -->
							<div class="box-footer clearfix">
								<div class="pull-right">
								    <div class="box-tools">
								      <div class="span8 columns" style="float:left">
								          <?php if (isset($pagination)) echo $pagination['html']; ?>
								      </div>
								    </div>
								</div><!-- /.pull-right -->
							</div>
						</div><!-- /.box -->
					</div>		  		
				</div>
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
	<div class="clearfix"></div>


	<?php  $this->load->view('tq_footer'); ?>
	<script src="<?php echo base_url(); ?>public/plugins/js/bootstrap-datetimepicker.js"></script>
	<script src="<?php echo base_url(); ?>public/plugins/js/bootstrap-datetimepicker.zh-CN.js"></script>

	<script>
		$('.starttime').datetimepicker({
			minView:2,
		    format: 'yyyy-mm-dd',
		    language: 'zh-CN',
		    autoclose: true,
		    todayBtn: true,
		    todayHighlight:true,
		}).on('changeDate',function (ev) {
				var starttime = $(".starttime").val();	
				$(".endtime").datetimepicker({
				    format: 'yyyy-mm-dd',					
				    language: 'zh-CN',
					minView:2,
				    autoclose: true,
				    todayBtn: true,
				    todayHighlight:true,				    									
				});
				$(".endtime").datetimepicker('setStartDate',starttime);
				$('.starttime').datetimepicker("hide");				
		});
		
		$(".add_remark").click(function(event) {
			var name=prompt("请输入备注名：","")
			if (name!=null && name!="")
			{
				var regUserId = $(this).attr('data-reg-id');
				$.ajax({
					url: 'remark_reg_user',
					type: 'POST',
					dataType: 'json',
					data: {regUserId: regUserId,remark:name},
				})
				.done(function(data) {
					if (data.status == 200) {
						$("#re_id_"+regUserId).html(name);	
						alert('备注已成功添加！');
					}else{
						alert(data.message);
					};	
				})
				.fail(function() {
					console.log("error");
				});
					
			}
		});
	</script>
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