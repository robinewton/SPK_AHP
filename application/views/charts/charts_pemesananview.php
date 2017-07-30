<link rel="shortcut icon" href="<?php echo base_url(); ?>konten/images/charts.png"> <!--link icon-->
<title>Chart Penyewa Pemesanan Gedung</title>
<script src="<?=base_url();?>konten/hightchart/js/jquery.js"></script>
<script src="<?=base_url();?>konten/hightchart/js/highcharts.js"></script>	
<?php
    /* Mengambil query report*/
    foreach($report as $result){
        $nama_gedung[] = $result->nama_gedung; //ambil jumlah
        $jumlah[] = (float) $result->jumlah; //ambil gedung
    }
    /* end mengambil query*/
     
?>
 
<!-- Load chart dengan menggunakan ID -->
<div id="report"></div>
<!-- END load chart -->
 
<!-- Script untuk memanggil library Highcharts -->
<script type="text/javascript">
$(function () {
    $('#report').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: false,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Grafik Pemesanan Penyewaan Gedung UPT. Taman Budaya Jawa Timur',
            style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        subtitle: {
           text: 'Source: SPK UPT. Taman Budaya JATIM',
           style: {
                    fontSize: '15px',
                    fontFamily: 'Verdana, sans-serif'
            }
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        credits: {
            enabled: false
        },
        xAxis: {
            categories:  <?php echo json_encode($nama_gedung);?>
        },
        exporting: { 
            enabled: false 
        },
        yAxis: {
            title: {
                text: 'Jumlah'
            },
        },
        tooltip: {
             formatter: function() {
                 return 'Banyak '+ this.series.name + ' in <b> '+ this.x + '</b> : <b>' + Highcharts.numberFormat(this.y,0) ;
             }
          },
        series: [{
            name: 'Data Pemesanan Gedung',
            data: <?php echo json_encode($jumlah);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                color: '#045396',
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
        </script>