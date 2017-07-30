<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class tipe extends CI_Controller
{
    function __construct()
    {
        parent::__construct();        
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if(akses()!="kepala")
        {
			redirect(base_url().'logout');
		}
		$this->load->model('kriteria_model','mod_kriteria');
    }
    
    function index()
    {
        $meta['judul']="Data Kriteria <small>component tables</small>";
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_kriteria->kriteria_data();
        $this->load->view(akses().'/komponen/kriteria/kriteriaview',$d);
        $this->load->view('tema/footer');
    }
    
    function add()
    {
		$this->form_validation->set_rules('nama','Nama Kriteria','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama=$this->input->post('nama');
			if($this->mod_kriteria->kriteria_add($nama)==TRUE)
			{
				set_header_message('success','Tambah Kriteria','Berhasil menambah kriteria');
				redirect(base_url(akses()).'/unsur/tipe');
			}else{
				set_header_message('danger','Tambah Kriteria','Gagal menambah kriteria');
				redirect(base_url(akses()).'/unsur/tipe/add');
			}
		}else{
			$meta['judul']="Tambah Kriteria";
        	$this->load->view('tema/header',$meta);
        	$this->load->view(akses().'/komponen/kriteria/kriteriaadd');
        	$this->load->view('tema/footer');
		}
	}
	
	function edit()
    {
		$this->form_validation->set_rules('id_kriteria','ID Kriteria','required');
		$this->form_validation->set_rules('nama','Nama Kriteria','required');
		if($this->form_validation->run()==TRUE)
		{
			$id_kriteria=$this->input->post('id_kriteria');
			$nama=$this->input->post('nama');
			if($this->mod_kriteria->kriteria_edit($id_kriteria,$nama)==TRUE)
			{
				set_header_message('success','Ubah Kriteria','Berhasil mengubah kriteria');
				redirect(base_url(akses()).'/unsur/tipe');
			}else{
				set_header_message('danger','Ubah Kriteria','Gagal mengubah kriteria');
				redirect(base_url(akses()).'/unsur/tipe');
			}
		}else{
			$id=$this->input->get('id');
			$meta['judul']="Ubah Kriteria";
        	$this->load->view('tema/header',$meta);
        	$d['data']=$this->mod_kriteria->kriteria_data(array('id_kriteria'=>$id));
        	$this->load->view(akses().'/komponen/kriteria/kriteriaedit',$d);
        	$this->load->view('tema/footer');
		}
	}
	
	function delete()
	{
		$id=$this->input->get('id');
		if($this->mod_kriteria->kriteria_delete($id)==TRUE)
		{
			set_header_message('success','Hapus Kriteria','Berhasil menghapus kriteria');
			redirect(base_url(akses()).'/unsur/tipe');
		}else{
			set_header_message('danger','Hapus Kriteria','Gagal menghapus kriteria');
			redirect(base_url(akses()).'/unsur/tipe');
		}
	}
	
	function subkriteria()
	{
		$kriteria=$this->input->get('kriteria');
        $s=array();
        $nama="";
        if(!empty($kriteria))
        {
			$s=array(
			'id_kriteria'=>$kriteria,
			);
			$exnama=field_value('kriteria','id_kriteria',$kriteria,'nama_kriteria');
			$nama=" ".$exnama;
		}
		$meta['judul']="Parameter".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->mod_kriteria->subkriteria_data($s);
        $d['kriteria']=$kriteria?"?kriteria=".$kriteria:"";
        $this->load->view(akses().'/komponen/kriteria/subkriteria/subkriteriaview',$d);
        $this->load->view('tema/footer');
	}
	
	function subkriteriaadd()
	{
		$this->form_validation->set_rules('id_kriteria','Kriteria Utama','required');
		$this->form_validation->set_rules('nilaiid','Tipe','required');
		if($this->form_validation->run()==TRUE)
		{
			$ref=$this->input->get('kriteria');
			$link=$ref?"?kriteria=".$ref:"";
			$id_kriteria=$this->input->post('id_kriteria');
			$nilaiid=$this->input->post('nilaiid');
			$tipe=$this->input->post('tipe');			
			$max=$this->input->post('max');
			$opmax=$this->input->post('opmax');
			$min=$this->input->post('min');
			$opmin=$this->input->post('opmin');
			$ket=$this->input->post('ket');
			
			$isi='';
			if($tipe=="teks")
			{
				$isi=$ket;
			}elseif($tipe=="nilai"){
				$isi=$max;
			}
			if($this->mod_kriteria->subkriteria_add($tipe,$id_kriteria,$opmax,$isi,$opmin,$min,$nilaiid)==TRUE)
			{
				set_header_message('success','Tambah Parameter','Berhasil menambah parameter');
				redirect(base_url(akses().'/unsur/tipe/subkriteria').$link);
			}else{
				set_header_message('danger','Tambah Parameter','Gagal menambah parameter');
				redirect(base_url(akses().'/unsur/tipe/subkriteriaadd').$link);
			}
		}else{
			$kriteria=$this->input->get('kriteria');
			$link=$kriteria?"?kriteria=".$kriteria:"";
			$nama=field_value('kriteria','id_kriteria',$kriteria,'nama_kriteria');
			$meta['judul']="Tambah Parameter ".$nama;
	        $this->load->view('tema/header',$meta);
	        $d['utama']=$this->mod_kriteria->kriteria_data();
	        $d['nilai']=$this->m_db->get_data('nilai_kategori');
	        $d['kriteria']=$kriteria;
	        $d['link']=$link;
	        $this->load->view(akses().'/komponen/kriteria/subkriteria/subkriteriaadd',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function subkriteriaedit()
    {		
		$this->form_validation->set_rules('subkriteria','Parameter Id','required');
		$this->form_validation->set_rules('id_kriteria','Kriteria Utama','required');
		$this->form_validation->set_rules('nilaiid','Tipe','required');
		if($this->form_validation->run()==TRUE)
		{			
			$ref=$this->input->get('kriteria');
			$link=$ref?"?kriteria=".$ref:"";
			$subID=$this->input->post('subkriteria');
			$id_kriteria=$this->input->post('id_kriteria');
			$nilaiid=$this->input->post('nilaiid');
			$tipe=$this->input->post('tipe');			
			$max=$this->input->post('max');
			$opmax=$this->input->post('opmax');
			$min=$this->input->post('min');
			$opmin=$this->input->post('opmin');
			$ket=$this->input->post('ket');
			
			$isi='';
			if($tipe=="teks")
			{
				$isi=$ket;
			}elseif($tipe=="nilai"){
				$isi=$max;
			}
			if($this->mod_kriteria->subkriteria_edit($subID,$tipe,$id_kriteria,$opmax,$isi,$opmin,$min,$nilaiid)==TRUE)
			{
				set_header_message('success','Ubah Parameter','Berhasil mengubah parameter');
				redirect(base_url(akses().'/unsur/tipe/subkriteria').$link);
			}else{
				set_header_message('danger','Ubah Parameter','Gagal mengubah parameter');
				redirect(base_url(akses().'/unsur/tipe/subkriteria').$link);
			}
		}else{
			$id=$this->input->get('id');
			$kriteria=$this->input->get('kriteria');
			$meta['judul']="Ubah Parameter";
	        $this->load->view('tema/header',$meta);
	        $d['utama']=$this->mod_kriteria->kriteria_data();
	        $d['nilai']=$this->m_db->get_data('nilai_kategori');
	        $d['kriteria']=$kriteria?"?kriteria=".$kriteria:"";
	        $d['data']=$this->mod_kriteria->subkriteria_data(array('subkriteria_id'=>$id));
	        $this->load->view(akses().'/komponen/kriteria/subkriteria/subkriteriaedit',$d);
	        $this->load->view('tema/footer');
		}
	}
	
	function subkriteriadelete()
	{
		$id=$this->input->get('id');
		$kriteria=$this->input->get('kriteria');
		$link=$kriteria?"?kriteria=".$kriteria:"";
		if($this->mod_kriteria->subkriteria_delete($id)==TRUE)
		{
			set_header_message('success','Hapus Parameter','Berhasil menghapus parameter');
			redirect(base_url(akses().'/unsur/tipe/subkriteria').$link);
		}else{
			set_header_message('danger','Hapus Parameter','Gagal menghapus parameter');
			redirect(base_url(akses().'/unsur/tipe/subkriteria').$link);
		}
	}
    
}
