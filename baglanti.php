<?php

$sunucu = 'localhost';  //server
$kullanici = 'root';	//user
$parola = '';			//password
$veritabani = 'biletal';//db

$baglanti = @(count($ahmet_temp = explode(':', $sunucu)) > 1 ? mysqli_connect($ahmet_temp[0], $kullanici, $parola, '', $ahmet_temp[1]) : mysqli_connect($sunucu, $kullanici, $parola));

if (!$baglanti) {die('Mesaj1: Veritabanı sunucusuna bağlantı sağlanamadı!');}

mysqli_select_db($baglanti, $veritabani) or die('Mesaj2: Veritabanina baglanti saglanamadi!');
?>