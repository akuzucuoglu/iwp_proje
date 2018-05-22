<?php

session_start();
ob_start();
/* 1. Giris yapildi mi diye kontrol edilir */
if (!isset($_SESSION['giris'])) {
    echo str_repeat('<br>', 8) . '<center><img src=images/hata.gif border=0 />Bu sayfayi görüntülemek için giris yapmalisiniz.</center>';
    header('Refresh: 2; url= giris.php');
    return;
}

$event_id = $_GET['event_id'];
$member_id= $_GET['member_id'];

include 'baglanti.php';


/* Katilim saglanacak event'e dair bilgiler getirilir. */

$sorgula = mysqli_query($baglanti, 'SELECT event_name, event_date FROM table_events where event_id=\'' . $event_id . '\'') or die(mysqli_error($baglanti));
$event_info = mysqli_fetch_array($sorgula);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>Etkinlige Katil</title>
<link href="css/mycssstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p></p>
<p></p>
<br>
<br>
<br>

<form name="join_event" method="post" action="join_event_finish.php?member_id=<?php echo $member_id;?>&event_id=<?php echo $event_id;?>&num_of_participants=<?php echo '1';?>">
<table align="center" width="400" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td> <b> Etkinlik Adi:</td>
    <td> <?php echo $event_info['event_name'];?></td>
  </tr>
  <tr>
    <td><b> Etkinlik Tarihi:</td>
    <td> <?php echo $event_info['event_date'];?></td>
  </tr>
  <tr>
    <td> <b> Katilimci Sayisi:</td>
    <td><input type="number_format" name="num_of_participants" value="1"  /></td>
  </tr>
  <tr>
  </tr>
  <tr>
   <tr>
  </tr>
    <td> <img src="images/return_arrow.gif" width="32" height="32" /> <a href="index.php"> Geri Dön</a> </td>
    <td><input type="submit" name="button" value="Katil" /></td>
  </tr>
</table>
</form>
</body>
</html>
