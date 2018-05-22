<?php

session_start();
ob_start();
include 'baglanti.php';
if ((!isset($_SESSION['giris'])) or $_SESSION['giris']=='false') {
    echo str_repeat('<br>', 8) . '<center><img src=images/error.gif border=0 /> <br> Bu sayfayi görüntülemek için giris yapmalisiniz.</center>';
    header('Refresh: 2; url= giris.php');
    return;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>Katildigim Etkinlikler</title>
<link href="css/mycssstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="600" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
  <!--1.hücre -->
    	<?php
if	($_SESSION['giris']=='true') {
    echo '<td width="20"   align="center"><a href="cikis.php"> ' .$_SESSION['kullanici_adi'].  ',<br> Cikis Yap</a></td>';
								} 
elseif ($_SESSION['giris']=='false') {
    echo '<td width="20"  align="center"><a href="giris.php">Giris</a></td>';
									 }
	?>   </td>
    	<?php
if ($_SESSION['giris']=='true') {
    null;						} 
elseif ($_SESSION['giris']=='false') {
    echo '<td  align="center"><a href="new_membership.php">Uye Ol</a></td>';
									 }
	?>   </td>
	<td align="center"><a href="index.php">Tum Etkinlikleri Listele</a></td>
	<td align="center"><a href="events_joined.php">Katildigim Etkinlikler</a></td>
  </tr>
</table>
 <table align="center" width="800" border="0" cellspacing="2" cellpadding="2">
<br>
 <tr>
    <td><b><u>Etkinlik Adi</u></b></td>
    <td><b><u>Etkinlik Tarihi</u></b></td>
    <td><b><u>Katildiginiz Kisi Sayisi</u></b></td>
 </tr>
<?php 
$sorgula = mysqli_query($baglanti, 'SELECT * FROM table_event_member_join tem,
												  table_events te 
									where tem.event_id=te.event_id and tem.member_id=\'' . $_SESSION['member_id'] . '\' order by tem.join_date')
?>

<?php
while ($table_event_member_join = mysqli_fetch_array($sorgula)) {   ?>
 <tr>
    <td><?php echo $table_event_member_join['event_name'];  ?></td>
    <td><?php echo $table_event_member_join['event_date']; ?></td>
    <td><?php echo $table_event_member_join['num_of_participants']; ?></td>
<!--
    <td><a href="admin_islem.php?islem=duzenle&id=<?php echo $uyeler['id'];?>">Düzenle</a></td>
    <td><a href="admin_islem.php?islem=sil&id=<?php echo $uyeler['id'];?>">Sil</a></td>
  </tr>
-->
<?php } ?>
</table>
</form>


</body>
</html>