<?php 	
	// $class_priest_id = $this->input->get('document_id') ? $this->input->get('document_id') : "";
	$results = isset($results) ? $results : "" ;
	// var_dump($results);exit;
	$pre_id = isset($pre_id) ? $pre_id : "" ;
	// var_dump($pre_id);exit;
	$next_id = isset($next_id) ? $next_id : "" ;

	// var_dump($results);exit;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>牧师讲道</title>
	<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				牧师讲道
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">在线阅读</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<?php  $this->load->view('tq_alerts'); ?>
			<div class="row">
				<?php if (!empty($results)) {
						$document_id = $results->id;
						// var_dump($document_id);
						$content = $results->edit_content;
						$created_at = $results->created_at;
						$updated_at = $results->updated_at;
						// var_dump(!empty($updated_at));exit;
				 ?>
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title"></h3>
							<div class="box-tools pull-right">
								<?php if (!empty($pre_id)) { ?>
									<a href="<?php echo base_url('read_myEdit?document_id='."$pre_id"); ?>" class="btn btn-box-tool" data-toggle="tooltip" title="上一篇"><i class="fa fa-chevron-left"></i></a>
								<?php } ?>
								<?php if (!empty($next_id)){ ?>
									<a href="<?php echo base_url('read_myEdit?document_id='."$next_id"); ?>" class="btn btn-box-tool" data-toggle="tooltip" title="下一篇"><i class="fa fa-chevron-right"></i></a>
								<?php	} ?>	
							</div>
						</div><!-- /.box-header -->
						<div class="box-body no-padding">
							<div class="mailbox-read-message">
								<!-- <div class="clearfix"></div>		 -->
								<div class="col-md-12">
									<div class="col-md-12">											
										<small class='pull-right'><i>更新时间：<?php if (! empty($updated_at)) echo $updated_at; else echo $created_at;?></i></small>
										<p class="text-center"><?php echo $content; ?></p>
									</div>	
								</div>
							</div><!-- /.mailbox-read-message -->
						</div><!-- /.box-body -->
						<div class="clearfix">
							
						</div>
						<div class="box-footer">
							<a href="<?php echo base_url('myEdit?id='."$document_id"); ?>" class="btn btn-info pull-right" id="delPriestPreach" data-keyboard="false">编辑</a>
							<button class="btn btn-warning" onclick="window.history.back()"> 返回</button>
						</div><!-- /.box-footer -->
					</div><!-- /. box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		<?php } ?>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php  $this->load->view('tq_footer'); ?>

</body>
</html>