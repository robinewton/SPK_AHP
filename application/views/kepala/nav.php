<?php

$menu=array(		
	'Komponen'=>array(		
		'icon'=>'glyphicon glyphicon-file',
		'slug'=>'master',
		'child'=>array(
				'Data Kriteria'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/unsur/tipe",
					'target'=>"",
				),
				/*'Proses'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/master/kriteria/add",
					'target'=>"",
				),	*/			
			),
	),
	'Perhitungan'=>array(		
		'icon'=>'glyphicon glyphicon-education',
		'slug'=>'beasiswa',
		'child'=>array(
				'Pemesanan Gedung'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/analisa/pilihan_tempat",
					'target'=>"",
					),
				'Kriteria Pemesanan'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/analisa/Kriteria",
					'target'=>"",
					),
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
	'Persetujuan'=>array(		
		'icon'=>'glyphicon glyphicon-transfer',
		'slug'=>'beasiswa',
		'child'=>array(
				'Pemesanan Gedung'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/persetujuan/Sewa_Tempat",
					'target'=>"",
					),				
			),
	),		
);
?>