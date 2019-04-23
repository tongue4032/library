<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Profile_model');
        $this->load->library('form_validation');

    }


    public function user_info(){
        $this->load->view('Profile_views/user_info');
    }
    public function modify(){
        $user_id = $this->input->get('user_id',Null);
        $data = array('user_id' => $user_id );
        $this->load->view('Profile_views/modify',$data);
    }


    public function modify_user_info(){
        $user_id = $this->input->post('user_id');
        $username = $this->input->post('username');
        $pwd = $this->input->post('password');
        $password = md5($pwd);
        $telephone = $this->input->post('telephone');
        $email = $this->input->post('email');
        // var_dump($email);
        $data = array(
            'username' => $username,
            'password' => $password,
            'telephone' => $telephone,
            'email' => $email
        );
        // var_dump($data);
        if($this->Profile_model->modify($data,$user_id)){
//            echo "<script>alert('Update Successful!Please login again to check.');window.location='/Home/username_login'</script>";
            echo json_encode(array('code' => 1, 'message' => 'Update Successful!Please login again to check.'));
        }else{
//            echo "<script>alert('Error,Please Check Again');window.location='/Home/user_info'</script>";
            echo json_encode(array('code' => 0, 'message' => 'Error,Please Check Again!'));
        }
    }

}