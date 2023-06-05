//cacher les messages des erreurs
function confirm_msg() {
    var console_msg = document.querySelector(".console-msg");
    console_msg.innerHTML = "";
}
window.setTimeout(confirm_msg, 4000);

//suppression utilisateur avec id
function delete_id(id) {
    //chercher toutes les boutons ayant la classe btn-delete
    let btns_delete = document.querySelectorAll(".btn-delete");
    //parcourir les boutons
    btns_delete.forEach((elem) => {
        //ajouter l'evenement click pour l'element sélectionné
        elem.addEventListener("click", function () {
            //rediriger vers la page de suppression
            document.location.href = 'page-delete?id=' + id;
        });
    });
}

//fonction pour trier les colonnes
function sortTable(columnIndex) {
    let click_element = event.target;
    // Obtenir tous les éléments avec la classe btn-order
    const buttons_elements = document.querySelectorAll('.btn-order');
    // Supprimer la classe de chaque élément active
    buttons_elements.forEach((element) => {
        element.classList.remove('active');
    });
    //ajouter la classe active sur le bouton sélectionné
    click_element.classList.add('active');
    //récupérer l'attribut
    const sort_order = click_element.getAttribute("data-sort-order");
    //sélectionner la table
    const table = document.querySelector('#table-user');
    // Exclure la ligne d'en-tête du tableau
    const rows = Array.from(table.rows).slice(1);

    if (sort_order === 'asc') {
        //trier trier ascendant
        rows.sort((a, b) => {
            //récupérer les données du tableau
            const cellA = a.cells[columnIndex].textContent;
            const cellB = b.cells[columnIndex].textContent;
            // Comparez les valeurs des cellules en fonction de leur type de données
            if (isNaN(cellA) || isNaN(cellB)) {
                return cellA.localeCompare(cellB);
            } else {
                return Number(cellA) - Number(cellB);
            }
        });
    } else {
        //trier trier descendant
        rows.sort((b, a) => {
            const cellA = a.cells[columnIndex].textContent;
            const cellB = b.cells[columnIndex].textContent;
            if (isNaN(cellA) || isNaN(cellB)) {
                return cellA.localeCompare(cellB);
            } else {
                return Number(cellA) - Number(cellB);
            }
        });
    }

    // Effacer le contenu du tableau existant
    const tbody = table.getElementsByTagName('tbody')[0];
    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }

    // Ajouter les lignes triées au tableau
    rows.forEach((row) => tbody.appendChild(row));
}

