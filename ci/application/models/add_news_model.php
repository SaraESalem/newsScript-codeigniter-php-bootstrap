<?php

     class add_news_model extends CI_Model
     {
 
     	function add_new_category()
		{
		   $insert_new_cat=array(
		   'name' => $this->input->post('cat_name')
		   );		   
		   //table writer 
		   $query=$this->db->insert("category",$insert_new_cat);
		   return $query;
		   
		 }
		 function get_all_cats(){

		 	$this->db->select('id, name');
			$query = $this->db->get('category');
			return $query->result();
		 }
		 function add_news($datanew)
		{
		      
		   //table writer 
		   $query=$this->db->insert("news",$datanew);
		   return $query;
		   
		 }
		function get_one_cat_by_id($cat_id){ //`id`, `title`, `text`, `img`, `writer_id`, `cat_id`
		 	$this->db->where('id',$cat_id );
			$query = $this->db->get('category');
			return $query->row();
		 }

		 function get_all_news(){ //`id`, `title`, `text`, `img`, `writer_id`, `cat_id`
		 	$this->db->where('writer_id', $this->session->userdata('user_id'));
		 	$this->db->select('id, title,text,img,writer_id,cat_id');
			$query = $this->db->get('news');
			return $query->result();
		 }
		 function get_cat_by_id($cat_id){ //`id`, `title`, `text`, `img`, `writer_id`, `cat_id`
		 	$this->db->where('cat_id',$cat_id );
		 	$this->db->where('writer_id',$this->session->userdata('user_id') );
		 	$this->db->select('id, title,text,img,writer_id,cat_id');
			$query = $this->db->get('news');
			return $query->result();
		 }
		public function del_news_by_id($news_id)
		{
			$this->db->where('id', $news_id);
			$this->db->delete('news');
		}
		public function get_news_by_id($news_id)
		{
			$this->db->where('id',$news_id);
			$query=$this->db->get('news');
			return $query->row();
		}
		public function update_news($datanew){
						$this->db->where('id',$datanew['id']);
						return $this->db->update('news',$datanew);
		}

     }
     ?>