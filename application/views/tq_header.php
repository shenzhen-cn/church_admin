<?php 
  $admin_info     = isset($admin_info) ? $admin_info : "";
  $admin_id       = isset($admin_info->admin_id) ? $admin_info->admin_id : ''; 
  $admin_name     = isset($admin_info->admin_name) ? $admin_info->admin_name : ''; 
  $admin_nick     = isset($admin_info->admin_nick) ? $admin_info->admin_nick : ''; 
  $adminHead_src  = isset($admin_info->adminHead_src) ? $admin_info->adminHead_src : ''; 
  $group_info     = isset($group_info) ?  $group_info : "";
//  var_dump($group_info);exit;
  $clas_p_p       = isset($clas_p_p) ?  $clas_p_p : "";
 ?>

 <script>
   userHeadSrc = '<?php echo ROLE_USER_HEAD_BASE_SRC ?>' ; 
 </script>
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="JavaScript:;" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>盟约</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>使命</b>青年团契</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top " role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <?php if (!empty($admin_info)) { ?>
                  <a href="" class="dropdown-toggle" data-toggle="dropdown">
                     <?php if (empty($adminHead_src)) {?>
                        <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="user-image" alt="User Image">
                     <?php } else { ?>
                      <img src="<?php echo base_url()."public/uploads/userHeadsrc/$adminHead_src"; ?>" class="user-image" alt="User Image">
                      <?php   } ?>

                        <span class="hidden-xs">
                             <?php echo $admin_nick; ?> 
                        </span>
                  </a>
                <?php } ?>

                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                      <?php if (! empty($adminHead_src)) {?>
                         <img src="<?php echo base_url()."public/uploads/userHeadsrc/$adminHead_src"; ?>" class="img-circle" alt="User Image">
                      <?php } else { ?>
                         <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle" alt="User Image">
                       <?php   } ?>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">个人</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('sign_out'); ?>" class="btn btn-default btn-flat">退出</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

        </nav>
      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php if (empty($adminHead_src)) {?>
                 <img src="<?php echo base_url(); ?>public/images/mrpho.jpg" class="img-circle" alt="User Image">
              <?php } else { ?>
               <img src="<?php echo base_url()."public/uploads/userHeadsrc/$adminHead_src"; ?>" class="img-circle" alt="User Image">
               <?php   } ?>  
            </div>
            <div class="pull-left info">
              <p>
                <?php if (!empty($admin_nick)) { ?>
                   <?php echo $admin_nick; ?> 
                <?php } ?>
              </p>
            </div>
          </div>
          <!-- search form -->
          <ul class="sidebar-menu">
            <li>
              <a href="<?php echo site_url('bibile'); ?>">
                <i class="fa fa-book"></i> <span>在线圣经</span>
              </a>
            </li>
            <li class="header">目录</li>
            <li class="treeview">
              <a href="<?php echo site_url('home'); ?>">
                <i class="fa fa-dashboard"></i> <span>首页</span>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>牧师讲道</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php  echo site_url('priest_preach?id='."1"); ?>"><i class="fa fa-circle-o"></i>牧师课程</a></li>
                <li><a href="<?php  echo site_url('uploadCourse'); ?>"><i class="fa fa-circle-o"></i>上传课程</a></li>
                <li><a href="<?php  echo site_url('read_myEdit'); ?>"><i class="fa fa-circle-o"></i>在线阅读</a></li>
                <li><a href="<?php  echo site_url('myEdit'); ?>"><i class="fa fa-circle-o"></i>编辑在线阅读</a></li>
              </ul>
            </li>


            <li class="treeview">
              <a href="">
                <i class="fa fa-pie-chart"></i>
                <span>小组</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if (! empty($group_info)) {
                  foreach ($group_info as $k => $v) {
                    $group_id   = $v->id;
                    $group_name = $v->group_name; ?>
                    <li><a href="<?php echo site_url("group?group_id=".$group_id); ?>"><i class="fa fa-circle-o"></i><?php echo $group_name; ?></a></li>

                  <?php }?>
                <?php } ?>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> 小组设置 <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php  echo site_url('group/group_info'); ?>"><i class="fa fa-circle-o"></i> 小组修改</a></li>
                    <li><a href="<?php  echo site_url('group/addGroup'); ?>"><i class="fa fa-circle-o"></i> 添加小组</a></li>

                  </ul>
                </li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>团契生活</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="<?php  echo site_url('wall_for_photos'); ?>"><i class="fa fa-circle-o"></i> 照片墙</a>
                </li>
              </ul>
            </li>

            <li>
              <a href="<?php echo site_url('Wallofprayer'); ?>">
                <i class="fa fa-fire"></i> <span>祷告墙</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>

            <li>
              <a href="">
                <i class="fa fa-male"></i> <span>添加用户</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('add_personal'); ?>"><i class="fa fa-circle-o"></i> 提交用户 </a></li>
                <li><a href="<?php echo site_url('user_registered'); ?>"><i class="fa fa-circle-o"></i> 注册状态 </a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog"></i>
                <span>设置</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('homesetting'); ?>"><i class="fa fa-circle-o"></i>   首页通知</a></li>
                <li><a href="<?php echo site_url('add_today_scriptures'); ?>"><i class="fa fa-circle-o"></i> 首页当日经文</a></li>
                <li><a href="<?php echo site_url('urgentPrayer'); ?>"><i class="fa fa-circle-o"></i> 首页紧急代祷</a></li>
                <li><a href="<?php echo site_url('noticeGroup'); ?>"><i class="fa fa-circle-o"></i> 各小组注意事项</a></li>
                <li><a href="<?php echo site_url('setPersonalData'); ?>"><i class="fa fa-circle-o"></i>个人资料设置</a></li>
                <li><a href="<?php echo site_url('resetpassword'); ?>"><i class="fa fa-circle-o"></i> 修改密码</a></li>
              </ul>
            </li>

            <li>
              <a href="<?php echo site_url('sign_out'); ?>">
                <i class="fa fa-toggle-off"></i> <span>退出</span>
              </a>
            </li>
          </ul>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <form action="<?php echo site_url('onlineBibile'); ?>" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="search_keyword" class="search_keyword form-control" placeholder="在线圣经查找"/>
              <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
        </section>
        <!-- /.sidebar -->
      </aside>

