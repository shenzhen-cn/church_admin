<?php
		$results = isset($results) ? $results : "";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>注册状态查询</title>
	<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				用户注册状态查询
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">用户注册状态查询</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">注册状态</h3>
								<div class="box-tools pull-right">
								  <div class="has-feedback">
								    <div class="btn-group">
								      <?php if (isset($page)) echo ($page-1)*10+1; ?>
								      -<?php if (isset($page) && isset($total) && $page*10 < $total ){
								           echo $page*10;
								           }else {
								            echo $total ;
								            } ?>
								      /<?php if (isset($total)) echo $total; ?>                    
								    </div><!-- /.btn-group -->
								  </div>
								</div><!-- /.box-tools -->
							</div><!-- /.box-header -->
							<div class="box-body">

							<div class="table-responsive mailbox-messages">
								<?php 	if (!empty($results)) { ?>
									<table class="table table-bordered">
										<tr>
											<th>编号</th>
											<th>注册邮箱</th>
											<th>申请注册时间</th>
											<th>注册链接过期时间</th>
											<th>是否已经注册</th>
										</tr>
										<?php  foreach ($results as $k => $v) {

										 	$id 		    = $v->id;
										 	$user_name      = $v->user_name;
										 	$status         = $v->status;
										 	$created_url_at = $v->created_url_at;
										 	$token_exptime  = $v->token_exptime; 
										 	?>

											<tr>
												<td><?php 	echo $k+1; ?></td>
												<td><?php 	echo $user_name; ?></td>
												<td><?php 	echo $created_url_at; ?></td>
												<td><?php 	echo $token_exptime; ?></td>
												<?php 	if ($status == 1) { ?>
													<td><strong class="label label-info">已注册</strong></td>
													
												<?php  } else { ?> 

													<td><strong class="label label-danger">未注册</strong></td>
												<?php	} ?>
											</tr>

									<?php	 }?>
									
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

	<?php  $this->load->view('tq_footer'); ?>

</body>
</html>