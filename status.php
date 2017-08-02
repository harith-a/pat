<!DOCTYPE html>
<html>
<head>
    <title>Statistik Pendaftaran</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<style type="text/css">

hr.spacer-10 {
  border: 0;
  clear: both;
  margin:0 0 100px;
}

.col-centered{
    float: none;
    margin: 0 auto;
}

canvas {
            width: 100% !important;
            max-width: 1300px;
            height: auto !important;
}

</style>

<body>

<nav class="navbar navbar-inverse navbar-fixed-bottom">
  <div class="container">
    <div class="navbar-header">
            <a class="navbar-brand" href="/">Pendaftaran</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="#meChart">Negeri</a></li>
        <li><a href="#meChart2">Jantina</a></li>
        <li><a href="#meChart3">Umur</a></li>
        <li><a href="#meChart4">Bukan Ahli</a></li>
    </ul>
  </div>
</nav>


<div class="row">
        <div class="col-sm-11 col-centered" id="meChart">
            <canvas id="myChart" class="text-center"></canvas>
        </div>
        <hr class="spacer-10">
</div>
<div class="row">
        <div class="col-sm-11 col-centered" id="meChart2">
            <canvas id="myChart2"></canvas>
        </div>
        <hr class="spacer-10">
</div>

<div class="row ">
        <div class="col-sm-11 col-centered" id="meChart3">
            <canvas id="myChart3"></canvas>
        </div>
        <hr class="spacer-10">
</div>
<div class="row">
        <div class="col-sm-11 col-centered" id="meChart4">
            <canvas id="myChart4"></canvas>
        </div>
        <hr class="spacer-10">
</div>



<script src="js/Chart.min.js"></script>
<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>


//ChartJS plugin to show number on top of bar
Chart.pluginService.register({
    afterDraw: function(chartInstance) {
        var ctx = chartInstance.chart.ctx;
        // render the value of the chart above the bar
        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
        ctx.textAlign = 'center';
        ctx.textBaseline = 'bottom';
        ctx.fillStyle = "#000";
        
        // for (var key in chartInstance) {
        //  console.log(key);
        // }

    
        if ((chartInstance.id ==0) || (chartInstance.id ==2) ){
         chartInstance.data.datasets.forEach(function (dataset) {
            for (var i = 0; i < dataset.data.length; i++) {
                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
                ctx.fillText(dataset.data[i], model.x, model.y - 2);
            }
         });
        }
  }
});

//get canvas height
var myHeight = ($(window).height() - $("#navbar").height());
var navHeight = $("#navbar").height();
// $("#metext").text(myHeight);
$(".navHeight").height(navHeight);
$("#meChart").height(myHeight);
$("#meChart2").height(myHeight);
$("#meChart3").height(myHeight);
$("#meChart4").height(myHeight);


$(document).ready(function() {
    $.getJSON('ajax/getdata.php', function (data) {


//Chart Negeri

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: data.Negeri,
        datasets: [{
            label: 'Pendaftaran',
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            data: data.JumlahNegeri,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Pecahan Negeri (Ahli)', 
        },
        legend: {
            display: false,
        },
        scales: {
            yAxes: [{
                display: true
            }]
        },

    },

});

//Chart Jantina

var ctx2 = document.getElementById("myChart2");
var myChart2 = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ["Lelaki","Perempuan"],
        datasets: [{
            label: 'Jantina Hadir',
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            data: data.JumlahJantina,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Pecahan Jantina (Ahli)', 
        },
        legend: {
            display: false,
        },
        scales: {
            yAxes: [{
                display: true
            }]
        },

    },

});


//chart umur

var ctx3 = document.getElementById("myChart3");
var myChart3 = new Chart(ctx3,{
    type: 'bar',
    data: {
        labels: [">20","20+","30+","40+","50+","60+",">70"],
        datasets: [{
            label: '',
            backgroundColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            borderColor: [
               'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            // data: [0,49],
            data: data.JumlahUmur,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Pecahan Umur (Ahli)', 
        },
        legend: {
            display: false,
        },
        scales: {
            yAxes: [{
                display: true
            }]
        },

    },

});

//Chart Kehadiran Ahli + Bukan Ahli

var ctx4 = document.getElementById("myChart4");
var myChart4 = new Chart(ctx4, {
    type: 'pie',
    data: {
        labels: ["Ahli","Bukan Ahli"],
        datasets: [{
            label: 'Kehadiran Ahli & Bukan Ahli',
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(75, 192, 192, 0.2)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
            ],
            data: data.JumlahAhlixAhli,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Pecahan Keahlian', 
        },
        legend: {
            display: false,
        },
        scales: {
            yAxes: [{
                display: true
            }]
        },

    },

});


});

});
</script>

</body>
</html>

