<?php

session_start();
ob_start();
// 1. Katılım saglanacak etkinlige daha onceden katilim saglanmis mi kontrolunu yapiyoruz.
include 'baglanti.php';
$sql_events = 'select * from table_events';
$sorgula_events = mysqli_query($baglanti, $sql_events) or die(mysqli_error($baglanti));
if (!isset($_SESSION['giris'])) {$_SESSION['giris']='false';}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
    <title>Etkinlikleri Listele</title>
    <link href="css/mycssstyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="400" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
  <!--1.cell -->
    	<?php
if	($_SESSION['giris']=='true') {
    echo '<td  align="center"><a href="cikis.php"> ' .$_SESSION['kullanici_adi'].  ',<br> Cikis Yap</a></td>';
								} 
elseif ($_SESSION['giris']=='false') {
    echo '<td  align="center"><a href="giris.php">Giris</a></td>';
									 }
	?>   </td>
   <!--2.cell -->
    	<?php
if ($_SESSION['giris']=='true') {
    null;						} 
elseif ($_SESSION['giris']=='false') {
    echo '<td  align="center"><a href="new_membership.php">Uye Ol</a></td>';
									 }
	?>   </td>
    <!--3.cell -->
	<td  align="center"><a href="index.php">Tum Etkinlikleri Listele</a></td>
	<!--4.cell -->
	<td  align="center"><a href="events_joined.php">Katildigim Etkinlikler</a></td>
  </tr>
</table>
  <tr> <br> </tr>
<form name="list_event_form" method="post" action="join_events.php">
  

<!--START 1.Event Tablosu olusturulur.-->
<table align="center" width="1200" border="1" cellspacing="2" cellpadding="2">

 <tr>
    <td width="100" align="center"><b>Etkinlik Tarihi</b></td>
    <td align="center"><b>Etkinlik Adi </b></td>
    <td align="center"><b>Detaylar</b></td>
	<td align="center"><b>Durum</b></td>
	
 </tr>
 
<?php while ($table_events = mysqli_fetch_array($sorgula_events)) {   ?>
 <tr>
    <td width="200" align="center" > <?php echo $table_events['event_date'];  ?></td>
    <td align="center"> <b><?php echo $table_events['event_name']; ?></td>
    <td><?php echo $table_events['description']; ?></td>
	<!--4.cell -->
    <td>
    <?php
        if ($table_events['event_date'] >= date('Y-m-d h:i:s a', time())) {
            echo  'Gelecek Etkinlik!';
        } elseif ($table_events['event_date'] < date('Y-m-d h:i:s a', time())) {
            echo 'Kacirdiniz!';
        } elseif (1==1) {
		    echo date('Y-m-d h:i:s a', time());
		}
    ?>
    </td>
	<!--5.cell -->
	<?php
if	($_SESSION['giris']=='true' and
	 ($table_events['event_date'] >= date('Y-m-d h:i:s a', time()))) {
	echo '<td  align="center"> <a href="join_event.php?islem=katil&member_id=' ,  $_SESSION['member_id'] , '&event_id=', $table_events['event_id'], '">Katil</a></td>';
  //  echo '<td  align="center"><a href="cikis.php"> ' .$_SESSION['kullanici_adi'].  ',<br> Cikis Yap</a></td>';
								} 
elseif ($_SESSION['giris']=='false') {
    echo '<td  align="center"><a href="giris.php">Katilmak i�in Giris Yap</a></td>';
									 }
	?>   </td>
  </tr>
<?php } ?>
</table>
<!--END 1.Event Tablosu olusturulur.-->
</body>
</html>
</form>
<br>
<div class='tableauPlaceholder' id='viz1526559735987' style='position: relative'><noscript><a href='#'><img alt='Dashboard 1 ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;iw&#47;iwp_proje&#47;Dashboard1&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='iwp_proje&#47;Dashboard1' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;iw&#47;iwp_proje&#47;Dashboard1&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1526559735987');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='1000px';vizElement.style.height='827px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
