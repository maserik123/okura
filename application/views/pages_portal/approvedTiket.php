<div class="banner header-text">
</div>
<div class="send-message tab1">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="col-md-12">
                    <div class="section-heading">
                        <!-- <h6 style="color:blue">Anda Belum Login !</h6> -->
                        <h3>Ambil Tiket</h3>
                        <p>Tunjukkan kode transaksi berikut pada kasir ketika memasuki Taman Bunga Impian Okura.</p>
                    </div>
                </div>
                <div class="services">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="service-item">
                                    <h3>KODE TRANSAKSI</h3>
                                    <div class="icon">
                                        <h4> <?php echo $dataTiket[0]->kode_tiket; ?></h4>
                                    </div>
                                    <div class="down-content">

                                        <h4>Username : <?php echo $dataTiket[0]->username; ?></h4>
                                        <p style="color:brown;font-weight: bolder;">Kode tiket ini akan habis masa berlakunya setelah melewati tanggal berkunjung.</p>
                                        <a href="<?php echo base_url('portal/pemesanan_tiket') ?>" class="filled-button btn btn-primary">Beli Tiket Lagi..</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
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