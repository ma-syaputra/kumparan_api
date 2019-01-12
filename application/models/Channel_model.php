<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_channel($channel_id){
		$query = $this->db->query("SELECT  channel_id,channel_name FROM td_channel WHERE channel_id=$channel_id");
		return $query->result_array();
	}

	public function checkparent($channel_id){
		$query = $this->db->query("SELECT parent_id,channel_name FROM td_channel WHERE channel_id=$channel_id");
		return $query->row_array();

	}
	public function getfamilychannel($channel_id){
		$getValid = $this->checkparent($channel_id);
		if($getValid['parent_id']==0){
			$sql = "SELECT channel_id,
			channel_name 
			FROM 
			td_channel 
			WHERE 1=1
			AND 
			parent_id = ( SELECT parent_id FROM td_channel WHERE parent_id = ".$channel_id."  
			GROUP BY parent_id )
			OR channel_id=(SELECT channel_id FROM td_channel WHERE channel_id=".$channel_id." )
			";
		}else{
			$sql 	= "SELECT channel_id,
			channel_name FROM 
			td_channel 
			WHERE channel_id=".$channel_id." 
			OR parent_id=(SELECT parent_id FROM td_channel WHERE channel_id=".$channel_id." )
			OR channel_id=(SELECT parent_id FROM td_channel WHERE channel_id=".$channel_id." )";
		}
		$query 	= $this->db->query($sql);
		return $query->result_array();
		
		
	}

}