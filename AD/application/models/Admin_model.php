<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

    public function get($id){
        $query = $this->db->get_where(TBL_ADMIN, array('admin_id' => $id));
        return $query->row_array();
    }

	//修改管理员
	public function change_admin($data,$admin_id){
		$data = array(
			'admin_name' => $data['admin_name']
		);
		$this->db->where("admin_id='".$admin_id."'");
		return $this->db->update(TBL_ADMIN,$data);
	}

	//删除管理员
	public function delete_admins($data){
		return $this->db->delete(TBL_ADMIN,$data);
	}

	//添加管理员
	public function add_admin($data){
		return $this->db->insert(TBL_ADMIN,$data);
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

    //获取管理员角色
    public function get_type(){
        $query = $this->db->get_where(TBL_TYPE);
        return $query->result_array();
    }
}





