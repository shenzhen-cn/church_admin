<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wallofprayer extends MY_Controller {

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
			$data['results'] = 10;
			$data['page'] = $this->input->get('page') ? $this->input->get('page') : 1;

			$get_all_prayer = doCurl(API_BASE_LINK.
				'wallOfPrayer/get_all_prayer'.
				'?limit='.$data['results'].
				'&page='.$data['page']
				);

//			var_dump($get_all_prayer);exit;
			if ($get_all_prayer && $get_all_prayer['http_status_code'] ==200) {
				$content = json_decode($get_all_prayer['output']);
				$status_code	 = $content->status_code;
				if ($status_code == 200) {
					$data['total']	 = $content->total;
					$data['get_all_prayer'] = $content->results;	
					
				}
			}

			$this->load->view('Wallofprayer/timeline_of_prayer_view',isset($data) ? $data : "");
		}
    }

    public function get_json_wallofprayer()
    {
    	$data['results'] = 10;
    	$data['page'] = $this->input->post('page') ? $this->input->post('page') : 1;
    	
    	$get_all_prayer = doCurl(API_BASE_LINK.
    		'wallOfPrayer/get_all_prayer'.
    		'?limit='.$data['results'].
    		'&page='.$data['page']
    		);			

    	if ($get_all_prayer && $get_all_prayer['http_status_code'] ==200) {
    		$content = json_decode($get_all_prayer['output']);
    		$status_code	 = $content->status_code;
    		
    		if ($status_code == 200) {
    			$data['get_all_prayer_json'] = $content->results;	
    			echo json_encode($data);exit;
    		}
    	}else {
    		echo json_encode('error!');exit;
    	}
    }
}
