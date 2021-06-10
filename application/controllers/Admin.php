<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(TRUE);
        $this->load->model('M_Admin');
		cek_nologin();
		cek_admin();
        
    }


// HALAMAN DATA ASET LAPTOP
	public function laptop()
	{
		$data = array (
			'judul' => "VMA | Data Aset Laptop",
			'row'	=> $this->M_Admin->getDataLaptop(),
			'rowId'	=> $this->M_Admin->genIDLaptop() 	// Auto Generate ID Aset Laptop
			// 'rowlvl'=> $this->M_Admin->getDataLevel()
		);
		$this->template->load('template', 'admin/laptop',$data);
	}

	#Proses Tambah Data Aset Laptop
	public function tambahLaptop()
	{
		$id			= $this->input->post('idlaptop',TRUE);
		$merk		= $this->input->post('merk',TRUE);
		$seri		= $this->input->post('seri',TRUE);
		$processor	= $this->input->post('processor',TRUE);
		$ram		= $this->input->post('ram',TRUE);
		$hdd		= $this->input->post('hdd',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		$data = array(
			'id_aset' 	=> $id,
			'merk_aset'	=> $merk,
			'sn_aset'		=> $seri,
			'processor'		=> $processor,
			'ram'			=> $ram,
			'hdd'			=> $hdd,
			'tgl_input'		=> $today,
			'tgl_update'	=> "0000-00-00 00:00:00",
			'stts_laptop'	=> "B",
			'stts_pinjam'	=> "N"
		);

		$this->M_Admin->addLaptop($data,'tb_laptop');
		$this->session->set_flashdata('flash','ditambah');
		redirect('Admin/laptop');
	}

	#Proses Edit Data Aset Laptop
	public function editLaptop()
	{
		$id			= $this->input->post('idlaptop',TRUE);
		$merk		= $this->input->post('merk',TRUE);
		$seri		= $this->input->post('seri',TRUE);
		$processor	= $this->input->post('processor',TRUE);
		$ram		= $this->input->post('ram',TRUE);
		$hdd		= $this->input->post('hdd',TRUE);
		$status		= $this->input->post('status',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		$data = array(
			'merk_aset'	=> $merk,
			'sn_aset'		=> $seri,
			'processor'		=> $processor,
			'ram'			=> $ram,
			'hdd'			=> $hdd,
			'tgl_update'	=> $today,
			'stts_laptop'	=> $status
		);

		// $where = array('id_aset' => $id, );

		$this->M_Admin->updateLaptop($data,'tb_laptop',$id);
		if($this->db->affected_rows()){
            $this->session->set_flashdata('flash','diubah');
            redirect('Admin/laptop');
        }else{
            $this->session->set_flashdata('flash_error','diubah');
            redirect('Admin/laptop');
        }
	}

	#Proses Hapus Data Aset Laptop
	public function hapusLaptop()
	{
		$id 	= decrypt_url($this->uri->segment(3));

		$this->M_Admin->delLaptop('tb_laptop',$id);
        if($this->db->affected_rows()){
            $this->session->set_flashdata('flash','dihapus');
            redirect('Admin/laptop');
        }else{
            $this->session->set_flashdata('flash_error','dihapus');
            redirect('Admin/laptop');
        }
	}
//============================

// HALAMAN DATA SET MONITOR
	public function monitor()
	{
		$data = array (
			'judul' => "VMA | Data Aset Monitor",
			'row'	=> $this->M_Admin->getDataMonitor(),
			'rowId'	=> $this->M_Admin->genIDMonitor() 	// Auto Generate ID Aset MONITOR
			// 'rowlvl'=> $this->M_Admin->getDataLevel()
		);
		$this->template->load('template', 'admin/monitor',$data);
	}

	#Proses Tambah Data Aset Monitor
	public function tambahMonitor()
	{
		$id			= $this->input->post('idmonitor',TRUE);
		$merk		= $this->input->post('merk',TRUE);
		$seri		= $this->input->post('seri',TRUE);
		$display	= $this->input->post('display',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		$data = array(
			'id_aset' 	=> $id,
			'merk_aset'	=> $merk,
			'sn_aset'	=> $seri,
			'display_monitor'=> $display,
			'tgl_input'		=> $today,
			'tgl_update'	=> "0000-00-00 00:00:00",
			'stts_monitor'	=> "B",
			'stts_pinjam'	=> "N"
		);

		$this->M_Admin->addMonitor($data,'tb_monitor');
		$this->session->set_flashdata('flash','ditambah');
		redirect('Admin/monitor');
	}

	#Proses Edit Data Aset Monitor
	public function editMonitor()
	{
		$id			= $this->input->post('idmonitor',TRUE);
		$merk		= $this->input->post('merk',TRUE);
		$seri		= $this->input->post('seri',TRUE);
		$display	= $this->input->post('display',TRUE);
		$status		= $this->input->post('status',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		$data = array(
			'merk_aset'	=> $merk,
			'sn_aset'	=> $seri,
			'display_monitor'=> $display,
			'tgl_update'	=> $today,
			'stts_monitor'	=> $status
		);

		$this->M_Admin->updateMonitor($data,'tb_monitor',$id);
		if($this->db->affected_rows()){
            $this->session->set_flashdata('flash','diubah');
            redirect('Admin/monitor');
        }else{
            $this->session->set_flashdata('flash_error','diubah');
            redirect('Admin/monitor');
        }
	}

	#Proses Hapus Data Aset Monitor
	public function hapusMonitor()
	{
		$id 	= decrypt_url($this->uri->segment(3));

		$this->M_Admin->delMonitor('tb_monitor',$id);
        if($this->db->affected_rows()){
            $this->session->set_flashdata('flash','dihapus');
            redirect('Admin/monitor');
        }else{
            $this->session->set_flashdata('flash_error','dihapus');
            redirect('Admin/monitor');
        }
	}
//============================

// HALAMAN DATA SET PRINTER
	public function printer()
	{
		$data = array (
			'judul' => "VMA | Data Aset Printer",
			'row'	=> $this->M_Admin->getDataPrinter(),
			'rowId'	=> $this->M_Admin->genIDPrinter() 	// Auto Generate ID Aset MONITOR
			// 'rowlvl'=> $this->M_Admin->getDataLevel()
		);
		$this->template->load('template', 'admin/printer',$data);
	}
	#Proses Tambah Data Aset Printer
	public function tambahPrinter()
	{
		$id			= $this->input->post('idprinter',TRUE);
		$merk		= $this->input->post('merk',TRUE);
		$seri		= $this->input->post('seri',TRUE);
		$tipe		= $this->input->post('tipe',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		$data = array(
			'id_aset' 	=> $id,
			'merk_aset'	=> $merk,
			'sn_aset'	=> $seri,
			'tipe_printer'	=> $tipe,
			'tgl_input'		=> $today,
			'tgl_update'	=> "0000-00-00 00:00:00",
			'stts_printer'	=> "B",
			'stts_pinjam'	=> "N"
		);

		$this->M_Admin->addPrinter($data,'tb_printer');
		$this->session->set_flashdata('flash','ditambah');
		redirect('Admin/printer');
	}

	#Proses Edit Data Aset Printer
	public function editPrinter()
	{
		$id			= $this->input->post('idprinter',TRUE);
		$merk		= $this->input->post('merk',TRUE);
		$seri		= $this->input->post('seri',TRUE);
		$tipe		= $this->input->post('tipe',TRUE);
		$status		= $this->input->post('status',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		$data = array(
			'merk_aset'	=> $merk,
			'sn_aset'	=> $seri,
			'tipe_printer'	=> $tipe,
			'tgl_update'	=> $today,
			'stts_printer'	=> $status
		);

		$this->M_Admin->updatePrinter($data,'tb_printer',$id);
		if($this->db->affected_rows()){
            $this->session->set_flashdata('flash','diubah');
            redirect('Admin/printer');
        }else{
            $this->session->set_flashdata('flash_error','diubah');
            redirect('Admin/printer');
        }
	}

	#Proses Hapus Data Aset Printer
	public function hapusPrinter()
	{
		$id 	= decrypt_url($this->uri->segment(3));

		$this->M_Admin->delPrinter('tb_printer',$id);
        if($this->db->affected_rows()){
            $this->session->set_flashdata('flash','dihapus');
            redirect('Admin/printer');
        }else{
            $this->session->set_flashdata('flash_error','dihapus');
            redirect('Admin/printer');
        }
	}
//============================

//HALAMAN DATA USER
	public function user()
	{
		$data = array (
			'judul' => "VMA | Data User",
			'row'	=> $this->M_Admin->getDataUser(),
			'rowlvl'=> $this->M_Admin->getDataLevel()
		);
		$this->template->load('template', 'admin/user',$data);
	}

	public function cekUname()
	{
		$username = $this->input->post('username',TRUE);
		if($username != ''){
			$cek = $this->db->query("SELECT * FROM tb_user WHERE username='$username'");
			if($cek->num_rows() > 0){
				echo "<cite class='text-danger'> Username sudah dipakai ! <i class='far fa-hand-paper'></i></cite>";
			}else{
				echo "<cite class='text-success'> Username tersedia ! <i class='far fa-thumbs-up'></i></cite>";
			}
		}else{
			echo "<cite class='text-danger'> Username tidak boleh kosong ! <i class='far fa-hand-paper'></i></cite>";
		}
	}

	#Proses TAMBAH USER
	public function tambahUser()
	{
		$fullname 	= $this->input->post('fullname',TRUE);
		$username	= $this->input->post('username',TRUE);
		$pass  		= md5($this->input->post('password',TRUE));
		$level 		= $this->input->post('level',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		// echo $fullname,'/',$username,'/',$pass,'/',$level,'/',$today;

		$data = array(
			'fullname'	=> $fullname,
			'username'	=> $username,
			'pass_user'	=> $pass,
			'userlevel'	=> $level,
			'tgl_input'	=> $today,
			'stts_user'	=> "Y"
		);

		$cek = $this->db->query("SELECT * FROM tb_user WHERE username='$username'");
		if($cek->num_rows() > 0){
			$this->session->set_flashdata('flash_error','ditambah');
			redirect('Admin/user');
		}else{
			$this->M_Admin->addUser($data,'tb_user');
			$this->session->set_flashdata('flash','ditambah');
			redirect('Admin/user');
		}

	}

	#Proses Edit User
	public function editUser()
	{
		$id 		= $this->input->post('iduser',TRUE);
		$fullname 	= $this->input->post('fullname',TRUE);
		$level 		= $this->input->post('level',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		$data = array(
			'fullname' 	=> $fullname,
			'userlevel'		=> $level,
			'tgl_input'	=> $today
		);

		$this->M_Admin->updateUser($data,'tb_user',$id);
		$this->session->set_flashdata('flash','diubah');
		redirect('Admin/user');
	}

	#Proses Reset Password User
	public function resetPass()
	{
		$id 		= $this->input->post('iduser',TRUE);
		$pass		= $this->input->post('userpass',TRUE);
		$today 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

		$data = array(
			'pass_user' => md5($pass), 
			'tgl_input'	=> $today
		);

		$this->M_Admin->updateUser($data,'tb_user',$id);
		$this->session->set_flashdata('flash','diubah');
		redirect('Admin/user');
	}
	
	#PRoses Tukar Status User
	public function switchStatus()
	{
		$id 	= decrypt_url($this->uri->segment(3));
		$stts 	= decrypt_url($this->uri->segment(4));
		$today 	= gmdate("Y-m-d H:i:s", time()+60*60*7);

		if($stts == "Y"){
			$stts_baru = "N";
		}else{$stts_baru = "Y";}

		$data = array(
			'stts_user' => $stts_baru,
			'tgl_input'	=> $today
		);		

		$this->M_Admin->updateUser($data,'tb_user',$id);
		$this->session->set_flashdata('flash','diubah');
		redirect('Admin/user');		
	}
//============================


}
