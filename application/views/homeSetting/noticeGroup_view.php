<?php
    $group_info     = isset($group_info) ?  $group_info : "";
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>各小组注意事项</title>
  <?php  $this->load->view('tq_head'); ?>
  <link rel="stylesheet"  href="<?php echo base_url()."public/plugins/css/blue.css"; ?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php  $this->load->view('tq_header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        各小组注意事项
        <small>IN GOD WE TRUST</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">各小组注意事项</li>
      </ol>
    </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            
            <div class="col-md-6">
              <?php $this->load->view('tq_alerts'); ?>            
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">小组通知</h3>                  
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="mailbox-controls">
                      <button class="btn btn-primary btn-sm checkbox-toggle">是否/全选</button>
                    </div>
                    <div class="table-responsive mailbox-messages">
                      <div class="col-md-12">
                        <form action="<?php echo site_url('noticeGroup'); ?>" method="post" >
                        <table class="table table-hover table-striped">
                          <tbody>
                          <?php if (!empty($group_info)) {
                                  foreach ($group_info as $k => $v) {
                                   $group_id =  $v->id;
                                   $group_name =  $v->group_name; ?>
                                <tr>
                                  <td><input type="checkbox" name="group_id[]" value="<?php echo $group_id; ?>"></td>
                                  <td class="mailbox-name">
                                    <?php echo $group_name; ?>
                                  </td>
                                </tr>                               
                              <?php }
                           ?>
                          <?php } ?>
                          </tbody>
                          </table><!-- /.table -->
                          <div class="form-group">
                            <label for="notice_contents">通知内容：</label>
                            <textarea type="textarea" class="form-control" id="notice_contents" name="notice_contents" rows="5" ></textarea>
                          </div>
                      </div>
                    </div><!-- /.mail-box-messages -->
                  </div><!-- /.box-body -->
                  <div class="box-footer ">
                      <button type="submit" class="btn btn-primary pull-right">提交</button>
                      <button type="submit" class="btn btn-warning pull-left" onclick="window.history.back()">返回</button>
                  </div>
                  </form>
                </div><!-- /. box -->              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
       
      </div><!-- /.content-wrapper -->
    <?php  $this->load->view('tq_footer'); ?>

    <script src="<?php echo base_url()."public/plugins/js/icheck.min.js"; ?>" type="text/javascript" ></script>
    <script>
      $(function () {
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }
          $(this).data("clicks", !clicks);
        });

      });
    </script>

  </body>
  </html>      