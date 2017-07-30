<?php
$menu = array(
    'Master' => array(
        'icon' => 'fa fa-table',
        'slug' => 'Master',
        'child' => array(
            'Data Pegawai' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/Pegawai",
                'target' => "",
            ),
            'Data Account' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/users",
                'target' => "",
            ),
            'Data Penyewa' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/Pemesan",
                'target' => "",
            ),
            'Data Jenis Gedung' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/Macam_Tempat",
                'target' => "",
            ),
            'Data Gedung' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/Tempat",
                'target' => "",
            ),
        ),
    ),
    /*'Monitoring'=>array(
        'icon'=>'glyphicon glyphicon-eye-open',
        'slug'=>'Analisa',
        'child'=>array(
                'Pemesanan'=>array(
                    'icon'=>'fa fa-circle-o',
                    'url'=>base_url(akses())."/Sewa_Tempat",
                    'target'=>"",
                    ),
            ),
    ),*/
    'Analisa' => array(
        'icon' => 'glyphicon glyphicon-bullhorn',
        'slug' => 'Analisa',
        'child' => array(
            'Pemesanan' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/Sewa_Tempat",
                'target' => "",
            ), 'Pengembalian' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/pengembalian",
                'target' => "",
            ),
            'Kriteria' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/kriteria",
                'target' => "",
            ),
            'Grafik Pemesanan' => array(
                'icon' => 'fa fa-circle-o',
                'url' => base_url(akses()) . "/Charts",
                'target' => "",
            ),
        ),
    ),
);
?>