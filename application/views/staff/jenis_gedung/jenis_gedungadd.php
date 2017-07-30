<?php
echo validation_errors();
echo form_open(base_url(akses().'/Macam_Tempat/add'),array('class'=>'form-horizontal'));
?>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Jenis</label>
	<div class="col-md-5">
		<input type="text" name="Nama_Jenis" id="" class="form-control " autocomplete="" placeholder="Nama Jenis" required="" value="<?php echo set_value('Nama_Jenis'); ?>"/>
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