<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('akunbank_pengajuan_model');
			$this->load->model('akunbank_model');
			
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}

	public function index(){
		
		$data["titlepage"] = "NOTIFIKASI";
		$data["datatable"] = $this->akunbank_pengajuan_model->pengajuannotiv("PENDING");
		$data["pluginjs"] = "project.js?2s2";
		$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/notiv' , $data);
		$this->load->view('template/footer');
	}

	public function notivsp(){
		
		$data["titlepage"] = "NOTIFIKASI";
		$data["datatable"] = $this->akunbank_pengajuan_model->pengajuannotivsp("PENDING");
		$data["pluginjs"] = "project.js?2s2";
		$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/notivsp' , $data);
		$this->load->view('template/footer');
	}

	public function setting($a)
	{
		$data["dataresult"] = $this->project_model->viewSinggle($a);
		$data["titlepage"] = "LIST PENGAJUAN CALL CENTER = " .$data["dataresult"]->project_code;
		$data["datatable"] = $this->akunbank_pengajuan_model->view($a);
		$data["pluginjs"] = "transaksi.js";
		$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/view' , $data);
		$this->load->view('template/footer');
	}
	public function edit($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
		$data["pengajuanstatus"] = $this->akunbank_pengajuan_model->pengajuanstatus();
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->edit();	
		redirect($_SERVER['HTTP_REFERER']);  
		
		}
	}

    public function add($id , $pengajuan="project"){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
		$data["titlepage"] = "Transaksi Project ";
		$data["project_id"] = $id;
		$data["pengajuanproses"] = $pengajuan;
		$data["akunbank"] = $this->akunbank_model->view();
		$data["pengajuanstatus"] = $this->akunbank_pengajuan_model->pengajuanstatus($pengajuan);
	//   print_r($data["akunbank"]);
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/add' , $data);
		$this->load->view('template/footer');
		
		}else{

			$config['upload_path']          = './pembayaran/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 100000;
			$config['max_width']            = 102400;
			$config['max_height']           = 76800;
			$config['encrypt_name']           = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				$this->load->view('template/header' , $data);
				$this->load->view('Pengajuan/add' , $data);
				$this->load->view('template/footer');
			}else{
				// print_r();		
				echo "<script>alert('pengajuan berhasil di input')</script>";
				$this->akunbank_pengajuan_model->submitadd($this->upload->data("file_name"));
				if($this->input->post("statusPengajuan")=="project"){
				redirect('/Pengajuan/setting/'.$id, 'refresh');
			
				}else{

					redirect("/suratpesanan", 'refresh');   
				}	
			}
		}
	}
    public function delete($d){

        $this->akunbank_pengajuan_model->delete($d);
		redirect($_SERVER['HTTP_REFERER']);  
    }

	public function reject($d){
		$this->db->set("statusTransaksi" , "REJECT");
		$this->db->where("akunbank_pengajuanCode" ,$d);
		$this->db->limit(1);
		$this->db->update("akunbank_pengajuan");
		redirect($_SERVER['HTTP_REFERER']);  
    }
	
	public function pengajuanho(){
		
		$data["titlepage"] = "NOTIFIKASI";
		
        $this->db->join("witelho c" , "c.witelhoID=a.witel_id");
        $this->db->join("sto d" , "d.stoCode=a.stoCode");
        $this->db->join("pekerjaan f" , "f.pekerjaanCode=a.pekerjaanCode");
		$this->db->where("kategoriakutansi" , "pending");
        $this->db->order_by("orCode" , "DESC");
        $data["datatable"] = $this->db->get("oprasionalrequest a")->result_array();
		$data["pluginjs"] = "project.js?2s2";
		$this->load->view('template/header' , $data);
		$this->load->view('Pengajuan/pengajuanho' , $data);
		$this->load->view('template/footer');
	}
	
}
