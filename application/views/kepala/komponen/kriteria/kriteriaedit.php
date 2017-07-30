<?php
if(empty($data))
{
	redirect(base_url(akses().'/unsur/tipe'));
}
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url(akses().'/unsur/tipe/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="id_kriteria" value="<?=$row->id_kriteria;?>"/>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Kriteria</label>
	<div class="col-md-7">
		<input type="text" name="nama" id="" class="form-control " autocomplete="off" placeholder="Nama Kriteria" required="" value="<?php echo set_value('nama',$row->nama_kriteria); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-4">
		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
		<a href="javascript:history.back(-1);" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-repeat"></i> Batal</a>
	</div>
</div>
<?php
echo form_close();
?>