<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model 
{

// FUNGSI yang dipakai untuk Umum
	public function getDataLevel()
	{
		$this->db->order_by('kode_level', 'ASC');
		$data = $this->db->get('tb_level');
		return $data->result_array();
	}

	#Proses Auto Generate ID Aset Laptop
	public function genIDLaptop()
	{
		$prefix 	= 'ICT-1';
		$query	= $this->db->query("SELECT MAX(id_aset) AS maxKode FROM tb_laptop");
		$row 	= $query->row_array();
		$kode	= $row['maxKode'];
		$nourut = (int) substr($kode,5,3); //cara baca nya substr(string,x1,x2) adalah string = ICT-1000; x1=awal baca/scan string dari index kiri; x2= kebalikan dari x1 atau baca index dari kanan
		$nourut++;
		$newKode = $prefix.sprintf("%03s",$nourut);
		return $newKode;
	}

	#Proses Auto Generate ID Aset Monitor
	public function genIDMonitor()
	{
		$prefix 	= 'ICT-2';
		$query	= $this->db->query("SELECT MAX(id_aset) AS maxKode FROM tb_monitor");
		$row 	= $query->row_array();
		$kode	= $row['maxKode'];
		$nourut = (int) substr($kode,5,3); //cara baca nya substr(string,x1,x2) adalah string = ICT-2000; x1=awal baca/scan string dari index kiri; x2= kebalikan dari x1 atau baca index dari kanan
		$nourut++;
		$newKode = $prefix.sprintf("%03s",$nourut);
		return $newKode;
	}

	#Proses Auto Generate ID Aset Printer
	public function genIDPrinter()
	{
		$prefix 	= 'ICT-3';
		$query	= $this->db->query("SELECT MAX(id_aset) AS maxKode FROM tb_printer");
		$row 	= $query->row_array();
		$kode	= $row['maxKode'];
		$nourut = (int) substr($kode,5,3); //cara baca nya substr(string,x1,x2) adalah string = ICT-2000; x1=awal baca/scan string dari index kiri; x2= kebalikan dari x1 atau baca index dari kanan
		$nourut++;
		$newKode = $prefix.sprintf("%03s",$nourut);
		return $newKode;
	}

// ========================================

//HALAMAN MASTER DATA ASET LAPTOP
	public function getDataLaptop()
	{
		$this->db->select('*');
		$this->db->from('tb_laptop');
		$this->db->order_by('id_aset','DESC');
		$data = $this->db->get();
		return $data->result_array();
	}

	#Proses Tambah Data Aset Laptop
	public function addLaptop($data,$table)
	{
		$insert = $this->db->insert($table,$data);
        return $data;
	}

	#Proses Edit Data Aset Laptop
	public function updateLaptop($data,$table,$id)
	{
		$this->db->where('id_aset',$id);
		$this->db->update($table,$data);
	}

	#Proses Hapus Data Aset Laptop
	public function delLaptop($table,$id)
	{
		$this->db->where('id_aset',$id);
		$this->db->delete($table);
	}

//===========================

//HALAMAN MASTER DATA ASET MONITOR
	public function getDataMonitor()
	{
		$this->db->select('*');
		$this->db->from('tb_monitor');
		$this->db->order_by('id_aset','DESC');
		$data = $this->db->get();
		return $data->result_array();
	}

	#Proses Tambah Data Aset Monitor
	public function addMonitor($data,$table)
	{
		$insert = $this->db->insert($table,$data);
		return $data;
	}

	#Proses Edit Data Aset Monitor
	public function updateMonitor($data,$table,$id)
	{
		$this->db->where('id_aset',$id);
		$this->db->update($table,$data);
	}

	#Proses Hapus Data Aset Monitor
	public function delMonitor($table,$id)
	{
		$this->db->where('id_aset',$id);
		$this->db->delete($table);
	}

//===========================

//HALAMAN MASTER DATA ASET PRINTER
	public function getDataPrinter()
	{
		$this->db->select('*');
		$this->db->from('tb_printer');
		$this->db->order_by('id_aset','DESC');
		$data = $this->db->get();
		return $data->result_array();
	}

	#Proses Tambah Data Aset Printer
	public function addPrinter($data,$table)
	{
		$insert = $this->db->insert($table,$data);
		return $data;
	}

	#Proses Edit Data Aset Printer
	public function updatePrinter($data,$table,$id)
	{
		$this->db->where('id_aset',$id);
		$this->db->update($table,$data);
	}

	#Proses Hapus Data Aset Printer
	public function delPrinter($table,$id)
	{
		$this->db->where('id_aset',$id);
		$this->db->delete($table);
	}

//===========================

//HALAMAN DATA USER
	public function getDataUser()
	{
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->join('tb_level','tb_level.kode_level=tb_user.userlevel','left');
		$this->db->order_by('id_user','DESC');
		$data = $this->db->get();
		return $data->result_array();
	}

	#Proses Tambah Data User
	public function addUser($data,$table)
	{
		$insert = $this->db->insert($table,$data);
        return $data;
	}

	#Proses Edit Data User
	public function updateUser($data,$table,$id)
	{
		$this->db->where('id_user',$id);
		$this->db->update($table,$data);
	}
//===========================


	
}