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
                    <h2>Hubungi Kami</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-image">
                    <img src="<?php echo base_url('assets/assets/images/taman4.jpg') ?>" alt="">
                </div>
            </div>
            <?php foreach ($getData as $r) : ?>
                <div class="col-md-6">
                    <div class="left-content">
                        <h4>Saran dan Masukan : </h4>
                        <p>
                            <ul>
                                <li>No Hp/Whatsapp : <?php echo $r->no_hp; ?></li>
                                <li>Instagram : <?php echo $r->instagram; ?></li>
                                <li>Facebook : <?php echo $r->facebook; ?></li>
                            </ul>
                        </p>
                        <ul class="social-icons">
                            <li><a href=""><i class="fa fa-send"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>