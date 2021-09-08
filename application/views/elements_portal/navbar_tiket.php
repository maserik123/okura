<ul class="navbar-nav ml-auto">
    <li class="nav-item ">
        <a class="nav-link" href="<?php echo base_url('portal') ?>">Home</a>
    </li>
    <li class="nav-item <?php if (isset($active_beranda)) {
                            echo $active_beranda;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/pemesanan_tiket') ?>">Beranda Pemesanan</a>
    </li>
    <li class="nav-item <?php if (isset($active_tiket)) {
                            echo $active_tiket;
                        } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/listTiket'); ?>">Daftar Tiket Anda</a>
    </li>
    <!-- <li class="nav-item <?php if (isset($active_tiket)) {
                                    echo $active_tiket;
                                } ?>">
        <a class="nav-link" href="<?php echo base_url('portal/listTiket'); ?>">Ubah Data Diri</a>
    </li> -->
    <li class="nav-item ">
        <a class="nav-link" style="background-color: red;" onclick="alert('Apakah anda yakin ingin logout ?')" href="<?php echo base_url('portal/logout') ?>">Logout/Keluar</a>
    </li>

</ul>