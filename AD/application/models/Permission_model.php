<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Permission_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    //获取管理员角色
    public function get_type(){
        $query = $this->db->get_where(TBL_TYPE);
        return $query->result_array();
    }

    //获取用户角色
    public function get_userType(){
        $query = $this->db->get_where(TBL_USERTYPE);
        return $query->result_array();
    }

    //修改用户角色
    public function change_user_role($data,$user_id){
        $data = array(
            'professional' => $data['professional']
        );
        $this->db->where("user_id='".$user_id."'");
        return $this->db->update(TBL_USER,$data);
    }

    //修改管理员角色
    public function change_admin_role($data,$admin_id){
        $data = array(
            'professional' => $data['professional']
        );
        $this->db->where("admin_id='".$admin_id."'");
        return $this->db->update(TBL_ADMIN,$data);
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

    //显示管理员
    public function admin_select_all($limit, $offset){
        $query = $this->db->get(TBL_ADMIN, $limit, $offset);
        return $query->result_array();
    }

    public function get_admin_all(){
        $sql = 'select count(*) as total from lib_admin';
        $query  = $this->db->query($sql);
        return $query->row_array();
    }
}