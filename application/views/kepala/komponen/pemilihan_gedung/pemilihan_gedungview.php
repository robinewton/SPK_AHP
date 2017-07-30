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
	<a href="<?=base_url(akses().'/analisa/pilihan_tempat/add');?>" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
</div>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>No</th>
		<th>Nama Gedung</th>
		<th>Nama Jenis</th>	
		<th>Tahun</th>	
		<th>Kuota</th>		
		<th>Aksi</th>
	</thead>
	<tbody>
		<?php
		$no=0;
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$no+=1;
				$id=$row->id_pemilihan_gedung;
			?>
			<tr>
				<td width="10%"><?=$no;?></td>
				<td width="30%"><?=$row->nama_gedung;?></td>
				<td width="15%"><?=$row->Nama_Jenis;?></td>
				<td width="10%"><?=$row->tahun;?></td>
				<td width="10%"><?=$row->kuota;?></td>
				<td>
					<a title="Proses Pemilihan Gedung" href="<?=base_url(akses().'/analisa/pilihan_tempat/proses');?>?id=<?=$id;?>" class="btn btn-xs btn-success"><i class="fa fa-users"></i> Penyewa</a>
					<a title="Edit Kriteria" href="<?=base_url(akses().'/analisa/pilihan_tempat/edit');?>?id=<?=$id;?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
					<a title="Hapus Kriteria" onclick="return confirm('Yakin ingin menghapus pemilihan pemesanan gedung ini?');" href="<?=base_url(akses().'/analisa/pilihan_tempat/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>