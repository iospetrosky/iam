<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
    }
    
	public function index()	{
	    // load all the data needed in the views in variables to be passed as second parameter
	    //$data['tile_sets'] = $this->register_model->some_method(); 
	    
		$this->load->view('intro');
		$this->load->view('register_form');
	}
	
	public function ajax() {
	    switch($this->hdata->aktion) {
			case 'MAKE_NEW_USER':
                $id = $this->register_model->create_user($this->hdata->username, $this->hdata->fullname, 
                                                                $this->hdata->email,$this->hdata->password);
                echo ($id);
                break;
            case 'TEST_EMAIL':
                if ($this->register_model->test_valid_email($this->hdata->email)) {
                    echo 'E-Mail can be used';
                } else {
                    echo 'E-Mail already in use';
                }
                break;
                case 'TEST_USER':
                if ($this->register_model->test_valid_user($this->hdata->username)) {
                    echo 'User ID can be used';
                } else {
                    echo 'User ID already in use';
                }
                break;
	    }
	}
	
}
    