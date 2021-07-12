<?php 

include 'database.php';

$que = mysqli_query($db_conn, 'SELECT * FROM smp');


while($data = mysqli_fetch_array($que))
{
	$rata=str_replace(".", ",", $data['rata']);
	$sql="INSERT INTO un_siswa (nama,ttl,nis,nisn,kelas,no_ujian,instansi,n_pai,n_pkn,n_bindo,n_mtk,n_ipa,n_ips,n_bing,n_sen,n_penj,n_pkwu,jml,rata) VALUES ('$data[nama]','$data[ttl]','$data[nis]','$data[nisn]','$data[kelas]','$data[nopes]','smp','$data[pai]','$data[pkn]','$data[bindo]','$data[mtk]','$data[ipa]','$data[ips]','$data[bing]','$data[senbud]','$data[pjok]','$data[prak]','$data[jml]','$rata');";

	// var_dump($sql);
	// die();

	mysqli_query($db_conn,$sql);
}


 ?>