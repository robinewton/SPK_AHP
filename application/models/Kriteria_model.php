<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kriteria_model extends CI_Model
{	
	private $tb_kriteria='kriteria';
	private $tb_jenis='jenis_gedung';	
	private $tb_gedung='gedung';	
	private $tb_penyewa='penyewa';	
	private $tb_pegawai='pegawai';	
	private $tb_kriteria_nilai='kriteria_nilai';
	private $tb_pemesanan_gedung=' pemesanan_gedung';
	private $tb_subkriteria='subkriteria';
    function __construct()
    {
         $this->load->library('m_db');
    }

    function cekNama_Id($id_gedung,$tgl_acara,$jam_acara){
		$this->db->where('id_gedung',$id_gedung);
        $this->db->where('tgl_acara',$tgl_acara);
        $this->db->where('jam_acara',$jam_acara);
        return $this->db->get("pemesanan_gedung");
    }
    
    function kriteria_data($where=array(),$order="id_kriteria ASC")
    {
		$d=$this->m_db->get_data($this->tb_kriteria,$where,$order);
		return $d;
	}

	function pegawai_data($where=array(),$order="id_pegawai ASC")
    {
		$d=$this->m_db->get_data($this->tb_pegawai,$where,$order);
		return $d;
	}

	function gedung_data($where=array(),$order="id_gedung ASC")
    {
		$d=$this->m_db->get_data($this->tb_gedung,$where,$order);
		return $d;
	}

	function Jenis_data($where=array(),$order="id_jenis_gedung ASC")
    {
		$d=$this->m_db->get_data($this->tb_jenis,$where,$order);
		return $d;
	}

	function penyewa_data($where=array(),$order="id_penyewa ASC")
    {
		$d=$this->m_db->get_data($this->tb_penyewa,$where,$order);
		return $d;
	}
	
	function kriteria_info($id_kriteria,$output)
	{
		$s=array(
		'id_kriteria'=>$id_kriteria,
		);
		$item=$this->m_db->get_row($this->tb_kriteria,$s,$output);
		return $item;
	}
	
	function kriteria_add($nama)
	{
		$d=array(
		'nama_kriteria'=>$nama,
		);
		if($this->m_db->add_row($this->tb_kriteria,$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}

	public function get_user(){
        return $this->db->get("pengguna");
    }
	
	function kriteria_edit($id_kriteria,$nama)
	{
		$s=array(
		'id_kriteria'=>$id_kriteria,
		);
		$d=array(
		'nama_kriteria'=>$nama,
		);
		if($this->m_db->edit_row($this->tb_kriteria,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function edit_master_jenis($id_jenis_gedung,$Nama_Jenis)
	{
		$s=array(
		'id_jenis_gedung'=>$id_jenis_gedung,
		);
		$d=array(
		'Nama_Jenis'=>$Nama_Jenis,
		);
		if($this->m_db->edit_row($this->tb_jenis,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}

	function edit_master_pemesanangedung($id_pemesanan_gedung,$status)
	{
		$s=array(
		'id_pemesanan_gedung'=>$id_pemesanan_gedung,
		);
		$d=array(
		'status'=>$status,
		);
		if($this->m_db->edit_row($this->tb_pemesanan_gedung,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}

	function edit_master_gedung($id_gedung,$nama_gedung)
	{
		$s=array(
		'id_gedung'=>$id_gedung,
		);
		$d=array(
		'nama_gedung'=>$nama_gedung,
		);
		if($this->m_db->edit_row($this->tb_gedung,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}

	function edit_master_penyewa($id_penyewa,$KTP,$nama_penyewa,$alamat,$pekerjaan,$notelp_penyewa)
	{
		$s=array(
		'id_penyewa'=>$id_penyewa,		
		);
		$d=array(
		'KTP'=>$KTP,
		'nama_penyewa'=>$nama_penyewa,
		'alamat'=>$alamat,
		'pekerjaan'=>$pekerjaan,
		'notelp_penyewa'=>$notelp_penyewa,
		);
		if($this->m_db->edit_row($this->tb_penyewa,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}

	function edit_master_pegawai($id_pegawai,$nama_pegawai,$jk,$nip,$jabatan,$golongan,$alamat,$notelp)
	{
		$s=array(
		'id_pegawai'=>$id_pegawai,		
		);
		$d=array(
		'nama_pegawai'=>$nama_pegawai,
		'nip'=>$nip,
		'jk'=>$jk,
		'jabatan'=>$jabatan,
		'golongan'=>$golongan,
		'alamat'=>$alamat,
		'notelp'=>$notelp,
		);
		if($this->m_db->edit_row($this->tb_pegawai,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}

	function kriteria_delete($id_kriteria)
	{
		$s=array(
		'id_kriteria'=>$id_kriteria,
		);
		if($this->m_db->delete_row($this->tb_kriteria,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function subkriteria_data($where=array(),$order="nama_subkriteria ASC")
	{
		$d=$this->m_db->get_data($this->tb_subkriteria,$where,$order);
		return $d;
	}
	
	function subkriteria_child($id_kriteria,$order="nama_subkriteria")
	{
		$s=array(
		'id_kriteria'=>$id_kriteria,
		);
		$d=$this->subkriteria_data($s,$order);
		return $d;
	}
	
	function subkriteria_add($tipe,$kriteria,$opmax=NULL,$max,$opmin=NULL,$min,$nilai)
	{
		$d=array();
		if($tipe=="teks")
		{
			$d=array(
			'nama_subkriteria'=>$max,
			'id_kriteria'=>$kriteria,
			'tipe'=>$tipe,
			'nilai_id'=>$nilai,
			);
		}else{
			$d=array(
			'nama_subkriteria'=>$opmin." ".$min." ".$opmax." ".$max,
			'id_kriteria'=>$kriteria,
			'tipe'=>$tipe,
			'nilai_minimum'=>$min,
			'nilai_maksimum'=>$max,
			'op_min'=>$opmin,
			'op_max'=>$opmax,
			'nilai_id'=>$nilai,
			);
		}
		
		if($this->m_db->add_row($this->tb_subkriteria,$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function subkriteria_edit($subkriteriaID,$tipe,$kriteria,$opmax=NULL,$max,$opmin=NULL,$min,$nilai)
	{
		$s=array(
		'subkriteria_id'=>$subkriteriaID,
		);
		$d=array();
		if($tipe=="teks")
		{
			$d=array(
			'nama_subkriteria'=>$max,
			'id_kriteria'=>$kriteria,
			'tipe'=>$tipe,
			'nilai_id'=>$nilai,
			);
		}else{
			$d=array(
			'nama_subkriteria'=>$opmin." ".$min." ".$opmax." ".$max,
			'id_kriteria'=>$kriteria,
			'tipe'=>$tipe,
			'nilai_minimum'=>$min,
			'nilai_maksimum'=>$max,
			'op_min'=>$opmin,
			'op_max'=>$opmax,
			'nilai_id'=>$nilai,
			);
		}
		
		if($this->m_db->edit_row($this->tb_subkriteria,$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function subkriteria_delete($subKriteriaID)
	{
		$s=array(
		'subkriteria_id'=>$subKriteriaID,
		);
		if($this->m_db->delete_row($this->tb_subkriteria,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
}