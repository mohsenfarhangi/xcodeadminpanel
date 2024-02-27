"use strict";

window.modalForm = null;

function closeModal(modal_id) {
    let modalElem = $(modal_id);
    let modal = bootstrap.Modal.getInstance(modalElem);
    modal.hide();
}

(function ($) {

    /*** Manage Modal Form ***/
    $(document).on('click', '.btn-show-data', function () {
        let elem = $(this);
        let id = elem.closest('tr').attr('id');
        window.livewire.emit('showData', id);
    })

    $(document).on('click', '#btn-add-form', function () {
        let elem = $(this);
        let id = null;
        window.livewire.emit('showData', id);
    })
})(jQuery);
