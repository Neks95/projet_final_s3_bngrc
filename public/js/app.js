/**
 * Application BNGRC - Gestion des Dons
 * Fichier JavaScript principal
 */

// ==========================================
// Utilitaires généraux
// ==========================================

/**
 * Formater un nombre avec séparateur de milliers
 */
function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}

/**
 * Formater un montant en Ariary
 */
function formatCurrency(amount) {
    return formatNumber(amount) + ' Ar';
}

/**
 * Calculer un pourcentage
 */
function calculatePercentage(part, total) {
    if (total === 0) return 0;
    return Math.round((part / total) * 100);
}

/**
 * Afficher un message de confirmation
 */
function showConfirmation(message) {
    return confirm(message);
}

/**
 * Afficher un message de succès
 */
function showSuccess(message) {
    alert('✓ ' + message);
}

/**
 * Afficher un message d'erreur
 */
function showError(message) {
    alert('✗ ' + message);
}

// ==========================================
// Gestion des formulaires
// ==========================================

/**
 * Valider un formulaire
 */
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;

    const inputs = form.querySelectorAll('[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        }
    });

    return isValid;
}

/**
 * Calculer le montant total (quantité × prix unitaire)
 */
function calculateTotal() {
    const quantityInput = document.getElementById('quantite');
    const priceInput = document.getElementById('prix_unitaire');
    const totalInput = document.getElementById('montant_total');

    if (quantityInput && priceInput && totalInput) {
        const quantity = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        const total = quantity * price;
        totalInput.value = total.toFixed(2);
    }
}

/**
 * Gérer la soumission d'un formulaire d'ajout
 */
function handleAddForm(event, entityName) {
    event.preventDefault();
    
    if (validateForm(event.target.id)) {
        if (showConfirmation(`Voulez-vous vraiment ajouter ce(cette) ${entityName} ?`)) {
            showSuccess(`${entityName} ajouté(e) avec succès !`);
            setTimeout(() => {
                window.history.back();
            }, 1000);
        }
    } else {
        showError('Veuillez remplir tous les champs obligatoires.');
    }
}

/**
 * Gérer la soumission d'un formulaire de modification
 */
function handleEditForm(event, entityName) {
    event.preventDefault();
    
    if (validateForm(event.target.id)) {
        if (showConfirmation(`Voulez-vous vraiment modifier ce(cette) ${entityName} ?`)) {
            showSuccess(`${entityName} modifié(e) avec succès !`);
            setTimeout(() => {
                window.history.back();
            }, 1000);
        }
    } else {
        showError('Veuillez remplir tous les champs obligatoires.');
    }
}

/**
 * Gérer la suppression d'un élément
 */
function handleDelete(entityName, id) {
    if (showConfirmation(`Êtes-vous sûr de vouloir supprimer ce(cette) ${entityName} ?`)) {
        showSuccess(`${entityName} supprimé(e) avec succès !`);
        // Dans une vraie application, on supprimerait l'élément du DOM
        setTimeout(() => {
            location.reload();
        }, 1000);
    }
}

// ==========================================
// Filtrage et recherche
// ==========================================

/**
 * Filtrer un tableau par recherche textuelle
 */
function filterTable(searchInputId, tableId) {
    const searchInput = document.getElementById(searchInputId);
    const table = document.getElementById(tableId);
    
    if (!searchInput || !table) return;

    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const text = row.textContent.toLowerCase();
            
            if (text.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}

/**
 * Filtrer un tableau par sélection
 */
function filterTableBySelect(selectId, tableId, columnIndex) {
    const select = document.getElementById(selectId);
    const table = document.getElementById(tableId);
    
    if (!select || !table) return;

    select.addEventListener('change', function() {
        const filter = this.value.toLowerCase();
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const cell = row.getElementsByTagName('td')[columnIndex];
            
            if (!cell) continue;
            
            const text = cell.textContent.toLowerCase();
            
            if (filter === '' || text.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}

// ==========================================
// Tri des tableaux
// ==========================================

/**
 * Rendre un tableau triable
 */
function makeSortable(tableId) {
    const table = document.getElementById(tableId);
    if (!table) return;

    const headers = table.querySelectorAll('thead th.sortable');
    
    headers.forEach((header, index) => {
        header.addEventListener('click', function() {
            sortTable(table, index, this);
        });
    });
}

/**
 * Trier un tableau par colonne
 */
function sortTable(table, columnIndex, header) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    // Déterminer la direction du tri
    const isAscending = !header.classList.contains('asc');
    
    // Retirer les classes de tri de tous les headers
    table.querySelectorAll('thead th').forEach(th => {
        th.classList.remove('asc', 'desc');
    });
    
    // Ajouter la classe appropriée
    header.classList.add(isAscending ? 'asc' : 'desc');
    
    // Trier les lignes
    rows.sort((a, b) => {
        const aValue = a.cells[columnIndex].textContent.trim();
        const bValue = b.cells[columnIndex].textContent.trim();
        
        // Essayer de comparer comme nombres
        const aNum = parseFloat(aValue.replace(/[^\d.-]/g, ''));
        const bNum = parseFloat(bValue.replace(/[^\d.-]/g, ''));
        
        if (!isNaN(aNum) && !isNaN(bNum)) {
            return isAscending ? aNum - bNum : bNum - aNum;
        }
        
        // Sinon comparer comme texte
        return isAscending 
            ? aValue.localeCompare(bValue)
            : bValue.localeCompare(aValue);
    });
    
    // Réinsérer les lignes triées
    rows.forEach(row => tbody.appendChild(row));
}

// ==========================================
// Pagination
// ==========================================

/**
 * Initialiser la pagination d'un tableau
 */
function initPagination(tableId, rowsPerPage = 10) {
    const table = document.getElementById(tableId);
    if (!table) return;

    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    
    let currentPage = 1;

    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        
        rows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        updatePaginationButtons(page);
    }

    function updatePaginationButtons(page) {
        const paginationContainer = table.closest('.table-container').querySelector('.pagination');
        if (!paginationContainer) return;

        let html = '';
        
        // Bouton précédent
        html += `<li class="page-item ${page === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${page - 1}">Précédent</a>
        </li>`;
        
        // Numéros de page
        for (let i = 1; i <= totalPages; i++) {
            html += `<li class="page-item ${i === page ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>`;
        }
        
        // Bouton suivant
        html += `<li class="page-item ${page === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${page + 1}">Suivant</a>
        </li>`;
        
        paginationContainer.innerHTML = html;
        
        // Ajouter les event listeners
        paginationContainer.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const newPage = parseInt(this.dataset.page);
                if (newPage >= 1 && newPage <= totalPages) {
                    currentPage = newPage;
                    showPage(currentPage);
                }
            });
        });
    }

    showPage(currentPage);
}

// ==========================================
// Graphiques avec Chart.js
// ==========================================

/**
 * Créer un graphique en barres
 */
function createBarChart(canvasId, labels, datasets, title) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: title,
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return formatNumber(value);
                        }
                    }
                }
            }
        }
    });
}

/**
 * Créer un graphique en secteurs (pie)
 */
function createPieChart(canvasId, labels, data, title) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    '#0056b3',
                    '#28a745',
                    '#fd7e14',
                    '#dc3545',
                    '#17a2b8',
                    '#6c757d'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: title,
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                },
                legend: {
                    display: true,
                    position: 'right'
                }
            }
        }
    });
}

// ==========================================
// Initialisation au chargement de la page
// ==========================================

document.addEventListener('DOMContentLoaded', function() {
    // Ajouter la classe active au lien de navigation correspondant
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });

    // Initialiser les tooltips Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Ajouter des event listeners pour le calcul automatique du montant total
    const quantityInput = document.getElementById('quantite');
    const priceInput = document.getElementById('prix_unitaire');
    
    if (quantityInput && priceInput) {
        quantityInput.addEventListener('input', calculateTotal);
        priceInput.addEventListener('input', calculateTotal);
    }

    // Afficher la date et l'heure actuelles
    updateDateTime();
    setInterval(updateDateTime, 60000); // Mettre à jour chaque minute
});

/**
 * Mettre à jour la date et l'heure
 */
function updateDateTime() {
    const dateTimeElement = document.getElementById('current-datetime');
    if (dateTimeElement) {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        dateTimeElement.textContent = now.toLocaleDateString('fr-FR', options);
    }
}

/**
 * Initialiser les filtres d'une page
 */
function initFilters(searchInputId, tableId) {
    if (searchInputId && tableId) {
        filterTable(searchInputId, tableId);
    }
}

/**
 * Mettre à jour les statistiques du dashboard
 */
function updateDashboardStats() {
    // Cette fonction sera appelée par le dashboard
    // Les calculs sont basés sur les données statiques HTML
}
