<div class="banner header-text">
</div>
<div class="send-message tab1">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="col-md-12">
                    <div class="section-heading">
                        <!-- <h6 style="color:blue">Anda Belum Login !</h6> -->
                        <h3>Upload Bukti Pembayaran</h3>
                        <p>Silahkan Upload Bukti Pembayaran Disini !</p>
                    </div>
                </div>
                <div class="contact-form">
                    <form id="contact" action="<?php echo base_url('portal/upload_bayar/bayar') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <input type="hidden" name="id" value="<?php echo $pembayaran[0]->id; ?>" id="id">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset style="text-align: center;">
                                    <label for="">
                                        Silahkan lakukan pembayaran sebesar <strong> Rp <?php echo number_format_satuan($pembayaran[0]->jml_tiket * 5000); ?></strong><br>
                                        ke rekening : <br><br> <?php echo $pembayaran[0]->jenis_bank . ' <strong>' . $pembayaran[0]->no_rekening . ' A/N ' . $pembayaran[0]->nama . '</strong>'; ?>
                                        <br><br>
                                    </label>
                                </fieldset>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="bukti_bayar" type="file" class="form-control" id="bukti_bayar">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <a href="<?php echo base_url('portal/pemesanan_tiket'); ?>" id="form-submit" style="font-size: 13px;" class="btn btn-danger">
                                        Kembali
                                    </a>
                                    <button type="submit" id="form-submit" style="font-size: 13px;" class="btn btn-success">
                                        <li class="fa fa-user"></li> Kirim Bukti Bayar
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