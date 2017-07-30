<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pemesan extends CI_Controller
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
		$this->load->model('mcombox','mod_username');
    }
    
    /*function index()
    {
        $meta['judul']="Data Penyewa <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_data('penyewa');
        $this->load->view(akses().'/penyewa/penyewaview',$d);
        $this->load->view('tema/footer');
    }*/

    /*function index()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
    	
    	$id=$this->input->get('id');
    	$sql="SELECT p.id_penyewa,p.user_id,p.KTP,p.nama_penyewa,pg.username,p.alamat,p.pekerjaan,p.notelp_penyewa FROM penyewa p JOIN pengguna pg ON p.user_id = pg.user_id";
        $meta['judul']="Data Penyewa <small>advanced tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
       	$this->load->view(akses().'/penyewa/penyewaview',$d);
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
			$s=" Where pengguna.user_id='$id'";
			$nama=" ".field_value('pengguna','user_id',$id,'username');
		}
    	$sql="SELECT p.id_penyewa,pg.username,p.KTP,p.nama_penyewa,pg.username,p.alamat,p.pekerjaan,p.notelp_penyewa FROM (penyewa p LEFT JOIN  pengguna pg ON p.user_id = pg.user_id)".$s;
        $meta['judul']="Data Penyewa <small>advanced tables</small>".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/penyewa/penyewaview',$d);
        $this->load->view('tema/footer');
}
    
   function add()
    {
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('user_id','User ID','required');
		$this->form_validation->set_rules('KTP','Nama Pegawai','required');
		$this->form_validation->set_rules('nama_penyewa','NIP','required');
		$this->form_validation->set_rules('alamat','Jabatan Pegawai','required');
		$this->form_validation->set_rules('pekerjaan','Golongan Pegawai','required');
		$this->form_validation->set_rules('notelp_penyewa','No.Telp Pegawai','required');
		if($this->form_validation->run()==TRUE)
		{
			$user_id=$this->input->post('user_id');
			$KTP=$this->input->post('KTP');	
			$nama_penyewa=$this->input->post('nama_penyewa');
			$alamat=$this->input->post('alamat');
			$pekerjaan=$this->input->post('pekerjaan');
			$notelp_penyewa=$this->input->post('notelp_penyewa');
			
			$d=array(
			'user_id'=>$user_id,
			'KTP'=>$KTP,
			'nama_penyewa'=>$nama_penyewa,
			'alamat'=>$alamat,
			'pekerjaan'=>$pekerjaan,
			'notelp_penyewa'=>$notelp_penyewa,
			);
			if($this->m_db->add_row('penyewa',$d)==TRUE)
			{
				$id_penyewa=$this->m_db->last_insert_id();
				$table="penyewa";
				$this->add_penyewa($table,$id_penyewa,$user_id,$KTP,$nama_penyewa,$alamat,$pekerjaan,$notelp_penyewa);
				set_header_message('success','Tambah Penyewa','Berhasil menambah Penyewa');
				redirect(base_url(akses().'/Pemesan'));
			}else{
				set_header_message('danger','Tambah Penyewa','Gagal menambah Penyewa');
				redirect(base_url(akses().'/Pemesan/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Penyewa";
			$this->load->view('tema/header',$meta);
			$d['link']=$ref;
	        $d['pengguna']=$this->mod_username->pengguna_data();
	        $d['user_id']=$bearef;	
			$this->load->view(akses().'/penyewa/penyewaadd',$d);
			$this->load->view('tema/footer');
		}
	}

	function edit()
    {
    	$this->form_validation->set_rules('id_penyewa','ID Gedung','required');
		$this->form_validation->set_rules('KTP','KTP','required');
		$this->form_validation->set_rules('nama_penyewa','Nama penyewa','required');
		$this->form_validation->set_rules('alamat','alamat','required');
		$this->form_validation->set_rules('pekerjaan','pekerjaan','required');
		$this->form_validation->set_rules('notelp_penyewa','pekerjaan','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_penyewa=$this->input->post('id_penyewa');
			$KTP=$this->input->post('KTP');
			$nama_penyewa=$this->input->post('nama_penyewa');
			$alamat=$this->input->post('alamat');
			$pekerjaan=$this->input->post('pekerjaan');
			$notelp_penyewa=$this->input->post('notelp_penyewa');
			
			if($this->mod_kriteria->edit_master_penyewa($id_penyewa,$KTP,$nama_penyewa,$alamat,$pekerjaan,$notelp_penyewa)==TRUE)
			{
				set_header_message('success','Ubah Penyewa','Berhasil mengubah Penyewa');
				redirect(base_url(akses()).'/Pemesan');
			}else{
				set_header_message('danger','Ubah Penyewa','Gagal mengubah Penyewa');
				redirect(base_url(akses()).'/Pemesan');
			}
		}else{
			$id=$this->input->get('id');
			$meta['judul']="Ubah Penyewa";
	        $this->load->view('tema/header',$meta);
	        $d['data']=$this->mod_kriteria->penyewa_data(array('id_penyewa'=>$id));
	        $this->load->view(akses().'/penyewa/penyewaedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		$s=array(
		'id_penyewa'=>$id,
		);
		if($this->m_db->is_bof('penyewa',$s)==FALSE)
		{
			$this->m_db->delete_row('penyewa',$s);
			set_header_message('success','Hapus Penyewa','Berhasil Menghapus Penyewa');
			redirect(base_url(akses().'/Pemesan'));
		}else{
			set_header_message('danger','Hapus Penyewa','Gagal Menghapus Penyewa');
			redirect(base_url(akses().'/Pemesan'));
		}
	}
	
	private function add_penyewa($table)
	{
		if(!empty($id_penyewa))
		{
			$d=array(
			'user_id'=>$user_id,
			'KTP'=>$KTP,
			'nama_penyewa'=>$nama_penyewa,
			'alamat'=>$alamat,
			'pekerjaan'=>$pekerjaan,
			'notelp_penyewa'=>$notelp_penyewa,
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
