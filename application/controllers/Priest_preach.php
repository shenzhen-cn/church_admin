<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Priest_preach extends MY_Controller {

	 /**
     * Constructor function
     */
	 public function __construct() {
	 	parent::__construct();
	 	$this->load->helper('pagination');
	 }

	 public function index() {

	 	if (!$this->session->userdata('access_token')) {

	 		redirect('login','refresh');
	 	}else {
	 		$data =  $this->tq_admin_header_info();	
	 		$id  =  $this->input->get('id') ? $this->input->get('id') : "";
	 		$data['results'] = $this->input->get('results') ? $this->input->get('results') : 10;
	 		$data['page'] = $this->input->get('page') ? $this->input->get('page') : 1;		
	 		if (!empty($id)) {

		 		$results = doCurl(API_BASE_LINK.
		 			'priest_preach/get_priest_preach_by_id?id='.$id.
		 			'&'.'limit='.$data['results'].
		 			'&'.'page='.$data['page']);

		 		if ($results && $results['http_status_code'] ==200) {
		 			$content = json_decode($results['output']);
		 			$status_code = $content->status_code;

		 			if ($status_code == 200) {

			 			$data['total'] = $content->total;
		 				$data['content'] = $content->results;
		 				$uri = 'priest_preach';	
						$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);
		 			}
		 					
		 		}else {
		 			show_404();exit();
		 		}	
	 			
	 		}else{
	 			show_404();exit;
	 		}

	 		$this->load->view('priest_preach/priest_preach_view' ,isset($data) ? $data : "" );
	 	}	
	 }

	 public function pp_read()
	 {
	 	if (!$this->session->userdata('access_token')) {

	 		redirect('login','refresh');
	 	}else {
	 		$data =  $this->tq_admin_header_info();

	 		$id = $this->input->get('id') ? $this->input->get('id') : "";	
	 		

	 		if (!empty($id)) {
		 		$results = doCurl(API_BASE_LINK.'priest_preach/pp_read_by_id?id='."$id");
	 			// var_dump($results);exit;
	 			if ($results && $results['http_status_code'] ==200) {
	 				$content = json_decode($results['output']);
	 				$status_code = $content->status_code;

	 				if ($status_code == 200) {
		 				$data['results'] = $content->results;
	 				}	

	 			}else {
	 				show_404();exit;
	 			}		

	 		}else {

	 			redirect('Priest_preach','refresh');
	 		}

		 	$this->load->view('priest_preach/pp_read_view' ,isset($data) ? $data : "" );	
	 	}
	 }

	 public function PP_add($value='')
	 {
	 	if (!$this->session->userdata('access_token')) {

	 		redirect('login','refresh');
	 	}else {

	 		$data =  $this->tq_admin_header_info();
	 		$temp_post = $this->input->post();
	 		if ($temp_post) {

	 			$params['course_class'] = $this->input->post('course_class') ? $this->input->post('course_class') : "" ;
	 			$params['admin_id'] = $this->session->userdata('admin_id') ? $this->session->userdata('admin_id') : "" ;

	 			$url = API_BASE_LINK.'priest_preach/add_course_class';
	 			$result = doCurl($url, $params, 'POST');
	 			if ($result && $result['http_status_code'] ==200) {
	 				$content = json_decode($result['output']);
	 				$status_code = $content->status_code;
	 				if ($status_code == 401) {

	 					$message = $content->message;
	 					$this->session->set_flashdata('info', $message);
	 				}else if ($status_code == 400) {

	 					$message = $content->message;
	 					$this->session->set_flashdata('error', $message);

	 				}else if ($status_code == 200) {

	 					$message = $content->message;
	 					$this->session->set_flashdata('success', $message);
	 				}

	 				redirect('priest_preach?id=1','refresh');
	 			}else{

	 				show_404();exit();
	 			}

	 		}	


	 		$this->load->view('priest_preach/pp_add_view' ,isset($data) ? $data : "" );	
	 	}
	 }



	 public function uploadCourse()
	 {
	 	if (!$this->session->userdata('access_token')) {

	 		redirect('login','refresh');
	 	}else {

	 		$data =  $this->tq_admin_header_info();	

	 		$this->load->view('priest_preach/pp_uploadCourse_view', isset($data) ? $data : "" );	
	 	}	
	 }

	 public function getContent()
	 {
	 	if (!$this->session->userdata('access_token')) {

	 		redirect('login','refresh');
	 	}else {

	 		$params = $this->input->post();
	 		$upload_data = $this->do_upload();

	 		if (isset($upload_data['error'])) {
	 			
	 			$error  = $upload_data['error'] ;
	 			$this->session->set_flashdata('error', $error);


	 		}else  if (!empty($params)) {

	 			$params['p_p_c_n_id']     = $this->input->post('p_p_c_n_id') ? $this->input->post('p_p_c_n_id') : "" ;
	 			$params['course_title']   = $this->input->post('course_title') ? $this->input->post('course_title') : "" ;
	 			$params['share_from']     = $this->input->post('share_from') ? $this->input->post('share_from') : "" ;
	 			$params['course_keys']    = $this->input->post('course_keys') ? $this->input->post('course_keys') : "" ;
	 			$params['admin_id']       = $this->session->userdata('admin_id') ? $this->session->userdata('admin_id') : "";
	 			$params['file_name']      = isset($upload_data['file_name']) ? $upload_data['file_name'] : "";
	 			$params['full_path']      = isset($upload_data['full_path']) ? $upload_data['full_path'] : "";
	 			$params['orig_name']      = isset($upload_data['orig_name']) ? $upload_data['orig_name'] : "";
	 			$params['file_size']      = isset($upload_data['file_size']) ? $upload_data['file_size'] : "";


	 			$url = API_BASE_LINK.'priest_preach/getContent';

	 			$result = doCurl($url, $params, 'POST');	 			
	 			if ($result && $result['http_status_code'] == 200 ) {
		 			$content = json_decode($result['output']);

		 			$status_code = $content->status_code;
		 			$results = isset($content->results) ? $content->results : "";		
		 			if ($status_code == 200 && $results >= 1) {

	 					$this->session->set_flashdata('success', '提交成功！');
		 			}

	 			}else {
	 				show_404();exit();
	 			}
	 			
	 		}

	 		redirect('uploadCourse','refresh');	
	 	}

	 }

    public function myEdit()
    {
    	if (!$this->session->userdata('access_token')) {

    		redirect('login','refresh');
    	}else {

    		$detect = new Mobile_Detect();
    		
    		if ($detect->isMobile()) {
	 			$this->session->set_flashdata('info', '该功能不支持你的手机，请在电脑操作！');    				
    		    redirect('Home','refresh');
    		    exit();
    		}	
    		
	 		$data =  $this->tq_admin_header_info();	
	 		$id =  $this->input->get('id');

    		$id = !empty($id) ? $id : "" ;
    		$temp_get = $this->input->get();
    		if (!empty($temp_get)) {
    			$results = doCurl(API_BASE_LINK.'priest_preach/read_myEdit_by_id?document_id='.$id);
    			if ($results && $results['http_status_code'] == 200 ) {
    				$content = json_decode($results['output']);
    				$status_code = $content->status_code;

    				if ($status_code == 200) {
    					$data['results'] = $content->results->rows;
    				}

    			}else {
    				show_404();exit;
    			}
    		}

	 		$this->load->view('priest_preach/pp_myEdit_view', isset($data) ? $data : "" );	

    	}
    }

    public function read_myEdit()
    {
    	if (!$this->session->userdata('access_token')) {

    		redirect('login','refresh');
    	}else {

	 		$data =  $this->tq_admin_header_info();	
    		$document_id = $this->input->get('document_id') ? $this->input->get('document_id') : '' ;
    		$results = doCurl(API_BASE_LINK.'priest_preach/read_myEdit_by_id?document_id='.$document_id);
			if ($results && $results['http_status_code'] == 200 ) {
				$content = json_decode($results['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {
					$data['results'] = $content->results->rows;
					$data['pre_id'] = $content->results->pre_id;
					$data['next_id'] = $content->results->next_id;
				}

			}else {
				show_404();exit;
			}
			
	 		$this->load->view('priest_preach/pp_read_view', isset($data) ? $data : "" );	

    	}
    }

    public function getmyEditor()
    {
    	if (!$this->session->userdata('access_token')) {

    		redirect('login','refresh');
    	}else {

    		$data =  $this->tq_admin_header_info();
    		$temp_post = $this->input->post();
    		if (!empty($temp_post)) {
		 		$params['myEditor']       = $this->input->post('myEditor') ? $this->input->post('myEditor') : "" ;
		 		$params['admin_id']       = $this->session->userdata('admin_id') ? $this->session->userdata('admin_id') : "";
		 		$params['document_id']    = $this->input->post('document_id') ? $this->input->post('document_id') : "";
    			
		 		$url = API_BASE_LINK.'priest_preach/getmyEditor';
		 		$result = doCurl($url, $params, 'POST');	
		 		if ($result && $result['http_status_code'] == 200 ) {
		 			$content = json_decode($result['output']);
		 			$status_code = $content->status_code;

		 			if ($status_code == 200) {
			 			$is_set = $content->results;
			 			$message = $is_set > 0 ? "内容提交完成" : "内容提交提交失败！请重试一次！" ;	
	 					$this->session->set_flashdata('info', $message);

		 			}else if ($status_code == 400) {
	 					$this->session->set_flashdata('error', "内容提交提交失败！");

		 			}
		 				 		
			 		
	    			redirect('priest_preach/read_myEdit?document_id='.$params['document_id'],'refresh');
		 		}else {
		 			show_404();exit;
		 		}	

    		}else{
    			redirect('priest_preach/myEdit','refresh');
    		}

    	}
    }

    public function do_upload()
    {

        $config['upload_path']      = './public/uploads/files/course_ppt/';
        $config['allowed_types']    = '*';
        $config['max_width']        = 3072;
        $config['overwrite']        = false;
        $config['encrypt_name']     = TRUE;
        $config['remove_spaces']    = TRUE;
        $config['detect_mime']      = TRUE;
		        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('attachment'))
        {
        	$return_str = array();
            $error = array('error' => $this->upload->display_errors());
            // var_dump($error);exit;
            switch ($error['error']) {
            	case '<p>The filetype you are attempting to upload is not allowed.</p>':
            		$return_str['error'] = '提交的文件类型错误,只能为ppt、doc、pdf格式！' ;
            		break;
            	case '<p>The uploaded file exceeds the maximum allowed size in your PHP configuration file.</p>':
            		$return_str['error'] = '文件大于2M！' ;
            		break;
            	case '<p>The upload path does not appear to be valid.</p>':
            		$return_str['error'] = '文件上传路径错误！' ;
            		break;		
            		
            	default:
            		$return_str['error'] = '提交的文件错误！' ;
            		break;
            }

            return $return_str;
        }
        else
        {
         	$data = $this->upload->data();
         	if (isset($data)) {
         		$return_str = array(
		     			'file_name' => $data['file_name'],
		     			'full_path' => $config['upload_path'],
		     			'orig_name' => $data['orig_name'],
		     			'file_size' => $data['file_size'],
         			 );
         	}
            

	        return $return_str;
        }

    }

    public function course_download()
    {
    	if (!$this->session->userdata('access_token')) {

    		redirect('login','refresh');
    	}else {
    		// var_dump($this->input->post());exit;
    		$temp_post = $this->input->post();
    		if (! empty($temp_post)) {
	    		$file_name = $this->input->post('file_name');
	    		$full_path = $this->input->post('full_path');
	    		$orig_name = $this->input->post('orig_name');
    			
	    		$this->load->helper('download');  
	    		// $data = file_get_contents("http://localhost/church/tq_admin_web/public/uploads/files/course_ppt/c9b1c3e9d70743723581d07604655f30.pdf"); // 读文件内容  
	    		// echo $full_path.$file_name;exit;
	    		// $data = file_get_contents("http://localhost/church/tq_admin_web/public/".$full_path.""); // 读文件内容  
	    		$data = file_get_contents($full_path.$file_name); // 读文件内容  
	    		$download_file_name = $orig_name;      			
	    		force_download($download_file_name, $data); 

    		}else{
    			show_404();exit;
    		}

    	}
    }

    public function del_course()
    {
    	if (!$this->session->userdata('access_token')) {

    		redirect('login','refresh');
    	}else {
    		$id = $this->input->get('id') ? $this->input->get('id') : "" ;
    		$class_priest_id = $this->input->get('class_priest_id') ? $this->input->get('class_priest_id') : "" ;
    		$admin_id = $this->session->userdata('admin_id') ? $this->session->userdata('admin_id') : "" ;
    		$file_name = $this->input->get('file_name');

    		if (!empty($id) && !empty($admin_id) ) {    			
				$result = doCurl(API_BASE_LINK.'priest_preach/del_course?id='.$id.'&admin_id='.$admin_id);

				if ($result && $result['http_status_code'] ==200) {
					$content = json_decode($result['output']);
					$status_code = $content->status_code;
					if ($status_code == 200) {
						 if(!empty($file_name)){			
							$file = 'uploads/files/course_ppt/'.$file_name;
						 	if(file_exists($file)){					
						 		!unlink($file);
						 	}				 
						 }
	 					$this->session->set_flashdata('success', '成功删除！');
					}

				}else {
					show_404();exit;
				}
				
    		}

    		redirect('priest_preach?id='.$class_priest_id,'refresh');
    	}
    }

    public function del_document()
    {
    	if (!$this->session->userdata('access_token')) {

    		redirect('login','refresh');
    	}else {
    		$document_id = $this->input->get('document_id') ? $this->input->get('document_id') : "" ;
    		$admin_id = $this->session->userdata('admin_id') ? $this->session->userdata('admin_id') : "" ;
			if (!empty($document_id) && !empty($admin_id) ) {
    			
				$result = doCurl(API_BASE_LINK.'priest_preach/del_document?id='.$document_id.'&admin_id='.$admin_id);

				// var_dump($result);exit;	
				if ($result && $result['http_status_code'] ==200) {
					$content = json_decode($result['output']);
					$status_code = $content->status_code;

					if ($status_code == 200) {
	 					$this->session->set_flashdata('success', '成功删除！');
					}

				}else {
					show_404();exit;
				}
				
    		}

    		redirect('priest_preach/read_myEdit','refresh');
    		
    	}
    }
}
