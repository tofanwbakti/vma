<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_Auth extends CI_Model 
	{

		public function login($post){
			$this->db->select('*');
			$this->db->from('tb_user');
			$this->db->where('username',$post['user_name']);
			$this->db->where('pass_user',md5($post['user_pass']));
			$this->db->where('stts_user !=','N');

			$query = $this->db->get();
			return $query;
		}

		//fungsi untuk cetak session
		public function get ($id=null)
		{
			$this->db->select('*');
			$this->db->from('tb_user');
			// $this->db->join('tb_dosen','tb_dosen.nip_dosen=tb_user.nip_dosen','left');
			if ($id != null){
				$this->db->where('id_user',$id);
			}
			$query = $this->db->get();
			return $query;

		}
    }