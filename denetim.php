<?php

session_start();
ob_start();
include 'baglanti.php';
$kullanici_adi = htmlentities(mysqli_real_escape_string($baglanti, $_POST['user_name']));
$sifre = md5(md5(htmlentities(mysqli_real_escape_string($baglanti, $_POST['sifre']))));
$sorgula = mysqli_query($baglanti, "SELECT * FROM table_members WHERE user_name='{$kullanici_adi}' and password='{$sifre}'") or die(mysqli_error($baglanti));

$table_members=mysqli_fetch_array($sorgula);

$uye_varmi = mysqli_num_rows($sorgula);
if ($uye_varmi > 0) {
    $_SESSION['giris'] = 'true';
    $_SESSION['kullanici_adi'] = $kullanici_adi;
    $_SESSION['sifre'] = $sifre;
	$_SESSION['member_id'] = $table_members['member_id'];
    setcookie('kullanici_adi', $kullanici_adi, time() + 60 * 60 * 24);
    setcookie('sifre', $sifre, time() + 60 * 60 * 24);
	setcookie('member_id', $table_members['member_id'], time() + 60 * 60 * 24);
    echo str_repeat('<br>', 8) . '<center><img src=images/loading.gif border=0 /> Giris basarili, lutfen bekleyiniz.</center>';
    header('Refresh: 2; url=events_joined.php');
} else {
    echo str_repeat('<br>', 8) . '<center><img src=images/error.gif border=0 /> <br> Kullanici adi veya sifreyi hatali girdiniz! <br> Lutfen tekrar deneyiniz.</center>';
    header('Refresh: 2; url=giris.php');
}
mysqli_close($baglanti);
ob_end_flush();
?>