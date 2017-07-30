<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Charts extends CI_Controller
{
    /*function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(empty(akses()))
        {
			redirect(base_url().'logout');
		}
		$this->load->model('Charts_model','mod_charts');
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('siswa_model','mod_siswa');
    }*/

    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="staff")
        {
            redirect(base_url().'logout');
        }
        $this->load->model('Charts_model','mod_charts');
    }
    
    function index()
    {
        //$meta['judul']="Daftar Penyewa Pemesanan Gedung ";
        //$this->load->view('tema/cetak/header',$meta);
        $d['report']=$this->mod_charts->report();
        $this->load->view('charts/charts_pemesananview',$d);
        //$this->load->view('tema/cetak/footer');
	}
    
}