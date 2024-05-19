$(document).ready(function() {
    function updateList() {
        $.ajax({
            url: 'list_data.php', // URL zur Datei oder API, die die Daten liefert
            method: 'GET',
            success: function(data) {
                var listContainer = $('#list-container');
                listContainer.empty(); // Vorherige Daten löschen

                data.forEach(function(item) {
                    var listItem = $('<div class="list-item"></div>').text(item);
                    listContainer.append(listItem);
                });
            },
            error: function() {
                $('#list-container').html('<div class="list-item">Fehler beim Laden der Daten.</div>');
            }
        });
    }

    // Initiale Daten laden
    updateList();

    // Liste alle 10 Sekunden aktualisieren
    setInterval(updateList, 10000);
});