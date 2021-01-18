<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MONITORING HIDROPONIK</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="asset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
                <li class="nav-item">
                    <a class="nav-link" href="index3.php">MONITORING</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index2.php">LAPORAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">LOG OUT</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid" style="margin-top:10px; ">
        <h1 style="color:#ffffaa; font-weight: bold; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">MONITORING KOLAM KOI</h1>
        <p style="color:#ffffaa; margin-top: -10px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">By ANDY MUHAMMAD SURYO S.kom</p>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="table-responsive bg-dark">
                <table id="example2" class="table table-bordered table-hover" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Parameter</th>
                            <th>PH larutan</th>
                            <th>Suhu Larutan</th>
                            <th>PPM Larutan</th>
                            <th>Volume Larutan</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $con = mysqli_connect("localhost", "root", "", "kolamandi");
                        $data = mysqli_query($con, "select * from parameter ");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr class="table-primary">
                                <td><?php echo $d['id_parameter']; ?></td>
                                <td><?php echo $d['ph']; ?></td>
                                <td><?php echo $d['suhu']; ?></td>
                                <td><?php echo $d['ppm']; ?></td>
                                <td><?php echo $d['volume']; ?></td>
                                <td><?php echo $d['hari']; ?></td>
                                <td><?php echo $d['waktu']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $(function() {
        $('#example2').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': true,
        })
    })
</script>
<script src="asset/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="asset/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="asset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

</html>