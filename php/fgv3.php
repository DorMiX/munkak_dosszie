<?php
	//----------------------------------------------//
	//deklarációk									//
	//----------------------------------------------//
	require("php/konfig.php");
	
	//----------------------------------------------//
	//függvények									//
	//----------------------------------------------//
	
	function tabla_mezok2($tablanev) { //visszatér egy tömbbel, ami a paraméterben megadott tábla mezőneveit tárolja
		require("php/konfig.php");
		$eredmeny = array();
		$eredmeny[0] = $tablanev;
		$lekerdezes = 'SHOW COLUMNS FROM ' . $tablanev ;
		$talalat = $adatbazis -> query($lekerdezes);
		$i = 1;
		foreach ($talalat as $sor => $ertek) {
			$eredmeny[$i] = $ertek['Field'];
			$i++;
		}
		return $eredmeny;
	}
	
	
	function mezonev_kiiras2($rekord) { //a táblázat mezőneveihez társítja az xml-ben megadott nevet és kiírja a képernyőre azt 
		$xmldom_doc = new DOMDocument();
		$xmldom_doc -> load('xml/munkak_dosszie_of.xml');
		$rek = $xmldom_doc -> getElementsByTagName($rekord);
		foreach ($rek as $rk) {
			echo $rk -> nodeValue, PHP_EOL;
		}
	}
	
	function tabla_index_rekordnev($tablanev) { //visszatér a táblázat PRIMARY_KEY index rekord nevével
		
		require("php/konfig.php");
		
		$lekerdezes = 'SHOW COLUMNS FROM ' . $tablanev ;
		$talalat = $adatbazis -> query($lekerdezes);
		//$sor = $talalat->fetch_assoc();
		$i = 1;
		foreach ($talalat as $sor => $ertek) {
			$eredmeny[$i] = $ertek['Field'];
			//echo $eredmeny[$i]; 
			$i++;
		}
		return $eredmeny[1];
	}

	function mysql_get_prim_key($table) { //visszatér a táblázat PRIMARY_KEY index oszlopnevével
		
		require("php/konfig.php");
		
		$sql = "SHOW INDEX FROM $table WHERE Key_name = 'PRIMARY'";
		$gp = $adatbazis -> query($sql);
		$cgp = $gp -> num_rows;
		if($cgp > 0) {
			// Note I'm not using a while loop because I never use more than one prim key column
			$agp = $gp -> fetch_array(MYSQLI_ASSOC);
			
			return $agp['Column_name'];
		} else {
			return(false);
		}
	}
	
	function egy_mezo_ertek_index($tablanev, $idx, $mezonev) { //a táblázatból visszatér 1 konkrét mező értékével
		
		require("php/konfig.php");
		
		$idx_name = tabla_index_rekordnev($tablanev);
		
		$lekerdezes = "SELECT * FROM $tablanev WHERE  $idx_name = $idx";
		$talalat = $adatbazis -> query($lekerdezes);
		$talalatok_szama = $talalat -> num_rows;
		$sor = $talalat->fetch_assoc();
		return $sor[$mezonev];
	}
	
	function tablazat_listazas2($tablanev) {
		
		require("php/konfig.php");
		
		$tomb = tabla_mezok2($tablanev);
		echo '<tr>';
		for($i = 1; $i <= (count($tomb) - 1); $i++) {
			echo "<th>";
			mezonev_kiiras2($tomb[$i]);
			echo "</th>";
		}
		echo '</tr>';
		
		switch ($tablanev) {
			case 'projektek':
				$lekerdezes2 = '
					SELECT 
						idProjektNr, idProjekt, nvProjekt, prjtipus, projektek.allapot, projektek.letrehozas, letrehozo, leiras, ceg, kezdete, vege, ajanlatkell, megrendelve, dokukesz, advekesz, tibkesz, szamlazva, utoelet, projektek.last_update, ellenorzojel, idPrjTipus, nvPrjTipus, idAllapot, nvAllapot, idFelhasznalo, nvFelhasznalo, idCeg, nvCeg
					FROM 
						projektek, prjtipusok, allapotok, felhasznalok, cegek
					WHERE 
						prjtipus = idPrjTipus AND 
						projektek.allapot = idAllapot AND
						letrehozo = idFelhasznalo AND
						ceg = idCeg
					ORDER BY idProjektNr';
			break;
			case 'bejegyzesek':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'minugyjegyzetek':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'prjtipusok':
				$lekerdezes2 = '
					SELECT
						idPrjTipus, nvPrjTipus, allapot, prjtipusok.last_update, idAllapot, nvAllapot
					FROM 
						prjtipusok, allapotok
					WHERE 
						allapot = idAllapot
					ORDER BY idPrjTipus';
			break;
			case 'xproj_alkm':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'ajanlatok':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'atadasatvetelik':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'dokumentek':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'megrendelesek':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'szamlak':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'tibek':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'agazatok':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'cegek':
				$lekerdezes2 = '
					SELECT
						idCeg, nvCeg, cegteljesnev, irsz, telepules, cim, agazat, cegek.last_update, idAgazat, nvAgazat
					FROM 
						cegek, agazatok
					WHERE 
						agazat = idAgazat
					ORDER BY idCeg';
			break;
			case 'partnerek':
				$lekerdezes2 = "
					SELECT 
						idPartner, ceg, teljesnev, beosztas, reszleg, email, mobil, partnerek.allapot, partnerek.letrehozas, partnerek.last_update, idAllapot, nvAllapot 
					FROM 
						partnerek, allapotok 
					WHERE 
						allapot = idAllapot 
					ORDER BY 
						idPartner";
			break;
			case 'felhasznalok':
				$lekerdezes2 = '
					SELECT
						idFelhasznalo, nvFelhasznalo, nvEmail, csoport, jelszo, teljesnev, munkakor, mobil, felhasznalok.allapot, felhasznalok.letrehozas, felhasznalok.last_update, idAllapot, nvAllapot
					FROM 
						felhasznalok, allapotok
					WHERE
						allapot = idAllapot
					ORDER BY idFelhasznalo';
			break;
			case 'munkakorok':
				$lekerdezes2 = '
					SELECT
						idMunkakor, nvMunkakor, allapot, munkakorok.last_update, idAllapot, nvAllapot
					FROM
						munkakorok, allapotok
					WHERE
						allapot = idAllapot
					ORDER BY idMunkakor';
			break;
			case 'csoportok':
				$lekerdezes2 = '
					SELECT
						idCsoport, nvCsoport, csoportok.allapot, csoportok.last_update, idAllapot, nvAllapot
					FROM
						csoportok, allapotok
					WHERE
						csoportok.allapot = idAllapot
					ORDER BY idCsoport';
			break;
			case 'jogok':
				$lekerdezes2 = '
					SELECT
						idJog, nvJog, jogok.allapot, jogok.last_update, idAllapot, nvAllapot
					FROM
						jogok, allapotok
					WHERE
						jogok.allapot = idAllapot
					ORDER BY idJog';
			break;
			case 'xcsop_jog':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'eszkozok':
				$lekerdezes2 = '
					SELECT
						idEszkozNr, idEszkoz, nvEszkoz, gyarto, tipus, gysz, eszkozok.allapot, eszkozok.last_update, idAllapot, nvAllapot
					FROM
						eszkozok, allapotok
					WHERE
						eszkozok.allapot = idAllapot
					ORDER BY idEszkozNr';
			break;
			case 'muszerek':
				$lekerdezes2 = '
					SELECT
						idMuszerNr, idMuszer, nvMuszer, gyarto, tipus, gysz, kalbiz, kaldatum, kalerv, muszerek.allapot, muszerek.last_update, idAllapot, nvAllapot
					FROM
						muszerek, allapotok
					WHERE
						muszerek.allapot = idAllapot
					ORDER BY idMuszerNr';
			break;
			case 'allapotok':
				$lekerdezes2 = '
					SELECT
						*
					FROM ' . $tablanev;
			break;
			case 'igennem':
				$lekerdezes2 = 'SELECT * FROM ' . $tablanev;
			break;
			default:
				$lekerdezes2 = 'SELECT * FROM ' . $tablanev;
		}
		
		$talalat = $adatbazis -> query($lekerdezes2);
		$talalatok_szama = $talalat -> num_rows;
				
		$i=0;
		$odd = true;
		
		while ($i != $talalatok_szama) {
			echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
			$odd = !$odd;
			
			$sor = $talalat->fetch_assoc();
			for( $j = 1; $j <= (count($tomb) - 1); $j++) {
				echo '<td>';	
				switch ($tomb[$j]) {
					case 'prjtipus':
						echo $sor['nvPrjTipus'];
						break;
					case 'allapot':
						echo $sor['nvAllapot'];
						break;
					case 'letrehozo':
						echo $sor['nvFelhasznalo'];
						break;
					case 'ceg':
						echo $sor['nvCeg'];
						break;
					case 'agazat':
						echo $sor['nvAgazat'];
						break;
					case 'ajanlatkell':
						($sor['ajanlatkell'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 0, 'nvIN');
						echo $er;
						break;
					case 'megrendelve':
						($sor['megrendelve'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 0, 'nvIN');
						echo $er;
						break;
					case 'dokukesz':
						($sor['dokukesz'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 0, 'nvIN');
						echo $er;
						break;
					case 'advekesz':
						($sor['advekesz'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 0, 'nvIN');
						echo $er;
						break;
					case 'tibkesz':
						($sor['tibkesz'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 0, 'nvIN');
						echo $er;
						break;
					case 'szamlazva':
						($sor['szamlazva'] == 1) ? $er = egy_mezo_ertek_index('igennem', 1, 'nvIN') : $er = egy_mezo_ertek_index('igennem', 0, 'nvIN');
						echo $er;
						break;
					default: 
						echo $sor[$tomb[$j]];	
				}
				echo '</td>';
			}
			echo $tablanev . "<br>";
			$aaa = ($tablanev != "allapotok");
			echo "a= " . $aaa . "<br>";
			$bbb = ($tablanev != "igennem");
			echo "b= " . $bbb . "<br>";
			$ccc = $aaa || $bbb;
			echo "c= " . $ccc . "<br>";
		
		if (($tablanev != "allapotok") and ($tablanev != "igennem")) {
				echo '<td>';
				echo '<a class="button-link" href="visualization.php?action=edit&type=' . $tablanev . '&id=' . $sor[$tomb[1]] . '"> MÓDOSÍTÁS </a>';
				echo '<td>';
			
				if (in_array('allapot', $tomb)) {
					echo '<td>';
					echo '<a class="button-link" href="commit.php?action=stateonoff&type=' .$tablanev . '&id=' . $sor[$tomb[1]] . '">';
					
					if ($sor['allapot'] == 0)
						echo 'AKTIVÁLÁS';
					else						
						echo 'INAKTIVÁLÁS';
					echo '</a>';
					echo '</td>';
				}
				else {
					echo '<td>';
					echo '<a class="button-link" href="commit.php?action=delete&type=' . $tablanev . '&id=' . $sor[$tomb[1]] . '"> TÖRLÉS </a>';
					echo '<td>';
					}
			}
			
			echo '</tr>';
			$i++;
		}
	}
	
	

?>