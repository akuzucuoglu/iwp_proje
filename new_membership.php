

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>Yeni Uyelik</title>
<link href="css/mycssstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="600" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td width="20" align="center"><a href="giris.php">Giris</a></td>
	<td width="20" align="center"><a href="new_membership.php">Uye Ol</a></td>
	<td width="20" align="center"><a href="index.php">Tum Etkinlikleri Listele</a></td>
	<td width="40" align="center"><a href="events_joined.php">Katildigim Etkinlikler</a></td>
  </tr>
</table>
<form name="new_member_form" method="post" action="new_membership.php">
  <table width="500" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td></td>
    <td class="giris_td"><img src="images/new_member.jpg" width="200" height="200" /></td>
  </tr>
  <tr>
    <td>Adiniz:</td>
    <td><input type="text" name="first_name" /> <font color="#FF0000">*</font></td>
  </tr>
    <tr>
    <td>Soyadiniz:</td>
    <td><input type="text" name="last_name" /> <font color="#FF0000">*</font></td>
  </tr>
   <tr>
    <td>Kullanici Adi:</td>
    <td><input type="text" name="user_name" /> <font color="#FF0000">*</font></td>
  </tr>
  <tr>
    <td>E-Posta Adresiniz:</td>
    <td><input type="text" name="email" /> <font color="#FF0000">*</font></td>
  </tr>
  <tr>
    <td>Sifre:</td>
    <td><input type="password" name="password" /> <font color="#FF0000">*</font></td>
  </tr>
    <tr>
    <td>Lutfen Sifreyi Yeniden Giriniz:</td>
    <td><input type="password" name="password_again" /> <font color="#FF0000">*</font></td>
  </tr>
  <tr>
    <td></td>
    <td><input type="submit" name="button" value="Uye Ol" /></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
  </table>
</form>

<?php
ob_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'baglanti.php';
    $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$user_name = $_POST['user_name'];
    $password = $_POST['password'];
	echo $password;
    $password_again = $_POST['password_again'];
    $email = $_POST['email'];
    $button = $_POST['button'];
    //$membership_date = date('dd.mm.yyyy');
    if ($user_name == '' or $password == '' or $password_again == '' or $email == '') {
        echo '<center><img src=images/hata.gif border=0 /> Lutfen tüm alanlari eksiksiz doldurdugunuzdan emin olunuz!</center>';
        header('Refresh: 2; url=new_membership.php');
        return;
    } elseif ($password != $password_again) {
        echo '<center><img src=images/hata.gif border=0 /> Girdiginiz sifre ve tekrarladiginiz sifre bilgisi ayni olmalidir!</center>';
        header('Refresh: 2; url=new_membership.php');
        return;
    }
    function checkmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    if (!checkmail($email)) {
        echo '<center><img src=images/hata.gif border=0 /> Yazdiginiz e-posta adresi geçersizdir!</center>';
        header('Refresh: 2; url=new_membership.php');
        return;
    }
    $isim_kontrol = mysqli_query($baglanti, 'select * from table_members where user_name=\'' . $user_name . '\'') or die(mysqli_error($baglanti));
    $uye_varmi = mysqli_num_rows($isim_kontrol);
    if ($uye_varmi > 0) {
        echo '<center><img src=images/hata.gif border=0 /> Kullanici adi baska bir üye tarafindan kullaniliyor!</center>';
        header('Refresh: 2; url=new_membership.php');
        return;
    }
    $eposta_kontrol = mysqli_query($baglanti, 'select * from table_members where email=\'' . $email . '\'') or die(mysqli_error($baglanti));
    $eposta_varmi = mysqli_num_rows($eposta_kontrol);
    if ($eposta_varmi > 0) {
        echo '<center><img src=images/hata.gif border=0 /> E-Posta baska bir üye tarafindan kullaniliyor!</center>';
        header('Refresh: 2; url=new_membership.php');
        return;
    }
    $yenikayit = 'INSERT INTO table_members (first_name,
											 last_name,
											 user_name,
											 password, 
											 email) 
															  VALUES(\'' . $first_name . '\',
																     \'' . $last_name . '\', 
																	 \'' . $user_name . '\',
																	 \'' . md5(md5($password)) . '\',
																	 \'' . $email . '\')'
																	 ;
    $sorgu = mysqli_query($baglanti, $yenikayit);
    echo '<center><img src=images/tamam.gif border=0 /> Kayit islemi tamamlandi, giris sayfasina yönlendiriliyorsunuz.</center>';
    header('Refresh: 2; url= giris.php');
    mysqli_close($baglanti);
}
ob_end_flush();
?>

</body>
</html>