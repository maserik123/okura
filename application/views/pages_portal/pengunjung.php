<script>
    var save_method;
    console.log('test');

    function hapus(id) {
        swal({
                title: "Apakah Yakin Akan Dihapus?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('portal/pembayaran/delete'); ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        data = resp.result;
                        // updateAllTable();
                        setInterval(() => {
                            window.location = "<?php echo base_url('portal/pemesanan_tiket'); ?>"
                        }, 500);
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
        url = '<?php echo base_url() ?>portal/pembayaran/addData';

        sweetAlert({
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
                    data: $('#daftar').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#daftar input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#daftar")[0].reset();
                            setInterval(() => {
                                window.location = "<?php echo base_url('portal/pemesanan_tiket'); ?>"
                            }, 500);
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

    function showModal() {
        $('#myModal').modal('show');
    }

    function ambilId(id) {
        save_method = 'update';
        $('#myModal').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('portal/pembayaran/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id_pemesanan"]').val(data.id);
                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function simpanRating() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>portal/addFeedBack';

        sweetAlert({
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
                    data: $('#rating').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#rating input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#rating")[0].reset();
                            setInterval(() => {
                                window.location = "<?php echo base_url('portal/pemesanan_tiket'); ?>"
                            }, 2500);
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
<div class="banner header-text">
</div>
<!-- Banner Ends Here -->
<div class="call-to-action">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Status Pembelian Tiket Terbaru</h4>
                            <p> <?php foreach ($dataPemesanan as $r) { ?>
                                    <?php if ($r->tanggal < date('Y-m-d')) { ?>
                                        <div style="font-size:10px;color:brown;">Anda telah berkunjung pada <?php echo tgl_indo($r->tanggal); ?>
                                            <?php if ($r->feedback == 0) { ?>
                                                <button class="btn btn-danger" onclick="ambilId(<?php echo $r->id; ?>)" style="font-size:9px;background-color:brown">
                                                    <li class="fa fa-user"></li> Berikan Feedback
                                                </button>
                                            <?php } else { ?>
                                                <!-- <button class="btn btn-danger" onclick="ambilId(<?php echo $r->id; ?>)" style="font-size:9px;background-color:brown" disabled>
                                                    <li class="fa fa-user"></li> Berikan Feedback
                                                </button> -->
                                            <?php } ?>
                                        </div>
                                    <?php    } else { ?>
                                        <?php if ($r->status == 0) { ?>
                                            <p style="font-size:10px;color:green">Tiket (<?php echo tgl_indo($r->tanggal); ?>) <?php if (!empty($r->bukti_bayar)) {
                                                                                                                                    echo 'Telah lunas <a style="font-size: 9px;" class=" badge">Tiket sedang diproses..</a>';
                                                                                                                                } else { ?>
                                                    <a style="font-size: 9px;color:red;font-weight: bolder;" class="btn btn-warning" href="<?php echo base_url('portal/upload_bayar/') . $r->id; ?>">Bayar Sekarang !</a>
                                                    <a style="font-size: 9px;font-weight: bolder;color:white" class="btn btn-danger" onclick="hapus(<?php echo $r->id; ?>)">Batal / Hapus</a>
                                                <?php } ?></p>
                                        <?php } else if ($r->status == 1) { ?>
                                            <p style="font-size:11px;color:blue">Tiket pada (<?php echo tgl_indo($r->tanggal); ?>) Confirmed ! <a style="font-size: 8px;" class="btn btn-primary" href="<?php echo base_url('portal/approvedTiket/') . $r->id; ?>">Ambil/Lihat Tiket!</a></p>
                                        <?php } else { ?>
                                            <p style="font-size:11px;color:red"> Transaksi pada (<?php echo tgl_indo($r->tanggal); ?>) ditolak ! </p>

                                        <?php } ?>
                                <?php }
                                } ?>
                            </p>
                            <br>
                            <a href="<?php echo base_url('portal/listTiket') ?>" class="btn btn-info" style="font-size: 12px;">Kelola Tiket Anda</a>
                        </div>
                    </div>
                    <br>
                    <p style="font-size:12px;">Keterangan :
                        <ul>
                            <li style="font-size: 11px;">
                                <a style="color:green"><strong>Status Hijau</strong></a> : Perlu Pembayaran !
                            </li>
                            <li style="font-size: 11px;">
                                <a style="color:blue"><strong>Status Biru</strong> </a>: Transaksi Berhasil dan telah di terima !
                            </li>
                            <li style="font-size: 11px;">
                                <a style="color:red"><strong>Status Merah</strong> </a>: Transaksi Ditolak !
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Hai <?php echo $this->session->userdata('username') ?>, <span style="color:green;">Status kamu sedang login..</span> <br> Selamat datang di <em>menu pemesanan tiket</em> </h5>
                            <p style="font-size: 10px;">Kamu dapat melakukan pemesanan tiket secara online, Harga tiket perorang adalah <strong style="font-size: 14px;"> Rp.5000</strong></p> <br>
                        </div>
                        <div class="contact-form">
                            <form id="daftar" action="" method="post">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'id' => 'id')); ?>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label style="font-size: 12px;">Tanggal Akan Berkunjung</label>
                                            <input name="tanggal" type="date" class="form-control" id="tanggal" placeholder="Tanggal Berkunjung" required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <input name="jml_tiket" type="number" class="form-control" id="jml_tiket" placeholder="Jumlah Tiket" required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <select class="form-control" name="id_rekening" id="id_rekening" required>
                                                <option value="">Pilih Rekening Pembayaran</option>
                                                <?php foreach ($dataRekening as $row) { ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->jenis_bank; ?></option>
                                                <?php } ?>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <br><br><br>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <!-- <?php if (empty($dataPemesanan[0]->bukti_bayar)) { ?>
                                                <button type="button" onclick="simpan()" style="font-size: 13px;" title="Silahkan selesaikan transaksi pembayaran terlebih dahulu !" class="btn btn-danger" disabled>
                                                    <li class="fa fa-book"></li> Kirim Transaksi <div class=" btn btn-warning badge">Silahkan lakukan pembayaran</div>
                                                </button>
                                            <?php } else { ?> -->
                                            <!-- <?php } ?> -->
                                            <button type="button" onclick="simpan()" style="font-size: 13px;" class="btn btn-success">
                                                <li class="fa fa-book"></li> Kirim Transaksi
                                            </button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <br><br>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" id='rating'>
                    <input type="hidden" name="id" id="id">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <fieldset>
                            <h2 style="font-size: 12px;">Berikan tanggapan anda terhadap taman bunga impian okura</h2><br>
                            <select name="kategori" class="form-control" id="kategori">
                                <option value="">Bagaimana Tanggapan anda ?</option>
                                <option value="sangat_baik">Sangat Baik</option>
                                <option value="baik">Baik</option>
                                <option value="cukup">Cukup</option>
                                <option value="kurang">Kurang Baik</option>
                            </select>
                        </fieldset>
                    </div>
                    <br>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <fieldset>
                            <label for="">Tambahkan Komentar : </label>
                            <textarea name="komentar" id="komentar" class="form-control"></textarea>
                        </fieldset>
                        <input type="hidden" name="id_pemesanan" id="id_pemesanan">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" style="font-size: 10px;" class="btn btn-danger" data-dismiss="modal">X Close</button>
                <button type="button" style="font-size: 10px;" onclick="simpanRating()" class="btn btn-success" data-dismiss="modal">Simpan</button>

            </div>
            </form>
        </div>

    </div>
</div>