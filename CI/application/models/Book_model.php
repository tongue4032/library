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
        $query = $this->db->get_where(TBL_BOOK_ACTION,array('barcode' => $barcode,'user_id' => $user_id));
        return $query->row_array();
    }

    public function borrow($data){
        return $this->db->insert(TBL_BOOK_ACTION,$data);
    }

    public function show_info($data){
        $query = $this->db->get_where(TBL_BOOK_ACTION,$data);
        return $query->result_array();
    }

    public function give_back($data){
        return $this->db->delete(TBL_BOOK_ACTION, $data);
    }
}