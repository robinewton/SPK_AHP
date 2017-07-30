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
	<a href="<?=base_url(akses().'/Pemesan/add');?>" class="btn btn-primary btn-flat"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
</div>
<p>&nbsp;</p>
<table class="table table-border table-hover" id="datatable">
	<thead>		
		<th>ID</th>
		<th>KTP</th>
		<th>Nama Penyewa</th>
		<th>Username</th>		
		<th>Alamat</th>
		<th>Pekerjaan</th>
		<th>No. Telp</th>
		<th>Aksi</th>
	</thead>
	<tbody>
		<?php
		$nomor=0;
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$id=$row->id_penyewa;
				$nomor+=1;
			?>
			<tr>
				<td><?php echo $nomor;?></td>
				<td><?=$row->KTP;?></td>
				<td><?=$row->nama_penyewa;?></td>
				<td><?=$row->username;?></td>			
				<td><?=$row->alamat;?></td>
				<td><?=$row->pekerjaan;?></td>
				<td><?=$row->notelp_penyewa;?></td>
				<td>
					<a href="<?=base_url(akses().'/Pemesan/edit');?>?id=<?=$id;?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a onclick="return confirm('Yakin ingin menghapus Penyewa ini?');" href="<?=base_url(akses().'/Pemesan/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>