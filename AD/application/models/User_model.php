<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    //显示用户
    public function user_select_all($limit, $offset){
        $query = $this->db->get(TBL_USER, $limit, $offset);
        return $query->result_array();
    }

    public function get_user_all(){
        $sql = 'select count(*) as total from lib_user';
        $query  = $this->db->query($sql);
        return $query->row_array();
    }

    //删除用户
    public function delete_users($data){
        return $this->db->delete(TBL_USER,$data);
    }

    public function get($id) {
        $query = $this->db->get_where(TBL_USER,array('user_id' => $id));
        return $query->row_array();
    }
}