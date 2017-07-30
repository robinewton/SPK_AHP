<?php
if(empty($data))
{
	redirect(base_url(akses().'/analisa/Pilihan_tempat'));
}
foreach($data as $row){	
}
$idpemilihan_gedung=$row->id_pemilihan_gedung;
$IDpemilihan_gedung=$idpemilihan_gedung;
?>
<script type="text/javascript">
function proseshitung()
{
	$.ajax({
		type:'get',
		dataType:'json',
		url:"<?=base_url(akses().'/analisa/Pilihan_tempat/proseshitung');?>",
		data:"id=<?=$idpemilihan_gedung;?>",
		error:function(){
			$("#respon").html('Proses hitung seleksi Pemilihan Pemesanan Gedung gagal');
			$("#error").show();
		},
		beforeSend:function(){
			$("#error").hide();
			$("#respon").html("Sedang bekerja, tunggu sebentar");
		},
		success:function(x){
			if(x.status=="ok")
			{
				alert('Proses seleksi berhasil. Halaman akan direfresh');
				window.location=window.location;
			}else{
				$("#respon").html('Proses hitung seleksi Pemilihan Pemesanan Gedung gagal');
				$("#error").show();
			}
		},
	});
}
</script>

<div id="respon" class="hidden-print"></div>
<?php
$sql="Select COUNT(*) as m FROM pemilih_penyewa Where id_pemilihan_gedung='$idpemilihan_gedung' AND status IN ('Layak Sewa','Tidak Layak Sewa')";
$c=$this->m_db->get_query_row($sql,'m');
if($c < 1)
{
	echo '<div class="alert alert-warning hidden-print" id="error"><i class="glyphicon glyphicon-zoom-in"></i> Pemilihan Pemesanan Gedung  belum diproses. Klik <a href="javascript:;" onclick="proseshitung();">di sini</a> untuk proses.</div>';
}else{	
?>
<a href="<?=base_url('laporan/penerimagedung');?>?id=<?=$idpemilihan_gedung;?>" target="_blank" class="btn btn-success btn-md hidden-print"><i class="fa fa-print"></i> Cetak</a>
<a href="javascript:;" onclick="proseshitung();" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-refresh"></i> Ulangi</a>
<table class="table table-bordered">
<thead>
	<th>Nama Penyewa</th>
	<?php
	$dKriteria=$this->mod_kriteria->kriteria_data();
	if(!empty($dKriteria))
	{
		foreach($dKriteria as $rKriteria)
		{
			echo '<th>'.$rKriteria->nama_kriteria.'</th>';
		}
	}
	?>
	<th>Total</th>
	<th>Status</th>
</thead>
<?php
$s=array(
'id_pemilihan_gedung'=>$IDpemilihan_gedung,
);
if($this->m_db->is_bof('pemilihan_gedung',$s)==FALSE)
{
	$dPeserta=$this->m_db->get_data('pemilih_penyewa',$s);
	if(!empty($dPeserta))
	{
		
		foreach($dPeserta as $rPeserta)
		{
			$IDpemilih_penyewa=$rPeserta->id_pemilih_penyewa;
			$IDpenyewa=$rPeserta->id_penyewa;
			$KTP=field_value('penyewa','id_penyewa',$IDpenyewa,'KTP');
			$nama=field_value('penyewa','id_penyewa',$IDpenyewa,'nama_penyewa');
			
			?>
			<tr>
				<td><?=$KTP." ".$nama;?></td>
				<?php
				$total=0;
				if(!empty($dKriteria))
				{
					foreach($dKriteria as $rKriteria)
					{						
						$id_kriteria=$rKriteria->id_kriteria;
						$subkriteria=peserta_nilai($IDpemilih_penyewa,$id_kriteria);
						$nilaiID=field_value('subkriteria','subkriteria_id',$subkriteria,'nilai_id');
						$nilai=field_value('nilai_kategori','nilai_id',$nilaiID,'nama_nilai');
						$prioritas=ambil_prioritas($IDpemilihan_gedung,$subkriteria);
						$total+=$prioritas;
						echo '<td>'.number_format((double)$prioritas,2).'</td>';
					}
				}
				?>
				<td><?=number_format((double)$total,2);?></td>
				<td><?=ucwords($rPeserta->status);?></td>
			</tr>			
			<?php
			
		}
		
	}else{
		return false;
	}
	
}else{
	return false;
}
?>
</table>
<?php
}
?>