  <!--sidebar-menu-->
  <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
      <ul>
          <li class="<?php if (isset($active_home)) {
                            echo $active_home;
                        }  ?>"><a href="<?php echo base_url('administrator') ?>"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
          <li class="<?php if (isset($active_pemesananTiket)) {
                            echo $active_pemesananTiket;
                        }  ?>"> <a href="<?php echo base_url('administrator/pemesananTiket') ?>"><i class="icon icon-signal"></i> <span>Daftar Pemesanan Tiket</span></a> </li>
          <li class="<?php if (isset($active_pengunjung)) {
                            echo $active_pengunjung;
                        }  ?>"> <a href="<?php echo base_url('administrator/pengunjung') ?>"><i class="icon icon-inbox"></i> <span>Data Pengunjung</span></a> </li>
          <li class="<?php if (isset($active_denah)) {
                            echo $active_denah;
                        }  ?>"><a href="<?php echo base_url('administrator/denah') ?>"><i class="icon icon-columns"></i> <span>Data Denah</span></a></li>
          <li class="<?php if (isset($active_fasilitas)) {
                            echo $active_fasilitas;
                        }  ?>"><a href="<?php echo base_url('administrator/fasilitas'); ?>"><i class="icon icon-th"></i> <span>Data Fasilitas</span></a></li>
          <li class="<?php if (isset($active_promosi)) {
                            echo $active_promosi;
                        }  ?>"><a href="<?php echo base_url('administrator/promosi'); ?>"><i class="icon icon-star"></i> <span>Data Promosi</span></a></li>
          <li class="<?php if (isset($active_sejarah)) {
                            echo $active_sejarah;
                        }  ?>"><a href="<?php echo base_url('administrator/sejarah') ?>"><i class="icon icon-repeat"></i> <span>Sejarah Taman Okura</span></a></li>
          <li class="<?php if (isset($active_contact)) {
                            echo $active_contact;
                        }  ?>"><a href="<?php echo base_url('administrator/contact') ?>"><i class="icon icon-user"></i> <span>Data Contact</span></a></li>
          <li class="<?php if (isset($active_rating)) {
                            echo $active_rating;
                        }  ?>"><a href="<?php echo base_url('administrator/rating') ?>"><i class="icon icon-link"></i> <span>Rating&Review Pengunjung</span></a></li>
          <li class="<?php if (isset($active_gambar)) {
                            echo $active_gambar;
                        }  ?>"><a href="<?php echo base_url('administrator/gambar') ?>"><i class="icon icon-picture"></i> <span>Data Gambar</span></a></li>
          <li class="<?php if (isset($active_rekening)) {
                            echo $active_rekening;
                        }  ?>"><a href="<?php echo base_url('administrator/rekening') ?>"><i class="icon icon-picture"></i> <span>Data Rekening</span></a></li>
      </ul>
  </div>
  <!--sidebar-menu-->