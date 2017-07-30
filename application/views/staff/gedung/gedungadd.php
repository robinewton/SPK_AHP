<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
echo validation_errors();
echo form_open(base_url(akses().'/Tempat/add'),array('class'=>'form-horizontal'));
?>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Nama Gedung</label>
	<div class="col-md-5">
		<input type="text" name="nama_gedung" id="" class="form-control " autocomplete="" placeholder="Nama Gedung" required="" value="<?php echo set_value('nama_gedung'); ?>"/>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Jenis Gedung</label>
	<div class="col-md-5">
		<!--<input type="text" name="id_jenis_gedung" id="" class="form-control " autocomplete="" placeholder="ID Jenis Gedung" required="" value="<?php //echo set_value('id_jenis_gedung'); ?>"/>-->

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

		<!--<select name="jenis_gedung" class="form-control" required="">
			<option>-Pilih Jenis Gedung-</option>
			<option value="Kepala UPT">Kepala UPT</option>
			<option value="Seksi Bagian Tata Usaha">Seksi Bagian Tata Usaha</option>
			<option value="Seksi Pengembangan Seni dan Budaya">Seksi Pengembangan Seni dan Budaya</option>
			<option value="Seksi Penyajian Seni dan Budaya">Seksi Penyajian Seni dan Budaya</option>
	</select>-->
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