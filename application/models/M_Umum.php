<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_Umum extends CI_Model 
	{
		public function getFilterAset($filter1,$filter2,$kat)
		{		
			$this->db->group_by('id_aset');
			$this->db->select('id_aset');
			$this->db->select('count(*) as total');
			$this->db->like('id_aset',$kat);
			$this->db->where('tgl_pinjam <=',$filter2);
			$this->db->where('tgl_pinjam >=',$filter1);
			return $this->db->from('tb_trx_pinjam')->get()->result();

		}

		#Proses get data transaksi peminjaman per user
		public function getDataTrx($user)
		{
			$this->db->select('*');
			$this->db->from('tb_trx_pinjam');
			$this->db->where('id_user',$user);
			$this->db->order_by('id_trx_pinjam',"DESC");
			$data = $this->db->get();
			return $data->result_array();
		}
		
    }