<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sign_out extends MY_Controller {

	 /**
     * Constructor function
     */
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        // Unset access token in session
        $this->session->unset_userdata('access_token');
        
        // Display sign out page
        $this->load->view('login_view');
    }
}
