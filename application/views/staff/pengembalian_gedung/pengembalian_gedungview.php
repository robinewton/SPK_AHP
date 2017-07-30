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
    <a href="<?=base_url(akses().'/pengembalian/add');?>" class="btn btn-primary btn-flat"><i class="glyphicon glyphicon-plus"></i> Pengembalian</a>
</div>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>ID</th>
		<th>Pengguna</th>
		<th>Gedung</th>
		<th>KTP</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Tlp Pengembali</th>
		<th>Tanggal Pengembalian</th>
		<th>Jam Pengembalian</th>
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
				<td><?=$row->KTP;?></td>
				<td><?=$row->KTP;?></td>
				<td><?=$row->KTP;?></td>
				<td><?=$row->KTP;?></td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>


