<?php
if(empty($data))
{
	redirect(base_url(akses().'/Tempat'));
}
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url(akses().'/Tempat/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="id_gedung" value="<?=$row->id_gedung;?>"/>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Gedung</label>
	<div class="col-md-5">
		<input type="text" name="nama_gedung" id="" class="form-control " autocomplete="" placeholder="Judul Beasiswa" required="" value="<?php echo set_value('nama_gedung',$row->nama_gedung); ?>"/>
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