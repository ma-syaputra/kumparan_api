<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        //load database library
        $this->load->database();
    }

    /*
     * Fetch user data
     */
    function getRows($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }
    
    function get_auth($username,$password){
    $query = $this->db->get_where(  'td_user', array(
                                    'user_name'         => $username,
                                    'user_password'     => $password));
    if($query->num_rows() == 1):
       return $query->row_array();
    else:
        return FALSE;
    endif;
    }

    public function getauth_menu($id){
            $sql        = "SELECT 
            c.channel_name as parent,
            c.channel_name,c.channel_id,
            c.parent_id FROM `td_user` as u 
            LEFT JOIN tr_group_permission as gp ON u.group_id=gp.group_id 
            LEFT JOIN td_channel as c ON gp.channel_id=c.channel_id WHERE u.user_id=".$id." 
            AND 
            c.active_status=1 ORDER BY c.channel_id ASC";
            $query      = $this->db->query($sql);
            return $query->result_array();
        } 


    public function get_user_info($id){
            $sql        = "SELECT U.user_name,
            U.fullname, 
            U.user_id, 
            U.email, 
            U.picture, 
            A.author_id, 
            A.author_code, 
            A.author_name,
            A.author_type_id, 
            I.institution_name, 
            T.author_type,
            U.group_id,
            U.picture FROM `td_user` as U 
            LEFT JOIN td_author as A ON U.author_id=A.author_id 
            LEFT JOIN td_institution as I ON A.institution_id=I.institution_id
            LEFT JOIN td_author_type as T ON A.author_type_id = T.author_type_id 
            WHERE 
            U.user_id=".$id;
            $query      = $this->db->query($sql);
            return $query->result_array();
        }          



    public function insert($data = array()) {
        if(!array_key_exists('created', $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists('modified', $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        $insert = $this->db->insert('users', $data);
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
    
    /*
     * Update user data
     */
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            if(!array_key_exists('modified', $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            $update = $this->db->update('users', $data, array('id'=>$id));
            return $update?true:false;
        }else{
            return false;
        }
    }
    
    /*
     * Delete user data
     */
    public function delete($id){
        $delete = $this->db->delete('users',array('id'=>$id));
        return $delete?true:false;
    }

}
?>