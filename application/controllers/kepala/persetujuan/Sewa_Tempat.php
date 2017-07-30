<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sewa_Tempat extends CI_Controller
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
		//$this->load->model('kriteria_model','mod_kriteria');
		$this->load->model('mcombox','mod_gedung');
		$this->load->model('kriteria_model','mod_kriteria');
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
    	$sql="SELECT pg.id_pemesanan_gedung,g.nama_gedung,pgg.nama_penyewa,pe.username,DATE_FORMAT(pg.tgl_acara,'%d-%m-%Y') as tgl_acara,pg.jam_acara,pg.tgl_order,pg.jumlah_pesan,pg.instansi,pg.status,pg.file,pg.acara FROM (pemesanan_gedung pg LEFT JOIN gedung g ON pg.id_gedung = g.id_gedung LEFT JOIN pengguna pe on pg.user_id = pe.user_id LEFT JOIN penyewa pgg on pe.user_id = pgg.user_id) where pg.status='Belum Disetujui'".$s;
    	//SELECT pg.id_pemesanan_gedung,g.nama_gedung,pe.username,pg.tgl_acara,pg.jam_acara,pg.tgl_order,pg.jumlah_pesan,pg.acara FROM (pemesanan_gedung pg LEFT JOIN gedung g ON pg.id_gedung = g.id_gedung LEFT JOIN pengguna pe on pg.user_id = pe.user_id) WHERE user_id='$id'
        $meta['judul']="<i class='fa fa-building'></i> Pemesanan Gedung <small>Transaction tables</small>".$nama;
        $this->load->view('tema/header',$meta);
        $d['data']=$this->m_db->get_query_data($sql);
        $d['link']=$ref;
        $this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungview',$d);
        $this->load->view('tema/footer');
}
    
   	function update()
    {
    	//$bearef=$this->input->get('id');
    	//$ref=$bearef?"?id=".$bearef:"";
    	//$userid=user_info('user_id');
    	//$d['data']=$this->m_db->get_data('pengguna',array('user_id'=>$userid));
    	/*$id=$this->input->get('id');
    	$query = "UPDATE pemesanan_gedung 
					set Status = 'Telah Disetujui'
				 WHERE Id_Pertanyaan = '$id' AND Status = 'Belum Disetujui' ";
		//$hasil =  mysql_query($query);
		set_header_message('success','Persetujuan','Berhasil menyetujui Data Pemesanan Gedung');
	    //$d['data']=$this->mod_kriteria->gedung_data(array('id_gedung'=>$id));
	    $this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungview');
	    $this->load->view('tema/footer');*/

	    	
	    	$d=array(	    
			'Status'=>$status='Telah Disetujui',
			);
			if($this->m_db->edit_row('pemesanan_gedung',$d)==TRUE)
			{
				$id_jenis_gedung=$this->m_db->last_insert_id();
				$table="pemesanan_gedung";
				$this->mod_kriteria->edit_master_pemesanangedung($table,$Status);
				set_header_message('success','Persetujuan Pemesanan','Berhasil Menyetujui Pemesanan Gedung');
				redirect(base_url(akses().'/persetujuan/Sewa_Tempat'));
				$meta['judul']="<i class='fa fa-building'></i> Pemesanan Gedung <small>Transaction tables</small>".$nama;
       		    $this->load->view('tema/header',$meta);
				$this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungview');
				$this->load->view('tema/footer');
			}else{
				set_header_message('danger','Persetujuan Pemesanan','Gagal Menyetujui Pemesanan Gedung');
				redirect(base_url(akses().'/persetujuan/Sewa_Tempat'));
				$meta['judul']="<i class='fa fa-building'></i> Pemesanan Gedung <small>Transaction tables</small>".$nama;
        		$this->load->view('tema/header',$meta);
				$this->load->view(akses().'/pemesanan_gedung/pemesanan_gedungview');
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
	
	private function update_status($table)
	{
		if(!empty($id_gedung))
		{
			$status='Telah Disetujui';
			$d=array(
			'Status'=>$status,
			);
			if($this->m_db->update_row($table,$d)==TRUE)
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
