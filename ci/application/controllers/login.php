<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function index(){
		$data['main_content'] = 'login_form';
		$this->load->view('template/content', $data);
	}
	function registration(){
		
		$this->load->library('form_validation');
		//('field'=>'name','label'=>'Page Title','rules'=>'trim|required'
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() == FALSE)
		{
				$this->index();
		}
		else
		{			
			$this->load->model('writer_login_model');
			if($query = $this->writer_login_model->add_new_writer() ){
				$this->index();
				echo "<h4 style='color:#336600;text-align:center;margin-top:20px'>Register Successfully.Now you have new account.and Login Now </h4>";						   
			}else
			{
				$this->index();			
			 }
		}
	}
	function writer_login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username2', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[4]|max_length[32]');
		if($this->form_validation->run() == FALSE)
		{
				$this->index();
		}
		else
		{	
				$this->load->model('writer_login_model');
				$query = $this->writer_login_model->login_writer();
				if($query){
					$usr_data = array(
						"user_id"=>$query[0]->id,
						'username'=> $this->input->post('username2'),
						'is_logged_in' => true
					);
			
					$this->session->set_userdata($usr_data);
					$data['main_content'] = 'add_news_form';
					//get cats from db
					$this->load->model('add_news_model');
					$data['cat_res'] = $this->add_news_model->get_all_cats();

					$this->load->view('template/content', $data);
				}else{
					$this->index();
				}
		}
		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}
