<?php 
        $section_result  = isset($section_result) ? $section_result : "" ;
        $note_result     = isset($note_result) ? $note_result : "" ;
        $book_list       = isset($book_list) ? $book_list : "";
        $search_keyword  = isset($return_url['form_key']) ? $return_url['form_key'] : "";

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <title>首页当日经文设置</title>
  <?php  $this->load->view('tq_head'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/plugins/css/daterangepicker-bs3.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <?php  $this->load->view('tq_header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        首页当日经文设置
        <small>IN GOD WE TRUST</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('home'); ?>"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li class="active">首页当日经文设置</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        <?php $this->load->view('tq_alerts'); ?>        
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">经文设置：</h3>
            </div>
            <div class="box-body">
             <div class="col-md-12">
               <form class="navbar-form navbar-left" role="search" action="<?php echo base_url('homeSetting/search_bibile'); ?>" method="get">
                 <label  for="testament">新旧约：</label>                  
                 <div class="form-group">
                   <select class="form-control" name="testament" id="testament">
                    <option value="new">新约</option>
                    <option value="old">旧约</option>
                  </select>
                </div>
                <div class="form-group">
                 <label  for="book_id">书名：</label>
                 <select class="form-control" id='book_id' name='book_id' required/>

               </select>
             </div>
             <div class="form-group">
               <label  for="form_chapter_id">章：</label>
               <select class="form-control"  id="chapter_id" name="chapter_id" required/>

             </select>
           </div>               
           <div class="form-group">
             <label  for="form_key">关键字：</label>                 
             <input type="text" class="form-control" placeholder="关键字..." id="form_key" name="form_key">
           </div>              
           <button type="submit" class="btn btn-primary">搜索</button>
         </form>
       </div>            
       <div class="clearfix"></div>
       <br>            
       <div class="row">
        <?php if (!empty($section_result)) { ?>
        <div class="col-md-12">
         <div class="nav-tabs-custom">
           <ul class="nav nav-tabs">
             <li class="active"><a href="#activity" data-toggle="tab">经文</a></li>
             <li><a href="#timeline" data-toggle="tab">解经</a></li>
           </ul>
           <div class="tab-content">
             <div class="active tab-pane" id="activity">
               <div class="direct-chat-messages">
                <?php foreach ($section_result as $k => $v) { 
                  $chapter_id = $v->chapter_id;
                  $section_id = $v->section;
                  $section_content = $v->section_content;
                  ?>                              
                  <form action="<?php echo base_url('homeSetting/add_today_scriptures'); ?>" method="post" name="add_bibile_form<?php echo $k; ?>">
                   <p><label>
                     <a href="javascript:document.add_bibile_form<?php echo $k; ?>.submit();"><i class="fa  fa-plus-square"></i></a>                   
                   </label>
                     &nbsp;<?php echo $chapter_id; ?>:<?php echo $section_id; ?> <?php echo str_replace("$search_keyword","<strong class='label label-danger'>".$search_keyword."</strong>","$section_content"); ?> 

                     <input type="hidden" name="testament" value="<?php echo $return_url['testament']; ?>">
                     <input type="hidden" name="book_id" value="<?php echo $return_url['book_id']; ?>"> 
                     <input type="hidden" name="chapter_id" value="<?php echo $return_url['chapter_id']; ?>"> 
                     <input type="hidden" name="form_key" value="<?php echo $return_url['form_key']; ?>"> 
                     <input type="hidden" name="section_id" value="<?php echo $section_id; ?>"> 
                     <input type="hidden" name="section_content" value="<?php echo $section_content; ?>"> 
                   </p>                             
                 </form>
                 <?php } ?>
               </div>
             </div><!-- /.tab-pane -->
             <div class="tab-pane" id="timeline">
               <div class="direct-chat-messages">
                <?php if (! empty($note_result)) { 
                  foreach ($note_result as $key => $value) {
                    $chapter_id = $value->chapter_id;
                    $section = $value->section;
                    $note_title = $value->note_title;
                    $content = $value->content;
                    if (! empty($note_title)) { ?>
                    <p>【<?php echo $chapter_id;?>:<?php echo $section;?>】&nbsp;<b><?php echo $note_title ; ?></b></p>                                                                          
                    <?php }
                    if (!empty($content)) {  ?>
                    <p><?php echo$content ; ?></p>                                      
                    <?php } 
                  }
                  ?>                             
                  <?php } ?>
                </div>  
              </div><!-- /.tab-pane -->
              <br>               
            </div><!-- /.tab-content -->
          </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
        <?php } ?>   
        <?php if (!empty($book_list)) { ?>
                 
        <form action="<?php echo base_url('homeSetting/setting_todayScriptures'); ?>" method="post">
         <div class="col-md-12">

            <div class="box box-primary">
              <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">已选经文清单：</h3>                
              </div><!-- /.box-header -->
              <div class="box-body">
                <ul class="todo-list">
                  <?php foreach ($book_list as $key => $value){
                    // var_dump($book_list);exit;
                        $book_id = $value['book_id'];
                        $section_id = $value['section_id'];

                        $chapter_id = $value['chapter_id'];
                        $section_content = $value['section_content'];                      
                    ?>                    
                  <li>                    
                    <div class="tools">
                      <a href="<?php echo base_url('homeSetting/del_choosed_bibile?key_id='.$key); ?>" onclick=" return drop_confirm()" ><i class="fa fa-trash-o"></i></a>
                    </div>
                    <span class="text">【<?php echo $chapter_id;?>:<?php echo $section_id; ?>】<?php echo $section_content; ?></span>
                    <input type="hidden" name="book_id[]" value="<?php echo $book_id; ?>">
                    <input type="hidden" name="chapter_id[]" value="<?php echo $chapter_id; ?>">
                    <input type="hidden" name="section_id[]" value="<?php echo $section_id; ?>">
                  </li>
                  <?php } ?>
                  
                </ul>

              </div><!-- /.box-body -->
        
            </div><!-- /.box -->
           <div class="box-footer clearfix no-border">
             <button class="btn btn-warning pull-right" onclick="window.history.back()">返回</button>
             <button type="submit" class="btn btn-primary pull-left">提交</button>
           </div>
         </div>
       </form>
       <?php } ?> 
     </div>
   </div><!-- /.box-body -->
 </div><!-- /.box -->
</div><!-- /.col (right) -->

</div> <!-- /.row -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php  $this->load->view('tq_footer'); ?>
<script>
  $(function () {

    load_testament_def();

    function load_testament_def (argument) {
     var testament = $("#testament").val();
     var str_url = '<?php echo site_url("bibile/get_bibile_book_id_by_testament?testament="); ?>' + testament;
     $.ajax({
      url: str_url,
      type: 'GET',
      dataType: 'json',
    })
     .done(function(data) {
      var book_id ="";

      $.each(data, function(index,item) {

        $("#book_id").append(' <option value="'+item.book_id+'">'+item.name +'</option>');
      });
      $("#chapter_id").empty(); 
      var book_id =$("#book_id").val();
      var str_url = '<?php echo site_url("bibile/get_bible_section_by_book_id?book_id="); ?>' + book_id;
        // alert(testament);
        $.ajax({
          url: str_url,
          type: 'GET',
          dataType: 'json',
        })
        .done(function(data) {

          $.each(data, function(index,item) {

            $("#chapter_id").append(' <option value="'+item.chapter_id+'">'+item.chapter_id +'</option>');
          });

          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

        console.log("success");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

      }
      $('#testament').change(function(event) {
        $("#book_id").empty();
        $("#chapter_id").empty();
        $("#chapter_id").append('<option value="1">1</option>');

        var testament = $(this).val();
              // alert(testament);
              var str_url = '<?php echo site_url("bibile/get_bibile_book_id_by_testament?testament="); ?>' + testament;
              // alert(testament);
              $.ajax({
                url: str_url,
                type: 'GET',
                dataType: 'json',
              })
              .done(function(data) {

                $.each(data, function(index,item) {
                  $("#book_id").append(' <option value="'+item.book_id+'">'+item.name +'</option>');
                });
                $("#chapter_id").empty(); 
                var book_id =$("#book_id").val();
                var str_url = '<?php echo site_url("bibile/get_bible_section_by_book_id?book_id="); ?>' + book_id;
                    // alert(testament);
                    $.ajax({
                      url: str_url,
                      type: 'GET',
                      dataType: 'json',
                    })
                    .done(function(data) {

                      $.each(data, function(index,item) {

                        $("#chapter_id").append(' <option value="'+item.chapter_id+'">'+item.chapter_id +'</option>');
                      });

                      console.log("success");
                    })
                    .fail(function() {
                      console.log("error");
                    })
                    .always(function() {
                      console.log("complete");
                    });

                    console.log("success");
                  })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");
                });
                });

                $('#book_id').change(function(event) {
                  // var selected_testament = $(this).val();
                  // alert(selected_testament);
                  $("#chapter_id").empty(); 
                  var book_id = $(this).val();
                  var str_url = '<?php echo site_url("bibile/get_bible_section_by_book_id?book_id="); ?>' + book_id;
                  // alert(testament);
                  $.ajax({
                    url: str_url,
                    type: 'GET',
                    dataType: 'json',
                  })
                  .done(function(data) {

                    $.each(data, function(index,item) {

                      $("#chapter_id").append(' <option value="'+item.chapter_id+'">'+item.chapter_id +'</option>');
                    });

                    console.log("success");
                  })
                  .fail(function() {
                    console.log("error");
                  })
                  .always(function() {
                    console.log("complete");
                  });
                });
          }) 

      function drop_confirm()
      {
        var r=confirm("你确定删除此这条么？");
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
<style type="text/css" media="screen">
  .todo-list>li .tools{
    display:block;
    color:#dd4b39;
    /*float:left;    */
  }
</style>
</body>
</html>