<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ReportKeuangan extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->model('Report_model');
			if(!$this->session->userdata("userCode")){
				redirect('/login', 'refresh');
			}
	}


	public function index()
	{

		$data["titlepage"] = "Report Keuangan";
		$data["pluginjs"] = "transaksi.js";
        $mulai = date("Y-m-d");
        $selesai = date("Y-m-d");
        if($this->input->get("mulai") and $this->input->get("selesai")){
            $mulai = $this->input->get("mulai");
            $selesai = $this->input->get("selesai");
           
        }
        $querycari = 'select   DATE_FORMAT(a.transaksiDate, \'%d-%m-%Y\') as transaksiDate, MONTH(a.transaksiDate) as bulan , b.project_code ,d.AkunAkutansiName , d.AkunAkutansiCodeName , "tidak ada" as akun, "tidak ada" as kategori , witel_name , region_name , cat_name , a.transaksiNote, CASE WHEN a.statusTransaksi="DB" THEN a.transaksiJumlah ELSE NULL END AS debit , CASE WHEN a.statusTransaksi="CR" THEN a.transaksiJumlah ELSE NULL END AS kredit , vendorName from akunbank_transaksi a JOIN project b ON b.project_id=a.project_id  JOIN akunbank c ON a.akunBankCode=c.akunBankCode JOIN akunakutansi d ON d.AkunAkuntansiCode=a.AkunAkuntansiCode JOIN project e ON e.project_id=a.project_id JOIN witel f ON f.witel_id=e.witel_id JOIN region g ON g.region_id=f.region_id JOIN project_cat h ON e.cat_id=h.cat_id JOIN vendor i ON i.vendorCode=e.vendorCode where date(a.transaksiDate) between date("'.$mulai.'")  AND date("'.$selesai.'")  order by transaksiDate desc';
        $data["tabledata"] = $this->db->query($querycari)->result_array(); 
        $nilaiboq = 'select sum(nilai_boq) as nilai from project a where date(a.project_start) between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["nilaiboq"] =  $this->db->query($nilaiboq)->row(); 
        $nilaikeluar = 'select sum(transaksiJumlah) as nilai from akunbank_transaksi a where date(a.transaksiDate)  between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["nilaikeluar"] =  $this->db->query($nilaikeluar)->row(); 
        $projectpaid = 'select sum(nilai_project_paid) as nilai from project a where date(a.project_paid) between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["projectpaid"] =  $this->db->query($projectpaid)->row(); 
        $projectcash = 'select sum(nilai_project_paid) as nilai from project a where date(a.tanggal_cashbank) between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["projectcash"] =  $this->db->query($projectcash)->row(); 
        $oprasional = 'select sum(kredit) as nilai from oprasional a where date(a.tanggal) between date("'.$mulai.'")  AND date("'.$selesai.'")';
        $data["oprasional"] =  $this->db->query($oprasional)->row(); 
     
        $this->load->view('template/header' , $data);
		$this->load->view('reportkeuangan/view' , $data);
		$this->load->view('template/footer');
    }

    public function export(){
        $date =$this->input->get("mulai");
        $result =[];
        $s = 1;
        while (strtotime($date) <= strtotime($this->input->get("selesai"))) {
           $transaksiproject = $this->db->query("select   DATE_FORMAT(a.transaksiDate, '%Y-%m-%d') as transaksiDate, MONTH(a.transaksiDate) as bulan , b.project_code ,d.AkunAkutansiName , d.AkunAkutansiCodeName , 'tidak ada' as akun, 'tidak ada' as kategori , witel_name , region_name , cat_name , a.transaksiNote, CASE WHEN a.statusTransaksi='DB' THEN a.transaksiJumlah ELSE NULL END AS debit , CASE WHEN a.statusTransaksi='CR' THEN a.transaksiJumlah ELSE NULL END AS kredit , vendorName from akunbank_transaksi a JOIN project b ON b.project_id=a.project_id  JOIN akunbank c ON a.akunBankCode=c.akunBankCode JOIN akunakutansi d ON d.AkunAkuntansiCode=a.AkunAkuntansiCode JOIN project e ON e.project_id=a.project_id JOIN witel f ON f.witel_id=e.witel_id JOIN region g ON g.region_id=f.region_id JOIN project_cat h ON e.cat_id=h.cat_id JOIN vendor i ON i.vendorCode=e.vendorCode where DATE_FORMAT(a.transaksiDate, '%Y-%m-%d') ='$date'")->result_array();
            foreach ($transaksiproject as $key => $value) {
                $row = array();
                # code...
                $row[]=$value["transaksiDate"];
                $row[]= date("M",strtotime($value["transaksiDate"]));
                $row[]=$value["project_code"];
                $row[]=$value["AkunAkutansiName"];
                $row[]=$value["AkunAkutansiCodeName"];
                $row[]=$value["akun"];
                $row[]=$value["kategori"];
                $row[]=$value["witel_name"];
                $row[]=null;
                $row[]=$value["region_name"];
                $row[]=$value["cat_name"];
                $row[]=$value["transaksiNote"];
                $row[]=null;
                $row[]=$value["kredit"];
                $row[]=null;
                $row[]=null;
                $row[]=$value["vendorName"];
                $result[] = $row;
                $s++;
            }
            // echo "select * from oprasional a where DATE_FORMAT(a.tanggal, '%Y-%m-%d') ='$date'";
            
            $this->db->join("akutansi_akun b" , "b.kode_akun=a.kode_akun");
            $this->db->join("witelho c" , "c.witelhoID=a.witel_id");
            $this->db->join("sto d" , "d.stoCode=a.stoCode");
            $this->db->join("pekerjaan f" , "f.pekerjaanCode=a.pekerjaanCode");
            $this->db->where("DATE_FORMAT(a.tanggal, '%Y-%m-%d')=" , $date);
            $db = $this->db->get("oprasional a");
            $transaksiproject2 =  $db->result_array();
            // $transaksiproject2 = $this->db->query("select * from oprasional a where DATE_FORMAT(a.tanggal, '%Y-%m-%d') ='$date'")->result_array();
            foreach ($transaksiproject2 as $key => $value) {
            
                # code...
                $row = array();
                # code...
                $row[]=$value["tanggal"];
                $row[]= date("M",strtotime($value["tanggal"]));
                $row[]=$value["kode_project"];
                $row[]=$value["nama_akun"];
                $row[]=$value["kode_akun"];
                $row[]=$value["nama_akun"];
                $row[]=$value["kategori"];
                $row[]=$value["witelhoName"];
                $row[]=$value["stoName"];
                $row[]=$value["regional_id"];
                $row[]=$value["pekerjaanName"];
                $row[]=$value["keterangan"];
                $row[]=$value["debit"];
                $row[]=$value["kredit"];
                $row[]=$value["diterimaoleh"];
                $row[]=$value["dikirimoleh"];
                $row[]=$value["mandor"];
                $result[] = $row;
            }
            
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        }
        
        echo json_encode($result); 
    }

    public function exportnew(){
        $date =$this->input->get("mulai");
        $result =[];
        $s = 1;
        while (strtotime($date) <= strtotime($this->input->get("selesai"))) {
           $transaksiproject = $this->db->query("select   DATE_FORMAT(a.transaksiDate, '%Y-%m-%d') as transaksiDate, MONTH(a.transaksiDate) as bulan , b.project_code ,d.AkunAkutansiName , d.AkunAkutansiCodeName , 'tidak ada' as akun, 'tidak ada' as kategori , witel_name , region_name , cat_name , a.transaksiNote, CASE WHEN a.statusTransaksi='DB' THEN a.transaksiJumlah ELSE NULL END AS debit , CASE WHEN a.statusTransaksi='CR' THEN a.transaksiJumlah ELSE NULL END AS kredit , vendorName from akunbank_transaksi a JOIN project b ON b.project_id=a.project_id  JOIN akunbank c ON a.akunBankCode=c.akunBankCode JOIN akunakutansi d ON d.AkunAkuntansiCode=a.AkunAkuntansiCode JOIN project e ON e.project_id=a.project_id JOIN witel f ON f.witel_id=e.witel_id JOIN region g ON g.region_id=f.region_id JOIN project_cat h ON e.cat_id=h.cat_id JOIN vendor i ON i.vendorCode=e.vendorCode where DATE_FORMAT(a.transaksiDate, '%Y-%m-%d') ='$date'")->result_array();
            foreach ($transaksiproject as $key => $value) {
                $row = array();
                # code...
                $row[]=$value["transaksiDate"];
                $row[]= date("M",strtotime($value["transaksiDate"]));
                $row[]=$value["project_code"];
                $row[]=$value["AkunAkutansiName"];
                $row[]=$value["AkunAkutansiCodeName"];
                $row[]=$value["akun"];
                $row[]=$value["kategori"];
                $row[]=$value["witel_name"];
                $row[]=null;
                $row[]=$value["region_name"];
                $row[]=$value["cat_name"];
                $row[]=$value["transaksiNote"];
                $row[]=null;
                $row[]=$value["kredit"];
                $row[]=null;
                $row[]=null;
                $row[]=$value["vendorName"];
                $result[] = $row;
                $s++;
            }
            // echo "select * from oprasional a where DATE_FORMAT(a.tanggal, '%Y-%m-%d') ='$date'";
            
            $this->db->join("akutansi_akun b" , "b.kode_akun=a.kode_akun");
            $this->db->join("witelho c" , "c.witelhoID=a.witel_id");
            $this->db->join("sto d" , "d.stoCode=a.stoCode");
            $this->db->join("pekerjaan f" , "f.pekerjaanCode=a.pekerjaanCode");
            $this->db->where("DATE_FORMAT(a.tanggal, '%Y-%m-%d')=" , $date);
            $db = $this->db->get("oprasional a");
            $transaksiproject2 =  $db->result_array();
            // $transaksiproject2 = $this->db->query("select * from oprasional a where DATE_FORMAT(a.tanggal, '%Y-%m-%d') ='$date'")->result_array();
            foreach ($transaksiproject2 as $key => $value) {
            
                # code...
                $row = array();
                # code...
                $row[]=$value["tanggal"];
                $row[]= date("M",strtotime($value["tanggal"]));
                $row[]=$value["kode_project"];
                $row[]=$value["nama_akun"];
                $row[]=$value["kode_akun"];
                $row[]=$value["nama_akun"];
                $row[]=$value["kategori"];
                $row[]=$value["witelhoName"];
                $row[]=$value["stoName"];
                $row[]=$value["regional_id"];
                $row[]=$value["pekerjaanName"];
                $row[]=$value["keterangan"];
                $row[]=$value["debit"];
                $row[]=$value["kredit"];
                $row[]=$value["diterimaoleh"];
                $row[]=$value["dikirimoleh"];
                $row[]=$value["mandor"];
                $result[] = $row;
            }
            
            $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
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
		$sheet->setCellValue('A1', "Tanggal"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('B1', "Bulan"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('C1', "Kode Project"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('D1', "Nama Akun"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('E1', "Kode Akun"); // Set kolom E3 dengan tulisan "ALAMAT"
	
		$sheet->setCellValue('F1', "Akun"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('G1', "Kategori"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('H1', "Witel"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('I1', "Sto"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('J1', "Regional"); // Set kolom E3 dengan tulisan "ALAMAT"
        
		$sheet->setCellValue('K1', "Pekerjaan"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('L1', "Keterangan"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('M1', "Debit"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('N1', "Kredit"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('O1', "Diterima Oleh"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('P1', "Dikirim Oleh"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('Q1', "Mandor"); // Set kolom E3 dengan tulisan "ALAMAT"
	
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
		$sheet->getStyle('Q1')->applyFromArray($style_col);
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4

        foreach ($result as $key => $value) {
		
		  $sheet->setCellValue('A'.$numrow, $value["0"]);
		  $sheet->setCellValue('B'.$numrow, $value["1"] );
		  $sheet->setCellValue('C'.$numrow, $value['2']);
		  $sheet->setCellValue('D'.$numrow,  $value["3"]);
		  $sheet->setCellValue('E'.$numrow, $value["4"]);
		  $sheet->setCellValue('F'.$numrow, $value["5"]);
		  $sheet->setCellValue('G'.$numrow, $value["6"]);
		  $sheet->setCellValue('H'.$numrow, $value["7"]);
		  $sheet->setCellValue('I'.$numrow, $value["8"]);
		  $sheet->setCellValue('J'.$numrow, $value["9"]);
		  $sheet->setCellValue('K'.$numrow, $value["10"]);
		  $sheet->setCellValue('L'.$numrow, $value["11"]);
		  $sheet->setCellValue('M'.$numrow, $value["12"]);
		  $sheet->setCellValue('N'.$numrow, $value["13"]);
		  $sheet->setCellValue('O'.$numrow, $value["14"]);
		  $sheet->setCellValue('p'.$numrow, $value["15"]);
		  $sheet->setCellValue('Q'.$numrow, $value["16"]);
		  
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
		  $sheet->getStyle('Q'.$numrow)->applyFromArray($style_row);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}
	
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(15); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(25); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
		
		$sheet->getColumnDimension('F')->setWidth(15); // Set width kolom A
		$sheet->getColumnDimension('G')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('H')->setWidth(15); // Set width kolom C
		$sheet->getColumnDimension('I')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('J')->setWidth(15); // Set width kolom E
		$sheet->getColumnDimension('K')->setWidth(15); // Set width kolom A
		$sheet->getColumnDimension('L')->setWidth(100); // Set width kolom B
		$sheet->getColumnDimension('M')->setWidth(15); // Set width kolom C
		$sheet->getColumnDimension('N')->setWidth(15); // Set width kolom D
		$sheet->getColumnDimension('O')->setWidth(15); // Set width kolom E
		$sheet->getColumnDimension('P')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('Q')->setWidth(20); // Set width kolom E
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
	
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
	
		// Set judul file excel nya
		$sheet->setTitle("Laporan Data WIP API");
	
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="reportApiKeuaangan.'.date("Y-M-d").'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
	
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');

    }

}
?>