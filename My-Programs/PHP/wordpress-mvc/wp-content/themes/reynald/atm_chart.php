<?php
    require_once('../../../wp-load.php');
    get_header();

    if( !is_user_logged_in()) {
        wp_redirect('http://localhost:8090');
        exit();
      }


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpChart - Basic Chart</title>
<script src="/wp-content/themes/reynald/assets/js/chartjs/chart.js"></script>
</head>
<body>

<div style="width:800px;margin:0 auto;">
    <h1>ATM Deployment Summary<h1>

    <canvas id="myChart"></canvas>
    <div id="myDiv"></div>
</div>

<script>

//line, bar, radar, pie, doughnut, polarArea, bubble
// const config = {
//   type: 'bar',
//   data: data,
//   options: {
//     // indexAxis: 'y',       
//   }
// };

var rg = [];
var eg = [];
fetch('http://localhost:8090/wp-content/themes/reynald/atm_chart_data.php')
	.then(res => res.json()).then(data => {
        for(var i = 0; i < data.length; i++) {
            var obj = data[i];
            rg[i] = obj.datedeployed;
            eg[i] = obj.qty;

        }
                
        const cdata = {
            labels: rg,
            datasets: [{
                label: 'ATM Deployment Summary',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: eg,
            }]
            };

            const config = {
            type: 'bar',
            data: cdata,
            options: {
                indexAxis: 'y',       
            }
            };

            const myChart = new Chart(
            document.getElementById('myChart'),
            config
            );


    });

</script>

<?php get_footer(); ?>
</body>
</html>

