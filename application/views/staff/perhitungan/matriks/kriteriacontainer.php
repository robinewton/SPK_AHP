<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<script type="text/javascript">
$(document).ready(function () {
	$("#formcari").submit(function(e){
		e.preventDefault();
		$.ajax({
			type:'get',
			dataType:'html',
			url:"<?=base_url(akses().'/kriteria/gethtml');?>",
			data:$(this).serialize(),
			error:function(){
				$("#matrik").html('Gagal mengambil data matrik');
			},
			beforeSend:function(){
				$("#matrik").html('Mengambil data matrik. Tunggu sebentar');
			},
			success:function(x){
				$("#matrik").html(x);
			},
		});
	});
});

function showsubdata(kriteria,pemilihan_gedung)
{
	$.ajax({
			type:'get',
			dataType:'html',
			url:"<?=base_url(akses().'/kriteria/getsub');?>",
			data:"kriteria="+kriteria+"&pemilihan_gedung="+pemilihan_gedung,
			error:function(){
				$("#matriksub").html('Gagal mengambil data matrik');
			},
			beforeSend:function(){
				$("#matriksub").html('Mengambil data matrik. Tunggu sebentar');
			},
			success:function(x){
				$("#matriksub").html(x);
			},
		});
}

</script>
<?php
echo validation_errors();
echo form_open('#',array('class'=>'form-horizontal','id'=>'formcari'));
?>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Pilih Pemilihan Gedung</label>
	<div class="col-md-5">
		<select name="pemilihan_gedung" class="form-control" required="">
			<?php
			if(!empty($pemilihan_gedung))
			{
				foreach($pemilihan_gedung as $rb)
				{
					echo '<option value="'.$rb->id_pemilihan_gedung.'">'.$rb->nama_pemilihan.'</option>';
				}
			}
			?>
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">&nbsp;</label>
	<div class="col-md-5">
		<button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i> Cari</button>		
	</div>
</div>
<?php
echo form_close();
?>
<div id="matrik"></div>