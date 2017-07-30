<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penilaian_Sarat extends CI_Controller
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
    
    /*function index()
    {
        $meta['judul']="Data Penilaian Kriteria <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('penilaian_kriteria');
        $this->load->view(akses().'/penilaian_kriteria/penilaian_kriteriaview',$d);
        $this->load->view('tema/footer');
    }*/

    function index()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
    	
    	$id=$this->input->get('id');
    	$sql="SELECT p.id_penilaian_kriteria,p.bobot_kriteria,g.nama_gedung FROM penilaian_kriteria p JOIN gedung g ON p.id_gedung = g.id_gedung";
        $meta['judul']="Data Penilaian Kriteria <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $this->load->view(akses().'/penilaian_kriteria/penilaian_kriteriaview',$d);
        $this->load->view('tema/footer');
    }
    
    /*function add()
    {
		$this->form_validation->set_rules('id_gedung','Nama Gedung','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_gedung=$this->input->post('id_gedung');

		if($this->Penilaian_Sarat_add($table,$id_penilaian_kriteria,$id_gedung)==TRUE)
			{
				set_header_message('success','Tambah Penilaian Kriteria','Berhasil menambah Penilaian Kriteria');
				redirect(base_url(akses().'/Penilaian_Sarat'));
			}else{
				set_header_message('danger','Tambah Penilaian Kriteria','Gagal menambah Penilaian Kriteria');
				redirect(base_url(akses().'/Penilaian_Sarat/add'));
			}
			
		}else{
			$meta['judul']="Tambah Penilaian Kriteria";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/penilaian_kriteria/penilaian_kriteriaadd');
			$this->load->view('tema/footer');
		}
	}*/

	function add()
    {
		$this->form_validation->set_rules('id_gedung','Nama Gedung','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_gedung=$this->input->post('id_gedung');
			
			$d=array(
			'id_gedung'=>$id_gedung,
			);
			if($this->m_db->add_row('penilaian_kriteria',$d)==TRUE)
			{
				$id_penyewa=$this->m_db->last_insert_id();
				$table="penilaian_kriteria";
				$this->Penilaian_Sarat_add($table,$id_penyewa,$nama_gedung,$jenis_gedung,$acara,$Status);
				set_header_message('success','Tambah Penilaian Kriteria','Berhasil menambah Penilaian Kriteria');
				redirect(base_url(akses().'/Penilaian_Sarat'));
			}else{
				set_header_message('danger','Tambah Penilaian Kriteria','Gagal menambah Penilaian Kriteria');
				redirect(base_url(akses().'/Penilaian_Sarat/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Penilaian Kriteria";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/penilaian_kriteria/penilaian_kriteriaadd');
			$this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		$s=array(
		'id_gedung'=>$id,
		);
		if($this->m_db->is_bof('penilaian_kriteria',$s)==FALSE)
		{
			$this->m_db->delete_row('penilaian_kriteria',$s);
			set_header_message('success','Hapus Penilaian Kriteria','Berhasil Menghapus Penilaian Kriteria');
			redirect(base_url(akses().'/Penilaian_Sarat'));
		}else{
			set_header_message('danger','Hapus Penilaian Kriteria','Gagal Menghapus Penilaian Kriteria');
			redirect(base_url(akses().'/Penilaian_Sarat'));
		}
	}
	
	private function Penilaian_Sarat_add($table)
	{
		if(!empty($id_penilaian_kriteria))
		{
			$d=array(
			'id_gedung'=>$id_gedung,
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
