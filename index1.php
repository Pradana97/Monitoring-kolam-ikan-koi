<!DOCTYPE html>
<html>
<?php
$con = mysqli_connect("localhost", "abmbtour_ta", "pradanapodcast123", "abmbtour_ta");
$query = "select * from monitor";
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
    <!-- Daterange picker -->
    <!-- bootstrap wysihtml5 - text editor -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script>
        $(document).ready(function() {
            ajaxCall(); // To output when the page loads
            setInterval(ajaxCall, (2 * 1000)); // x * 1000 to get it in seconds
        });

        function ajaxCall() {
            $.ajax({
                url: 'isi_data.php',
                type: 'get',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                cache: false,
                success: function(response) {
                    document.getElementById('ph').innerHTML = response[0].ph;
                    var ph = document.getElementById('ph').innerHTML;
                    if (ph > 6) {
                        document.getElementById("phku").innerHTML = "Terlalu Basa";
                    } else if (ph == 5 || ph == 6) {
                        document.getElementById("phku").innerHTML = "normal";
                    } else if (ph < 5) {
                        document.getElementById("phku").innerHTML = "ASAM";
                    }

                    //suhu
                    document.getElementById('suhu').innerHTML = response[0].suhu;
                    var suhu = document.getElementById('suhu').innerHTML;
                    if (suhu > 25) {
                        document.getElementById("suhuku").innerHTML = "Hangat";
                    } else if (suhu == 25) {
                        document.getElementById("suhuku").innerHTML = "normal";
                    } else if (suhu < 25) {
                        document.getElementById("suhuku").innerHTML = "Dingi";
                    }

                    //suhu
                    document.getElementById('ppm').innerHTML = response[0].ppm;
                    var ppm = document.getElementById('ppm').innerHTML;
                    if (ppm > 1600) {
                        document.getElementById("ppmku").innerHTML = "banyak";
                    } else if (ppm > 1260 && ppm <= 1600) {
                        document.getElementById("ppmku").innerHTML = "normal";
                    } else if (ppm < 1260) {
                        document.getElementById("ppmku").innerHTML = "sedikit";
                    }
                    document.getElementById('volume').innerHTML = response[0].volume;
                    var volume = document.getElementById('volume').innerHTML;
                    if (volume <= 6) {
                        document.getElementById("volumeku").innerHTML = "banyak";
                    } else if (volume == 7) {
                        document.getElementById("volumeku").innerHTML = "normal";
                    } else if (volume > 8) {
                        document.getElementById("volumeku").innerHTML = "sedikit";
                    }
                }
            });
        };

        function testph() {
            document.getElementById('boxchart1').style.visibility = 'visible';
            document.getElementById('boxchartku').style.visibility = 'visible';
        }

        function testsuhu() {
            document.getElementById('boxchart2').style.visibility = 'visible';
            document.getElementById('boxchartku2').style.visibility = 'visible';
        }

        function testppm() {
            document.getElementById('boxchart3').style.visibility = 'visible';
            document.getElementById('boxchartku3').style.visibility = 'visible';
        }

        function testvolume() {
            document.getElementById('boxchart4').style.visibility = 'visible';
            document.getElementById('boxchartku4').style.visibility = 'visible';
        }
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
                <li class="nav-item active">
                    <a class="nav-link" href="index1.php">HOME</a>
                </li>
                <li class="nav-item">
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
    <br>
    <div class="container-fluid" style="margin-top:10px; ">
        <h1 style="color:#ffffaa; font-weight: bold; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">MONITORING KOLAM KOI</h1>
        <p style="color:#ffffaa; margin-top: -10px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">By ANDY MUHAMMAD SURYO S.kom</p>
    </div>
    <section class="content">
        <!--    
<!--    include 'conect.php';-->
        <!--    $data = mysqli_query($conect,"-->
        <!--Select * From monitor-->
        <!--where id_monitor = (select max(id_monitor) from monitor)");-->
        <!--    while($d = mysqli_fetch_array($data)) {-->
        <!--        ?>-->
        <div id="data" class="row">
            <div class="col-lg-4">
                <!-- small box -->
                <div style="cursor: pointer;" onclick="testph();" class="small-box bg-aqua click1">
                    <div class="inner">
                        <h3 id="ph"></h3>
                        <!--<h3 id="ph"><?php echo $d['ph']; ?></h3>-->
                        <p>PH KOLAM</p>
                        <p id="phku"></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- small box -->
                <div style="cursor: pointer;" onclick="testsuhu();" class="small-box bg-green">
                    <div class="inner">
                        <h3 id="suhu"></h3>
                        <p>SUHU KOLAM</p>
                        <p id="suhuku"></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- small box -->
                <div style="cursor: pointer;" onclick="testvolume();" class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="volume"></h3>
                        <p>KETINGGIAN AIR KOLAM</p>
                        <p id="volumeku"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
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
</script>
<!-- SlimScroll -->
<!-- Bootstrap 3.3.7 -->

</html>