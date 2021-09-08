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
                "url": "<?php echo site_url('administrator/gambar/getAllData') ?>",
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
                    url: "<?php echo site_url('administrator/gambar/delete'); ?>/" + id,
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
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('administrator') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home </a> Gambar</div>
</div>
<!--End-breadcrumbs-->

<div class="container-fluid">
    <div class="title">
        <h4>Daftar Gambar</h4>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <button class="btn btn-mini btn-primary" onclick="tambah()"><i class="icon-plus"></i> Tambah Data</button> </span>
                    <h5>Tabel Gambar</h5>
                </div>
                <div class="widget-content nopadding">
                    <table id="data" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul Gambar</th>
                                <th>Jenis</th>
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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <form action="<?php echo base_url('administrator/uploadGambar') ?>" id="form_inputan" method="post" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">

                    <div class="control-group">
                        <label class="control-label">Gambar :</label>
                        <div class="controls">
                            <input type="file" id="url" name="url" class="form-control" placeholder="Gambar" required />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Judul :</label>
                        <div class="controls">
                            <input type="text" id="judul" name="judul" class="form-control" />

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Jenis :</label>
                        <div class="controls">
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="">--Pilih--</option>
                                <option value="Sejarah">Sejarah</option>
                                <option value="Fasilitas">Fasilitas</option>
                                <option value="Promosi">Promosi</option>
                                <option value="Lain-lain">Lain-lain</option>

                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Create Date :</label>
                        <div class="controls">
                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="text" id="create_date" name="create_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Create Date" readonly required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger btn-mini">Tutup</button>
                    <button type="reset" class="btn btn-warning btn-mini reset">Reset</button>
                    <!-- <button type="button" onclick="simpan()" class="btn btn-success">Simpan</button> -->
                    <button type="submit" onclick="alert('Apakah anda yakin ?')" class="btn btn-success btn-mini">Simpan</button>

                </div>
            </form>
        </div>

    </div>
</div>