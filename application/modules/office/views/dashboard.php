<h4>Menu Dashboard</h4>
<hr class="line11" style="margin-top:0;padding-top:0;">


<div style="height:20px;"></div>

<div class="row">
	<div class="col-md-7">
		<canvas id="canvas"></canvas>	

	</div>
</div>
<br>


<script>
	var config = {
	    type: 'line',
	    data: {
	        labels: [<?php echo $a; ?>],
	        datasets: [{
	            label: "Sudah mengisi penilaian",
	            data: [<?php echo $b; ?>],
	            //fill: false,
	            borderDash: [5, 5],
	        }]
	    },
	    options: {
	        responsive: true,
	        title:{
	            display:true,
	            text:'TOTAL INDEX KEPUASAN MASYARAKAT'
	        },
	        tooltips: {
	            mode: 'label',
	            callbacks: {
	                // beforeTitle: function() {
	                //     return '...beforeTitle';
	                // },
	                // afterTitle: function() {
	                //     return '...afterTitle';
	                // },
	                // beforeBody: function() {
	                //     return '...beforeBody';
	                // },
	                // afterBody: function() {
	                //     return '...afterBody';
	                // },
	                // beforeFooter: function() {
	                //     return '...beforeFooter';
	                // },
	                // footer: function() {
	                //     return 'Footer';
	                // },
	                // afterFooter: function() {
	                //     return '...afterFooter';
	                // },
	            }
	        },
	        hover: {
	            mode: 'dataset'
	        },
	        scales: {
	            xAxes: [{
	                display: true,
	                scaleLabel: {
	                    display: true,
	                    labelString: 'Tanggal'
	                }
	            }],
	            yAxes: [{
	                display: true,
	                scaleLabel: {
	                    display: true,
	                    labelString: 'Value'
	                },
	                ticks: {
	                    suggestedMin: -10,
	                    suggestedMax: 250,
	                }
	            }]
	        }
	    }
	};

	window.onload = function() {
	    var ctx = document.getElementById("canvas").getContext("2d");
	    window.myLine = new Chart(ctx, config);
	};
</script>