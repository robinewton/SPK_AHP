<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class mmaster extends CI_Model
{	
    function __construct()
    {
         $this->load->library('m_db');
    }
	
	function master_JenisGedung_edit($id_jenis_gedung,$Nama_Jenis)
	{
		$s=array(
		'id_jenis_gedung'=>$id_jenis_gedung,
		);
		$d=array(
		'Nama_Jenis'=>$Nama_Jenis,
		);
		if($this->m_db->edit_row('jenis_gedung',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
}