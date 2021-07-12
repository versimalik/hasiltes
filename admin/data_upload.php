<?php
session_start();
if(isset($_SESSION['logged']) && !empty($_SESSION['logged'])){
include "../database.php";

	if(isset($_REQUEST['submit'])){
		echo $filename=$_FILES["file"]["tmp_name"];
		
		if($_FILES["file"]["size"] > 0){
			$file = fopen($filename, "r");
			
			mysqli_query($db_conn,"daful_siswa");
			
			while (($unData = fgetcsv($file, 10000, ",")) !== FALSE){

				// var_dump($unData);
				// die();
				// query insert
				// $sql = "INSERT INTO un_siswa (`nisn`, `no_ujian`, `nis`, `cabang`, `instansi`, `komli`, `nama`, `ttl`, `n_pai`, `n_pkn`, `n_bindo`, `n_mtk`, `n_sejin`, `n_bing`, `n_sen`, `n_penj`, `n_simdig`, `n_fis`, `n_kim`, `n_ekob`, `n_admu`, `n_ipa`, `n_c2`, `n_c3`, `rata`)VALUES('$unData[0]','$unData[1]','$unData[2]','$unData[3]','$unData[4]','$unData[5]','$unData[6]','$unData[7]','$unData[8]','$unData[9]','$unData[10]','$unData[11]','$unData[12]','$unData[13]','$unData[14]','$unData[15]','$unData[16]','$unData[17]','$unData[18]','$unData[19]','$unData[20]','$unData[21]','$unData[22]','$unData[23]','$unData[24]')";

				// $sql = "INSERT INTO un_siswa (`nisn`, `no_ujian`, `nis`, `cabang`, `instansi`, `nama`, `ttl`, `n_pai`, `n_pkn`, `n_bindo`, `n_mtk`, `n_ipa`, `n_ips`, `n_bing`, `n_sen`, `n_penj`, `n_pkwu`, `n_tik`, `n_aqidah`, `n_barab`, `n_tahfidz`,`rata`)VALUES('$unData[0]','$unData[1]','$unData[2]','$unData[3]','$unData[4]','$unData[5]','$unData[6]','$unData[7]','$unData[8]','$unData[9]','$unData[10]','$unData[11]','$unData[12]','$unData[13]','$unData[14]','$unData[15]','$unData[16]','$unData[17]','$unData[18]','$unData[19]','$unData[20]','$unData[21]')";

				// $sql = "INSERT INTO daful_siswa (`cabang`, `unit`, `jurusan`, `kelas_asal`, `kelas_naik`, `nis`, `nisn`, `kode_verifikasi`, `nama`, `jenis_kelamin`, `wali`, `no_telp`, `alamat`)VALUES('$unData[0]','$unData[1]','$unData[2]','$unData[3]','$unData[4]','$unData[5]','$unData[6]','$unData[7]','$unData[8]','$unData[9]','$unData[10]','$unData[11]','$unData[12]')";

				$jurusan= strtoupper($unData[2]." ".$unData[3]);

				$sql = "INSERT INTO hasiltes_siswa (`cabang`, `unit`, `jurusan`, `nisn`, `password`, `nama`, `terimaDi`, `nilai`)VALUES('$unData[0]','$unData[1]','$jurusan','$unData[4]','$unData[5]','$unData[6]','$unData[7]','$unData[8]')";

				$res = mysqli_query($db_conn,$sql);

				// var_dump($sql);
				// die();
				
				if(! $res){
					echo "<script type=\"text/javascript\">alert(\"Invalid File!Please Upload CSV File.\");window.location = \"data.php\"</script>";
				}
			}
			
			fclose($file);
			
			echo "<script type=\"text/javascript\">alert(\"CSV File has been successfully Imported.\");window.location = \"data.php\"</script>";
		}
	} else {
		header('Location: data.php');
	}


} else {
	header('Location: ./login.php');
}
?> 