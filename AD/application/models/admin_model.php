<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	const TBL_USER = 'lib_user';
	const TBL_ADMIN = 'lib_admin';
	const TBL_BOOKINFO = 'lib_bookinfo';
	const TBL_TYPE = 'lib_type';
	const TBL_USERTYPE = 'lib_userType';

	//登录
	public function get_user($username,$pwd){
		$condition['admin_name'] = $username;
		$condition['admin_pwd'] = $pwd;
		$query = $this->db->where($condition)->get(self::TBL_ADMIN);
		return $query->row_array();
	}
	//查询修改图书
	public function get($barcode){
		$query = $this->db->get_where('lib_bookinfo', array('barcode' => $barcode));
        return $query->row_array();
	}

	//添加图书
	public function add_book($data){
		return $this->db->insert(self::TBL_BOOKINFO,$data);
	}

	//获取管理员角色
	public function get_type(){
	    $query = $this->db->get_where(self::TBL_TYPE);
	    return $query->result_array();
    }

    //获取用户角色
    public function get_userType(){
	    $query = $this->db->get_where(self::TBL_USERTYPE);
	    return $query->result_array();
    }

	//显示图书
	// public function show_book(){
	// 	$query = $this->db->get_where(self::TBL_BOOKINFO);
	// 	return $query->result_array();
	// }

	//删除图书
	public function delete_books($data){
		return $this->db->delete(self::TBL_BOOKINFO,$data); 
	}

	//显示用户
	// public function show_user(){
	// 	$query = $this->db->get_where(self::TBL_USER);
	// 	return $query->result_array();
	// }

	//删除用户
	public function delete_users($data){
		return $this->db->delete(self::TBL_USER,$data);
	}

	//显示管理员
	// public function show_admin(){
	// 	$query = $this->db->get_where(self::TBL_ADMIN);
	// 	return $query->result_array();
	// }

	//修改图书
	public function change_book($data,$barcode){
		$data = array(
			'bookname' => $data['bookname'],
			'author' => $data['author'],
			'press' => $data['press'],
			'publish_date' => $data['publish_date'],
			'content' => $data['content']
		);
		$this->db->where("barcode='".$barcode."'");
		return $this->db->update('lib_bookinfo',$data);
	}

	//修改管理员
	public function change_admin($data,$admin_id){
		$data = array(
			'admin_name' => $data['admin_name']
		);
		$this->db->where("admin_id='".$admin_id."'");
		return $this->db->update('lib_admin',$data);
	}

	//删除管理员
	public function delete_admins($data){
		return $this->db->delete(self::TBL_ADMIN,$data);
	}
	
	//添加管理员
	public function add_admin($data){
		return $this->db->insert(self::TBL_ADMIN,$data);
	}

	//修改用户角色
	public function change_user_role($data,$user_id){
		$data = array(
			'professional' => $data['professional'] 
		);
		$this->db->where("user_id='".$user_id."'");
		return $this->db->update('lib_user',$data);
	}

	//修改管理员角色
	public function change_admin_role($data,$admin_id){
		$data = array(
			'professional' => $data['professional']
		);
		$this->db->where("admin_id='".$admin_id."'");
		return $this->db->update('lib_admin',$data);
	}

	//修改管理员名字
	public function modifyAdmin($data,$admin_id){
		$data = array(
			'admin_name' => $data['admin_name'],
            'admin_pwd' => $data['admin_pwd']
		);
		$this->db->where("admin_id='".$admin_id."'");
		return $this->db->update('lib_admin',$data);
	}


	//显示图书
	public function book_select_all($limit, $offset){
		$query = $this->db->get('lib_bookinfo', $limit, $offset);
		return $query->result_array();
	}

	public function get_all(){
		$sql = 'select count(*) as total from lib_bookinfo';
		$query  = $this->db->query($sql);
		return $query->row_array();
	}

	//显示用户
	public function user_select_all($limit, $offset){
		$query = $this->db->get('lib_user', $limit, $offset);
		return $query->result_array();
	}

	public function get_user_all(){
		$sql = 'select count(*) as total from lib_user';
		$query  = $this->db->query($sql);
		return $query->row_array();
	}

	//显示管理员
	public function admin_select_all($limit, $offset){
		$query = $this->db->get('lib_admin', $limit, $offset);
		return $query->result_array();
	}

	public function get_admin_all(){
		$sql = 'select count(*) as total from lib_admin';
		$query  = $this->db->query($sql);
		return $query->row_array();
	}
}





