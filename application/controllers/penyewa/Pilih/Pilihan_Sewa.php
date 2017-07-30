<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pilihan_Sewa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="penyewa")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('mcombox','mod_gedung');
		$this->load->model('Sewa_model','mod_sewa');
		$this->load->model('Pemilihan_model','mod_pilged');
    }

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
    	$sql="SELECT pp.id_pemilih_penyewa,pp.id_penyewa,p.KTP,p.nama_penyewa,p.alamat,p.pekerjaan,p.notelp_penyewa,pg.id_pemilihan_gedung,pg.nama_pemilihan,pg.id_gedung,pp.status FROM (pemilih_penyewa pp LEFT JOIN penyewa p ON pp.id_penyewa = p.id_penyewa LEFT JOIN pemilihan_gedung pg on pp.id_pemilihan_gedung = pg.id_pemilihan_gedung) WHERE p.user_id='$userid'".$s;
    	$meta['judul']="Pemilihan Gedung <small>advanced tables</small>".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/pemilihan_gedung/pemilihan_gedungview',$d);
        $this->load->view('tema/footer');
}
    
    function add()
    {
    	$userid=user_info('user_id');
    	$d['data']=$this->m_db->get_data('pengguna',array('user_id'=>$userid));
    	$bearef=$this->input->get('id');
    	$ref=$bearef?"?id=".$bearef:"";
		$this->form_validation->set_rules('id_pemilihan_gedung','ID Pemilihan Gedung','required');
		$this->form_validation->set_rules('id_penyewa','ID Penyewa','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_penyewa=$this->input->post('id_penyewa');
			$id_pemilihan_gedung=$this->input->post('id_pemilihan_gedung');
			$kriteria=$this->input->post('kriteria');
			
		if($this->mod_pilged->peserta_add($id_penyewa,$id_pemilihan_gedung,$kriteria)==TRUE)
			{
				set_header_message('success','Tambah Pemilihan Gedung','Berhasil menambah Pemilihan Gedung');
				redirect(base_url(akses().'/Pilih/Pilihan_Sewa'.$ref));
			}else{
				set_header_message('danger','Tambah Pemilihan Gedung','Gagal menambah Pemilihan Gedung');
				redirect(base_url(akses().'/Pilih/Pilihan_Sewa/add'.$ref));
			}			
			
		}else{
			$meta['judul']="<i class='fa fa-cube'></i> Pemilihan Gedung";
			$this->load->view('tema/header',$meta);
			$d['link']=$ref;
	        $d['pemilihan_gedung']=$this->mod_pilged->pemilihan_gedung_data();
	        $d['id_pemilihan_gedung']=$bearef;	
	        $d['penyewa']=$this->mod_sewa->sewa_data();
	        $d['kriteria']=$this->mod_kriteria->kriteria_data();
			$this->load->view(akses().'/pemilihan_gedung/pemilihan_gedungadd',$d);
			$this->load->view('tema/footer');
		}
	}

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
