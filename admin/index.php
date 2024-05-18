<?php

include "kopf.php";
//include "setup.php";
//ist_eingeloggt();

//Entfernt das Session-Cookie
//unset($_SESSION["eingeloggt"]);
?>
                <div class="slider">
                    <div class="container">
                        <h1>Finde Deinen Traumjob</h1>
                        <p class="subtitle">
                            Bewirb Dich schon heute und starte eine bessere Zukunft
                        </p>
                        <button>Suche</button><!-- hier kommen mehrere Suchfelder -->
                    </div>
                </div>
            </header>
            <main>
                <section class="teaser inner-wrapper">
                    <article>
                        <h2>
                            Aktuelle Jobangebote
                        </h2>
                        <img
                            src="img/user-experience@2x.png"
                            alt="User Experience"
                        />
                        <p>
                            Folgende Stellen sind ausgeschrieben. Schau mal, ob Du was Passendes findest...
                        </p>
                        <a href="job_liste.php">Zu den offenen Stellen</a>
                    </article>

                    <article>
                        <h2>
                            In welcher Kategorie suchst Du einen Job?
                        </h2>
                        <img
                            src="img/interface-laptop@2x.png"
                            alt="Interface Laptop"
                        />
                        <p>
                            In vielen Branchen sind derzeit stellen offen. Hier findest Du die gefragten Kategorien...
                        </p>
                        <a href="#">Jobs nach Kategorie</a>
                    </article>
                </section>
                </section>
                <section class="questions inner-wrapper">
                    <h2>Möchtest Du regelmäßig über Jobangebote informiert werden?</h2>
                    <p>
                        Melde Dich bei unserem Jobticker an, um keine neuen Stellen mehr zu verpassen.
                    </p>
                    <div class="align-center">
                        <button>für den Jobticker anmelden</button>
                    </div>
                </section>
            </main>

<?php
include "fuss.php";

?>
