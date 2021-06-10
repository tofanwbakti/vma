<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_nologin();
		$this->load->model('M_Umum');
		
	}

	public function index()
	{
		// cek_yeslogin();
		$user = $this->fungsi->user_login()->id_user;
		$data = array (
            'judul' => "VMA | Dashboard",
			'row' 	=> $this->M_Umum->getDataTrx($user)
        );
        $this->template->load('template', 'dashboard',$data);
	}
}
