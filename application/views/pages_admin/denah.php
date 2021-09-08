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
                "url": "<?php echo site_url('administrator/denah/getAllData') ?>",
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

    function ubah(id) {
        save_method = 'update';
        $('#myform1')[0].reset();
        $('#formUpdate').show();
        $('#formGambar').hide();
        $('#formAdd').hide();
        $('.reset').hide();
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('administrator/denah/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id1"]').val(data.id);
                $('[name="nama_bunga1"]').val(data.nama_bunga);
                $('[name="status1"]').val(data.status);
                $('[name="create_date1"]').val(data.create_date);
                $('[name="gambar1"]').val(data.gambar);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function ubah_gambar(id) {
        save_method = 'update';
        $('#myform2')[0].reset();
        $('#formUpdate').hide();
        $('#formGambar').show();
        $('#formAdd').hide();
        $('.reset').hide();
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('administrator/denah/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id2"]').val(data.id);
                $('[name="nama_bunga2"]').val(data.nama_bunga);
                $('[name="gambar2"]').val(data.gambar);
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
                    url: "<?php echo site_url('administrator/denah/delete'); ?>/" + id,
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
        url = '<?php echo base_url() ?>administrator/denah/update';
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
                    data: $('#myform1').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#myform1 input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateAllTable();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#myform1")[0].reset();
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
        $('#formAdd').hide();
        $('#formUpdate').hide();
        $('#formGambar').hide();


        $("#tombol_show").click(function() {
            $('#myform')[0].reset();
            $('.reset').show();
            $("#formAdd").show();
            $('#formUpdate').hide();
            $('#formGambar').hide();
        })
        $("#tombol_hide").click(function() {
            $("#formAdd").hide();
        })

        $("#hide_update").click(function() {
            $("#formUpdate").hide();
        })
        $("#hide_gambar").click(function() {
            $("#formGambar").hide();
        })
    });
</script>
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('administrator') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home </a> Denah</div>
</div>
<!--End-breadcrumbs-->

<div class="container-fluid">
    <div class="title">
        <h4>Data Denah</h4>
    </div>
    <hr>
    <div class="row-fluid" id="formAdd">
        <div class="span8">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Tambah Data Denah</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="<?php echo base_url('administrator/uploadDenah') ?>" id="myform" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="control-group">
                                <label class="control-label">Nama Bunga :</label>
                                <div class="controls">
                                    <input type="text" id="nama_bunga" name="nama_bunga" class="span11" placeholder="Nama Bunga" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Gambar :</label>
                                <div class="controls">
                                    <input type="file" id="gambar" name="gambar" class="span11" placeholder="Gambar" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status Mekar :</label>
                                <div class="controls">
                                    <!-- <input type="text" id="status" name="status" class="span11" /> -->

                                    <select name="status" id="status" class="span11" required>
                                        <option value="">--Pilih--</option>
                                        <option value="Sedang Mekar">Sedang Mekar</option>
                                        <option value="Belum Mekar">Belum Mekar</option>
                                        <option value="Sedang Replanting">Sedang Replanting</option>
                                        <option value="Sedang Renovasi Taman">Sedang Renovasi Taman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Create Date :</label>
                                <div class="controls">
                                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                    <input type="text" id="create_date" name="create_date" value="<?php echo date('Y-m-d'); ?>" class="span11" placeholder="Create Date" readonly required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="tombol_hide" class="btn btn-danger btn-mini">Tutup</button>
                            <button type="reset" class="btn btn-warning btn-mini reset">Reset</button>
                            <!-- <button type="button" onclick="simpan()" class="btn btn-success">Simpan</button> -->
                            <button type="submit" onclick="alert('Apakah anda yakin ?')" class="btn btn-success btn-mini">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid" id="formUpdate">
        <div class="span8">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Ubah Data</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="" id="myform1" method="post" class="form-horizontal">
                        <input type="hidden" name="id1" id="id1">
                        <div class="modal-body">
                            <div class="control-group">
                                <label class="control-label">Nama Bunga :</label>
                                <div class="controls">
                                    <input type="text" id="nama_bunga1" name="nama_bunga1" class="span11" placeholder="Nama Bunga" required />
                                </div>
                            </div>

                            <input type="hidden" id="gambar1" name="gambar1" class="span11" placeholder="Gambar" />

                            <div class="control-group">
                                <label class="control-label">Status Mekar :</label>
                                <div class="controls">
                                    <!-- <input type="text" id="status" name="status" class="span11" /> -->
                                    <select name="status1" id="status1" class="span11" required>
                                        <option value="">--Pilih--</option>
                                        <option value="Sedang Mekar">Sedang Mekar</option>
                                        <option value="Belum Mekar">Belum Mekar</option>
                                        <option value="Sedang Replanting">Sedang Replanting</option>
                                        <option value="Sedang Renovasi Taman">Sedang Renovasi Taman</option>
                                    </select>
                                </div>
                            </div>

                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="hidden" id="create_date1" name="create_date1" value="<?php echo date('Y-m-d'); ?>" class="span11" placeholder="Create Date" readonly required />

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="hide_update" class="btn btn-danger btn-mini">Tutup</button>
                            <button type="reset" class="btn btn-warning btn-mini reset">Reset</button>
                            <!-- <button type="button" onclick="simpan()" class="btn btn-success">Simpan</button> -->
                            <button type="button" onclick="simpan()" class="btn btn-success btn-mini">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid" id="formGambar">
        <div class="span8">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Ubah Gambar</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="<?php echo base_url('administrator/denah/updateGambar') ?>" id="myform2" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="id2" id="id2">
                        <div class="modal-body">
                            <div class="control-group">
                                <label class="control-label">Nama Bunga :</label>
                                <div class="controls">
                                    <input type="text" id="nama_bunga2" name="nama_bunga2" class="span8" disabled />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Pilih Gambar :</label>
                                <div class="controls">
                                    <input type="file" id="gambar2" name="gambar2" class="span11" placeholder="Gambar Bunga" required />
                                </div>
                            </div>
                            <!-- <input type="file" id="gambar1" name="gambar1" class="span11" placeholder="Gambar" /> -->
                            <!-- <div class="control-group">
                                <label class="control-label">Status Mekar :</label>
                                <div class="controls">
                                    <select name="status1" id="status1" class="span11" required>
                                        <option value="">--Pilih--</option>
                                        <option value="Mekar">Mekar</option>
                                        <option value="Belum Mekar">Belum Mekar</option>
                                        <option value="Sedang Replanting">Sedang Replanting</option>
                                        <option value="Sedang Renovasi Taman">Sedang Renovasi Taman</option>
                                    </select>
                                </div>
                            </div> -->

                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="hidden" id="create_date1" name="create_date1" value="<?php echo date('Y-m-d'); ?>" class="span11" placeholder="Create Date" readonly required />

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="hide_gambar" class="btn btn-danger btn-mini">Tutup</button>
                            <button type="reset" class="btn btn-warning btn-mini reset">Reset</button>
                            <!-- <button type="button" onclick="simpan()" class="btn btn-success">Simpan</button> -->
                            <button type="submit" onclick="alert('Apakah anda sudah yakin ?')" class="btn btn-success btn-mini">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <button type="button" class="btn btn-primary btn-mini" id="tombol_show"><i class="icon-plus"></i> Tambah Data</button></span>
                    <h5>Susunan Denah Bunga</h5>
                    <div class="text-right">
                        <?php if ($this->session->flashdata('alert')) { ?>
                            <button class="btn btn-warning btn-mini" style="color:black">
                                <?php echo $this->session->flashdata('alert'); ?>
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <div class="widget-content nopadding">
                    <table id="data" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Bunga</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Create Date</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Data Denah</h4>
            </div>
            <form action="<?php echo base_url('administrator/uploadDenah') ?>" id="form_inputan" method="post" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Nama Bunga :</label>
                        <div class="controls">
                            <input type="text" id="nama_bunga" name="nama_bunga" class="form-control" placeholder="Nama Bunga" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Status Mekar :</label>
                        <div class="controls">
                            <label>
                                <input type="radio" name="status" id="status" value="Sedang Mekar" />
                                Sedang Mekar</label>
                            <label>
                                <input type="radio" name="status" id="status" value="Belum Mekar" />
                                Belum Mekar</label>
                            <label>
                                <input type="radio" name="status" id="status" value="Sedang Replanting" />
                                Sedang Replanting</label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Create Date :</label>
                        <div class="controls">
                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="text" id="create_date" name="create_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Create Date" readonly />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-mini">Batal</button>
                    <button type="reset" class="btn btn-warning btn-mini">Reset</button>
                    <button type="submit" onclick="alert('Apakah anda yakin ?')" class="btn btn-success btn-mini">Simpan</button>

                </div>
            </form>

        </div>

    </div>
</div> -->