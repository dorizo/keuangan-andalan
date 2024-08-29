<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Project extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('project_model');
			$this->load->model('Report_model');
			
			$this->load->model('vendor_model');
			$this->load->model('witel_model');
			$this->load->model('akunbankTransaksi_model');
			$this->load->library('zip');
			$this->load->model('log_project_model');
			$this->load->model('Projectcat_model');
			
			$this->load->model('job_model');
			$this->load->helper(array('form', 'url','directory'));
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function export(){
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
	
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = [
		  'font' => ['bold' => true], // Set font nya jadi bold
		  'alignment' => [
			'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ],
		  'borders' => [
			'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
			'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
			'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
			'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
		  ]
		];
	
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
		  'alignment' => [
			'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ],
		  'borders' => [
			'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
			'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
			'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
			'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
		  ]
		];
	
	
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A1', "NO"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('B1', "NIS"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('C1', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('D1', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('E1', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
	
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A1')->applyFromArray($style_col);
		$sheet->getStyle('B1')->applyFromArray($style_col);
		$sheet->getStyle('C1')->applyFromArray($style_col);
		$sheet->getStyle('D1')->applyFromArray($style_col);
		$sheet->getStyle('E1')->applyFromArray($style_col);
	
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$siswa = $this->db->query("select * from project")->result();
	
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa as $data){ // Lakukan looping pada variabel siswa
		  $sheet->setCellValue('A'.$numrow, $no);
		  $sheet->setCellValue('B'.$numrow, $data->project_code);
		  $sheet->setCellValue('C'.$numrow, $data->witel_id);
		  $sheet->setCellValue('D'.$numrow, $data->project_start);
		  $sheet->setCellValue('E'.$numrow, $data->project_done);
		  
		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
	
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
	
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
	
		// Set judul file excel nya
		$sheet->setTitle("Laporan Data Siswa");
	
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Siswa.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
	
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	  }

	public function index()
	{
		$data["pluginjs"] = "project.js?22";

		if($this->input->get()){
			$data["dataresult"] = $this->Report_model->detail($this->input->get());
	
		}else{
			$array = array();
			$witel = $this->witel_model->role_witel($this->session->userdata("userCode"));
			foreach ($witel as $key => $value) {
				# code...
				$array[] = $value->witelCode;
			}
			$data["dataresult"] = $this->project_model->view($array);
	
		}
		$data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
        $data["Projectcat"] = $this->Projectcat_model->view();
		
		
		$data["titlepage"] = "PROYEK";
		$this->load->view('template/header' , $data);
		$this->load->view('project' , $data);
		$this->load->view('template/footer');
	}
	public function setting($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/Settingnilaiproject' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->edit();
			
            redirect('/project', 'refresh');
		
		}
	}

	public function boqfinal($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/boqfinal' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->editboqfinal();
			
            redirect('/project', 'refresh');
		
		}
	}

	public function edit($id){

		$data["kategori"] = $this->db->query("select * from project_cat")->result_array();
		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/edit' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->editpms();
			
            redirect('/project', 'refresh');
		
		}
	}

	public function generate($id){
		$data = $this->project_model->viewSinggle($id);
		$tgl =date("Y" ,strtotime($data->project_date));
		$parameter = explode("-", $data->project_code);
		// echo;
		$witel = $this->db->query("select * from witel where witel_id=".$data->witel_id)->row();
		$search = $witel->region_id."-".$witel->witel_code."-".$tgl;
		$codetahun = $this->db->query("SELECT * ,  (SUBSTRING( project_code , 11) * 1) as mn FROM project where project_code LIKE '%-".$tgl."-%' order by mn desc" )->row();
		// print_r( $codetahun);
		$generetecallcenter =  $search."-".str_pad(($codetahun->mn+1), 4, '0', STR_PAD_LEFT);
		if(count($parameter) == 4){
			$dataddd["titlepage"] = "<div class='bg-danger'>ERROR <hr />PROJECT UNTUK COLCANTER INI TELAH DI BUAT = ".$data->project_code."<hr /><a href='".BASE_URL("project")."'>BACK</a></div>";	
			$this->load->view('template/header' , $dataddd);
			$this->load->view('template/footer');
		}else{
			$dataddd["titlepage"] = "<div class='bg-primary card-body'>GENERATE CODE <hr />PROJECT  COLCANTER INI AKAN DIBUAT DENGAN CODE <hr />".$generetecallcenter."<hr /><a class='btn btn-danger' href='".BASE_URL("project")."'>CANCEL</a> <a class='btn btn-danger' href='".BASE_URL("project/generatesubmit/".$id."/".$generetecallcenter)."'>GENERATE</a></div>";	
			$this->load->view('template/header' , $dataddd);
			$this->load->view("projectpart/generate");
			$this->load->view('template/footer');
			// $this->load->view();
			// $data = array("project_code" => $generetecallcenter );
			// $this->db->where("project_id" , $id);
			// $sss = $this->db->update("project" ,$data);
			// if($sss){
				
			// 	redirect('/project', 'refresh');
			// }
		
		}
		// ;
		// $this->

	}
	public function generatesubmit($id,$generetecallcenter){
		$data = array("project_code" => $generetecallcenter );
			$this->db->where("project_id" , $id);
			$sss = $this->db->update("project" ,$data);
			if($sss){
				
				redirect('/project', 'refresh');
			}
	}
	
	public function done($id){

		$this->form_validation->set_rules('project_id', 'project_id', 'required');
        
        $data["dataresult"] = $this->project_model->viewSinggle($id);
        $data["vendorresult"] = $this->vendor_model->view();
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
	   if ($this->form_validation->run() === FALSE)
        {
     	$this->load->view('template/header' , $data);
		$this->load->view('projectpart/done' , $data);
		$this->load->view('template/footer');
		
		}else{
			$this->project_model->doneproject();
            redirect('/project', 'refresh');
		}
	}
	public function download($id){
		$x = explode("/",$_SERVER['DOCUMENT_ROOT']);
		unset($x[4]);
		unset($x[5]);
		unset($x[6]);
		$path =  implode("/",$x)."/api/assets/".$id."/";
	
		// $path = $_SERVER["DOCUMENT_ROOT"]."/../../api/assets/".$id."/";
		// $path =  $_SERVER["DOCUMENT_ROOT"]."/backend_andalanpratama/assets/".$id."/";

		$this->zip->read_dir($path);

		// Download the file to your desktop. Name it "my_backup.zip"
		$this->zip->download('my_backup.zip');

	}
	public function detail($id){
        $data["dataresult"] = $this->project_model->viewSinggle($id);
		$data["logproject"] = $this->log_project_model->getlogproject($id);
		$data["sumproject"] = $this->akunbankTransaksi_model->sumproject($id);
		$data["transaksiproject"] = $this->akunbankTransaksi_model->view($id);
        $data["datajob"] = $this->job_model->view();
		$data["titlepage"] = "PROYEK " . $data["dataresult"]->project_code;
		// echo $_SERVER["DOCUMENT_ROOT"]."/../../api/assets/".$id."/";
		
			$x = explode("/",$_SERVER['DOCUMENT_ROOT']);
			unset($x[4]);
			unset($x[5]);
			unset($x[6]);
			// print_r($x);
		 $file =  implode("/",$x)."/api/assets/".$id."/";
		//local dir
		// $file =  $_SERVER["DOCUMENT_ROOT"]."/backend_andalanpratama/assets/".$id."/";
        $map = directory_map($file, false , true);
	
		$data["upload_list"] = $this->db->from("karyawan_upload")->where("project_id" , $id)->order_by("log_date","desc")->get()->result();
		$data["lainlain"] = $this->db->from("biayalain")->join("biayalaindetail" , "biayalain.biayalainCode=biayalaindetail.biayalainCode")->join("project" , "project.project_id=biayalaindetail.project_id")->where("biayalaindetail.project_id" , $id)->get()->result_array();
		
		$data["map"] =  $map;
		$this->load->view('template/header' , $data);
		$this->load->view('projectpart/detail' , $data);
		$this->load->view('template/footer');
	}

	
	public function add(){
		
        $data["vendorresult"] = $this->vendor_model->view();
        $data["witelresult"] = $this->witel_model->view();
		$data["titlepage"] = "Tambah Project";
		$data["kategori"] = $this->db->query("select * from project_cat")->result_array();
			$this->form_validation->set_rules('project_name', 'project_name', 'required');
		 if ($this->form_validation->run() === FALSE)
		  {
		   $this->load->view('template/header' , $data);
		  $this->load->view('projectpart/addproject' , $data);
		  $this->load->view('template/footer');
		  
		  }else{
			  $this->project_model->submitadd();	
			  redirect('/', 'refresh');
		  }
	}
}
