<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pegawai extends CI_Controller
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
        $meta['judul']="Data Pegawai <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('pegawai');
        $this->load->view(akses().'/karyawan/karyawanview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
		$this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required');
		$this->form_validation->set_rules('nip','NIP','required');
		$this->form_validation->set_rules('jabatan','Jabatan Pegawai','required');
		$this->form_validation->set_rules('golongan','Golongan Pegawai','required');
		$this->form_validation->set_rules('notelp','No.Telp Pegawai','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama_pegawai=$this->input->post('nama_pegawai');
			$nip=$this->input->post('nip');
			$jabatan=$this->input->post('jabatan');
			$golongan=$this->input->post('golongan');
			$notelp=$this->input->post('notelp');

		if($this->mod_pegawai->karyawan_add($table,$nama_pegawai,$nip,$jabatan,$golongan,$notelp)==TRUE)
			{
				set_header_message('success','Tambah Karyawan','Berhasil menambah Karyawan');
				redirect(base_url(akses().'/Pegawai'));
			}else{
				set_header_message('danger','Tambah Karyawan','Gagal menambah Karyawan');
				redirect(base_url(akses().'/karyawan/add'));
			}
			
		}else{
			$meta['judul']="Tambah Karyawan";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/karyawan/karyawanadd');
			$this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		$s=array(
		'user_id'=>$id,
		);
		if($this->m_db->is_bof('pengguna',$s)==FALSE)
		{
			$this->m_db->delete_row('pengguna',$s);
			$this->m_db->delete_row('tata_usaha',$s);
			$this->m_db->delete_row('waka_siswa',$s);
			$this->m_db->delete_row('wali_kelas',$s);
			set_header_message('success','Hapus User','Berhasil Menghapus User');
			redirect(base_url(akses().'/users'));
		}else{
			set_header_message('danger','Hapus User','Gagal Menghapus User');
			redirect(base_url(akses().'/users'));
		}
	}
	
	private function mod_pegawai($table,$nama_pegawai,$nip,$jabatan,$golongan,$notelp)
	{
		if(!empty($userID))
		{
			$d=array(
			'nama_pegawai'=>$nama_pegawai,
			'nip'=>$nip,
			'jabatan'=>$jabatan,
			'golongan'=>$golongan,
			'notelp'=>$notelp,
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
