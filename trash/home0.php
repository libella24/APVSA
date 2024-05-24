<?php


use WIFI\apvsa\Jobify\Class\Jobs;

include "header.php";
?>

                <div class="slider">
                    <div class="container">
                        <h1>Finde Deinen Traumjob</h1>
                        <p class="subtitle">
                            Worauf hast Du Lust?
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
                            <label for="category-select">Kategorie wählen:</label>
                            <select id="category-select">
                                <!-- Optionen werden dynamisch geladen -->
                            </select>
                            <button id="load-jobs">Jobs laden</button>
                            <div id="jobs-list">
                                <!-- Job-Liste wird hier eingefügt -->
                            </div>
                            <script src="admin/js/script.js"></script>
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
include "admin/fuss.php";

?>

