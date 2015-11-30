<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homesetting extends MY_Controller {

	 /**
     * Constructor function
     */
    public function __construct() {
        parent::__construct();
    }

	public function index() {
//			echo "sdfsdfsdf";exit;
		if (!$this->session->userdata('access_token')) {
					
				redirect('login','refresh');
		}else {

			$data =  $this->tq_admin_header_info();	

			$params['home_inform'] = $this->input->post('home_inform');
			$params['home_inform_days'] = $this->input->post('home_inform_days');
			$params['admin_id'] = $this->session->userdata('admin_id');
			$temp_post = $this->input->post();
			if ( !empty($temp_post)) {
				
				$url = API_BASE_LINK.'homeSetting/home_inform';
//				 echo $url;exit();
				$result = doCurl($url, $params, 'POST');
				// var_dump($result);exit();

				if ($result && $result['http_status_code'] == 200) {
					$content  = json_decode($result['output']);

					$status_code = $content->status_code;
					if ($status_code == 200) {
						
						$this->session->set_flashdata('success', '提交成功！');
					}else{

						$this->session->set_flashdata('error', '提交失败！');
					}
				}else{
					show_404();exit();
				}

				redirect('Homesetting','refresh');
			}
			else{
				$this->load->view('homeSetting/homeInform_view' ,isset($data) ? $data : "");

			}
		}
	}
	
	public function noticeGroup()
	{
		if (!$this->session->userdata('access_token')) {
					
				redirect('login','refresh');
		}else {

			$data =  $this->tq_admin_header_info();
			$temp_post = $this->input->post();
			if (!empty($temp_post)) {

				$group_ids = $this->input->post('group_id');
				$params['notice_contents'] = $this->input->post('notice_contents');
				$params['admin_id']  = $this->session->userdata('admin_id'); 
				$params['group_id_str']=implode(',',$group_ids);

				$url = API_BASE_LINK.'homeSetting/notice_groups';
				$result = doCurl($url, $params, 'POST');
				var_dump($result);exit;
				if ($result && $result['http_status_code'] == 200) {

					$content  = json_decode($result['output']);

					$status_code = $content->status_code;
					if ($status_code == 200) {						
						$this->session->set_flashdata('success', '提交成功！');
						// $data['success'] = '';
					}else{
						$this->session->set_flashdata('error', '提交失败！');
					}	
				}else{
					show_404();exit();
				}		

				redirect('noticeGroup','refresh');					
			}
			$this->load->view('homeSetting/noticeGroup_view',isset($data) ? $data : "");	
		}	
	}

	

	public function urgentPrayer()
	{
		if (!$this->session->userdata('access_token')) {
					
				redirect('login','refresh');
		}else {

			$data =  $this->tq_admin_header_info();	
			$params['urgent_prayer_days'] = $this->input->post('urgent_prayer_days');
			$params['urgent_prayer_content'] = $this->input->post('urgent_prayer_content');
			$params['admin_id'] = $this->session->userdata('admin_id');
			// var_dump($params);exit();
			$temp_post = $this->input->post();
			if (!empty($temp_post)) {

				$url = API_BASE_LINK.'homeSetting/urgentPrayer';
				$result = doCurl($url, $params, 'POST');
				if ($result && $result['http_status_code'] == 200) {

					$content  = json_decode($result['output']);

					$status_code = $content->status_code;
					if ($status_code == 200) {						
						$this->session->set_flashdata('success', '提交成功！');
						// $data['success'] = '';
					}else{
						$this->session->set_flashdata('error', '提交失败！');
						// $data['error'] = '';

					}	
				}else{
					show_404();exit();
				}		
						
				redirect('urgentPrayer','refresh');
			}else{
				
				$this->load->view('homeSetting/urgentPrayer_view',isset($data) ? $data : "" );	
			}
		}
	}

	public function search_bibile(){

        if (!$this->session->userdata('access_token')) {

            redirect('login','refresh');
       
        }else {
           
		   $data =  $this->tq_admin_header_info();	

           $params['testament']         = $this->input->get('testament');
           $params['book_id']           = $this->input->get('book_id');
           $params['chapter_id']        = $this->input->get('chapter_id');
           $params['form_key']          = $this->input->get('form_key');

           $data['return_url']['testament'] = $params['testament'];
           $data['return_url']['book_id'] = $params['book_id'];
           $data['return_url']['chapter_id'] = $params['chapter_id'];
           $data['return_url']['form_key'] = $params['form_key'];

           $book_list = $this->session->userdata('book_list');
		   $data['book_list'] =  !empty($book_list)? $book_list : array();

           $url = API_BASE_LINK.'homeSetting/search_bibile';
           $result = doCurl($url, $params, 'POST');

           if ($result && $result['http_status_code'] == 200 ) {
               $content =json_decode($result['output']);
               // var_dump($content);exit();
               $status_code = $content->status_code;

               if ($status_code == 200 ) {
                   $data['section_result'] = $content->results->section_result;
                   $data['note_result'] = $content->results->note_result;
                   // var_dump($data['section_result']);exit;
                  if (!empty($params['form_key']) && empty($data['section_result'])) {                  	
	                   $data['error'] = '没有你搜的<strong>'.$params['form_key'].'</strong>结果！';
                  }                   
               }
           }else{
            
                show_404();exit();
           }
			
			$this->load->view('homeSetting/todayScriptures_view' ,isset($data) ? $data : "");	

       }
		
	}


	public function add_today_scriptures()
	{
	    if (!$this->session->userdata('access_token')) {

	        redirect('login','refresh');
	   
	    }else {
	       
		   $data =  $this->tq_admin_header_info();
		   $temp_post = $this->input->post();	 
		   if (!empty($temp_post)) {
		   	$testament    = $this->input->post('testament');
		   	$book_id      = $this->input->post('book_id');
		   	$chapter_id   = $this->input->post('chapter_id');
		   	$form_key     = $this->input->post('form_key');
		   	$section_id   = $this->input->post('section_id');
		   	$section_content   = $this->input->post('section_content');

		   	$params['testament']  = $testament;
		   	$params['book_id']    = $book_id;
		   	$params['chapter_id'] = $chapter_id;
		   	$params['form_key']   = $form_key;
		   	$params['section_id']   = $section_id;
		   	$params['section_content']   = $section_content;

		   	$book_list = $this->session->userdata('book_list');

		   	$new_book_list = !empty($book_list) ?  $book_list : array();
		   	array_push($new_book_list, $params);

		   	$this->session->set_userdata('book_list' , $new_book_list);
		   	$url_form_key =  urlencode($form_key);
			$this->session->set_flashdata('info', '成功添加！');

		   	redirect(site_url("homesetting/search_bibile?testament=$testament&book_id=$book_id&chapter_id=$chapter_id&form_key=$url_form_key"), 'refresh');
		   	
		   }else {
	           $book_list = $this->session->userdata('book_list');
			   $data['book_list'] =  !empty($book_list)? $book_list : array();
			   $this->load->view('homeSetting/todayScriptures_view' ,isset($data) ? $data : "");	
		   }

		}

	}

	public function setting_todayScriptures()
	{
	    if (!$this->session->userdata('access_token')) {

	        redirect('login','refresh');
	   
	    }else {

           $params = array();
		   $param['book_id']    = $this->input->post('book_id');	
		   $param['chapter_id'] = $this->input->post('chapter_id');	
		   $param['section_id'] = $this->input->post('section_id');	
		   $param['created_by'] = $this->session->userdata('admin_id');	
		   $params['params_json'] =    json_encode($param);
		   $this->session->unset_userdata('book_list');
		   $total = count($param['section_id']);
		   // var_dump($total);exit;
		   	if (!empty($params)) {

	           $url = API_BASE_LINK.'homeSetting/setting_todayScriptures';
	           $result = doCurl($url, $params, 'POST');

	           if ($result && $result['http_status_code'] == 200 ) {
	               $content =json_decode($result['output']);
	               $status_code = $content->status_code;

	               if ($status_code == 200 ) {
						$this->session->set_flashdata('info', '你设置的'.$total.'条经文已经提交！');
	               }
	           }else{
	            
	                show_404();exit();
	           }

		   	}

	        redirect('add_today_scriptures','refresh');

		}
	}

	public function del_choosed_bibile()
	{
	    if (!$this->session->userdata('access_token')) {

	        redirect('login','refresh');
	   
	    }else {
	       
		   $data =  $this->tq_admin_header_info();
           $temp_book_list = $this->session->userdata('book_list');
           $key_id = $this->input->get('key_id');
           $key_id =   $key_id ? $key_id : '0';
           unset($temp_book_list[$key_id]); 
           $this->session->unset_userdata('book_list');
           $this->session->set_userdata('book_list' , $temp_book_list);
		   $this->session->set_flashdata('warning', '成功删除！');
           redirect('add_today_scriptures','refresh');
		}			
	
	}
}
