<?php
//include "setup.php";


//include "header.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job-Kategorien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #jobs {
            margin-top: 20px;
        }
        .job {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Jobs nach Kategorie</h1>
    <label for="category_id">Kategorie auswählen:</label>
    <select name="category_id" id="category_id">
    <option>--Bitte wählen--</option>
               
    </select>
    <button onclick="fetchJobs()">Jobs anzeigen</button>

    <div id="jobs"></div>

    <script>
        function fetchJobs() {
            const category = document.getElementById('category').value;
            const jobsContainer = document.getElementById('jobs');
            jobsContainer.innerHTML = ''; // Vorherige Ergebnisse leeren

            fetch(`http://localhost/apvsa/admin/api.php/api/categories/${category}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        data.result.forEach(job => {
                            const jobElement = document.createElement('div');
                            jobElement.className = 'job';
                            jobElement.innerHTML = `
                                <h2>${job.titel}</h2>
                                <p>${job.beschreibung}</p>
                                <p><strong>Unternehmen:</strong> ${job.firmen_bez}</p>
                                <p><strong>Ort:</strong> ${job.ort}</p>
                                <p><strong>Gehalt:</strong> ${job.gehalt}</p>
                            `;
                            jobsContainer.appendChild(jobElement);
                        });
                    } else {
                        jobsContainer.innerHTML = '<p>Keine Jobs gefunden.</p>';
                    }
                })
                .catch(error => {
                    jobsContainer.innerHTML = '<p>Fehler beim Abrufen der Jobs.</p>';
                    console.error('Error fetching jobs:', error);
                });
        }
    </script>
</body>
</html>
