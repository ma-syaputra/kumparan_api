<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_aggregation_model extends CI_Model {
	public function __construct()
	 {
	  		 parent::__construct();
	  		 $this->load->database();
	 }

public function insert_aggregation($array){
		$this->db->insert("topic",$array);
		return $this->db->insert_id();
	}

public function update_aggregation($array,$last_id){
		$this->db->where("aggregation_id",$last_id);
		$this->db->update("td_content_aggregation",$array);
	}


public function insert_author_aggregation($array){
		$this->db->insert("td_aggregation_author",$array);
		return $this->db->insert_id();
	}
}