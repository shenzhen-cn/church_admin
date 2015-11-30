<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

	 /**
     * Constructor function
     */
    public function __construct() {
        parent::__construct();
    }

	public function index() {
		$access_token = $this->session->userdata('access_token');
		if ($access_token) {
			$this->session->unset_userdata('access_token');
			redirect(site_url('login'),'refresh');

		}else {

			$params['admin_name'] = $this->input->post('admin_name');
			$params['admin_pwd'] = $this->input->post('admin_pwd');
			$url = API_BASE_LINK.'adminLogin/checkLogin';
			$result = doCurl($url, $params, 'POST');
			// var_dump($result);exit;
			if (isset($result) && $result['http_status_code'] == 400 && !empty($params['admin_pwd']))
			{
			    $result = json_decode($result['output']);
			    $status_code = $result->status_code;
			    $message     = $result->message;

			    if ($status_code == 400) {
					$data['error'] = $message;

			    }
			    else if ($status_code == 401) {

					$data['error'] = $message;

			    }
			    else if ($status_code == 402) {
					$data['error'] = $message;
			    }

			}else if (isset($result) && $result['http_status_code'] == 200) {
//				var_dump($result);exit;
				$result = json_decode($result['output']);

			    $status_code = $result->status_code;
			    $content = $result->results;

			    $admin_id = $result->results->account_id;
			    $token   = $result->results->access_token;

	            $this->session->set_userdata('access_token', $token);
	            $this->session->set_userdata('admin_id', $admin_id);
	            redirect('home','refresh');
			}

			$this->load->view('login_view',isset($data) ? $data : "");

		}
	}

	public  function reset_pwd_for_forget()
	{
		$op = $this->input->get('op');
		$id = $this->input->get('id');
		$token = $this->input->get('token');
		// var_dump($op);var_dump($id);var_dump($token);exit;
		if (!empty($op) && !empty($id) &&  !empty($token)) {

			$result = doCurl(API_BASE_LINK.'register/reset_pwd_for_forget?op='.$op."&id=".$id."&token=".$token);
			if ($result && $result['http_status_code'] == 200) {

				$content   = json_decode($result['output']);

				$status_code    = $content->status_code;
				$get_op         = $content->op;


				if ($status_code == 200 && $get_op == 'resetpwd') {
					
					$data['get_admin_info'] = $content->get_admin_info;
					$data['get_op'] = $get_op;
					$this->load->view('rest_pwd_for_forget',isset($data) ? $data : "");
				} 
				else{
					exit('无效链接！');
				}				
			}			
		}else {
			show_404();exit();
		}			
	}

	public function reset_admin_pwd()
	{
		$temp_pwd2 = $this->input->post('pwd2');
		$params['pwd2'] = !empty($temp_pwd2) ? md5(md5($temp_pwd2)) : "";			
		$params['admin_id']  = $this->input->post('admin_id');

		$url = API_BASE_LINK.'admin_setting/reset_admin_pwd';
		$result = doCurl($url, $params, 'POST');
		if ($result && $result['http_status_code'] == 200) {
			$content   = json_decode($result['output']);
			$status_code    = $content->status_code;
			// var_dump($status_code);exit();

			if ($status_code == 200) {
				redirect(site_url('login'),'refresh');									
			}else{
	 			echo "密码重置失败！"; exit();									
			}				
		}else{
			show_404();exit();
		}			


	}

}
