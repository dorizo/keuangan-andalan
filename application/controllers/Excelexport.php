<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Excelexport extends CI_Controller {

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

    public function index()
	{
		$data["pluginjs"] = "project.js?22";

		if($this->input->get()){
			$data["dataresult"] = $this->Report_model->detailexport($this->input->get());
	
		}else{
			$data["dataresult"] = $this->project_model->view();
	
		}
		$data["witelresult"] = $this->witel_model->view();
        $data["datajob"] = $this->job_model->view();
        $data["Projectcat"] = $this->Projectcat_model->view();
		
		
		$data["titlepage"] = "PROYEK";
		$this->load->view('template/header' , $data);
		$this->load->view('excel/indexdata' , $data);
		$this->load->view('template/footer');
	}
    public function export(){
        
		if($this->input->get()){
			$dataresult= $this->Report_model->detailexport($this->input->get());
	
		}else{
			$dataresult= $this->project_model->view();
	
		}

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
		$sheet->setCellValue('B1', "PROJECT KODE"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('C1', "VENDOR"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('D1', "WITEL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('E1', "KATEGORI"); // Set kolom E3 dengan tulisan "ALAMAT"
	
		$sheet->setCellValue('F1', "PROJECT STATUS"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('G1', "PROJECT MULAI"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('H1', "PROJECT SELESAI"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('I1', "NILAI PROJECT"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('J1', "NILAI BOQ"); // Set kolom E3 dengan tulisan "ALAMAT"
        
		$sheet->setCellValue('K1', "SHERING VENDOR"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('L1', "SHERING OWNER"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('M1', "PAYMENT VENDOR"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('N1', "TOTAL SELURUH BUNGA"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('O1', "PEMBAYARAN API"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('P1', "NO SURAT PESANAN"); // Set kolom E3 dengan tulisan "ALAMAT"
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A1')->applyFromArray($style_col);
		$sheet->getStyle('B1')->applyFromArray($style_col);
		$sheet->getStyle('C1')->applyFromArray($style_col);
		$sheet->getStyle('D1')->applyFromArray($style_col);
		$sheet->getStyle('E1')->applyFromArray($style_col);
		$sheet->getStyle('F1')->applyFromArray($style_col);
		$sheet->getStyle('G1')->applyFromArray($style_col);
		$sheet->getStyle('H1')->applyFromArray($style_col);
		$sheet->getStyle('I1')->applyFromArray($style_col);
		$sheet->getStyle('J1')->applyFromArray($style_col);
		$sheet->getStyle('K1')->applyFromArray($style_col);
		$sheet->getStyle('L1')->applyFromArray($style_col);
		$sheet->getStyle('M1')->applyFromArray($style_col);
		$sheet->getStyle('N1')->applyFromArray($style_col);
		$sheet->getStyle('O1')->applyFromArray($style_col);
		$sheet->getStyle('P1')->applyFromArray($style_col);
	
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		// $siswa = $this->db->query("select * from project")->result();
	
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4

        // foreach ($dataresult as $key => $value) {
        //     echo;
        //     echo ;
        //     echo $value[""];
        //     echo $value[""];
        //     echo $value[""];
        //     echo $value[""];
        //     echo $value[""];
        //     echo $value[""];
        //     echo $value[""];
        //     echo $value[""];
        //     echo $value[""];
        //     echo $value[""];
        // }
        foreach ($dataresult as $key => $value) {
			$spnum = $this->db->query("SELECT * FROM `suratpesanan` a JOIN suratpesanandetail b ON a.suratpesananCode=b.suratpesananCode  WHERE b.project_id=".$value["project_id"])->row();
			if($spnum){
			  $spnum = $spnum->NoSuratpesanan;
			}
		  $sheet->setCellValue('A'.$numrow, $no);
		  $sheet->setCellValue('B'.$numrow, $value["project_code"] );
		  $sheet->setCellValue('C'.$numrow, $value['vendor']);
		  $sheet->setCellValue('D'.$numrow,  $value["witel"]);
		  $sheet->setCellValue('E'.$numrow, $value["cat_name"]);
		  $sheet->setCellValue('F'.$numrow, $value["project_status"]);
		  $sheet->setCellValue('G'.$numrow, $value["project_start"]);
		  $sheet->setCellValue('H'.$numrow, $value["project_done"]);
		  $sheet->setCellValue('I'.$numrow, $value["nilai_project"]);
		  $sheet->setCellValue('J'.$numrow, $value["nilai_boq"]);
		  $sheet->setCellValue('K'.$numrow, $value["sharing_vendor"]);
		  $sheet->setCellValue('L'.$numrow, $value["sharing_owner"]);
		  $sheet->setCellValue('M'.$numrow, $value["paymentvendor"]);
		  $sheet->setCellValue('N'.$numrow, $value["totalbungaseluruh"]);
		  $sheet->setCellValue('O'.$numrow, $value["pembayaranAPI"]);
		  $sheet->setCellValue('P'.$numrow , $spnum);
		  
		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('K'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('L'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('M'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('N'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('O'.$numrow)->applyFromArray($style_row);
		  $sheet->getStyle('P'.$numrow)->applyFromArray($style_row);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
	
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(15); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
		
		$sheet->getColumnDimension('F')->setWidth(15); // Set width kolom A
		$sheet->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$sheet->getColumnDimension('I')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('J')->setWidth(15); // Set width kolom E
		$sheet->getColumnDimension('K')->setWidth(15); // Set width kolom A
		$sheet->getColumnDimension('L')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('M')->setWidth(15); // Set width kolom C
		$sheet->getColumnDimension('N')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('O')->setWidth(15); // Set width kolom E
		$sheet->getColumnDimension('P')->setWidth(40); // Set width kolom E
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
	
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
	
		// Set judul file excel nya
		$sheet->setTitle("Laporan Data WIP API");
	
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="REPORT_PROJECT_API.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
	
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
      
    }
}
