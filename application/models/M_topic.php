<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_topic extends CI_Model {
	public function __construct()
	 {
	  		 parent::__construct();
	  		 $this->load->database();
	 }
public function insertTopic($array){
		$this->db->trans_begin();
		$this->db->insert("topic",$array);
		if ($this->db->trans_status() === FALSE):
        $this->db->trans_rollback();
        return FALSE;
		else:
        $this->db->trans_commit();
        return TRUE;
		endif;
	}

    public function updateTopic($userData,$id){
        $this->db->trans_begin();
        $this->db->where('id',$id);
        $this->db->update('topic',$userData);
        if ($this->db->trans_status() === FALSE):
        $this->db->trans_rollback();
        return FALSE;
        else:
        $this->db->trans_commit();
        return TRUE;
        endif;
    }

 public function delete($id){
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->delete('topic');
        if ($this->db->trans_status() === FALSE):
        $this->db->trans_rollback();
        return FALSE;
        else:
        $this->db->trans_commit();
        return TRUE;
        endif;
    }

public function getTopic($topicName,$start,$limit){
      	$this->db->select('id,topic_name,date_created,date_updated');
    	$this->db->from('topic');
    	$this->db->like('topic_name', $topicName);
        $this->db->order_by('id','DESC');
    	$this->db->limit($limit,$start);
    	return $this->db->get()->result_array();
    }	

public function getCountTopic($topicName){
    	$this->db->select('id');
    	$this->db->from('topic');
    	$this->db->like('topic_name', $topicName);
    	return $this->db->get()->num_rows();
    }

    public function getDetailTopic($id=""){
    if(!empty($id)){
        $this->db->select('id,topic_name');
        $this->db->from('topic');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
        }else{
        $this->db->select('id,topic_name');
        $this->db->from('topic');
        return $this->db->get()->result_array();
        }        


        
    }
}