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
//            var_dump($user_results);exit;
            if ( $user_results && $user_results['http_status_code'] ==200 ) {
                $content  =  json_decode($user_results['output']);
                $status_code = $content->status_code;
//                var_dump($content);exit;

                if ($status_code == 200) {
                    $data['group_users'] = $content->results;
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
                    $data['week_s_report'] = $content->results;
                    $data['week_firstday'] = $content->week_firstday;
                    $data['week_lastday'] = $content->week_lastday;
                    
                }
                
            } else {
                show_404();exit();
            }  
            

            $this->load->view('group/group_view' , isset($data) ? $data : "");
            
        }

	}
    
    public function addGroup()
    {
        if (!$this->session->userdata('access_token')) {
            redirect('login','refresh');

        } else{
            $data  = $this->tq_admin_header_info();
            var_dump($this->session->userdata('admin_id'));exit;
            $params = array();
            $params['addGroupName']  = $this->input->post('addGroupName')
            $params['admin_id']      = $this->session->userdata('admin_id');
            var_dump($params);exit;

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


}
