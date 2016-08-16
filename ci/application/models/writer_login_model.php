<?php
     class writer_login_model extends CI_Model
     {
        function add_new_writer()
		{
		   $insert_new_writer=array(
		   'name' => $this->input->post('username'),
		   'email'  => $this->input->post('email'),
		   'password'  => md5($this->input->post('password')));		   
		   //table writer 
		   $query=$this->db->insert("writer",$insert_new_writer);
		   return $query;
		   
		 }
		function login_writer()
		 {
		   $this->db->where('name', $this->input->post('username2'));
		   $this->db->where('password', md5($this->input->post('password2')));
		   $query = $this->db->get('writer');
		    return $query->result();   
		 }
		   
 
     }



     ?>