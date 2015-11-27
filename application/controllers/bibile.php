	<?php
	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	class Bibile extends MY_Controller {

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

			$result = doCurl(API_BASE_LINK.'bibile/find_volumeName');
			// var_dump($result);exit;

			if ($result && $result['http_status_code'] == 200)
			{
				 $data['results'] = json_decode($result['output']);		
				// var_dump($results);exit;
				$this->load->view('bibile/bibile_view', isset($data) ? $data : "");
			}else{
				show_404();exit;
			}
		}

	}

	public function look_volume()
	{
		if (!$this->session->userdata('access_token')) {

			redirect('login','refresh');
		} else{
			
			$data =  $this->tq_admin_header_info();
			$book_id = $this->input->get('book_id');
			// var_dump($book_id);
			$chapter_id = $this->input->get('chapter_id');
			$chapter_id = isset($chapter_id)  > 0  ? $chapter_id : 1 ;
			// var_dump($chapter_id);exit;

			$result = doCurl(API_BASE_LINK.'bibile/look_volume?book_id='."$book_id".'&chapter_id='."$chapter_id");
			// var_dump($result);exit;

			if ($result && $result['http_status_code'] == 200)
			{
				 $results = json_decode($result['output']);		
				 $data['bible_section'] 	= $results->bible_section;
				 $data['bible_note']    	= $results->bible_note;
				 $data['volume_name']    	= $results->volume_name;
				 $data['count_chapter']    	= $results->count_chapter;

				 // var_dump($count_chapter);exit;
				 $this->load->view('bibile/look_volume_view',isset($data) ? $data : "");	
			}else{
				show_404();exit;
			}

			
		}

	}

	public function onlineBibile()
	{
		if (! $this->session->userdata('access_token')) {
			redirect('login','refresh');			
		}
		else {

			$data =  $this->tq_admin_header_info();
			
			$data['results'] = $this->input->get('results') ? $this->input->get('results') : 10;
			$data['page'] = $this->input->get('page') ? $this->input->get('page') : 1;	
			$search_keyword = trim($this->input->get('search_keyword'));
			// echo strlen($search_keyword);exit;

			
			$result = doCurl(API_BASE_LINK.
							'bibile/onlineBibile?search_keyword='.$search_keyword.
							'&'.'limit='.$data['results'].
							'&'.'page='.$data['page']);


			if ($result && $result['http_status_code'] == 200){

				$content = json_decode($result['output']);	
				if (isset($content->message)) {
					$message = $content->message;
					$data['error'] = $message;
					// $this->session->set_flashdata('error', $message);
					
				}else{

					$data['total'] = $content->total;
					// var_dump()
					$data['results'] = $content->results;
					$uri = 'onlineBibile';	
					$data['pagination'] = pagination($content->total, $data['page'], $content->results, $uri);					
				}
			}


			$this->load->view('bibile/onlineBibile_view',isset($data) ? $data : "");	
		}
	}

	public function get_bibile_book_id_by_testament()
	{
		$testament = $this->input->get('testament') ;
		$testament = isset($testament) ? $testament : "";

		$result = doCurl(API_BASE_LINK.
						'bibile/get_bibile_book_id_by_testament?testament='.$testament);
		if ($result && $result['http_status_code'] == 200) {
			$content = json_decode($result['output']);
			$status_code = $content->status_code;
			if ($status_code == 200 ) {
				$results = $content->results;
				$book_name = json_encode($results);
				echo $book_name;				
			}else{
				show_404();exit();
			}
			
		}
		
	}

	public function get_bible_section_by_book_id()
	{
		$book_id = $this->input->get('book_id') ;
		$book_id = isset($book_id) ? $book_id : "";

		$result = doCurl(API_BASE_LINK.
						'bibile/get_bible_section_by_book_id?book_id='.$book_id);
		if ($result && $result['http_status_code'] == 200) {
			$content = json_decode($result['output']);
			$status_code = $content->status_code;
			if ($status_code == 200 ) {
				$results = $content->results;
				$book_name = json_encode($results);
				echo $book_name;				
			}else{
				show_404();exit();
			}
			
		}
	}

	

}
