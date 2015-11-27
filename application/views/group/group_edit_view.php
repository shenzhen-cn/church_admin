<?php 
	$results = isset($results) ? $results : "";
	$group_id = isset($group_id) ? $group_id   : "" ;
	$group_leader_id = isset($group_leader_id) ? $group_leader_id   : "" ;
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
				<div class="col-md-4">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">编辑小组信息</h3>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="<?php echo base_url('group/groupEdit'); ?>" method='post' >
							
								<div class="box-body">
									<div class="form-group">
										<label for="addGroupName">小组名称：</label>
										<?php if (! empty($group_info) && ! empty($group_id)) {
													// var_dump($group_info);exit();
											?>
											<?php	foreach ($group_info as $k => $v) {
													$id   = $v->id;
													$group_name = $v->group_name; 
														if ($group_id == $id) { ?>
														<input type="hidden" name="group_id" value="<?php echo $group_id; ?>" >
														<input type="text" class="form-control" maxlength="10"  name="group_name"  value='<?php echo $group_name; ?>'  required='required' >
															
													<?php	break;}
													?>
												
												<?php }
											} ?>
									</div>

									<div class="form-group " id="snb_place_id">
									<?php if (!empty($results)){ ?>
										<label for="group_leader_id">设置组长：</label>
										<select class="form-control select2" style="width: 100%;" id="group_leader_id" name="group_leader_id">
										<?php foreach ($results as $k => $v){
											// var_dump($results);exit();
												$user_id = $v->id;
												$nick = $v->nick;
												$selected="";
												if ($group_leader_id == $user_id) {
													$selected="selected";
												}
										 ?>
											<option <?php echo $selected; ?> value="<?php echo $user_id; ?>"><?php 	echo $nick; ?></option>
										<?php }?>
										
										</select>
									<?php }  ?>
											
									</div>

								</div><!-- /.box-body -->
								
							<div class="box-footer">
								<a href="<?php echo base_url('group/del_group?group_id='."$group_id"); ?>" type="button" class="btn btn-danger pull-left" >删除
								</a>		
								<button type="submit" class="btn btn-primary pull-right" >提交
								</button>
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