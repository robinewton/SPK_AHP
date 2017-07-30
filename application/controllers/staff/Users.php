<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller
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
        $meta['judul']="Data Account <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('pengguna',array('akses !='=>'admin'),'nama ASC');
        $this->load->view(akses().'/user/userview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
		$this->form_validation->set_rules('nama','Nama User','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password User','required');
		$this->form_validation->set_rules('akses','Akses User','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama=$this->input->post('nama');
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$akses=$this->input->post('akses');
			
			$d=array(
			'username'=>$username,
			'nama'=>$nama,
			'password'=>md5($password),
			'akses'=>$akses,
			);
			if($this->m_db->add_row('pengguna',$d)==TRUE)
			{
				$userID=$this->m_db->last_insert_id();
				$table="pengguna";
				/*if($akses=="Staff")
				{
					$table="tata_usaha";
				}elseif($akses=="Kepala"){
					$table="waka_siswa";
				}elseif($akses=="Penyewa"){
					$table="wali_kelas";
				}*/
				$this->add_manajemen($table,$userID,$nama,$username,$password,$akses);
				set_header_message('success','Tambah Account','Berhasil Tambah User');
				redirect(base_url(akses().'/users'));
			}else{
				set_header_message('danger','Tambah Account','Gagal Tambah User');
				redirect(base_url(akses().'/users/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Account";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/user/useradd');
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
			//$this->m_db->delete_row('tata_usaha',$s);
			//$this->m_db->delete_row('waka_siswa',$s);
			//$this->m_db->delete_row('wali_kelas',$s);
			set_header_message('success','Hapus User','Berhasil Menghapus User');
			redirect(base_url(akses().'/users'));
		}else{
			set_header_message('danger','Hapus User','Gagal Menghapus User');
			redirect(base_url(akses().'/users'));
		}
	}
	
	private function add_manajemen($table)
	{
		if(!empty($userID))
		{
			$d=array(
			'nama'=>$nama,
			'username'=>$username,
			'password'=>$password,
			'akses'=>$akses,
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
