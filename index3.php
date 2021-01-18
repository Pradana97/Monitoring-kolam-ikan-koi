<?php
$con = mysqli_connect("localhost", "abmbtour_ta", "pradanapodcast123", "abmbtour_ta");
$query = "select * from parameter";
$result = mysqli_query($con, $query);
$chart_data = '';
$s = strtotime("Y-m-d 06:00:00");
$e = strtotime("Y-m-d 17:00:00");
$a = "";
while ($s != $e) {
    $s = strtotime('+30 minutes', $s);
    $a = date('H:i', $s);
}
while ($d = mysqli_fetch_array($result)) {
    $chart_data .= "{ waktu:'" . $d["waktu"] . "',ph:'" . $d["ph"] . "',suhu:'" . $d["suhu"] . "',ppm:'" . $d["ppm"] . "',volume:'" . $d["volume"] . "'}, ";
}
$chart_data = substr($chart_data, 0, -2);
$data_chartku = json_encode($chart_data);
?>
<!DOCTYPE html>
<html>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>MONITORING HIDROPONIK</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Bootstrap 3.3.7 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="asset/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="asset/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="asset/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="asset/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="asset/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="asset/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="asset/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script>
        $(document).ready(function() {

            var ph = document.getElementById('phku').innerHTML;
            if (ph > 6) {
                document.getElementById("ph1").innerHTML = "TERLALUBASA";
            } else if (ph == 5 || ph == 6) {
                document.getElementById("ph1").innerHTML = "NORMAL";
            } else if (ph < 5) {
                document.getElementById("ph1").innerHTML = "ASAM";
            }

            //suhu
            var suhu = document.getElementById('suhuku').innerHTML;
            if (suhu > 25) {
                document.getElementById("suhu1").innerHTML = "Hangat";
            } else if (suhu == 25) {
                document.getElementById("suhu1").innerHTML = "normal";
            } else if (suhu < 25) {
                document.getElementById("suhu").innerHTML = "Dingi";
            }

            //suhu
            var ppm = document.getElementById('ppmku').innerHTML;
            if (ppm > 1600) {
                document.getElementById("ppm1").innerHTML = "banyak";
            } else if (ppm > 1260 && ppm <= 1600) {
                document.getElementById("ppm1").innerHTML = "normal";
            } else if (ppm < 1260) {
                document.getElementById("ppm1").innerHTML = "sedikit";
            }

            var volume = document.getElementById('volumeku').innerHTML;
            if (volume <= 6) {
                document.getElementById("volume1").innerHTML = "banyak";
            } else if (volume == 7) {
                document.getElementById("volume1").innerHTML = "normal";
            } else if (volume > 8) {
                document.getElementById("volume1").innerHTML = "sedikit";
            }
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="logo" style="width:200px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index1.php">HOME</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index3.php">MONITORING</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index2.php">LAPORAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">LOG OUT</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Content Wrapper. Contains page content -->
    <br>
    <div class="container-fluid" style="margin-top:10px; ">
        <h1 style="color:#ffffaa; font-weight: bold; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">MONITORING KOLAM KOI</h1>
        <p style="color:#ffffaa; margin-top: -10px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">By ANDY MUHAMMAD SURYO S.kom</p>
    </div>
    <br>
    <div class="container">
        <?php
        include 'conect.php';
        $data = mysqli_query($conect, "
    select * From parameter
where id_parameter = (select max(id_parameter) from parameter)");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <h3 style="visibility: hidden" id="phku"><?php echo $d['ph']; ?></h3>
            <h3 style="visibility: hidden" id="suhuku"><?php echo $d['suhu']; ?></h3>
            <h3 style="visibility: hidden" id="ppmku"><?php echo $d['ppm']; ?></h3>
            <h3 style="visibility: hidden" id="volumeku"><?php echo $d['volume']; ?></h3>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <!-- LINE CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">PH AIR KOLAM</h3>
                        <h4 id="ph1"></h4>
                    </div>
                    <div class="box-body chart-responsive">
                        <div id="chart1"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-12">
                <!-- LINE CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">SUHU AIR KOLAM</h3>
                        <h4 id="suhu1"></h4>
                    </div>
                    <div class="box-body chart-responsive">
                        <div id="chart2"></div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-12">
                <!-- LINE CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">KETINGGIAN AIR KOLAM</h3>
                        <h4 id="volume1"></h4>
                    </div>
                    <div class="box-body chart-responsive">
                        <div id="chart4"></div>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>



    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="asset/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="asset/bower_components/raphael/raphael.min.js"></script>
    <script src="asset/bower_components/morris.js/morris.min.js"></script>
    <!-- FastClick -->
    <script src="asset/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->l
    <script src="asset/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="asset/dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        Morris.Line({
            element: 'chart1',
            data: [<?php echo $chart_data; ?>],
            xkey: 'waktu',
            ykeys: ['ph'],
            labels: ['waktu,ph'],
            parseTime: false,
            hideHover: true,
            lineWidth: '6px',
            stacked: true
        });
        Morris.Line({
            element: 'chart2',
            data: [<?php echo $chart_data; ?>],
            xkey: 'waktu',
            ykeys: ['suhu'],
            labels: ['waktu,suhu'],
            parseTime: false,
            hideHover: true,
            lineWidth: '6px',
            stacked: true
        });
        Morris.Line({
            element: 'chart3',
            data: [<?php echo $chart_data; ?>],
            xkey: 'waktu',
            ykeys: ['ppm'],
            labels: ['waktu,ppm'],
            parseTime: false,
            hideHover: true,
            lineWidth: '6px',
            stacked: true
        });
        Morris.Line({
            element: 'chart4',
            data: [<?php echo $chart_data; ?>],
            xkey: 'waktu',
            ykeys: ['volume'],
            labels: ['waktu,volume'],
            parseTime: false,
            hideHover: true,
            lineWidth: '6px',
            stacked: true
        });
        // Morris.Line({
        //     element: 'chart',
        //     data: respon.data_chartku,
        //     xkeys: 'ph',
        //     ykeys: ['ph', 'suhu', 'ppm', 'volume'],
        //     labels: ['ph', 'suhu', 'ppm', 'volume'],
        //     hideHover: 'auto'
        // });
        //$(document).ready(function () {
        //    $.ajax({
        //        url: "<?php //echo url('/'); 
                        ?>//" + "/index3.php",
        //        type: "GET",
        //        dataType: "JSON",
        //        success: function (respon) {
        //            alert("tes");
        //
        //        },
        //        error: function (request, status, error) {
        //        }
        //    });
        //});
        //})
        $(function() {
            // var data = [
            //         {y: '06:00', a: 3},
            //         {y: '07:00', a: 6},
            //         {y: '08:00', a: 5},
            //         {y: '09:00', a: 7},
            //         {y: '10:00', a: 7},
            //         {y: '11:00', a: 6},
            //         {y: '12:00', a: 5},
            //         {y: '13:00', a: 4},
            //         {y: '14:00', a: 5},
            //         {y: '15:00', a: 6},
            //         {y: '16:00', a: 6},
            //         {y: '16:00', a: 6}
            //     ],
            //     config = {
            //         data: data,
            //         xkey: 'y',
            //         ykeys: ['a'],
            //         labels: ['Total Income', 'Total Outcome'],
            //         fillOpacity: 0.6,
            //         hideHover: 'auto',
            //         behaveLikeLine: true,
            //         resize: true,
            //         parseTime: false,
            //         pointFillColors: ['#ffffff'],
            //         pointStrokeColors: ['black'],
            //         lineColors: ['gray', 'red']
            //     };
            //
            // var data2 = [
            //         {y: '06:00', a: 25},
            //         {y: '07:00', a: 26},
            //         {y: '08:00', a: 25},
            //         {y: '09:00', a: 27},
            //         {y: '10:00', a: 24},
            //         {y: '11:00', a: 24},
            //         {y: '12:00', a: 24},
            //         {y: '13:00', a: 25},
            //         {y: '14:00', a: 24},
            //         {y: '15:00', a: 24},
            //         {y: '16:00', a: 25},
            //         {y: '16:00', a: 26}
            //     ],
            //     config2 = {
            //         data: data2,
            //         xkey: 'y',
            //         ykeys: ['a'],
            //         labels: ['Total Income', 'Total Outcome'],
            //         fillOpacity: 0.6,
            //         hideHover: 'auto',
            //         behaveLikeLine: true,
            //         resize: true,
            //         parseTime: false,
            //         pointFillColors: ['#ffffff'],
            //         pointStrokeColors: ['black'],
            //         lineColors: ['gray', 'red']
            //     };
            //
            // var data3 = [
            //         {y: '06:00', a: 2500},
            //         {y: '07:00', a: 2400},
            //         {y: '08:00', a: 2300},
            //         {y: '09:00', a: 2350},
            //         {y: '10:00', a: 2300},
            //         {y: '11:00', a: 2500},
            //         {y: '12:00', a: 2450},
            //         {y: '13:00', a: 2400},
            //         {y: '14:00', a: 2300},
            //         {y: '15:00', a: 2300},
            //         {y: '16:00', a: 2400},
            //         {y: '16:00', a: 2350}
            //     ],
            //     config3 = {
            //         data: data3,
            //         xkey: 'y',
            //         ykeys: ['a'],
            //         labels: ['Total Income', 'Total Outcome'],
            //         fillOpacity: 0.6,
            //         hideHover: 'auto',
            //         behaveLikeLine: true,
            //         resize: true,
            //         parseTime: false,
            //         pointFillColors: ['#ffffff'],
            //         pointStrokeColors: ['black'],
            //         lineColors: ['gray', 'red']
            //     };
            //
            // var data4 = [
            //         {y: '06:00', a: 5},
            //         {y: '07:00', a: 6},
            //         {y: '08:00', a: 7},
            //         {y: '09:00', a: 9},
            //         {y: '10:00', a: 10},
            //         {y: '11:00', a: 7},
            //         {y: '12:00', a: 9},
            //         {y: '13:00', a: 10},
            //         {y: '14:00', a: 6},
            //         {y: '15:00', a: 8},
            //         {y: '16:00', a: 9},
            //         {y: '16:00', a: 10}
            //     ],
            //     config4 = {
            //         data: data4,
            //         xkey: 'y',
            //         ykeys: ['a'],
            //         labels: ['Total Income', 'Total Outcome'],
            //         fillOpacity: 0.6,
            //         hideHover: 'auto',
            //         behaveLikeLine: true,
            //         resize: true,
            //         parseTime: false,
            //         pointFillColors: ['#ffffff'],
            //         pointStrokeColors: ['black'],
            //         lineColors: ['gray', 'red']
            //     };
            //
            // config.element = 'line-chart';
            // config2.element = 'line-chart2';
            // config3.element = 'line-chart3';
            // config4.element = 'line-chart4';
            // Morris.Line(config);
            // Morris.Line(config2);
            // Morris.Line(config3);
            // Morris.Line(config4);
        });
    </script>

</body>

</html>