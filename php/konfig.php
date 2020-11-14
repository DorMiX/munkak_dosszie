<?php
	
	$adatbazis = new mysqli('localhost', 'drobi', 'd75r1104', 'munkak_dosszie');
	$adatbazis->set_charset("utf8");
	if (mysqli_connect_errno())
	{
		echo 'Hiba: Nem sikerült kapcsolódni az adatbázishoz. Kérjük, próbálkozzon később.';
		exit;
	}
?>
