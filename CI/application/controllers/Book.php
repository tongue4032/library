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
            echo "<script>alert('You did not log in!!');window.location='/Secure/username_login'</script>";
//            echo json_encode(array('code' => 1, 'message' => '你没登录'));
        }else{
            $username = $user['username'];
            $user_id = $user['user_id'];
            $barcode = $this->input->get('barcode',Null);
            $bookname = $this->input->get('bookname',Null);
            $author = $this->input->get('author',Null);
            $time = date('Y-m-d');
            $data = array(
                'barcode' => $barcode,
                'bookname' => $bookname,
                'author' => $author,
                'user_id' => $user_id,
                'username' => $username,
                'borrow_time' => $time
            );
            if(!empty($this->Book_model->get($barcode,$user_id))){
                echo "<script>alert('This book has been borrowed, please choose again!');window.location='/Secure'</script>";
//				echo json_encode(array('code' => 0, 'message' => 'This book has been borrowed, please choose again!'));
            }else{
                if($this->Book_model->borrow($data)){
                    echo "<script>alert('Borrowing successful!');window.location='/Book/info'</script>";
//					echo json_encode(array('code' => 1, 'message' => 'Borrowing successful!'));
                }
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