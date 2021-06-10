<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_nologin();
		cek_admin_2();
		$this->load->model('M_Manajemen');
		
	}

	public function index()
	{
		// cek_yeslogin();
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);
		$data = array (
            'judul' 	=> "VMA | Manajemen Aset",
			'rowUser'	=> $this->M_Manajemen->getDataUser(),
			'rowIdTrx'	=> $this->M_Manajemen->genIdTrx($today), 				// Auto Generate id Transaksi
			'rowlt'		=> $this->M_Manajemen->getLaptopPinjam(),				// Get data transaksi peminjaman Laptop
			'rowmt'		=> $this->M_Manajemen->getMonitorPinjam(),				// Get data transaksi peminjaman Monitor
			'rowpt'		=> $this->M_Manajemen->getPrinterPinjam(),				// Get data transaksi peminjaman Printer
        );
        $this->template->load('template', 'manajemen/manajemen',$data);
	}

	#Proses mencari Aset untuk keperluan LINK SELECT dari perubahan data JENIS ASET
	public function cariAset()
	{
		$jenis = $this->input->post('jenis',TRUE);
		if($jenis == "laptop"){
			$data = $this->M_Manajemen->getAsetLaptopFree();	// Mencari aset laptop yang tidak dipinjam
		}else if($jenis == "monitor"){
			$data = $this->M_Manajemen->getAsetMonitorFree();	// Mencari aset Monitor yang tidak dipinjam
		}else if($jenis == "printer"){
			$data = $this->M_Manajemen->getAsetPrinterFree();	// Mencari aset Printer yang tidak dipinjam
		}

		echo json_encode($data);
	}

	#Proses Tambah Transaksi Peminjaman Aset
	public function trxTambahPinjam()
	{
		$id		= $this->input->post('idtrx',TRUE);
		$tgl1 	=$this->input->post('tglpinjam',FALSE);
		$tgl 	= explode('s/d',$tgl1);
		// $tglawal = $tgl[0];
		// $tglakhir = date("Y-m-d",strtotime($tgl[1]));
		$idaset = $this->input->post('idaset',TRUE);
		$aset = $this->input->post('aset',TRUE);
		$user 	= $this->input->post('peminjam',TRUE);
		$operator= $this->input->post('operator',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		// echo $id.'<br>';
		// echo $tgl1.'<br>';
		// echo date("Y-m-d",strtotime($tglawal)).' '.$tglakhir.'<br>';
		// echo $idaset.'<br>';
		// echo $user.'<br>';
		// echo $operator.'<br>';
		// echo $today.'<br>';

		$data = array(
			'id_pinjam'		=> $id,
			'tgl_pinjam'	=> date("Y-m-d",strtotime($tgl[0])),
			'tgl_bts_pinjam'=> date("Y-m-d",strtotime($tgl[1])),
			'tgl_kembali'	=> '',
			'id_aset'		=> $idaset,
			'id_user'		=> $user,
			'operator'		=> $operator,
			'operator_update'=> '',
			'tgl_trx_input'	=> $today,
			'tgl_trx_update'=> '',
			'keterlambatan' => ''
		);

		$data2 = array('stts_pinjam' => "Y", );

		$this->M_Manajemen->trxTambahPinjam($data,'tb_trx_pinjam');
		if($this->db->affected_rows()){
			if($aset == "laptop"){
				$this->M_Manajemen->switchAsetLaptop($idaset,'tb_laptop',$data2);
			}else if($aset == "monitor"){
				$this->M_Manajemen->switchAsetMonitor($idaset,'tb_monitor',$data2);
			}else{
				$this->M_Manajemen->switchAsetPrinter($idaset,'tb_printer',$data2);
			}
			$this->session->set_flashdata('flash','ditambah');
			redirect('Manajemen');
		}else{
			$this->session->set_flashdata('flash_error','ditambah');
            redirect('Manajemen');
		}
	}

	public function trxPengembalian()
	{
		$id		= decrypt_url($this->uri->segment(3));
		$idaset	= decrypt_url($this->uri->segment(4));
		$aset	= $this->uri->segment(5);
		$exp	= $this->uri->segment(6);
		$operator 		= $this->fungsi->user_login()->username;
		$today 			= gmdate("Y-m-d H:i:s", time()+60*60*7);
		// $pengembalian 	= gmdate("Y-m-d", time()+60*60*7);
		$batas  = date_create($exp);
		$pengembalian 	= date_create();
		$selisih		= date_diff($pengembalian,$batas);
		// echo "ID".$id.'<br>';
		// echo "IDASET ".$idaset.'<br>';
		// echo "OPERATOR ".$operator.'<br>';
		// echo "KEMBALI ".$pengembalian.'<br>';
		// echo "Today ".$today.'<br>';
		// echo "ASET ".$aset.'<br>';
		// echo $selisih->days.'<br>';
		// echo date_format($pengembalian,"Y-m-d");

		$data = array(
			'operator_update' 	=> $operator, 
			'tgl_kembali'		=> date_format($pengembalian,"Y-m-d"),
			'tgl_trx_update'	=> $today,
			'keterlambatan'		=> $selisih->days
		);

		$data2 = array('stts_pinjam' => "N", );

		$this->M_Manajemen->trxPengembalian($data,'tb_trx_pinjam',$id);
		if($this->db->affected_rows()){
			if($aset == "1"){
				$this->M_Manajemen->switchAsetLaptop($idaset,'tb_laptop',$data2);
			}else if($aset == "2"){
				$this->M_Manajemen->switchAsetMonitor($idaset,'tb_monitor',$data2);
			}else{
				$this->M_Manajemen->switchAsetPrinter($idaset,'tb_printer',$data2);
			}
			$this->session->set_flashdata('flash','ditambah');
			redirect('Manajemen');
		}else{
			$this->session->set_flashdata('flash_error','ditambah');
            redirect('Manajemen');
		}		

	}
}
