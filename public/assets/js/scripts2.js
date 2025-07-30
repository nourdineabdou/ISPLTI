function appendDetail({url, container, callback = null}) {
    // get the container
    container = $(container);
    // make an ajax request
    let existingProducts = [];
    document.querySelectorAll('select[name="produit[]"]').forEach(select => {
        existingProducts.push(select.value);
    });

    // Make an AJAX request to get the new row
    $.ajax({
        url: url,
        type: 'GET',
        data: {existing_products: existingProducts}, // Send the current product IDs
        success: function (response) {
            $(container).append(response);
            // initJs()
        },
        error: function (xhr) {
            console.error('Error fetching new row:', xhr.responseText);
        },
    });
}

window.closeModal = function (modalId) {
    const activeModal = $('#' + modalId);
    activeModal.hide();
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');

}


$(document).ready(function () {
    $(document).on('change', '.product-select', function () {
        loadEmballage($(this));
    });
});

function loadEmballage(selectElement) {
    let productId = selectElement.val(); // Récupère l'ID du produit sélectionné
    let row = selectElement.closest('tr'); // Trouve la ligne de la table
    if (productId) {
        // Requête AJAX pour récupérer les types d'emballage et quantités associées
        $.ajax({
            url: 'sorti/getEmballage/' + productId, // URL de l'endpoint Laravel
            type: 'GET',
            success: function (response) {
                // Mettre à jour le champ 'emballage'
                let emballageSelect = row.find('.emballage-select');
                 // Append the response HTML to the container
                 emballageSelect.html(response.type_empbalages);
                // emballageSelect.empty();
                // emballageSelect.append('<option value="">{{ __("Sélectionner un emballage") }}</option>');
                // $.each(response.packaging, function (index, emballage) {
                //     emballageSelect.append('<option value="' + emballage.id + '">' + emballage.name + '</option>');
                // });

                // // Mettre à jour le champ 'nb_prod'
                // let nbProdSelect = row.find('[name="nb_prod[]"]');
                // nbProdSelect.empty();
                // nbProdSelect.append('<option value="">{{ __("Sélectionner une quantité") }}</option>');
                // $.each(response.quantities, function (index, quantity) {
                //     nbProdSelect.append('<option value="' + quantity + '">' + quantity + '</option>');
                // });
            },
            error: function () {
                console.log('Erreur lors de la récupération des données');
            }
        });
    }
}

 //get nombre de produit par emballage
$(document).ready(function () {
    $(document).on('change', '.emballage-select', function () {
        loadNbProd($(this));
    });
}
);

function loadNbProd(selectElement) {
    let emballageId = selectElement.val(); // Récupère l'ID de l'emballage sélectionné
    let row = selectElement.closest('tr'); // Trouve la ligne de la table
    let produit = row.find('.product-select');
    //let taille = row.find('.input-mesure');
    if (emballageId) {
        // Requête AJAX pour récupérer les types d'emballage et quantités associées
        $.ajax({
            url: 'sorti/getNombreProduit/' + produit.val() +'/'+emballageId, // URL de l'endpoint Laravel
            type: 'GET',
            success: function (response) {
                // Mettre à jour le champ 'nb_prod'
                let nbProdSelect = row.find('.nb_prod-select');
                nbProdSelect.html(response.nbProd);
            },
            error: function () {
                console.log('Erreur lors de la récupération des données');
            }
        });
    }
}

