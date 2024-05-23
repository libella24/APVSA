document.addEventListener("DOMContentLoaded", function () {
    // Funktion zum Laden der Kategorien
    // ==================================
    function loadCategories() {
        fetch('http://localhost/apvsa/admin/api.php/api/categories/list')
            .then(response => response.json())
            .then(data => {
                if (data.status === 1) {
                    const categorySelect = document.getElementById("category-select");
                    data.result.forEach(category => {
                        const option = document.createElement("option");
                        option.value = category.id;
                        option.textContent = category.name;
                        categorySelect.appendChild(option);
                    });
                } else {
                    alert("Fehler beim Laden der Kategorien.");
                }
            })
            .catch(error => console.error("Fehler:", error));
    }

    // Funktion zum Laden der Jobs pro Kategorie
     // ==================================
    function loadJobs(categoryId) {
        fetch(`http://localhost/apvsa/admin/api.php/api/categories/${categoryId}/jobs`)
            .then(response => response.json())
            .then(data => {
                const jobList = document.getElementById("job-list");
                jobList.innerHTML = ""; // initial leer

                if (data.status === 1) {
                    data.result.forEach(job => {
                        const listItem = document.createElement('li');
                        listItem.innerHTML = `
                        <h3>${job.titel} </h3>
                        <p/>${job.beschreibung}</p>`;
                        const link = document.createElement('a');
                        link.href = `http://localhost/apvsa/admin/api.php/api/jobs/${job.id}`;
                        link.textContent = `Details...`;
                        listItem.appendChild(link);
                        jobList.appendChild(listItem);
                    });
                }
            })
            .catch(error => console.error("Fehler beim Laden der Jobs:", error));
    }
    // Kategorien laden, wenn die Seite geladen wird

    loadCategories();
    // Event-Listener für die Kategorieauswahl
    document.getElementById("category-select").addEventListener('change', function () {
        const categoryId = this.value;
        if (categoryId) {
            loadJobs(categoryId);
        }
    });
});
    
