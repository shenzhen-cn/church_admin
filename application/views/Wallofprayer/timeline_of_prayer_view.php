<?php 
	$get_all_prayer  = isset($get_all_prayer) ? $get_all_prayer : "" ;
	$page            = isset($page) ? $page : "";
	$total           = isset($total) ? $total : "";
	$user_Headsrc_base_url = ROLE_USER_HEAD_BASE_SRC;
//var_dump($user_Headsrc_base_url);exit;


?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>祷告墙</title>
	<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				祷告墙
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">祷告墙</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<!-- The time line -->
					<ul class="timeline">
						<?php   if (! empty($get_all_prayer)) { 
								foreach ($get_all_prayer as $k => $v) {
									$group_prayer_id = isset($v->group_prayer_id) ? $v->group_prayer_id : '';
									$created_at = isset($v->created_at) ? $v->created_at : '';
									$group_prayer_contents = isset($v->group_prayer_contents) ? $v->group_prayer_contents : '';
									$user_id = isset($v->user_id) ? $v->user_id : '';
									$userHeadSrc = isset($v->userHeadSrc) ? $v->userHeadSrc : '';
									$conversion_time = isset($v->conversion_time) ? $v->conversion_time : '';
									$urgent_id = isset($v->urgent_id) ? $v->urgent_id : '';
									$content_prayer = isset($v->content_prayer) ? $v->content_prayer : ''; 
									$nick = isset($v->nick) ? $v->nick : ''; ?>

							<?php  if (!empty($group_prayer_id)) { ?>
								<li class="time-label prayer_container_<?php  echo $group_prayer_id;?>">
									<span class="ion-android-people bg-green">
										：<?php echo $nick; ?>
									</span>
								</li>	
								<li class="prayer_container_<?php echo $group_prayer_id;?>">									
									<?php if (empty($userHeadSrc)) {?>
									   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="fa direct-chat-img" alt="用户头像">
									<?php } else { ?>
									 <img src="<?php echo $user_Headsrc_base_url.$userHeadSrc; ?>" class="fa direct-chat-img" alt="用户头像">
									 <?php   } ?>
									<div class="row">
										<div class="box-body">
											<div class="col-md-12">
												<!-- Message to the right -->
												<div class="direct-chat-msg ">
													<div class="direct-chat-info clearfix">
														<span class="direct-chat-timestamp pull-right"><?php echo $conversion_time; ?></span>
													</div><!-- /.direct-chat-info -->														
													<div class="direct-chat-text">
														<?php echo $group_prayer_contents; ?>
														<a href="javascript:;" class="link-black text-lg text-red pull-right  del_prayer" data-prayer-id="<?php echo $group_prayer_id; ?>" content-style="group_prayer"><i class="fa fa-trash-o margin-r-5"></i></a>

													</div><!-- /.direct-chat-text -->
												</div>
											</div>
										</div><!-- /.direct-chat-msg -->
									</div>
								</li>
							<?php }else { ?>
								<li class="time-label prayer_container_<?php echo $urgent_id;?>">
									<span class="ion-ios-people bg-red">
										：<?php echo $nick; ?>										
									</span>
								</li>	
								<li class="prayer_container_<?php  echo $urgent_id;?>">									
								<?php if (empty($userHeadSrc)) {?>
								   <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="fa direct-chat-img" alt="用户头像">
								<?php } else { ?>
								 <img src="<?php echo $user_Headsrc_base_url.$userHeadSrc; ?>" class="fa direct-chat-img" alt="用户头像">
								 <?php   } ?>
								<div class="row">
									<div class="box-body">
										<div class="col-md-12">
											<!-- Message to the right -->
											<div class="direct-chat-msg ">
												<div class="direct-chat-info clearfix">
													<span class="direct-chat-timestamp pull-right"><?php echo $conversion_time; ?></span>
												</div><!-- /.direct-chat-info -->														
												<div class="direct-chat-text">
													<?php echo $content_prayer; ?>
													<a href="javascript:;" class="link-black text-lg text-red pull-right  del_prayer" data-prayer-id="<?php echo $urgent_id; ?>" content-style="urgent_prayer"><i class="fa fa-trash-o margin-r-5"></i></a>
												</div><!-- /.direct-chat-text -->
											</div>
										</div>
									</div><!-- /.direct-chat-msg -->
								</div>
							</li>							
							<?php } ?>			

							<?php 	}
							?>							
						<?php } ?>												
						<!-- END timeline item -->
						<li class="end_timeline">
							<i class="fa fa-angle-double-down"></i>
						</li>
					</ul>
				</div><!-- /.col -->
				<br>
				<div class="col-md-4 col-md-offset-4 laod_more">					
					  <button type="button" id="more_loading" class="btn btn-primary btn-sm  btn-block">加载更多..</button>
					  <input type="hidden" class="current_page" value="<?php echo $page; ?>">
					  <input type="hidden" class="current_total" value="<?php echo $total; ?>">
				</div>
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>	
	<script>
		$(function(){
			var current_total = $(".current_total").val();	

			if(current_total <=10 ){
				$(".laod_more").hide();
			}


			$("#more_loading").click(function(){
			var current_page = $(".current_page").val();	
			// console.log(current_page);
			current_page = parseInt(current_page);
			var current_total = $(".current_total").val();	
			current_total = parseInt(current_total);
			// console.log(current_total);
			var count = Math.ceil(current_total/10);
			
            currentPage = parseInt(current_page) + 1;
			// console.log(currentPage);


			var url  = "<?php echo site_url('Wallofprayer/get_json_wallofprayer');?>";

			 htmlobj=$.ajax({
			 	url:url,
			 	type: "post",
			 	cache:false, 
			 	async:false, 
			 	dataType: "json", 
			 	data: {page: currentPage},
			 	success: function(json){ 
			 		var items = json.get_all_prayer_json;
			 		$.each(items, function(k, v) {
			 			// console.log(v);
			 			if(v.group_prayer_id != null){
			 				
			 				$("ul.timeline").append(
			 				'<li class="time-label prayer_container_'+v.group_prayer_id+'">'+
			 					'<span class="ion-android-people bg-green">：'+v.nick+'</span>'+  			 		                                			 		        
			 				'</li>'+
			 				'<li class="prayer_container_'+v.group_prayer_id+'">'+
				 				'<img src="'+userHeadSrc+v.userHeadSrc+'" class="fa direct-chat-img" alt="用户头像">'+
					 				'<div class="row">'+
						 				'<div class="box-body">'+
							 				'<div class="col-md-12">'+
								 				'<div class="direct-chat-msg ">'+
								 				'<div class="direct-chat-info clearfix">'+
								 					'<span class="direct-chat-timestamp pull-right">'+v.conversion_time+'</span>'+
								 				'</div>'+														
								 				'<div class="direct-chat-text">'+v.group_prayer_contents+
								 				'<a href="javascript:;" class="link-black text-lg text-red pull-right  del_prayer" data-prayer-id="'+v.group_prayer_id+'" content-style="group_prayer"><i class="fa fa-trash-o margin-r-5"></i></a>'+
								 				'</div>'+
							 				'</div>'+
						 				'</div>'+
					 				'</div>'+
				 				'</div>'+
			 				'</li>'
			 				);
							
			 			}else{
			 				$("ul.timeline").append(
			 				'<li class="time-label prayer_container_'+v.urgent_id+'">'+
			 					'<span class="ion-ios-people bg-red">：'+v.nick+'</span>'+  			 		                                			 		        
			 				'</li>'+
			 				'<li class="prayer_container_'+v.urgent_id+'">'+
				 				'<img src="'+userHeadSrc+v.userHeadSrc+'" class="fa direct-chat-img" alt="用户头像">'+
				 				'<div class="row">'+
					 				'<div class="box-body">'+
						 				'<div class="col-md-12">'+
							 				'<div class="direct-chat-msg ">'+
								 				'<div class="direct-chat-info clearfix">'+
								 					'<span class="direct-chat-timestamp pull-right">'+v.conversion_time+'</span>'+
								 				'</div>'+														
								 				'<div class="direct-chat-text">'+v.content_prayer+
								 				'<a href="javascript:;" class="link-black text-lg text-red pull-right  del_prayer" data-prayer-id="'+v.urgent_id+'" content-style="urgent_prayer"><i class="fa fa-trash-o margin-r-5"></i></a>'+
								 				'</div>'+
							 				'</div>'+
						 				'</div>'+
					 				'</div>'+
				 				'</div>'+
			 				'</li>'
			 				);
			 			};			 			
			 		});							 						 			
			 	}
			 	});

				if(currentPage < count){
		           	$(".current_page").val(currentPage);

				}else{
					$("#more_loading").hide();		 						 		    			 		    
				};
	           	$(".end_timeline").hide();
				
	 			$("ul.timeline").append(
	 			'<li class="end_timeline">'+
				'<i class="fa fa-angle-double-down"></i>'+
				'</li>'	
	 			);

			 });		
			
			//	删除祷告
			$("ul.timeline").on("click",".del_prayer",function () {			
				var prayerId = $(this).attr("data-prayer-id");
				var contentStyle = $(this).attr("content-style");
				var y = confirm("你确定要删除这条祷告么？");	

				if(y == false){
					return false;
				};		

				var url = 'group/del_prayer';
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: {prayer_id: prayerId,contentStyle:contentStyle},
				})
				.done(function(data) {
					console.log(data);
					if(data.status == 200){
						$(".prayer_container_"+prayerId).remove();				
					}else{
						alert('未知错误！');	
					};

					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});						
			});
		});
	</script>
	<style type="text/css">
		.timeline>li>.fa, .timeline>li>.glyphicon, .timeline>li>.ion{
			width:40px;
			height:40px;
			left:13px;
		}	
		.box-body{
			margin-top: -25px;
		}							
	</style>
</body>
</html>