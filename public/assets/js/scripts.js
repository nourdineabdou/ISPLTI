(function (window, undefined) {
    'use strict';
    //fetchTranslations();
    //fetchPaymentMethods();
    initJs()
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
    });

    $('table[data-column]').each(function () {
        let table = $(this);
        let columns = table.data('column').split(',');
        let url = table.data('url');
        let params = table.data('params');
        const dataTable = table.DataTable({
            processing: true,
            serverSide: true,
            search: true,
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: -1}
            ],
            ajax: {
                // Pass filters as data to your server
            },
            columns: columns.map(function (col) {
                return {
                    data: col, name: col
                }
            }),
            order: [[0, 'desc']]
        });

        table.closest('.datatable-container')
            .find('[data-filter]')
            .on('change', function () {
                dataTable.draw();
            });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            const activeElement = document.activeElement;
            if (activeElement.tagName === 'INPUT' || activeElement.tagName === 'SELECT') {
                const form = activeElement.closest('form');
                if (form) {
                    const submitButton = form.querySelector('button[onclick]');
                    if (submitButton) {
                        submitButton.click();
                        event.preventDefault();
                    }
                }
            }

            if (activeElement.tagName !== 'TEXTAREA' && activeElement.tagName !== 'BUTTON') {
                event.preventDefault();
                return false;
            }
        }
    });


})(window);

function fetchTranslations() {
    sendAjaxRequest({
        url: '/translations',
        onSuccess: function (response) {
            window.translations = response.data;
        },
    });
}

function fetchPaymentMethods() {
    sendAjaxRequest({
        url: '/payment-methods',
        onSuccess: function (response) {
            window.paymentMethods = response.data;
        },
    })
}

// Call this function on language switch or on page load

// hideModal
window.hideModal = hideModal;

function hideModal(modal = 'main', is_static = true) {
    $('#' + modal + '-modal').hide()
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
}

function logOut() {
    Swal.fire({
        title: 'Confirmer!',
        text: 'Voulez-vous vraiment vous déconnecter?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, déconnecter!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.value) {
            $('#logout-form').submit();
        } else {
            return false;
        }
    })
}


// loading spinner
function showLoadingSpinner(element) {
    let timerInterval;
    Swal.fire({
        title: "Auto close alert!",
        html: "I will close in <b></b> milliseconds.",
        timer: 2000,
        // timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
        }
    });
}


const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});

function initJs() {
    $('.select2').select2({
        width: '100%',
        allowClear: true
    });

    $('.select2-no-search').select2({
        allowClear: true,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('.select2-tags').select2({
        // theme: 'bootstrap-4',
        width: '100%',
        tags: true,
        tokenSeparators: [',', ' ']

    });

}


//removeElement(this)
function removeElement(element) {
    const closestLi = element.closest('li');
    const closestTr = element.closest('tr');

    if (closestLi) {
        closestLi.remove();
    } else if (closestTr) {
        closestTr.remove();
    } else {
        console.warn('No <li> or <tr> found to remove.');
    }
}

// check if the user needs to change the password
function checkPasswordChange() {
    $.ajax({
        url: window.location.href,  // Send request to current page URL
        method: 'GET',  // Assuming it's a GET request
        success: function (response) {
            console.log("Page loaded successfully.");
        },
        error: function (xhr) {
            console.log(xhr.status)
            if (xhr.status === 403) {  // Check if the user needs to change the password
                const data = xhr.responseJSON;
                alert(data.message);  // Show alert or other notification
                window.location.href = data.redirect_url;  // Redirect to the password change page
            }
        }
    });
}

function loadDropdown(url, dropdown, defaultOption = '', formatOption) {
    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            dropdown.empty();
            dropdown.append('<option value="">' + defaultOption + '</option>');
            $.each(data, function (index, item) {
                dropdown.append(`<option value="${item.id}">${formatOption(item)}</option>`);
            });
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function handleDependentDropdown(parentDropdown, childDropdown, urlTemplate, defaultOption, formatOption) {
    const parentId = parentDropdown.val();
    console.log(parentId)
    if (parentId) {
        loadDropdown(urlTemplate.replace(':id', parentId), childDropdown, defaultOption, formatOption);
    } else {
        childDropdown.empty();
        childDropdown.append('<option value="">' + defaultOption + '</option>');
    }
}

function ChangerEtatCommande(url) {
    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            const redirectRoute = response.redirectRoute;
            Swal.fire({
                type: 'success',
                title: response.message,
            }).then(() => {
                if (redirectRoute) {
                    window.location.href = redirectRoute;
                }
            });
            hideModal();
            $('table[data-column]').each(function () {
                    let table = $(this);
                    let dataTable = table.DataTable();
                    dataTable.ajax.reload();
                }
            );

        },
        error: function (error) {
            Swal.fire({
                type: 'error',
                title: "Error!",
                text: error.responseJSON.message
            })
        }
    });
}

function deleteRecord(url) {
    $.ajax({
        url: url,
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            Swal.fire({
                type: 'success',
                title: response.message,
            })
            $('table[data-column]').each(function () {
                    let table = $(this);
                    let dataTable = table.DataTable();
                    dataTable.ajax.reload();
                }
            );
        },
        error: function (error) {
            Swal.fire({
                type: 'error',
                title: "Error!",
                text: error.responseJSON.error
            })
        }
    });

}

function validerCommande(url, messageConfr,) {
    Swal.fire({
        title: 'Confirmer!',
        text: messageConfr,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, valider!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.value) {
            ChangerEtatCommande(url)
        } else {
            return false;
        }
    })
}

function confirmDelete(url) {
    Swal.fire({
        title: 'Confirmer!',
        text: 'Voulez-vous vraiment supprimer cet enregistrement?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.value) {
            Swal.showLoading()
            deleteRecord(url)
        } else {
            return false;
        }
    })
}


// show indicator progress
function showIndicatorProgress(element) {
    $(element).attr('disabled', 'disabled');
    $(element).find('.main-icon').hide();
    $(element).find('.indicator-progress').removeClass('d-none');
}

// hide indicator progress
function hideIndicatorProgress(element) {
    $(element).removeAttr('disabled');
    $(element).find('.main-icon').show();
    $(element).find('.indicator-progress').addClass('d-none');
}

window.openInModal = openInModal;

function openInModal({link, element, callback = null, modal = "main", size = "lg", is_static = true}) {
    // showIndicatorProgress(element);
    Swal.showLoading();
    $.ajax({
        type: 'get',
        url: link,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-App-Request': 'MySecretToken123' // Your custom token
        },
        success: function (data) {

            // hideIndicatorProgress(element);
            Swal.close();

            const modalId = `${modal}-modal`;
            const modalElement = document.getElementById(modalId);

            if (modalElement) {
                const modalDialog = modalElement.querySelector('.modal-dialog');
                modalDialog.className = `modal-dialog modal-${size}`;
                modalElement.querySelector('.modal-header-body').innerHTML = data;
                const activeModal = new bootstrap.Modal(modalElement, {
                    backdrop: is_static ? 'static' : true, // Manage backdrop
                    keyboard: !is_static, // Disable keyboard dismiss if static
                });
                activeModal.show();
                initJs();
                if (callback) callback();
            }

            /*hideIndicatorProgress(element);
            $("#" + modal + "-modal .modal-dialog").addClass("modal-" + size);
            $("#" + modal + "-modal .modal-header-body").html(data);
            const modalElement = document.getElementById(modal + '-modal');
            if (modalElement) {
                const activeModal = new bootstrap.Modal(modalElement, {
                    backdrop: is_static ? 'static' : false,
                });
                activeModal.show();
                /!*setTimeout(() => {
                    // hideModal(modal, is_static);
                    const modalElement = document.getElementById(modal + '-modal');
                    if (modalElement) {
                        const activeModal = new bootstrap.Modal(modalElement, {
                            backdrop: is_static ? 'static' : false,
                        });
                        activeModal.hide();
                    }
                }, 2000);*!/
                initJs()
            }*/

            /* setTimeout(() => {
                 hideModal(modal, is_static);
             }, 2000);*/

            if (callback)
                callback();
        },
        error: function (xhr) {
            // hideIndicatorProgress(element);
            Swal.close();
            Toast.fire({
                type: 'error',
                title: 'Error!',
                text: 'Une erreur s\'est produite lors du chargement de la page'
            });
            const data = xhr.responseJSON;
            if (xhr.status === 403 && xhr.responseJSON.status === 'error_change_password') {
                Swal.fire({
                    title: 'Changer le mot de passe',
                    text: data.message,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, changer le mot de passe',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                        if (result.isConfirmed) {
                            openInModal({
                                link: data.redirect_url,
                                element: element,
                                modal: 'main',
                                size: 'md',
                            });
                        }
                    }
                );
            }
        }
    });
}

function saveForm({element, afterSave = null, autoClose = true, modal = 'main'}) {
    const container = $(element).attr('container');
    const activeModal = $('#' + modal + '-modal');
    const form = $('#' + container + ' form');
    //console.log(new FormData(form[0]))
    $(element).attr('disabled', 'disabled');
    const mainIcon = $('#' + container + ' .main-icon');
    const wellSaved = $('#' + container + ' .well-saved');
    const indicatorProgress = $('#' + container + ' .indicator-progress');
    mainIcon.hide();
    indicatorProgress.removeClass('d-none');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: form.attr("method"),
        url: form.attr("action"),
        data: new FormData(form[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            const redirectRoute = data.redirectRoute;
            $(element).removeAttr('disabled');
            wellSaved.removeClass('d-none');
            mainIcon.hide();
            indicatorProgress.addClass('d-none');
            setTimeout(function () {
                wellSaved.addClass('d-none');
                mainIcon.show();
            }, 3000);
            if (redirectRoute === undefined) {
                Toast.fire({
                    type: 'success',
                    title: data.message,
                    // timerProgressBar: true,
                    timer: 3000,
                }).then(response => {
                    if (autoClose) {
                        activeModal.hide()
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');
                    }


                }).finally(() => {
                    if (afterSave && typeof afterSave === 'function') {
                        afterSave(data);
                    }
                });
            }
            $('#' + container + ' .is-invalid').each(function (index, item) {
                $(item).removeClass('is-invalid');
            });
            $('#' + container + ' .invalid-feedback').each(function (index, item) {
                $(item).remove();
            });
            $('#' + container + ' .select2-invalid-feedback').each(function (index, item) {
                $(item).remove();
            });
            $('table[data-column]').each(function () {
                let table = $(this);
                let dataTable = table.DataTable();
                dataTable.ajax.reload();
            });
            if (redirectRoute) {
                Swal.fire({
                    type: 'success',
                    title: data.message,
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = redirectRoute;
                })
            }
        },
        error: function (data) {
            mainIcon.show();
            indicatorProgress.addClass('d-none');
            $(element).removeAttr('disabled');
            if (data.status === 422) {
                //errors dans un tableau dinamique ou un tableau simple avec les erreurs
                //name* => name.0, name.1, name.2

                const errors = data.responseJSON;

                const erreurs = (errors.errors) ? errors.errors : errors;
                //afficher les erreurs dans un div

                $.each($('#' + container + ' form input'), function (key, item) {
                    let input = $(item);
                    if (!(input.attr('name') in erreurs)) {
                        input.next('.invalid-feedback').remove();
                        input.removeClass('is-invalid');
                    }
                });

                $.each(erreurs, function (key, value) {
                    const formControl = $('#' + container + ' .form-control[name=' + key + ']');
                    const input = formControl;
                    if (input.attr('name') === key) {
                        if (input.hasClass('select2')) {
                            const span = formControl;
                            if (input.parent().parent().parent().hasClass('input-group')) {
                                span.parent().parent().parent('.select2-invalid-feedback').remove();
                                $(`<strong class='select2-invalid-feedback'>${value}</strong>`).insertAfter(input.parent().parent().parent());
                            } else {
                                span.next().next('.select2-invalid-feedback').remove();
                                $(`<strong class='select2-invalid-feedback'>${value}</strong>`).insertAfter(span.next());
                            }
                        } else {
                            input.next('.invalid-feedback').remove();
                            $(`<strong class='invalid-feedback'>${value}</strong>`).insertAfter(input);
                        }
                        input.addClass('is-invalid');
                    }
                });

                $('#' + container + ' .form-control').on('change', function () {
                    $(this).next('.invalid-feedback').remove();
                    $(this).removeClass('is-invalid');
                });

                const select2 = $('#' + container + ' .select2');

                select2.change(function () {
                    $(this).next().next('.select2-invalid-feedback').remove();
                    $(this).removeClass('is-invalid');
                });

                select2.change(function () {
                    $(this).parent().parent().parent().next('.select2-invalid-feedback').remove();
                    $(this).removeClass('select2-is-invalid');
                });

                if (errors.errors) {
                    let form = $('#' + container + ' form');
                    $('#' + container).find('.alert-danger').remove();
                }

            } else if (data.status === 400) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: data.responseJSON.error
                })

            } else {
                Toast.fire({
                    type: 'error',
                    title: 'Une erreur s\'est produite lors de l\'enregistrement!'
                });
            }

            $('#' + container + ' .main-icon').show();
            $(element).removeAttr('disabled');
        }
    });
}

function loadDropdownElements({url, dropdown, defaultOption = '', formatOption}) {
    dropdown = $(dropdown);
    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            dropdown.empty();
            // dropdown.append('<option></option>');
            if (defaultOption !== '') {
                dropdown.append('<option>' + defaultOption + '</option>');
            }
            $.each(data, function (index, item) {
                dropdown.append(`<option value="${item.id}">${formatOption(item)}</option>`);
            });
        },
        error: function (error) {
            console.log(error);
        }
    });
}


// inject html into a div
window.injectHtml = injectHtml;

function injectHtml({url, container, callback = null}) {
    $.ajax({
        type: 'get',
        url: url,
        success: function (data) {
            $(container).append(data);
            initJs()
            if (callback) {
                callback();
            }
        },
        error: function (xhr) {
            const data = xhr.responseJSON;
            if (xhr.status === 403 && xhr.responseJSON.status === 'error_change_password') {  // Check if the user needs to change the password
                Swal.fire({
                    title: 'Changer le mot de passe',
                    text: data.message,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, changer le mot de passe',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                        if (result.isConfirmed) {
                            openInModal({
                                link: data.redirect_url,
                                element: container,
                                modal: 'main',
                                size: 'md',
                            });
                        }
                    }
                );
            }
        }
    });
}

function appendToContainer({url, container, callback = null}) {
    // get the container
    container = $(container);
    const placeholder = $(container);
    // make an ajax request
    let existingProducts = [];
    document.querySelectorAll('select[name="products[]"]').forEach(select => {
        existingProducts.push(select.value);
    });

    // Make an AJAX request to get the new row
    $.ajax({
        url: url,
        type: 'GET',
        data: {existing_products: existingProducts}, // Send the current product IDs
        success: function (response) {


            const rows = placeholder.find('tr');
            const index = rows.length;
            const newRow = $(response).attr('data-index', index);
            placeholder.prepend(newRow);
            // Append the response HTML to the container
            //$(container).prepend(response);
        },
        error: function (xhr) {
            console.error('Error fetching new row:', xhr.responseText);
        }
    });
}

function deleteTableRow({element, url}) {
    let button = $(element);
    Swal.fire({
        title: 'Confirmer!',
        text: 'Voulez-vous vraiment supprimer cet enregistrement?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    button.closest('tr').remove();
                    Toast.fire({
                        type: 'success',
                        title: response.message,
                    });
                },
                error: function (error) {
                    Toast.fire({
                        type: 'error',
                        title: 'Error!',
                        text: error.responseJSON.error
                    });
                }
            });
        }
    })
}

function validatePlaceholder() {
    const placeholder = $('#placeholder');

    if (!placeholder || placeholder.length === 0) {
        toastr.error('Placeholder element not found');
        return false;
    }

    return true;
}


function isElementAlreadyAdded(id) {
    const existingElement = $(`input[name="p_p_e_item[${id}]"]`);

    return existingElement.length > 0;
}

function addNewProduct({container, meal_id}) {
    alert('Adding new product');
    $(".placeholder-container").append(`
            <div class="row">
                <div class="col-md-6">
                    <select
                        class="form-control"
                        name="product_id[]"
                        required
                    >
                        <option value="">Select Product</option>
                        <!--@foreach(\App\Models\Product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach-->
                    </select>
                </div>
                <div class="col-md-4">
                    <input
                        type="number"
                        class="form-control"
                        name="quantity[]"
                        required
                    >
                </div>
                <div class="col-md-2">
                    <button
                        class="btn btn-danger"
                        onclick="$(this).closest('.row').remove()"
                    >
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `);
}

// printing
// printObject
/*function printObject({link,callback = null,  title = 'Print', width = 800, height = 600}) {
    const printWindow = window.open(link, title, `width=${width}, height=${height}`);
    printWindow.print();
    if (callback) {
        callback();
    }
}*/

function printObject({ link, callback = null, title = 'Print', width = 800, height = 600 }) {
    const printWindow = window.open(link, title, `width=${width},height=${height}`);

    // Check if the window opened successfully
    if (printWindow) {
        printWindow.addEventListener('load', () => {
            printWindow.print(); // Print after the window is fully loaded
            if (callback) {
                callback(); // Call the callback function after printing
            }
        });
    } else {
        console.error('Failed to open print window.');
    }
}

function showConfirmationDialog({
                                    title = 'Confirmer!',
                                    text = 'Voulez-vous vraiment effectuer cette action?',
                                    confirmButtonText = 'Oui, continuer!',
                                    cancelButtonText = 'Annuler',
                                    inputType = null,
                                    inputOptions = null,
                                    inputPlaceholder = null,
                                    inputValidator = null,
                                }) {
    const config = {
        title: title,
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText,
    };

    if (inputType) {
        config.input = inputType;
        config.inputOptions = inputOptions;
        config.inputPlaceholder = inputPlaceholder;
        config.inputValidator = inputValidator;
    }

    return Swal.fire(config);
}

// Reusable AJAX handler
function sendAjaxRequest({url, method = 'GET', data = {}, onSuccess, onError}) {
    $.ajax({
        url: url,
        method: method,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: data,
        success: onSuccess,
        error: onError || function (error) {
            Swal.fire({
                title: 'Erreur!',
                text: error.responseJSON?.message || 'Une erreur est survenue.',
                type: 'error',
                confirmButtonText: 'OK',
            });
        },
    });
}

// Reload DataTables
function reloadDataTables() {
    $('table[data-column]').each(function () {
        $(this).DataTable().ajax.reload();
    });
}

// Generalized confirmation and action handler
function confirmAndExecute({
                               title,
                               text,
                               confirmButtonText,
                               url,
                               method,
                               paymentMethods = null,
                               callback = null
                           }) {
    const inputType = paymentMethods ? 'select' : null;
    const inputOptions = paymentMethods
        ? paymentMethods.reduce((options, item) => {
            options[item.id] = item.name;
            return options;
        }, {})
        : null;

    const inputValidator = paymentMethods
        ? (value) =>
            value
                ? Promise.resolve()
                : Promise.resolve('Veuillez sélectionner un mode de paiement')
        : null;

    showConfirmationDialog({
        title,
        text,
        confirmButtonText,
        inputType,
        inputOptions,
        inputPlaceholder: paymentMethods
            ? 'Sélectionnez un mode de paiement'
            : null,
        inputValidator,
    }).then((result) => {
        if (result.value) {
            const data = paymentMethods ? {payment_method_id: result.value} : {};
            sendAjaxRequest({
                url,
                method,
                data,
                onSuccess: function (response) {
                    Swal.fire({
                        title: response.message,
                        type: 'success',
                        confirmButtonText: 'OK',
                    })
                        .then(reloadDataTables)
                        .finally(() => {
                            if (callback) {
                                callback(response);
                            }
                        });

                },
            });
        }
    }).catch(err => {
        console.error(err);
    })
}

// Specific handlers
window.confirmPayment = ({title, text, confirmButtonText, url, method, callback = null}) =>
    confirmAndExecute({
        title,
        text,
        confirmButtonText,
        url,
        method,
        paymentMethods,
        callback
    });

window.confirmAction = ({title, text, confirmButtonText, url, method, callback = null}) =>
    confirmAndExecute({
        title,
        text,
        confirmButtonText,
        url,
        method,
        callback
    });


window.showModal = function ({
                                 route,
                                 title = "",
                                 modalBody = "",
                                 size = "md",
                                 backdrop = "static",
                                 keyboard = true,
                                 focus = true,
                                 callback = null,
                                 modalId = 'dynamic-modal',
                                element = null
                             }) {
    // Check if the modal already exists
    let existingModal = document.getElementById(modalId);
    if (existingModal) {
        // If it exists, remove it before creating a new one
        existingModal.remove();
    }

    // add id to the clicked button
    if (element) {
        // console.log(element)
            $(element).attr('id', 'clicked-button')
    }

    // Create a new modal structure
    const modalHtml = `
        <div class="modal fade" id="${modalId}" tabindex="-1"
            aria-labelledby="${modalId}-label" aria-hidden="true"
        >
            <div class="modal-dialog modal-${size}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="${modalId}-label">${title}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden"></span>
                        </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHtml);

    // Get the newly created modal element
    const modalElement = document.getElementById(modalId);

    // Initialize the Bootstrap modal
    const myModal = new bootstrap.Modal(modalElement, {
        backdrop: 'static'
    });

    // Show the modal
    myModal.show();

    if (route){
        // Fetch the content from the route and inject it
        $.ajax({
            url: route,
            type: 'GET',
            success: function (response) {
                // Inject the response content into the modal body
                modalElement.querySelector('.modal-body').innerHTML = response;

                initJs()

                if (callback) {
                    callback(response)
                }

            },
            error: function (xhr, status, error) {
                // Show an error message if the request fails
                modalElement.querySelector('.modal-body').innerHTML = `
                <div class="alert alert-danger">Failed to load content. Please try again.</div>
            `;
                console.error("Error loading modal content:", error);
            }
        });
    }else {
        modalElement.querySelector('.modal-body').innerHTML = modalBody;
    }

    initJs()

}

window.closeModal = function (modalId) {
    const activeModal = $('#' + modalId);
    activeModal.hide();
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');

}


// reloadDatatable
window.reloadDatatable = function () {
    $('table[data-column]').each(function () {
        $(this).DataTable().ajax.reload();
    });
}

// appendToCommandeTable
window.appendToCommandeTable = function ({container, element , commende}) {
    const productId = $(element).val();
    const placeholder = $(container);
    const url = `/products/${productId}/${commende}/commande-row`;

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            // placeholder.prepend(response);

            // find all the rows in the placeholder and add data-index attribute to them
            const rows = placeholder.find('tr');
            const index = rows.length;
            const newRow = $(response).attr('data-index', index);
            placeholder.prepend(newRow);
            // console.log(index)
        },
        error: function (xhr) {
            console.error('Error fetching new row:', xhr.responseText);
        }
    });

}


// appendToDeplacementTable
window.appendToDeplacementTable = function ({container, element , commende}) {
    const productId = $(element).val();
    const placeholder = $(container);
    const url = `/sorti/${productId}/${commende}/commande-row`;

    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            // placeholder.prepend(response);
            // find all the rows in the placeholder and add data-index attribute to them
            const rows = placeholder.find('tr');
            const index = rows.length;
            const newRow = $(response).attr('data-index', index);
            placeholder.prepend(newRow);
            // console.log(index)
        },
        error: function (xhr) {
            console.error('Error fetching new row:', xhr.responseText);
        }
    });

}

// saveEmballage
/*window.saveEmballage = function (element) {
    const container = $(element).attr('container');
    const form = $('#' + container + ' form');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: form.attr("method"),
        url: form.attr("action"),
        data: new FormData(form[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            Toast.fire({
                type: 'success',
                title: data.message,
                timer: 1000,
            }).then(() => {

            });
        },
        error: function (data) {

        }
    });
}*/

window.saveEmballage = function (element) {
    const container = $(element).attr('container');
    const modal = $('#' + container); // Get the modal element
    const form = modal.find('form');
    /*const mainIcon = $('#' + container + ' .main-icon');
    const wellSaved = $('#' + container + ' .well-saved');
    const indicatorProgress = $('#' + container + ' .indicator-progress');
    mainIcon.hide();
    indicatorProgress.removeClass('d-none');*/
    const mainIcon = $('#' + container + ' .main-icon');
    const wellSaved = $('#' + container + ' .well-saved');
    const indicatorProgress = $('#' + container + ' .indicator-progress');
    $(element).attr('disabled', 'disabled');
    mainIcon.hide();
    indicatorProgress.removeClass('d-none');
    const placeholder = $('#placeholder');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: form.attr("method"),
        url: form.attr("action"),
        data: new FormData(form[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $(element).removeAttr('disabled');
            wellSaved.removeClass('d-none');
            mainIcon.hide();
            indicatorProgress.addClass('d-none');
            setTimeout(function () {
                wellSaved.addClass('d-none');
                mainIcon.show();
            }, 3000);
            Toast.fire({
                type: 'success',
                title: data.message,
                timer: 3000,
            }).then(() => {
                if (data.route) { // Check if the response contains the modal URL
                    $.get(data.route, function (response) {
                        placeholder.html(response);
                    });
                } else {
                    console.error("Modal URL is missing in the response.");
                }
            });
            initJs()
            // reset the form
            form[0].reset();
            // select2
            form.find('.select2').val(null).trigger('change');

        },
        error: function (data) {
            mainIcon.show();
            indicatorProgress.addClass('d-none');
            $(element).removeAttr('disabled');
            if (data.status === 422) {
                //errors dans un tableau dinamique ou un tableau simple avec les erreurs
                //name* => name.0, name.1, name.2

                const errors = data.responseJSON;

                const erreurs = (errors.errors) ? errors.errors : errors;
                //afficher les erreurs dans un div

                $.each($('#' + container + ' form input'), function (key, item) {
                    let input = $(item);
                    if (!(input.attr('name') in erreurs)) {
                        input.next('.invalid-feedback').remove();
                        input.removeClass('is-invalid');
                    }
                });

                $.each(erreurs, function (key, value) {
                    const formControl = $('#' + container + ' .form-control[name=' + key + ']');
                    const input = formControl;
                    if (input.attr('name') === key) {
                        if (input.hasClass('select2')) {
                            const span = formControl;
                            if (input.parent().parent().parent().hasClass('input-group')) {
                                span.parent().parent().parent('.select2-invalid-feedback').remove();
                                $(`<strong class='select2-invalid-feedback'>${value}</strong>`).insertAfter(input.parent().parent().parent());
                            } else {
                                span.next().next('.select2-invalid-feedback').remove();
                                $(`<strong class='select2-invalid-feedback'>${value}</strong>`).insertAfter(span.next());
                            }
                        } else {
                            input.next('.invalid-feedback').remove();
                            $(`<strong class='invalid-feedback'>${value}</strong>`).insertAfter(input);
                        }
                        input.addClass('is-invalid');
                    }
                });

                $('#' + container + ' .form-control').on('change', function () {
                    $(this).next('.invalid-feedback').remove();
                    $(this).removeClass('is-invalid');
                });

                const select2 = $('#' + container + ' .select2');

                select2.change(function () {
                    $(this).next().next('.select2-invalid-feedback').remove();
                    $(this).removeClass('is-invalid');
                });

                select2.change(function () {
                    $(this).parent().parent().parent().next('.select2-invalid-feedback').remove();
                    $(this).removeClass('select2-is-invalid');
                });

                if (errors.errors) {
                    let form = $('#' + container + ' form');
                    $('#' + container).find('.alert-danger').remove();
                }

            } else if (data.status === 400) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: data.responseJSON.error
                })

            } else {
                Toast.fire({
                    type: 'error',
                    title: 'Une erreur s\'est produite lors de l\'enregistrement!'
                });
            }

            $('#' + container + ' .main-icon').show();
            $(element).removeAttr('disabled');

        }
    });
};
// on change the select2
window.natureEmballage = function(element) {
    // recupere le tr selectionner *
    //const clickedButton = $('#clicked-button');
    //const row = clickedButton.closest('tr');
    // get element tr a prtir de l'element
    const row = $(element).closest('tr');
    const product = $(element).val();
    url = '/products/get-nature-embalages/'+product;
    // ajax request to get the nature emballage
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            console.log(response.nombre)
            // desabled input mesure if mesure is null
            if (!response.mesure) {
                //alert(row)
                // desabled input mesure if mesure is null
                row.find('input[name="mesure[]"]').prop('disabled', true);
                row.find('input[name="mesure[]"]').val('');
            }else
            {
                // desabled input mesure if mesure is null
                row.find('input[name="mesure[]"]').prop('disabled', false);
                row.find('input[name="mesure[]"]').val('');
            }
            // dsabled input qte if qte is null
            if(!response.nombre || response.nombre <= 1)
            {
                row.find('input[name="qte[]"]').prop('disabled', true);
                row.find('input[name="qte[]"]').val('');
            }else
            {
                row.find('input[name="qte[]"]').prop('disabled', false);
                row.find('input[name="qte[]"]').val('');
            }

        },
        error: function (xhr) {
            console.error('Error fetching new row:', xhr.responseText);
        }
    });
    console.log(product)
}

// replaceEmballage
window.replaceEmballage = function ({ element, elements}) {
    const clickedButton = $('#clicked-button');
    console.log(elements)
    // get the closest row
    // {typeEmballageNom: 'type one', typeEmballage: '31', mesure: '1.00', nombre: '1', productName: 'Ajax', …}
    const row = clickedButton.closest('tr');
    const productName = elements.productName;
    const idProduct = elements.productId;
    const typeEmballage =  elements.typeEmballageNom + ' - ' + elements.mesure +  elements.unit + ' - ';
    let span = "";
    //row.find('td:eq(0) input.product_id').text(idProduct);
    //row.find('td:eq(0) input.emballage_id').text(elements.emballageId);
    if( elements.qte > -1)
    {
        if(elements.qte > 0)
            span = '<span class="badge badge-primary"><i class="bi bi-box-fill"></i>'+elements.qte+'</span>';
        else if (elements.qte === 0)
            span = '<span class="badge badge-danger"><i class="bi bi-box"></i>0</span>';
        else
        span=  '<span class="badge badge-danger"><i class="bi bi-box"></i>le produit n existe pas</span>';
        row.find('td:eq(3)').html(span)
    }
    row.find('td:eq(1) span.type-emballage').text(typeEmballage);
    row.find('td:eq(1) span.sub-product').text('Sous produits: ' + elements.nombre);
    row.find('td:eq(1) span.product-name').text(productName);
    // .elements.nombre
    // row.find(
    // replace the hidden input values

    row.find('input[name="emballage_id[]"]').val(elements.emballageId);

    Toast.fire({
        type: 'success',
        title: 'Emballage remplacé avec succès!',
        timer: 1000,
    }).then(() => {
        hideModal('product');
    })
};

//exportTable function
window.exportTable = function (url) {
    // redirect to the url
    window.location.href = url;
    //console.log(url)
};
