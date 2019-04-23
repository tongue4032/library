<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller
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


    //管理员信息
    public function admin_info(){
        $this->load->view('admin_info');
    }

    //修改管理员信息
    public function modifyAdmin(){
        $user = $this->session->userdata('user');
        $this->load->view('modifyAdmin',$user);
    }

    //执行修改
    public function do_modify(){
        $this->form_validation->set_rules('admin_name','Admin_name','max_length[6]|alpha_numeric');
        $this->form_validation->set_rules('admin_pwd','Admin_Password','min_length[6]|max_length[10]','alpha_dash');
        if($this->form_validation->run() == false){
            echo validation_errors();
        }else{
            $admin_id = $this->input->post('admin_id');
            $admin_name = $this->input->post('admin_name',true);
            $pwd = $this->input->post('admin_pwd',true);
            $admin_pwd = md5($pwd);
            $professional = $this->input->post('professional');
            $data = array(
                'admin_name' => $admin_name,
                'admin_pwd' => $admin_pwd,
                'professional' => $professional,
            );
            $row = $this->admin_model->modifyAdmin($data,$admin_id);
            if($row) {
                echo json_encode(array('code' => 1, 'message' => 'Modify successfull! Please Login again!'));
            }else{
                echo json_encode(array('code' => 0, 'message' => 'Modify failure!'));
            }
        }
    }

}