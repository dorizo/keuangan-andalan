<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('Kategori_model');
			$this->load->model('Projectcat_model');
            
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function parent()
	{
		$data["titlepage"] = "PARENT KATEGORI";
		$data["pluginjs"] = "transaksi.js";
        $data["dataresult"] = $this->Kategori_model->parent();
		$this->load->view('template/header' , $data);
		$this->load->view('kategori/parent' , $data);
		$this->load->view('template/footer');
	}
	public function addparent()
	{
        $this->form_validation->set_rules('parentcatName', 'AkunAkutansiCodeName', 'required');
        if ($this->form_validation->run() === FALSE)
        {
		$data["titlepage"] = "PARENT KATEGORI";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('kategori/addparent' , $data);
		$this->load->view('template/footer');
        }else{
             $this->Kategori_model->simpanparent();
            redirect('/kategori/parent', 'refresh');
		
        }
	}
    public function editparent($id)
	{
        $this->form_validation->set_rules('parentcatName', 'AkunAkutansiCodeName', 'required');
        $data["result"] =  $this->Kategori_model->singleparent($id);
        if ($this->form_validation->run() === FALSE)
        {
		$data["titlepage"] = "PARENT KATEGORI";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('kategori/editparent' , $data);
		$this->load->view('template/footer');
        }else{
             $this->Kategori_model->editsimpanparent();
            redirect('/kategori/parent', 'refresh');
		
        }
	}

    
	public function kat()
	{
		$data["titlepage"] = "PARENT KATEGORI";
		$data["pluginjs"] = "transaksi.js";
        $data["dataresult"] = $this->Projectcat_model->view();
		$this->load->view('template/header' , $data);
		$this->load->view('kategori/kategori' , $data);
		$this->load->view('template/footer');
	}
	public function addcat()
	{
        $this->form_validation->set_rules('parentcatName', 'AkunAkutansiCodeName', 'required');
        if ($this->form_validation->run() === FALSE)
        {
		$data["titlepage"] = "PARENT KATEGORI";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('kategori/addkategori' , $data);
		$this->load->view('template/footer');
        }else{
             $this->Projectcat_model->simpanparent();
            redirect('/kategori/parent', 'refresh');
		
        }
	}
    public function editcat($id)
	{
        $this->form_validation->set_rules('cat_id', 'cat_id', 'required');
        $data["result"] =  $this->Projectcat_model->getsingle($id);
        
        $data["dataresult"] = $this->Kategori_model->parent();
        if ($this->form_validation->run() === FALSE)
        {
		$data["titlepage"] = "PARENT KATEGORI";
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('kategori/editkategori' , $data);
		$this->load->view('template/footer');
        }else{
             $this->Projectcat_model->editcat();
            redirect('/kategori/kat', 'refresh');
		
        }
	}

	
	
}


?>
