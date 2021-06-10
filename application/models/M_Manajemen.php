<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_Manajemen extends CI_Model 
	{
		#
		public function getDataUser()
		{
			$this->db->select('*');
			$this->db->from('tb_user');
			// $this->db->join('tb_level','tb_level.kode_level=tb_user.userlevel','left');
			$this->db->order_by('id_user','ASC');
			$data = $this->db->get();
			return $data->result_array();
		}

		#Proses AutoGenerate ID/Kkode Transaksi
		public function genIdTrx($today)
		{
			$bulan = date('n');
			$query	= $this->db->query("SELECT MAX(id_pinjam) AS maxKode FROM tb_trx_pinjam WHERE month(tgl_trx_input)='$bulan'");
			$row 	= $query->row_array();
			$kode	= $row['maxKode'];
			$nourut = (int)substr($kode,0,16);
			$nourut++;
			$newKode = sprintf("%04s",$nourut);
			return $newKode;
		}

// UNTUK PROSES PENCARIAN ASET YANG TIDAK DI PINJAM DAN DITAMPILKAN PADA SELECT DI FORM INPUT
		#Proses mencari LAPTOP yang tidak dipinjam
		public function getAsetLaptopFree()
		{
			$this->db->select('*');
			$this->db->from('tb_laptop');
			$this->db->where('stts_pinjam !=',"Y");
			$this->db->where('stts_laptop !=',"R");
			$this->db->or_where('stts_pinjam','');
			$this->db->order_by('id_aset','ASC');
			$data = $this->db->get();
			return $data->result_array();

		}
		#Proses mencari MONITOR yang tidak dipinjam
		public function getAsetMonitorFree()
		{
			$this->db->select('*');
			$this->db->from('tb_monitor');
			$this->db->where('stts_pinjam !=',"Y");
			$this->db->where('stts_monitor !=',"R");
			$this->db->order_by('id_aset','ASC');
			$data = $this->db->get();
			return $data->result_array();

		}
		#Proses mencari PRINTER yang tidak dipinjam
		public function getAsetPrinterFree()
		{
			$this->db->select('*');
			$this->db->from('tb_printer');
			$this->db->where('stts_pinjam !=',"Y");
			$this->db->where('stts_printer !=',"R");
			$this->db->order_by('id_aset','ASC');
			$data = $this->db->get();
			return $data->result_array();

		}

// UNTUK DI LOAD DI DALAM TABLE TRANSAKSI PEMINJAMAN ASET
		#Proses mendapatkan data transaksi peminjaman LAPTOP untuk di load di table transaksi
		public function getLaptopPinjam()
		{
			$this->db->select('*');
			$this->db->from('tb_trx_pinjam');
			$this->db->join('tb_user','tb_user.id_user=tb_trx_pinjam.id_user','left');
			// $this->db->join('tb_laptop','tb_laptop.id_aset=tb_trx_pinjam.id_aset','left');
			$this->db->like('tb_trx_pinjam.id_aset','ICT-1');
			$this->db->order_by('tb_trx_pinjam.id_trx_pinjam','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}

		#Proses mendapatkan data transaksi peminjaman MONITOR untuk di load di table transaksi
		public function getMonitorPinjam()
		{
			$this->db->select('*');
			$this->db->from('tb_trx_pinjam');
			$this->db->join('tb_user','tb_user.id_user=tb_trx_pinjam.id_user','left');
			$this->db->like('id_aset','ICT-2');
			$this->db->order_by('tb_trx_pinjam.id_trx_pinjam','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}

		#Proses mendapatkan data transaksi peminjaman PRINTER untuk di load di table transaksi
		public function getPrinterPinjam()
		{
			$this->db->select('*');
			$this->db->from('tb_trx_pinjam');
			$this->db->join('tb_user','tb_user.id_user=tb_trx_pinjam.id_user','left');
			$this->db->like('id_aset','ICT-3');
			$this->db->order_by('tb_trx_pinjam.id_trx_pinjam','DESC');
			$data = $this->db->get();
			return $data->result_array();
		}

// UNTUK PROSES BERKAITAN CRUD TRANSAKSI
		#Proses tambah transaksi peminjaman
		public function trxTambahPinjam($data,$table)
		{
			$insert = $this->db->insert($table,$data);
			return $data;
		}

		#Proses Pengembalian aset
		public function trxPengembalian($data,$table,$id)
		{
			$this->db->where('id_trx_pinjam',$id);
			$this->db->update($table,$data);
		}

// PROSES PERUBAHAN DATA STATUS PINJAM ASET PADA TABEL ASET YANG DI TRIGGER DARI SEKALI PROSES INPUT TRANSAKSI PEMINJAMAN
		#Proses perubahan status pinjam Laptop
		public function switchAsetLaptop($idaset,$table,$data2)
		{
			$this->db->where('id_aset',$idaset);
			$this->db->update($table,$data2);
		}

		#Proses perubahan status pinjam Monitor
		public function switchAsetMonitor($idaset,$table,$data2)
		{
			$this->db->where('id_aset',$idaset);
			$this->db->update($table,$data2);
		}

		#Proses perubahan status pinjam Printer
		public function switchAsetPrinter($idaset,$table,$data2)
		{
			$this->db->where('id_aset',$idaset);
			$this->db->update($table,$data2);
		}

	}