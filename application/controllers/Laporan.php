<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(empty(akses()))
        {
			redirect(base_url().'logout');
		}
		$this->load->model('beasiswa_model','mod_pilged');
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('siswa_model','mod_siswa');
    }
    
    function penerimagedung()
    {
        $id=$this->input->get('id');
        $nama=$this->mod_pilged->pemilihan_gedung_info($id,'nama_pemilihan');
        $meta['judul']="Daftar Penyewa Pemesanan Gedung ".$nama;
        $this->load->view('tema/cetak/header',$meta);
        $d['data']=$this->mod_pilged->pemilihan_gedung_data(array('id_pemilihan_gedung'=>$id));
        $this->load->view('laporan/layaksewapenyewaview',$d);
        $this->load->view('tema/cetak/footer');

		/*$id=$this->input->get('id');
		$nama=$this->mod_bea->beasiswa_info($id,'judul');
		$meta['judul']="Daftar Penerima Beasiswa ".$nama;
        $this->load->view('tema/cetak/header',$meta);
        $d['data']=$this->mod_bea->beasiswa_data(array('beasiswa_id'=>$id));
        $this->load->view('laporan/layaksewapenyewaview',$d);
        $this->load->view('tema/cetak/footer');*/
	}
    
}