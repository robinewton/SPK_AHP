<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Charts_model extends CI_Model
{   
	private $tb_pemesanan='pemesanan_gedung';
    function __construct()
    {
         $this->load->library('m_db');
    }
    //SELECT nama_gedung, sum(nama_gedung='Pendopo Jayengrono') as jumlah FROM pemesanan_gedung pg join gedung g on pg.id_gedung=g.id_gedung WHERE status='Telah Disetujui';
    function pemesanan_gedung_data($where=array(),$order="username ASC")
    {
        $d=$this->m_db->get_data('pemesanan_gedung',$where,$order);
        return $d;
    }
	
	function pemesanan_data($table,$where=array(),$order='',$group='',$limit=null,$start=null){


		if(!empty($table))	{
			if(!empty($where)){
				$this->CI->db->where($where);
			}

			if(!empty($order)){
				$this->CI->db->order_by($order);
			}

			if(!empty($group)){
				$this->CI->db->group_by($group);
			}

			if(!empty($limit)){
				$this->CI->db->limit($limit,$start);
			}

			$result=$this->CI->db->get($table);
			if($result->num_rows() > 0){
				return $result->result();
			}else{
				return null;
			}
		}else{
			$this->noTable();
		}
	}
	
	function report(){
        $query = $this->db->query("SELECT nama_gedung, sum(jumlah_pesan) as jumlah FROM pemesanan_gedung pg join gedung g on pg.id_gedung=g.id_gedung WHERE status='Telah Disetujui'");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
	
}