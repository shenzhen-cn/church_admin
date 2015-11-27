<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helpers('uploadFiles');
	 	$this->load->helper('pagination');
		

	}

	public function index()
	{
		$this->load->view('personal/personal_view');
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
				$msg_return = uploadFiles( $fileInfo,$uploadPath);

				if (isset($msg_return['msg']) ) {
					$this->session->set_flashdata('error', $msg_return['msg']);
					redirect('setPersonalData','refresh');	
				}else{
					$params['adminHeadSrc']	= $msg_return['newName'];
				}	

				if(!empty($adminHead_src)){
					$file = 'public/uploads/userHeadsrc/'.$adminHead_src;
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

	public function addPersonal()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');

		}else {

			$data =  $this->tq_admin_header_info();

			$params['re_user_email'] = $this->input->post('re_user_email') ; 
			$params['admin_id'] = $this->session->userdata('admin_id'); 
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

	public function user_registered()
	{
		if (!$this->session->userdata('access_token')) {
			redirect('login','refresh');
			
		}else {

			$data =  $this->tq_admin_header_info();
			$data['results'] = $this->input->get('results') ? $this->input->get('results') : 10;
			$data['page'] = $this->input->get('page') ? $this->input->get('page') : 1;	

			$result = doCurl(API_BASE_LINK.'personal/user_registered?limit='.$data['results'].
		 			'&page='.$data['page']);	

			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$data['results'] = $content->results;
			 	$data['total'] = $content->total;
 				$uri = '';	
				$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);

			}

			$this->load->view('personal/user_registered',isset($data) ? $data : "" );
		}
	}
}
