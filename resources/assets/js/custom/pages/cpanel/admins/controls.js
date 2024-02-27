const controllActions = function () {
    var form,
        table_id    = 'admins_table',
        modal_id    = '#btn_modal_cred',
        dataForm    = null,
        formMode    = 'store',
        resetForm   = false,
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
                    'first_name': {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.First name is required')
                            }
                        }
                    },
                    'last_name' : {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.Last name is required')
                            }
                        }
                    },
                    'mobile' : {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.Mobile no is required')
                            }
                        }
                    },
                    'birth_date' : {
                        validators: {
                            notEmpty: {
                                message: trans('auth.birth date is required')
                            }
                        }
                    },
                    'email' : {
                        validators: {
                            notEmpty: {
                                message: trans('auth.Email is required')
                            }
                        }
                    },
                    'status' : {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.status_select')
                            }
                        }
                    },
                    'role_id[]' : {
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
        $(document).on('submit','#kt_manage_form',function (e) {
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

        var record = dataForm != null ? dataForm : null;

        if (record != null) {
            $(form).attr('action', route_update.replace('-id-', record.id));
            $(".form-patch").html(patch);
            $('.form-title').html(trans('cpanel.edit'));
        } else {
            $(form).attr('action', route_store);
            $('.form-patch').html('');
            $('.form-title').html(trans('cpanel.create'));
        }

        var option_data = {
            first_name   : record != null ? record.first_name : '',
            last_name    : record != null ? record.last_name : '',
            national_code: record != null ? (record.info != null ? record.info.national_code : '') : '',
            email        : record != null ? record.email : '',
            mobile_no    : record != null ? record.mobile_no : '',
            gender       : record != null ? (record.info != null ? record.info.gender : '') : '',
            birthday     : record != null ? (record.info != null ? record.info.birthday : '') : '',
            roles        : record != null ? (record.roles != null ? record.roles : []) : [],
            avatar       : record != null ? record.avatar : ''
        };

        $('[name="first_name"]')
            .val(option_data.first_name)
            .focus();
        $('[name="last_name"]')
            .val(option_data.last_name);
        $('[name="national_code"]')
            .val(option_data.national_code);
        $('[name="email"]')
            .val(option_data.email);
        $('[name="mobile_no"]')
            .val(option_data.mobile_no);
        $('[name="gender"]')
            .val(option_data.gender)
            .trigger('change');
        $('[name="role_id[]"]')
            .val(option_data.roles)
            .trigger('change');

        $('[name="birthday-text"]').val(option_data.birthday !== '' && option_data.birthday != null ? moment(option_data.birthday, 'YYYY-MM-DD').locale('fa').format('YYYY-MM-DD') : '');
        if (option_data.birthday !== '' && option_data.birthday != null) pdPicker.setDate(Date.parse(option_data.birthday));

        window.livewire.emit('resetDataAvatar', option_data.avatar);

        resetForm = false;
    }

    var checkValidate = function (mode = '') {

        submitButton.disabled = true;
        // submitCloseButton.disabled = true;
        if (mode === 'close') submitCloseButton.setAttribute('data-kt-indicator', 'on');
        else submitButton.setAttribute('data-kt-indicator', 'on');

        if (validator) {
            validator.validate().then(function (status) {
                console.log(status)
                if (status === 'Valid') {
                    sendDate(mode);
                } else {
                    submitButton.disabled = false;
                    // submitCloseButton.disabled = false;
                    submitButton.removeAttribute('data-kt-indicator');
                    // submitCloseButton.removeAttribute('data-kt-indicator');
                    $('html, body').animate({
                        scrollTop: $(".card-body").offset().top -= 95
                    }, 1000);
                }
            });
        } else {
            sendDate(mode);
        }
    }

    var sendDate = function (mode = '') {
        axios({
            method: 'post',
            url   : route_store,
            data  : new FormData(form),
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

    return {
        init   : function () {
            form = document.querySelector('#kt_manage_form');
            submitButton = document.querySelector('#modal_submit');
            // submitCloseButton = document.querySelector('#modal_submit_close');

            // initValidation();
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
