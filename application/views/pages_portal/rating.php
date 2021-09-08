 <!-- Page Content -->
 <div class="page-heading contact-heading header-text">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="text-content">
                     <h4></h4>
                     <h2></h2>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <div class="products">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="section-heading">
                     <h3>Tanggapan Pengunjung</h3>
                 </div>
             </div>
             <div class="col-md-12">
                 <?php foreach ($getDataRating as $row) { ?>
                     <div class="filters-content">
                         <div class="col-md-12">
                             <div class="product-item">
                                 <div class="down-content">
                                     <small style="font-size:10px;text-align: justify;"><?php echo $row->komentar; ?></small>
                                     <?php if ($row->kategori == 'sangat_baik') { ?>
                                         <ul class="stars">
                                             <li><i class="fa fa-star"></i></li>
                                             <li><i class="fa fa-star"></i></li>
                                             <li><i class="fa fa-star"></i></li>
                                             <li><i class="fa fa-star"></i></li>
                                         </ul>
                                     <?php } else if ($row->kategori == 'baik') { ?>
                                         <ul class="stars">
                                             <li><i class="fa fa-star"></i></li>
                                             <li><i class="fa fa-star"></i></li>
                                             <li><i class="fa fa-star"></i></li>
                                         </ul>
                                     <?php } else if ($row->kategori == 'cukup') { ?>
                                         <ul class="stars">
                                             <li><i class="fa fa-star"></i></li>
                                             <li><i class="fa fa-star"></i></li>
                                         </ul>
                                     <?php } else { ?>
                                         <ul class="stars">
                                             <li><i class="fa fa-star"></i></li>
                                         </ul>
                                     <?php } ?>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php } ?>
             </div>
         </div>
     </div>
 </div>