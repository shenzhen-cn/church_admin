<?php 
	$results = isset($results->results) ? $results->results : "";
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>在线圣经-使命青年团契</title>
<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				在线圣经
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">在线圣经</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Info boxes -->
			<div class="row">  
				<?php if (! empty($results)) {?>
					<h1><i class="fa  fa-pied-piper-alt"></i>旧约</h1> 
						<div class="bibile">
							<div class="clearfix visible-sm-block"></div>

								<?php foreach ($results as $k => $v) {
									// var_dump($results);exit;
									$book_id 			= $v->id;
									$bibile_volumeName  = $v->volumeName;
									$bibile_testament   = $v->testament; 
									// var_dump($bibile_id);exit;

									if ($bibile_testament == 'old') { ?>
										<div class="col-md-2 col-sm-3 col-xs-4">
											<a href="<?php echo base_url('look_volume?book_id='."$book_id"); ?>">
												<span class="info-box-icon bg-red"><?php echo $bibile_volumeName; ?></span>
											</a>
										</div><!-- /.col -->
										
								<?php }?>
								
								<?php } ?>
						</div> <!-- /.bibile -->

						<div class="clearfix"></div>
						<br>	
						<h1><i class="fa fa-flag"></i>新约</h1>
						<div class="bibile">
							<div class="clearfix visible-sm-block"></div>

								<?php foreach ($results as $k => $v) {
									// var_dump($results);exit;
									$book_id 			= $v->id;
									$bibile_volumeName  = $v->volumeName;
									$bibile_testament   = $v->testament; 
									// var_dump($bibile_id);exit;

									if ($bibile_testament == 'new') { ?>
										<div class="col-md-2 col-sm-3 col-xs-4">
											<a href="<?php echo base_url('look_volume?book_id='."$book_id"); ?>">
												<span class="info-box-icon bg-aqua"><?php echo $bibile_volumeName; ?></span>
											</a>
										</div><!-- /.col -->
										
								<?php }?>
								
								<?php } ?>
						</div> <!-- /.bibile -->

				<?php } ?>


				
			</div><!-- /.row -->

		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php $this->load->view('tq_footer'); ?>

</body>
</html>

 