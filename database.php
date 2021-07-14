<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root021');
define('DB_NAME','u6519370_hasiltes');

$db_conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(mysqli_connect_errno()){
	echo 'Gagal terhubung ke database: '.mysqli_connect_error();
	exit();
}
?>
