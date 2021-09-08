<div class="banner header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="best-features">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2><i class="fa fa-list"></i> Our Promotion</h2>
                </div>
            </div>
            <?php foreach ($getDataPromosi as $row) { ?>
                <div class="col-md-6">
                    <div class="left-content">
                        <h4><?php echo $row->judul ?></h4>
                        <p><?php echo $row->keterangan; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-image">
                        <img src="<?php echo base_url('gambar/' . $row->url) ?>" width="400px" height="300px" alt="">
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>