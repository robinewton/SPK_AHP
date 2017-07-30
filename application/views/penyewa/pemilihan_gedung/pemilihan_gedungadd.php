<link rel="stylesheet" href="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.css"/>
<script src="<?=base_url();?>konten/tema/lte/plugins/select2/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$("select").select2();
});
</script>
<?php
echo validation_errors();
echo form_open(base_url(akses().'/Pilih/Pilihan_Sewa/add'),array('class'=>'form-horizontal'));
?>
<img src="<?php echo base_url(); ?>konten/images/SPK_UPT.png" style="width:100%;height:120px"><br><br>
<div class="col-md-12">
	<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4 style="color:#800000"><img src="<?php echo base_url(); ?>konten/images/logo.png" style="width:50px;height:50px">Peringatan / <small><i style="color:#800000"> Alert :</i></small></h4>
         <p style="color:brown">Analisa akan muncul, jika telah ada persetujuan oleh kepala UPT. Jika ada warning, berarti <i>textbox</i> belum terisi. 
		 Data pesanan akan diterima oleh pihak UPT. Taman Budaya Jawa Timur. Dan Jika telah disetujui oleh pihak kepala maka anda akan mendapatkan email dan dapat melakukan tahap selanjutnya, untuk melakukan pemesanan gedung pada UPT. Taman Budaya Jawa Timur.</p>
    </div>
</div>
<!--input type="hidden" name="user_id" class="form-control" required="" placeholder="ID User" value="<?//=user_info('user_id');?>"/>
<input type="hidden" name="jumlah_pesan" class="form-control" required="" placeholder="Jum Pesan" value="1"/>-->
<?php date_default_timezone_set('Asia/jakarta');
      //$tgl=date("d-m-Y");
      //$tgl2=date("Y-m-d"); 
      //echo $tgl;
?>
<!--<input type="hidden" name="tgl_order" class="form-control" required="" placeholder="ID User" value="<?//=$tgl2;?>"/>-->
<div class="form-group required">
	<label class="col-sm-2 control-label" for="">Nama Gedung</label>
	<div class="col-md-9">
		
		<?php
		if(!empty($id_pemilihan_gedung))
		{
			$nama_pemilihan=field_value('pemilihan_gedung','id_pemilihan_gedung',$id_pemilihan_gedung,'nama_pemilihan');
		?>
		<p class="form-control-static"><?=$id_gedung;?></p>
		<input type="hidden" name="id_pemilihan_gedung" id="id_pemilihan_gedung" value="<?=$id_pemilihan_gedung;?>"/>
		<?php
		}else{
		?>
		<select name="id_pemilihan_gedung" class="form-control" id="id_pemilihan_gedung" data-placeholder="Pilih Nama Gedung" required="" style="width: 100%">
			<option></option>
			<?php
			if(!empty($pemilihan_gedung))
			{
				foreach($pemilihan_gedung as $rbe)
				{
					echo '<option value="'.$rbe->id_pemilihan_gedung.'" '.set_select('id_pemilihan_gedung',$rbe->id_pemilihan_gedung).'>'.$rbe->nama_pemilihan.'</option>';
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
	<label class="col-sm-2 control-label" for="">ID Penyewa</label>
	<div class="col-md-9">
		<input type="text" name="id_penyewa" class="form-control tanggal" required="" value="<?=user_info('user_id');?>" placeholder="Nama Penyewa"  readonly/>
		<small class="text-info">Akan Muncul ID Otomatis Sesuai Akun anda.</small>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label" for="">Pemilihan</label>
	<div class="col-md-9">
		<table class="table table-bordered">
			<thead>
				<th>Kriteria</th>
				<th>Nilai</th>
			</thead>
			<tbody>
			<?php
			if(!empty($kriteria))
			{
				foreach($kriteria as $rk)
				{
					$id_kriteria=$rk->id_kriteria;
					echo '<tr>';
					echo '<td>'.$rk->nama_kriteria.'</td>';
					echo '<td>';
					$dSub=$this->m_db->get_data('subkriteria',array('id_kriteria'=>$id_kriteria));
					if(!empty($dSub))
					{						
						echo '<select name="kriteria['.$id_kriteria.']" class="form-control" data-placeholder="Pilih Kategori" required style="width: 100%">';
						echo '<option></option>';
						foreach($dSub as $rSub)
						{
							$o='';
							if($rSub->tipe=="teks")
							{
								$o=$rSub->nama_subkriteria;
							}elseif($rSub->tipe=="nilai"){
								$opmin=$rSub->op_min;
								$opmax=$rSub->op_max;
								$nilaimin=$rSub->nilai_minimum;
								$nilaimax=$rSub->nilai_maksimum;
								if($opmin==$opmax && $nilaimin==$nilaimax)
								{
									$o=$opmax." ".$nilaimin;
								}else{
									$o=$opmin." ".$nilaimin." dan ".$opmax." ".$nilaimax;
								}
							}
							echo '<option value="'.$rSub->subkriteria_id.'">'.$o.'</option>';
						}
						echo '</select>';
					}
					echo '</td>';
					echo '</tr>';
				}
			}
			?>
			</tbody>
		</table>
	</div>
<div class="form-group">
	<label class="col-sm-4 control-label">&nbsp;</label>
	<div class="col-md-7">
		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
		<button type="reset" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-refresh"></i> Batal</button>
	</div>
</div>	
<?php
echo form_close();
?>