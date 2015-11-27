<?php   
    $userHeadSrc_info = isset($admin_info->adminHead_src) ? $admin_info->adminHead_src : "";
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>个人中心-使命青年团契</title>
  <?php  $this->load->view('tq_head'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php  $this->load->view('tq_header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        设置
        <small>IN GOD WE TRUST</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li>设置</li>
        <li class="active">修改资料</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-md-4">
          <?php $this->load->view('tq_alerts'); ?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">更改基本资料</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url('personal/upload_photo'); ?>" onSubmit="return check();" method='post' enctype="multipart/form-data">
              <div class="box-body box-profile">
                <?php if (!empty($admin_info)) {
                  if (! empty($userHeadSrc_info)) { ?>
                    <img id="userHead_pho_preview" class="profile-user-img img-responsive img-circle" src="<?php echo base_url()."public/uploads/userHeadsrc/$userHeadSrc_info"; ?>" style="width:150px;height:150px;" alt="上传头像">
                      <input type="hidden" name="userHeadSrc" id="userHeadSrcId" value="<?php echo $userHeadSrc_info; ?>">
                  <?php  }else { ?>
                    <img id="userHead_pho_preview" class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>public/images/mrpho.jpg" style="width:150px;height:150px;" alt="上传头像">
                    <input type="hidden" name="userHeadSrc" id="userHeadSrcId" value="<?php echo $userHeadSrc_info; ?>">

                  <?php } ?>
                  <h3 class="profile-username text-center"><?php echo $admin_info->admin_nick; ?></h3>
                  <?php } ?>      
                </div><!-- /.box-body -->

                <div class="box-body">
                  <div class="form-group">
                    <div class="btn btn-primary btn-file">
                      <i class="fa fa-picture-o"></i> 上传头像
                      <input type="file" id="up_userHead_src" class="btn btn-primary btn-block" name="uploadphoto" onchange="loadUserHeadAsURL();"  >
                      <input type="hidden" id="userHead_pho" style="width:150px;height:150px;" alt="上传头像" /> 
                    </div>
                    <p class="help-block">文件不大于：2M</p>
                  </div>
                  <div class="form-group">
                    <label for="admin_nick">昵称：</label>
                    <?php   if (! empty($admin_info)) { ?>
                        <input type="text" class="form-control" id="admin_nick" name="admin_nick" required="required" value="<?php echo $admin_info->admin_nick; ?>">
                    <?php } else{?>
                      <input type="text" class="form-control" id="admin_nick" name="admin_nick" required="required" >
                    <?php }?>
                  </div>

                  <div class="form-group">
                    <label for="gender">性别：</label>
                    <select class="form-control select2" style="width: 100%;" id="gender" name="gender">
                      <?php   if (! empty($admin_info)) {
                        if ($admin_info->admin_gender == '男') { ?>
                        <option selected="selected">男</option>
                        <option>女</option>
                        <?php } else{ ?>
                        <option>男</option>
                        <option selected="selected">女</option>
                        <?php }?> 
                        <?php } ?>

                      </select>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">提交</button>
                  </div>
                </form>
              </div><!-- /.box -->          
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php $this->load->view('tq_footer'); ?>
      <script>

        var user_headSrc = '<?php echo $userHeadSrc_info; ?>';
        var userHeadSrcId = document.getElementById("userHeadSrcId").value;

        function loadUserHeadAsURL() {          
          var filesSelected = document.getElementById("up_userHead_src").files;
          
          if (filesSelected.length > 0)
          {
            var fileToLoad = filesSelected[0];
            var f = document.getElementById("up_userHead_src").value;
            
            if (!/\.(png|jpg|jpeg|bmp)$/.test(f)){

              alert("图片类型必须是.png,jpeg,jpg,bmp中的一种")
              return false;
            }
            else if (fileToLoad.size > 2*1024*1024 ) {
             alert("文件不能大于2M，请再次选择！");
             return false;
           }
           
           var fileReader = new FileReader();
           fileReader.onload = function(fileLoadedEvent) 
           {
            var logo_encoded = document.getElementById("userHead_pho");
            var logo_preview = document.getElementById("userHead_pho_preview");
            logo_encoded.value = fileLoadedEvent.target.result;
            logo_preview.setAttribute('src', fileLoadedEvent.target.result);
          };
          fileReader.readAsDataURL(fileToLoad);          
          document.getElementById("userHeadSrcId").value="";
        }else{
          if(user_headSrc.length > 0 ){
            return true
          }else{            
            alert('请上传头像！');
            return false;
          }
        }
      };

      function check () {
        return loadUserHeadAsURL();
      };
     
    </script>  

    
  </body>
  </html>