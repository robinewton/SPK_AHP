<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Macam_Tempat extends CI_Controller
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
		//$this->load->model('mmaster','m_m');
    }
    
    /*function index()
    {
        $meta['judul']="Data Jenis Gedung <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('jenis_gedung');
        $this->load->view(akses().'/jenis_gedung/jenis_gedungview',$d);
        $this->load->view('tema/footer');
    }*/

    function index()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
    	
    	$id=$this->input->get('id');
    	$sql="SELECT id_jenis_gedung,Nama_Jenis FROM jenis_gedung";
        $meta['judul']="Data Jenis Gedung <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $this->load->view(akses().'/jenis_gedung/jenis_gedungview',$d);
        $this->load->view('tema/footer');
    }

    function edit()
    {
    	$this->form_validation->set_rules('id_jenis_gedung','ID Jenis Gedung','required');
		$this->form_validation->set_rules('Nama_Jenis','Nama Jenis','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_jenis_gedung=$this->input->post('id_jenis_gedung');
			$Nama_Jenis=$this->input->post('Nama_Jenis');
			
			if($this->mod_kriteria->edit_master_jenis($id_jenis_gedung,$Nama_Jenis)==TRUE)
			{
				set_header_message('success','Ubah Gedung','Berhasil mengubah Gedung');
				redirect(base_url(akses()).'/Macam_Tempat');
			}else{
				set_header_message('danger','Ubah Gedung','Gagal mengubah Gedung');
				redirect(base_url(akses()).'/Macam_Tempat');
			}
		}else{
			$id=$this->input->get('id');
			$meta['judul']="Ubah Jenis Gedung";
	        $this->load->view('tema/header',$meta);
	        $d['data']=$this->mod_kriteria->Jenis_data(array('id_jenis_gedung'=>$id));
	        $this->load->view(akses().'/jenis_gedung/jenis_gedungedit',$d);
	        $this->load->view('tema/footer');
		}
	}

	/*private function edit_master_jenis($table){
		if(!empty($id_jenis_gedung))
		{
			$d=array(
			'Nama_Jenis'=>$Nama_Jenis,
			);
			if($this->m_db->update($table,$d)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		}
	}*/
    
    /*function add()
    {
		$this->form_validation->set_rules('Nama_Jenis','Nama Jenis','required');
		if($this->form_validation->run()==TRUE)
		{
			$Nama_Jenis=$this->input->post('Nama_Jenis');

		if($this->mod_pegawai->karyawan_add($table,$id_jenis_gedung,$Nama_Jenis)==TRUE)
			{
				set_header_message('success','Tambah Jenis Gedung','Berhasil menambah Jenis Gedung');
				redirect(base_url(akses().'/Macam_Tempat'));
			}else{
				set_header_message('danger','Tambah Jenis Gedung','Gagal menambah Jenis Gedung');
				redirect(base_url(akses().'/Macam_Tempat/add'));
			}
			
		}else{
			$meta['judul']="Tambah Jenis Gedung";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/jenis_gedung/jenis_gedungadd');
			$this->load->view('tema/footer');
		}
	}*/

	function add()
    {
		$this->form_validation->set_rules('Nama_Jenis','Nama Jenis','required');
		if($this->form_validation->run()==TRUE)
		{
			$Nama_Jenis=$this->input->post('Nama_Jenis');
			
			$d=array(
			'Nama_Jenis'=>$Nama_Jenis,
			);
			if($this->m_db->add_row('jenis_gedung',$d)==TRUE)
			{
				$id_jenis_gedung=$this->m_db->last_insert_id();
				$table="jenis_gedung";
				$this->add_jenis_gedung($table,$id_jenis_gedung,$Nama_Jenis);
				set_header_message('success','Tambah Jenis Gedung','Berhasil menambah Jenis Gedung');
				redirect(base_url(akses().'/Macam_Tempat'));
			}else{
				set_header_message('danger','Tambah Jenis Gedung','Gagal menambah Jenis Gedung');
				redirect(base_url(akses().'/Macam_Tempat/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Jenis Gedung";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/jenis_gedung/jenis_gedungadd');
			$this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		$s=array(
		'id_jenis_gedung'=>$id,
		);
		if($this->m_db->is_bof('jenis_gedung',$s)==FALSE)
		{
			$this->m_db->delete_row('jenis_gedung',$s);
			set_header_message('success','Hapus Jenis Gedung','Berhasil Menghapus Jenis Gedung');
			redirect(base_url(akses().'/Macam_Tempat'));
		}else{
			set_header_message('danger','Hapus Jenis Gedung','Gagal Menghapus Jenis Gedung');
			redirect(base_url(akses().'/Macam_Tempat'));
		}
	}
	
	private function add_jenis_gedung($table)
	{
		if(!empty($id_jenis_gedung))
		{
			$d=array(
			'Nama_Jenis'=>$Nama_Jenis,
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
