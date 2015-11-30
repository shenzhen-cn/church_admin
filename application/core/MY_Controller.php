<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->helper('util');
		$this->load->helper('mobile_detect');
		date_default_timezone_set('Asia/Shanghai');
	}

	public function tq_admin_header_info()
	{
		if (!$this->session->userdata('access_token')) {
			
			redirect('login','refresh');

		}else {

			$admin_id = $this->session->userdata('admin_id');

			if ($admin_id) {
				//临时图片存放地址
				$data['role_path_albums']           = 'D:/workspace/church_dev/tq_user/';
				$result = doCurl(API_BASE_LINK.'tq_admin_header_info/find?admin_id='.$admin_id);
//				var_dump($result);exit;
				if (isset($result) && $result['http_status_code'] == 200)
				{
					$contents = json_decode($result['output']);
					$content = $contents->results;
					// var_dump($content);exit;

					$data['admin_info']      					= 	$content->admin_info;
					$data['group_info']     					= 	$content->group_info;
					$data['clas_p_p']     	    = 	$content->class_name_priest_preach;

//			var_dump($data);exit;

					return $data;

				}    	
				
			}else{
				redirect('login','refresh');
			}

		}
	}
	
}
