<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('m_db');
        if (akses() != "staff") {
            redirect(base_url() . 'logout');
        }
        //$this->load->model('kriteria_model','mod_kriteria');
        $this->load->model('mcombox', 'mod_gedung');
    }



    public function index(){
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
        $sql="SELECT * from pengembalian_gedung";
        $d['data']=$this->m_db->get_query_data($sql);
        $meta['judul']="<i class='fa fa-building'></i> Pengembalian Gedung <small>advanced tables</small>".$nama;
        $this->load->view('tema/header',$meta);

        $this->load->view(akses().'/pengembalian_gedung/pengembalian_gedungview',$d);
        $this->load->view('tema/footer');

    }

    function add(){
        $meta['judul']="<i class='fa fa-building'></i> Input Pengembalian Gedung";
        $this->load->view('tema/header',$meta);
//        $sql1 = "SELECT * from pengembalian_gedung p join pengguna u on p.id_pengembalian = u.user_id JOIN pemesanan_gedung pm on u.user_id = pm.id_pemesanan_gedung JOIN gedung ge on pm.id_pemesanan_gedung = ge.id_gedung";
        $sql1 = "select * from penyewa";
        $d['record'] = $this->db->query($sql1)->result();
        $sql2 = "select * from gedung";
        $d['record1'] = $this->db->query($sql2)->result();
        $this->load->view(akses().'/pengembalian_gedung/pengembalianadd',$d);
        $this->load->view('tema/footer');
    }

    function addall(){
            $userid = user_info('username');
            $sqlid = "SELECT user_id from pengguna where username='$userid'";
            $id_user = $this->db->query($sqlid)->row()->user_id;
        if (isset($_POST['submit'])){
            $nama=$this->input->post('datapeengembalian');
            $ktp=$this->input->post('ktpPengembali');
            $namagedung=$this->input->post('namaGedung');
            $alamat=$this->input->post('alamatText');
            $noTlp=$this->input->post('noTlp');
            $Pekerjaan=$this->input->post('Pekerjaan');
            $tglPengembalian=$this->input->post('tglPengembalian');
            $jamPengembalian=$this->input->post('jamPengembalian');
            $id_gedung=$this->input->post('id_gedung');
            $isi=array(
                'user_id'=> $id_user,
                'id_gedung'=> $id_gedung,
                'nama_pengembali_gedung'=> $nama,
                'ktp_pengembalian_gedung' => $ktp ,
                'alamat_pengembali_gedung' => $alamat ,
                'tlp_pengembali_gedung' => $noTlp ,
                'pekerjaan_pengembali_gedung' => $Pekerjaan ,
                'tanggal_pengembalian' => strtotime($tglPengembalian) ,
                'jam_pengembalian' => $jamPengembalian ,
            );

            $this->db->insert("pengembalian_gedung", $isi);
//            $this->session->set_flashdata('sukses_msg', 'Berhasil Menambahkan Motor Pelanggan');
            redirect(base_url('staff/pengembalian/'));

            print_r($isi);
        }else{
            redirect("staff/pengembalian/add");
        }
    }
}