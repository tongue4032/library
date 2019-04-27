<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('User_model');
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }


    //显示用户
    public function show_users(){
        $page_size = 8;
        $page = $this->uri->segment(4);
        if($page == Null){
            $page = 1;
        }
        $offset = ($page - 1) * $page_size;
        $pageall = $this->User_model->get_user_all();
        $config['base_url'] = '/User/show_users/page/';
        $config['total_rows'] = $pageall['total'];
        $config['per_page'] = $page_size;
        $config['use_page_numbers'] = true;//URL中的数字显示第几页，否则，显示到达第几条
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $data['users'] = $this->User_model->user_select_all($page_size,$offset);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        // $data['users'] = $this->admin_model->show_user();
        $this->load->view('Users/show_users',$data);
    }

    //删除用户
    public function delete_user(){
        $id = (int) $this->input->get_post('id');
        $user = $this->User_model->get($id);
        $data = array(
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'telephone' => $user['telephone'],
            'email' => $user['email'],
            'register_date' => $user['register_date']
        );
        if($this->User_model->delete_users($data)){
            echo json_encode(array('code' => 1, 'message' => 'Delete successfull!!'));
        }
    }
}