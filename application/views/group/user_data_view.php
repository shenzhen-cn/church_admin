<?php 
	$user_create_at  	= isset($user_create_at) ? $user_create_at : "" ;
	$spirituality    	= isset($spirituality) ? $spirituality : "";
	$prayer_for_group 	= isset($prayer_for_group) ? $prayer_for_group : "";
	$prayer_for_urgent 	= isset($prayer_for_urgent) ? $prayer_for_urgent : "";

	$group_userHead_src 	  = isset($group_userHead_src) ? $group_userHead_src : "";
	$userHead_src             = isset($group_userHead_src->userHead_src) ? $group_userHead_src->userHead_src : "";
	$spiri_total_count 		  = !empty($spiri_total_count) ? $spiri_total_count  : "0";
	$spiri_week_count 		  = !empty($spiri_week_count) ? $spiri_week_count : "0";

	$prayer_group_week_count  = !empty($prayer_group_week_count) ? $prayer_group_week_count : "0";
	$urgent_group_week_count  = !empty($urgent_group_week_count) ? $urgent_group_week_count : "0";
	$prayer_group_total_count = !empty($prayer_group_total_count) ? $prayer_group_total_count : "0";
	$urgent_group_total_count = !empty($urgent_group_total_count) ? $urgent_group_total_count : "0";
	$group_user_info 		  = isset($group_user_info) ? $group_user_info : "";
	var_dump($group_user_info);exit;
	$user_created_at          = isset($group_user_info->user_created_at) ?  $group_user_info->user_created_at : "";
	var_dump($user_created_at);exit;

	$reg_days				  =  diffBetweenTwoDays(date("Y-m-d",strtotime($user_created_at)) ,date("Y-m-d",time())) + 1;

	function diffBetweenTwoDays ($day1, $day2)
	{
	  $second1 = strtotime($day1);
	  $second2 = strtotime($day2);
	   
	  if ($second1 < $second2) {
	    $tmp = $second2;
	    $second2 = $second1;
	    $second1 = $tmp;
	  }
	  return ($second1 - $second2) / 86400;
	}
	
	//两个数相除得百分比
	function get_percentage($val1,$val2,$decimal = 2)
	{
	    if ($val2==0) {
	        return "0%";
	    }

	    return round($val1 / $val2 * 100 , $decimal) . "%";
	}

	$user_group_id            = isset($group_user_info->group_id) ?  $group_user_info->group_id : "";
	$group_name               = isset($group_user_info->group_name) ?  $group_user_info->group_name: "";
	$group_leader_id          = isset($group_user_info->group_leader_id) ?  $group_user_info->group_leader_id: "";
	$user_id                  = isset($group_user_info->user_id) ?  $group_user_info->user_id: "";
	$nick                     = isset($group_user_info->nick) ?  $group_user_info->nick: "";
	$sex                      = isset($group_user_info->sex) ?  $group_user_info->sex: "男";
	$group_ranking_result     = !empty($group_ranking_result) ? $group_ranking_result : "0";

	$tq_ranking_result 		  = !empty($tq_ranking_result) ? $tq_ranking_result : "0";
	$role_user_head_base_src  = ROLE_USER_HEAD_BASE_SRC;

 ?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>成员信息-使命青年团契</title>
<?php $this->load->view('tq_head'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/css/fullcalendar.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/css/fullcalendar.print.css" media='print'>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				成员灵修统计
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li><a href="<?php echo site_url('group?group_id='."$user_group_id"); ?>">小组</a></li>
				<li class="active">成员灵修统计</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="col-md-12">
				<div class="row">
				  <div class="col-md-4">
				    <!-- Widget: user widget style 1 -->
				    <div class="box box-widget widget-user-2">
				      <!-- Add the bg color to the header using any of the bg-* classes -->
				      <div class="widget-user-header bg-yellow">
				        <div class="widget-user-image">
			               <?php if (empty($userHead_src)) {?>
			                  <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle" alt="User Image">
			               <?php } else { ?>
							<img src="<?php echo $role_user_head_base_src."/$userHead_src"; ?>"  class="img-circle" alt="User Image">
			                <?php   } ?>				        
				        </div><!-- /.widget-user-image -->
				        <h3 class="widget-user-username"><?php echo $nick; ?><small>(<?php echo $sex ; ?>)</small></h3>
				        <h5 class="widget-user-desc">
				        	<?php echo $group_name; ?>				        					        	
				        	<?php if($group_leader_id == $user_id ){ ?>
								组长 		
				        	<?php	}else{ ?>
								组员
				        	<?php } ?>
				       </h5>
				      </div>
				      <div class="box-footer no-padding">
				        <ul class="nav nav-stacked">
				          <li><a href="javascript:void(0)">在线天数<span class="pull-right badge bg-aqua"><?php echo $reg_days; ?></span></a></li>
				          <li><a href="javascript:void(0)">灵修天数<span class="pull-right badge btn-warning"><?php echo $spiri_total_count; ?></span></a></li>
				          <li><a href="javascript:void(0)">亏欠天数<span class="pull-right badge bg-aqua"><?php echo $reg_days - $spiri_total_count; ?></span></a></li>				          
				          <li><a href="javascript:void(0)">总灵修率<span class="pull-right badge bg-red"><?php echo get_percentage($spiri_total_count,$reg_days) ?></span></a></li>
				          <li><a href="javascript:void(0)">小组排名<span class="pull-right badge bg-aqua"><?php echo $group_ranking_result; ?></span></a></li>
				          <li><a href="javascript:void(0)">团契排名<span class="pull-right badge bg-aqua"><?php echo $tq_ranking_result; ?></span></a></li>				          
				          <li><a href="javascript:void(0)">本周灵修总次数<span class="pull-right badge bg-aqua"><?php echo $spiri_week_count; ?></span></a></li>
				          <li><a href="javascript:void(0)">本周祷告总次数<span class="pull-right badge bg-blue"><?php echo $prayer_group_week_count + $urgent_group_week_count; ?></span></a></li>				          
				          <li><a href="javascript:void(0)">小组祷告总次数<span class="pull-right badge bg-green"><?php echo $prayer_group_total_count; ?></span></a></li>				          
				          <li><a href="javascript:void(0)">紧急祷告总次数<span class="pull-right badge bg-red"><?php echo $urgent_group_total_count; ?></span></a></li>				          				          
				        </ul>
				      </div>
				    </div><!-- /.widget-user -->
				  </div><!-- /.col -->

				  <div class="col-md-8">
				  	<div class="box box-primary">
				  		<div class="box-body no-padding">
				  			<!-- THE CALENDAR -->
				  			<div id="calendar"></div>
				  		</div><!-- /.box-body -->
				  	</div><!-- /. box -->
				  </div>
				  </div>
				</div><!-- /.row -->		
			</div>				
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<?php  $this->load->view('tq_footer'); ?>
	<script src="<?php echo base_url(); ?>public/plugins/js/fullcalendar.js"></script>
	<script src="<?php echo base_url(); ?>public/plugins/js/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>public/plugins/js/fullcalendar.min.js"></script>
	<script>
	  $(function () {

	    /* initialize the calendar
	     -----------------------------------------------------------------*/
	    //Date for the calendar events (dummy data)
	    var date = new Date();
	    var d = date.getDate(),
	            m = date.getMonth(),
	            y = date.getFullYear();

	    $('#calendar').fullCalendar({
	      header: {
	        left: 'prevYear,nextYear',
	        center: 'title',
	        right: 'prev,next today'
	      },
	      buttonText: {
	        today: '今天',
	        prevYear: '上一年',
	        nextYear: '下一年',
	      },
	      height:'auto',
	      // contentHeight:'150px',

	      monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
	      monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
	      dayNames: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],
	      dayNamesShort: ['日', '一', '二', '三', '四', '五', '六'],
	      //Random default events
	      events: [
      		<?php if (!empty($spirituality)) { ?>
        	<?php foreach ($spirituality as $k => $v) {
        		$created_at = $v->created_at;
        		// var_dump($created_at);exit;
        	 ?>
	        {
    		  title: '已灵修',
    		  start: '<?php echo $created_at; ?>',	         
	          backgroundColor: "#f39c12", //red
	          borderColor: "#f39c12" //red
	        },
        	<?php } ?>
      		<?php }; ?>
      		<?php if (!empty($user_create_at)) { ?>
	        {
	          title: '注册时间',
	          start: '<?php echo $user_create_at; ?>',
	          // end: new Date(y, m, d - 2),
	          backgroundColor: "#f39c12", //yellow
	          borderColor: "#f39c12" //yellow
	        },
      		<?php }; ?>
      		<?php if (!empty($prayer_for_group)) {
      				foreach ($prayer_for_group as $k => $v) {
      					$created_at = $v->created_at; ?>
      		{
      		  title: '小组祷告',
      		  start: '<?php echo $created_at; ?>',
      		  allDay: false,
      		  backgroundColor: "#00a65a", //Blue
      		  borderColor: "#00a65a" //Blue
      		},			
      		<?php }
      		 ?> 
      		<?php }; ?>
	        <?php if (!empty($prayer_for_urgent)) {
	        		foreach ($prayer_for_urgent as $k => $v) {
	        				$created_at = $v->created_at;
	        		 ?>
	        {
	          title: '紧急代祷',
	          start: '<?php echo $created_at; ?>',
	          allDay: false,
	          backgroundColor: "#f56954", //Info (aqua)
	          borderColor: "#f56954" //Info (aqua)
	        },	        			
	        		<?php }
	         ?>
	        <?php }; ?>	        
	      ],	  
	      editable: false,
	      droppable: false, 
	    });

	  });

	</script>
	
	
</body>
</html>