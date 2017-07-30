<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
echo validation_errors();
//echo form_open(base_url(akses().'/Pegawai/add'),array('class'=>'form-horizontal'));
echo form_open(base_url(akses().'/Pegawai/add'.$link),array('class'=>'form-horizontal'));
?>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Username</label>
	<div class="col-md-5">
	<!--<input type="text" name="user_id" id="" class="form-control " autocomplete="" placeholder="ID Username" required="" value="<?php //echo set_value('user_id'); ?>"/>-->

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

		<!--<select name="user_id" id="user_id" class="form-control">
			<?php
			//mysql_connect("localhost","root",""); // koneksi database
			//mysql_select_db("pemilihangedung_ahp");
			//$sql = mysql_query("SELECT * FROM pengguna");
			//while($data = mysql_fetch_array($sql)){
			//echo "<option value=' ".$data['user_id']." '>".$data['Username']."</option>";
			//}
			?>
		</select>-->
		<!--<select class="form-control" name="user_id" id="user_id" required>
            <option value="">- Pilih Username -</option>
            <?php
            //mengambil nama-nama mapel yang ada di database
            //$mapel = mysql_query("SELECT * FROM pengguna ORDER BY nama_mapel");
            //while($p=mysql_fetch_array($mapel)){
            //echo "<option value=\"$p[user_id]\">$p[Username]</option>\n";
            //}
            ?>
         </select>-->
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Nama Pegawai</label>
	<div class="col-md-5">	
		<input type="text" name="nama_pegawai" id="" class="form-control " autocomplete="" placeholder="Nama Pegawai" required="" value="<?php echo set_value('nama_pegawai'); ?>"/>
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
	<label class="col-sm-2 control-label" for="">NIP</label>
	<div class="col-md-5">
		<input type="text" name="nip" id="" class="form-control " autocomplete="" placeholder="NIP" required="" value="<?php echo set_value('nip'); ?>"/>
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
		<textarea name="alamat" class="form-control" placeholder="Alamat"><?=set_value('alamat');?></textarea>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Telp</label>
	<div class="col-md-5">
		<input type="number" name="notelp" id="" class="form-control " autocomplete="" placeholder="No. Telp" required="" value="<?php echo set_value('notelp'); ?>"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-6">
		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
		<button type="reset" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-refresh"></i> Batal</button>
		<!--<button type="submit" class="btn btn-primary btn-flat">Tambah</button>
		<a href="javascript:history.back(-1);" class="btn btn-default btn-flat">Batal</a>-->
	</div>
</div>
<?php
echo form_close();
?>