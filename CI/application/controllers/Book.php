<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Book_model');
        $this->load->library('form_validation');

    }


    public function query(){
        $this->load->view('Book_views/query');
    }

    //搜索图书
    public function search(){
        $type = $this->input->get_post('type');
        $info = $this->input->get_post('info');
        $data = array(
            'type' => $type,
            'info' => $info
        );
        $data['books'] = $this->Book_model->search_book($data);
        if($data['books']){
            $this->load->view('Book_views/query',$data);
        }else{
            $this->load->view('Book_views/query_fail');
        }
    }


    //借阅
    public function borrow(){
        $user = $this->session->userdata('user');
        if(empty($user)){
            echo json_encode(array('code' => 0, 'message' => 'You did not log in!!'));
        }else{
            $username = $user['username'];
            $user_id = $user['user_id'];
            $id = (int) $this->input->get_post('id');
            $barcode = (int) $this->input->get_post('barcode');
            $time = date('Y-m-d');
            $book = $this->Book_model->borrow_book($id);
            $data = array(
                'username' => $username,
                'user_id' => $user_id,
                'time' => $time
            );
            if(!empty($this->Book_model->get($barcode,$user_id))){
				echo json_encode(array('code' => 1, 'message' => 'This book has been borrowed, please choose again!'));
            }else{
                $this->Book_model->borrow($book,$data);
                echo json_encode(array('code' => 2, 'message' => 'Borrowing successful!'));
            }

        }
    }

    //归还
    public function give_back(){
        $id = (int) $this->input->get_post('id');
        $back = $this->Book_model->give_back($id);
        if($back) {
            echo json_encode(array('code' => 1, 'message' => 'Give back successfull!!'));
        } else {
            echo json_encode(array('code' => 0, 'message' => 'Give back failure!!'));
        }
    }


    //信息
    public function info(){
        $user = $this->session->userdata('user');
        $condition = array(
            'user_id' => $user['user_id']
        );
        $data['books'] = $this->Book_model->show_info($condition);
        $this->load->view('Book_views/info',$data);
    }

}