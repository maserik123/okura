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
                "url": "<?php echo site_url('administrator/contact/getAllData') ?>",
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
        $('#myModal').modal('show');
        $('.reset').show();
    }

    function ubah(id) {
        save_method = 'update';
        $('#form_inputan')[0].reset();
        $('.reset').hide();
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('administrator/contact/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('[name="no_hp"]').val(data.no_hp);
                $('[name="instagram"]').val(data.instagram);
                $('[name="facebook"]').val(data.facebook);
                $('[name="whatsapp"]').val(data.whatsapp);
                $('[name="keterangan"]').val(data.keterangan);
                $('#myModal').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
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
                    url: "<?php echo site_url('administrator/contact/delete'); ?>/" + id,
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

    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        if (save_method == 'add') {
            url = '<?php echo base_url() ?>administrator/contact/addData';
        } else if (save_method == 'update') {
            url = '<?php echo base_url() ?>administrator/contact/update';
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
</script>

<script>
    $(document).ready(function() {
        $("#hide_button").click(function() {
            $('#myModal').modal('hide');
        })
    });
</script>
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('administrator') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home </a> Contact</div>
</div>
<!--End-breadcrumbs-->

<div class="container-fluid">
    <div class="title">
        <h4>Kontak Saya</h4>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <button class="btn btn-mini btn-primary" onclick="tambah()"><i class="icon-plus"></i> Tambah Data</button> </span>
                    <h5> Kontak Saya</h5>
                </div>
                <div class="widget-content nopadding">
                    <table id="data" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Hp</th>
                                <th>Instagram</th>
                                <th>Facebook</th>
                                <th>Whatsapp</th>
                                <th>Keterangan</th>
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form action="" id="form_inputan" method="post" class="form-horizontal">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">No Hp :</label>
                        <div class="controls">
                            <input type="text" id="no_hp" name="no_hp" class="form-control" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Instagram :</label>
                        <div class="controls">
                            <input type="text" id="instagram" name="instagram" class="form-control" required />

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Facebook :</label>
                        <div class="controls">
                            <input type="text" id="facebook" name="facebook" class="form-control" required />

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Whatsapp :</label>
                        <div class="controls">
                            <input type="text" id="whatsapp" name="whatsapp" class="form-control" required />

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Keterangan :</label>
                        <div class="controls">
                            <input type="text" id="keterangan" name="keterangan" class="form-control" required />

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-mini">Tutup</button>
                    <button type="reset" class="btn btn-warning btn-mini reset">Reset</button>
                    <button type="button" onclick="simpan()" id="hide_button" class="btn btn-success btn-mini">Simpan</button>
                    <!-- <button type="submit" onclick="alert('Apakah anda yakin ?')" class="btn btn-success btn-mini">Simpan</button> -->
                </div>
            </form>
        </div>

    </div>
</div>