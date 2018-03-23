
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('control_model');
    }
    
	public function index()
	{
	    // load all the data needed in the views in variables to be passed as second parameter
        $data = $this->control_model->read_current_user($this->hdata->iam_id); 
        if($data === false) {
            header("Location: /iam.php",true);
        }
	    
		$this->load->view('intro');
		$this->load->view('control_form',$data);
	}
	
	public function ajax() {
	    switch($this->hdata->aktion) {
            case 'UPDATE_EMAIL':
                $r = $this->control_model->update_email($this->hdata->iam_id, $this->hdata->email);
                if ($r == 1) {
                    echo "Update OK";
                } else {
                    echo "Update error";
                }
                break;
            case 'UPDATE_NAME':
                $r = $this->control_model->update_fullname($this->hdata->iam_id, $this->hdata->fullname);
                if ($r == 1) {
                    echo "Update OK";
                } else {
                    echo "Update error";
                }
                break;
            case 'UPDATE_PASS':
                $r = $this->control_model->update_password($this->hdata->iam_id, $this->hdata->password);
                if ($r == 1) {
                    echo "Update OK";
                } else {
                    echo "Update error";
                }
                break;
        }
    }

    public function logoff() {
        setcookie("iam_id",0,time()-100,"/");
    }
}
    