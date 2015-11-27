<?php 

	$results      = isset($results) ? $results : "" ;	
	$document_id  = isset($results->id) ? $results->id : "" ;	
	$edit_content = isset($results->edit_content) ? $results->edit_content : "" ;	
	$created_at   = isset($results->created_at) ? $results->created_at : "" ;	

 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>编辑课程</title>
	<!-- Bootstrap 3.3.5 -->
	<link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>public/css/bootstrap.css.map" rel="stylesheet">
	<!-- Theme style -->
	<link href="<?php echo base_url(); ?>public/css/AdminLTE.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/plugins/ueditor/utf8-php/themes/default/css/ueditor.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	
	<section class="content">
		<form  method="post" action="<?php 	echo base_url('priest_preach/getmyEditor'); ?>">
			<div class="col-md-12">
				<div class="row">
					<div class="form-group">
						<script type="text/plain" id="myEditor" name="myEditor">

						</script>
					</div>
				</div>
				<div style="display:none;">
					<input type="hidden" id="daily_content" value='<?php echo $edit_content; ?>'>
				</div>
				<input type="hidden" name="document_id" value="<?php echo $document_id; ?>">	
				<div class="box-footer">
					<div class="pull-right">
						<?php if (!empty($document_id)): ?>
							<a href="<?php echo base_url('priest_preach/del_document?document_id='."$document_id"); ?>" class="btn btn-danger" id="preview" onclick=" return drop_confirm()">删除</a>							
						<?php endif ?>
						<button class="btn btn-primary" id="preview" onclick="if(!check_is_blank()){return false;}">提交上传</button>
					</div>
					<button class="btn btn-waring" onclick="window.history.back()">返回</button>
				</div><!-- /.box-footer -->
			</form>	
		</section>

		<script src="<?php echo base_url(); ?>public/plugins/ueditor/utf8-php/ueditor.config.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>public/plugins/ueditor/utf8-php/ueditor.all.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>public/plugins/js/jquery-2.1.4.min.js" type="text/javascript"></script>
		
		<script type="text/javascript">
		

			var editor_a = UE.getEditor('myEditor',{initialFrameHeight:600});

			function check_is_blank () {

				var doc=document,
				version=editor_a.options.imageUrl||"php",
				form=doc.getElementById("form");

				if(!UE.getEditor('myEditor').hasContents()){

					alert("请输入文本内容");
					return false;
				}else{
					return true;
				}
			}

	        var content =$('#daily_content').val();
	        editor_a.addListener("ready", function () {
	        
		        editor_a.setContent(content, true); 
	        });

	        function drop_confirm()
	        {
	        	var r=confirm("你确定删除此文件么");
	        	if (r==true)
	        	{
	        		return true;
	        	}
	        	else
	        	{
	        		return false;
	        	}
	        }	
		</script>
		<style type="text/css">
			label{
				color: red;
				font-size: 20px;
			}
		</style>

	</body>
	</html>
