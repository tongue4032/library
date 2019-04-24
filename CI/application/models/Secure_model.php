<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Secure_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function add_user($data){
		return $this->db->insert(TBL_USER,$data);
	}

	public function get_user($username,$pwd){
		$condition['username'] = $username;
		$condition['password'] = $pwd;
		$query = $this->db->where($condition)->get(TBL_USER);
		return $query->row_array();
	}
	public function get_email($email,$pwd){
		$condition['email'] = $email;
		$condition['password'] = $pwd;
		$query = $this->db->where($condition)->get(TBL_USER);
		return $query->row_array();
	}
	public function get_telephone($telephone,$pwd){
		$condition['telephone'] = $telephone;
		$condition['password'] = $pwd;
		$query = $this->db->where($condition)->get(TBL_USER);
		return $query->row_array();
	}

	public function sendemail($email){
//		$this->db->select('user_id,username,password');//进行邮箱验证
//        $sql = $this->db->get_where('lib_user',"email='$email'")->row_array();
//        $id = $sql['user_id'];
//        if(!$id){//该邮箱尚未注册！
//            return array('code' => 0, 'result' => 'This email address is not registered. Please check your email address.');
//        }else{
//           $get_pass_time = time(); //获取当前时间
//           $uid = $sql['user_id'];//用户id
           $token = rand(1000,9999);//组合验证码
           $this->db->query("update lib_user set password='".$token."'where email='".$email."'");
           $smtp_email_to = $email; //收件人邮箱
           $url = "http://dev.ci.com/Secure/reset?email=".$email."&token=".$token;//构造重置密码地址的URL
           $email_subject = "www.onelibrary.com - Retrieve password";//邮件主题
           $email_body = "Dear,".$email."：<br/>You submitted a password recovery request at ONELibrary.Please click the link below to reset the password(the link is valid within 24 hours)<br/><a href='".$url."'target='_blank'>".$url."</a>"; //邮件内容
            //加载Mailer类调用sendMail方法传参
           $this->load->library('Mailer');
           return $this->mailer->sendMail($email_subject,$email_body,$smtp_email_to);           //更新数据时间
	}

    public function check_permission($email){
        $this->db->select('user_id,username,password');//进行邮箱验证
        $sql = $this->db->get_where('lib_user', "email='$email'")->row_array();
        $id = $sql['user_id'];
        if (!$id) {//该邮箱尚未注册！
            return array('code' => 0, 'message' => 'This email address is not registered. Please check your email address.');
        }
    }

	public function Update($data,$token){
		return $this->db->query("update lib_user set password='".$data['password']."' where password='".$token."'");
	}

}











