"use strict";
let ProfileActions = function () {
    let user_id;
    let saveBtn, editBtn;
    let mapVal, mapMarker;
    let changeAddressCity;
    let addressForm, addressFormValidator;

    //**********************************
    // Detail Tab
    //**********************************
    const overviewTab = () => {
        saveBtn = $(document).find(".btn-save-account");
        editBtn = $(document).find(".edit-account-btn");
        let formWrapper = $('#diver_details');
        editBtn.on('click', function () {
            let elem = $(this);
            if (saveBtn.hasClass("d-none")) {
                saveBtn.removeClass('d-none');
                elem.addClass('d-none')
                showHideAccountDetailInputs()
            } else {
                elem.removeClass('d-none');
                saveBtn.addClass('d-none')
                showHideAccountDetailInputs()
            }
        })
        saveBtn.on('click', function () {
            let elem = $(this);
            if (editBtn.hasClass("d-none")) {
                formWrapper.submit()
                indicatorEnable(saveBtn);
            } else {
                editBtn.removeClass('d-none');
                elem.addClass('d-none')
            }
        })
        saveDetails(formWrapper);
    }
    const showHideAccountDetailInputs = () => {
        $('.account-detail-input').each(function (index, item) {
            let elem = $(item);
            let span = elem.siblings('.span-value');
            if (elem.hasClass('d-none')) {
                elem.removeClass("d-none")
                span.addClass("d-none")
            } else {
                elem.addClass("d-none")
                span.removeClass("d-none")
            }
        })
    }
    const saveDetails = (form) => {
        form.on('submit', function (e) {
            e.preventDefault();
            let formValues = new FormData(form[0]);
            formValues.append('_token', _token);
            formValues.append('id', user_id);
            formValues.append('action', 'changeDetails')
            axios({
                method: 'post',
                url: ajax,
                data: formValues,
            })
                .then(function (response) {
                    var response_data = response.data;

                    if (response_data.status && !response_data.errors) {
                        createSuccessMessage();
                        showHideAccountDetailInputs()
                        window.location.reload();
                    } else {
                        createErrorPage(response_data.errors);
                    }

                })
                .finally(function () {
                    setTimeout(function () {
                        indicatorDisable(saveBtn);
                    }, 1000)
                })
        })

    }
    /**
     * change driver avatar functions
     */
    const changeAvatar = () => {
        //Create a new image upload instance
        let AvatarContainer = document.querySelector('.user-avatar-input-container')
        let Avatar = new KTImageInput(AvatarContainer);

        let applyButton = $('[data-kt-image-input-action="apply"]');

        // After the new image is selected
        Avatar.on("kt.imageinput.changed", function (e) {
            applyButton.removeClass('d-none')
        });
        //After the selected image is canceled
        Avatar.on("kt.imageinput.canceled", function (e) {
            applyButton.addClass('d-none')
        });
        //When the save button is clicked
        applyButton.on('click', function () {
            let fileInput = $(Avatar.getInputElement()).prop('files');
            let form = new FormData();
            form.append('avatar', fileInput[0])
            form.append('_token', _token)
            form.append('id', user_id)
            form.append('action', "uploadNewAvatar")
            axios({
                method: 'post',
                url: ajax,
                data: form,
                headers: {
                    "Content-Type": "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
                }
            })
                .then(function (response) {
                    var response_data = response.data;

                    if (response_data.status && !response_data.errors) {
                        // let avatarImage = $(Avatar.getElement()).find('.image-input-wrapper');
                        // avatarImage.css('background-image','url('+ response_data.url +')')
                        Avatar.changeSrc(response_data.url)
                        $(document).find('.user-avatar-input-container [data-kt-image-input-action="cancel"]').click();
                    } else {
                        createErrorPage(response_data.errors);
                    }
                })
                .catch(function (error) {
                    if (error.response) { // get response with a status code not in range 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) { // no response
                        console.log(error.request);
                        // instance of XMLHttpRequest in the browser
                        // instance ofhttp.ClientRequest in node.js
                    } else { // Something wrong in setting up the request
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                });
        })

        //After the selected image is canceled
        Avatar.on("kt.imageinput.removed", function (e) {
            axios({
                method: 'post',
                url: ajax,
                data: {
                    "_token": _token,
                    "id": user_id,
                    "action": "removeAvatar"
                },
            })
                .then(function (response) {
                    var response_data = response.data;

                    if (response_data.status && !response_data.errors) {
                        $(document).find('.user-avatar-input-container [data-kt-image-input-action="cancel"]').click();
                    } else {
                        createErrorPage(response_data.errors);
                    }
                })
                .catch(function (error) {
                    if (error.response) { // get response with a status code not in range 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) { // no response
                        console.log(error.request);
                        // instance of XMLHttpRequest in the browser
                        // instance ofhttp.ClientRequest in node.js
                    } else { // Something wrong in setting up the request
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                });
        });
    }

    //**********************************
    // Address Tab
    //**********************************
    let btnRemoveAddressElem;
    const addressFormValidation = () => {
        addressFormValidator = FormValidation.formValidation(
            addressForm,
            {
                fields: {
                    'address_title': {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.is required')
                            }
                        }
                    },
                    'address_province_id': {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.is required')
                            }
                        }
                    },
                    'address_city_id': {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.is required')
                            }
                        }
                    },
                    'address_format': {
                        validators: {
                            notEmpty: {
                                message: trans('cpanel.is required')
                            }
                        }
                    },
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

    }
    const addressMapInit = () => {
        let geo_location_lat = $(document).find('[name="address[lat]"]');
        let geo_location_lng = $(document).find('[name="address[lng]"]');

        let city_lat = $(document).find('[name="city_lat"]').val();
        let city_lng = $(document).find('[name="city_lng"]').val();


        mapVal = new L.Map('address_map', {center: new L.LatLng(city_lng, city_lat), zoom: 13})
        var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            osm = L.tileLayer(osmUrl, {maxZoom: 20, attribution: osmAttrib});

        L.control.layers({
            "map": osm.addTo(mapVal),
        }, {}, {position: 'topright', collapsed: false}).addTo(mapVal);

        if (geo_location_lat.val() !== '' && geo_location_lng.val() !== '') {
            mapMarker = L.marker([geo_location_lat.val(), geo_location_lng.val()]).addTo(mapVal)
            mapVal.setView(mapMarker.getLatLng())
        }

        mapVal.on('click', function (e) {

            if (mapMarker !== undefined) {
                mapMarker.remove();
            }
            mapMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(mapVal)
            geo_location_lat.val(e.latlng.lat)
            geo_location_lng.val(e.latlng.lng)

            axios({
                method: 'post',
                url: ajax,
                data: {
                    "_token": _token,
                    "lat": e.latlng.lat,
                    "lng": e.latlng.lng,
                    "action": "getUserAddressFormat"
                },
            })
                .then(function (response) {
                    var response_data = response.data;

                    if (response_data.status && !response_data.errors) {
                        $('[name="address_format"]').val(response_data.formatted_address)
                    } else {
                        createErrorPage(response_data.errors);
                    }
                })
                .catch(function (error) {
                    if (error.response) { // get response with a status code not in range 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) { // no response
                        console.log(error.request);
                        // instance of XMLHttpRequest in the browser
                        // instance ofhttp.ClientRequest in node.js
                    } else { // Something wrong in setting up the request
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                });
        })

    }
    const saveAddress = () => {
        $('.btn-save-address').on('click', function () {
            addressFormValidator.validate().then(function (status) {
                if (status === 'Valid'){
                    let elem = $(this)
                    indicatorEnable(elem)
                    let formEl = $("#user_address");
                    let formData = new FormData(formEl[0])
                    let address_id = $('[name="address_id"]')
                    formData.append('_token', _token)
                    formData.append('id', user_id)
                    formData.append('action', 'saveUserAddress')
                    formData.append('address_id', address_id.val())
                    // let addressTextArea = $(document).find('[name="address_format"]')
                    // formData.append('address_format', addressTextArea.val())
                    axios({
                        method: 'post',
                        url: ajax,
                        data: formData
                    })
                        .then(function (response) {
                            var response_data = response.data;

                            if (response_data.status && !response_data.errors) {
                                createSuccessMessage();
                                window.location.reload()
                                // console.log(response_data);
                            } else {
                                createErrorPage(response_data.errors);
                            }
                        })
                        .catch(function (error) {
                            if (error.response) { // get response with a status code not in range 2xx
                                console.log(error.response.data);
                                console.log(error.response.status);
                                console.log(error.response.headers);
                            } else if (error.request) { // no response
                                console.log(error.request);
                                // instance of XMLHttpRequest in the browser
                                // instance ofhttp.ClientRequest in node.js
                            } else { // Something wrong in setting up the request
                                console.log('Error', error.message);
                            }
                            console.log(error.config);
                        })
                        .finally(function () {
                            setTimeout(function () {
                                indicatorDisable(elem)
                            }, 500);
                        });
                }
            })

        })
    }
    const onChangeAddressCity = () => {
        $(document).on('change', '[name="address_city_id"]', function () {
            let elem = $(this)
            if (changeAddressCity) {
                console.log("changeAddressCity")
                axios({
                    method: 'post',
                    url: ajax,
                    data: {
                        "_token": _token,
                        "action": "getCityGeo",
                        "city_id": elem.val()
                    }
                })
                    .then(function (response) {
                        var response_data = response.data;

                        if (response_data.status && !response_data.errors) {
                            var latlng = L.latLng(response_data.geo.latitude, response_data.geo.longitude);
                            mapVal.panTo(latlng);
                        } else {
                            // createErrorPage(response_data.errors);
                        }
                    })
            }
        });
    }
    const activeCurrentRegisteredLocation = (elem) => {
        elem.addClass('active');
        elem.removeClass('btn-secondary')
        elem.addClass('btn-primary')
    }
    const deactiveAllRegisteredLocation = () => {
        let elem = $('.registered-location')
        elem.each(function (index, item) {
            $(item).removeClass('active')
            $(item).removeClass('btn-primary')
            $(item).addClass('btn-secondary')
        })
    }
    const onClickRegisteredLocation = () => {
        $(document).on('click', '.registered-location', function () {
            let elem = $(this);
            let address_id = elem.data('location-id')
            changeAddressCity = false;
            if (address_id !== -1) {
                btnRemoveAddressElem.removeClass('d-none')
            }
            axios({
                url: ajax,
                method: "post",
                data: {
                    "_token": _token,
                    "action": "getUserAddressByid",
                    "address_id": address_id,
                    "user_id": user_id,
                }
            }).then(function (response) {
                var response_data = response.data;
                deactiveAllRegisteredLocation()
                activeCurrentRegisteredLocation(elem)
                if (response_data.status && !response_data.errors) {
                    var latlng = L.latLng(response_data.geo.latitude, response_data.geo.longitude);
                    $('[name="address_title"]').val(response_data.title)
                    $('[name="address_id"]').val(response_data.id)
                    $('[name="address_format"]').val(response_data.address)
                    $('[name="address_province_id"]').val(response_data.province_id).change()
                    $('[name="address[lat]"]').val(response_data.geo.latitude)
                    $('[name="address[lng]"]').val(response_data.geo.longitude)
                    if (mapMarker !== undefined) {
                        mapMarker.remove();
                    }
                    mapMarker = L.marker(latlng).addTo(mapVal)
                    mapVal.panTo(latlng);
                    setTimeout(function () {
                        $('[name="address_city_id"]').val(response_data.city_id).change()
                    }, 1000)
                } else {
                    createErrorPage(response_data.errors);
                }
            })
        })
    }
    const onClickAddNewAddress = () => {

        $(document).on('click', '.btn-empty-address-form', function () {
            btnRemoveAddressElem.addClass('d-none')
            deactiveAllRegisteredLocation()
            $('[name="address_title"]').val('');
            $('[name="address_province_id"]').val('').change();
            $('[name="address_city_id"]').val('').change();
            $('[name="address_format"]').val('')
            $('[name="address[lat]"]').val('')
            $('[name="address[lng]"]').val('')
            $('[name="city_lat"]').val('')
            $('[name="city_lng"]').val('')
            $('[name="address_id"]').val('')
            if (mapMarker) {
                mapMarker.remove()
            }
            setTimeout(function () {
                changeAddressCity = true
            }, 1000)
        })
    }
    const onClickRemoveAddress = () => {
        btnRemoveAddressElem.on('click', function () {
            let activeElem = $('.registered-location.active')
            let addressID = activeElem.data('location-id')
            if (addressID !== -1) {
                axios({
                    method: 'post',
                    url: ajax,
                    data: {
                        "_token": _token,
                        "action": "removeUserAddress",
                        "address_id": addressID,
                        "user_id": user_id
                    }
                })
                    .then(function (response) {
                        var response_data = response.data;

                        if (response_data.status && !response_data.errors) {
                            createSuccessMessage();
                            window.location.reload()
                        } else {
                            createErrorPage(response_data.errors);
                        }
                    })
                    .catch(function (error) {
                        if (error.response) { // get response with a status code not in range 2xx
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                        } else if (error.request) { // no response
                            console.log(error.request);
                            // instance of XMLHttpRequest in the browser
                            // instance ofhttp.ClientRequest in node.js
                        } else { // Something wrong in setting up the request
                            console.log('Error', error.message);
                        }
                        console.log(error.config);
                    })
            }

        })
    }


    //**********************************
    // General
    //**********************************
    const indicatorEnable = (submitButton) => {
        submitButton.prop('disabled', true);
        submitButton.attr('data-kt-indicator', 'on');
    }
    const indicatorDisable = (submitButton) => {
        submitButton.prop('disabled', false);
        submitButton.removeAttr('data-kt-indicator');
    }
    const onChangeTab = () => {
        var tabEl = $('a[data-bs-toggle="tab"]')
        tabEl.on('shown.bs.tab', function (event) {
            let target = $(event.target);
            let targetId = target.attr('href')
            if (targetId == '#address') {
                setTimeout(function () {
                    window.dispatchEvent(new Event("resize"));
                    mapVal.invalidateSize(true);
                }, 500);
            }
        })
    }
    const changeConfirmation = () => {
        $(document).on('click', '.change-confirmation', function () {
            let elem = $(this);
            let action = elem.data('action')
            let type = elem.data('type')
            let change_to = elem.data('change-to')
            axios({
                method: 'post',
                url: ajax,
                data: {
                    _token: _token,
                    "action": action,
                    "user_id": user_id,
                    "type": type,
                    "to": change_to
                },
            }).then(function (response) {
                if (response.data.status) {
                    Swal.fire({
                        text: trans("cpanel.Status changed successfully"),
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: trans('cpanel.Ok, got it!'),
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        window.location.reload()
                    })
                } else {
                    createErrorPage(response.data.errors)
                }
            })
        })
    }

    return {
        // Public functions
        init: function () {
            user_id = $('input[name="user_id"]').val();
            btnRemoveAddressElem = $('.btn-remove-address-form');
            addressForm = document.querySelector('#user_address');
            changeAddressCity = true;

            overviewTab();
            changeAvatar();
            addressMapInit();
            addressFormValidation();
            onChangeTab();
            saveAddress();
            changeConfirmation();
            onChangeAddressCity();
            onClickRegisteredLocation();
            onClickAddNewAddress();
            onClickRemoveAddress();
        }
    }
}
();
KTUtil.onDOMContentLoaded(function () {
    ProfileActions.init()
});
