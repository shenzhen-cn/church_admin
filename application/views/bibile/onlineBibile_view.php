<?php 	
		$search_keyword = $this->input->get('search_keyword') ? $this->input->get('search_keyword')  :"" ;
		$search_keyword = trim($search_keyword);
		$total = isset($total) ?  $total : "";
		$results = isset($results) ?  $results : "";
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
				<li >在线圣经</li>
				<li class="active">查找经文</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
				<?php $this->load->view('tq_alerts'); ?>
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">查询结果</h3>
						</div><!-- /.box-header -->
						<div class="col-md-8">														
							<?php 	if (! empty($total)) { ?>
								<h4>本圣经系统帮你搜索到约有<strong style="color:red;"><?php echo $total; ?></strong>项符合“<?php echo $search_keyword;?>	”的经文</h4><br>	
								
							<?php  } ?>
						</div>
						<div class="clearfix"></div>
						<div class="box-body no-padding">
							<table class="table table-hover">
							<?php 	if (!empty($total)) { 
										foreach ($results as $k => $v) {
											$bibile_section_id  = $v->id;
											$book_id     = $v->book_id;
											$chapter_id  = $v->chapter_id;
											$section     = $v->section;
											$directory   = $v->directory;
											$content     = $v->content;?>
								
									<tr>
										<td style="width: 100px;">
											<font><b><a href="<?php echo base_url().'look_volume?book_id='.$book_id."&chapter_id=".$chapter_id."#".$bibile_section_id; ?>"><?php echo $directory;?><?php echo $chapter_id;?>	:<?php echo $section;?></a></b></font>
										</td>
										<td>
											<span><?php echo str_replace("$search_keyword","<strong class='label label-danger'>".$search_keyword."</strong>","$content"); ?></span>
										</td>

									</tr>


								<?php		}
							?>
							<?php  } ?>
							</table>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix">
						  <div class="span8 columns" style="float:left">
						  	<?php if (isset($pagination)) echo $pagination['html']; ?>
						  </div>
						</div>
					</div><!-- /.box -->
				</div>
			</div>
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>

</body>
</html>