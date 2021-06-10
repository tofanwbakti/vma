<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url','form','session');
    }
	
	public function index()
	{
		// $this->load->view('welcome_message');
        cek_yeslogin();
		$this->load->view('login');
		$this->session->sess_destroy();
	}

	// Proses autentifikasi login
    public function proceed()
    {
        $post = $this->input->post(null,TRUE);
        if(isset($post['login'])){
            $this->load->model('M_Auth');
            $query_login = $this->M_Auth->login($post);

            if($query_login->num_rows() > 0){
                $row = $query_login->row();
                $param = array(
                    'idusr' 	=> $row->id_user,
					'username' 	=> $row->username,
					'idlevel'	=> $row->userlevel
                );
                $this->session->set_userdata($param);
                echo "<script>alert ('Selamat, login berhasil');
                window.location='".site_url('Dashboard')."';</script>";
            }else{
                echo"<script>alert('Login failed');
                window.location='".site_url('Auth')."';</script>";
            }
        }
    }

	// Proses Logout start
    function logout(){
        $this->session->sess_destroy();
        //$url=base_url('');
        redirect('Auth');
    }

     // update data ketika session expired
    function sessionOff(){
        $this->session->sess_destroy();
        redirect('Auth');
    }
}
