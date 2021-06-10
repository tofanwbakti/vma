<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanPDF extends CI_Controller {

	function __construct() {
        parent::__construct();
        // cek_nologin();
        $this->load->library('pdf');
    } 

// HALAMAN DATA USER
    # Download data User
    public function downloadUser()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_level','tb_level.kode_level=tb_user.userlevel','left');
        $this->db->order_by('id_user',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('P');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar User Aplikasi');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Daftar User Aplikasi',0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(190,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(60,8,'Nama',1,0,'C',1);
        $pdf->Cell(25,8,'Username',1,0,'C',1);
        $pdf->Cell(35,8,'Level',1,0,'C',1);
        $pdf->Cell(40,8,'Update',1,0,'C',1);
        $pdf->Cell(20,8,'Status',1,1,'C',1);
        $no = 1;
        foreach ($data as $row){
            $pdf->Cell(10,7,$no++,1,0,'C');       
            $pdf->Cell(60,7,$row->fullname,1,0,'L');
            $pdf->Cell(25,7,$row->username,1,0,'L');
            $pdf->Cell(35,7,$row->nama_level,1,0,'L');
            $pdf->Cell(40,7,$row->tgl_input,1,0,'L');
            if($row->stts_user == "Y"){
                $status= "AKTIF";
            }else {$status= "NONAKTIF";}
            $pdf->Cell(20,7,$status,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

// ==========================

// HALAMAN DATA ASET LAPTOP
    # Download data Aset laptop
    public function downloadLaptop()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_laptop');
        $this->db->order_by('id_aset',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Data Aset Laptop');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Data Aset Laptop',0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(20,8,'ID/Kode',1,0,'C',1);
        $pdf->Cell(25,8,'Merk',1,0,'C',1);
        $pdf->Cell(50,8,'SN',1,0,'C',1);
        $pdf->Cell(62,8,'Processor',1,0,'C',1);
        $pdf->Cell(20,8,'RAM(Gb)',1,0,'C',1);
        $pdf->Cell(20,8,'HDD(Gb)',1,0,'C',1);
        $pdf->Cell(40,8,'Input',1,0,'C',1);
        $pdf->Cell(30,8,'Status',1,1,'C',1);
        $no = 1;

        foreach ($data as $row) {
            $cellWidth = 62; //atur lebar cell
            $cellHeight= 7; //tinggi sel satu baris normal

            //Periksa jika melebihi batas kolom
            if($pdf->GetStringWidth($row->processor) < $cellWidth){
                //jika tidak, maka biar saja
                $line = 1;
            }else{
                // jika iya(melebihi) maka hitung ketinggian yang dibutuhkan sel untuk dirapikan
                // dengan memisahkan teks agar sesuai dengan lebar sel
                // lalu hitung banyak baris yang dibutuhkan agar teks pas dengan cell
                $textLength = strlen($row->processor); //panjangan text 
                $errMargin  = 5; // margin kesalahan lebar cell
                $startChar  = 0; // posisi awal karakter untuk setiap baris
                $maxChar    = 0; // maksimum karkater yang akan ditambahkan dalam satu baris
                $textArray  = array(); //untuk menampung data dalam setiap baris
                $tmpString  = "";//untuk menampung data dalam setiap baris (temporary)

                while ($startChar < $textLength) {
                    # code...
                    //looping sampai akhir teks
                    // atau looping sampai maksimum karakter tercapai
                    while ($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength) {
                        # code...
                        $maxChar++;
                        $tmpString = substr($row->processor,$startChar,$maxChar);
                    }
                    // pindahkan ke baris selanjutnya
                    $startChar = $startChar + $maxChar;
                    // tambahkan ke dalam array agar tahu banyak baris yang dibutuhkan
                    array_push($textArray,$tmpString);
                    // reset variable penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                // Dapatkan jumlah baris
                $line = count($textArray);
            }
            # code...
            // $kode  = $row->kode_fakultas;
            // $hit = $this->db->query("SELECT * FROM tb_prodi where kode_fakultas='$kode'");

            $pdf->Cell(10,($line * $cellHeight),$no++,1,0,'C');
            $pdf->Cell(20,($line * $cellHeight),$row->id_aset,1,0,'C'); 
            $pdf->Cell(25,($line * $cellHeight),$row->merk_aset,1,0,'L'); 
            $pdf->Cell(50,($line * $cellHeight),$row->sn_aset,1,0,'L'); 
            
            // Manfaatkan MultiCall sebagai ganti Cell
            // atur posisi x,y untuk cell berikutnya agar disebelahnya
            // ingat posisi x dany sebelum menulis MultiCell
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth,$cellHeight,$row->processor,1);
            
            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth , $yPos);
            // $pdf->Cell(120,7,$row->processor,1,0,'L');
            $pdf->Cell(20,($line * $cellHeight),$row->ram,1,0,'C');
            $pdf->Cell(20,($line * $cellHeight),$row->hdd,1,0,'C');
            $pdf->Cell(40,($line * $cellHeight),$row->tgl_input,1,0,'L');
                if($row->stts_laptop == "B"){
                    $status= "BAIK";
                }else if($row->stts_laptop == "R"){
                    $status = "RUSAK";
                }else {$status= "PERBAIKAN";}
            $pdf->Cell(30,($line * $cellHeight),$status,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

// ==========================

// HALAMAN DATA ASET MONITOR
    # Download data Aset Monitor
    public function downloadMonitor()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_monitor');
        $this->db->order_by('id_aset',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Data Aset Monitor');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Data Aset Monitor',0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(30,8,'ID/Kode',1,0,'C',1);
        $pdf->Cell(50,8,'Merk',1,0,'C',1);
        $pdf->Cell(70,8,'SN',1,0,'C',1);
        $pdf->Cell(37,8,'Display (Inch)',1,0,'C',1);
        $pdf->Cell(50,8,'Input',1,0,'C',1);
        $pdf->Cell(30,8,'Status',1,1,'C',1);
        $no = 1;

        foreach ($data as $row) {
            $cellWidth = 70; //atur lebar cell
            $cellHeight= 7; //tinggi sel satu baris normal

            //Periksa jika melebihi batas kolom
            if($pdf->GetStringWidth($row->sn_aset) < $cellWidth){
                //jika tidak, maka biar saja
                $line = 1;
            }else{
                // jika iya(melebihi) maka hitung ketinggian yang dibutuhkan sel untuk dirapikan
                // dengan memisahkan teks agar sesuai dengan lebar sel
                // lalu hitung banyak baris yang dibutuhkan agar teks pas dengan cell
                $textLength = strlen($row->sn_aset); //panjangan text 
                $errMargin  = 5; // margin kesalahan lebar cell
                $startChar  = 0; // posisi awal karakter untuk setiap baris
                $maxChar    = 0; // maksimum karkater yang akan ditambahkan dalam satu baris
                $textArray  = array(); //untuk menampung data dalam setiap baris
                $tmpString  = "";//untuk menampung data dalam setiap baris (temporary)

                while ($startChar < $textLength) {
                    # code...
                    //looping sampai akhir teks
                    // atau looping sampai maksimum karakter tercapai
                    while ($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength) {
                        # code...
                        $maxChar++;
                        $tmpString = substr($row->sn_aset,$startChar,$maxChar);
                    }
                    // pindahkan ke baris selanjutnya
                    $startChar = $startChar + $maxChar;
                    // tambahkan ke dalam array agar tahu banyak baris yang dibutuhkan
                    array_push($textArray,$tmpString);
                    // reset variable penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                // Dapatkan jumlah baris
                $line = count($textArray);
            }
            # code...
            // $kode  = $row->kode_fakultas;
            // $hit = $this->db->query("SELECT * FROM tb_prodi where kode_fakultas='$kode'");

            $pdf->Cell(10,($line * $cellHeight),$no++,1,0,'C');
            $pdf->Cell(30,($line * $cellHeight),$row->id_aset,1,0,'C'); 
            $pdf->Cell(50,($line * $cellHeight),$row->merk_aset,1,0,'L'); 
            
            // Manfaatkan MultiCall sebagai ganti Cell
            // atur posisi x,y untuk cell berikutnya agar disebelahnya
            // ingat posisi x dany sebelum menulis MultiCell
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth,$cellHeight,$row->sn_aset,1);
            
            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth , $yPos);
            // $pdf->Cell(120,7,$row->processor,1,0,'L');
            $pdf->Cell(37,($line * $cellHeight),$row->display_monitor,1,0,'C');
            $pdf->Cell(50,($line * $cellHeight),$row->tgl_input,1,0,'L');
                if($row->stts_monitor == "B"){
                    $status= "BAIK";
                }else if($row->stts_monitor == "R"){
                    $status = "RUSAK";
                }else {$status= "PERBAIKAN";}
            $pdf->Cell(30,($line * $cellHeight),$status,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

// ==========================

// HALAMAN DATA ASET PRINTER
    # Download data Aset Printer
    public function downloadPrinter()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_printer');
        $this->db->order_by('id_aset',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Data Aset Printer');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Data Aset Printer',0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(30,8,'ID/Kode',1,0,'C',1);
        $pdf->Cell(50,8,'Merk',1,0,'C',1);
        $pdf->Cell(70,8,'SN',1,0,'C',1);
        $pdf->Cell(37,8,'Tipe Printer',1,0,'C',1);
        $pdf->Cell(50,8,'Input',1,0,'C',1);
        $pdf->Cell(30,8,'Status',1,1,'C',1);
        $no = 1;

        foreach ($data as $row) {
            $cellWidth = 70; //atur lebar cell
            $cellHeight= 7; //tinggi sel satu baris normal

            //Periksa jika melebihi batas kolom
            if($pdf->GetStringWidth($row->sn_aset) < $cellWidth){
                //jika tidak, maka biar saja
                $line = 1;
            }else{
                // jika iya(melebihi) maka hitung ketinggian yang dibutuhkan sel untuk dirapikan
                // dengan memisahkan teks agar sesuai dengan lebar sel
                // lalu hitung banyak baris yang dibutuhkan agar teks pas dengan cell
                $textLength = strlen($row->sn_aset); //panjangan text 
                $errMargin  = 5; // margin kesalahan lebar cell
                $startChar  = 0; // posisi awal karakter untuk setiap baris
                $maxChar    = 0; // maksimum karkater yang akan ditambahkan dalam satu baris
                $textArray  = array(); //untuk menampung data dalam setiap baris
                $tmpString  = "";//untuk menampung data dalam setiap baris (temporary)

                while ($startChar < $textLength) {
                    # code...
                    //looping sampai akhir teks
                    // atau looping sampai maksimum karakter tercapai
                    while ($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength) {
                        # code...
                        $maxChar++;
                        $tmpString = substr($row->sn_aset,$startChar,$maxChar);
                    }
                    // pindahkan ke baris selanjutnya
                    $startChar = $startChar + $maxChar;
                    // tambahkan ke dalam array agar tahu banyak baris yang dibutuhkan
                    array_push($textArray,$tmpString);
                    // reset variable penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                // Dapatkan jumlah baris
                $line = count($textArray);
            }
            # code...
            // $kode  = $row->kode_fakultas;
            // $hit = $this->db->query("SELECT * FROM tb_prodi where kode_fakultas='$kode'");

            $pdf->Cell(10,($line * $cellHeight),$no++,1,0,'C');
            $pdf->Cell(30,($line * $cellHeight),$row->id_aset,1,0,'C'); 
            $pdf->Cell(50,($line * $cellHeight),$row->merk_aset,1,0,'L'); 
            
            // Manfaatkan MultiCall sebagai ganti Cell
            // atur posisi x,y untuk cell berikutnya agar disebelahnya
            // ingat posisi x dany sebelum menulis MultiCell
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth,$cellHeight,$row->sn_aset,1);
            
            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth , $yPos);
            // $pdf->Cell(120,7,$row->processor,1,0,'L');
            $pdf->Cell(37,($line * $cellHeight),$row->tipe_printer,1,0,'C');
            $pdf->Cell(50,($line * $cellHeight),$row->tgl_input,1,0,'L');
                if($row->stts_printer == "B"){
                    $status= "BAIK";
                }else if($row->stts_printer == "R"){
                    $status = "RUSAK";
                }else {$status= "PERBAIKAN";}
            $pdf->Cell(30,($line * $cellHeight),$status,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

// ==========================
// HALAMAN DOWNLOAD MANAJEMEN ASET
    # Download data Aset laptop yang sedang dipinjam
    public function downloadLaptopOut()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_laptop');
        $this->db->where('stts_pinjam',"Y");
        $this->db->order_by('id_aset',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Aset Laptop Sedang Dipinjam');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Aset Laptop Sedang Dipinjam',0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(20,8,'ID/Kode',1,0,'C',1);
        $pdf->Cell(25,8,'Merk',1,0,'C',1);
        $pdf->Cell(50,8,'SN',1,0,'C',1);
        $pdf->Cell(62,8,'Processor',1,0,'C',1);
        $pdf->Cell(20,8,'RAM(Gb)',1,0,'C',1);
        $pdf->Cell(20,8,'HDD(Gb)',1,0,'C',1);
        $pdf->Cell(40,8,'Input',1,0,'C',1);
        $pdf->Cell(30,8,'Status',1,1,'C',1);
        $no = 1;

        foreach ($data as $row) {
            $cellWidth = 62; //atur lebar cell
            $cellHeight= 7; //tinggi sel satu baris normal

            //Periksa jika melebihi batas kolom
            if($pdf->GetStringWidth($row->processor) < $cellWidth){
                //jika tidak, maka biar saja
                $line = 1;
            }else{
                // jika iya(melebihi) maka hitung ketinggian yang dibutuhkan sel untuk dirapikan
                // dengan memisahkan teks agar sesuai dengan lebar sel
                // lalu hitung banyak baris yang dibutuhkan agar teks pas dengan cell
                $textLength = strlen($row->processor); //panjangan text 
                $errMargin  = 5; // margin kesalahan lebar cell
                $startChar  = 0; // posisi awal karakter untuk setiap baris
                $maxChar    = 0; // maksimum karkater yang akan ditambahkan dalam satu baris
                $textArray  = array(); //untuk menampung data dalam setiap baris
                $tmpString  = "";//untuk menampung data dalam setiap baris (temporary)

                while ($startChar < $textLength) {
                    # code...
                    //looping sampai akhir teks
                    // atau looping sampai maksimum karakter tercapai
                    while ($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength) {
                        # code...
                        $maxChar++;
                        $tmpString = substr($row->processor,$startChar,$maxChar);
                    }
                    // pindahkan ke baris selanjutnya
                    $startChar = $startChar + $maxChar;
                    // tambahkan ke dalam array agar tahu banyak baris yang dibutuhkan
                    array_push($textArray,$tmpString);
                    // reset variable penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                // Dapatkan jumlah baris
                $line = count($textArray);
            }
            # code...
            // $kode  = $row->kode_fakultas;
            // $hit = $this->db->query("SELECT * FROM tb_prodi where kode_fakultas='$kode'");

            $pdf->Cell(10,($line * $cellHeight),$no++,1,0,'C');
            $pdf->Cell(20,($line * $cellHeight),$row->id_aset,1,0,'C'); 
            $pdf->Cell(25,($line * $cellHeight),$row->merk_aset,1,0,'L'); 
            $pdf->Cell(50,($line * $cellHeight),$row->sn_aset,1,0,'L'); 
            
            // Manfaatkan MultiCall sebagai ganti Cell
            // atur posisi x,y untuk cell berikutnya agar disebelahnya
            // ingat posisi x dany sebelum menulis MultiCell
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth,$cellHeight,$row->processor,1);
            
            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth , $yPos);
            // $pdf->Cell(120,7,$row->processor,1,0,'L');
            $pdf->Cell(20,($line * $cellHeight),$row->ram,1,0,'C');
            $pdf->Cell(20,($line * $cellHeight),$row->hdd,1,0,'C');
            $pdf->Cell(40,($line * $cellHeight),$row->tgl_input,1,0,'L');
                if($row->stts_laptop == "B"){
                    $status= "BAIK";
                }else if($row->stts_laptop == "R"){
                    $status = "RUSAK";
                }else {$status= "PERBAIKAN";}
            $pdf->Cell(30,($line * $cellHeight),$status,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

    # Download data Aset Monitor Yang segang di pinjam
    public function downloadMonitorOut()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_monitor');
        $this->db->where('stts_pinjam',"Y");
        $this->db->order_by('id_aset',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Aset Monitor Sedang Dipinjam');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Aset Monitor Sedang Dipinjam',0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(30,8,'ID/Kode',1,0,'C',1);
        $pdf->Cell(50,8,'Merk',1,0,'C',1);
        $pdf->Cell(70,8,'SN',1,0,'C',1);
        $pdf->Cell(37,8,'Display (Inch)',1,0,'C',1);
        $pdf->Cell(50,8,'Input',1,0,'C',1);
        $pdf->Cell(30,8,'Status',1,1,'C',1);
        $no = 1;

        foreach ($data as $row) {
            $cellWidth = 70; //atur lebar cell
            $cellHeight= 7; //tinggi sel satu baris normal

            //Periksa jika melebihi batas kolom
            if($pdf->GetStringWidth($row->sn_aset) < $cellWidth){
                //jika tidak, maka biar saja
                $line = 1;
            }else{
                // jika iya(melebihi) maka hitung ketinggian yang dibutuhkan sel untuk dirapikan
                // dengan memisahkan teks agar sesuai dengan lebar sel
                // lalu hitung banyak baris yang dibutuhkan agar teks pas dengan cell
                $textLength = strlen($row->sn_aset); //panjangan text 
                $errMargin  = 5; // margin kesalahan lebar cell
                $startChar  = 0; // posisi awal karakter untuk setiap baris
                $maxChar    = 0; // maksimum karkater yang akan ditambahkan dalam satu baris
                $textArray  = array(); //untuk menampung data dalam setiap baris
                $tmpString  = "";//untuk menampung data dalam setiap baris (temporary)

                while ($startChar < $textLength) {
                    # code...
                    //looping sampai akhir teks
                    // atau looping sampai maksimum karakter tercapai
                    while ($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength) {
                        # code...
                        $maxChar++;
                        $tmpString = substr($row->sn_aset,$startChar,$maxChar);
                    }
                    // pindahkan ke baris selanjutnya
                    $startChar = $startChar + $maxChar;
                    // tambahkan ke dalam array agar tahu banyak baris yang dibutuhkan
                    array_push($textArray,$tmpString);
                    // reset variable penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                // Dapatkan jumlah baris
                $line = count($textArray);
            }
            # code...
            // $kode  = $row->kode_fakultas;
            // $hit = $this->db->query("SELECT * FROM tb_prodi where kode_fakultas='$kode'");

            $pdf->Cell(10,($line * $cellHeight),$no++,1,0,'C');
            $pdf->Cell(30,($line * $cellHeight),$row->id_aset,1,0,'C'); 
            $pdf->Cell(50,($line * $cellHeight),$row->merk_aset,1,0,'L'); 
            
            // Manfaatkan MultiCall sebagai ganti Cell
            // atur posisi x,y untuk cell berikutnya agar disebelahnya
            // ingat posisi x dany sebelum menulis MultiCell
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth,$cellHeight,$row->sn_aset,1);
            
            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth , $yPos);
            // $pdf->Cell(120,7,$row->processor,1,0,'L');
            $pdf->Cell(37,($line * $cellHeight),$row->display_monitor,1,0,'C');
            $pdf->Cell(50,($line * $cellHeight),$row->tgl_input,1,0,'L');
                if($row->stts_monitor == "B"){
                    $status= "BAIK";
                }else if($row->stts_monitor == "R"){
                    $status = "RUSAK";
                }else {$status= "PERBAIKAN";}
            $pdf->Cell(30,($line * $cellHeight),$status,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

    # Download data Aset Printer
    public function downloadPrinterOut()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_printer');
        $this->db->where('stts_pinjam',"Y");
        $this->db->order_by('id_aset',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Aset Printer Sedang Dipinjam');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Aset Printer Sedang Dipinjam',0,1,'C');

        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(30,8,'ID/Kode',1,0,'C',1);
        $pdf->Cell(50,8,'Merk',1,0,'C',1);
        $pdf->Cell(70,8,'SN',1,0,'C',1);
        $pdf->Cell(37,8,'Tipe Printer',1,0,'C',1);
        $pdf->Cell(50,8,'Input',1,0,'C',1);
        $pdf->Cell(30,8,'Status',1,1,'C',1);
        $no = 1;

        foreach ($data as $row) {
            $cellWidth = 70; //atur lebar cell
            $cellHeight= 7; //tinggi sel satu baris normal

            //Periksa jika melebihi batas kolom
            if($pdf->GetStringWidth($row->sn_aset) < $cellWidth){
                //jika tidak, maka biar saja
                $line = 1;
            }else{
                // jika iya(melebihi) maka hitung ketinggian yang dibutuhkan sel untuk dirapikan
                // dengan memisahkan teks agar sesuai dengan lebar sel
                // lalu hitung banyak baris yang dibutuhkan agar teks pas dengan cell
                $textLength = strlen($row->sn_aset); //panjangan text 
                $errMargin  = 5; // margin kesalahan lebar cell
                $startChar  = 0; // posisi awal karakter untuk setiap baris
                $maxChar    = 0; // maksimum karkater yang akan ditambahkan dalam satu baris
                $textArray  = array(); //untuk menampung data dalam setiap baris
                $tmpString  = "";//untuk menampung data dalam setiap baris (temporary)

                while ($startChar < $textLength) {
                    # code...
                    //looping sampai akhir teks
                    // atau looping sampai maksimum karakter tercapai
                    while ($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength) {
                        # code...
                        $maxChar++;
                        $tmpString = substr($row->sn_aset,$startChar,$maxChar);
                    }
                    // pindahkan ke baris selanjutnya
                    $startChar = $startChar + $maxChar;
                    // tambahkan ke dalam array agar tahu banyak baris yang dibutuhkan
                    array_push($textArray,$tmpString);
                    // reset variable penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                // Dapatkan jumlah baris
                $line = count($textArray);
            }
            # code...
            // $kode  = $row->kode_fakultas;
            // $hit = $this->db->query("SELECT * FROM tb_prodi where kode_fakultas='$kode'");

            $pdf->Cell(10,($line * $cellHeight),$no++,1,0,'C');
            $pdf->Cell(30,($line * $cellHeight),$row->id_aset,1,0,'C'); 
            $pdf->Cell(50,($line * $cellHeight),$row->merk_aset,1,0,'L'); 
            
            // Manfaatkan MultiCall sebagai ganti Cell
            // atur posisi x,y untuk cell berikutnya agar disebelahnya
            // ingat posisi x dany sebelum menulis MultiCell
            $xPos=$pdf->GetX();
            $yPos=$pdf->GetY();
            $pdf->MultiCell($cellWidth,$cellHeight,$row->sn_aset,1);
            
            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth , $yPos);
            // $pdf->Cell(120,7,$row->processor,1,0,'L');
            $pdf->Cell(37,($line * $cellHeight),$row->tipe_printer,1,0,'C');
            $pdf->Cell(50,($line * $cellHeight),$row->tgl_input,1,0,'L');
                if($row->stts_printer == "B"){
                    $status= "BAIK";
                }else if($row->stts_printer == "R"){
                    $status = "RUSAK";
                }else {$status= "PERBAIKAN";}
            $pdf->Cell(30,($line * $cellHeight),$status,1,1,'C');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

    #Proses Doenload Transaksi Peminjaman Laptop
    public function downloadTrxPinjamLaptop()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_trx_pinjam');
        $this->db->join('tb_user','tb_user.id_user=tb_trx_pinjam.id_user','left');
        $this->db->like('id_aset',"ICT-1");
        $this->db->order_by('id_trx_pinjam',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Transaksi Peminjaman Laptop');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Transaksi Peminjaman Laptop',0,1,'C');
        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(55,8,'ID Transaksi',1,0,'C',1);
        $pdf->Cell(25,8,'ID Aset',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl Pinjam',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl Kembali',1,0,'C',1);
        $pdf->Cell(30,8,'User',1,0,'C',1);
        $pdf->Cell(35,8,'Diserahkan Opr.',1,0,'C',1);
        $pdf->Cell(35,8,'Diterima Opr.',1,0,'C',1);
        $pdf->Cell(28,8,'Terlambat.',1,1,'C',1);
        $no = 1;

        foreach ($data as $row){
            $pdf->Cell(10,7,$no++,1,0,'C');       
            $pdf->Cell(55,7,$row->id_pinjam,1,0,'L');
            $pdf->Cell(25,7,$row->id_aset,1,0,'L');
            $pdf->Cell(30,7,date("d-M-Y",strtotime($row->tgl_pinjam)),1,0,'L');
            if($row->tgl_kembali == "0000-00-00"){
                $balik = "-";
            }else {
                $balik = date("d-M-Y",strtotime($row->tgl_kembali));
            }
            $pdf->Cell(30,7,$balik,1,0,'L');
            $pdf->Cell(30,7,$row->username,1,0,'L');
            $pdf->Cell(35,7,$row->operator,1,0,'L');
            $pdf->Cell(35,7,$row->operator_update,1,0,'L');
            if($row->keterlambatan < 1){
                $harilambat = ' - ';
            }else{
                $harilambat = $row->keterlambatan.' Hari';
            }
            $pdf->Cell(28,7,$harilambat,1,1,'L');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
        
    }

    #Proses Doenload Transaksi Peminjaman Monitor
    public function downloadTrxPinjamMonitor()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_trx_pinjam');
        $this->db->join('tb_user','tb_user.id_user=tb_trx_pinjam.id_user','left');
        $this->db->like('id_aset',"ICT-2");
        $this->db->order_by('id_trx_pinjam',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Transaksi Peminjaman Monitor');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Transaksi Peminjaman Monitor',0,1,'C');
        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(55,8,'ID Transaksi',1,0,'C',1);
        $pdf->Cell(25,8,'ID Aset',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl Pinjam',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl Kembali',1,0,'C',1);
        $pdf->Cell(30,8,'User',1,0,'C',1);
        $pdf->Cell(35,8,'Diserahkan Opr.',1,0,'C',1);
        $pdf->Cell(35,8,'Diterima Opr.',1,0,'C',1);
        $pdf->Cell(28,8,'Terlambat.',1,1,'C',1);
        $no = 1;

        foreach ($data as $row){
            $pdf->Cell(10,7,$no++,1,0,'C');       
            $pdf->Cell(55,7,$row->id_pinjam,1,0,'L');
            $pdf->Cell(25,7,$row->id_aset,1,0,'L');
            $pdf->Cell(30,7,date("d-M-Y",strtotime($row->tgl_pinjam)),1,0,'L');
            if($row->tgl_kembali == "0000-00-00"){
                $balik = "-";
            }else {
                $balik = date("d-M-Y",strtotime($row->tgl_kembali));
            }
            $pdf->Cell(30,7,$balik,1,0,'L');
            $pdf->Cell(30,7,$row->username,1,0,'L');
            $pdf->Cell(35,7,$row->operator,1,0,'L');
            $pdf->Cell(35,7,$row->operator_update,1,0,'L');
            if($row->keterlambatan < 1){
                $harilambat = ' - ';
            }else{
                $harilambat = $row->keterlambatan.' Hari';
            }
            $pdf->Cell(28,7,$harilambat,1,1,'L');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
        
    }

    #Proses Doenload Transaksi Peminjaman Printer
    public function downloadTrxPinjamPrinter()
    {
        // Load Database
        $this->db->select('*');
        $this->db->from('tb_trx_pinjam');
        $this->db->join('tb_user','tb_user.id_user=tb_trx_pinjam.id_user','left');
        $this->db->like('id_aset',"ICT-3");
        $this->db->order_by('id_trx_pinjam',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Transaksi Peminjaman Printer');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Transaksi Peminjaman Printer',0,1,'C');
        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(55,8,'ID Transaksi',1,0,'C',1);
        $pdf->Cell(25,8,'ID Aset',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl Pinjam',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl Kembali',1,0,'C',1);
        $pdf->Cell(30,8,'User',1,0,'C',1);
        $pdf->Cell(35,8,'Diserahkan Opr.',1,0,'C',1);
        $pdf->Cell(35,8,'Diterima Opr.',1,0,'C',1);
        $pdf->Cell(28,8,'Terlambat.',1,1,'C',1);
        $no = 1;

        foreach ($data as $row){
            $pdf->Cell(10,7,$no++,1,0,'C');       
            $pdf->Cell(55,7,$row->id_pinjam,1,0,'L');
            $pdf->Cell(25,7,$row->id_aset,1,0,'L');
            $pdf->Cell(30,7,date("d-M-Y",strtotime($row->tgl_pinjam)),1,0,'L');
            if($row->tgl_kembali == "0000-00-00"){
                $balik = "-";
            }else {
                $balik = date("d-M-Y",strtotime($row->tgl_kembali));
            }
            $pdf->Cell(30,7,$balik,1,0,'L');
            $pdf->Cell(30,7,$row->username,1,0,'L');
            $pdf->Cell(35,7,$row->operator,1,0,'L');
            $pdf->Cell(35,7,$row->operator_update,1,0,'L');
            if($row->keterlambatan < 1){
                $harilambat = ' - ';
            }else{
                $harilambat = $row->keterlambatan.' Hari';
            }
            $pdf->Cell(28,7,$harilambat,1,1,'L');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
        
    }

    #Proses Download Transaksi Yang Sudah DIFILTER per kategori dan tanggal
    public function downloadFilterTrx()
    {
        $aset   = $this->input->post('aset',TRUE);
        $tgl1 	=$this->input->post('tglfilter',FALSE);
		$tgl 	= explode('s/d',$tgl1);
        // echo $aset.'<br>'.$tgl1.'<br>'.date("Y-m-d",strtotime($tgl[0])).'<br>'.date("Y-m-d",strtotime($tgl[1]));

        // Load Database
        $this->db->select('*');
        $this->db->from('tb_trx_pinjam');
        $this->db->join('tb_user','tb_user.id_user=tb_trx_pinjam.id_user','left');
        if($aset == "1"){
            $this->db->like('id_aset',"ICT-1");
        }else if($aset == "2"){
            $this->db->like('id_aset',"ICT-2");
        }else {
            $this->db->like('id_aset',"ICT-3");
        }
        $this->db->where('tgl_pinjam >=',date("Y-m-d",strtotime($tgl[0])));
        $this->db->where('tgl_pinjam <=',date("Y-m-d",strtotime($tgl[1])));
        $this->db->order_by('id_trx_pinjam',"ASC");
        $data = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L');
        $pdf->AddPage();    
        /* ./ TEMPLATE  HEADER */  

        // CONTENT
        // Title Page
        $pdf->SetFont('Arial','',10);
        $pdf->SetTitle('VMA | Daftar Transaksi Peminjaman Printer');

        // JUDUL FORM 
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(290,7,'Daftar Transaksi Peminjaman Printer',0,1,'C');
        // Table
        // Header Table
        $pdf->SetLeftMargin('10');
        $pdf->Cell(290,7,'',0,1,'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,8,'No',1,0,'C',1);       
        $pdf->Cell(55,8,'ID Transaksi',1,0,'C',1);
        $pdf->Cell(25,8,'ID Aset',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl Pinjam',1,0,'C',1);
        $pdf->Cell(30,8,'Tgl Kembali',1,0,'C',1);
        $pdf->Cell(30,8,'User',1,0,'C',1);
        $pdf->Cell(35,8,'Diserahkan Opr.',1,0,'C',1);
        $pdf->Cell(35,8,'Diterima Opr.',1,0,'C',1);
        $pdf->Cell(28,8,'Terlambat.',1,1,'C',1);
        $no = 1;

        foreach ($data as $row){
            $pdf->Cell(10,7,$no++,1,0,'C');       
            $pdf->Cell(55,7,$row->id_pinjam,1,0,'L');
            $pdf->Cell(25,7,$row->id_aset,1,0,'L');
            $pdf->Cell(30,7,date("d-M-Y",strtotime($row->tgl_pinjam)),1,0,'L');
            if($row->tgl_kembali == "0000-00-00"){
                $balik = "-";
            }else {
                $balik = date("d-M-Y",strtotime($row->tgl_kembali));
            }
            $pdf->Cell(30,7,$balik,1,0,'L');
            $pdf->Cell(30,7,$row->username,1,0,'L');
            $pdf->Cell(35,7,$row->operator,1,0,'L');
            $pdf->Cell(35,7,$row->operator_update,1,0,'L');
            if($row->keterlambatan < 1){
                $harilambat = ' - ';
            }else{
                $harilambat = $row->keterlambatan.' Hari';
            }
            $pdf->Cell(28,7,$harilambat,1,1,'L');
        }

        /** TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        /** ./ TEMPLATE FOOTER dan output */
    }

// ==========================

}