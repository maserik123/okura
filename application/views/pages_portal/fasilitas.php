<div class=" header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="team-members">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Fasilitas yang tersedia</h2>
                    <p>Dapatkan Fasilitas terbaik saat anda mengunjungi Taman Bunga Impian Okura</p>
                </div>
            </div>
            <?php foreach ($getDataFasilitas as $row) { ?>
                <div class="col-md-4">
                    <div class="team-member">
                        <div class="thumb-container">
                            <img src="<?php echo base_url('gambar/' . $row->url) ?>" alt="">

                        </div>
                        <div class="down-content">
                            <h4><?php echo $row->judul; ?></h4>
                            <p><?php echo $row->keterangan; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>