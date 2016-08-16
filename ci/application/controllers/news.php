<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller {
	function index(){
		$data['main_content'] = 'add_category_form';
		$this->load->view('template/content', $data);
	}
	function addNews(){
		$data['main_content'] = 'add_news_form';
		//get cats from db
					$this->load->model('add_news_model');
					$data['cat_res'] = $this->add_news_model->get_all_cats();
		$this->load->view('template/content', $data);
	}
	function allNews(){
	$this->load->model('add_news_model');
	$datax['cat_res'] = $this->add_news_model->get_all_cats();
	$datax['news_res'] = $this->add_news_model->get_all_news();
	$datax['main_content'] = 'display_all_news';
	$this->load->view('template/content', $datax);
	}
   
   function add_category(){
   	
   	$this->load->library('form_validation');
   	$this->form_validation->set_rules('cat_name', 'category name', 'trim|required|min_length[4]');
   	if($this->form_validation->run() == FALSE)
		{
				$data['main_content'] = 'add_news_form';
				$this->load->view('template/content', $data);
		}
		else
		{			
			$this->load->model('add_news_model');
			$query = $this->add_news_model->add_new_category();
			if($query){
				$data['main_content'] = 'add_news_form';
				//get cats from db
				$this->load->model('add_news_model');
				$data['cat_res'] = $this->add_news_model->get_all_cats();
				$this->load->view('template/content', $data);
				echo "<h4 style='color:#336600;text-align:center;margin-top:20px'>Category added Successfully.Now complete adding news </h4>";						   
			}else
			{
				$data['main_content'] = 'add_news_form';
				$this->load->view('template/content', $data);			
			 }
		}
   }

   function add_news(){
   		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('text', 'text', 'trim|required|min_length[10]');
		if (empty($_FILES['img_file']['name']))
		{
    		$this->form_validation->set_rules('img_file', 'upload image', 'required');
		}

		$this->form_validation->set_rules('cats','cats Options','required');
		if($this->form_validation->run() == FALSE )
		{
				$data['main_content'] = 'add_news_form';
				//get cats from db
				$this->load->model('add_news_model');
				$data['cat_res'] = $this->add_news_model->get_all_cats();
				$this->load->view('template/content', $data);
		}else
		{	
			$config['upload_path'] = './uploads/';
    		$config['allowed_types'] = 'gif|jpg|png';
    		$config['max_size'] = '500';
    		$config['max_width']  = '1024';
    		$config['max_height']  = '768';
    		$config['overwrite'] = TRUE;
    		$config['encrypt_name'] = FALSE;
    		$config['remove_spaces'] = TRUE;
    		if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
    		$this->load->library('upload', $config);
    		if ( ! $this->upload->do_upload('img_file'))
    		{
        		echo 'error uploading image try another one <br/>';
        		die("error uploading image try another one <a href='".base_url()."newsadd' style='font-weight:bold'> Back </a> ");
    		}
    		else
    		{
    			$datanewx['imgx'] = $this->upload->data();
    			$datanew['img'] =$datanewx['imgx']['file_name'];
        		//var_dump($datanewx['imgx']) ;
    		}
    		$datanew['title'] = $this->input->post('title');
    		$datanew['text'] = $this->input->post('text');
    		if($this->session->userdata('is_logged_in')){
                  $datanew['writer_id'] =  $this->session->userdata('user_id');                    
             } 
             $datanew['cat_id'] = $this->input->post('cats');
             //echo $datanew['img']['full_path']."<br/>";
             //var_dump($datanew);
             //display all news page
            $this->load->model('add_news_model');
			$query = $this->add_news_model->add_news($datanew);
			if($query){
				$this->load->model('add_news_model');
				$datax['cat_res'] = $this->add_news_model->get_all_cats();
				$datax['news_res'] = $this->add_news_model->get_all_news();
				$datax['main_content'] = 'display_all_news';
				$this->load->view('template/content', $datax);				
			}else
			{
				$datay['main_content'] = 'add_news_form';
				$this->load->view('template/content', $datay);			
			 }
		}

   }
   function display_cat_details($cat_id){
   		$this->load->model('add_news_model');
   		$datax['cat_res'] = $this->add_news_model->get_all_cats();
	    $datax['news_res'] = $this->add_news_model->get_cat_by_id($cat_id);
	    $datax['main_content'] = 'display_all_news';
		$this->load->view('template/content', $datax);
   }
   function delete_news($news_id){
   		$this->load->model('add_news_model');
   		$this->add_news_model->del_news_by_id($news_id);
   		redirect('news/allNews');
   }
   function edit_news($news_id){
   		$this->load->model('add_news_model');
   		$datax['res'] = $this->add_news_model->get_news_by_id($news_id);
   		$datax['cat_res'] = $this->add_news_model->get_all_cats();
   		$datax['cat_name'] = $this->add_news_model->get_one_cat_by_id($datax['res']->cat_id);

   		$datax['main_content'] = 'edit_news_form';
		$this->load->view('template/content', $datax);
   }
    function update_news($news_id){
    	
   		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('text', 'text', 'trim|required|min_length[10]');
		if (empty($_FILES['img_file']['name']))
		{
    		$this->form_validation->set_rules('img_file', 'upload image', 'required');
		}

		$this->form_validation->set_rules('cats','cats Options','required');
		if($this->form_validation->run() == FALSE )
		{
				$this->edit_news($news_id);
		}else
		{	
			$config['upload_path'] = './uploads/';
    		$config['allowed_types'] = 'gif|jpg|png';
    		$config['max_size'] = '500';
    		$config['max_width']  = '1024';
    		$config['max_height']  = '768';
    		$config['overwrite'] = TRUE;
    		$config['encrypt_name'] = FALSE;
    		$config['remove_spaces'] = TRUE;
    		if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
    		$this->load->library('upload', $config);
    		if ( ! $this->upload->do_upload('img_file'))
    		{
        		echo 'error uploading image try another one <br/>';
        		die("error uploading image try another one <a href='".base_url()."news/edit_news/".$news_id." style='font-weight:bold'> Back </a> ");
    		}
    		else
    		{
    			$datanewx['imgx'] = $this->upload->data();
    			$datanew['img'] =$datanewx['imgx']['file_name'];
        		//var_dump($datanewx['imgx']) ;
    		}
    		$datanew['id'] = $news_id;
    		$datanew['title'] = $this->input->post('title');
    		$datanew['text'] = $this->input->post('text');
    		if($this->session->userdata('is_logged_in')){
                  $datanew['writer_id'] =  $this->session->userdata('user_id');                    
             } 
             $datanew['cat_id'] = $this->input->post('cats');
             //echo $datanew['img']['full_path']."<br/>";
             //var_dump($datanew);
             //display all news page
            // var_dump($datanew);
            // die();
            $this->load->model('add_news_model');
			$query = $this->add_news_model->update_news($datanew);
			if($query){
				$this->load->model('add_news_model');
				$datax['cat_res'] = $this->add_news_model->get_all_cats();
				$datax['news_res'] = $this->add_news_model->get_all_news();
				$datax['main_content'] = 'display_all_news';
				$this->load->view('template/content', $datax);				
			}else
			{
				$this->edit_news($news_id);			
			 }
		}

   }
   
}

?>