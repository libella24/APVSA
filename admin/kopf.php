
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobbörse</title>
    <link rel="stylesheet" href="/APVSA/css/base.css">
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
                        <a href="index.html"
                            ><img src="/APVSA/admin/img/logo.png" alt="Logo"
                        /></a>
                    </div>
                    <div class="label">
                        <h2>
                            ADMIN-Bereich
                        </h2>
                    </div>
                    <nav id="main-nav">
                        <div class="menu-items">
                            <ul>
                                <li>Eingeloggt als:<br> <?php echo $_SESSION["benutzername"]; ?> 
                                    <div id="icon">
                                        <img src="/APVSA/img/logout.svg" alt="logout">
                                        <a href="logout.php">Ausloggen</a>
                                     </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="burger">
                        <img src="img/burger.svg" alt="Burger Menu Icon" />
                    </div>
                    
                </div>
                <div class="slider">
                    <div class="search">
                        <h1>Stellenanzeigen verwalten</h1>
                        <h3>Firmendaten bearbeiten</h3>
                                            
                    </div>
                </div>
            </header>
    </header>
    