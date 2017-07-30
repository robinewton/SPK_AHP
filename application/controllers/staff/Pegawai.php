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
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('mcombox','mod_username');
		//$this->load->model('mcombox'); 
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
			$s=" Where pengguna.user_id='$id'";
			$nama=" ".field_value('pengguna','user_id',$id,'username');
		}
    	$sql="SELECT pg.id_pegawai,p.username,pg.nama_pegawai,pg.jk,pg.nip,pg.jabatan,pg.golongan,pg.alamat,pg.notelp FROM (pegawai pg LEFT JOIN  pengguna p ON pg.user_id = p.user_id)".$s;
        $meta['judul']="Data Pegawai <small>advanced tables</small>".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/karyawan/karyawanview',$d);
        $this->load->view('tema/footer');

        //$meta['judul']="Data Pegawai <small>advanced tables</small>";
        //$this->load->view('tema/header',$meta);        
        //$d['data']=$this->m_db->get_data('pegawai'); 
        //$d['link']=$ref;      
        //$this->load->view(akses().'/karyawan/karyawanview',$d);
        //$this->load->view('tema/footer');
        //$d['data']=$this->m_db->get_data('pengguna');         
        //$this->data['pengguna'] = $this->mkombobox->get();
  		//$this->load->view('pengguna', $this->data);
    }

    /*function getpeserta()
    {
		$pegawai=$this->input->get('pegawai');
		if(!empty($pegawai))
		{
			$s=array(
			'id_pegawai'=>$pegawai,
			);
			$d=$this->m_db->get_data('pengguna',$s);
			if(!empty($d))
			{listPengguna
				$listPengguna="";
				foreach($d as $r)
				{
					$listPengguna.=$r->user_id.",";
				}
				$listPengguna=substr($listPengguna,0,-1);
				
				$sql="Select * from pengguna Where user_id NOT IN ($listPengguna)";
				$o=$this->m_db->get_query_data($sql);
				echo json_encode($o);
			}else{
				$d=$this->mod_siswa->siswa_data();
				echo json_encode($d);
			}
		}else{
			echo json_encode(array());
		}
	}*/
    
    /*function add()
    {
		$this->form_validation->set_rules('user_id','User ID','required');
		$this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required');
		$this->form_validation->set_rules('nip','NIP','required');
		$this->form_validation->set_rules('jabatan','Jabatan Pegawai','required');
		$this->form_validation->set_rules('golongan','Golongan Pegawai','required');
		$this->form_validation->set_rules('notelp','No.Telp Pegawai','required');
		if($this->form_validation->run()==TRUE)
		{
			$user_id=$this->input->post('user_id');
			$nama_pegawai=$this->input->post('nama_pegawai');	
			$nip=$this->input->post('nip');
			$jabatan=$this->input->post('jabatan');
			$golongan=$this->input->post('golongan');
			$notelp=$this->input->post('notelp');

		if($this->mod_pegawai($table,$id_pegawai,$user_id,$nama_pegawai,$nip,$jabatan,$golongan,$notelp)==TRUE)
			{
				set_header_message('success','Tambah Pegawai','Berhasil menambah Pegawai');
				redirect(base_url(akses().'/Pegawai'));
			}else{
				set_header_message('danger','Tambah Pegawai','Gagal menambah Pegawai');
				redirect(base_url(akses().'/Pegawai/add'));
			}
			
		}else{
			$meta['judul']="Tambah Pegawai";
			$this->load->view('tema/header',$meta);
			$this->load->view(akses().'/karyawan/karyawanadd');
			$this->load->view('tema/footer');
		}
	}*/

	function add()
    {
    	//$data['gusername'] = $this->mkombobox->get_username(); 
    	//$d['qpengguna'] = $this->getAll(); 
    	//$d['data']=$this->m_db->get_data('pengguna'); 
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('user_id','User ID','required');
		$this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required');
		$this->form_validation->set_rules('jk','JK','required');
		$this->form_validation->set_rules('nip','NIP','required');
		$this->form_validation->set_rules('jabatan','Jabatan Pegawai','required');
		$this->form_validation->set_rules('golongan','Golongan Pegawai','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('notelp','No.Telp Pegawai','required');
		if($this->form_validation->run()==TRUE)
		{
			$user_id=$this->input->post('user_id');
			$nama_pegawai=$this->input->post('nama_pegawai');	
			$jk=$this->input->post('jk');	
			$nip=$this->input->post('nip');
			$jabatan=$this->input->post('jabatan');
			$golongan=$this->input->post('golongan');
			$alamat=$this->input->post('alamat');
			$notelp=$this->input->post('notelp');
			
			$d=array(
			'user_id'=>$user_id,
			'nama_pegawai'=>$nama_pegawai,
			'jk'=>$jk,
			'nip'=>$nip,
			'jabatan'=>$jabatan,
			'golongan'=>$golongan,
			'alamat'=>$alamat,
			'notelp'=>$notelp,
			);
			if($this->m_db->add_row('pegawai',$d)==TRUE)
			{				
				$userID=$this->m_db->last_insert_id();				
				$table="pegawai";
				$this->add_pegawai($table,$id_pegawai,$user_id,$nama_pegawai,$jk,$nip,$jabatan,$golongan,$alamat,$notelp);
				set_header_message('success','Tambah Pegawai','Berhasil menambah Pegawai');
				redirect(base_url(akses().'/Pegawai'));
			}else{
				set_header_message('danger','Tambah Pegawai','Gagal menambah Pegawai');
				redirect(base_url(akses().'/Pegawai/add'));
			}			
			
		}else{
			$meta['judul']="Tambah Pegawai";
			$this->load->view('tema/header',$meta);	
			$d['link']=$ref;
	        $d['pengguna']=$this->mod_username->pengguna_data();
	        $d['user_id']=$bearef;		
			$this->load->view(akses().'/karyawan/karyawanadd',$d);
			$this->load->view('tema/footer');			
		}
	}

	public function getAll() {
        $this->db->from("pengguna");
        return $this->db->get();
    }

	function edit()
    {
    	$this->form_validation->set_rules('id_pegawai','ID Jenis Gedung','required');
    	$this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required');
    	$this->form_validation->set_rules('jk','JK','required');
		$this->form_validation->set_rules('nip','NIP','required');
		$this->form_validation->set_rules('jabatan','Jabatan Pegawai','required');
		$this->form_validation->set_rules('golongan','Golongan Pegawai','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('notelp','No.Telp Pegawai','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_pegawai=$this->input->post('id_pegawai');
			$nama_pegawai=$this->input->post('nama_pegawai');
			$jk=$this->input->post('jk');		
			$nip=$this->input->post('nip');
			$jabatan=$this->input->post('jabatan');
			$golongan=$this->input->post('golongan');
			$alamat=$this->input->post('alamat');
			$notelp=$this->input->post('notelp');
			
			if($this->mod_kriteria->edit_master_pegawai($id_pegawai,$nama_pegawai,$jk,$nip,$jabatan,$golongan,$alamat,$notelp)==TRUE)
			{
				set_header_message('success','Ubah Pegawai','Berhasil mengubah Pegawai');
				redirect(base_url(akses()).'/Pegawai');
			}else{
				set_header_message('danger','Ubah Pegawai','Gagal mengubah Pegawai');
				redirect(base_url(akses()).'/Pegawai');
			}
		}else{
			$id=$this->input->get('id');
			$meta['judul']="Ubah Pegawai";
	        $this->load->view('tema/header',$meta);
	        $d['data']=$this->mod_kriteria->Pegawai_data(array('id_pegawai'=>$id));
	        $this->load->view(akses().'/karyawan/karyawanedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		$s=array(
		'id_pegawai'=>$id,
		);
		if($this->m_db->is_bof('pegawai',$s)==FALSE)
		{
			$this->m_db->delete_row('pegawai',$s);
			set_header_message('success','Hapus User','Berhasil Menghapus User');
			redirect(base_url(akses().'/Pegawai'));
		}else{
			set_header_message('danger','Hapus User','Gagal Menghapus User');
			redirect(base_url(akses().'/Pegawai'));
		}
	}


	/*function delete()
	{
		$id=$this->input->get('id_pegawai');
		if($this->mod_kriteria->karyawan_delete($id)==TRUE)
		{
			set_header_message('success','Hapus Kriteria','Berhasil menghapus kriteria');
			redirect(base_url(akses()).'/karyawan/karyawanadd');
		}else{
			set_header_message('danger','Hapus Kriteria','Gagal menghapus kriteria');
			redirect(base_url(akses()).'/karyawan/karyawanadd');
		}
	}*/
	
	private function add_pegawai($table)
	{
		if(!empty($id_pegawai))
		{
			$d=array(
			'user_id'=>$user_id,
			'nama_pegawai'=>$nama_pegawai,
			'jk'=>$jk,
			'nip'=>$nip,
			'jabatan'=>$jabatan,
			'golongan'=>$golongan,
			'alamat'=>$alamat,
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
	
	//var $tabel = 'pengguna';
	function get_username() {  //funtion menampilkan semua provinsi
        //$this->db->select('*');
       	$this->db->from("pengguna");
        //$this->db->where('level','1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    
}
