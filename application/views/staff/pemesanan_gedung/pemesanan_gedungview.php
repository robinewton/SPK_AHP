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
	
</div>
<p>&nbsp;</p>
<table class="table table-border table-hover" id="datatable">
	<thead>
		<th>ID</th>
		<th>Nama Gedung</th>
		<th>Nama Pemesan</th>
		<th>Username</th>
		<th>Tgl. Acara</th>
		<th>Jam Acara</th>
		<th>Tgl. Order</th>
		<th>Status</th>
		<th>Instansi</th>
		<th>Acara</th>
		<th>Aksi</th>
	</thead>
	<tbody>
		<?php
		$nomor=0;
		if(!empty($data))
		{
			foreach($data as $row)
			{
				$id=$row->id_pemesanan_gedung;
				$nomor+=1;
			?>
			<tr>
				<td><?php echo $nomor;?></td>
				<td><?=$row->nama_gedung;?></td>
				<td><?=$row->nama_penyewa;?></td>
				<td><?=$row->username;?></td>
				<td><?=$row->tgl_acara;?></td>
				<td><?=$row->jam_acara;?></td>
				<td><?=$row->tgl_order;?></td>
				<td><?=$row->status;?></td>
				<td><?=$row->instansi;?></td>
				<td><?=$row->acara;?></td>
				<td>
					<a onclick="return confirm('Yakin ingin menghapus Pemesanan Gedung ini?');" href="<?=base_url(akses().'/Sewa/Sewa_Tempat/delete');?>?id=<?=$id;?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</tbody>
</table>