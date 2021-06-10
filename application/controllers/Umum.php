<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umum extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cek_nologin();
		$this->load->model('M_Umum');
		
	}


	public function index()
	{		
		$data = array (
            'judul' 	=> "VMA | Visualisasi",
			// 'rowltjan'	=> $this->M_Umum->getltJan(),

        );
        $this->template->load('template', 'umum/visualisasi',$data);
	}

	public function filterVisualisasiAset()
	{
		$aset 	= $this->input->post('aset',TRUE);
		$tgl1 	=$this->input->post('tglfilter',FALSE);
		$tgl 	= explode('s/d',$tgl1);
		$filter1= date("Y-m-d",strtotime($tgl[0]));
		$filter2= date("Y-m-d",strtotime($tgl[1]));

		// echo $aset.'<br>'.$tgl1.'<br>'.date("Y-m-d",strtotime($tgl[0])).'<br>'.date("Y-m-d",strtotime($tgl[1]));
		if($aset == "1"){
			$data = array(
				'judul' => "VMA | Visualisasi Manajemen Aset Laptop",
				'row'	=> $this->M_Umum->getFilterAset($filter1,$filter2,'ICT-1'),
				'awal'	=> $filter1,
				'akhir'	=> $filter2,
				'aset'	=> "ICT-1",
				'kat'	=> "Laptop"
			);
		}else if($aset == "2"){
			$data = array(
				'judul' => "VMA | Visualisasi Manajemen Aset Monitor",
				'row'	=> $this->M_Umum->getFilterAset($filter1,$filter2,'ICT-2'),
				'awal'	=> $filter1,
				'akhir'	=> $filter2,
				'aset'	=> "ICT-2",
				'kat'	=> "Monitor"
			);
		}else{
			$data = array(
				'judul' => "VMA | Visualisasi Manajemen Aset Printer",
				'row'	=> $this->M_Umum->getFilterAset($filter1,$filter2,'ICT-3'),
				'awal'	=> $filter1,
				'akhir'	=> $filter2,
				'aset'	=> "ICT-3",
				'kat'	=> "Printer"
			);
		}
        $this->template->load('template', 'umum/visualisasiaset',$data);
        // $this->template->load('template', 'umum/visualisasiaset');
	}
}
