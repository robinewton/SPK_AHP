<?php
foreach($data as $row){	
}
echo validation_errors();
echo form_open(base_url(akses().'/analisa/Pilihan_tempat/edit'),array('class'=>'form-horizontal'));
?>
<input type="hidden" name="id_pemilihan_gedung" value="<?=$row->id_pemilihan_gedung;?>"/>
<!--<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Gedung</label>
	<div class="col-md-9">
		<input type="text" name="id_gedung" id="" class="form-control " autocomplete="" placeholder="Nama Gedung" required="" value="<?php //echo set_value('id_gedung',$row->id_gedung); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Jenis</label>
	<div class="col-md-9">
		<input type="text" name="id_jenis_gedung" id="" class="form-control " autocomplete="" placeholder="Nama Jenis" required="" value="<?php //echo set_value('id_jenis_gedung',$row->id_jenis_gedung); ?>"/>
	</div>
</div>-->
<input type="hidden" name="id_gedung" id="" class="form-control " autocomplete="" placeholder="Nama Gedung" required="" value="<?php echo set_value('id_gedung',$row->id_gedung); ?>"/>
<input type="hidden" name="id_jenis_gedung" id="" class="form-control " autocomplete="" placeholder="Nama Jenis" required="" value="<?php echo set_value('id_jenis_gedung',$row->id_jenis_gedung); ?>"/>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama</label>
	<div class="col-md-4">
		<input type="text" name="nama_pemilihan" id="" class="form-control " autocomplete="" placeholder="Nama Pemilihan" required="" value="<?php echo set_value('nama_pemilihan',$row->nama_pemilihan); ?>"/>
	</div>
</div>
<!--<div class="form-group">
	<label class="col-sm-2 control-label" for="">Keterangan</label>
	<div class="col-md-9">
		<textarea name="keterangan" class="form-control"><?//=set_value('keterangan',$row->keterangan);?></textarea>
	</div>
</div>-->
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Tahun</label>
	<div class="col-md-4">
		<input type="number" name="tahun" id="" class="form-control " autocomplete="" placeholder="Tahun Pemilihan" required="" value="<?php echo set_value('tahun',$row->tahun); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Kuota</label>
	<div class="col-md-4">
		<input type="number" name="kuota" id="" class="form-control " autocomplete="" placeholder="Kuota Pemilihan" required="" value="<?php echo set_value('kuota',$row->kuota); ?>"/>
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