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


<div class="best-features about-features">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>
                        <li class="fa fa-book"></li> Sejarah
                    </h2>
                    <p>Taman Bunga Impian Okura</p>
                </div>
            </div>
            <?php foreach ($getDataSejarah as $baris) { ?>
                <div class="col-md-5">
                    <div class="left-image">
                        <img src="<?php echo base_url('gambar/' . $baris->url) ?>" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="right-content">
                        <h4><?php echo $baris->judul; ?></h4>
                        <p><?php echo $baris->keterangan; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>