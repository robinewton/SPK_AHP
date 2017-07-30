<link rel="stylesheet" href="<?= base_url(); ?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.css"/>
<script src="<?= base_url(); ?>konten/tema/lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>konten/tema/lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>konten/tema/lte/plugins/datepicker/bootstrap-datepicker.js"></script>

<?php
date_default_timezone_set("asia/jakarta");
echo validation_errors();
//echo form_open(base_url(akses().'/Pegawai/add'),array('class'=>'form-horizontal'));
echo form_open(base_url(akses() . '/pengembalian/addall'), array('class' => 'form-horizontal'));
?>
<div class="form-group ">
    <label class="col-sm-2 control-label" for=""> Nama Pengembali</label>
    <div class="col-md-5">
        <input type="text" class="form-control" id="datapeengembalian" name="datapeengembalian"/>
    </div>
    <div class="col-md-2">
        <input type="button" class="btn btn-info btn-flat" id="pengembaliBtn" value="add"
               data-toggle="modal"
               data-target="#modalTambaPenyewa">
    </div>

</div>
<div class="form-group ">
    <label class="col-sm-2 control-label" for=""> KTP</label>
    <div class="col-md-5">
        <input type="text" class="form-control" id="ktpPengembali" name="ktpPengembali"/>
    </div>
</div>
<div class="form-group ">
    <label class="col-sm-2 control-label" for=""> Nama Gedung</label>
    <div class="col-md-5">
        <input type="text" class="form-control" id="namaGedung" name="namaGedung" disabled/>
    </div>
    <div class="col-md-2">
        <input type="button" class="btn btn-info btn-flat" id="pelangganmotorbtn" value="add"
               data-toggle="modal"
               data-target="#modalGedung">
    </div>
</div>
<div class="form-group ">
    <label class="col-sm-2 control-label" for="">Alamat</label>
    <div class="col-md-5">
        <textarea class="form-control" id="alamatText"></textarea>
    </div>
</div>

<div class="form-group ">
    <label class="col-sm-2 control-label" for="">No Tlp</label>
    <div class="col-md-5">
        <input type="text" name="noTlp" id="noTlp" class="form-control "
               value=""/>
    </div>
</div>
<div class="form-group required">
    <label class="col-sm-2 control-label" for="">Tanggal Pengembalian</label>
    <div class="col-md-3">
        <input type="text" name="tglPengembalian" id="datepicker" value="<?php echo date("d/m/Y"); ?>"
               class="form-control "
               required/>
    </div>
    <span>DD/MM/YYYY</span>
</div>
<div class="form-group required">
    <label class="col-sm-2 control-label" for="">Jam Pengembalian</label>
    <div class="col-md-5">
        <input type="time" name="jamPengembalian" value="<?php echo date("G:i"); ?>" class="form-control" required/>
    </div>
</div>

<div class="form-group ">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-md-6">
        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
        <!--        <button type="reset" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-refresh"></i> Batal</button>-->
        <a href="<?php echo base_url('staff/pengembalian'); ?>" class="btn btn-danger"><i
                    class="glyphicon glyphicon-refresh"></i> Cancel</a>
    </div>
</div>
<?php
echo form_close();
?>

<div id="modalTambaPenyewa" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Data Penyewa </h4>
            </div>
            <div class="modal-body">
                <table id="datatable" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Nama</th>
                        <th>KTP</th>
                        <th>Alamat</th>
                        <th>pekerjaan</th>
                        <th>notelp_penyewa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($record as $r) {
                        ?>
                        <tr class="pilih" data-idPeny="<?php echo $r->id_penyewa; ?>"
                            data-penyewa="<?php echo $r->nama_penyewa; ?>"
                            data-ktp="<?php echo($r->KTP); ?>"
                            data-alamat="<?php echo($r->alamat); ?>"
                            data-pekerjaan="<?php echo($r->pekerjaan); ?>"
                            data-tlp="<?php echo($r->notelp_penyewa); ?>"
                        >
                            <td><?php echo($r->nama_penyewa); ?></td>
                            <td><?php echo($r->KTP); ?></td>
                            <td><?php echo($r->alamat); ?></td>
                            <td><?php echo($r->pekerjaan); ?></td>
                            <td><?php echo($r->notelp_penyewa); ?></td>
                        </tr>
                        <?php ;
                    } ?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div id="modalGedung" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Data Penyewa </h4>
            </div>
            <div class="modal-body">
                <table id="datatable" class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Gedung</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($record1 as $r) {
                        ?>
                        <tr class="pilih2" data-idGedung="<?php echo $r->id_gedung; ?>"
                            data-namaGedung="<?php echo $r->nama_gedung; ?>">
                            <td><?php echo($r->id_gedung); ?></td>
                            <td><?php echo($r->nama_gedung); ?></td>
                        </tr>
                        <?php ;
                    } ?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.pilih', function (e) {
            document.getElementById("datapeengembalian").value = $(this).attr('data-penyewa'),
                document.getElementById("ktpPengembali").value = $(this).attr('data-ktp'),
                document.getElementById("alamatText").value = $(this).attr('data-alamat'),
//            document.getElementById("datapeengembalian").value = $(this).attr('data-pekerjaan'),
                document.getElementById("noTlp").value = $(this).attr('data-tlp');
//                document.getElementById("PELANGGAN_ID").value = $(this).attr('data-idPeny');
                $('#modalTambaPenyewa').modal('hide');
        });
        $(document).on('click', '.pilih2', function (e) {
//            document.getElementById("namaGedung1").value = $(this).attr('data-idGedung'),
                document.getElementById("namaGedung").value = $(this).attr('data-namaGedung');
                $('#modalGedung').modal('hide');
        });
        $('#datatable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        })

    });
</script>