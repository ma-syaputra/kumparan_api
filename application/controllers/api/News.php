<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class News extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('curl');
		$this->load->database();		
		$this->load->model('m_news','news');   
	}
	public function insert_post(){
 		$dataTopic = array();
        $dataTopic['title'] 			= rtrim(ltrim($this->post('title')));
        $dataTopic['summary'] 			= rtrim(ltrim($this->post('summary')));
        $dataTopic['content'] 			= rtrim(ltrim($this->post('content')));
        $dataTopic['date_created']      = date('Y-m-d H:i:s');
        $dataTopic['status']     		= rtrim(ltrim($this->post('status')));
        if(!empty($dataTopic['title'])){
        	$last_id 	= $this->news->insertNews($dataTopic);
        	foreach($_POST['topic'] as $item =>$value){
			$id_news[] = array(  'id_news'=>$last_id,
        						'id_topic'=>$value);	
        	}
        	$map = $this->news->insertMapNews($id_news);
            if($map){
                 $this->response([
                    'status' => TRUE,
                    'message' => 'Topic has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $this->response("Provide complete user information to create.", REST_Controller::HTTP_BAD_REQUEST);
        }        
	}

	public function list_post($start=NULL,$limit=NULL) {
		$newsName 	= rtrim(ltrim($this->post('news_name')));
		$statusNewsName = rtrim(ltrim($this->post('status_name')));
		$countNews = $this->news->getCountNews($newsName,$statusNewsName);
        $news = $this->news->getNews($newsName,$statusNewsName,$start,$limit);
        $dataTopic = array ('rowNews'=>$countNews,
    						'listNews'=>$news);
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
        $userData['topic_name'] = rtrim(ltrim($this->put('topic_name')));   
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

public function detail_get($id=null) {
        $news = $this->news->getDetailNews($id);
        $tag = $this->news->getDetailTag($id);
        $dataTopic = array ('news'=>$news,
    						'tags'=>$tag);        
        if(!empty($dataTopic)):
            $this->response(['status'=>TRUE,
            				'item'=>$dataTopic],	 REST_Controller::HTTP_OK);
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