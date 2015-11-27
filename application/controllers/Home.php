<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

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
			
			$this->load->view('home_view', isset($data) ? $data : "");
		}
	}
	
}
