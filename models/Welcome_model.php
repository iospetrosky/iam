<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model {

    public function __construct()    {
        $this->load->database();
    }


    public function logon($user, $password) {
        $d = $this->db->select('ID')
            ->from('users')
            ->where('username',$user)
            ->where('pass',$password)
            ->get()->result();
        
        if ($d) {
            return $d[0]->ID;
        } else {
            return 0;
        }
    }
    
}
    