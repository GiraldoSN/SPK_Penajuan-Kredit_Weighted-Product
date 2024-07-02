<?php
session_start();
include('configdb.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title><?php echo $_SESSION['judul']." - ".$_SESSION['by']; ?></title>
    <link href="ui/css/cerulean.min.css" rel="stylesheet">
    <link href="ui/css/jumbotron.css" rel="stylesheet">
</head>
<body>
    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo $_SESSION['judul']; ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="kriteria.php">Data Kriteria</a></li>
                    <li><a href="alternatif.php">Data Alternatif</a></li>
                    <li><a href="analisa.php">Analisa</a></li>
                    <li class="active"><a href="#">Perhitungan</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
    <div class="container">
        <!-- Main component for a primary marketing message or call to action -->
        <div class="panel panel-primary">
            <div class="panel-heading">Perhitungan</div>
            <div class="panel-body">
                <center>
                    <?php
                    // Mengambil data dari database
                    $alt = get_alternatif();
                    $alt_name = get_alt_name();
                    $kep = get_kepentingan();
                    $cb = get_costbenefit();
                    $k = jml_kriteria();
                    $a = jml_alternatif();
                    $tkep = 0;
                    $tbkep = 0;

                    // Menampilkan matriks alternatif-kriteria
                    echo "<b>Matrix Alternatif - Kriteria</b><br>";
                    echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead><tr><th>Alternatif / Kriteria</th>";
                    for ($i = 1; $i <= $k; $i++) {
                        echo "<th>K$i</th>";
                    }
                    echo "</tr></thead>";
                    for ($i = 0; $i < $a; $i++) {
                        echo "<tr><td><b>A".($i+1)."</b></td>";
                        for ($j = 0; $j < $k; $j++) {
                            echo "<td>".$alt[$i][$j]."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table><hr>";

                    // Menghitung bobot kepentingan
                    echo "<b>Perhitungan Bobot Kepentingan</b><br>";
                    echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead><tr><th></th>";
                    for ($i = 1; $i <= $k; $i++) {
                        echo "<th>K$i</th>";
                    }
                    echo "<th>Jumlah</th></tr></thead>";
                    echo "<tr><td><b>Kepentingan</b></td>";
                    foreach ($kep as $value) {
                        $tkep += $value;
                        echo "<td>$value</td>";
                    }
                    echo "<td>$tkep</td></tr>";
                    echo "<tr><td><b>Bobot Kepentingan</b></td>";
                    foreach ($kep as $value) {
                        $bkep[] = $value / $tkep;
                        $tbkep += end($bkep);
                        echo "<td>".round(end($bkep), 6)."</td>";
                    }
                    echo "<td>$tbkep</td></tr>";
                    echo "</table><hr>";

                    // Menghitung pangkat
                    echo "<b>Perhitungan Pangkat</b><br>";
                    echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead><tr><th></th>";
                    for ($i = 1; $i <= $k; $i++) {
                        echo "<th>K$i</th>";
                    }
                    echo "</tr></thead>";
                    echo "<tr><td><b>Cost/Benefit</b></td>";
                    foreach ($cb as $value) {
                        echo "<td>".ucwords($value)."</td>";
                    }
                    echo "</tr>";
                    echo "<tr><td><b>Pangkat</b></td>";
                    foreach ($cb as $i => $value) {
                        $pangkat[] = ($value == "cost") ? -1 * $bkep[$i] : $bkep[$i];
                        echo "<td>".round($pangkat[$i], 6)."</td>";
                    }
                    echo "</tr>";
                    echo "</table><hr>";

                    // Menghitung nilai S
                    echo "<b>Perhitungan Nilai S</b><br>";
                    echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead><tr><th>Alternatif</th><th>S</th></tr></thead>";
                    for ($i = 0; $i < $a; $i++) {
                        echo "<tr><td><b>A".($i+1)."</b></td>";
                        $ss[$i] = 1;
                        for ($j = 0; $j < $k; $j++) {
                            $s[$i][$j] = pow($alt[$i][$j], $pangkat[$j]);
                            $ss[$i] *= $s[$i][$j];
                        }
                        echo "<td>".round($ss[$i], 6)."</td></tr>";
                    }
                    echo "</table><hr>";

                    // Menghitung hasil akhir
                    echo "<b>Hasil Akhir</b><br>";
                    echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead><tr><th>Alternatif</th><th>V</th></tr></thead>";
                    $total = array_sum($ss);
                    for ($i = 0; $i < $a; $i++) {
                        $v[$i] = round($ss[$i] / $total, 6);
                        echo "<tr><td><b>".$alt_name[$i]."</b></td><td>".$v[$i]."</td></tr>";
                    }
                    echo "</table><hr>";

                    // Menampilkan kesimpulan
                    uasort($v, 'cmp');
                    $ranked = array_keys($v);
                    echo "<div class='alert alert-dismissible alert-info'>";
                    echo "<b><i>Dari tabel tersebut dapat disimpulkan bahwa ".$alt_name[$ranked[0]]." mempunyai hasil paling tinggi, yaitu ".$v[$ranked[0]].".";
                    for ($i = 1; $i < $a; $i++) {
                        echo "</br>Lalu diikuti dengan ".$alt_name[$ranked[$i]]." dengan nilai ".$v[$ranked[$i]].".";
                    }
                    echo "</i></b></div>";

                    // Fungsi-fungsi PHP untuk pengolahan data
                    function jml_kriteria() {
                        global $mysqli;
                        $result = $mysqli->query("SELECT * FROM kriteria");
                        return $result->num_rows;
                    }

                    function jml_alternatif() {
                        global $mysqli;
                        $result = $mysqli->query("SELECT * FROM alternatif");
                        return $result->num_rows;
                    }

                    function get_kepentingan() {
                        global $mysqli;
                        $result = $mysqli->query("SELECT kepentingan FROM kriteria");
                        $kep = [];
                        while ($row = $result->fetch_assoc()) {
                            $kep[] = $row["kepentingan"];
                        }
                        return $kep;
                    }

                    function get_costbenefit() {
                        global $mysqli;
                        $result = $mysqli->query("SELECT cost_benefit FROM kriteria");
                        $cb = [];
                        while ($row = $result->fetch_assoc()) {
                            $cb[] = $row["cost_benefit"];
                        }
                        return $cb;
                    }

                    function get_alt_name() {
                        global $mysqli;
                        $result = $mysqli->query("SELECT alternatif FROM alternatif");
                        $alt = [];
                        while ($row = $result->fetch_assoc()) {
                            $alt[] = $row["alternatif"];
                        }
                        return $alt;
                    }

                    function get_alternatif() {
                        global $mysqli;
                        $result = $mysqli->query("SELECT k1, k2, k3, k4, k5 FROM alternatif");
                        $alt = [];
                        while ($row = $result->fetch_assoc()) {
                            $alt[] = array($row["k1"], $row["k2"], $row["k3"], $row["k4"], $row["k5"]);
                        }
                        return $alt;
                    }

                    function cmp($a, $b) {
                        if ($a == $b) {
                            return 0;
                        }
                        return ($a > $b) ? -1 : 1;
                    }
                    ?>
                </center>
            </div>
            <div class="panel-footer text-primary"><?php echo $_SESSION['by']; ?></div>
        </div>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript -->
    <script src="ui/js/jquery-1.10.2.min.js"></script>
    <script src="ui/js/bootstrap.min.js"></script>
    <script src="ui/js/bootswatch.js"></script>
</body>
</html>
