<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Secure extends CI_Controller
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

    //登录页面
    public function index(){
        $this->load->view('login');
    }

    //登录
    public function do_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $pwd = md5($password);
        $user = $this->admin_model->get_user($username,$pwd);
        if ($user) {
            $this->session->set_userdata('user', $user);
            echo json_encode(array('code' => 1, 'message' => 'Welcome!'));
        } else {
            echo json_encode(array('code' => 0, 'message' => 'Incorrect admin name or password！'));
        }
    }


    //主页面
    public function home(){
        $this->load->view('index');
    }


    //注销登录
    public function logout(){
        $this->session->unset_userdata('user');
        echo "<script>window.location='./index'</script>";
    }

}