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
	<a href="<?=base_url(akses().'/Sarat/add');?>" class="btn btn-primary btn-flat"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
</div>
<p>&nbsp;</p>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>ID</th>
		<th>Nama Kriteria</th>	
		<th>Jumlah Kriteria</th>	
		<th>Aksi</th>
	</thead>
	<tbody>
		<?php
		$nomor=0;
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$id=$row->id_kriteria;
				$nomor+=1;
			?>
			<tr>
				<td><?php echo $nomor;?></td>
				<td><?=$row->nama_kriteria;?></td>
				<td><?=$row->jumlah_kriteria;?></td>
				<td>
					<a href="<?=base_url(akses().'/Sarat/edit');?>?id=<?=$id;?>" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					<a onclick="return confirm('Yakin ingin menghapus kriteria ini?');" href="<?=base_url(akses().'/Sarat/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>