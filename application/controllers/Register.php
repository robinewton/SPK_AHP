<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();            
        $this->load->library('form_validation');
        $this->load->library('m_db');
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
				$this->add_manajemen($table,$userID,$nama,$username,$password,$akses);
				set_header_message('success','Tambah Account','Berhasil Tambah User');
				redirect(base_url(akses().'/dashboard'));
			}else{
				set_header_message('danger','Tambah Account','Gagal Tambah User');
				redirect(base_url(akses().'/Register/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Account";
			$this->load->view('tema/registerview');
		}
	}

    function index()
    {
    	$meta['judul']="SPK Gedung | Register";
	    $this->load->view('tema/registerview',$meta);        
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
