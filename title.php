<?php //title beállítása
				switch ($_GET['type']) { //title beállítása
					case 'projektek':
						echo "Projekt";
						break;
					case 'bejegyzesek':
						echo "Bejegyzés";
						break;	
					case 'minugyjegyzetek':
						echo "Minőségügyi jegyzet";
						break;
					case 'prjtipusok':
						echo "Projekt típus";
						break;
					case 'xproj_alkm':
						echo "Projekt × Alkalmazott";
						break;
					case 'ajanlatok':
						echo "Ajánalt";
						break;
					case 'atadasatvetelik':
						echo "Átadás-Átvételi";
						break;
					case 'dokumentek':
						echo "Dokumentum";
						break;
					case 'megrendelesek':
						echo "Megrendelés";
						break;
					case 'szamlak':
						echo "Számlák";
						break;
					case 'tibek':
						echo "Teljesítés Igazolási Bizonylat";
						break;
					case 'agazatok':
						echo "Ágazat";
						break;
					case 'cegek':
						echo "Cég";
						break;
					case 'partnerek':
						echo "Partner";
						break;
					case 'felhasznalok':
						echo "Felhasználó";
						break;
					case 'munkakorok':
						echo "Munkakör";
						break;
					case 'csoportok':
						echo "Csoport";
						break;
					case 'jogok':
						echo "Jog";
						break;
					case 'xcsop_jog":
						echo "Csoprt × Jog';
						break;
					case 'eszkozok':
						echo "Eszköz";
						break;
					case 'muszerek':
						echo "Műszer";
						break;
					case 'allapotok':
						echo "Állapot";
						break;
					case 'igennem':
						echo "Igen/Nem";
						break;
				}
?>