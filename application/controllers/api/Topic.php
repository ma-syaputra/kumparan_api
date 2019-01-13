<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Topic extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('curl');
		$this->load->database();		
		$this->load->model('m_topic','topic');   
	}
	public function insert_post(){
 		$dataTopic = array();
        $dataTopic['topic_name'] 			= trim($this->post('topic_name'));
        $dataTopic['date_created']          = date('Y-m-d H:i:s');
        if(!empty($dataTopic['topic_name'])){
        	$last_id 	= $this->topic->insertTopic($dataTopic);
            if($last_id){
                $this->response([
                    'status' => TRUE,
                    'message' => 'Topic has been added successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
        }        
	}

	public function list_post($start=NULL,$limit=NULL) {
		$newsName 	= trim($this->post('topic_name'));
        $topicName  = trim($this->post('topic_name'));
		$countTopic = $this->topic->getCountTopic($topicName);
        $topic = $this->topic->getTopic($topicName,$start,$limit);
        $dataTopic = array ('rowTopic'=>$countTopic,
    						'contentTopic'=>$topic);
        if(!empty($dataTopic)):
            $this->response($dataTopic,	 REST_Controller::HTTP_OK);
        else:
            $this->response([
                'status' => FALSE,
                'message' => 'No Topic'
            ], REST_Controller::HTTP_NOT_FOUND);
        endif;
    }

    public function update_put() {
        $userData = array();
        $id = $this->put('id');
        $userData['topic_name'] = trim($this->put('topic_name'));   
        if(!empty($id) && !empty($userData['topic_name'])):
        $update = $this->topic->updateTopic($userData, $id);
         if($update):
              $this->response([
                    'status' => TRUE,
                    'message' => 'Topic has been updated successfully.'
                ], REST_Controller::HTTP_OK);
        else:
            $this->response([
                'status' => FALSE,
                'message' => 'No Topic'
            ], REST_Controller::HTTP_NOT_FOUND);
        endif;
    endif;
    }

public function detail_get($id = 0) {
        $topic = $this->topic->getDetailTopic($id);
        if(!empty($topic)):
            $this->response($topic,	 REST_Controller::HTTP_OK);
        else:
            $this->response([
                'status' => FALSE,
                'message' => 'Topic Not Found'
            ], REST_Controller::HTTP_NOT_FOUND);
        endif;
    }    

     public function item_delete($id=null){
        if($id){
            $delete = $this->topic->delete($id);
            if($delete){
                $this->response([
                    'status' => TRUE,
                    'message' => 'Topic has been removed successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Topic Not Found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }  
            

     
}