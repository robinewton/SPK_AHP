<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
echo validation_errors();
//echo form_open(base_url(akses().'/Pemesan/add'),array('class'=>'form-horizontal'));
echo form_open(base_url(akses().'/Pemesan/add'.$link),array('class'=>'form-horizontal'));
?>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Username</label>
	<div class="col-md-5">
		<?php
		if(!empty($user_id))
		{
			$username=field_value('pengguna','user_id',$user_id,'username');
		?>
		<p class="form-control-static"><?=$username;?></p>
		<input type="hidden" name="user_id" id="user_id" value="<?=$user_id;?>"/>
		<?php
		}else{
		?>
		<select name="user_id" class="form-control" id="user_id" data-placeholder="Pilih Username" required="" style="width: 100%">
			<option></option>
			<?php
			if(!empty($pengguna))
			{
				foreach($pengguna as $rbe)
				{
					echo '<option value="'.$rbe->user_id.'" '.set_select('user_id',$rbe->user_id).'>'.$rbe->username.'</option>';
				}
			}
			?>
		</select>
		<?php
		}
		?>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">KTP</label>
	<div class="col-md-5">
		<input type="text" name="KTP" id="" class="form-control " autocomplete="" placeholder="KTP" required="" value="<?php echo set_value('KTP'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Nama Penyewa</label>
	<div class="col-md-5">
		<input type="text" name="nama_penyewa" id="" class="form-control " autocomplete="" placeholder="Nama Penyewa" required="" value="<?php echo set_value('nama_penyewa'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Alamat</label>
	<div class="col-md-5">
		<textarea name="alamat" class="form-control" placeholder="Alamat"><?=set_value('alamat');?></textarea>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Pekerjaan</label>
	<div class="col-md-5">
		<input type="text" name="pekerjaan" id="" class="form-control " autocomplete="" placeholder="Pekerjaan" required="" value="<?php echo set_value('pekerjaan'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Telp</label>
	<div class="col-md-5">
		<input type="text" name="notelp_penyewa" id="" class="form-control " autocomplete="" placeholder="No. Telp" required="" value="<?php echo set_value('notelp_penyewa'); ?>"/>
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