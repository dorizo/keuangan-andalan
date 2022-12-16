<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			// $this->load->model('project_model');
			$this->load->model('user_model');
			
	}


	public function index()
	{
		$data["titlepage"] = "Login Page";
        // $this->session->sess_destroy();
        // print_r($this->session->userdata());

        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
    
        if ($this->form_validation->run() === FALSE)
        {
		$this->load->view('login' , $data);
        }else{
            $this->load->view('login' , $data);
            $createsession = $this->user_model->login();
        // print_r($createsession);
        if($createsession){
            // echo "data";
        //    $a =  json_encode($this->user_model->login());
        //     print_r($a);
            $a = array(
                'userCode'  => $createsession->userCode,
                'name'  => $createsession->name,
                'email'  => $createsession->email,
                'nik_api'  => $createsession->nik_api,
                'nik_ta'  => $createsession->nik_ta,
                // 'email'     => 'johndoe@some-site.com',
                // 'logged_in' => TRUE
            );
            $this->session->set_userdata($a);
            
            
            redirect('/', 'refresh');
        }else{
           echo "<h3>Username atau Password salah</h3>";
        }

        }
	}
    public function logout(){
        $this->session->sess_destroy();
            
            
        redirect('/', 'refresh');
    }
}
