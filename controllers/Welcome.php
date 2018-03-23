<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('welcome_model');
    }

	public function index() {
	    $this->load->view('intro');
		$this->load->view('welcome_message');
    }

    public function ajax() {
	    switch($this->hdata->aktion) {
            case 'LOGON':
                $r = $this->welcome_model->logon($this->hdata->username,
                                            $this->hdata->password);
                $retval = new stdClass();
                $retval->callback = '/iam.php/control';
                $retval->message = '';
                $retval->iam_id = '0';
                if ($r) {
                    setcookie('iam_id',$r,time()+60*60*12,"/");
                    $retval->iam_id = $r;
                    if (isset($this->hdata->iam_callback)) {
                        $retval->callback = $this->hdata->iam_callback;
                    } else {
                        $retval->message = "Logon ok. Navigate to your favourite app ";
                    }
                } else {
                    $retval->message = "Logon error";
                }
                echo json_encode($retval);
                break;
        }
    }
    
}
