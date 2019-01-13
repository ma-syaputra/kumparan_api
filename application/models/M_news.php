<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_news extends CI_Model {
	public function __construct()
	 {
	  		 parent::__construct();
	  		 $this->load->database();
	 }
public function insertNews($array){

		$this->db->insert("news",$array);
		$insert_id = $this->db->insert_id();
		return  $insert_id; 
	}
	public function insertMapNews($array){
 		$this->db->trans_begin();
        $this->db->insert_batch("map_news",$array);
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
public function updateNewsStatus($userData,$id){
        $this->db->trans_begin();
        $this->db->where('id',$id);
        $this->db->update('news',$userData);
        if ($this->db->trans_status() === FALSE):
        $this->db->trans_rollback();
        return FALSE;
        else:
        $this->db->trans_commit();
        return TRUE;
        endif;
    }    
    public function updateNews($userData,$id){
        $this->db->trans_begin();
        $this->db->where('id',$id);
        $this->db->update('news',$userData);
        if ($this->db->trans_status() === FALSE):
        $this->db->trans_rollback();
        return FALSE;
        else:
        $this->db->trans_commit();
        return TRUE;
        endif;
    }  

 public function deleteMaps($id){
        $this->db->trans_begin();
        $this->db->where('id_news', $id);
        $this->db->delete('map_news');
        if ($this->db->trans_status() === FALSE):
        $this->db->trans_rollback();
        return FALSE;
        else:
        $this->db->trans_commit();
        return TRUE;
        endif;
    }

public function getNews($newsName,$statusNewsName,$start,$limit){
      	$this->db->select('id,title,date_created,date_updated,status');
    	$this->db->from('news');
    	$this->db->like('title', $newsName);
		if($statusNewsName!=''):
    		$this->db->where('status', $statusNewsName);
    	endif;    	
        $this->db->order_by('id','DESC');
    	$this->db->limit($limit,$start);
    	return $this->db->get()->result_array();
    }	

public function getCountNews($newsName,$statusNewsName){
    	$this->db->select('id');
    	$this->db->from('news');
    	$this->db->like('title', $newsName);
    	if($statusNewsName!=''):
    		$this->db->where('status', $statusNewsName);
    	endif;
    	return $this->db->get()->num_rows();
    }

    public function getDetailNews($id){
        $this->db->select('title,summary,content,status,date_published');
        $this->db->from('news');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

   public function getDetailTag($id){
        $this->db->select('map_news.id_topic,topic.topic_name');
        $this->db->from('map_news');
       	$this->db->join('topic', 'map_news.id_topic = topic.id');
        $this->db->where('map_news.id_news', $id);
        return $this->db->get()->result_array();
    }    
}