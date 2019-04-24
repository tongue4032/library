<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Secure extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Secure_model');
        $this->load->library('form_validation');

    }

    public function index(){
        $this->load->view('Secure_views/homepage');
    }

    public function captcha(){
        $this->load->library('captcha');         //加载这个代替类
        $captcha= $this->captcha->getCaptcha();  //生成的验证码值
        $this->session->set_userdata('code', $captcha);   //保存验证码值
        $this->captcha->showImg();               //生成验证码图片
    }
    public function username_login(){
        $this->load->view('Secure_views/username_login');
    }
    public function email_login(){
        $this->load->view('Secure_views/email_login');
    }
    public function telephone_login(){
        $this->load->view('Secure_views/telephone_login');
    }
    public function register(){
        $this->load->view('Secure_views/register');
    }
    public function forget(){
        $this->load->view('Secure_views/forget');
    }
    public function reset(){
        $data['token'] = $this->input->get('token');
        $_SESSION['token'] = $data['token'];
        $this->load->view('Secure_views/reset');
    }
    public function phone_register(){
        $this->load->view('Secure_views/phone_register');
    }


    //用户登录
    public function do_username_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $pwd = md5($password);
        $user = $this->Secure_model->get_user($username,$pwd);
        if($user){
            $this->session->set_userdata('user',$user);
            echo json_encode(array('code' => 1, 'message' => 'Welcome!'));
        }else{
            echo json_encode(array('code' => 0, 'message' => 'Incorrect admin name or password!'));
        }
    }

    public function do_email_login(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $pwd = md5($password);
        $user = $this->Secure_model->get_email($email,$pwd);
        if($user){
            $this->session->set_userdata('user',$user);
            echo json_encode(array('code' => 1,'message' => 'Welcome!'));
        }else{
            echo json_encode(array('code' => 0, 'message' => 'Incorrect email address or password!'));
        }
    }

    public function do_telephone_login(){
        $telephone = $this->input->post('telephone');
        $password = $this->input->post('password');
        $pwd = md5($password);
        $user = $this->Secure_model->get_telephone($telephone,$pwd);
        if($user){
            $this->session->set_userdata('user',$user);
            echo json_encode(array('code' => 1,'message' => 'Welcome!'));
        }else{
            echo json_encode(array('code' => 0, 'message' => 'Incorrect mobile number or password!'));
        }
    }



    //用户注册
    public function do_register(){
        #设置规则
        $this->form_validation->set_rules('username','Username');
        $this->form_validation->set_rules('password','Password','min_length[6]|max_length[10]','alpha_dash');
        $this->form_validation->set_rules('repassword','Confirm Password','matches[password]');
        $this->form_validation->set_value('email','Eamil','valid_email');

        if($this->form_validation->run() == false){
            #未通过
            echo validation_errors();
        }else{
            #通过
            $code = $this->input->post('captcha');
            $code2 = strtolower($this->session->userdata('code'));
            if(strtolower($code) != $code2){
                echo json_encode(array('code' => 0, 'message' => 'Verification Code Error, Please Re-enter'));
            }else{
                $data['username'] = $this->input->post('username',true);
                $data['password'] = md5($this->input->post('password',true));
                $data['email'] = $this->input->post('email',true);
                $register = $this->Secure_model->add_user($data);
                if($register){
                    echo json_encode(array('code' => 1, 'message' => 'Register Successful!Please Return Login!'));
                }
            }
        }
    }



    //手机注册
    public function do_phone_register(){
        #设置规则
        $this->form_validation->set_rules('username','Username');
        $this->form_validation->set_rules('number','Number','numeric|exact_length(11)');
        $this->form_validation->set_rules('password','Password','min_length[6]|max_length[10]','alpha_dash');
        $this->form_validation->set_rules('repassword','Confirm Password','matches[password]');
        $this->form_validation->set_value('email','Eamil','valid_email');

        if($this->form_validation->run() == false){
            #未通过
            echo validation_errors();
        }else{
            #通过
            $code = $this->input->post('captcha');
            $code2 = strtolower($this->session->userdata('code'));
            if(strtolower($code) != $code2){
                echo json_encode(array('code' => 0, 'message' => 'Verification Code Error, Please Re-enter'));
            }else{
                $data['username'] = $this->input->post('username',true);
                $data['telephone'] = $this->input->post('telephone',true);
                $data['password'] = md5($this->input->post('password',true));
                $data['email'] = $this->input->post('email',true);
                $register = $this->Secure_model->add_user($data);
                if($register){
                    echo json_encode(array('code' => 1, 'message' => 'Register Successful!Please Return Login!'));
                }
            }
        }
    }


    //注销登录
    public function logout(){
        $this->session->unset_userdata('user');
        echo "<script>window.location='./index'</script>";
    }

    //发送邮件
    public function sendemail(){
        $code = $this->input->post('captcha');
        $code2 = $this->session->userdata('code');
        $email = $this->input->post('email');
        if ($code != $code2) {
            echo json_encode(array('code' => 1, 'message' => 'Verification Code Error, Please Re-enter'));
        } elseif ($this->Secure_model->check_permission($email)) {
            echo json_encode(array('code' => 0, 'message' => 'This email address is not registered. Please check your email address.'));
        } else {
            $send = $this->Secure_model->sendemail($email);
            if ($send) {
                echo json_encode(array('code' => 2, 'message' => 'The system has sent an email to your mailbox.Please login to your mailbox and reset your password in time!'));
            } else {
                echo json_encode(array('code' => 3, 'message' => 'Send failure!!'));
            }
        }
    }


    //重置密码
    public function update(){
        $_SESSION['token'];
        $data = $this->input->post();
        $this->form_validation->set_rules('password','Password','min_length[6]|max_length[10]','alpha_dash');
        $this->form_validation->set_rules('repassword','Confirm Password','matches[password]');
        if($this->form_validation->run() == false){
            echo validation_errors();
        }else{
            $code = $this->input->post('captcha');
            $code2 = strtolower($this->session->userdata('code'));
            if(strtolower($code) != $code2){
                echo json_encode(array('code' => 0, 'message' => 'Verification Code Error, Please Re-enter'));
            }else {
                $password = md5($this->input->post('password',true));
                $repassword = md5($this->input->post('repassword',true));
                $data = array(
                    'password' => $password,
                    'repassword' => $repassword
                );
                $token = $_SESSION['token'];
                $reset = $this->Secure_model->Update($data, $token);
                if ($reset) {
                    echo json_encode(array('code' => 1, 'message' => 'Register Successful!Please Return Login!'));
                }
            }
        }
    }

}