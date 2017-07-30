<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sewa_model extends CI_Model
{
	private $tb_penyewa='penyewa';
    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function sewa_data($where=array(),$order="nama_penyewa ASC")
    {
		$d=$this->m_db->get_data($this->tb_penyewa,$where,$order);
		return $d;
	}
	
}