<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pilihan_tempat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="kepala")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('Pemilihan_model','mod_pilged');
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('mcombox','mod_gedung');
		$this->load->model('mcombox','mod_jenis_gedung');
    }
    
    function index()
    {
        $bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
    	
    	$id=$this->input->get('id');
    	$s="";
    	$nama="";
    	if(!empty($id))
    	{
			$s=" Where jenis_gedung.id_jenis_gedung='$id'";
			$nama=" ".field_value('jenis_gedung','id_jenis_gedung',$id,'Nama_Jenis');
		}
    	$sql="SELECT pg.id_pemilihan_gedung,pg.nama_pemilihan,g.nama_gedung,jg.Nama_Jenis,pg.tahun,pg.kuota FROM (pemilihan_gedung pg LEFT JOIN gedung g ON pg.id_gedung = g.id_gedung LEFT JOIN jenis_gedung jg ON pg.id_jenis_gedung = jg.id_jenis_gedung)".$s;
        $meta['judul']="Pemilihan Pemesanan Gedung <small>Transaction tables</small>".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/komponen/pemilihan_gedung/pemilihan_gedungview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
    	$userid=user_info('user_id');
    	$d['data']=$this->m_db->get_data('pengguna',array('user_id'=>$userid));
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('id_gedung','Nama Gedung','required');
		$this->form_validation->set_rules('id_jenis_gedung','Nama Jenis','required');
		$this->form_validation->set_rules('nama_pemilihan','Nama Pemilihan','required');
		$this->form_validation->set_rules('tahun','Tahun Pemilihan','required');
		$this->form_validation->set_rules('kuota','Kuota Pemilihan','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_gedung=$this->input->post('id_gedung');
			$id_jenis_gedung=$this->input->post('id_jenis_gedung');
			$nama_pemilihan=$this->input->post('nama_pemilihan');
			$tahun=$this->input->post('tahun');
			$kuota=$this->input->post('kuota');
			
			if($this->mod_pilged->pemilihan_gedung_add($id_gedung,$id_jenis_gedung,$nama_pemilihan,$tahun,$kuota)==TRUE)
			{
				set_header_message('success','Tambah Pemilihan Pemesanan Gedung','Berhasil menambah Pemilihan Pemesanan Gedung');
				redirect(base_url(akses()).'/analisa/Pilihan_tempat');
			}else{
				set_header_message('danger','Tambah Pemilihan Pemesanan Gedung','Gagal menambah Pemilihan Pemesanan Gedung');
				redirect(base_url(akses()).'/analisa/Pilihan_tempat/add');
			}
		}else{
			$meta['judul']="Tambah Pemilihan Pemesanan Gedung";
	        $this->load->view('tema/header',$meta);
	        $d['link']=$ref;
	        $d['gedung']=$this->mod_gedung->nama_gedung_data();
	        $d['id_gedung']=$bearef;	
	        $d['kriteria']=$this->mod_kriteria->kriteria_data();
	        $d['jenis_gedung']=$this->mod_jenis_gedung->jenis_gedung_data();
	        $d['id_jenis_gedung']=$bearef;	
	        $this->load->view(akses().'/komponen/pemilihan_gedung/pemilihan_gedungadd',$d);
	        $this->load->view('tema/footer');
		}
	}
        
	function edit()
    {
		$this->form_validation->set_rules('id_gedung','Nama Gedung','required');
		$this->form_validation->set_rules('id_jenis_gedung','Nama Jenis','required');
		$this->form_validation->set_rules('nama_pemilihan','Nama Pemilihan','required');
		$this->form_validation->set_rules('tahun','Tahun Pemilihan','required');
		$this->form_validation->set_rules('kuota','Kuota Pemilihan','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_pemilihan_gedung=$this->input->post('id_pemilihan_gedung');
			$id_gedung=$this->input->post('id_gedung');
			$id_jenis_gedung=$this->input->post('id_jenis_gedung');
			$nama_pemilihan=$this->input->post('nama_pemilihan');
			$tahun=$this->input->post('tahun');
			$kuota=$this->input->post('kuota');
			
			if($this->mod_pilged->pemilihan_gedung_edit($id_pemilihan_gedung,$id_gedung,$id_jenis_gedung,$nama_pemilihan,$tahun,$kuota)==TRUE)
			{
				set_header_message('success','Ubah Pemilihan Pemesanan Gedung','Berhasil mengubah Pemilihan Pemesanan Gedung');
				redirect(base_url(akses()).'/analisa/Pilihan_tempat');
			}else{
				set_header_message('danger','Ubah Pemilihan Pemesanan Gedung','Gagal mengubah Pemilihan Pemesanan Gedung');
				redirect(base_url(akses()).'/analisa/Pilihan_tempat');
			}
		}else{
			$id=$this->input->get('id');
			$meta['judul']="Ubah Pemilihan Pemesanan Gedung";
	        $this->load->view('tema/header',$meta);
	        $d['data']=$this->mod_pilged->pemilihan_gedung_data(array('id_pemilihan_gedung'=>$id));
	        $this->load->view(akses().'/komponen/pemilihan_gedung/pemilihan_gedungedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		if($this->mod_pilged->pemilihan_gedung_delete($id)==TRUE)
		{
			set_header_message('success','Hapus Pemilihan Pemesanan Gedung','Berhasil menghapus Pemilihan Pemesanan Gedung');
			redirect(base_url(akses()).'/komponen/pemilihan_gedung');
		}else{
			set_header_message('danger','Hapus Pemilihan Pemesanan Gedung','Gagal menghapus Pemilihan Pemesanan Gedung');
			redirect(base_url(akses()).'/komponen/pemilihan_gedung');
		}
	}
	
	function proses()
	{
		$id=$this->input->get('id');
		$nama=$this->mod_pilged->pemilihan_gedung_info($id,'nama_pemilihan');
		//$sql="SELECT g.nama_gedung FROM (pemilihan_gedung pg LEFT JOIN gedung g ON pg.id_gedung = g.id_gedung) where pg.id_gedung='$idg'";
		//$nama=$this->m_db->get_query_row($sql);
		$meta['judul']="<i class='fa fa-users'></i> Daftar Penyewa Pemesanan Gedung ".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_pilged->pemilihan_gedung_data(array('id_pemilihan_gedung'=>$id));
        $this->load->view(akses().'/komponen/pemilihan_gedung/prosesview',$d);
        $this->load->view('tema/footer');
	}
	
	function proseshitung()
	{
		$id=$this->input->get('id');
		$this->mod_pilged->proseshitung($id);		
		if($this->mod_pilged->proseshitung($id)==TRUE)
		{
			//set_header_message('success','Proses Beasiswa','Beasiswa telah diproses');
			//redirect(base_url(akses().'/beasiswa/beasiswa').'?id='.$id);
			echo json_encode(array('status'=>'ok'));
		}else{
			//set_header_message('danger','Proses Beasiswa','Beasiswa gagal diproses');
			//redirect(base_url(akses().'/beasiswa/beasiswa'));
			echo json_encode(array('status'=>'no'));
		}		
	}
    
}
