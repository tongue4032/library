<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Admin_model');
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

    //显示管理员
    public function show_admins(){
        $page_size = 8;
        $page = $this->uri->segment(4);
        if($page == Null){
            $page = 1;
        }
        $offset = ($page - 1) * $page_size;
        $pageall = $this->Admin_model->get_admin_all();
        $config['base_url'] = '/Admin/show_admins/page/';
        $config['total_rows'] = $pageall['total'];
        $config['per_page'] = $page_size;
        $config['use_page_numbers'] = true;//URL中的数字显示第几页，否则，显示到达第几条
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $data['admins'] = $this->Admin_model->admin_select_all($page_size,$offset);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        $this->load->view('Admins/show_admins',$data);
    }
    //修改管理员
    public function change_admin(){
        $user = $this->session->userdata('user');
        if($user['professional'] == 'Administrator'){
            echo json_encode(array('code' => 0, 'message' => 'You do not have permission to do this!!'));
        }else{
            $id = (int) $this->input->get_post('id');
            $admin = $this->Admin_model->get($id);
            $data = array(
                'admin_id' => $admin['admin_id'],
                'admin_name' => $admin['admin_name'],
                'professional' => $admin['professional']
            );
            $this->session->set_userdata('admin',$data);
            echo json_encode(array('code' => 1));
        }
    }

    public function changes() {
        $this->load->view('Admins/change_admin');
    }

    //执行修改
    public function change_admins(){
        $this->form_validation->set_rules('admin_name','Admin_name','max_length[8]');

        if($this->form_validation->run() == false){
            echo validation_errors();
        }else{
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name',true);
            $data = array(
                'admin_name' => $admin_name,
            );
            $admin = $this->Admin_model->change_admin($data,$admin_id);
            if($admin) {
                echo json_encode(array('code' => 1, 'message' => 'Modify successfull!'));
            }else{
                echo json_encode(array('code' => 0, 'message' => 'Modify failure!'));
            }
        }
    }

    //删除管理员
    public function delete_admins(){
        $user = $this->session->userdata('user');
        if($user['professional'] == 'Administrator'){
            echo json_encode(array('code' => 0, 'message' => 'You do not have permission to do this!!'));
        }else{
            $id = (int) $this->input->get_post('id');
            $admin = $this->Admin_model->get($id);
            $data = array(
                'admin_id' => $admin['admin_id'],
                'admin_name' => $admin['admin_name'],
                'admin_pwd' => $admin['admin_pwd'],
                'professional' => $admin['professional'],
                'last_login_date' => $admin['last_login_date']
            );
            if($this->Admin_model->delete_admins($data)){
                echo json_encode(array('code' => 1, 'message' => 'Delete successfull!!'));
            }else{
                echo json_encode(array('code' => 2, 'message' => 'Detele failure!!Please again delete.'));
            }
        }
    }

    //添加管理员
    public function add_admin(){
        $data['type'] = $this->Admin_model->get_type();
        $this->load->view('Admins/add_admins',$data);
    }

    //执行添加
    public function add_admins(){
        $this->form_validation->set_rules('admin_name','Admin_name','max_length[8]');
        $this->form_validation->set_rules('admin_pwd','Admin_Password','min_length[6]|max_length[10]','alpha_dash');

        if($this->form_validation->run() == false){
            echo validation_errors();
        }else{
            $user = $this->session->userdata('user');
            if($user['professional'] == 'Administrator'){
                echo json_encode(array('code' => 0, 'message' => 'You do not have premission to do this!!'));
            }else {
                $admin_name = $this->input->post('admin_name', true);
                $admin_pwd = $this->input->post('admin_pwd', true);
                $ad_pwd = md5($admin_pwd);
                $professional = $this->input->post('professional');
                $data = array(
                    'admin_name' => $admin_name,
                    'admin_pwd' => $ad_pwd,
                    'professional' => $professional
                );
                $add = $this->Admin_model->add_admin($data);
                if ($add) {
                    echo json_encode(array('code' => 1, 'message' => 'Add successfull!'));
                } else {
                    echo json_encode(array('code' => 2, 'message' => 'Add failure!'));
                }
            }
        }
    }


}