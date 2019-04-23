<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Permissions extends CI_Controller
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

    //分配角色
    public function role_users(){
        $page_size = 7;
        $page = $this->uri->segment(4);
        if($page == Null){
            $page = 1;
        }
        $offset = ($page - 1) * $page_size;
        $pageall = $this->admin_model->get_user_all();
        $config['base_url'] = '/Admin/role_users/page/';
        $config['total_rows'] = $pageall['total'];
        $config['per_page'] = $page_size;
        $config['use_page_numbers'] = true;//URL中的数字显示第几页，否则，显示到达第几条
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $data['users'] = $this->admin_model->user_select_all($page_size,$offset);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        // $data['users'] = $this->admin_model->show_user();
        $this->load->view('role_users',$data);
    }

    public function role_admins(){
        $page_size = 5;
        $page = $this->uri->segment(4);
        if($page == Null){
            $page = 1;
        }
        $offset = ($page - 1) * $page_size;
        $pageall = $this->admin_model->get_admin_all();
        $config['base_url'] = '/Admin/role_admins/page/';
        $config['total_rows'] = $pageall['total'];
        $config['per_page'] = $page_size;
        $config['use_page_numbers'] = true;//URL中的数字显示第几页，否则，显示到达第几条
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $data['admins'] = $this->admin_model->admin_select_all($page_size,$offset);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        // $data['admins'] = $this->admin_model->show_admin();
        $this->load->view('role_admins',$data);
    }

    //修改用户角色
    public function role(){
        $user = $this->session->userdata('user');
        if($user['professional'] == 'Administrator'){
            echo "<script>alert('You do not have permission to do this!');window.location='/Admin/role_users'</script>";
        }else{
            $user_id = $this->input->get('user_id',Null);
            $username = $this->input->get('username',Null);
            $data = array(
                'user_id' => $user_id,
                'username' => $username
            );
            $data['type'] = $this->admin_model->get_userType();
            $this->load->view('role',$data);
        }
    }

    //执行修改
    public function change_user_role(){
        $this->form_validation->set_rules('professional','Professional','alpha');
        if($this->form_validation->run() == false){
            echo validation_errors();
        }else {
            $user_id = $this->input->post('user_id');
            $username = $this->input->post('username');
            $professional = $this->input->post('professional');
            $data = array(
                'username' => $username,
                'professional' => $professional
            );
            $user_role = $this->admin_model->change_user_role($data, $user_id);
            if($user_role) {
                echo json_encode(array('code' => 1, 'message' => 'Modify successfull!'));
            }else {
                echo json_encode(array('code' => 0, 'message' => 'Modify failuer!'));
            }
        }
    }

    //修改管理员角色
    public function roles(){
        $user = $this->session->userdata('user');
        if($user['professional'] == 'Administrator'){
            echo "<script>alert('You do not have permission to do this!');window.location='/Admin/role_admins'</script>";
        }else{
            $admin_id = $this->input->get('admin_id',Null);
            $admin_name = $this->input->get('admin_name',Null);
            $data = array(
                'admin_id' => $admin_id,
                'admin_name' => $admin_name
            );
            $data['type'] = $this->admin_model->get_type();
            $this->load->view('roles',$data);
        }
    }

    //执行修改
    public function change_admin_role(){
        $this->form_validation->set_rules('professional','Professional','trim|alpha_numeric_spaces');
        if($this->form_validation->run() == false){
            echo validation_errors();
        }else{
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name');
            $professional = $this->input->post('professional',true);
            $data = array(
                'admin_name' => $admin_name,
                'professional' => $professional
            );
            $admin_role = $this->admin_model->change_admin_role($data,$admin_id);
            if($admin_role) {
                echo json_encode(array('code' => 1, 'message' => 'Modify successfull!'));
            }else{
                echo json_encode(array('code' => 0, 'message' => 'Modify failure!'));
            }
        }
    }

}