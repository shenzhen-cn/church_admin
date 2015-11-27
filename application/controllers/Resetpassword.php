<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resetpassword extends MY_Controller {

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

			$data =  $this->tq_admin_header_info();
			$params['currentPwd'] = $this->input->post('currentPwd');
			$params['confirmNewPwd'] = $this->input->post('confirmNewPwd');
			$params['admin_id'] = $this->session->userdata('admin_id');
			// var_dump($params);exit;
			if (empty($this->input->post())) {
				
				$this->load->view('resetPassword_view',isset($data) ? $data : "");
			}else{
				// var_dump($params);exit;
				$result = $this->alteradminPassword($params);
				// var_dump($result);exit();
				if ($result && $result['http_status_code'] == 200) {
					$content = json_decode($result['output']); 
					$is_reset = $content->results;				

					if (! isset($is_reset) && $is_reset<=0  ) {
						// $data['error'] = '密码修改失败！请重试！';	
	 					$this->session->set_flashdata('error', '密码修改失败！请重试！');						
						redirect('resetpassword','refresh');
					}else{
						
				        $this->session->unset_userdata('access_token');
						redirect('login','refresh');
					}
				}else{
					show_404();exit;
				}

			}

		 } 	

	}

	public function forgetpassword() {

		$params['user_email']  = $this->input->post('user_email');
		$checkcode1		  =  strtolower(trim($this->input->post('checkcode')));
		$checkcode        = md5($checkcode1);
		$cookie_checkcode = $this->input->cookie("checkpic");
		if (!empty($checkcode1) && ($checkcode != $cookie_checkcode)) {
			$data['error'] = '验证码输入错误！';
			$this->load->view('forgetpassword_view',isset($data) ? $data: "" );
	    }else{

			if (!empty($params['user_email'])) {

				$result = $this->alteradminPassword($params);
				if ($result && $result['http_status_code'] == 200) {
					$content = json_decode($result['output']); 
					$status_code = $content->status_code;

					if ($status_code && $status_code == 200) {
						$message = $content->message;
						$data['success'] = $message;							
						$this->load->view('forgetpassword_view',isset($data) ? $data: "" );
					} else{

						$message = $content->message;
						$data['error'] = $message;							
						$this->load->view('forgetpassword_view',isset($data) ? $data: "" );
					}
				}				
				  			    		
			}else {
				$this->load->view('forgetpassword_view');

			}	    	
	    }	

	}

	public function alteradminPassword($params='')
	{
		if (! empty($params)) {
			$url = API_BASE_LINK.'register/alteradminPassword';
			$result = doCurl($url, $params, 'POST');
			return $result;
		}else{
			return false;
		}	

	}

	public function checkCurrentadminPwd()
	{
		if (!$this->session->userdata('access_token')) {

			redirect('login','refresh');
		}else {

			$params['currentPwd']  = $this->input->post('currentPwd') ? $this->input->post('currentPwd') : "";
			$params['admin_id'] = $this->session->userdata('admin_id') ? $this->session->userdata('admin_id') : "" ;
			// var_dump($params);exit;
			$url = API_BASE_LINK.'resetpassword/checkCurrentadminPwd';
			// echo $url;exit;
			$result = doCurl($url, $params, 'POST');
			if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']); 
				$is_bool = $content->results;
				echo json_encode($is_bool);				
			}else{
				show_404();exit;
			}			
		}	
	}
}
