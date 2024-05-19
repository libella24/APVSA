$(document).ready(function() {
    function updateTicker() {
        $.ajax({
            url: 'job_liste_all_ticker.php', // URL zur Datei oder API, die die Daten liefert
            method: 'GET',
            success: function(data) {
                $('#ticker').text(data);
            },
            error: function() {
                $('#ticker').text('Fehler beim Laden der Daten.');
            }
        });
    }

    // Initiale Daten laden
    updateTicker();

    // Ticker alle 5 Sekunden aktualisieren
    setInterval(updateTicker, 5000);
});