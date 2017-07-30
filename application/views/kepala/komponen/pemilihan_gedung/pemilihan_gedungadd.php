<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
echo validation_errors();
echo form_open(base_url(akses().'/analisa/Pilihan_tempat/add'),array('class'=>'form-horizontal'));
?>
<?php $nama_pemilihan=''; ?>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama</label>
	<div class="col-md-5">
		<input type="text" name="nama_pemilihan" id="" class="form-control " autocomplete="" placeholder="Nama Pemilihan" required="" value="<?php echo set_value('nama_pemilihan'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Nama Gedung</label>
	<div class="col-md-5">
		
		<?php
		if(!empty($id_gedung))
		{
			$nama_gedung=field_value('gedung','id_gedung',$id_gedung,'nama_gedung');
			$nama_pemilihan=field_value('gedung','nama_gedung',$nama_gedung,'id_gedung');
		?>
		<p class="form-control-static"><?=$nama_gedung;?></p>
		<input type="hidden" name="id_gedung" id="id_gedung" value="<?=$id_gedung;?>"/>
		<?php
		}else{
		?>
		<select name="id_gedung" class="form-control" id="id_gedung" data-placeholder="Pilih Nama Gedung" required="" style="width: 100%">
			<option></option>
			<?php
			if(!empty($gedung))
			{
				foreach($gedung as $rbe)
				{
					echo '<option value="'.$rbe->id_gedung.'" '.set_select('id_gedung',$rbe->id_gedung).'>'.$rbe->nama_gedung.'</option>';
				}
			}
			?>
		</select>
		<?php
		}
		?>	
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Jenis Gedung</label>
	<div class="col-md-5">
		<?php
		if(!empty($id_jenis_gedung))
		{
			$Nama_Jenis=field_value('jenis_gedung','id_jenis_gedung',$id_jenis_gedung,'Nama_Jenis');
		?>
		<p class="form-control-static"><?=$Nama_Jenis;?></p>
		<input type="hidden" name="id_jenis_gedung" id="id_jenis_gedung" value="<?=$id_jenis_gedung;?>"/>
		<?php
		}else{
		?>
		<select name="id_jenis_gedung" class="form-control" id="id_jenis_gedung" data-placeholder="Pilih Jenis Gedung" required="" style="width: 100%">
			<option></option>
			<?php
			if(!empty($jenis_gedung))
			{
				foreach($jenis_gedung as $rbe)
				{
					echo '<option value="'.$rbe->id_jenis_gedung.'" '.set_select('id_jenis_gedung',$rbe->id_jenis_gedung).'>'.$rbe->Nama_Jenis.'</option>';
				}
			}
			?>
		</select>
		<?php
		}
		?>
	</div>
</div>
<!--<div class="form-group">
	<label class="col-sm-2 control-label" for="">Keterangan</label>
	<div class="col-md-5">
		<textarea name="keterangan" class="form-control"><?//=set_value('keterangan');?></textarea>
	</div>
</div>-->
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Tahun</label>
	<div class="col-md-5">
		<input type="number" name="tahun" id="" class="form-control " autocomplete="" placeholder="Tahun Pemilihan" required="" value="<?php echo set_value('tahun'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Kuota</label>
	<div class="col-md-5">
		<input type="number" name="kuota" id="" class="form-control " autocomplete="" placeholder="Kuota Pemilihan" required="" value="<?php echo set_value('kuota'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-5">
		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
		<button type="reset" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-refresh"></i> Batal</button>
	</div>
</div>
<?php
echo form_close();
?>