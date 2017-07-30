<img src="<?php echo base_url(); ?>konten/images/SPK_UPT.png" style="width:100%;height:120px"><hr>	
<?php
foreach($data as $row){	
}
$idpemilihan_gedung=$row->id_pemilihan_gedung;
$IDpemilihan_gedung=$idpemilihan_gedung;
?>
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
						$prioritas=ambil_prioritas($idpemilihan_gedung,$subkriteria);
						$total+=$prioritas;
						echo '<td>'.number_format((double)$prioritas,2).'</td>';
					}
				}
				?>
				<td><?=number_format($total,2);?></td>
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