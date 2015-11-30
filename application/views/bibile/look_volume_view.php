<?php 
	$bible_section    = isset($bible_section) ? $bible_section : "";
	$bible_note       = isset($bible_note) ? $bible_note : "";
	$count_chapter    = isset($count_chapter) ? $count_chapter : '';
	// var_dump($count_chapter);exit;

	$id  = $this->input->get('chapter_id') ? $this->input->get('chapter_id') : "1";
	$book_id  = $this->input->get('book_id') ? $this->input->get('book_id') : "1";
	$id++;
	// var_dump($id);exit;

	$volume_name    = isset($volume_name) ? $volume_name : "";

	// var_dump($bible_section);exit;
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
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li><a href="<?php echo site_url('bibile'); ?>">在线圣经</a></li>
				<li class="active">查看经文</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
		    <div class="col-md-12 ">
		      <div class="box">
		        <div class="box-header with-border">
		          <h3 class="box-title"><?php echo $volume_name; ?></h3><i>当前章节：<b style="color:red"><?php echo $id-1;?></b></i>
		          <div class="col-md-1 pull-right input-group-sm" >
			          <input type="button" value="返回上一步" onclick="window.history.back()">
				  </div>
		        </div><!-- /.box-header -->
				<br>
				<?php if (!empty($count_chapter)) { ?>
					
					<form action="<?php echo site_url('look_volume'); ?>" method='get'>
				        <div class="col-md-2 pull-left input-group-sm" >
					        <select class="form-control  " name="chapter_id">
					        <?php for ($select_id = 1; $select_id <= $count_chapter ; $select_id++) { 
					        		if ($select_id == ($id-1)) { ?>
							          <option value="<?php  echo$select_id ;?>" selected="selected">第<?php echo $select_id;?>章</option>
					        <?php 	}else{ ?>
							          <option value="<?php  echo$select_id ;?>" >第<?php echo $select_id;?>章</option>
					        <?php }
								 } ?>
					        </select>	
						</div>
						<input type="hidden" value="<?php echo $book_id; ?>" name='book_id'>
						<button type="submit" class="btn btn-info">跳转章节</button>
					</form>

				<?php } ?>
				<div class="clearfix"></div>
				<br>
		        <div class="box-body no-padding">
		            <div class="nav-tabs-custom">
		              <ul class="nav nav-tabs">
		                <li class="active"><a href="#tab_1" data-toggle="tab">经文</a></li>
		                <li><a href="#tab_2" data-toggle="tab">解经</a></li>
		              </ul>
		              <div class="tab-content">
		                <div class="tab-pane active" id="tab_1">
		                	<?php if (!empty($bible_section)) {
		                		// var_dump($bible_section);exit;
		                			foreach ($bible_section as $k => $v) {
										$bibile_section_id  = $v->id;
		                				$bibile_book_id   =	$v->book_id;
		                				$chapter_id  		 =	$v->chapter_id;
		                				$section     		 =	$v->section;
		                				$content     		 =	$v->content; 
		                				// var_dump($content);exit;?>

					          	        <p id="<?php echo $bibile_section_id; ?>">&nbsp; <?php echo $chapter_id; ?>:<?php echo $section; ?>&nbsp;&nbsp;&nbsp;<?php echo $content; ?></p>

		                	<?php	}
		                	 	                		
		                		 } ?>
		                </div><!-- /.tab-pane -->
		                <div class="tab-pane" id="tab_2">
		          	  	<?php if (!empty($bible_note)) {
			          	  		foreach ($bible_note as $k => $v) {
			          	  			$chapter_id 	= $v->chapter_id; 
			          	  			$section    	= $v->section; 
			          	  			$content    	= $v->content;
			          	  			$note_title     = $v->note_title;
			          	  			 ?>
									<?php if ($section == '0'){ ?>
					          	        <p><?php echo $note_title;?><br><br><?php echo $content;?></p> 
									<?php } else {?>
					          	        <p>【<?php echo $chapter_id ;?>:<?php echo $section; ?>】<b><?php echo $note_title;?></b><br><br><?php echo $content;?></p> 
			          	  	<?php }
			          	  		}
		          	  	} ?>
		          	    
		                </div><!-- /.tab-pane -->
		                
		              </div><!-- /.tab-content -->
		            </div><!-- nav-tabs-custom -->
		        </div><!-- /.box-body -->
    	        <div class="box-footer no-padding">
    	          <div class="mailbox-controls">
    	            <div class="box-tools pull-right">
    	              <div class="has-feedback">
    	               <ul class="pagination pagination-sm no-margin pull-right">
    	               	<?php if (($temp = $id-2) >= 1 ) { ?>
                          <li>
                              <a href="<?php echo site_url('look_volume?book_id='."$bibile_book_id".'&chapter_id='."$temp"); ?>" class="btn btn-box-tool" >上一章</a>
                          </li>
    	               	<?php  } ?>
    	               	<?php if ($id <= $count_chapter) { ?>
                          <li>
                              <a href="<?php echo site_url('look_volume?book_id='."$bibile_book_id".'&chapter_id='."$id"); ?>" class="btn btn-box-tool" >下一章</a>
                          </li>
    	               	<?php } ?>
                        </ul>

    	              </div>
    	            </div><!-- /.box-tools -->
    	          </div>
    	          <br>
    	        </div>
		      </div><!-- /. box -->
		    </div><!-- /.col -->
		  </div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	<script language="javascript">
		$(function(){
			function getarg(url){
				arg=url.split("#");
				return arg[1];
			}

			var href_id = getarg(window.location.href);
			if(href_id != null){				
				document.getElementById(href_id).className='href_style';
			}

		});
	</script>
	<style type="text/css">
		.href_style{
			color: red;
		}
	</style>
</body>
</html>