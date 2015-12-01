<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fellowship_life extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('pagination');                
    }	

	public function wall_for_photos()
	{
		if (!$this->session->userdata('access_token')) {

		    redirect('login','refresh');		    
		}else { 

		    $data =  $this->tq_admin_header_info();
		    $page = $this->input->get('page');

		    $data['results'] = 20;
		    $data['page'] =  $page ? $page : 1;		  

		    $result = doCurl(
				    		API_BASE_LINK.
				    		'fellowship_life/get_today_user_photos?limit='.$data['results'].
				    		'&'.'page='.$data['page']			    		
				    	);		
				    	 
			if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {					

		 			$data['total'] = $content->total;
	 				$data['user_photos_results'] = $content->results;
	 				$uri = 'fellowship_life';	
					$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);

				}	
			}else {
				show_404();exit;
			}
			
			$this->load->view('fellowship_life/fellowship_life_view' , isset($data) ? $data : "" );
		}
	}	

	
	public function load_images()
	{
		$page = $this->input->post('page');
		$data['results'] = 10;
	    $data['page'] =  $page ? $page : 1;

	    if(!empty($data['page'])){	    

		    $result = doCurl(
		    		API_BASE_LINK.
		    		'fellowship_life/get_today_user_photos?limit='.$data['results'].
		    		'&'.'page='.$data['page']
				    	);		 
			if ($result && $result['http_status_code'] == 200) {

				$content = json_decode($result['output']);
				$status_code = $content->status_code;

				if ($status_code == 200) {					

		 			$data['total'] = $content->total;
	 				$data['user_photos_results'] = $content->results;
	 				$uri = 'fellowship_life';	
					$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);

					echo json_encode($data);
				}	
			}else {
				 echo json_encode('error!');
			}
	    }	
	}	

	public function del_photos()
	{
		if (!$this->session->userdata('access_token')) {

			    redirect('login','refresh');		    
		}else { 
		    $data =  $this->tq_admin_header_info();
		    $src_id  = $this->input->post('src_id');		    
		    $admin_id = $this->session->userdata('admin_id');
		    $paths_src  = $this->input->post('paths_src');		    
			$result = doCurl(API_BASE_LINK.'fellowship_life/del_photos?src_id='.$src_id.'&admin_id='.$admin_id);
			$obj = array();

		    if ($result && $result['http_status_code'] == 200) {
				$content = json_decode($result['output']);
				$status_code = $content->status_code;
				if ($status_code == 200) {
					if(!empty($paths_src)){
						$paths_src = str_replace('\\','/',$paths_src);
						$paths_src = $data['role_path_albums'].$paths_src;
						echo json_encode($paths_src);
						echo json_encode(file_exists($paths_src));exit;

						if(file_exists($paths_src)){					
							!unlink($paths_src);
						}				 
					}

					$obj['status'] = '200';
				}else{
					$obj['status'] = '400';					
					$obj['message'] = '异常错误！';					
				}				
			}else {
				echo json_encode('error!');
				exit;
			}	

			echo json_encode($obj);exit;			
		}	
	}
}
