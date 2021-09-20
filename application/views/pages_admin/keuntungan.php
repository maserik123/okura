 <script>
     function downloadCSV(csv, filename) {
         var csvFile;
         var downloadLink;

         // CSV file
         csvFile = new Blob([csv], {
             type: "text/csv"
         });

         // Download link
         downloadLink = document.createElement("a");

         // File name
         downloadLink.download = filename;

         // Create a link to the file
         downloadLink.href = window.URL.createObjectURL(csvFile);

         // Hide download link
         downloadLink.style.display = "none";

         // Add the link to DOM
         document.body.appendChild(downloadLink);

         // Click download link
         downloadLink.click();
     }

     function exportTableToCSV(filename) {
         var csv = [];
         var rows = document.querySelectorAll("table tr");

         for (var i = 0; i < rows.length; i++) {
             var row = [],
                 cols = rows[i].querySelectorAll("td, th");

             for (var j = 0; j < cols.length; j++)
                 row.push(cols[j].innerText);

             csv.push(row.join(","));
         }

         // Download CSV file
         downloadCSV(csv.join("\n"), filename);
     }
 </script>
 <!--breadcrumbs-->
 <div id="content-header">
     <div id="breadcrumb"> <a href="<?php echo base_url('administrator') ?>" title="Go to Home" class="tip-bottom">
             <i class="icon-home"></i> Home </a> Laporan Pemasukan</div>
 </div>
 <!--End-breadcrumbs-->


 <div class="container-fluid">
     <div class="title">
         <h4>Laporan Pemasukan</h4>
     </div>
     <hr>
     <div class="row-fluid">
         <div class="span12">
             <div class="text-right">
                 <form action="<?php echo site_url('administrator/keuntungan'); ?>" method="POST">
                     <select name="bulan" id="bulan" onchange="this.form.submit();">
                         <option value="">Pilih Bulan</option>
                         <option value="1">Januari</option>
                         <option value="2">Februari</option>
                         <option value="3">Maret</option>
                         <option value="4">April</option>
                         <option value="5">Mei</option>
                         <option value="6">Juni</option>
                         <option value="7">Juli</option>
                         <option value="8">Agustus</option>
                         <option value="9">September</option>
                         <option value="10">Oktober</option>
                         <option value="11">November</option>
                         <option value="12">Desember</option>
                     </select>
                 </form>
             </div>
             <div class="widget-box">
                 <div class="widget-title">
                     <span class="icon">
                         <button onclick="exportTableToCSV('LaporanBulanan.csv')" class="btn btn-success btn-mini">
                             Download Laporan Pemasukan</button>
                     </span>
                     <h5>Tabel Laporan Pemasukan Bulan <?php echo getBulan($bulan); ?></h5>
                 </div>
                 <div class="widget-content nopadding">
                     <table id="data" class="table table-striped table-bordered">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Tanggal</th>
                                 <th>Jumlah Tiket(Q)</th>
                                 <th>Jumlah(Rp)</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $no = 0;
                                foreach ($getDataByBulan as $row) { ?>
                                 <tr>
                                     <td><?php echo ++$no; ?></td>
                                     <td><?php echo ($row->tanggal); ?></td>
                                     <td><?php echo $row->jml_tiket; ?></td>
                                     <td><?php echo rupiah_format($row->jumlah_bayar); ?></td>
                                 </tr>
                             <?php } ?>
                             <tr>
                                 <td colspan="3" style="background-color:burlywood;color:black;">Total Keseluruhan</td>
                                 <td><?php echo rupiah_format($total[0]->total_keseluruhan); ?></td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>