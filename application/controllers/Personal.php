<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helpers('uploadfiles');
	 	$this->load->helper('pagination');
		

	}

//	public function index()
//	{
//		$this->load->view('personal/personal_view');
//	}

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
//			var_dump($adminHead_src);exit;
			$userHeadSrc = $this->input->post('userHeadSrc') ;
//			var_dump($userHeadSrc);exit;


			if(!empty($userHeadSrc) && $userHeadSrc  == $adminHead_src){
				$params['adminHeadSrc']	= $userHeadSrc;
			}else{
				$fileInfo = $_FILES['uploadphoto'];
				$uploadPath = "public/uploads/userHeadsrc";
				$msg_return = uploadFiles($fileInfo,$uploadPath);
//				var_dump($msg_return);exit;


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
//			var_dump($params);exit;
			$url = API_BASE_LINK.'personal/upload_admin_photo';
			$result = doCurl($url, $params, 'POST');
//			var_dump($result);exit;

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
//			echo "sdfsdf";exit;
			redirect('setPersonalData','refresh');
		}
		
	}

	public function add_personal()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');

		}else {
//			var_dump('ssdfsdf');exit;
			$data =  $this->tq_admin_header_info();
			$params['re_user_email'] = $this->input->post('re_user_email') ;
			$params['admin_id']      = $this->session->userdata('admin_id');
//			var_dump($params);exit;
			if ( ! empty($params['re_user_email'])) {
				$url = API_BASE_LINK.'user/addPersonal';

//				echo $url;exit;
				$result = doCurl($url, $params, 'POST');
//				var_dump($result);exit;
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
//					var_dump($data);exit;
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
			$results = $this->input->get('results');	
			$page  = $this->input->get('page');

			$data['results'] =  $results ? $results : 10;
			$data['page'] = $page  ? $page : 1;	

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
