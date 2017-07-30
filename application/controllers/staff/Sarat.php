<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sarat extends CI_Controller
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
    }
    
    function index()
    {
        $meta['judul']="Data Kriteria <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('kriteria');
        $this->load->view(akses().'/kriteria/kriteriaview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
		$this->form_validation->set_rules('nama_gedung','User ID','required');
		$this->form_validation->set_rules('jenis_gedung','Nama Pegawai','required');
		$this->form_validation->set_rules('acara','NIP','required');
		$this->form_validation->set_rules('Status','Jabatan Pegawai','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama_gedung=$this->input->post('nama_gedung');
			$jenis_gedung=$this->input->post('jenis_gedung');	
			$acara=$this->input->post('acara');
			$Status=$this->input->post('Status');
			
			$d=array(
			'nama_gedung'=>$nama_gedung,
			'jenis_gedung'=>$jenis_gedung,
			'acara'=>$acara,
			'Status'=>$Status,
			);
			if($this->m_db->add_row('gedung',$d)==TRUE)
			{
				$id_penyewa=$this->m_db->last_insert_id();
				$table="gedung";
				$this->add_penyewa($table,$id_penyewa,$nama_gedung,$jenis_gedung,$acara,$Status);
				set_header_message('success','Tambah Gedung','Berhasil menambah Gedung');
				redirect(base_url(akses().'/Pemesan'));
			}else{
				set_header_message('danger','Tambah Gedung','Gagal menambah Gedung');
				redirect(base_url(akses().'/Pemesan/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Gedung";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/gedung/gedungadd');
			$this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		$s=array(
		'id_kriteria'=>$id,
		);
		if($this->m_db->is_bof('kriteria',$s)==FALSE)
		{
			$this->m_db->delete_row('kriteria',$s);
			set_header_message('success','Hapus Kriteria','Berhasil Menghapus Kriteria');
			redirect(base_url(akses().'/Sarat'));
		}else{
			set_header_message('danger','Hapus Kriteria','Gagal Menghapus Kriteria');
			redirect(base_url(akses().'/Sarat'));
		}
	}
	
	private function add_kriteria($table)
	{
		if(!empty($id_kriteria))
		{
			$d=array(
			'nama_kriteria'=>$nama_kriteria,
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
