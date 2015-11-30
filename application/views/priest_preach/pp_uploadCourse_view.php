<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>上传课件</title>
  <?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php  $this->load->view('tq_header'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        上传课件
        <small>IN GOD WE TRUST</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li><a href="#">牧师讲道</a></li>
        <li class="active">上传课件</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <?php  $this->load->view('tq_alerts'); ?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">上传课件</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <form role="form"   action="<?php  echo site_url('priest_preach/getContent'); ?>"  method="post" enctype="multipart/form-data" onsubmit="return check_file();">
                <div class="col-md-12">
                  <br>  
                  <div class="row">
                    <div class="">
                      <div class="form-group">
                        <label for="course_title" class="col-md-2 control-label">课程课程标题*：</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" id="course_title" name="course_title" required="required" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="share_from" class="col-md-2 col-md-offset-2 control-label">课程分享来自*：</label>
                        <div class="col-md-2">
                          <input type="text" class="form-control" id="share_from" name="share_from" required="required" >
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="">
                      <?php if (!empty($clas_p_p)) { ?>
                      <div class="form-group">
                        <label for="p_p_c_n_id" class="col-md-2 control-label">选择课程类别*：</label>
                        <div class="col-md-2">
                          <select class="form-control" name="p_p_c_n_id"  required="required" >
                            <?php foreach ($clas_p_p as $k => $v){ 
                              $p_p_c_n_id = $v->id; 
                              $class_name = $v->class_name; 
                              ?>
                              <option value="<?php echo $p_p_c_n_id; ?>"><?php echo $class_name; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                      
                      <div class="form-group">
                        <label for="course_keys" class="col-md-2 col-md-offset-2 control-label">课程内容关键字*：</label>
                        <div class="col-md-2">
                          <textarea type="text" class="form-control" id="course_keys" name="course_keys" placeholder="2-3个关键字，以# #隔开" ></textarea>
                        </div>
                      </div>        
                    </div>      
                  </div>
                  <div class="clearfix"></div>
                  <br>  
                  <div class="form-group">
                    <label for="attachment" class="col-md-2 control-label">上传你的文件*：</label>
                    <div class="col-md-2">
                      <div class="btn btn-default btn-file">
                          <i class="fa fa-paperclip"></i> 上传课程
                          <input type="file" name="attachment" id="attachment" onchange="return fileChange(this)">
                      </div>
                      <p class="help-block">大小：2MB;类型:ppt/doc/pdf</p>
                    </div>
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                  <div class="pull-right">
                    <button type='submit' class="btn btn-primary">提交</button>
                  </div>
                  <button class="btn btn-waring" onclick="window.history.back()">返回</button>
                </div><!-- /.box-footer -->
              </form> 
            </div><!-- /. box -->
          </div><!-- /.col-->
        </div><!-- ./row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php  $this->load->view('tq_footer'); ?>

    <script type="text/javascript">
      //检测文件大小和类型 
      function fileChange(target){ 
          //检测上传文件的类型 
          if(!(/(?:doc|pdf|ppt|docx)$/i.test(target.value))) {
            alert("只允许上传doc|pdf|ppt|docx格式的文件！");

            if (window.ActiveXObject) {
                target.select();//select the file ,and clear selection 
                document.selection.clear();
            }else if(window.opera) {
                target.type="text";target.type="file"; 

            }else {
                target.value="";//for FF,Chrome,Safari 
                return; 
            }

          }else {
            var isIE = /msie/i.test(navigator.userAgent) && !window.opera; 
            var fileSize = 0; 

            if (isIE && !target.files) {
                var filePath = target.value; 
                var fileSystem = new ActiveXObject("Scripting.FileSystemObject"); 
                var file = fileSystem.GetFile(filePath); 
                fileSize = file.Size; 
            } else {
              fileSize = target.files[0].size; 
            }
            
            var size = fileSize / 1024 / 1024;
            if (size > (2)) {
              alert("文件大小不能超过2M");
              if (window.ActiveXObject) {
                target.select();//select the file ,and clear selection 
                document.selection.clear(); 
              }else if (window.opera){
                target.type="text";
                target.type="file";
              }else {
                target.value="";//for FF,Chrome,Safari
              }
              return;
            }else {
              return;
            }

          }       
      }

      function check_file() {
          var file = document.getElementById('attachment').value;
          if(file.length <=0 ){
            alert("上传文件不能为空！");
            return false; 
          }else{            
            return true;            
          }
      }

  </script>
</body>
</html>
