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
	<a href="<?=base_url(akses().'/users/add');?>" class="btn btn-primary btn-flat"><i class="glyphicon glyphicon-plus"></i> Tambah</a>
</div>
<p>&nbsp;</p>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>ID</th>
		<th>Nama</th>
		<th>Username</th>
		<th>Password</th>		
		<th>Akses</th>
		<th>Aksi</th>
	</thead>
	<tbody>
		<?php
		$nomor=0;
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$nomor+=1;
			?>
			<tr>
				<td>#<?php echo $nomor;?></td>
				<td><?=$row->nama;?></td>
				<td><?=$row->username;?></td>
				<td><?=$row->password;?></td>
				<td><?=$row->akses;?></td>
				<td>
					<a onclick="return confirm('Yakin ingin menghapus user ini?');" href="<?=base_url(akses().'/users/delete');?>?id=<?=$row->user_id;?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>