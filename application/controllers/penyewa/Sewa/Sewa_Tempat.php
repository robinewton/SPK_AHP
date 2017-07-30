<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sewa_Tempat extends CI_Controller
{
    function __construct()
    {
        parent::__construct(); 
        $this->load->helper(array('form', 'url'));       
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="penyewa")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('mcombox','mod_gedung');
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
    	$userid=user_info('user_id');
    	$d['data']=$this->m_db->get_data('pengguna',array('user_id'=>$userid));
    	$id=$this->input->get('id');
    	$s="";
    	$nama="";
    	if(!empty($id))
    	{
			$s=" Where gedung.id_gedung='$id'";
			$nama=" ".field_value('gedung','id_gedung',$id,'nama_gedung');
		}
    	$sql="SELECT pg.id_pemesanan_gedung,g.nama_gedung,pe.username,pg.tgl_acara,pg.jam_acara,pg.tgl_order,pg.jumlah_pesan,pg.status,pg.acara FROM (pemesanan_gedung pg LEFT JOIN gedung g ON pg.id_gedung = g.id_gedung LEFT JOIN pengguna pe on pg.user_id = pe.user_id) WHERE pe.user_id='$userid'".$s;
    	//SELECT pg.id_pemesanan_gedung,g.nama_gedung,pe.username,pg.tgl_acara,pg.jam_acara,pg.tgl_order,pg.jumlah_pesan,pg.acara FROM (pemesanan_gedung pg LEFT JOIN gedung g ON pg.id_gedung = g.id_gedung LEFT JOIN pengguna pe on pg.user_id = pe.user_id) WHERE user_id='$id'
        $meta['judul']="<i class='fa fa-building'></i> Pemesanan Gedung <small>advanced tables</small>".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungview',$d);
        $this->load->view('tema/footer');
}
    public function aksi_upload(){
		$config['upload_path']          = './konten/dokumen/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungadd',$error);
			$this->load->view('tema/footer');
		}else{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungadd',$data);
			$this->load->view('tema/footer');
		}
	}

	function _conf_upload(){
	 $config['upload_path'] = "./konten/dokumen/";
	 $config['allowed_types'] = "doc|docx|pdf|xls|xlsx";
	 $config['max_size'] = "2048";
	 $this->load->library('upload');
	 $this->upload->initialize($config);
	}

	function upload_file(){
	 $this->_conf_upload();
	 if ( ! $this->upload->do_upload()){  // cek apakah ada file yg diupload
	  $status = array('status' => false, 'msg' => $this->upload->display_errors());
	  $this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungadd',$data);
	  $this->load->view('tema/footer');
	 }else{
	  $file = $this->upload->data();
	  // pura-puranya disini ada sebuah proses mengenai file yg d upload.
	  $status = array('status' => true, 'msg' => 'Tugas berhasil di upload');
	  $this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungadd',$data);
	  $this->load->view('tema/footer');
	 }
	 echo(json_encode($status));
	}

	public function do_upload() { 
		$userid=user_info('user_id');
    	$d['data']=$this->m_db->get_data('pengguna',array('user_id'=>$userid));
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('user_id','ID User','required');
		$this->form_validation->set_rules('id_gedung','Nama Gedung','required');
		$this->form_validation->set_rules('tgl_acara','Tgl Acara','required');
		$this->form_validation->set_rules('jam_acara','Jam Acara','required');
		$this->form_validation->set_rules('tgl_order','Tgl Order','required');
		$this->form_validation->set_rules('jumlah_pesan','Jum Pesan','required');
		$this->form_validation->set_rules('acara','Acara','required');
		$this->form_validation->set_rules('userfile','file');
		$this->form_validation->set_rules('instansi','instansi','required');
		$instansi=$this->input->post('Bukan');
         //UPLOAD
         $file = $_FILES['userfile'];
         $file_name = $file['instansi'];
         $config['upload_path']   = './konten/dokumen/'; 
         $config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|xls|xlsx'; 
         $config['max_size']      = 10000; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768;  
         $config['file_name']       = $file['instansi'];
         $this->load->library('upload', $config);
   		 //CEK APAKAH UPLOAD BERHASIL ATAU TIDAK, JIKA TIDAK BERHASIL MUNCULKAN ERROR 
         //JIKA BERHASIL LANJUT KE PROSES SELANJUTNYA
         if ( ! $this->upload->do_upload('userfile')) {
            set_header_message('danger','Tambah Pemesanan Gedung','Gagal menambah Pemesanan Gedung');
			redirect(base_url(akses().'/Sewa/Sewa_Tempat/add'));
         }
         //PROSES MENYIMPAN DATA KE DATABASE
         else { 
            $data['user_id']=$this->input->post('user_id');
            $data['id_gedung']=$this->input->post('id_gedung');
            $data['tgl_acara']=$this->input->post('tgl_acara');
            $data['jam_acara']=$this->input->post('jam_acara');
            $data['tgl_order']=$this->input->post('tgl_order');
            $data['jumlah_pesan']=$this->input->post('jumlah_pesan');
            $data['acara']=$this->input->post('acara');
            $data['instansi']=$this->input->post('instansi');
            $data['path']=$file_name;
            $this->m_file->simpan($data);
            //$this->simpan($data);
            set_header_message('success','Tambah Pemesanan Gedung','Berhasil menambah Pemesanan Gedung');
			redirect(base_url(akses().'/Sewa/Sewa_Tempat'));
         } 
      }


    private function simpan($data){
        $this->db->insert('pemesanan_gedung', $data);
    }

    function add()
    {
    	$userid=user_info('user_id');
    	$d['data']=$this->m_db->get_data('pengguna',array('user_id'=>$userid));
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('user_id','ID User','required');
		$this->form_validation->set_rules('id_gedung','Nama Gedung','required');
		$this->form_validation->set_rules('tgl_acara','Tgl Acara','required');
		$this->form_validation->set_rules('jam_acara','Jam Acara','required');
		$this->form_validation->set_rules('tgl_order','Tgl Order','required');
		$this->form_validation->set_rules('jumlah_pesan','Jum Pesan','required');
		$this->form_validation->set_rules('acara','Acara','required');
		$this->form_validation->set_rules('file','file');
		$this->form_validation->set_rules('instansi','instansi','required');
		$instansi=$this->input->post('Bukan');
		if($this->form_validation->run()==TRUE)
		{
			$user_id=$this->input->post('user_id');
			$id_gedung=$this->input->post('id_gedung');
			$tgl_acara=$this->input->post('tgl_acara');
			$jam_acara=$this->input->post('jam_acara');
			$tgl_order=$this->input->post('tgl_order');
			$jumlah_pesan=$this->input->post('jumlah_pesan');
			$acara=$this->input->post('acara');
			$file=$this->input->post('file');
			$instansi=$this->input->post('instansi');
			
			$d=array(
			'user_id'=>$user_id,
			'id_gedung'=>$id_gedung,
			'tgl_acara'=>$tgl_acara,
			'jam_acara'=>$jam_acara,
			'tgl_order'=>$tgl_order,
			'jumlah_pesan'=>$jumlah_pesan,
			'acara'=>$acara,
			'file'=>$file,
			'instansi'=>$instansi,
			);
			// Baca lokasi file sementara dan nama file dari form (file)
			$lokasi_file = $_FILES['file']['tmp_name'];
			$nama_file   = $_FILES['file']['instansi'];

			// Tentukan folder untuk menyimpan file
			$folder = "./konten/dokumen/$nama_file";
			if($this->m_db->add_row('pemesanan_gedung',$d)==TRUE)
			{
				$id_pemesanan_gedung=$this->m_db->last_insert_id();
				$table="pemesanan_gedung";
				$this->add_gedung($table,$id_pemesanan_gedung,$user_id,$id_gedung,$tgl_acara,$jam_acara,$tgl_order,$jumlah_pesan,$acara,$file,$instansi);
				set_header_message('success','Tambah Pemesanan Gedung','Berhasil menambah Pemesanan Gedung');
				redirect(base_url(akses().'/Sewa/Sewa_Tempat'));
			}else{
				set_header_message('danger','Tambah Pemesanan Gedung','Gagal menambah Pemesanan Gedung');
				redirect(base_url(akses().'/Sewa/Sewa_Tempat/add'));
			}			
			
		}else{
			$meta['judul']="<i class='fa fa-building'></i> Pemesanan Gedung";
			$this->load->view('tema/header',$meta);
			$d['link']=$ref;
	        $d['gedung']=$this->mod_gedung->nama_gedung_data();
	        $d['id_gedung']=$bearef;	
			$this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungadd',$d);
			$this->load->view('tema/footer');
		}
	}

	/*function edit()
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
	}*/
	
	function delete()
	{
		$id=$this->input->get('id');
		$s=array(
		'id_pemesanan_gedung'=>$id,
		);
		if($this->m_db->is_bof('pemesanan_gedung',$s)==FALSE)
		{
			$this->m_db->delete_row('pemesanan_gedung',$s);
			set_header_message('success','Hapus Pemesanan Gedung','Berhasil Menghapus Pemesanan Gedung');
			redirect(base_url(akses().'/Sewa/Sewa_Tempat'));
		}else{
			set_header_message('danger','Hapus Pemesanan Gedung','Gagal Menghapus Pemesanan Gedung');
			redirect(base_url(akses().'/Sewa/Sewa_Tempat'));
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