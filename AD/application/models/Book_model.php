<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    //显示图书
    public function book_select_all($limit, $offset){
        $query = $this->db->get(TBL_BOOKINFO, $limit, $offset);
        return $query->result_array();
    }

    public function get_all(){
        $sql = 'select count(*) as total from lib_bookinfo';
        $query  = $this->db->query($sql);
        return $query->row_array();
    }

    //查询修改图书
    public function get($id){
        $query = $this->db->get_where(TBL_BOOKINFO, array('id' => $id));
        return $query->row_array();
    }

    //添加图书
    public function add_book($data){
        return $this->db->insert(TBL_BOOKINFO,$data);
    }

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
        return $this->db->update(TBL_BOOKINFO,$data);
    }

    //删除图书
    public function delete_books($data){
        return $this->db->delete(TBL_BOOKINFO,$data);
    }
}