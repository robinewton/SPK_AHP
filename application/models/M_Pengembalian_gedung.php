<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Pengembalian_gedung extends CI_Model
{
    private $tb_penyewa='pengembalian_gedung';
    function __construct()
    {
        $this->load->library('m_db');
    }

    function sewa_data($where=array(),$order="tanggal_pengembalian ASC")
    {
        $d=$this->m_db->get_data($this->tb_penyewa,$where,$order);
        return $d;
    }

}