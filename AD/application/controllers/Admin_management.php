<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_management extends CI_Controller
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

    //显示管理员
    public function show_admins(){
        $page_size = 8;
        $page = $this->uri->segment(4);
        if($page == Null){
            $page = 1;
        }
        $offset = ($page - 1) * $page_size;
        $pageall = $this->admin_model->get_admin_all();
        $config['base_url'] = '/Admin/show_admins/page/';
        $config['total_rows'] = $pageall['total'];
        $config['per_page'] = $page_size;
        $config['use_page_numbers'] = true;//URL中的数字显示第几页，否则，显示到达第几条
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $data['admins'] = $this->admin_model->admin_select_all($page_size,$offset);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        // $data['admins'] = $this->admin_model->show_admin();
        $this->load->view('show_admins',$data);
    }
    //修改管理员
    public function change_admin(){
        $user = $this->session->userdata('user');
        if($user['professional'] == 'Administrator'){
            echo "<script>alert('You do not have permission to do this!');window.location='/Admin/show_admins'</script>";
        }else{
            $admin_id = $this->input->get('admin_id',Null);
            $admin_name = $this->input->get('admin_name',Null);
            $professional = $this->input->get('professional',Null);
            $data = array(
                'admin_id' => $admin_id,
                'admin_name' => $admin_name,
                'professional' => $professional
            );
            $this->load->view('change_admin',$data);
        }
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
            $admin = $this->admin_model->change_admin($data,$admin_id);
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
            echo "<script>alert('You do not have permission to do this!');window.location='/Admin/show_admins'</script>";
        }else{
            $admin_id = $this->input->get('admin_id',Null);
            $admin_name = $this->input->get('admin_name',Null);
            $professional = $this->input->get('professional',Null);
            $last_login_date = $this->input->get('last_login_date',Null);
            $data = array(
                'admin_id' => $admin_id,
                'admin_name' => $admin_name,
                'professional' => $professional,
                'last_login_date' => $last_login_date
            );
            if($this->admin_model->delete_admins($data)){
                // var_dump('hello');
                echo "<script>window.location='/Admin/show_admins'</script>";
            }else{
                echo "<script>window.location='/Admin/show_admins'</script>";
            }
        }
    }

    //添加管理员
    public function add_admin(){
        $user = $this->session->userdata('user');
        if($user['professional'] == 'Administrator'){
            echo "<script>alert('You do not have permission to do this!');window.location='/Admin/show_admins'</script>";
        }else{
            $data['type'] = $this->admin_model->get_type();
            $this->load->view('add_admins',$data);
        }
    }

    //执行添加
    public function add_admins(){
        $this->form_validation->set_rules('admin_name','Admin_name','max_length[8]');
        $this->form_validation->set_rules('admin_pwd','Admin_Password','min_length[6]|max_length[10]','alpha_dash');

        if($this->form_validation->run() == false){
            echo validation_errors();
        }else{
            $admin_name = $this->input->post('admin_name',true);
            $admin_pwd = $this->input->post('admin_pwd',true);
            $ad_pwd = md5($admin_pwd);
            $professional = $this->input->post('professional');
            $data = array(
                'admin_name' => $admin_name,
                'admin_pwd' => $ad_pwd,
                'professional' => $professional
            );
            $add = $this->admin_model->add_admin($data);
            if($add) {
                echo json_encode(array('code' => 1, 'message' => 'Add successfull!'));
            }else{
                echo json_encode(array('code' => 0, 'message' => 'Add failure!'));
            }
        }
    }


}