<?php 
	$user_photos_results = isset($user_photos_results) ? $user_photos_results : "";
	$role_user_photos_url = ROLE_USER_PHOTOS_URL;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>团契生活-使命青年团契</title>
	<?php $this->load->view('tq_head'); ?>
	<link rel="stylesheet" href="<?php echo base_url() ; ?>public/css/blueimp-gallery.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ; ?>public/css/bootstrap-image-gallery.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse"  data-spy="scroll" data-target=".navbar-example">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				团契生活
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">团契生活</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<h4><button  onclick="window.history.back()" class="btn ">返回</button></h4>
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="box box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">照片墙</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="content_pbl">
								<div id="device" class="gridalicious">
									<div class="galcolumn">
										<?php if (!empty($user_photos_results)) { 
											foreach ($user_photos_results as $key => $value) {
												$user_album_src_id =$value->user_album_src_id;
												$user_album_src = $value->user_album_src;
												$user_album_id  =$value->user_album_id;
												$album_src_created_at = $value->album_src_created_at;
												$user_album_name = $value->user_album_name;
												$album_user_id = $value->album_user_id;
												$user_nick = $value->user_nick;
												$userHead_src = $value->userHead_src; ?>
												<div class="item item_src_<?php echo $user_album_src_id; ?>">
													<?php if (empty($user_album_src)) {?>
													<img src="<?php echo base_url(); ?>public/images/no_img.jpg" class="user-image">
													<?php } else { ?>
													<a href="<?php echo $role_user_photos_url.$user_album_src; ?>" data-gallery>
														<img src="<?php echo $role_user_photos_url.$user_album_src; ?>" class="img-responsive">			        
													</a>
													<?php   } ?>
													<br>
													<p>
														<a  href="javascript:void(0);"  onclick="del_photos(<?php echo $user_album_src_id; ?>);" class="btn btn-danger  pull-left reomvePhoto  btn-xs">删除</a>
														&nbsp;&nbsp;&nbsp;
														<small>
															<?php echo $user_nick.'的《'.$user_album_name.'》'.$album_src_created_at; ?>
														</small>
														<input type="hidden" name="paths_src" class="paths_src_<?php echo $user_album_src_id;?>" value="<?php echo $user_album_src; ?>">											
													</p>
												</div>	       	 	          		
												<?php 	}
												?>
												<?php } ?>	       	 	          
											</div>	       	 	          
										</div>
									</div>
								</div><!-- /.box-body -->	       	 	     
							</div><!-- /.box -->
						</div><!-- .col -->
					</div><!-- /.row -->

					<div class="col-md-12">
						<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
						<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
							<!-- The container for the modal slides -->
							<div class="slides"></div>
							<!-- Controls for the borderless lightbox -->
							<h3 class="title"></h3>
							<a class="prev">‹</a>
							<a class="next">›</a>
							<a class="close">×</a>
							<a class="play-pause"></a>
							<ol class="indicator"></ol>
							<!-- The modal dialog, which will be used to wrap the lightbox content -->
							<div class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" aria-hidden="true">&times;</button>
											<h4 class="modal-title"></h4>
										</div>
										<div class="modal-body next"></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left prev">
												<i class="glyphicon glyphicon-chevron-left"></i>
												Previous
											</button>
											<button type="button" class="btn btn-primary next">
												Next
												<i class="glyphicon glyphicon-chevron-right"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>	<!-- .col -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<div style="display:none">		
				<input type="hidden" name="currentPage" id="currentPage" value="<?php echo $pagination['page']; ?>">
				<input type="hidden" name="totalPage" id="totalPage" value="<?php echo $pagination['total_pages']; ?>">
				<input type="hidden" name="role_user_photos_url" id="role_user_photos_url" value="<?php echo $role_user_photos_url; ?>">
			</div>


			<?php  $this->load->view('tq_footer'); ?>
			<script src="<?php echo base_url(); ?>public/js/jquery.blueimp-gallery.min.js"></script>
			<script src="<?php echo base_url(); ?>public/js/bootstrap-image-gallery.min.js"></script>			 
			<script src="<?php echo base_url(); ?>public/plugins/js/jquery.grid-a-licious.min.js"></script>


			<script>
			//模拟滚动条滚动时随机添加内容
			var currentPage = $("#currentPage").val();
			var totalPage = $("#totalPage").val();
			var role_user_photos_url = $("#role_user_photos_url").val(); 

			makeboxes = function() {            	

				currentPage = parseInt(currentPage);
				totalPage = parseInt(totalPage);
				currentPage = parseInt(currentPage) + 1;

				var url = "<?php echo site_url('fellowship_life/load_images'); ?>";

				var boxes = new Array; 		
				$.ajax({ 
					type: "post", 
					url: url, 
					cache:false, 
					async:false, 
					dataType: "json",
					data: {page: currentPage},
					success: function(json){ 
						var items = json.user_photos_results;
						for (var i = items.length - 1; i >= 0; i--) {
							var item = items[i];
							var user_album_src_id = item.user_album_src_id;
							var src_old = item.user_album_src;
							var  src    = src_old.replace("\\", '/')

							var user_nick = item.user_nick;
							var user_album_name = item.user_album_name;
							var album_src_created_at = item.album_src_created_at;
							var randTxt = [user_nick+'的《'+user_album_name+'》 时间：'+album_src_created_at];	
							div = $('<div></div>').addClass('item item_src_'+user_album_src_id); 
							content = 		                    
							"<a href='"+role_user_photos_url+src+"' data-gallery><img src='"+role_user_photos_url+src+"'/></a><br><p>"+	     	   			    
							"<a href='javascript:void(0);' onclick='del_photos("+user_album_src_id+")' class='btn btn-danger  pull-left reomvePhoto  btn-xs'>删除</a>&nbsp;&nbsp;&nbsp;<small>"+randTxt+"</small>"+
							"<input type='hidden' name='paths_src' class='paths_src_"+user_album_src_id+"' value='"+src+"'>"+
							"</p>";
							div.append(content);
							boxes.push(div);
						};
					}
				});

				if(currentPage <= totalPage){
					$("#currentPage").val(currentPage);
				};				
				return boxes;            	                

				}

			//滚动条事件
			$(document).ready(function () {         
				$(window).scroll(function () {
					if(($(window).scrollTop() + $(window).height()) == $(document).height())
					{		

						if(currentPage<= totalPage){
							$("#device").gridalicious('append', makeboxes());
						}else{
							
							if(currentPage > 3){
								alert('所有图片已加载完毕！');
							}
						}
					}
				});

				//主要部分
				$("#device").gridalicious({
					gutter: 20,
					width: 300,
					animate: true,
					animationOptions: {
						speed: 150,
						duration: 400,
						complete:function(data){
							console.log("success");	
						}
					},
				});
			});		

			//删除照片
	        function del_photos (argument) {
	        	var src_id = argument;

	        	var r = confirm("你确定删除此文件么");

	        	if(r == true  && src_id != null){
	        		var paths_src = $('.paths_src_'+src_id).val();

	        		var Ajaxurl = 'fellowship_life/del_photos';
	        		$.ajax({
	        			url: Ajaxurl,
	        			type: 'POST',
	        			dataType: 'json',
	        			data:{src_id:src_id,paths_src:paths_src},
	        		})
	        		.done(function(data) {
	        			console.log(data);
	        			if(data.status == 200){
	        				$(".item_src_"+src_id).remove();		
	        			}else{
	        				alert('异常错误!');
	        			}
	        			console.log("success");
	        		})
	        		.fail(function() {
	        			console.log("error");
	        		})
	        		.always(function() {
	        			console.log("complete");
	        		});
	        	}

	        	
	        }
	    </script>

	</body>
	</html>