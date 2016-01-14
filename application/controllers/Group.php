<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group extends MY_Controller {

     /**
     * Constructor function
     */
    public function __construct() {
        parent::__construct();

    }

    public function index() {

        if (!$this->session->userdata('access_token')) {

            redirect('login','refresh');
        }else {
            $data  = $this->tq_admin_header_info();

            $group_id =  $this->input->get('group_id');

            //得到小组的group_id,group_name,group_leader_id
            $result = doCurl(API_BASE_LINK.'group/find_group_by_group_id?group_id='."$group_id");           
            if ($result && $result['http_status_code'] == 200) {
                $content  =  json_decode($result['output']);
                $status_code = $content->status_code;
                if ($status_code == 200) {
                    $data['results'] = $content->results;
                }
            }else {
                show_404();exit();
            }

            //小组的成员信息
            $user_results = doCurl(API_BASE_LINK.'group/find_all_users_by_group_id?group_id='."$group_id");
            if ( $user_results && $user_results['http_status_code'] ==200 ) {
                $content  =  json_decode($user_results['output']);
                $status_code = $content->status_code;
                if ($status_code == 200) {
                    $group_users = $content->results;
                    $data['group_name'] = $content->group_name;
                    
                }
                
            } else {
                show_404();exit();
            }  

            //小组本周灵修情况
            $week_s_report = doCurl(API_BASE_LINK.'group/find_week_s_report?group_id='."$group_id");    
            if ( $week_s_report && $week_s_report['http_status_code'] ==200 ) {
                $content  =  json_decode($week_s_report['output']);
                $status_code = $content->status_code;

                if ($status_code == 200) {
                    $week_s_report = $content->results;
                    $data['week_firstday'] = $content->week_firstday;
                    $data['week_lastday'] = $content->week_lastday;                    
                }else{
                    $week_s_report = null;
                }
                    
            } else {
                show_404();exit();
            }  

          $week_s_reports = array();  
          if (!empty($week_s_report)) {

            foreach ($week_s_report as $k1 => $v1) {
                $group_user_id = $v1->group_user_id ;
                $arr_2 = $this->objectToArray($v1);
                $arr_1 = $this->split_array($group_users,$group_user_id);  
                $res_array = array_merge($arr_2,$arr_1);

                $week_s_reports[] =  $res_array;
            }   

          }

          usort($week_s_reports, function($a, $b) {
                      $al = (int)$a['this_week_count'];
                      $bl = (int)$b['this_week_count'];
                      if ($al == $bl)
                          return 0;
                      return ($al > $bl) ? -1 : 1;
                  });

          $data['week_s_reports'] = $week_s_reports;         

          $this->load->view('group/group_view' , isset($data) ? $data : "");
            
        }

    }

    function objectToArray($e){

        $e=(array)$e;

        foreach($e as $k=>$v){

            if( gettype($v)=='resource' ) return;

            if( gettype($v)=='object' || gettype($v)=='array' )

                $e[$k]=(array)objectToArray($v);

        }

        return $e;

    }

    function split_array($array,$index)
    { 
      $temp = array();
      foreach ($array as $k2 => $v2) {
          $object_user_id  = $v2->user_id;

          if(!empty($object_user_id) && $object_user_id == $index ){
              $temp = $v2; 
              break;
          }
      }

      return $this->objectToArray($temp);
    }    
    

    public function addGroup()
    {
        if (!$this->session->userdata('access_token')) {
            redirect('login','refresh');

        } else{
            $data  = $this->tq_admin_header_info();

            $params = array();
            $params['addGroupName']  = $this->input->post('addGroupName');
            $params['admin_id']      = $this->session->userdata('admin_id');
            // var_dump($params);exit;

            if (!empty($params['addGroupName'])) {

                $url = API_BASE_LINK.'group/addGroup';
                $result = doCurl($url, $params, 'POST');
                if ($result && $result['http_status_code'] == 200){

                     $content = json_decode($result['output']);
                     $status_code = $content->status_code;
                     $groupName = $content->groupName;

                     if ($status_code == 200) {

                         $data['group_Name'] = $params['addGroupName'];

                         $this->session->set_flashdata('success', '<b>'.$groupName."</b>添加成功！");
                     }else if ($status_code == 400) {

                         $this->session->set_flashdata('error', $groupName."添加失败！");
                     }       

                    redirect('/group/group_info','refresh');  

                 }else{
                    show_error();
                    exit;
                 }

            }else{

                $this->load->view('group/group_addGroup_view',isset($data)? $data : "");
            }
        }


    }
 
    public function group_info()
    {
        if (! $this->session->userdata('access_token')) {
            redirect('login','refresh');
            
        }else{

            $data = $this->tq_admin_header_info();

            $result = doCurl(API_BASE_LINK.'group/get_group');
               // var_dump($result);exit(); 
            if ( $result && $result['http_status_code'] == 200) {
                $content = json_decode($result['output']);

                $data['all_groups'] = $content->results;

                $this->load->view('group/group_info_view',isset($data) ? $data : "" );
            
            }else{

                show_404();exit;
            }

        }
    }

    public function  groupEdit()
    {
        if (! $this->session->userdata('access_token')) {
            redirect('login','refresh');
            
        }else{

            $data   = $this->tq_admin_header_info();
            
            $group_id = $this->input->get('group_id');
            $group_leader_id = $this->input->get('group_leader_id');

            $params['group_id']         = $this->input->post('group_id');
            $params['group_name']       = $this->input->post('group_name');
            $params['group_leader_id']  = $this->input->post('group_leader_id');
            $temp_post = $this->input->post();
            if (! empty($group_id)) {
                $result = doCurl(API_BASE_LINK.'group/find_user_by_group_id?group_id='."$group_id");

                if ($result && $result['http_status_code']) {
                    $content = json_decode($result['output']);
                    $status_code = $content->status_code;
                    $data['group_id'] = $group_id;
                    $data['group_leader_id'] = $group_leader_id;

                    if ($status_code == 200 ) {
                        $data['results'] = $content->results; 
                    }

                    $this->load->view('group/group_edit_view',isset($data) ? $data : "" );

                }else{
                    show_404();exit();
                }
            }
            else if (!empty($temp_post)) {

                $url = API_BASE_LINK.'group/groupEdit';
                $result = doCurl($url, $params, 'POST');

                if ($result && $result['http_status_code'] == 200) {
                    $content = json_decode($result['output']);
                    $status_code = $content->status_code; 

                    if ($status_code == 200 ) {
                           $this->session->set_flashdata('success', "小组修改成功！"); 

                    }  else{
                        $this->session->set_flashdata('error', "小组修改失败！"); 
                    } 

                    redirect('/group/group_info','refresh');  

                }else{
                    show_404();exit();
                }
            }

        }
    }

    public function del_group()
    {
        if (! $this->session->userdata('access_token')) {
            redirect('login','refresh');
            
        }else{

            $data = $this->tq_admin_header_info();
            $group_id = $this->input->get('group_id'); 

            $result = doCurl(API_BASE_LINK.'group/del_group?group_id='."$group_id ");  
            if ($result && $result['http_status_code']) {
                $content = json_decode($result['output']);
                $status_code = $content->status_code;

                if ($status_code == 200) {

                    $this->session->set_flashdata('success', "删除成功！");                         

                } else{

                    $this->session->set_flashdata('error', "删除失败，请重试！");  
                }  

                redirect('/group/group_info','refresh');                   
                
            }else{

                show_404();exit();
            }

        }
    }

    //删除祷告
    public function del_prayer()
    {
      $params['prayer_id'] = $this->input->post('prayer_id');
      $params['contentStyle'] = $this->input->post('contentStyle');
      $params['admin_id'] = $this->session->userdata('admin_id');
      $odj = array();

      $url = API_BASE_LINK.'group/del_prayer';
      
      $result = doCurl($url, $params, 'POST');


      if ($result && $result['http_status_code'] == 200) {
          $content =json_decode($result['output']);
          $status_code = $content->status_code; 
          if($status_code == 200){
            $odj['status'] = 200;                                       
          }else{
            $odj['status'] = 400;                          
          }

      }else{
        echo json_encode('error');exit;
      }
      echo json_encode($odj);exit;
    }

    public function del()
    {
        $params['user_id'] = $this->input->post("selectedId");
        $params['admin_id'] = $this->session->userdata('admin_id');
        $url = API_BASE_LINK.'group/del_users_by_id';
        
        $result = doCurl($url, $params, 'POST');
        if ($result && $result['http_status_code'] == 200) {
            $content =json_decode($result['output']);
            $status_code = $content->status_code; 

            if($status_code == 200){
              $odj['status'] = 200;                                       
            }else{
              $odj['status'] = 400;                          
            }

        }else{
          echo json_encode('error');exit;
        }
        echo json_encode($odj);exit;
    }

    // update 12-19
    public function ranking()
    {   

      if (! $this->session->userdata('access_token')) {

        redirect('login','refresh');

      }else{
          
        $data = $this->tq_admin_header_info();
        $admin_id = $this->session->userdata('admin_id');       

        $rate_of_spirituality_results = doCurl(API_BASE_LINK.'group/get_rate_of_spirituality');    
        if ( $rate_of_spirituality_results && $rate_of_spirituality_results['http_status_code'] ==200 ) {
            $content  =  json_decode($rate_of_spirituality_results['output']);
            $status_code = $content->status_code;

            if ($status_code == 200) {
                $data['last_month_results'] = $content->last_month_results;                
                $data['last_week_results'] = $content->last_week_results;                
            }
            
        } else {
            show_404();exit();
        } 

        $this->load->view('group/group_ranking_view',isset($data) ? $data : "");
      }
    }
    
    public function get_user_data()
    {
        if (! $this->session->userdata('access_token')) {
            redirect('login','refresh');
        }else{   

            $data = $this->tq_admin_header_info();
            $user_id = $this->input->get("id");

            // 各种数据
            echo API_BASE_LINK.'group/see_member?group_user_id='.$user_id;exit;
            $result    = doCurl(API_BASE_LINK.'group/see_member?group_user_id='.$user_id);         

            if ($result && $result['http_status_code'] == 200) {
                $content          = json_decode($result['output']);
                var_dump($content);exit;
                $status_code      = $content->status_code;


                if ($status_code == 200) {
                    $data['group_userHead_src'] = $content->results->userHead_src;                    
                    $data['spiri_total_count'] = $content->results->spiri_total_count;
                    $data['spiri_week_count'] = $content->results->spiri_week_count;
                    $data['prayer_group_week_count'] = $content->results->prayer_group_week_count;
                    $data['urgent_group_week_count'] = $content->results->urgent_group_week_count;
                    $data['prayer_group_total_count'] = $content->results->prayer_group_total_count;
                    $data['urgent_group_total_count'] = $content->results->urgent_group_total_count;
                    $data['group_user_info'] = $content->results->group_user_info;
                    $data['group_ranking_result'] = $content->results->group_ranking_result;
                    $data['tq_ranking_result'] = $content->results->tq_ranking_result;
                }            
            }

            //灵修日历！
            $results = doCurl(API_BASE_LINK.'calendar/get_all_events_for_json?user_id='.$user_id);
            if (isset($results) && $results['http_status_code'] == 200)
            {
                $content           = json_decode($results['output']);
                $results            = $content->results;

                $data['user_create_at']     = $results->user_create_at; 
                $data['spirituality']       = $results->spirituality;
                $data['prayer_for_group']   = $results->prayer_for_group;
                $data['prayer_for_urgent']  = $results->prayer_for_urgent;
            }

            $this->load->view('group/user_data_view',isset($data) ? $data : "");
        }
    }

    public function frozen()
    {
        $odj  = array();
        $params["user_id"] = $this->input->post("selectedId");
        $params["admin_id"] = $this->session->userdata("admin_id");

        $url = API_BASE_LINK.'group/frozen_users_by_id';
        
        $result = doCurl($url, $params, 'POST');
        if ($result && $result['http_status_code'] == 200) {
            $content =json_decode($result['output']);
            $status_code = $content->status_code; 

            if($status_code == 200){
              $odj['status'] = 200;                                       
            }else{
              $odj['status'] = 400;                          
            }

        }else{
          echo json_encode('error');exit;
        }
        echo json_encode($odj);exit;
    }


}
