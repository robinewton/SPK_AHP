<?php
if(empty($data))
{
	redirect(base_url(akses().'/Pemesan'));
}
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url(akses().'/Pemesan/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="id_penyewa" value="<?=$row->id_penyewa;?>"/>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">KTP</label>
	<div class="col-md-5">
		<input type="text" name="KTP" id="" class="form-control " autocomplete="" placeholder="KTP" required="" value="<?php echo set_value('KTP',$row->KTP); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Penyewa</label>
	<div class="col-md-5">
		<input type="text" name="nama_penyewa" id="" class="form-control " autocomplete="" placeholder="Nama Penyewa" required="" value="<?php echo set_value('nama_penyewa',$row->nama_penyewa); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Alamat</label>
	<div class="col-md-5">
		<textarea name="alamat" class="form-control"><?=set_value('alamat',$row->alamat);?></textarea>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Pekerjaan</label>
	<div class="col-md-5">
		<input type="text" name="pekerjaan" id="" class="form-control " autocomplete="" placeholder="Pekerjaan" required="" value="<?php echo set_value('pekerjaan',$row->pekerjaan); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Telp</label>
	<div class="col-md-5">
		<input type="text" name="notelp_penyewa" id="" class="form-control " autocomplete="" placeholder="No. Telp" required="" value="<?php echo set_value('notelp_penyewa',$row->notelp_penyewa); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
		<a href="javascript:history.back(-1);" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-repeat"></i> Batal</a>
	</div>
</div>
<?php
echo form_close();
?>