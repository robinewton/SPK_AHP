<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#datatable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
});
</script>
<div>
	<a href="<?=base_url(akses().'/Pilih/Pilihan_Sewa/add'.$link);?>" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
</div>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>KTP</th>
		<th>Nama</th>
		<th>Pekerjaan</th>
		<th>No. Telp</th>
		<th>Pilihan Gedung</th>
		<th>Status</th>
		<th>Aksi</th>
	</thead>
	<tbody>
		<?php
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$id=$row->id_penyewa;
				$idg=$row->id_gedung;
				$pid=$row->id_pemilih_penyewa;
			?>
			<tr>
				<td><?=$row->KTP;?></td>				
				<td><?=$row->nama_penyewa;?></td>
				<!--<td><?//=$row->kelas." ".$row->jurusan;?></td>-->				
				<td><?=$row->pekerjaan;?></td>
				<td><?=$row->notelp_penyewa;?></td>
				<td><?=$row->nama_pemilihan;?></td>
				<td><?=ucwords($row->status);?></td>
				<?php  if($row->status != 'Layak Sewa'){ ?>
				<td>
					<a onclick="return confirm('Yakin ingin menghapus Pemesanan Gedung ini?');" href="<?=base_url(akses().'/Sewa/Sewa_Tempat/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
				</td>
				<?php }else{?>
				<td>
					<a onclick="return confirm('Yakin ingin melakukan Pemesanan Gedung ini?');" href="<?=base_url(akses().'/Sewa/Sewa_Tempat/add');?>?id=<?=$idg;?>" class="btn btn-xs btn-success"><i class="fa fa-send"></i> Pesan</a>
				</td>
				<?php }?>
			</tr>
			<?php 
			}
		}
		?>
	</tbody>
</table>