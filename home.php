<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <script src="vendor/jquery-3.7.1.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Funktion zum Laden der Kategorien in das Dropdown-Menü
            function loadCategories() {
                fetch('http://localhost/apvsa/admin/api.php/api/categories/list')
                    .then(response => response.json())
                    .then(data => {
                        const categorySelect = document.getElementById('categorySelect');
                        data.result.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.name;
                            categorySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Fehler beim Laden der Kategorien:', error));
            }

            // Funktion zum Laden der Jobs einer ausgewählten Kategorie
            function loadJobs(categoryId) {
                fetch(`http://localhost/apvsa/admin/api.php/api/categories/${categoryId}/jobs`)
                    .then(response => response.json())
                    .then(data => {
                        const jobList = document.getElementById('jobList');
                        jobList.innerHTML = ''; // Vorherige Jobs entfernen
                        data.result.forEach(job => {
                            const listItem = document.createElement('li');
                            listItem.textContent = `${job.title} - ${job.description}`;
                            jobList.appendChild(listItem);
                        });
                    })
                    .catch(error => console.error('Fehler beim Laden der Jobs:', error));
            }


            // Kategorien laden, wenn die Seite geladen wird
            loadCategories();

            // Event-Listener für das Dropdown-Menü
            document.getElementById('categorySelect').addEventListener('change', function () {
                const selectedCategory = this.value;
                if (selectedCategory) {
                    loadJobs(selectedCategory);
                }
            });
        });
    </script>
</head>
<body>
    <h1>Job Listings</h1>
    <label for="categorySelect">Kategorie auswählen:</label>
    <select id="categorySelect">
        <option value="">--Kategorie auswählen--</option>
        <!-- Kategorien werden hier geladen -->
    </select>

    <h2>Jobs:</h2>
    <ul id="jobList">
        <!-- Jobs werden hier angezeigt -->
    </ul>
</body>
</html>