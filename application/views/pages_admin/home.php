<!-- Styles -->
<style>
#bar1 {
    width: 100%;
    height: 400px;
}
</style>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/light.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<!-- Chart code -->
<!-- Chart code -->
<script>
console.log('test');
var chart = AmCharts.makeChart("bar1", {
    "type": "serial",
    "addClassNames": true,
    "theme": "light",
    "autoMargins": false,
    "marginLeft": 30,
    "marginRight": 8,
    "marginTop": 10,
    "marginBottom": 26,
    "balloon": {
        "adjustBorderColor": false,
        "horizontalPadding": 10,
        "verticalPadding": 8,
        "color": "#ffffff"
    },

    "dataProvider": [
        <?php foreach ($visualisasiPemasukan as $b) { ?> {
            "year": '<?php echo getBulan($b->bulan); ?>',
            "income": <?php echo $b->total; ?>,
            "expenses": <?php echo $b->total; ?>,
            "totalbayar": '<?php echo rupiah_format($b->tot); ?>'
        },
        <?php } ?>
    ],
    "valueAxes": [{
        "axisAlpha": 0,
        "position": "left"
    }],
    "startDuration": 1,
    "graphs": [{
        "alphaField": "alpha",
        "balloonText": "<span style='font-size:12px;'>[[title]] pada bulan [[category]]:<br><span style='font-size:20px;'>[[value]]([[totalbayar]])</span> [[additional]]</span>",
        "fillAlphas": 1,
        "title": "Pemasukan",
        "type": "column",
        "valueField": "income",
        "dashLengthField": "dashLengthColumn"
    }, {
        "id": "graph2",
        "balloonText": "<span style='font-size:12px;'>[[title]] pada bulan [[category]]:<br><span style='font-size:20px;'>[[value]]([[totalbayar]])</span> [[additional]]</span>",
        "bullet": "round",
        "lineThickness": 3,
        "bulletSize": 7,
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "useLineColorForBulletBorder": true,
        "bulletBorderThickness": 3,
        "fillAlphas": 0,
        "lineAlpha": 1,
        "title": "Pemasukan",
        "valueField": "expenses",
        "dashLengthField": "dashLengthLine"
    }],
    "categoryField": "year",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "tickLength": 0
    },
    "export": {
        "enabled": true
    }
});
</script>


<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('administrator') ?>" title="Go to Home" class="tip-bottom"><i
                class="icon-home"></i> Home</a></div>
</div>
<!--End-breadcrumbs-->

<div class="container-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lb span3"> <a href="#"> <i class="icon-group"></i>
                    <span class="label label-important"><?php echo $countPengunjung[0]->total_pengunjung; ?>
                        Orang</span>
                    Pengunjung Terdaftar</a>
            </li>
            <li class="bg_lg span3"> <a href="#"> <i class="icon-money"></i>
                    <span class="label label-important"><?php echo $countTransaksiDiterima[0]->total; ?>
                        Transaksi</span>
                    Transaksi diterima</a> </li>
            <li class="bg_ls span3"> <a href="#"> <i class="icon-warning-sign"></i> <span
                        class="label label-important"><?php echo $countTransaksiDitolak[0]->total; ?>
                        Transaksi</span>Total
                    Transaksi ditolak</a> </li>

        </ul>
    </div>
    <!--End-Action boxes-->
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5>Statistik Pemesanan Tiket Bulanan Tahun <?php echo date('Y'); ?></h5>
            </div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12">
                        <div id="bar1"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>