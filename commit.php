<?php
	include ("php/konfig.php");
	define ("FELTOLTES", "e:\\wamp\\www\\_munka_dosszie_\\files\\");
?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Végrehajtás!</title>
		
	
	<link rel="stylesheet" href="css/table_list.css" />		
	</head>
	<header>
		<p>Végrehajtás!</p>
	</header>
	<body>
		<?php
			
			switch ($_GET['action']) {//hozzáadás vagy módosítás vagy aktiválás/inaktiválás eldöntése
				case 'add'://adat hozzáadás
					switch ($_GET['type']) {//tábla kiválasztása adat hozzáadáshoz
						case 'agazatok': 
							$lekerdezes = "INSERT INTO agazatok (nvAgazat)
								VALUES ('" . $_POST['nvAgazat'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'cegek':
							$lekerdezes = "INSERT INTO cegek (nvCeg, cegteljesnev, irsz, telepules, cim, agazat)
								VALUES ('" . $_POST['nvCeg'] . "',
										'" . $_POST['cegteljesnev'] . "',
										'" . $_POST['irsz'] . "',
										'" . $_POST['telepules'] . "',
										'" . $_POST['cim'] . "',
										'" . $_POST['agazat'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'jogok':
							$lekerdezes = "INSERT INTO jogok (nvJog, allapot)
								VALUES ('" . $_POST['nvJog'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'csoportok':
							$lekerdezes = "INSERT INTO csoportok (nvCsoport, allapot)
								VALUES ('" . $_POST['nvCsoport'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'partnerek':
							$lekerdezes = "INSERT INTO partnerek (ceg, teljesnev, beosztas, reszleg, email, mobil, allapot)
								VALUES ('" . $_POST['ceg'] . "',
										'" . $_POST['teljesnev'] . "',
										'" . $_POST['beosztas'] . "',
										'" . $_POST['reszleg'] . "',
										'" . $_POST['email'] . "',
										'" . $_POST['mobil'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'munkakorok':
							$lekerdezes = "INSERT INTO munkakorok (nvMunkakor, allapot)
								VALUES ('" . $_POST['nvMunkakor'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'felhasznalok':
							$lekerdezes = "INSERT INTO felhasznalok (nvFelhasznalo, nvEmail, csoport, jelszo, teljesnev, munkakor, mobil, allapot)
								VALUES ('" . $_POST['nvFelhasznalo'] . "',
										'" . $_POST['nvEmail'] . "',
										'" . $_POST['csoport'] . "',
										'" . $_POST['jelszo'] . "',
										'" . $_POST['teljesnev'] . "',
										'" . $_POST['munkakor'] . "',
										'" . $_POST['mobil'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'eszkozok':
							$lekerdezes = "INSERT INTO eszkozok (idEszkoz, nvEszkoz, gyarto, tipus, gysz, allapot)
								VALUES ('" . $_POST['idEszkoz'] . "',
										'" . $_POST['nvEszkoz'] . "',
										'" . $_POST['gyarto'] . "',
										'" . $_POST['tipus'] . "',
										'" . $_POST['gysz'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'muszerek':
							$lekerdezes = "INSERT INTO muszerek (idMuszer, nvMuszer, gyarto, tipus, gysz, kalbiz, kaldatum, kalerv, allapot)
								VALUES ('" . $_POST['idMuszer'] . "',
										'" . $_POST['nvMuszer'] . "',
										'" . $_POST['gyarto'] . "',
										'" . $_POST['tipus'] . "',
										'" . $_POST['gysz'] . "',
										'" . $_POST['kalbiz'] . "',
										'" . $_POST['kaldatum'] . "',
										'" . $_POST['kalerv'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'prjtipusok':
							$lekerdezes = "INSERT INTO prjtipusok (nvPrjTipus, allapot)
								VALUES ('" . $_POST['nvPrjTipus'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'projektek':
							$lekerdezes = "INSERT INTO projektek (idProjekt, nvProjekt, prjtipus, letrehozo, leiras, ceg, kezdete, vege, ajanlatkell, megrendelve, dokukesz, advekesz, tibkesz, szamlazva, ellenorzojel, allapot)
								VALUES ('" . $_POST['idProjekt'] . "',
										'" . $_POST['nvProjekt'] . "',
										'" . $_POST['prjtipus'] . "',
										'" . $_POST['letrehozo'] . "',
										'" . $_POST['leiras'] . "',
										'" . $_POST['ceg'] . "',
										'" . $_POST['kezdete'] . "',
										'" . $_POST['vege'] . "',
										'" . $_POST['ajanlatkell'] . "',
										'" . $_POST['megrendelve'] . "',
										'" . $_POST['dokukesz'] . "',
										'" . $_POST['advekesz'] . "',
										'" . $_POST['tibkesz'] . "',
										'" . $_POST['szamlazva'] . "',
										'" . $_POST['ellenorzojel'] . "',
										'" . $_POST['allapot'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'bejegyzesek':
							$lekerdezes = "INSERT INTO bejegyzesek (idProjektNrX, idFelhasznaloX, bejegyzes)
								VALUES ('" . $_POST['idProjektNrX'] . "',
										'" . $_POST['idFelhasznaloX'] . "',
										'" . $_POST['bejegyzes'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'minugyjegyzetek':
							$lekerdezes = "INSERT INTO minugyjegyzetek (idProjektNrX, idFelhasznaloX, jegyzet)
								VALUES ('" . $_POST['idProjektNrX'] . "',
										'" . $_POST['idFelhasznaloX'] . "',
										'" . $_POST['jegyzet'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'xproj_alkm':
							$lekerdezes = "INSERT INTO xproj_alkm (idProjektNrX, idFelhasznaloX)
								VALUES ('" . $_POST['idProjektNrX'] . "',
										'" . $_POST['idFelhasznaloX'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'xproj_eszk':
							$lekerdezes = "INSERT INTO xproj_eszk (idProjektNrX, idEszkozNrX)
								VALUES ('" . $_POST['idProjektNrX'] . "',
										'" . $_POST['idEszkozNrX'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'xproj_musz':
							$lekerdezes = "INSERT INTO xproj_musz (idProjektNrX, idMuszerNrX)
								VALUES ('" . $_POST['idProjektNrX'] . "',
										'" . $_POST['idMuszerNrX'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'xcsop_jog':
							$lekerdezes = "INSERT INTO xcsop_jog (idCsoportX, idJogX)
								VALUES ('" . $_POST['idCsoportX'] . "',
										'" . $_POST['idJogX'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'ajanlatok':
							if ($_FILES['felhasznaloi_fajl']['error']>0) {
								echo 'Hiba történt: ';
								switch ($_FILES['felhasznaloi_fajl']['error']) {
									case 1: echo 'A fájlméret meghaladja a maximálisan feltölthető méretet';
									break;
									case 2: echo 'a fájlméret meghaladja a maximális méretet';
									break;
									case 3: echo 'A fájl feltöltése csak részlegesen sikerült';
									break;
									case 4: echo 'Nem lett fájl feltöltve';
									break;
									case 6: echo 'Nem lehet feltölteni a fájlt: Nincs ideiglenes mappa meghatározva';
									break;
									case 7: echo 'Nem sikerült a feltöltés: Nem lehetett a lemezre írni';
									break;
								}
								exit;
							}
							// Megfelelő MIME-típusú a fájl?
							if ($_FILES['felhasznaloi_fajl']['type'] != 'text/plain') {
								echo 'Hiba: a fájl nem egyszerű szöveg';
								exit;
							}

							// tegyük a fájlt a nekünk tetsző helyre és nevezzük át
							$ideig = explode (".", $_FILES['felhasznaloi_fajl']['name']);
							$ujnev = rand(0, 99999) . '.' . end($ideig);
							
							$feltoltendo_fajl = FELTOLTES . 'ajanlatok\\' . $ujnev;

							if (is_uploaded_file($_FILES['felhasznaloi_fajl']['tmp_name'])) {
								if (!move_uploaded_file($_FILES['felhasznaloi_fajl']['tmp_name'], $feltoltendo_fajl)) {
									echo 'Hiba: Nem sikerült a fájlt a célmappába áthelyezni';
									exit;
								}
							}
							else {
								echo 'Hiba: Fájlfeltöltési támadás lehetősége. Fájlnév: ';
								echo $_FILES['felhasznaloi_fajl']['name'];
								exit;
							}
							echo 'A fájlfeltöltés sikerült! :) <br><br>';

							// távolítsuk el a fájl tartalmából az esetleges HTML és PHP címkéket
							$tartalom = file_get_contents($feltoltendo_fajl);
							$tartalom = strip_tags($tartalom);
							file_put_contents($_FILES['felhasznaloi_fajl']['name'], $tartalom);
							//print_r($_FILES['felhasznaloi_fajl']['name']);
							//$eutvonal = realpath($_FILES['felhasznaloi_fajl']['tmp_name']);
							//echo "eredeti útvonal = " . $eutvonal . '<br>';
							$efajlnev = $_FILES['felhasznaloi_fajl']['name'];
							// echo "eredeti fájlnév = " . $efajlnev . '<br>';
							$tutvonal = FELTOLTES . 'ajanlatok\\';
							$tutvonal = addslashes($tutvonal);
							// echo "tárolt útvonal = " . $tutvonal . '<br>';
							$tfajlnev = $ujnev;
							// echo "tárolt fájlnév = " . $tfajlnev . '<br>';
							$tlink = FELTOLTES . 'ajanlatok\\' . $ujnev;
							$tlink = addslashes($tlink);
							// echo "tárolt link= " . $tlink . '<br>';
							//$link = mysql_real_escape_string( urlencode($_POST['link']) ); 
							
							$lekerdezes = "INSERT INTO ajanlatok (idAjanlat, rleiras, idProjektNrX, efajlnev, tutvonal, tfajlnev, tlink)
								VALUES ('" . $_POST['idAjanlat'] . "',
										'" . $_POST['rleiras'] . "',
										'" . $_POST['idProjektNrX'] . "',
										'" . $efajlnev . "',
										'" . $tutvonal . "',
										'" . $tfajlnev . "',
										'" . $tlink . "')";
							// echo $lekerdezes;
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'atadasatvetelik':
							$lekerdezes = "INSERT INTO atadasatvetelik (idAtadasAtveteli, idProjektNrX, eutvonal, efajlnev, tutvonal, tfajlnev, tlink)
								VALUES ('" . $_POST['idAtadasAtveteli'] . "',
										'" . $_POST['idProjektNrX'] . "',
										'" . $_POST['eutvonal'] . "',
										'" . $_POST['efajlnev'] . "',
										'" . $_POST['tutvonal'] . "',
										'" . $_POST['tfajlnev'] . "',
										'" . $_POST['tlink'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'dokumentek':
							$lekerdezes = "INSERT INTO dokumentek (idDokument, idProjektNrX, eutvonal, efajlnev, tutvonal, tfajlnev, tlink)
								VALUES ('" . $_POST['idDokument'] . "',
										'" . $_POST['idProjektNrX'] . "',
										'" . $_POST['eutvonal'] . "',
										'" . $_POST['efajlnev'] . "',
										'" . $_POST['tutvonal'] . "',
										'" . $_POST['tfajlnev'] . "',
										'" . $_POST['tlink'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'megrendelesek':
							$lekerdezes = "INSERT INTO megrendelesek (idMegrendeles, idProjektNrX, eutvonal, efajlnev, tutvonal, tfajlnev, tlink)
								VALUES ('" . $_POST['idMegrendeles'] . "',
										'" . $_POST['idProjektNrX'] . "',
										'" . $_POST['eutvonal'] . "',
										'" . $_POST['efajlnev'] . "',
										'" . $_POST['tutvonal'] . "',
										'" . $_POST['tfajlnev'] . "',
										'" . $_POST['tlink'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'szamlak':
							$lekerdezes = "INSERT INTO szamlak (idSzamla, idProjektNrX, eutvonal, efajlnev, tutvonal, tfajlnev, tlink)
								VALUES ('" . $_POST['idSzamla'] . "',
										'" . $_POST['idProjektNrX'] . "',
										'" . $_POST['eutvonal'] . "',
										'" . $_POST['efajlnev'] . "',
										'" . $_POST['tutvonal'] . "',
										'" . $_POST['tfajlnev'] . "',
										'" . $_POST['tlink'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'tibek':
							$lekerdezes = "INSERT INTO tibek (idTib, idProjektNrX, eutvonal, efajlnev, tutvonal, tfajlnev, tlink)
								VALUES ('" . $_POST['idTib'] . "',
										'" . $_POST['idProjektNrX'] . "',
										'" . $_POST['eutvonal'] . "',
										'" . $_POST['efajlnev'] . "',
										'" . $_POST['tutvonal'] . "',
										'" . $_POST['tfajlnev'] . "',
										'" . $_POST['tlink'] . "')";
							$talalat = $adatbazis->query($lekerdezes);
						break;//VÉGE::'tibek'
					}//VÉGE::tábla kiválasztása adat hozzáadáshoz
				break;//VÉGE::hozzáadás
				case 'edit'://adat szerkesztése
					switch ($_GET['type']) {//tábla kiválasztása adat szerkesztéshez
						case 'agazatok':
							$lekerdezes = "UPDATE agazatok SET 
								nvAgazat = '" . $_POST['nvAgazat'] . "'
							WHERE
								idAgazat = " . $_POST['idAgazat'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'cegek':
							$lekerdezes = "UPDATE cegek SET 
								nvCeg = '" . $_POST['nvCeg'] . "',
								cegteljesnev = '" . $_POST['cegteljesnev'] . "',
								irsz = '" . $_POST['irsz'] . "',
								telepules = '" . $_POST['telepules'] . "',
								cim = '" . $_POST['cim'] . "',
								agazat = '" . $_POST['agazat'] . "'
							WHERE
								idCeg = " . $_POST['idCeg'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'jogok':
							$lekerdezes = "UPDATE jogok SET 
								nvJog = '" . $_POST['nvJog'] . "'
							WHERE
								idJog = " . $_POST['idJog'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'csoportok':
							$lekerdezes = "UPDATE csoportok SET 
								nvCsoport = '" . $_POST['nvCsoport'] . "'
							WHERE
								idCsoport = " . $_POST['idCsoport'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'partnerek':
							$lekerdezes = "UPDATE partnerek SET 
								ceg = '" . $_POST['ceg'] . "',
								teljesnev = '" . $_POST['teljesnev'] . "',
								beosztas = '" . $_POST['beosztas'] . "',
								reszleg = '" . $_POST['reszleg'] . "',
								email = '" . $_POST['email'] . "',
								mobil = '" . $_POST['mobil'] . "'
							WHERE
								idPartner = " . $_POST['idPartner'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'munkakorok':
							$lekerdezes = "UPDATE munkakorok SET 
								nvMunkakor = '" . $_POST['nvMunkakor'] . "'
							WHERE
								idMunkakor = " . $_POST['idMunkakor'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'felhasznalok':
							$lekerdezes = "UPDATE felhasznalok SET 
								nvFelhasznalo = '" . $_POST['nvFelhasznalo'] . "',
								nvEmail = '" . $_POST['nvEmail'] . "',
								csoport = '" . $_POST['csoport'] . "',
								jelszo = '" . $_POST['jelszo'] . "',
								teljesnev = '" . $_POST['teljesnev'] . "',
								munkakor = '" . $_POST['munkakor'] . "',
								mobil = '" . $_POST['mobil'] . "'
							WHERE
								idFelhasznalo = " . $_POST['idFelhasznalo'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'eszkozok':
							$lekerdezes = "UPDATE eszkozok SET 
								idEszkoz = '" . $_POST['idEszkoz'] . "',
								nvEszkoz = '" . $_POST['nvEszkoz'] . "',
								gyarto = '" . $_POST['gyarto'] . "',
								tipus = '" . $_POST['tipus'] . "',
								gysz = '" . $_POST['gysz'] . "'
							WHERE
								idEszkozNr = " . $_POST['idEszkozNr'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'muszerek':
							$lekerdezes = "UPDATE muszerek SET 
								idMuszer = '" . $_POST['idMuszer'] . "',
								nvMuszer = '" . $_POST['nvMuszer'] . "',
								gyarto = '" . $_POST['gyarto'] . "',
								tipus = '" . $_POST['tipus'] . "',
								gysz = '" . $_POST['gysz'] . "',
								kalbiz = '" . $_POST['kalbiz'] . "',
								kaldatum = '" . $_POST['kaldatum'] . "',
								kalerv = '" . $_POST['kalerv'] . "'
							WHERE
								idMuszerNr = " . $_POST['idMuszerNr'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'prjtipusok':
							$lekerdezes = "UPDATE prjtipusok SET 
								nvPrjTipus = '" . $_POST['nvPrjTipus'] . "'
							WHERE
								idPrjTipus = " . $_POST['idPrjTipus'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'projektek':
							$lekerdezes = "UPDATE projektek SET 
								nvProjekt = '" . $_POST['nvProjekt'] . "',
								prjtipus = '" . $_POST['prjtipus'] . "',
								letrehozo = '" . $_POST['letrehozo'] . "',
								leiras = '" . $_POST['leiras'] . "',
								ceg = '" . $_POST['ceg'] . "',
								kezdete = '" . $_POST['kezdete'] . "',
								vege = '" . $_POST['vege'] . "',
								ajanlatkell = '" . $_POST['ajanlatkell'] . "',
								megrendelve = '" . $_POST['megrendelve'] . "',
								dokukesz = '" . $_POST['dokukesz'] . "',
								advekesz = '" . $_POST['advekesz'] . "',
								tibkesz = '" . $_POST['tibkesz'] . "',
								szamlazva = '" . $_POST['szamlazva'] . "',
							WHERE
								idProjektNr = " . $_POST['idProjektNr'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'bejegyzesek':
							//echo $_POST['bejegyzes'] . " " . $_POST['idBejegyzes'];
							$lekerdezes = "UPDATE bejegyzesek SET 
								bejegyzes = '" . $_POST['bejegyzes'] . "' 
							WHERE 
								idBejegyzes = " . $_POST['idBejegyzes'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'minugyjegyzetek':
							$lekerdezes = "UPDATE minugyjegyzetek SET 
								jegyzet = '" . $_POST['jegyzet'] . "'
							WHERE
								idMinUgyJegyzet = " . $_POST['idMinUgyJegyzet'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'ajanlatok':
							$lekerdezes = "UPDATE ajanlatok SET 
								idAjanlat = '" . $_POST['idAjanlat'] . "',
								rleiras = '" . $_POST['rleiras'] . "'
							WHERE
								idAjanlatNr = " . $_POST['idAjanlatNr'];
							/*,
								efajlnev = '" . $efajlnev . "',
								tutvonal = '" . $tutvonal . "',
								tfajlnev = '" . $tfajlnev . "',
								tlink = '" . $tlink . "'*/
								
							//echo $lekerdezes;
							$talalat = $adatbazis->query($lekerdezes);
							
						break;
						case 'atadasatvetelik':
							$lekerdezes = "UPDATE atadasatvetelik SET 
								idAtadasAtveteli = '" . $_POST['idAtadasAtveteli'] . "',
								idProjektNr = '" . $_POST['idProjektNr'] . "',
								eutvonal = '" . $_POST['eutvonal'] . "',
								efajlnev = '" . $_POST['efajlnev'] . "',
								tutvonal = '" . $_POST['tutvonal'] . "',
								tfajlnev = '" . $_POST['tfajlnev'] . "',
								tlink = '" . $_POST['tlink'] . "'
							WHERE
								idAtadasAtveteliNr = " . $_POST['idAtadasAtveteliNr'];
							$talalat = $adatbazis->query($lekerdezes);
						
						break;
						case 'dokumentek':
							$lekerdezes = "UPDATE dokumentek SET 
								idDokument = '" . $_POST['idDokument'] . "',
								idProjektNr = '" . $_POST['idProjektNr'] . "',
								eutvonal = '" . $_POST['eutvonal'] . "',
								efajlnev = '" . $_POST['efajlnev'] . "',
								tutvonal = '" . $_POST['tutvonal'] . "',
								tfajlnev = '" . $_POST['tfajlnev'] . "',
								tlink = '" . $_POST['tlink'] . "'
							WHERE
								idDokumentNr = " . $_POST['idDokumentNr'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'megrendelesek':
							$lekerdezes = "UPDATE megrendelesek SET 
								idMegrendeles = '" . $_POST['idMegrendeles'] . "',
								idProjektNr = '" . $_POST['idProjektNr'] . "',
								eutvonal = '" . $_POST['eutvonal'] . "',
								efajlnev = '" . $_POST['efajlnev'] . "',
								tutvonal = '" . $_POST['tutvonal'] . "',
								tfajlnev = '" . $_POST['tfajlnev'] . "',
								tlink = '" . $_POST['tlink'] . "'
							WHERE
								idMegrendelesNr = " . $_POST['idMegrendelesNr'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'szamlak':
							$lekerdezes = "UPDATE szamlak SET 
								idSzamla = '" . $_POST['idSzamla'] . "',
								idProjektNr = '" . $_POST['idProjektNr'] . "',
								eutvonal = '" . $_POST['eutvonal'] . "',
								efajlnev = '" . $_POST['efajlnev'] . "',
								tutvonal = '" . $_POST['tutvonal'] . "',
								tfajlnev = '" . $_POST['tfajlnev'] . "',
								tlink = '" . $_POST['tlink'] . "'
							WHERE
								idSzamlaNr = " . $_POST['idSzamlaNr'];
							$talalat = $adatbazis->query($lekerdezes);
						break;
						case 'tibek':
							$lekerdezes = "UPDATE tibek SET 
								idTib = '" . $_POST['idTib'] . "',
								idProjektNr = '" . $_POST['idProjektNr'] . "',
								eutvonal = '" . $_POST['eutvonal'] . "',
								efajlnev = '" . $_POST['efajlnev'] . "',
								tutvonal = '" . $_POST['tutvonal'] . "',
								tfajlnev = '" . $_POST['tfajlnev'] . "',
								tlink = '" . $_POST['tlink'] . "'
							WHERE
								idTibNr = " . $_POST['idTibNr'];
							$talalat = $adatbazis->query($lekerdezes);
						break;//VÉGE::'tibek'
					}//VÉGE::tábla kiválasztása adat szerkesztéshez
				break;//VÉGE::adat szerkesztés
				case 'stateonoff'://adat aktiválása/inaktiválása
					if (!isset($_GET['do']) || $_GET['do'] != 1) {//ha igaz módosít
						switch ($_GET['type']) {//tábla kiválasztása
							case 'jogok':
								echo 'Biztosan megváltoztatod a JOG állapotát? <br /> ';
							break;
							case 'csoportok':
								echo 'Biztosan megváltoztatod a CSOPORT állapotát? <br /> ';
							break;
							case 'partnerek':
								echo 'Biztosan megváltoztatod a PARTNER állapotát? <br /> ';
							break;
							case 'munkakorok':
								echo 'Biztosan megváltoztatod a MUNKAKÖR állapotát? <br /> ';
							break;
							case 'felhasznalok':
								echo 'Biztosan megváltoztatod a FELHASZNÁLÓ állapotát? <br /> ';
							break;
							case 'eszkozok':
								echo 'Biztosan megváltoztatod a ESZKÖZ állapotát? <br /> ';
							break;
							case 'muszerek':
								echo 'Biztosan megváltoztatod a MŰSZER állapotát? <br /> ';
							break;
							case 'prjtipusok':
								echo 'Biztosan megváltoztatod a PROJEKT TÍPUS állapotát? <br /> ';
							break;
							case 'projektek':
								echo 'Biztosan megváltoztatod a PROJEKT állapotát? <br /> ';
							break;
						}
						echo ' <a href="' . $_SERVER['REQUEST_URI'] . '&do=1"> Igen </a> ';
						echo 'vagy <a href="index.html"> Nem </a> ';
					}
					else {//
						switch ($_GET['type']) {//tábla kiválasztása
							case 'jogok': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									jogok
								WHERE
									idJog = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE jogok SET 
									allapot = '" . $allapot . "'
								WHERE
									idJog = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'csoportok': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									csoportok
								WHERE
									idCsoport = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE csoportok SET 
									allapot = '" . $allapot . "'
								WHERE
									idCsoport = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'partnerek': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									partnerek
								WHERE
									idPartner = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE partnerek SET 
									allapot = '" . $allapot . "'
								WHERE
									idPartner = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'munkakorok': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									munkakorok
								WHERE
									idMunkakor = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE munkakorok SET 
									allapot = '" . $allapot . "'
								WHERE
									idMunkakor = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'felhasznalok': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									felhasznalok
								WHERE
									idFelhasznalo = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE felhasznalok SET 
									allapot = '" . $allapot . "'
								WHERE
									idFelhasznalo = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'eszkozok': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									eszkozok
								WHERE
									idEszkozNr = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE eszkozok SET 
									allapot = '" . $allapot . "'
								WHERE
									idEszkozNr = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'muszerek': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									muszerek
								WHERE
									idMuszerNr = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE muszerek SET 
									allapot = '" . $allapot . "'
								WHERE
									idMuszerNr = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'prjtipusok': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									prjtipusok
								WHERE
									idPrjTipus = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE prjtipusok SET 
									allapot = '" . $allapot . "'
								WHERE
									idPrjTipus = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'projektek': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									projektek
								WHERE
									idProjektNr = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE projektek SET 
									allapot = '" . $allapot . "'
								WHERE
									idProjektNr = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
							case 'agazatok': 
								$lekerdezes = 'SELECT 
									allapot
								FROM
									agazatok
								WHERE
									idAgazat = ' . $_GET['id'];//állapot lekérdezése
								$talalat = $adatbazis->query($lekerdezes);
								$sor = $talalat->fetch_assoc();
								$allapot = !$sor['allapot'];//módosítás
								$lekerdezes = "UPDATE agazatok SET 
									allapot = '" . $allapot . "'
								WHERE
									idAgazat = " . $_GET['id'];//módosítás végrhajtás
								$talalat = $adatbazis->query($lekerdezes);
							break;
						}//VÉGE:  tábla kiválasztása
					}
				break;//VÉGE::adat aktiválása/inaktiválása
				case 'delete'://adat törlése
					switch ($_GET['type']) {//tábla kiválasztása adat törlésre
						case 'bejegyzesek':
							$del= "DELETE FROM 
									bejegyzesek 
								WHERE 
									idBejegyzes = " . $_GET['id'];
							$t = $adatbazis -> query($del);
						break;
						case 'minugyjegyzetek':
							$del= "DELETE FROM 
									minugyjegyzetek 
								WHERE 
									idMinUgyJegyzet = " . $_GET['id'];
							$t = $adatbazis -> query($del);
						break;
						case 'xproj_alkm':
							$del= "DELETE FROM 
									xproj_alkm 
								WHERE 
									idFelhasznaloX = " . $_GET['other'] . " AND idProjektNrX = " . $_GET['id'];
							$t = $adatbazis -> query($del);
						break;
						case 'xcsop_jog':
							$del= "DELETE FROM 
									xcsop_jog 
								WHERE 
									idJogX = " . $_GET['other'] . " AND idCsoportX = " . $_GET['id'];
							$t= $adatbazis -> query($del);
						break;
						case 'xproj_eszk':
							$del= "DELETE FROM 
									xproj_eszk 
								WHERE 
									idEszkozNrX = " . $_GET['other'] . " AND idProjektNrX = " . $_GET['id'];
								//echo $del;
							$t= $adatbazis -> query($del);
						break;
						case 'xproj_musz':
							$del= "DELETE FROM 
									xproj_musz 
								WHERE 
									idMuszerNrX = " . $_GET['other'] . " AND idProjektNrX = " . $_GET['id'];
								//echo $del;
							$t= $adatbazis -> query($del);
						break;//VÉGE::'xproj_musz'
						case 'ajanlatok':
							$del= "DELETE FROM 
									ajanlatok 
								WHERE 
									idAjanlatNr = "  . $_GET['id'];
								//echo $del;
							$t= $adatbazis -> query($del);
						break;//VÉGE::'xproj_musz'
					}//VÉGE::tábla kiválasztása adat törlésre
				break;//VÉGE::törlés
				case 'fajlmod': //fájl módosítása
					switch ($_GET('type')) { //tábla kiválasztása fájlmódosításra
						case 'ajanlatok':
							/*if ($_FILES['felhasznaloi_fajl']['error']>0) {
								echo 'Hiba történt: ';
								switch ($_FILES['felhasznaloi_fajl']['error']) {
									case 1: echo 'A fájlméret meghaladja a maximálisan feltölthető méretet!';
									break;
									case 2: echo 'a fájlméret meghaladja a maximális méretet!';
									break;
									case 3: echo 'A fájl feltöltése csak részlegesen sikerült!';
									break;
									case 4: echo 'Nem lett fájl feltöltve!';
									break;
									case 6: echo 'Nem lehet feltölteni a fájlt: Nincs ideiglenes mappa meghatározva!';
									break;
									case 7: echo 'Nem sikerült a feltöltés: Nem lehetett a lemezre írni!';
									break;
								}
								exit;
							}
							// Megfelelő MIME-típusú a fájl?
							if ($_FILES['felhasznaloi_fajl']['type'] != 'text/plain') {
								echo 'Hiba: a fájl nem egyszerű szöveg!';
								exit;
							}

							// tegyük a fájlt a nekünk tetsző helyre és nevezzük át
							$ideig = explode (".", $_FILES['felhasznaloi_fajl']['name']);
							$ujnev = rand(0, 99999) . '.' . end($ideig);
							
							$feltoltendo_fajl = FELTOLTES . 'ajanlatok\\' . $ujnev;

							if (is_uploaded_file($_FILES['felhasznaloi_fajl']['tmp_name'])) {
								if (!move_uploaded_file($_FILES['felhasznaloi_fajl']['tmp_name'], $feltoltendo_fajl)) {
									echo 'Hiba: Nem sikerült a fájlt a célmappába áthelyezni';
									exit;
								}
							}
							else {
								echo 'Hiba: Fájlfeltöltési támadás lehetősége. Fájlnév: ';
								echo $_FILES['felhasznaloi_fajl']['name'];
								exit;
							}
							echo 'A fájlfeltöltés sikerült! :) <br><br>';

							// távolítsuk el a fájl tartalmából az esetleges HTML és PHP címkéket
							$tartalom = file_get_contents($feltoltendo_fajl);
							$tartalom = strip_tags($tartalom);
							file_put_contents($_FILES['felhasznaloi_fajl']['name'], $tartalom);
							
							$efajlnev = $_FILES['felhasznaloi_fajl']['name'];
							$tutvonal = FELTOLTES . 'ajanlatok\\';
							$tutvonal = addslashes($tutvonal);
							$tfajlnev = $ujnev;
							$tlink = FELTOLTES . 'ajanlatok\\' . $ujnev;
							$tlink = addslashes($tlink);
							
							$lekerdezes = "UPDATE ajanlatok SET 
								efajlnev = '" . $efajlnev . "',
								tutvonal = '" . $tutvonal . "',
								tfajlnev = '" . $tfajlnev . "',
								tlink = '" . $tlink . "'
							WHERE
								idAjanlatNr = " . $_POST['idAjanlatNr'];
							
							$talalat = $adatbazis->query($lekerdezes);
						break;//VÉGE::ajánlatok fájlmódosítása*/
						echo "Itt módosítom a fájlt!";
					}//VÉGE::tábla kiválasztása fájlmódosításra 
				break;//VÉGE::fájl módosítása
			}//VÉGE::hozzáadás vagy módosítás vagy aktiválás/inaktiválás vagy fájlmódosítás eldöntése
		?>
		
		<p> Done! </p>
		<pre>
			<strong> DEBUG: </strong>
			<?php
				//print_r($eredmeny);
				print_r($_POST);
				print_r($_GET);
				//echo lekerdezes;
			?>
		</pre>
		
		<a href="index.html"> Return to Index </a>  </p>
		
	</body>
</html>

