 <!-- Style CSS -->
 <style>
     #warning {
         display: none;
     }
 </style>

 <div class="banner header-text">
 </div>
 <div class="send-message tab1">
     <div class="container">
         <div class="row">
             <div class="col-md-8">
                 <div class="col-md-12">
                     <div class="section-heading">
                         <!-- <h6 style="color:blue">Anda Belum Login !</h6> -->
                         <h3>Login Pemesanan Tiket</h3>
                         <p>Silahkan masukkan username dan password untuk melakukan pemesanan.</p>
                     </div>
                 </div>
                 <div class="contact-form">
                     <form id="contact" action="<?php echo base_url('portal/login') ?>" method="post">
                         <div class="row">
                             <div class="col-lg-12 col-md-12 col-sm-12">
                                 <fieldset>
                                     <label for="">Username : </label>
                                     <input name="username" type="text" class="form-control" id="username" placeholder="Username" required="">
                                 </fieldset>
                             </div>
                             <div class="col-lg-12 col-md-12 col-sm-12">
                                 <fieldset>
                                     <label for="">Password : </label>
                                     <input name="password" type="password" class="form-control" id="password" placeholder="Password" required="">
                                     <div id="warning" style="font-size: 11px;" class="alert alert-danger mb-0" role="alert">
                                         <strong>PERINGATAN!</strong> Caps Lock aktif.
                                     </div>
                                 </fieldset>
                                 <script>
                                     console.log('test')
                                     var input = document.getElementById("password");
                                     var warning = document.getElementById("warning");
                                     input.addEventListener("keyup", function(event) {
                                         if (event.getModifierState("CapsLock")) {
                                             warning.style.display = "block";
                                         } else {
                                             warning.style.display = "none"
                                         }
                                     });
                                 </script>
                             </div>
                             <div class="col-lg-12">
                                 <br>
                                 <fieldset>
                                     <p> <button type="submit" id="form-submit" onclick="alert('Apakah anda sudah yakin ?')" style="font-size: 13px;" class="btn btn-success">
                                             <li class="fa fa-user"></li> Login
                                         </button>
                                         Anda Lupa Password ? <a href="" style="font-size: 10px;"> Klik disini</a></p><br>
                                     <p style="font-size: 12px;">Belum punya akun ? Silahkan klik <button onclick="window.location = '<?php echo base_url('portal/regis_pengunjung') ?>';" style="font-size: 10px;" class="btn btn-primary">
                                             <li class="fa fa-users"></li> Daftar
                                         </button> </p>
                                 </fieldset>
                                 <?php
                                    $message = $this->session->flashdata('notif');
                                    if ($message) { ?>
                                     <div class="text-right" style="color: blue;"><?php echo $message; ?></div>
                                 <?php } else if ($this->session->flashdata('error')) { ?>
                                     <div class="text-right" style="color: red;"><?php echo $this->session->flashdata('error'); ?></div>
                                 <?php } ?>

                             </div>
                         </div>
                     </form>
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


 <div style="position:fixed;right:14px;bottom:40px;">
     <!-- <a href="https://api.whatsapp.com/send?phone=+6282171717123&text=" title="whatsapp">
        <img src="<?php echo base_url('assets/images/wa.png'); ?>" height="35px;" width="35px;">
    </a>
    <br> -->
     <a style="border-radius:8px" class="btn btn-primary" href="https://api.whatsapp.com/send?phone=+6282288383066" title="Pemesanan" target="_top">
         <img src="<?php echo base_url('assets/assets/images/wa.png'); ?>" height="30px;" width="30px;"> <br> <small style="font-size: 9px;">Contact Us</small>
     </a>
     <!-- <br>
    <a class="chat-sms" href="tel:+6282171717123" title="Sms" target="_top">
        <img src="<?php echo base_url('assets/images/sms.ico'); ?>" height="35px;" width="35px;">
    </a> -->

 </div>