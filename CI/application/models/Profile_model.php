<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function modify($data,$user_id){
        // $Email = $data['Email'];
        // var_dump($Email);
        $data = array(
            'username' => $data['username'],
            'password' => $data['password'],
            'telephone' => $data['telephone'],
            'email' => $data['email']
        );
        $this->db->where("user_id='".$user_id."'");
        return $this->db->update('lib_user',$data);
    }
}