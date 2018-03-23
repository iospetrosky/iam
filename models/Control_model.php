
    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control_model extends CI_Model {

    public function __construct()    {
        $this->load->database();
    }

    public function read_current_user($uid) {
        $data = $this->db->select('username, email, fullname')
                            ->from('users')
                            ->where('ID',$uid)
                            ->get()->result();
        if (is_array($data) && count($data > 0)) {
            return $data[0];
        } else {
            return false;
        }
    }

    public function update_email($uid,$email) {
        $obj = new stdClass();
        $obj->email = $email;

        $this->db->where('ID',$uid)->update("users", $obj)  ;
        return $this->db->affected_rows();
    }

    public function update_fullname($uid,$fullname) {
        $obj = new stdClass();
        $obj->fullname = $fullname;

        $this->db->where('ID',$uid)->update("users", $obj)  ;
        return $this->db->affected_rows();
    }

    public function update_password($uid,$password) {
        $obj = new stdClass();
        $obj->pass = $password;

        $this->db->where('ID',$uid)->update("users", $obj)  ;
        //setcookie('sql',$this->db->last_query(),time()+60,"/");
        return $this->db->affected_rows();
    }

}