<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kriteria extends CI_Controller
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
		$this->load->model('Pemilihan_model','mod_pilihan');
    }
    
    function index()
    {        
        $meta['judul']="Kriteria Pemesanan Gedung";
        $this->load->view('tema/header',$meta);
        $d['pemilihan_gedung']=$this->mod_pilihan->pemilihan_gedung_data();
        $this->load->view(akses().'/perhitungan/matriks/kriteriacontainer',$d);
        $this->load->view('tema/footer');
    }
    
    function gethtml()
    {
    	$id=$this->input->get('pemilihan_gedung');
		$output=array();
        $dKriteria=$this->mod_kriteria->kriteria_data();
		foreach($dKriteria as $rK)
		{
			$output[$rK->id_kriteria]=$rK->nama_kriteria;
		}		
    	$d['arr']=$output;
    	$d['id_pemilihan_gedung']=$id;
    	$this->load->view(akses().'/perhitungan/matriks/matrikutama',$d);
	}
	
	function getsubcontainer()
	{
		$id=$this->input->get('id_pemilihan_gedung');
		$d['kriteria']=$this->mod_kriteria->kriteria_data();
		$d['id_pemilihan_gedung']=$id;
		$this->load->view(akses().'/perhitungan/matriks/subcontainer',$d);
	}
	
	function getsub()
	{		
		$pemilihan_gedung=$this->input->get('pemilihan_gedung');
		$id=$this->input->get('kriteria');
    	$namaKriteria=$this->mod_kriteria->kriteria_info($id,'nama_kriteria');
    	$dSub=$this->mod_kriteria->subkriteria_child($id,'nilai_id ASC');
    	$output=array();
    	if(!empty($dSub))
    	{					
		foreach($dSub as $rK)
		{
			$nama=field_value('nilai_kategori','nilai_id',$rK->nilai_id,'nama_nilai');
			$output[$rK->subkriteria_id]=$nama;
		}
		}
    	$d['arr']=$output;
    	$d['id_kriteria']=$id;
    	$d['id_pemilihan_gedung']=$pemilihan_gedung;
    	$d['namakriteria']=$namaKriteria;
    	$this->load->view(akses().'/perhitungan/matriks/matriksub',$d);
	}
    
    function add()
    {
		$this->form_validation->set_rules('nama','Nama Kriteria','required');
		if($this->form_validation->run()==TRUE)
		{
			$nama=$this->input->post('nama');
			if($this->mod_kriteria->kriteria_add($nama)==TRUE)
			{
				redirect(base_url(akses()).'/ahp/kriteria');
			}else{
				redirect(base_url(akses()).'/ahp/kriteria/add');
			}
		}else{
			$meta['judul']="Tambah Kriteria Utama";
        	$this->load->view('tema/header',$meta);
        	$this->load->view(akses().'/ahp/kriteria/kriteriaadd');
        	$this->load->view('tema/footer');
		}
	}
    
    function updatedata()
    {
		foreach($_POST as $k=>$v)
		{
			$s=array(
			'id_kriteria'=>$k,
			);
			$d=array(
			'nama_kriteria'=>$v,
			);
			$this->m_db->edit_row('kriteria',$d,$s);
		}
		redirect(base_url(akses().'/ahp/kriteria'));
	}
	
	function deletedata()
	{
		$s=array(
		'id_kriteria'=>$this->input->get('id'),
		);		
		$this->m_db->delete_row('kriteria',$s);
		redirect(base_url(akses().'/ahp/kriteria'));
	}
    
    function updateutama()
    {
    	$error=FALSE;
    	$id_pemilihan_gedung=$this->input->post('id_pemilihan_gedung');
    	if(!empty($id_pemilihan_gedung))
    	{
			
		
    	$msg="";
    	$s=array(
    	'kriteria_nilai_id !='=>''
    	);
    	$this->m_db->delete_row('kriteria_nilai',$s);
    	    	
    	$cr=$this->input->post('crvalue');
    	if($cr > 0.01)
    	{
    		$msg="Gagal diupdate karena nilai CR kurang dari 0.01";
			$error=TRUE;
		}else{
			foreach($_POST as $k=>$v)
			{
				if($k!="crvalue" && $k!="id_pemilihan_gedung")
				{									
				foreach($v as $x=>$x2)
				{
					$d=array(
					'id_pemilihan_gedung'=>$id_pemilihan_gedung,
					'kriteria_id_dari'=>$k,
					'kriteria_id_tujuan'=>$x,
					'nilai'=>$x2,
					);
					$this->m_db->add_row('kriteria_nilai',$d);
				}
				}
			}
			$msg="Berhasil update nilai kriteria";
			$error=FALSE;
		}
    			
    	
    	if($error==FALSE)
    	{			
			echo json_encode(array('status'=>'ok','msg'=>$msg));
		}else{
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
		}else{
			$msg="Gagal mengubah nilai kriteria";
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
	}
	
	function updatesub()
    {
    	$error=FALSE;
    	$id_pemilihan_gedung=$this->input->post('id_pemilihan_gedung');
    	$id_kriteria=$this->input->post('id_kriteria');
    	if(!empty($id_pemilihan_gedung) && !empty($id_kriteria))
    	{
			
		
    	$msg="";
    	$s=array(
    	'id_pemilihan_gedung'=>$id_pemilihan_gedung,
    	'id_kriteria'=>$id_kriteria,
    	);
    	$this->m_db->delete_row('subkriteria_nilai',$s);
    	    	
    	$cr=$this->input->post('crvalue');
    	if($cr > 0.01)
    	{
    		$msg="Gagal diupdate karena nilai CR kurang dari 0.01";
			$error=TRUE;
		}else{
			foreach($_POST as $k=>$v)
			{
				if($k!="crvalue" && $k!="id_pemilihan_gedung" && $k!="id_kriteria")
				{									
				foreach($v as $x=>$x2)
				{
					$d=array(
					'id_pemilihan_gedung'=>$id_pemilihan_gedung,
					'id_kriteria'=>$id_kriteria,
					'subkriteria_id_dari'=>$k,
					'subkriteria_id_tujuan'=>$x,
					'nilai'=>$x2,
					);
					$this->m_db->add_row('subkriteria_nilai',$d);
				}
				}
			}
			$msg="Berhasil update nilai subkriteria";
			$error=FALSE;
		}
    			
    	
    	if($error==FALSE)
    	{			
			echo json_encode(array('status'=>'ok','msg'=>$msg));
		}else{
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
		}else{
			$msg="Gagal mengubah nilai subkriteria";
			echo json_encode(array('status'=>'no','msg'=>$msg));
		}
		
	}
	
	function updatesubprioritas()
	{
		$id_pemilih_penyewa=$this->input->post('id_pemilih_penyewa');
    	$id_kriteria=$this->input->post('id_kriteria');
    	$prio=$this->input->post('prio');
    	if(!empty($prio))
    	{
			foreach($prio as $rk=>$rv)
			{
				$s=array(
				'id_pemilihan_gedung'=>$id_pemilih_penyewa,
				'subkriteria_id'=>$rk,
				);
				if($this->m_db->is_bof('subkriteria_hasil',$s)==TRUE)
				{
					$d=array(
					'id_pemilihan_gedung'=>$id_pemilih_penyewa,
					'subkriteria_id'=>$rk,
					'prioritas'=>$rv,
					);
					$this->m_db->add_row('subkriteria_hasil',$d);
				}else{
					$d=array(					
					'prioritas'=>$rv,
					);
					$this->m_db->edit_row('subkriteria_hasil',$d,$s);
				}
			}
			echo json_encode('ok');
		}else{
			echo json_encode('no');
		}
	}
    
}
