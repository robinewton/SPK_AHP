<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class mcombox extends CI_Model
{   
    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function pengguna_data($where=array(),$order="username ASC")
    {
        $d=$this->m_db->get_data('pengguna',$where,$order);
        return $d;
    }

    function jenis_gedung_data($where=array(),$order="Nama_Jenis ASC")
    {
        $d=$this->m_db->get_data('jenis_gedung',$where,$order);
        return $d;
    }

    function nama_gedung_data($where=array(),$order="nama_gedung ASC")
    {
        $d=$this->m_db->get_data('gedung',$where,$order);
        return $d;
    }
}