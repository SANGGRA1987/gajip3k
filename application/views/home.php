<style type="text/css">
<!--
.style1 {color: #339900}
-->
</style>
<div class="row">
	<div class="col-lg-12 col-xs-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<i class="fa fa-briefcase"></i>
				<h3 class="box-title">REKAPAN REALISASI SP2D GAJI INDUK </h3>				
			</div>
			<div class="box-body"><canvas id="chart" width="1100" height="400"></canvas></div>
		</div>
	</div>
</div>	

<!--highcharts-->
<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
	
<script>
	var barData = {
		labels : ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
		datasets : [
			{
			//fillColor : "rgba(215, 40, 40, 0.9)",
			fillColor : "rgba(0,128,0)",
			strokeColor : "rgba(220,220,220,1)",
			data : [10,20,30,40,50,60,70,80,90,100,110,120]
			}
		]
	}
	var barKu = new Chart(document.getElementById("chart").getContext("2d")).Bar(barData);
   
 /*$(function() {	 		 
	//*****HIGHTCHART	
 	Highcharts.chart('piechart1', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 50,
            beta: 0
        }
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Browser share',
        //url	:'<?php echo base_url('Welcome/getData') ?>',
        data: [
            ['', 213123],
            ['',  2123],
            {
                name: '',
                y:  5442,
                sliced: true,
                selected: true
            },
            ['',  86],
            ['',  64],
            ['',  890]
        ]
    }]
});
		
 }); */
</script>