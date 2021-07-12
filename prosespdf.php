<?php 
ini_set('display_errors', 1);
include "database.php";
$id = $_POST['id'];

require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$hasil = mysqli_query($db_conn,"SELECT * FROM daful_siswa WHERE id='$id'");
$konfigurasi = mysqli_query($db_conn,"SELECT * FROM daful_konfigurasi");

if(mysqli_num_rows($hasil) > 0)
{
	function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tahun
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tanggal

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}

	$data = mysqli_fetch_array($hasil);
	$konfig = mysqli_fetch_array($konfigurasi);
	
	// $noujian = $data['no_ujian'];
	$cabang= ucfirst($data['cabang']);
	$unit = strtoupper($data['unit']);

	// var_dump($cabang);
	// die();
	$jk = ($data['jenis_kelamin']==1)?"Laki - Laki": "Perempuan";
	$unitjudul = ($data['unit']=="smp")?("SEKOLAH MENENGAH PERTAMA (SMP)"):($data['unit']=="sma"?"SEKOLAH MENENGAH ATAS (SMA)":"SEKOLAH MENENGAH KEJURUAN (SMK)");

	
	// $kepsek = "";

	if ($data['cabang']=='petojo') 
	{
		switch ($data['unit']) {
			case 'smp':
				$kepsek = $konfig['kepseksmppetojo'];
				break;
			case 'sma':
				$kepsek = $konfig['kepseksmapetojo'];
				break;
			case 'smk':
				$kepsek = $konfig['kepseksmkpetojo'];
				break;
			
			default:
				$kepsek = "";
				break;
		}
	}
	if ($data['cabang']=='cakung') 
	{
		switch ($data['unit']) {
			case 'smp':
				$kepsek = $konfig['kepseksmpcakung'];
				break;
			case 'sma':
				$kepsek = $konfig['kepseksmacakung'];
				break;
			case 'smk':
				$kepsek = $konfig['kepseksmkcakung'];
				break;
			
			default:
				$kepsek = "";
				break;
		}
	}


		// var_dump($unitjudul);
	// die();
	// $jakarta= ($data['cabang']=="petojo") ? "Jakarta Pusat" : "Jakarta Timur";
	$alamatippi = ($data['cabang']=="petojo") ? "Jl. Petojo Barat III No.2  Jakarta Pusat Telp. 6318984, 6313055 - Fax. 6313055" : "Jl. P. Komarudin Ujung Krawang Kober Limo, Pulogebang, Cakung - Jakarta Timur";
	$email = "";
	if ($data['cabang']=='petojo')
	{
		switch ($data['unit']) {
			case 'sma':
				$email="smaypippi_1951@yahoo.com";
				break;
			case 'smk':
				$email="smkypippip@gmail.co.id";
				break;
			case 'smp':
				$email="smp.ypippi_1951@yahoo.co.id";
				break;
			
			default:
				$email="";
				break;
		}
	}
	$hr=($data['cabang']=="cakung")?"":"<hr style=border-width:2px; width:100%;>";

	$noteb='<div style="background-color:#eed202; color:black; padding:10px; font-size:15px;">Form ini harus dibawa pada saat awal masuk sekolah.</div>';

	$date = date("Y-m-d");

	// var_dump(tgl_indo("2000-01-11"));
	// die()

	$html='

		<html>
			<head>
				<style>
					html { margin: 30px 35px 20px 35px; font-family: Arial, Helvetica, sans-serif;}
					

					.kopbesar
					{
						font-size : 16px;
					}

					.kopsedang
					{
						font-size: 15px;
						white-space:nowrap;
					}

					.kopkecil
					{
						font-size: 14px;
						white-space:nowrap;
					}

					.lulus
					{
						margin:0px 0px 0px 100px;
					}

					.lulus td
					{
						padding-top:0px;
						padding-bottom:0px;
					}

					.komli
					{
						margin:10px 0px 5px 180px;
					}

					.tablenilai
					{
						margin:5px 50px 0px 50px;
						border-collapse: collapse;
						font-size:13px;
					}

					.tablenilai td
					{
						border: 1px solid black;
						padding: 1 2 1 2px;
					}

					.tablenilaismk
					{
						margin:5px 120px 0px 120px;
						border-collapse: collapse;
					}

					.tablenilaismk td
					{
						border: 1px solid black;
						padding: 1px;
					}

					.ttd
					{
						border-collapse: collapse;
						margin:10px 50px 0px 50px;
						padding: 0px;
					}

					.text-center
					{
						text-align:center;
					}

					.fontnormal
					{
						font-size: 16px;
					}

					.bordertd
					{
						border-top: 1px solid black;
					}


				</style>
			</head>
			<body>

	';

	if($data['cabang']=="petojo")
	{
		$html.='
		
			<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
						<tr>
							<td><img src="img/logoippi.png" style="width:130px; margin-left:35px;"/>
							</td>
							<td align="center">
								<span class="kopsedang">YAYASAN PERGURUAN</span><br/>
								<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>
								<span class="kopsedang">'.$unitjudul.' YP IPPI PETOJO</span><br/>
								<span class="kopsedang">JAKARTA PUSAT</span><br/>
								<span class="kopbesar">AKREDITASI : "A"</span><br/>
								<span class="kopkecil">'.$alamatippi.'</span><br/>
								<span class="kopkecil">Telp. (021) 48703207 Fax. (021)4808359 Email : '.$email.'
							</td>
						</tr>
				</table>
				<table class="fontnormal" border="0" width="100%">
						<tr>
							<td>
								'.$hr.'
							</td>
						</tr>
				</table>';
	}
	else
	{
		$html.= '

			<table border="0" width="100%" style="margin:0px 5 0px 0px 10px;">
				<tr>
					<td><img src="img/logoippi.png" style="width:130px; margin-left:65px;"/>
					</td>
					<td align="center" style="padding-right:35px;">
						<span class="kopsedang">YAYASAN PERGURUAN</span><br/>	
						<span class="kopsedang">INSTITUT PENGEMBANGAN PENDIDIKAN INDONESIA</span><br/>
							<span class="kopsedang" style="font-size:18px; font-weight:bolder;">'.$unitjudul.'</span><br/>
							<span class="kopsedang" style="font-size:18px; font-weight:bolder;">YP IPPI CAKUNG JAKARTA TIMUR</span><br/>
							<span class="kopsedang" style="font-size:18px; font-weight:bolder;">TERAKREDITASI "A"</span><br/>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="border-top:1px solid black; border-bottom:4px double black; font-size:12px; text-align:center">
						Jl. Ujung Krawang / Jl. Kober Ujung RT. 006 RW. 05, Kelurahan Pulo Gebang Kecamatan Cakung Kota Administrasi Jakarta Timur
					</td>
				</tr>
			</table>
		';
	}

		$html.='
				<table class="fontnormal" border="0">
						<tr align="center">
							<td colspan="3" style="line-height: 1;">
								<div style=font-size:20px;>
									<br>
									<span>FORM DAFTAR ULANG PESERTA DIDIK</span><br>
									<span>SMP - SMA - SMK YP IPPI JAKARTA</span><br>
									<span>TAHUN PELAJARAN 2021 - 2022</span>
								</div>
								<br>
								<br>
								<div>
									Anda telah terdaftar di tingkat selanjutnya.
								</div>
								<br><br>
							</td>
						</tr>
						<tr align="left">
							<td colspan="3">
								<div>
									<table border="0" class="lulus" style="margin-left: 120px;">
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td>'.$data['nama'].'</td>
										</tr>
										<tr>
											<td>Unit</td>
											<td>:</td>
											<td>'.strtoupper($data['unit']).'</td>
										</tr>										
										<tr>
											<td>Kelas</td>
											<td>:</td>
											<td>'.$data['kelas_naik'].'</td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa</td>
											<td>:</td>
											<td>'.$data['nis'].'</td>
										</tr>
										<tr>
											<td>Nomor Induk Siswa Nasional</td>
											<td>:</td>
											<td>'.$data['nisn'].'</td>
										</tr>
										<tr>
											<td>Jenis Kelamin</td>
											<td>:</td>
											<td>'.$jk.'</td>
										</tr>
										<tr>
											<td>Nama Wali</td>
											<td>:</td>
											<td>'.$data['wali'].'</td>
										</tr>
										<tr>
											<td>Nomor Telepon</td>
											<td>:</td>
											<td>'.$data['no_telp'].'</td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>:</td>
											<td>'.$data['alamat'].'</td>
										</tr>
										<tr>											
											<div style="margin:5px 40px 0px 40px; text-align=justify"><br><br>Demikianlah form ini sebagai bukti anda telah melakukan daftar ulang dan anda berada di kelas tersebut. Terima kasih.
											</div>
										</tr>
									</table>
								</div>
							</td>
						</tr>								
					</table>
					
			<div>
				<table width="100%" border="-" class="ttd fontnormal">
					<tr>
						<td width="60%" colspan="2"></td>
						<td width="40%" style="padding-left:4px;">
							<div>Jakarta, '.tgl_indo(date("Y-m-d")).'</div>
							<div>Kepala '.$unit.' YP IPPI '.$cabang.'</div>
										<!-- <div style="margin-top:30px;"><img src="img/ttdpakyusuf.jpeg" height="90"/></div>-->
										<div style="margin-top:50px;">'.$kepsek.'</div>
						</td>				
					</tr>

				</table>

				<table width="100%" border="-" class="ttd fontnormal">
					<tr>
						<td colspan="3">'.$noteb.'</td>
					</tr>
				</table>




		';


}


// var_dump($html);
// die();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

// $dompdf->stream('SKL_'.$nisn.'.pdf');	
$dompdf->stream("daftarulang2122-".$data['nisn'].".pdf", array("Attachment" => 0));
// exit(0);



 ?>