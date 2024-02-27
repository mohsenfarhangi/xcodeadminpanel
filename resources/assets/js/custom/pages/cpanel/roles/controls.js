const controllActions = function () {
    var form,
        table_id = 'roles_table',
        modal_id = '#btn_modal_cred',
        dataForm = null,
        formMode = 'store',
        resetForm = false,
        validations = [],
        submitButton,
        submitCloseButton,
        validator
    ;

    var handleForm = function () {

        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'role': {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.role id is required')
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        /*** Form Actions ***/
        $(document).on('click', '#modal_submit', function () {
            checkValidate();
        });

        /**
         * on form submit
         */
        $(document).on('submit', '#kt_manage_form', function (e) {
            e.preventDefault();
            checkValidate();
        })

        /*** livewire hook ***/
        window.livewire.hook('message.processed', (message, component) => {
            if (component.el.className === 'container-avatar') {
                KTImageInput.createInstances('.container-avatar [data-kt-image-input]');
                KTApp.initBootstrapTooltips();
            }

            if (component.el.className === 'container-modal-description') {
                window.modalForm = new bootstrap.Modal('#kt_modal_description')
                window.modalForm.show();
            }

            if (component.el.className === 'container-modal-send-sms') {
                window.modalForm = new bootstrap.Modal('#kt_modal_send_sms')
                window.modalForm.show();
            }
        });
    }

    var setForm = function () {
        resetForm = true;
        form.reset();
        $.each(validations, function (index, item) {
            item.resetForm();
        });

        resetForm = false;
    }

    var checkValidate = function (mode = '') {

        submitButton.disabled = true;
        // submitCloseButton.disabled = true;
        if (mode === 'close') submitCloseButton.setAttribute('data-kt-indicator', 'on');
        else submitButton.setAttribute('data-kt-indicator', 'on');

        // if (validator) {
        //     validator.validate().then(function (status) {
        //         console.log(status)
        //         if (status === 'Valid') {
        //             sendDate(mode);
        //         } else {
        //             console.log(validator.validate())
        //             submitButton.disabled = false;
        //             submitButton.removeAttribute('data-kt-indicator');
        //         }
        //     });
        // } else {
        sendDate(mode);
        // }
    }

    var sendDate = function (mode = '') {
        axios({
            method: 'post',
            url: route_store,
            data: new FormData(form),
        })
            .then(function (response) {
                var response_data = response.data;

                if (response_data.status && !response_data.errors) {
                    createSuccessMessage();
                    window.LaravelDataTables[table_id].ajax.reload();
                    dataForm = null;

                    if (mode === 'close') {
                        setForm();
                        $('.card-table').slideDown();
                        $('.card-form').slideUp();
                    } else {
                        if (formMode === 'update') dataForm = response_data.data;
                        setForm();
                    }
                } else {
                    createErrorPage(response_data.errors);
                }
            })
            .catch(function (error) {
                if (error.response) {
                    window.createErrorPage(error.response.data.errors);
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
            })
            .finally(function () {
                setTimeout(function () {
                    submitButton.disabled = false;
                    submitButton.removeAttribute('data-kt-indicator');

                    // submitCloseButton.disabled = false;
                    // submitCloseButton.removeAttribute('data-kt-indicator');
                }, 1000);
            });
    }

    const checkAllPermission = () => {
        let permissions = $(document).find('input[name="permissions[]"]');

        $(document).on('click', "#check_all_permissions", function () {
            let elem = $(this);
            let checked = elem.prop('checked');
            permissions.each(function (index, item) {
                $(item).prop('checked',checked)
            })
        })
    }

    return {
        init: function () {
            form = document.querySelector('#kt_manage_form');
            submitButton = document.querySelector('#modal_submit');
            // submitCloseButton = document.querySelector('#modal_submit_close');

            // initValidation();
            checkAllPermission();
            handleForm();
        },
        setForm: function (mode = 'store', response = null) {
            formMode = mode;
            dataForm = response;
            setForm();
        }
    };
}()

KTUtil.onDOMContentLoaded(function () {
    controllActions.init();
});
