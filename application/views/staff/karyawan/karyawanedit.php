<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
if(empty($data))
{
	redirect(base_url(akses().'/Pegawai'));
}
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url(akses().'/Pegawai/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="id_pegawai" value="<?=$row->id_pegawai;?>"/>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Pegawai</label>
	<div class="col-md-5">
		<input type="text" name="nama_pegawai" id="" class="form-control " autocomplete="" placeholder="Tahun Beasiswa" required="" value="<?php echo set_value('nama_pegawai',$row->nama_pegawai); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">NIP</label>
	<div class="col-md-5">
		<input type="number" name="nip" id="" class="form-control " autocomplete="" placeholder="Kuota Beasiswa" required="" value="<?php echo set_value('nip',$row->nip); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Jenis Kelamin</label>
	<div class="col-md-5">
		<select name="jk" class="form-control" required="">
			<option>-Pilih JK-</option>
			<option value="L">Laki-Laki</option>
			<option value="P">Perempuan</option>
	</select>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Jabatan</label>
	<div class="col-md-5">
		<select name="jabatan" class="form-control" required="">
			<option>-Pilih Jabatan-</option>
			<option value="Kepala UPT">Kepala UPT</option>
			<option value="Seksi Bagian Tata Usaha">Seksi Bagian Tata Usaha</option>
			<option value="Seksi Pengembangan Seni dan Budaya">Seksi Pengembangan Seni dan Budaya</option>
			<option value="Seksi Penyajian Seni dan Budaya">Seksi Penyajian Seni dan Budaya</option>
	</select>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Golongan</label>
	<div class="col-md-5">
		<select name="golongan" class="form-control" required="">
			<option>-Pilih Golongan-</option>
			<option value="I/a">I/a</option>
			<option value="I/b">I/b</option>
			<option value="I/c">I/c</option>
			<option value="I/d">I/d</option>
			<option value="II/a">II/a</option>
			<option value="II/b">II/b</option>
			<option value="II/c">II/c</option>
			<option value="II/d">II/d</option>
			<option value="III/a">III/a</option>
			<option value="III/b">III/b</option>
			<option value="III/c">III/c</option>
			<option value="III/d">III/d</option>
			<option value="IV/a">IV/a</option>
			<option value="IV/b">IV/b</option>
			<option value="IV/c">IV/c</option>
			<option value="IV/d">IV/d</option>
			<option value="IV/e">IV/e</option>
	</select>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Alamat</label>
	<div class="col-md-5">
		<textarea name="alamat" class="form-control"><?=set_value('alamat',$row->alamat);?></textarea>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Telp</label>
	<div class="col-md-5">
		<input type="number" name="notelp" id="" class="form-control " autocomplete="" placeholder="Kuota Beasiswa" required="" value="<?php echo set_value('notelp',$row->notelp); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-5">
		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
		<a href="javascript:history.back(-1);" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-repeat"></i> Batal</a>
	</div>
</div>
<?php
echo form_close();
?>