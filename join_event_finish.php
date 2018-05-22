<?php
session_start();
ob_start();
include 'baglanti.php';
/* 1. Giris yapildi mi diye kontrol edilir */
if (!isset($_SESSION['giris'])) {
    echo str_repeat('<br>', 8) . '<center><img src=images/error.gif border=0 />Bu sayfayi görüntülemek için giris yapmalisiniz.</center>';
    header('Refresh: 2; url= giris.php');
    return;
}

$event_id = $_GET['event_id'];
$member_id= $_GET['member_id'];


$sorgula = mysqli_query($baglanti, 'SELECT * FROM table_event_member_join WHERE event_id=\'' . $event_id . '\' and member_id=\'' . $member_id . '\'') or die(mysqli_error($baglanti));
$katilim = mysqli_fetch_array($sorgula);
$katilim_var_mi = mysqli_num_rows($sorgula);


/* 2. Halihazirda katilim var mi diye kontrol edilir. */
if ($katilim_var_mi>0) {
    echo str_repeat('<br>', 8) . '<center><img src=images/error.gif border=0 /> <br> Bu etkinlige halihazirda katilim saglamissiniz</center>';
    header('Refresh: 2; url= index.php');
    return;
}
elseif ($katilim_var_mi=0) {
    echo str_repeat('<br>', 8) . '<center><img src=images/loading.gif border=0 /> <br>Bu etkinlige daha önce katilmak için basvurmamissiniz</center>';
    return;
}	

$event_id = $_GET['event_id'];
$member_id= $_GET['member_id'];
$num_of_participants = $_GET['num_of_participants'];

$etkinlik_kayit = 'INSERT INTO table_event_member_join (event_id,
													   member_id,
													   num_of_participants) 
															  VALUES(\'' . $event_id . '\',
																     \'' . $member_id . '\', 
																	 \'' . $num_of_participants . '\')';
																	 ;	
$sorgu = mysqli_query($baglanti, $etkinlik_kayit);

mysqli_close($baglanti);
ob_end_flush();

echo str_repeat('<br>', 8) . '<center><img src=images/tamam.gif border=0 />Katilma islemi basariyla sonlandi.<br>
							   Katildiginiz etkinlikler sayfasina yonlendiriliyorsunuz.</center>';
    header('Refresh: 2; url= events_joined.php');
    return;

?>