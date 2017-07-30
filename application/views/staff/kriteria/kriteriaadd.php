<?php
echo validation_errors();
echo form_open(base_url(akses().'/Sarat/add'),array('class'=>'form-horizontal'));
?>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Kriteria</label>
	<div class="col-md-5">
		<input type="text" name="nama_kriteria" id="" class="form-control " autocomplete="" placeholder="Nama Kriteria" required="" value="<?php echo set_value('nama_kriteria'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
		<button type="reset" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-refresh"></i> Batal</button>
	</div>
</div>
<?php
echo form_close();
?>