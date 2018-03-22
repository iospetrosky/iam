<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {

    public function __construct()    {
        $this->load->database();
    }

    public function create_user($username, $fullname, $email, $password ) {
        $data['username'] = $username;
        $data['fullname'] = $fullname;
        $data['email'] = $email;
        $data['pass'] = $password;
        if ($this->db->insert('users',$data)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function test_valid_email($email) {
        /* tests if an email is valid for the registration so it returns FALSE 
           if the email already exists */
        $d = $this->db->select('count(ID) as test')
            ->from('users')
            ->where('email',$email)
            ->get()->result()[0];
        if ($d->test != 0) {
            return false;
        } else {
            return true;
        }
    }

    public function test_valid_user($user) {
        /* tests if an User ID is valid for the registration so it returns FALSE 
           if the user already exists */
        $d = $this->db->select('count(ID) as test')
            ->from('users')
            ->where('username',$user)
            ->get()->result()[0];
        if ($d->test != 0) {
            return false;
        } else {
            return true;
        }
    }
    
}
    