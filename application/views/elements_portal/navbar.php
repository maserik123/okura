<ul class="navbar-nav ml-auto">
    <li class="nav-item <?php if (isset($active_home)) {
                            echo $active_home;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal') ?>">Home</a>
    </li>
    <li class="nav-item <?php if (isset($active_pemesanan_tiket)) {
                            echo $active_pemesanan_tiket;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/pemesanan_tiket'); ?>">Pemesanan Tiket</a>
    </li>
    <li class="nav-item <?php if (isset($active_denah)) {
                            echo $active_denah;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/denah'); ?>">Denah Taman</a>
    </li>
    <li class="nav-item <?php if (isset($active_fasilitas)) {
                            echo $active_fasilitas;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/fasilitas') ?>">Fasilitas</a>
    </li>
    <li class="nav-item <?php if (isset($active_sejarah)) {
                            echo $active_sejarah;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/sejarah') ?>">Sejarah</a>
    </li>
    <li class="nav-item <?php if (isset($active_rating)) {
                            echo $active_rating;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/rating') ?>">Rating & Review</a>
    </li>
    <li class="nav-item <?php if (isset($active_promosi)) {
                            echo $active_promosi;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/promosi') ?>">Promosi</a>
    </li>
    <li class="nav-item <?php if (isset($active_contact)) {
                            echo $active_contact;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/contact'); ?>">Contact Us</a>
    </li>
</ul>