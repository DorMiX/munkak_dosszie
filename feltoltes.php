<html>
<head>
<title>Feltöltés...</title>
</head>
<body>
<h1>A fájl feltöltése...</h1>
<?php

  if ($_FILES['felhasznaloi_fajl']['error']>0)
  {
    echo 'Hiba történt: ';
    switch ($_FILES['felhasznaloi_fajl']['error'])
    {
      case 1: echo 'A fájlméret meghaladja a maximálisan feltölthetõ méretet';
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
  // Megfelelõ MIME-típusú a fájl?
  if ($_FILES['felhasznaloi_fajl']['type'] != 'text/plain')
  {
    echo 'Hiba: a fájl nem egyszerû szöveg';
    exit;
  }

  // tegyük a fájlt a nekünk tetszõ helyre
  $feltoltendo_fajl = 'feltoltesek/'.$_FILES['felhasznaloi_fajl']['name'] ;

  if (is_uploaded_file($_FILES['felhasznaloi_fajl']['tmp_name']))
  {
     if (!move_uploaded_file($_FILES['felhasznaloi_fajl']['tmp_name'], $feltoltendo_fajl))
     {
        echo 'Hiba: Nem sikerült a fájlt a célmappába áthelyezni';
        exit;
     }
  }
  else
  {
    echo 'Hiba: Fájlfeltöltési támadás lehetõsége. Fájlnév: ';
    echo $_FILES['felhasznaloi_fajl']['name'];
    exit;
  }

  echo 'A fájlfeltöltés sikerült<br><br>';

  // távolítsuk el a fájl tartalmából az esetleges HTML és PHP címkéket
  $tartalom = file_get_contents($feltoltendo_fajl);
  $tartalom = strip_tags($tartalom);
  file_put_contents($_FILES['felhasznaloi_fajl']['name'], $tartalom);

  // mutassuk meg a feltöltött fájlt
  echo '<p>A feltöltött fájl tartalmának elõnézete:<br/><hr/>';
  echo nl2br($tartalom);
  echo '<br/><hr/>';
?>
</body>
</html>
