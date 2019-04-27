<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    //修改管理员名字
    public function modifyAdmin($data,$admin_id){
        $data = array(
            'admin_name' => $data['admin_name'],
            'admin_pwd' => $data['admin_pwd']
        );
        $this->db->where("admin_id='".$admin_id."'");
        return $this->db->update(TBL_ADMIN,$data);
    }
}