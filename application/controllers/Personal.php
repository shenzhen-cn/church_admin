<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helpers('uploadfiles');
	 	$this->load->helper('pagination');
		

	}

	public function setPersonalData()
	{	
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_admin_header_info();

			$this->load->view('personal/setPersonalData_view' , isset($data) ? $data : "");
		}	

	}

	public function upload_photo()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');
		}else {

			$data =  $this->tq_admin_header_info();
			$adminHead_src = $data['admin_info']->adminHead_src;
			$userHeadSrc = $this->input->post('userHeadSrc') ;


			if(!empty($userHeadSrc) && $userHeadSrc  == $adminHead_src){
				$params['adminHeadSrc']	= $userHeadSrc;
			}else{
				$fileInfo = $_FILES['uploadphoto'];
				$uploadPath = "public/uploads/userHeadsrc";
				$msg_return = uploadFiles($fileInfo,$uploadPath);


				if (isset($msg_return['msg']) ) {
					$this->session->set_flashdata('error', $msg_return['msg']);
					redirect('setPersonalData','refresh');	
				}else{
					$params['adminHeadSrc']	= $msg_return['newName'];
				}	

				if(!empty($adminHead_src)){
					$file = '/var/www/html/church/church_admin/public/uploads/userHeadsrc/'.$adminHead_src;
					if(file_exists($file)){					
						!unlink($file);
					}				 
				}
			}


			$params['admin_nick'] 	    = $this->input->post('admin_nick');
			$params['gender'] 			= $this->input->post('gender');
			$params['admin_id'] 		= $this->session->userdata('admin_id');
			$url = API_BASE_LINK.'personal/upload_admin_photo';
			$result = doCurl($url, $params, 'POST');

			if ($result && $result['http_status_code'] == 200) {

				$result = json_decode($result['output']);
				$content = $result->results;

				if ($content) {

					$affected_id 			= 	$content->affected_id;
					$adminHead_src_id 	= 	$content->adminHead_src_id;

					if (isset($affected_id) && $adminHead_src_id) {
						$this->session->set_flashdata('success', '资料修改成功！');
					}

				}else{

					$this->session->set_flashdata('error', '资料修改失败！');
				}				

			} else {
				show_404();exit;
			}  
			redirect('setPersonalData','refresh');
		}
		
	}

	public function add_personal()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');

		}else {
			$data =  $this->tq_admin_header_info();
			$params['re_user_email'] = $this->input->post('re_user_email') ;
			$params['admin_id']      = $this->session->userdata('admin_id');
			if ( ! empty($params['re_user_email'])) {
				$url = API_BASE_LINK.'user/addPersonal';
				$result = doCurl($url, $params, 'POST');
				if ($result && $result['http_status_code'] == 200){

					$result = json_decode($result['output']);
					$status_code = $result->status_code;
					
					if ($status_code  == 200) {

						$message = $result->message;
						$data['re_user_id'] = $result->results;
						$data['success'] = $message;
					}else {

						$message = $result->message;
						$data['info'] = $message;
					}
					$this->load->view('personal/addpersonal_view' ,isset($data) ? $data : "" );	

				}else{
					show_404();exit;
				}	

			}else{

				$this->load->view('personal/addpersonal_view' ,isset($data) ? $data : "" );	
			}	


		}		

	}

	/**
		update 12-20
	*/


	public function user_registered()
	{
		if (!$this->session->userdata('access_token')) {
			redirect('login','refresh');
			
		}else {

			$data =  $this->tq_admin_header_info();
			$results = $this->input->get('results');	
			$page  = $this->input->get('page');


			$data['limit'] =  $results ? $results : 10;
			$data['page'] = $page  ? $page : 1;	
			$data['total'] = null;

			$params['user_nick'] = $this->input->get("user_nick");
			$params['user_group_id'] = $this->input->get("user_group_id");
			$params['admins_id'] = $this->input->get('admins_id');
			$params['user_email'] = $this->input->get('user_email');
			$params['member_status'] = $this->input->get('member_status');
			$params['reg_start_time'] = $this->input->get('start_time');
			$params['reg_end_time'] = $this->input->get('end_time');
			$params['limit'] = $data['limit'];
			$params['page'] = $data['page'];
			$url = API_BASE_LINK.'personal/user_registered';
			var_dump($url);exit();
			$result = doCurl($url, $params, 'POST');
			var_dump($result);exit;
			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$status_code = $content->status_code;
				if($status_code == 200){
					$data['results'] = $content->results;
					// var_dump($data['results']);exit;
				 	$data['total'] = $content->total;
	 				$uri = '';	
					$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);
				}

			}

			$result = doCurl(API_BASE_LINK.'personal/admin');	

			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$data['admins_info'] = $content->results;
			}


			$this->load->view('personal/user_registered_view',isset($data) ? $data : "" );
		}
	}	

	public function admin()
	{
		if (!$this->session->userdata('access_token')) {
			redirect('login','refresh');
			
		}else {

			$data =  $this->tq_admin_header_info();
			$result = doCurl(API_BASE_LINK.'personal/admin');	

			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$data['results'] = $content->results;
			}

			$this->load->view('personal/detail_admin_view',isset($data) ? $data : "" );
		}
	}

	public function edit_user_reg()
	{
		if (!$this->session->userdata('access_token')) {
			redirect('login','refresh');
			
		}else {

			$data =  $this->tq_admin_header_info();
			$re_user_id = $this->input->get('re_user_id');
			$result = doCurl(API_BASE_LINK.'personal/detail_user_reg?re_user_id='.$re_user_id);	
			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$status_code = $content->status_code;
				if($status_code == 200){
					$data['re_user_results'] = $content->results;
				}	
			}

			$this->load->view('personal/update_user_reg_view',isset($data) ? $data : "" );
		}
	}

	public function detail_user_reg()
	{
		if (!$this->session->userdata('access_token')) {
			redirect('login','refresh');
			
		}else {

			$data =  $this->tq_admin_header_info();
			$re_user_id = $this->input->get('re_user_id');

			$result = doCurl(API_BASE_LINK.'personal/detail_user_reg?re_user_id='.$re_user_id);	
			// var_dump($result);exit();
			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$status_code = $content->status_code;
				if($status_code == 200){
					$data['re_user_results'] = $content->results;
				}	
			}

			$this->load->view('personal/detail_user_reg_view',isset($data) ? $data : "" );
		}
		
	}

	public function update_user_reg()
	{
		$params['remark'] = $this->input->post('remark');
		$params['user_group_id'] = $this->input->post('user_group_id');
		$params['re_user_id'] = $this->input->post('re_user_id');		

		$url = API_BASE_LINK.'personal/update_user_reg';

		$result = doCurl($url, $params, 'POST');

		if ($result && $result['http_status_code'] == 200) {
			$content = json_decode($result['output']);
			$status_code = $content->status_code;
			if($status_code == 200){
				$this->session->set_flashdata('success', "数据更新成功！");
			}else{
				$this->session->set_flashdata('error', "数据更新失败！");				
			}

		}	

		redirect('personal/detail_user_reg?re_user_id='.$params['re_user_id'],'refresh');		
	}

	public function remark_reg_user()
	{
		$reg_user_id = $this->input->post('regUserId');
		$remark = $this->input->post('remark');
		$obj = array();	

		$result = doCurl(API_BASE_LINK.'personal/remark_reg_user?reg_user_id='.$reg_user_id.'&remark='.$remark);	

		if ($result && $result['http_status_code'] == 200) {
			$content = json_decode($result['output']);
			$status_code = $content->status_code;
			if($status_code == 200) {
			  $obj['status'] = 200;						
			}else{
			  $obj['status'] = 400;						
			  $obj['message'] = '异常错误！';						
			}	
		}	

		echo json_encode($obj);exit;	
	}	
}
