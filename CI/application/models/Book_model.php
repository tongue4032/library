<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function search_book($data){
        $type = $data['type'];
        $info = $data['info'];
        if($type == 'Bookname') {
            $conditon['bookname'] = $info;
            $query = $this->db->where($conditon)->get(TBL_BOOKINFO);
            return $query->result_array();
        }
        if($type == 'Author'){
            $conditon['author'] = $info;
            $query = $this->db->where($conditon)->get(TBL_BOOKINFO);
            return $query->result_array();
        }
    }

    public function get($barcode,$user_id){
        $query = $this->db->get_where(TBL_BORROW,array('barcode' => $barcode,'user_id' => $user_id));
        return $query->row_array();
    }

    public  function borrow_book($id){
        $query = $this->db->get_where(TBL_BOOKINFO,array('id' => $id));
        return $query->row_array();
    }

    public function borrow($book,$data){
        $data = array(
            'barcode' => $book['barcode'],
            'bookname' => $book['bookname'],
            'author' => $book['author'],
            'user_id' => $data['user_id'],
            'username' => $data['username'],
            'borrow_time' => $data['time']
        );
        return $this->db->insert(TBL_BORROW,$data);
    }

    public function show_info($data){
        $query = $this->db->get_where(TBL_BORROW,$data);
        return $query->result_array();
    }

    public function give_back($id){
        return $this->db->delete(TBL_BORROW,array('id' => $id));
    }
}