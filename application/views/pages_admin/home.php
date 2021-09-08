<!-- Styles -->
<style>
    #bar1 {
        width: 100%;
        height: 300px;
    }

    #bar2 {
        width: 100%;
        height: 300px;
    }

    #pie1 {
        width: 100%;
        height: 300px;
    }

    #pie2 {
        width: 100%;
        height: 300px;
    }
</style>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
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
        "theme": "none",
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

        "dataProvider": [{
            "year": 2009,
            "income": 23.5,
            "expenses": 21.1
        }, {
            "year": 2010,
            "income": 26.2,
            "expenses": 30.5
        }, {
            "year": 2011,
            "income": 30.1,
            "expenses": 34.9
        }, {
            "year": 2012,
            "income": 29.5,
            "expenses": 31.1
        }, {
            "year": 2013,
            "income": 30.6,
            "expenses": 28.2,
            "dashLengthLine": 5
        }, {
            "year": 2014,
            "income": 34.1,
            "expenses": 32.9,
            "dashLengthColumn": 5,
            "alpha": 0.2,
            "additional": "(projection)"
        }],
        "valueAxes": [{
            "axisAlpha": 0,
            "position": "left"
        }],
        "startDuration": 1,
        "graphs": [{
            "alphaField": "alpha",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "fillAlphas": 1,
            "title": "Income",
            "type": "column",
            "valueField": "income",
            "dashLengthField": "dashLengthColumn"
        }, {
            "id": "graph2",
            "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
            "bullet": "round",
            "lineThickness": 3,
            "bulletSize": 7,
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "useLineColorForBulletBorder": true,
            "bulletBorderThickness": 3,
            "fillAlphas": 0,
            "lineAlpha": 1,
            "title": "Expenses",
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

<script>
    var chart = AmCharts.makeChart("bar2", {
        "type": "serial",
        "theme": "none",
        "handDrawn": true,
        "handDrawScatter": 3,
        "legend": {
            "useGraphSettings": true,
            "markerSize": 12,
            "valueWidth": 0,
            "verticalGap": 0
        },
        "dataProvider": [{
            "year": 2005,
            "income": 23.5,
            "expenses": 18.1
        }, {
            "year": 2006,
            "income": 26.2,
            "expenses": 22.8
        }, {
            "year": 2007,
            "income": 30.1,
            "expenses": 23.9
        }, {
            "year": 2008,
            "income": 29.5,
            "expenses": 25.1
        }, {
            "year": 2009,
            "income": 24.6,
            "expenses": 25
        }],
        "valueAxes": [{
            "minorGridAlpha": 0.08,
            "minorGridEnabled": true,
            "position": "top",
            "axisAlpha": 0
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>",
            "title": "Income",
            "type": "column",
            "fillAlphas": 0.8,

            "valueField": "income"
        }, {
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "useLineColorForBulletBorder": true,
            "fillAlphas": 0,
            "lineThickness": 2,
            "lineAlpha": 1,
            "bulletSize": 7,
            "title": "Expenses",
            "valueField": "expenses"
        }],
        "rotate": true,
        "categoryField": "year",
        "categoryAxis": {
            "gridPosition": "start"
        },
        "export": {
            "enabled": true
        }

    });
</script>
<!-- Chart code -->
<script>
    var chart = AmCharts.makeChart("pie1", {
        "type": "pie",
        "theme": "none",
        "dataProvider": [{
            "country": "Lithuania",
            "litres": 501.9
        }, {
            "country": "Czech Republic",
            "litres": 301.9
        }, {
            "country": "Ireland",
            "litres": 201.1
        }, {
            "country": "Germany",
            "litres": 165.8
        }, {
            "country": "Australia",
            "litres": 139.9
        }, {
            "country": "Austria",
            "litres": 128.3
        }, {
            "country": "UK",
            "litres": 99
        }, {
            "country": "Belgium",
            "litres": 60
        }, {
            "country": "The Netherlands",
            "litres": 50
        }],
        "valueField": "litres",
        "titleField": "country",
        "balloon": {
            "fixedPosition": true
        },
        "export": {
            "enabled": true
        }
    });
</script>

<script>
    var chart = AmCharts.makeChart("pie2", {
        "type": "pie",
        "theme": "none",
        "dataProvider": [{
            "country": "Lithuania",
            "value": 260
        }, {
            "country": "Ireland",
            "value": 201
        }, {
            "country": "Germany",
            "value": 65
        }, {
            "country": "Australia",
            "value": 39
        }, {
            "country": "UK",
            "value": 19
        }, {
            "country": "Latvia",
            "value": 10
        }],
        "valueField": "value",
        "titleField": "country",
        "outlineAlpha": 0.4,
        "depth3D": 15,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "angle": 30,
        "export": {
            "enabled": true
        }
    });
</script>
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('administrator') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
</div>
<!--End-breadcrumbs-->

<div class="container-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lb span3"> <a href="#"> <i class="icon-group"></i> <span class="label label-important">20</span> Pengunjung Terdaftar</a> </li>
            <li class="bg_lg span3"> <a href="#"> <i class="icon-money"></i> <span class="label label-important">20</span> Transaksi diterima</a> </li>
            <li class="bg_ls span3"> <a href="#"> <i class="icon-warning-sign"></i> <span class="label label-important">20</span>Total Transaksi ditolak</a> </li>

        </ul>
    </div>
    <!--End-Action boxes-->
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5>Site Analytics</h5>
            </div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span6">
                        <div id="bar1"></div>
                    </div>
                    <div class="span6">
                        <div id="pie1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5>Site Analytics</h5>
            </div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span6">
                        <div id="bar2"></div>
                    </div>
                    <div class="span6">
                        <div id="pie2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>