<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class User_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('admin_model');
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
        $pageall = $this->admin_model->get_user_all();
        $config['base_url'] = '/Admin/show_users/page/';
        $config['total_rows'] = $pageall['total'];
        $config['per_page'] = $page_size;
        $config['use_page_numbers'] = true;//URL中的数字显示第几页，否则，显示到达第几条
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $data['users'] = $this->admin_model->user_select_all($page_size,$offset);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        // $data['users'] = $this->admin_model->show_user();
        $this->load->view('show_users',$data);
    }

    //删除用户
    public function delete_user(){
        $user_id = $this->input->get('user_id',Null);
        $username = $this->input->get('username',Null);
        $telephone = $this->input->get('telephone',Null);
        $email = $this->input->get('email',Null);
        $register_date = $this->input->get('register_date',Null);
        $data = array(
            'user_id' => $user_id,
            'username' => $username,
            'telephone' => $telephone,
            'email' => $email,
            'register_date' => $register_date
        );
        if($this->admin_model->delete_users($data)){
            // var_dump('hello');
            echo "<script>window.location='/Admin/show_users'</script>";
        }else{
            echo "<script>window.location='/Admin/show_users'</script>";
        }
    }
}