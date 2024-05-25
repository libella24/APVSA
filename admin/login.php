<?php

include "setup.php";

use WIFI\apvsa\Jobify\Validieren;
use WIFI\apvsa\Jobify\Mysql;

/*echo "<br>";
echo "Das hier sind die vom User eingegebenen Logindaten."; 
print_r($_POST); 
print_r($_SESSION); 
echo "<br>";*/

// (1) Prüfen, ob das Formular abgeschickt wurde
//     wenn Daten eingegeben wurden = $_POST ist nicht leer, dann...
if(!empty($_POST)){
    $validieren = new Validieren();
    $validieren->ist_ausgefuellt($_POST["benutzer"], "benutzer");
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");
    // ist_ausgefüllt: überprüft die Eingabe im POST-Feld, z.B. "benutzer" (=$wert), ob es ausgefüllt ist (if (empty ($wert)). Wenn nicht, wird ein Fehler im errors Array aufgenommen. Der 2. Parameter (=$feldname wird in die Fehlermeldung geschrieben.
    if (!$validieren->fehler_aufgetreten()) {
        // wenn KEINE Fehler aufgetreten sind, dann: weiter machen mit einloggen.
        $db = Mysql::getInstanz();
        $sql_benutzer = $db->escape($_POST["benutzer"]);
        $ergebnis = $db->query("SELECT * FROM firmen WHERE benutzer = '{$sql_benutzer}'");
        $firma = $ergebnis->fetch_assoc();
        echo "<pre>"; print_r($firma); echo "</pre>"; 

        if (empty($firma) || !password_verify($_POST["passwort"], $firma["passwort"])) {
            // Fehler: Eingegebener Benutzer existiert nicht
            $validieren->fehler_hinzu("Benutzer oder Passwort war falsch.");
            echo "Ungültiger Benutzername oder Passwort."; 
        } else {
            // Alles ok -> Login in Session merken
            // der gesamte Firmen-Datensatz ist in der Session verfügbar
            // Alle Felder, die ich in der gesamten Anwendung mit der $_SESSION aufrufe, muss ich hier definieren
            $_SESSION["eingeloggt"] = true;
            $_SESSION["benutzername"] = $firma["benutzer"];
            $_SESSION["firmen_id"] = $firma["id"];
            $_SESSION["firmen_bezeichnung"] = $firma["bezeichnung"];
            $_SESSION["admin"] = $firma["admin"];
            
            header("Location: firma_bearbeiten.php?id={$_SESSION["firmen_id"]}");
            exit;
        }
    }
}


?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobify</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/APVSA/css/base.css">
</head>
<body>
    <header>
        <div class="wrapper">
            <header id="main-header">
                <div class="top-header h-spacing inner-wrapper">
                    <div id="logo">
                        <a href="/APVSA/index.html"
                            ><img src="img/logo.png" alt="Logo"
                        /></a>
                    </div>
                    <div class="burger">
                        <img src="img/burger.svg" alt="Burger Menu Icon" />
                    </div>
                    <nav id="main-nav">
                        
                        <div class="menu-items">
                            <ul>
                                <li><a href="/APVSA/job-liste.html">Jobs</a></li>
                                <li><a href="/APVSA/admin/login.php">Anzeige aufgeben</a></li>
                        
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="slider">
                    <div class="search">
                            <h1>Login / Registrierung</h1>
                            <h3>Stellenanzeigen aufgeben<h3>                   
                        </div>

                </div>
<body>

       
    <?php
    // Wenn im $error Array ein Fehler registriert wurde - $error is not empty - , dann soll der Fehlertext ($error = "Blabla") oberhalb des Formulars angezeigt werden.
    if(!empty($error)){
        echo "<p>".$error."</p>";
    }
    ?>
    <div class="section-header inner-wrapper">
        <h1>Finde Deine Mitarbeiter:innen <br> einfach und schnell</h1>
    </div>
    <div class="section" >
        <div class="content inner-wrapper">
            <p>Bei der bekanntesten Job-Plattform Südost-Lamprechtshausens - Mit nur wenigen Klicks bist Du dabei...</p>
            <div class="sign-up">
            <h3>Neu hier?</h3>
            <p>Dann registriere Dich bitte hier:  </p>
            <button>
                <a href="/APVSA/admin/firma_neu.php" color="white" >Registrieren</a>
            </button>
        </div>
    </div>
    
    <div class="recruiting-image inner-wrapper">
            <img src="/APVSA/img/recruiting.jpg" alt="Recruiting">
        
    </div>
</div>
    <div class="login inner-wrapper">
        <h3>Du bist bereits registriert?</h3>
        <p>Dann logge dich hier bitte ein:</p>  
    </div>
    <div class="login-form inner-wrapper">      
        <form action="login.php" method="post">
            <div class="form-container">
                <label for="benutzer">Benutzername:</label>
                <input type="text" placeholer="Benutzername" name="benutzer" id= "benutzer">
                <label for="passwort">Passwort:</label>
                <input type="password" name="passwort" id="passwort">
                <button type="submit">Login</button>
            </div>
        </form>
    </div> 
</div>
</body>
<?php
include "fuss.php";
?>
</html>