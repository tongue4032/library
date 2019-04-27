<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Secure_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    //登录
    public function get_user($username,$pwd){
        $condition['admin_name'] = $username;
        $condition['admin_pwd'] = $pwd;
        $query = $this->db->where($condition)->get(TBL_ADMIN);
        return $query->row_array();
    }


}