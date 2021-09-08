<script>
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
                            window.location = "<?php echo base_url('portal/listTiket'); ?>"
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
</script>
<div class="banner header-text">
</div>
<div class="send-message tab1">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="col-md-12">
                    <div class="section-heading">
                        <!-- <h6 style="color:blue">Anda Belum Login !</h6> -->
                        <h3>Daftar Pembelian Tiket</h3>
                        <p>Riwayat Pembelian Tiket Anda dapat dilihat pada tabel berikut.</p>
                    </div>
                    <div class="card-box table-responsive">

                        <table id="data" class="table table-striped table-bordered" style="width:100%;font-size: 11px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>Kode Transaksi</th> -->
                                    <th>Tanggal Kunjungan</th>
                                    <th>Jumlah Tiket</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status Tiket</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($dataPemesanan)) { ?>
                                    <tr>
                                        <td colspan="7">
                                            <?php echo 'Belum ada transaksi'; ?>
                                        </td>
                                    </tr>
                                <?php   } else { ?>
                                    <?php $no = 0;
                                    foreach ($dataPemesanan as $row) { ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <!-- <td>
                                                <?php if ($row->tanggal < date('Y-m-d')) {
                                                    echo '<div style="color:red;">Kode Expired</div>';
                                                } else {
                                                    echo $row->kode_tiket;
                                                } ?>
                                            </td> -->
                                            <td>
                                                <!-- <?php if ($row->tanggal < date('Y-m-d')) {
                                                            echo '<div style="color:red;">Tanggal Expired</div>';
                                                        } else {
                                                            echo tgl_indo($row->tanggal);
                                                        } ?> -->
                                                <?php echo tgl_indo($row->tanggal); ?>
                                            </td>
                                            <td><?php echo $row->jml_tiket; ?></td>
                                            <td><?php echo $row->bukti_bayar; ?></td>
                                            <td style="text-align: center;">
                                                <?php if ($row->tanggal < date('Y-m-d')) {
                                                    echo '<div style="color:red;">Tiket Expired</div>';
                                                } else {

                                                ?>

                                                    <?php if ($row->status == 1) { ?>
                                                        <div class="btn btn-primary badge">Berhasil dikonfirmasi !</div> <br><br>
                                                        <a style="font-size: 9px;" class="btn btn-info" href="<?php echo base_url('portal/approvedTiket/') . $row->id; ?>">Lihat Tiket!</a>
                                                    <?php } else if ($row->status == 2) { ?>
                                                        <div class="btn btn-danger badge">Permintaan ditolak !</div>
                                                    <?php } else { ?>
                                                        <div class="btn btn-success badge">Permintaan diproses..</div>
                                                <?php }
                                                } ?>
                                            </td>
                                            <td>
                                                <?php if ((!empty($row->bukti_bayar) && ($row->status == 0))) { ?>
                                                    <button style="font-size: 9px;font-weight: bolder;color:white" class="btn btn-danger" onclick="hapus(<?php echo $row->id; ?>)" disabled>Batal / Hapus</button>
                                                <?php } else { ?>
                                                    <a style="font-size: 9px;font-weight: bolder;color:white" class="btn btn-danger" onclick="hapus(<?php echo $row->id; ?>)">Batal / Hapus</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="contact-form">

                </div>
            </div>
            <div class="col-md-4">
                <ul class="accordion">
                    <li>
                        <a>Pemesanan Tiket</a>
                        <div class="content">
                            <p>Silahkan masukkan username yang telah terdaftar pada sistem. Apabila username belum terdaftar silahkan klik tombol daftar terlebih dahulu</p>
                        </div>
                    </li>
                    <li>
                        <a>Pendaftaran Akun</a>
                        <div class="content">
                            <p>Silahkan masukkan username yang telah terdaftar pada sistem. Apabila username belum terdaftar silahkan klik tombol daftar terlebih dahulu</p>
                        </div>
                    </li>
                    <li>
                        <a>Lihat Daftar Pemesanan</a>
                        <div class="content">
                            <p>Silahkan masukkan username yang telah terdaftar pada sistem. Apabila username belum terdaftar silahkan klik tombol daftar terlebih dahulu</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>