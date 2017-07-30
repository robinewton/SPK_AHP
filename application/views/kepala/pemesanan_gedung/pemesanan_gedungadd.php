<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<link rel="stylesheet" href="<?=base_url();?>konten/jqueryui/jquery-ui.min.css"/>
<link rel="stylesheet" href="<?=base_url();?>konten/jqueryui/themes/overcast/jquery-ui.min.css"/>
<script src="<?=base_url();?>konten/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	if($(".tanggal").length)
	{
		$(".tanggal").datepicker({
			dateFormat: "yy-mm-dd",
			showAnim:"slide",
			changeMonth: true,
			changeYear: true,
			yearRange:'c-70:c+10',
		});
	}
});
</script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
echo validation_errors();
echo form_open(base_url(akses().'/Sewa/Sewa_Tempat/add'),array('class'=>'form-horizontal'));
?>
<div class="col-md-12">
<img src="<?php echo base_url(); ?>konten/images/UPT-fix.png" style="width:100%;height:120px"><hr>
<div class="col-md-6">
<input type="hidden" name="user_id" class="form-control" required="" placeholder="ID User" value="<?=user_info('user_id');?>"/>
<input type="hidden" name="jumlah_pesan" class="form-control" required="" placeholder="Jum Pesan" value="1"/>
<?php date_default_timezone_set('Asia/jakarta');
      $tgl=date("d-m-Y");
      $tgl2=date("Y-m-d"); 
      //echo $tgl;
?>
<input type="hidden" name="tgl_order" class="form-control" required="" placeholder="ID User" value="<?=$tgl2;?>"/>
<div class="form-group required">
	<label class="col-sm-4 control-label" for="">Nama Gedung</label>
	<div class="col-md-7">
		<!--<input type="text" name="id_jenis_gedung" id="" class="form-control " autocomplete="" placeholder="ID Jenis Gedung" required="" value="<?php //echo set_value('id_jenis_gedung'); ?>"/>-->

		<?php
		if(!empty($id_gedung))
		{
			$nama_gedung=field_value('gedung','id_gedung',$id_gedung,'nama_gedung');
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

		<!--<select name="jenis_gedung" class="form-control" required="">
			<option>-Pilih Jenis Gedung-</option>
			<option value="Kepala UPT">Kepala UPT</option>
			<option value="Seksi Bagian Tata Usaha">Seksi Bagian Tata Usaha</option>
			<option value="Seksi Pengembangan Seni dan Budaya">Seksi Pengembangan Seni dan Budaya</option>
			<option value="Seksi Penyajian Seni dan Budaya">Seksi Penyajian Seni dan Budaya</option>
	</select>-->
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-4 control-label">Tanggal Acara</label>
	<div class="col-md-7">
		<input type="text" name="tgl_acara" class="form-control tanggal" required="" placeholder="Tanggal Acara" value="<?=set_value('tgl_acara');?>"/>
		<small class="text-info">Tentukan Tanggal Sewa Untuk Acara.</small>
	</div>
</div>
<div class="form-group required">
	<label class="col-sm-4 control-label" for="">Jam Acara</label>
	<div class="col-md-7">
		<input type="time" name="jam_acara" id="" class="form-control " autocomplete="" placeholder="Jam Acara" required="" value="<?php echo set_value('jam_acara'); ?>"/>
		<small class="text-info">Tentukan Jam Sewa Untuk Acara.</small>		
	</div>
</div>
<div class="form-group">
	<label class="col-sm-4 control-label" for="">Untuk Acara Apa Order?</label>
	<div class="col-md-7">
		<textarea name="acara" class="form-control" placeholder="Acara"><?=set_value('acara');?></textarea>
		<small class="text-info">Comment (required)</small>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-4 control-label">&nbsp;</label>
	<div class="col-md-7">
		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
		<button type="reset" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-refresh"></i> Batal</button>
	</div>
</div>
</div>
<div class="col-md-6">
	<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4 style="color:#800000"><img src="<?php echo base_url(); ?>konten/images/logo.png" style="width:50px;height:50px">Peringatan / <small><i style="color:#800000"> Alert :</i></small></h4>
         <p style="color:brown">Pesanan Gedung tidak akan bisa dilakukan, jika telah ada penyewa lain yang telah melakukan pemesanan dengan waktu dan tempat yang sama. Jika ada peringatan berarti pada <i>textbox</i> belum terisi. 
		 Data pesanan akan diterima oleh pihak UPT. Taman Budaya Jawa Timur. Dan Jika telah dilihat maka akan ada WA/SMS dari pihak <br>UPT. Taman Budaya Jawa Timur.</p>			
        <div class="form-group">
        <!--<h3>Denda : </h3><h5 style="color:yellow;">Rp. <?php //echo $denda; ?> (<?php //echo $namad; ?>) / Hari <br></h5>
        <input type="hidden" name="nama_catalog" class="form-control" placeholder="Rp.<?php //echo $denda; ?> / Hari" readonly>-->
        </div>
    </div>
</div>		
</div>
<?php
echo form_close();
?>