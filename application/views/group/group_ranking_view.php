<?php 

$last_month_results    = isset($last_month_results) ? $last_month_results : "";
$last_week_results     = isset($last_week_results) ? $last_week_results : "";


?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>小组-使命青年团契</title>
	<?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php  $this->load->view('tq_header'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				小组
				<small>IN GOD WE TRUST</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
				<li class="active">小组灵修排名</li>
			</ol>
		</section>  		

    <!-- Main content -->
    <section class="content">                
          <?php if(!empty($last_week_results)){ ?>
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h2 class="page-header">
                    <i class="fa fa-globe"></i> 灵修排名
                  </h2>
                  <div class="box-tools pull-right">                  
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">  
                  <?php if (!empty($last_week_results)) {
                    $the_first_group_of_week = end($last_week_results);
                    $group_name  = $the_first_group_of_week->group_name;
                    $rate  = $the_first_group_of_week->rate;
                    $nick  = $the_first_group_of_week->nick;
                    $count_attencers  = $the_first_group_of_week->count_attencers;                    
                    $end_date  = date("Y/m/d",strtotime( $the_first_group_of_week->end_date));                    
                    $start_date  = date("Y/m/d",strtotime( $the_first_group_of_week->start_date));                                        
                  } ?>             
                  <!-- info row -->
                  <div class="row invoice-info">
                   <div class="col-sm-4 invoice-col">
                     <h3>上周灵修第一名</h3>
                     <address>
                       <p class="btn btn-primary btn-lg"><?php echo $group_name; ?></p>
                       <br><br>
                       <b>小组人数：</b><?php echo $count_attencers; ?><br>
                       <b>灵修率：</b><?php echo $rate; ?><br>
                       <b>组长：</b><?php echo $nick ?><br>
                       <b>时间：</b><?php echo $start_date; ?>——<?php echo $end_date; ?><br>
                     </address>
                   </div><!-- /.col -->

                   <?php if (!empty($last_month_results)) { 
                    $the_first_group = end($last_month_results);
                              // var_dump($the_first_group);exit;
                    $the_first_group_rate = $the_first_group->rate;
                    $the_first_group_name = $the_first_group->group_name;
                    $the_first_group_leader_nick = $the_first_group->nick;
                    $the_first_group_count_attencers = $the_first_group->count_attencers;
                    $end_date  = date("Y/m/d",strtotime( $the_first_group->end_date));                    
                    $start_date  = date("Y/m/d",strtotime( $the_first_group->start_date));

                    $the_last_group = $last_month_results['0'];
                    $the_last_group_rate = $the_last_group->rate;
                    $the_last_group_name = $the_last_group->group_name;
                    $the_last_group_leader_nick = $the_last_group->nick;
                    $the_last_group_count_attencers = $the_last_group->count_attencers;


                    ?>                      
                    <div class="col-sm-4 invoice-col">
                     <h3>上月灵修第一名</h3>
                     <address>
                       <p  class="btn btn-success btn-lg"><?php echo $the_first_group_name; ?></p><br>
                       <br>
                       <b>小组人数：</b><?php echo $the_first_group_count_attencers; ?><br>
                       <b>灵修率：</b><?php echo $the_first_group_rate; ?><br>
                       <b>组长：</b><?php echo $the_first_group_leader_nick; ?><br>
                       <b>时间：</b><?php echo $start_date; ?>——<?php echo $end_date; ?><br>

                     </address>
                   </div><!-- /.col -->
                   <div class="col-sm-4 invoice-col">
                     <h3>上月灵修最差</h3>
                     <address>
                      <p  class="btn btn-danger btn-lg"><?php echo $the_last_group_name; ?></p><br>
                      <br>
                      <b>小组人数：</b><?php echo $the_last_group_count_attencers; ?><br>
                      <b>灵修率：</b><?php echo $the_last_group_rate; ?><br>
                      <b>组长：</b><?php echo $the_last_group_leader_nick; ?><br>
                      <b>时间：</b><?php echo $start_date; ?>——<?php echo $end_date; ?><br>
                    </address>
                  </div><!-- /.col -->
                  <?php } ?>

                </div><!-- /.row -->
                              
                </div><!-- ./box-body -->                
              </div><!-- /.box -->

              <?php if (!empty($last_week_results)) { ?>        
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">上周灵修统计表</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>序号</th>
                      <th>组名</th>
                      <th>组长</th>
                      <th>小组人数</th>
                      <th>完成灵修进度</th>
                      <th>上周灵修率</th>
                      <th>时间</th>
                    </tr>
                    <?php foreach ($last_week_results as $k => $v) {
                      $rate  = $v->rate;
                      $group_name  = $v->group_name;
                      $nick  = $v->nick;
                      $start_date  = $v->start_date;
                      $end_date  = $v->end_date;
                      $count_attencers  = $v->count_attencers;?>
                      <tr>
                        <td><?php echo $k+1; ?></td>
                        <td><?php echo $group_name; ?></td>
                        <td><?php echo $nick; ?></td>
                        <td><?php echo $count_attencers; ?></td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger" style="width: <?php echo $rate; ?>"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-red"><?php echo $rate; ?></span></td>                      
                        <td><?php echo $start_date; ?>——<?php echo $end_date; ?></td>
                      </tr>
                      <?php }?>                  
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
                <?php }?>

                <?php if (!empty($last_month_results)) { ?>

                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">上月灵修统计表</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body table-responsive">
                    <table class="table table-striped">
                      <tr>
                       <th>序号</th>
                       <th>组名</th>
                       <th>组长</th>
                       <th>小组人数</th>
                       <th>完成灵修进度</th>
                       <th>上周灵修率</th>
                       <th>时间</th>
                     </tr>
                     <?php foreach ($last_month_results as $key => $value) {
                      $last_month_rate  = $value->rate;
                      $last_month_group_name  = $value->group_name;
                      $last_month_nick  = $value->nick;
                      $last_month_start_date  = $value->start_date;
                      $last_month_end_date  = $value->end_date;
                      $last_month_count_attencers  = $value->count_attencers;?>
                      <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $last_month_group_name; ?></td>
                        <td><?php echo $last_month_nick; ?></td>
                        <td><?php echo $last_month_count_attencers; ?></td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo $last_month_rate; ?>"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-green"><?php echo $last_month_rate; ?></span></td>                      
                        <td><?php echo $last_month_start_date; ?>——<?php echo $last_month_end_date; ?></td>
                      </tr>
                      <?php } ?>                      
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <?php } ?>

            </div><!-- /.col -->
          </div><!-- /.row -->
          <?php }?>
        </section><!-- /.content -->
        <div class="clearfix"></div>
      </div><!-- /.content-wrapper -->

      <?php  $this->load->view('tq_footer'); ?>
      <script>
        $(function(){
          $(".del_alert").click(function(){
            var alertId = $(this).attr('data-alert-id');
            var ajaxurl = "<?php echo site_url('alert_messages/remove_alert_by_id'); ?>";
            $.ajax({
              url: ajaxurl,
              type: 'POST',
              dataType: 'json',
              data: {alert_id: alertId},
            })
            .done(function(data) {
              console.log(data);
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
    </body>
    </html>