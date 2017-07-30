<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tempat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="staff")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('mcombox','mod_jenis_gedung');
    }
    
    /*function index()
    {
        $meta['judul']="Data Gedung <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('gedung');
        $this->load->view(akses().'/gedung/gedungview',$d);
        $this->load->view('tema/footer');
    }*/

    /*function index()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
    	
    	$id=$this->input->get('id');
    	$sql="SELECT g.id_gedung,j.Nama_Jenis,g.nama_gedung FROM gedung g JOIN jenis_gedung j ON g.id_jenis_gedung = j.id_jenis_gedung";
        $meta['judul']="Data Gedung <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $this->load->view(akses().'/gedung/gedungview',$d);
        $this->load->view('tema/footer');
    }*/

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
    	$sql="SELECT g.id_gedung,j.Nama_Jenis,g.nama_gedung FROM (gedung g LEFT JOIN jenis_gedung j ON g.id_jenis_gedung = j.id_jenis_gedung)".$s;
        $meta['judul']="Data Gedung <small>advanced tables</small>".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/gedung/gedungview',$d);
        $this->load->view('tema/footer');
}
    
    function add()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('nama_gedung','Nama Gedung','required');
		$this->form_validation->set_rules('id_jenis_gedung','Jenis Gedung','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama_gedung=$this->input->post('nama_gedung');
			$id_jenis_gedung=$this->input->post('id_jenis_gedung');
			
			$d=array(
			'nama_gedung'=>$nama_gedung,
			'id_jenis_gedung'=>$id_jenis_gedung,
			);
			if($this->m_db->add_row('gedung',$d)==TRUE)
			{
				$id_gedung=$this->m_db->last_insert_id();
				$table="gedung";
				$this->add_gedung($table,$id_gedung,$nama_gedung,$id_jenis_gedung,$acara,$Status);
				set_header_message('success','Tambah Gedung','Berhasil menambah Gedung');
				redirect(base_url(akses().'/Tempat'));
			}else{
				set_header_message('danger','Tambah Gedung','Gagal menambah Gedung');
				redirect(base_url(akses().'/Tempat/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Gedung";
			$this->load->view('tema/header',$meta);
			$d['link']=$ref;
	        $d['jenis_gedung']=$this->mod_jenis_gedung->jenis_gedung_data();
	        $d['id_jenis_gedung']=$bearef;	
			$this->load->view(akses().'/gedung/gedungadd',$d);
			$this->load->view('tema/footer');
		}
	}

	function edit()
    {
    	$this->form_validation->set_rules('id_gedung','ID Gedung','required');
		$this->form_validation->set_rules('nama_gedung','Nama Jenis','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_gedung=$this->input->post('id_gedung');
			$nama_gedung=$this->input->post('nama_gedung');
			
			if($this->mod_kriteria->edit_master_gedung($id_gedung,$nama_gedung)==TRUE)
			{
				set_header_message('success','Ubah Gedung','Berhasil mengubah Gedung');
				redirect(base_url(akses()).'/Tempat');
			}else{
				set_header_message('danger','Ubah Gedung','Gagal mengubah Gedung');
				redirect(base_url(akses()).'/Tempat');
			}
		}else{
			$id=$this->input->get('id');
			$meta['judul']="Ubah Gedung";
	        $this->load->view('tema/header',$meta);
	        $d['data']=$this->mod_kriteria->gedung_data(array('id_gedung'=>$id));
	        $this->load->view(akses().'/gedung/gedungedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		$s=array(
		'id_gedung'=>$id,
		);
		if($this->m_db->is_bof('gedung',$s)==FALSE)
		{
			$this->m_db->delete_row('gedung',$s);
			set_header_message('success','Hapus Gedung','Berhasil Menghapus Gedung');
			redirect(base_url(akses().'/Tempat'));
		}else{
			set_header_message('danger','Hapus Gedung','Gagal Menghapus Gedung');
			redirect(base_url(akses().'/Tempat'));
		}
	}
	
	private function add_gedung($table)
	{
		if(!empty($id_gedung))
		{
			$d=array(
			'nama_gedung'=>$nama_gedung,
			'id_jenis_gedung'=>$id_jenis_gedung,
			'acara'=>$acara,
			);
			if($this->m_db->add_row($table,$d)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
    
}
