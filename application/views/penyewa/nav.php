<?php

$menu=array(
	'Pemesanan'=>array(		
		'icon'=>'fa fa-building',
		'slug'=>'beasiswa',
		'child'=>array(
				'Pemesanan Gedung'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/Sewa/Sewa_Tempat",
					'target'=>"",
					),
				/*'Tambah Gedung'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/Sewa/Sewa_Tempat/add",
					'target'=>"",
					),*/
				/*'A'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/unsur/kriteria",
					'target'=>"",
					),
				'B'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/unsur/peserta",
					'target'=>"",
					),*/				
			),
	),			
	'Analisa'=>array(		
		'icon'=>'fa fa-cube',
		'slug'=>'master',
		'child'=>array(
				'Data Kriteria'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/Pilih/Pilihan_Sewa",
					'target'=>"",
				),
				/*'Proses'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/master/kriteria/add",
					'target'=>"",
				),	*/			
			),
	),
);
?>