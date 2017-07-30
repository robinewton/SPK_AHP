<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sewa_Tempat extends CI_Controller
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
		//$this->load->model('kriteria_model','mod_kriteria');
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
    	$sql="SELECT pg.id_pemesanan_gedung,g.nama_gedung,pgg.nama_penyewa,pe.username,DATE_FORMAT(pg.tgl_acara,'%d-%m-%Y') as tgl_acara,pg.jam_acara,pg.tgl_order,pg.jumlah_pesan,pg.instansi,pg.status,pg.acara FROM (pemesanan_gedung pg LEFT JOIN gedung g ON pg.id_gedung = g.id_gedung LEFT JOIN pengguna pe on pg.user_id = pe.user_id LEFT JOIN penyewa pgg on pe.user_id = pgg.user_id)".$s;
    	//SELECT pg.id_pemesanan_gedung,g.nama_gedung,pe.username,pg.tgl_acara,pg.jam_acara,pg.tgl_order,pg.jumlah_pesan,pg.acara FROM (pemesanan_gedung pg LEFT JOIN gedung g ON pg.id_gedung = g.id_gedung LEFT JOIN pengguna pe on pg.user_id = pe.user_id) WHERE user_id='$id'
        $meta['judul']="<i class='fa fa-building'></i> Pemesanan Gedung <small>advanced tables</small>".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungview',$d);
        $this->load->view('tema/footer');
}
    
   /* function add()
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
		if($this->form_validation->run()==TRUE)
		{
			$user_id=$this->input->post('user_id');
			$id_gedung=$this->input->post('id_gedung');
			$tgl_acara=$this->input->post('tgl_acara');
			$jam_acara=$this->input->post('jam_acara');
			$tgl_order=$this->input->post('tgl_order');
			$jumlah_pesan=$this->input->post('jumlah_pesan');
			$acara=$this->input->post('acara');
			
			$d=array(
			'user_id'=>$user_id,
			'id_gedung'=>$id_gedung,
			'tgl_acara'=>$tgl_acara,
			'jam_acara'=>$jam_acara,
			'tgl_order'=>$tgl_order,
			'jumlah_pesan'=>$jumlah_pesan,
			'acara'=>$acara,
			);
			if($this->m_db->add_row('pemesanan_gedung',$d)==TRUE)
			{
				$id_pemesanan_gedung=$this->m_db->last_insert_id();
				$table="pemesanan_gedung";
				$this->add_gedung($table,$id_pemesanan_gedung,$user_id,$id_gedung,$tgl_acara,$jam_acara,$tgl_order,$jumlah_pesan,$acara);
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
	} */

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
