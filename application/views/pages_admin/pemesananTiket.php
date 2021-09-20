<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    table = $('#data').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "responsive": true,
        "dataType": 'JSON',
        "ajax": {
            "url": "<?php echo site_url('administrator/pemesananTiket/getAllData') ?>",
            "type": "POST",
            "data": {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        },
        "order": [
            [0, "desc"]
        ],
        "columnDefs": [{
            "targets": [0],
            "className": "center"
        }]
    });
});

var save_method;

function updateAllTable() {
    table.ajax.reload();
}

function tambah() {
    save_method = 'add';
    $('#form_inputan')[0].reset();
    $('.form-group').removeClass('has-error')
        .removeClass('has-success')
        .find('#text-error').remove();
    $('#modalPemesanan').modal('show');
}

function ubah(id) {
    save_method = 'update';
    $('#form_inputan')[0].reset();
    $('.reset').hide();
    $('.form-group').removeClass('has-error')
        .removeClass('has-success')
        .find('#text-error').remove();
    $.ajax({
        url: "<?php echo site_url('administrator/pemesananTiket/getById/'); ?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(resp) {
            data = resp.data
            $('[name="id"]').val(data.id);
            $('[name="kode_tiket"]').val(data.kode_tiket);
            $('[name="jenis_pemesanan"]').val(data.jenis_pemesanan);
            $('[name="tanggal"]').val(data.tanggal);
            $('[name="jml_tiket"]').val(data.jml_tiket);
            $('[name="jumlah_bayar"]').val(data.jumlah_bayar);
            $('[name="id_rekening"]').val(data.id_rekening);
            $('[name="status"]').val(data.status);
            $('[name="feedback"]').val(data.feedback);
            $('[name="bukti_bayar"]').val(data.bukti_bayar);
            $('[name="jenis_akun"]').val(data.jenis_akun);
            $('#modalPemesanan').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error Get Data From Ajax');
        }
    });

}

function simpan() {
    var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
    var csrf_hash = ''
    var url;
    if (save_method == 'add') {
        url = '<?php echo base_url() ?>administrator/pemesananTiket/addData';
    } else if (save_method == 'update') {
        url = '<?php echo base_url() ?>administrator/pemesananTiket/update';
    }
    swal({
            title: "Apakah anda sudah yakin ?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            cancelButtonText: "Kembali",
            confirmButtonText: "Ya",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                url: url,
                method: 'POST',
                data: $('#form_inputan').serialize(),
                dataType: "JSON",
                success: function(resp) {
                    data = resp.result
                    csrf_hash = resp.csrf['token'];
                    $('#form_inputan input[name=' + token_name + ']').val(csrf_hash);
                    if (data['status'] == 'success') {
                        updateAllTable();
                        $('.form-group').removeClass('has-error')
                            .removeClass('has-success')
                            .find('#text-error').remove();
                        $("#form_inputan")[0].reset();
                    } else {
                        $.each(data['messages'], function(key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('#text-error')
                                .remove();
                            element.after(value);
                        });
                    }
                    swal({
                        html: true,
                        timer: 1300,
                        showConfirmButton: false,
                        title: data['msg'],
                        type: data['status']
                    });
                }

            });
        });
}

function hapus(id) {
    swal({
            title: "Apakah data akan dihapus?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                url: "<?php echo site_url('administrator/pemesananTiket/delete'); ?>/" + id,
                type: "POST",
                dataType: "JSON",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(resp) {
                    data = resp.result;
                    updateAllTable();
                    return swal({
                        html: true,
                        timer: 1300,
                        showConfirmButton: false,
                        title: data['msg'],
                        type: data['status']
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error Deleting Data');
                }
            });
        });
}

function verifikasi(id) {
    swal({
            title: "Anda ingin verifikasi?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                url: "<?php echo site_url('administrator/pemesananTiket/verify'); ?>/" + id,
                type: "POST",
                dataType: "JSON",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(resp) {
                    data = resp.result;
                    updateAllTable();
                    return swal({
                        html: true,
                        timer: 1300,
                        showConfirmButton: false,
                        title: data['msg'],
                        type: data['status']
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error Deleting Data');
                }
            });
        });
}

function unverifikasi(id) {
    swal({
            title: "Anda ingin menolak verifikasi?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Ya",
            closeOnConfirm: false
        },
        function() {
            $.ajax({
                url: "<?php echo site_url('administrator/pemesananTiket/unverify'); ?>/" + id,
                type: "POST",
                dataType: "JSON",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function(resp) {
                    data = resp.result;
                    updateAllTable();
                    return swal({
                        html: true,
                        timer: 1300,
                        showConfirmButton: false,
                        title: data['msg'],
                        type: data['status']
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error Deleting Data');
                }
            });
        });
}
</script>

<script>
$(document).ready(function() {
    $("#hide_button").click(function() {
        $('#modalPemesanan').modal('hide');
    })
});
</script>
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('administrator') ?>" title="Go to Home" class="tip-bottom"><i
                class="icon-home"></i> Home </a> Pemesanan Tiket</div>
</div>
<!--End-breadcrumbs-->

<div class="container-fluid">
    <div class="title">
        <h4>Daftar Pemesanan Tiket</h4>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <button type="button" onclick="tambah()" class="btn btn-primary btn-mini">Tambah Data</button>
                    </span>
                    <h5>Tabel Pemesanan Tiket</h5>

                </div>
                <div class="widget-content nopadding">
                    <table id="data" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengunjung</th>
                                <th>Kode Tiket</th>
                                <th>Jenis Transaksi</th>
                                <th>Tanggal</th>
                                <th>Jumlah Tiket</th>
                                <th>Status</th>
                                <th>Bukti Bayar</th>
                                <th>Tools</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalPemesanan" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form action="" id="form_inputan" method="post" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id')); ?>

                    <input type="hidden" name="kode_tiket" id="kode_tiket">
                    <input type="hidden" name="jenis_pemesanan" id="jenis_pemesanan">

                    <div class="control-group">
                        <label class="control-label">Tanggal :</label>
                        <div class="controls">
                            <input name="tanggal" type="date" class="form-control" id="tanggal"
                                placeholder="Tanggal Berkunjung" required="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Jml Tiket :</label>
                        <div class="controls">
                            <input name="jml_tiket" type="number" class="form-control" id="jml_tiket"
                                placeholder="Jumlah Tiket" required="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Rekening Pembayaran :</label>
                        <div class="controls">
                            <select class="form-control" name="id_rekening" id="id_rekening" required>
                                <option value="">Pilih Rekening Pembayaran</option>
                                <?php foreach ($dataRekening as $row) { ?>
                                <option value="<?php echo $row->id; ?>"><?php echo $row->jenis_bank; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-mini">Tutup</button>
                    <button type="reset" class="btn btn-warning btn-mini reset">Reset</button>
                    <button type="button" onclick="simpan()" id="hide_button"
                        class="btn btn-success btn-mini">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>