<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Giris Sayfasi</title>
<link href="css/mycssstyle.css" rel="stylesheet" type="text/css" />
<link rel="css/mycssstyle.css" href="https://fonts.googleapis.com/css?family=Raleway">
</head>

<body>
<!--START 1.Navigation Tablosu Oluşturulur.-->
<table  width="600" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td  width="40" align="center"><a href="giris.php">Giris</a></td>
	<td  width="40" align="center"><a href="new_membership.php">Uye Ol</a></td>
	<td  width="40" align="center"><a href="index.php">Tum Etkinlikleri Listele</a></td>
	<td  width="40" align="center"><a href="events_joined.php">Katildigim Etkinlikler</a></td>
	
  </tr>
</table>
<!--END 1.Navigation Tablosu Oluşturulur.-->
<br>
<form name="giris_form" method="post" action="denetim.php">
<table width="400" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td></td>
    <td class="giris_td"><img src="images/keys.png" width="81" height="89" /></td>
  </tr>
  <tr> <td> <br> </td>  </tr>
  <tr>
    <td>Kullanici adi:</td>
    <td><input type="text" name="user_name" /></td>
  </tr>
  <tr>
    <td>Sifre:</td>
    <td><input type="password" name="sifre" /></td>
  </tr>
  <tr>
    <td></td>
    <td><input type="submit" name="gonder" value="Giris Yap" /></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td><a href="new_membership.php">Uye Ol</a></td>
  </tr>
  </table>
</form>
</body>
</html>