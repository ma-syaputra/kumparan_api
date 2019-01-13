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
        $dataTopic['title'] 			= trim($this->post('title'));
        $dataTopic['summary'] 			= trim($this->post('summary'));
        $dataTopic['content'] 			= trim($this->post('content'));
        $dataTopic['date_created']      = date('Y-m-d H:i:s');
        $dataTopic['status']     		= trim($this->post('status'));
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
		$newsName 	= trim($this->post('news_name'));
		$statusNewsName = trim($this->post('status_name'));
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
    public function status_put($status) {
        $userData = array();
        $id = $this->put('id');
        if($status=='publish'):
        $userData['date_published'] = date('Y-m-d H:i:s');
    	elseif($status=='delete'):
    		 $userData['date_deleted'] = date('Y-m-d H:i:s');
    	endif;
    	$userData['status'] = $status;
        if(!empty($id) && !empty($userData['status'])):
        $update = $this->news->updateNewsStatus($userData, $id);
         if($update):
              $this->response([
                    'status' => TRUE,
                    'message' => 'Article has been'.' '.$status.' '.'successfully.'
                ], REST_Controller::HTTP_OK);
        else:
            $this->response([
                'status' => FALSE,
                'message' => 'No Topic'
            ], REST_Controller::HTTP_NOT_FOUND);
        endif;
    endif;
    }

   public function article_put() {
   		$userData = array();	
   		$id = $this->put('id');
        $userData['title'] 				= trim($this->put('title'));
        $userData['summary'] 			= trim($this->put('summary'));
        $userData['content'] 			= trim($this->put('content'));
        $userData['status']     		= trim($this->put('status'));   	
        if($userData['status'] =='publish'):
        $userData['date_published'] = date('Y-m-d H:i:s');
    	endif;
        if(!empty($id) && !empty($userData['status'])):
        $update = $this->news->updateNews($userData, $id);
    	if($update!=FALSE):
    	$delete =  $this->news->deleteMaps($id);
    	if($delete!=FALSE):
		foreach($this->put('topic') as $item =>$value){
			$id_news[] = array(  'id_news'=>$id,
        						'id_topic'=>$value);	
        	}
        $map = $this->news->insertMapNews($id_news);    		
    	endif;
    	endif;
         if($map):
              $this->response([

                    'status' => TRUE,
                    'message' => 'Article has been'.' '.$userData['status'].' '.'successfully.'
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