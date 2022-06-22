<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    function getUserDetails($postData){
        
        $response = array();
        
        if(isset($postData['username']) ){
            
            // Select record
            $this->db->select('*');
            $this->db->where('username', $postData['username']);
            $q = $this->db->get('users3');
            $response = $q->result_array();
        
		}
        
        return $response;
    }

}