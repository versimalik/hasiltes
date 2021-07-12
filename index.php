<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include "database.php";
$que = mysqli_query($db_conn, "SELECT * FROM hasiltes_konfigurasi");
$hsl = mysqli_fetch_array($que);
// $timestamp = strtotime($hsl['tgl_pengumuman']);
//echo $timestamp;

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Aplikasi sederhana untuk melihat hasil tes kejuruan dan peminatan Sekolah YP IPPI Jakarta">
    <!-- <meta name="author" content="slamet.bsan@gmail.com"> -->
    <title>Hasil Tes YP IPPI Jakarta</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="css/kelulusan.css" rel="stylesheet">
    <style type="text/css">
        .tdpad{
            padding: 8px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./">Sekolah <?=$hsl['sekolah'] ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="./">Home</a></li>
                <!-- <li><a href="#about">About</a></li> -->
                <!-- <li><a href="#contact">Contact</a></li> -->
              </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

<div class="container">
        <!-- <h2 align="center">Pengumuman Kelulusan 
<?=$hsl['tahun'] ?></h2> -->
        <h3 align="center" style="font-weight: bold;">Pengumuman Hasil Tes</h3>
        <h3 align="center" style="font-weight: bold;">Peminatan dan Kejuruan</h3>
        <h3 align="center" style="font-weight: bold;">SMA - SMK YP IPPI Jakarta</h3>
        <!-- countdown -->
        
        <div id="clock" class="lead"></div>
        
        <div id="xpengumuman">

<?php
	if(isset($_REQUEST['submit']))
	{
		$nisn = $_POST['nisn'];
        $password = $_POST['password'];

        $hasil = mysqli_query($db_conn,"SELECT * FROM hasiltes_siswa WHERE nisn='$nisn' AND password='$password'");

        if(mysqli_num_rows($hasil) > 0)
        {
            $data = mysqli_fetch_array($hasil);
            $cabang = ucfirst($data['cabang']);
            $instansi = strtoupper($data['unit']);

            $belum = '<div class="alert alert-danger" role="alert">Hasil tes untuk '.strtoupper($data['unit']).' belum tersedia.</div>';
            // var_dump($data['id']);
            // die();

?>
            <table class="table table-bordered">
                <tr>
                    <td>NISN / Username</td>
                    <td><?php echo $data['nisn']; ?></td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td>
                        <?php
                            echo $instansi." YP IPPI ".$cabang;
                        ?>                            
                    </td>
                </tr>
                <tr>
                    <td>Nama Siswa</td>
                    <td><?php echo strtoupper($data['nama']); ?></td>
                </tr>
                <tr>
                    <td>Diterima di</td>
                    <td><?php echo strtoupper($data['terimaDi']); ?></td>
                </tr>
                <tr>
                    <td>Nilai</td>
                    <td><?php echo strtoupper($data['nilai']); ?></td>
                </tr>
            </table>

            </div>
        </div><div>
            <!-- <form method="post" action="prosespdf.php">
                <input type="hidden" name="id" value=<?php echo $data['id']; ?>>
                <input type="submit" name="submit" value="Cetak Form Daftar Ulang" class="btn btn-primary btn-sm">

            </form> -->
<?php

        }
        else
        {
            echo 'NISN / USERNAME dan PASSSWORD yang anda masukkan salah! Mohon periksa kembali!';
?>
    
    <form method="post">
        <div class="input-group">
            <!-- <input type="text" name="nomor" class="form-control" data-mask="01-01-0058-9999-9" placeholder="Nomor Ujian" required> -->
            <input type="text" name="nisn" class="form-control" placeholder="NISN atau USERNAME" required>
            <input type="text" name="password" class="form-control" placeholder="PASSWORD" required>
            <!-- <span class="input-group-btn"> -->
                <button class="btn btn-primary btn-block" type="submit" name="submit">Daftar Ulang</button>
            <!-- </span> -->
        </div>
    </form>
        </div>        
    </div><!-- /.container -->
<?php  
        }
	
?>


<?php }else {?>
<!-- form ujian========================================================     -->
    

    <p>Masukkan NISN / USERNAME dan PASSWORD</p>
    
    <form method="post">
        <div class="input-group">
            <!-- <input type="text" name="nomor" class="form-control" data-mask="01-01-0058-9999-9" placeholder="Nomor Ujian" required> -->
            <input type="text" name="nisn" class="form-control" placeholder="NISN atau USERNAME" required>
            <input type="text" name="password" class="form-control" placeholder="PASSWORD" required>
            <!-- <span class="input-group-btn"> -->
                <button class="btn btn-primary btn-block" type="submit" name="submit">Daftar Ulang</button>
            <!-- </span> -->
        </div>
    </form>
        </div>        
    </div><!-- /.container -->
<!-- form ujian========================================================     -->	

<?php }?>

	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; <?=$hsl['tahun'] ?> &middot; Tim IT <?=$hsl['sekolah']; ?></p>
		</div>
	</footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script type="text/javascript">
	var skrg = Date.now();
	$('#clock').countdown("<?=$hsl['tgl_pengumuman'] ?>", {elapse: true})
	.on('update.countdown', function(event) {
	var $this = $(this);
	if (event.elapsed) {
		$( "#xpengumuman" ).show();
		$( "#clock" ).hide();
	} else {
		$this.html(event.strftime('Pengumuman dapat dilihat: <span>%D Hari %H Jam %M Menit %S Detik</span> lagi'));
		$( "#xpengumuman" ).hide();
	}
	});

	</script>
</body>
</html>
