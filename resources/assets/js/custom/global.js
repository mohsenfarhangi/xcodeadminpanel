window.getErrors = function (error) {
    let array = error.response.data.errors;
    let html = "<ul>";
    for (let element in array) {
        html += "<li>" + element[0] + "</li>";
    }
    html += "</ul>";

    return html;
}

window.datepicker = function () {
    $(".pdatepicker").pDatepicker({
        "format": "YYYY/MM/DD",
        "minDate": null,
        "maxDate": null,
        "autoClose": true,
        "position": "auto",
        "onlyTimePicker": false,
        "onlySelectOnDate": true,
        "calendarType": "persian",
        "inputDelay": 800,
        "observer": true,
        "toolbox": {
            "enabled": true,
            "calendarSwitch": {
                "enabled": true,
                "format": "MMMM"
            },
            "todayButton": {
                "enabled": true,
                "text": {
                    "fa": "امروز",
                    "en": "Today"
                }
            },
            "submitButton": {
                "enabled": true,
                "text": {
                    "fa": "تایید",
                    "en": "Submit"
                }
            },
            "text": {
                "btnToday": "امروز"
            }
        },
        "timePicker": {
            "enabled": false,
        },
        "responsive": true
    });
}
window.createSuccessMessage = function () {
    Swal.fire({
        title: trans('cpanel.register'),
        text: trans('cpanel.success_in_action'),
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: trans('cpanel.ok_in_action'),
        customClass: {
            confirmButton: "btn btn-success",
        }
    });
};

window.createNoCompleteMessage = function () {
    Swal.fire({
        title: trans('cpanel.error'),
        text: trans('cpanel.not_complete_info_in_action'),
        icon: "warning",
        buttonsStyling: false,
        confirmButtonText: trans('cpanel.ok_in_action'),
        customClass: {
            confirmButton: "btn btn-warning",
        }
    });
};

window.createErrorMessage = function () {
    Swal.fire({
        title: trans('cpanel.register'),
        text: trans('cpanel.error_in_action'),
        icon: "error",
        buttonsStyling: false,
        confirmButtonText: trans('cpanel.ok_in_action'),
        customClass: {
            confirmButton: "btn btn-danger",
        }
    });
};

window.createErrorPage = function (errors) {
    let ul = document.createElement("ul");
    $(ul)
        .addClass('list-error')
        .addClass('text-start');

    if (Array.isArray(errors) || (typeof errors === 'object')) {
        $.each(errors, function (index, item) {
            $(ul).append('<li class="alert-title">' + item + '</li>');
        });
    } else {
        $(ul).append('<li class="alert-title">' + errors + '</li>');
    }

    Swal.fire({
        title: trans('cpanel.error'),
        html: ul,
        icon: "error",
        buttonsStyling: false,
        confirmButtonText: trans('cpanel.ok_in_action'),
        customClass: {
            confirmButton: "btn btn-warning",
        }
    });
};

window.createErrorAlert = function (errors) {
    console.log(errors);
    let ul = document.createElement("ul");
    $(ul).addClass('list-error');

    $.each(errors, function (index, item) {
        $(ul).append('<li class="alert-title">' + item + '</li>');
    });

    $(".col-alert").html(
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
        '</div>');
    $(".col-alert .alert").append(ul);
};

window.digitSeparator = function (strDigit) {
    let number = "";

    if (strDigit === null) strDigit = 0;

    strDigit = strDigit.toString();

    if (strDigit !== "") {
        if (strDigit.substring(0, 1) === '-') {
            strDigit = Math.abs(strDigit);
            number += "-";
        }

        let cc = strDigit.toString().length % 3;

        if (cc === 2) cc += 2;
        else if (cc === 1) cc++;

        for (let i = 0; i < strDigit.toString().length; i++) {
            cc++;
            number += strDigit.toString().substr(i, 1);
            if ((strDigit < 0) && (i < 3) && (cc % 3 === 0)) cc--;
            if ((cc % 3 === 0) && (i < (strDigit.toString().length - 1))) number += ",";
        }
    }

    return number;
};

window.showLoader = function () {
    $("body")
        .addClass('overflow-hidden')
        .append('<div class="page-loader"><div class="row-loader"><div class="icon-loader"></div></div></div>');
};

window.hiddenLoader = function () {
    $("body").removeClass('overflow-hidden');
    $(".page-loader").remove();
};

window.specialChar = function (e) {
    let keyCode = (e.which) ? e.which : e.keyCode;
    return ((keyCode == 8)/*backspace*/ || ((!(e.which)) && ((keyCode == 9)/*tab*/ || (keyCode == 35)/*end*/ || (keyCode == 36)/*home*/ || (keyCode == 37)/*left*/ || (keyCode == 39)/*right*/ || (keyCode == 46)/*delete*/ || (keyCode == 116)/*F5*/)))
};

const getPolygon = function (latlngs) {
    let inputVal = [];
    $.each(latlngs, function (index, item) {
        inputVal.push([item.lat, item.lng]);
    });
    console.log([inputVal])
    $(document).find('input[name="polygon"]').val([inputVal])
}

const getPolygonCenter = function (layer) {
    let center = layer.getBounds().getCenter();
    let latlng = center.lat + "," + center.lng;
    $('input[name="center_geo"]').val(latlng)
}

const changeSelectOptions = (data, selectElem, emptyOptionTxt) => {
    selectElem.html("");
    let opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = emptyOptionTxt;
    selectElem.append(opt);
    $.each(data, function (index, item) {
        opt = document.createElement('option');
        opt.value = item.id;
        opt.innerHTML = item.name;
        selectElem.append(opt);
    })
};

window.chatrUploadFile = (id, action) => {

    const dropzone = document.querySelector(id);

    if (dropzone) {
// set the preview element template
        var previewNode = dropzone.querySelector(".dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
            url: ajax + "?action=" + action, // Set the url for your upload script location
            parallelUploads: 1,
            previewTemplate: previewTemplate,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            maxFilesize: 5, // Max filesize in MB
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
        });

        myDropzone.on("addedfile", function (file) {
            // Hookup the start button
            file.previewElement.querySelector(id + " .dropzone-start").onclick = function () {
                myDropzone.enqueueFile(file);
            };
            const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
            dropzoneItems.forEach(dropzoneItem => {
                dropzoneItem.style.display = '';
            });
            dropzone.querySelector('.dropzone-upload').style.display = "inline-block";
            dropzone.querySelector('.dropzone-select').style.display = "none";
            dropzone.querySelector('.dropzone-remove-all').style.display = "inline-block";
        });

// Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            const progressBars = dropzone.querySelectorAll('.progress-bar');
            progressBars.forEach(progressBar => {
                progressBar.style.width = progress + "%";
            });
        });

        myDropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            const progressBars = dropzone.querySelectorAll('.progress-bar');
            progressBars.forEach(progressBar => {
                progressBar.style.opacity = "1";
            });
            // And disable the start button
            file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
        });

// Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("complete", function (progress) {
            const progressBars = dropzone.querySelectorAll('.dz-complete');

            setTimeout(function () {
                progressBars.forEach(progressBar => {
                    progressBar.querySelector('.progress-bar').style.opacity = "0";
                    progressBar.querySelector('.progress').style.opacity = "0";
                    progressBar.querySelector('.dropzone-start').style.opacity = "0";
                });
            }, 300);
        });

// Setup the buttons for all transfers
        dropzone.querySelector(".dropzone-upload").addEventListener('click', function () {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        });

// Setup the button for remove all files
        dropzone.querySelector(".dropzone-remove-all").addEventListener('click', function () {
            dropzone.querySelector('.dropzone-upload').style.display = "none";
            dropzone.querySelector('.dropzone-remove-all').style.display = "none";
            myDropzone.removeAllFiles(true);
        });

// On all files completed upload
        myDropzone.on("queuecomplete", function (progress) {
            const uploadIcons = dropzone.querySelectorAll('.dropzone-upload');
            uploadIcons.forEach(uploadIcon => {
                uploadIcon.style.display = "none";
            });
        });

// On all files removed
        myDropzone.on("removedfile", function (file) {
            if (myDropzone.files.length < 1) {
                dropzone.querySelector('.dropzone-upload').style.display = "none";
                dropzone.querySelector('.dropzone-remove-all').style.display = "none";
                dropzone.querySelector('.dropzone-select').style.display = "inline-block";
            }
        });

        return myDropzone;
    }
}

const globalActions = function () {

    const getCity = () => {
        $(document).on('change', '[data-select="state"]', function () {
            let elem = $(this);
            axios({
                method: 'post',
                url: ajax,
                data: {
                    _token: _token,
                    'state': elem.val(),
                    'action': "getCity"
                },
            })
                .then(function (response) {
                    let response_data = response.data;
                    if (response_data.status && !response_data.errors) {
                        let selectElem = $('[data-show="city"]');
                        changeSelectOptions(response_data.cities, selectElem, trans('cpanel.city'))
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
        })
    }

    const changeCity = () => {
        /**
         * First, use the city:changeAction trigger to change the action.
         * Example:
         * city.trigger("city:changeAction",['getRegions']);
         * Then use the changeCityAction event to perform the operation after changing the city.
         * Example:
         * city.on('city:afterGetData',function (e, data) {
         *         let selectElem = $('[data-show="region"]');
         *         changeSelectOptions(data.regions,selectElem,trans('cpanel.region'));
         *     })
         */

        let changeCityAction = '';
        $(document).on('city:changeAction', '[data-select="city"]', function (e, action) {
            changeCityAction = action;
        });
        /**
         * change city
         */
        $(document).on('change', '[data-select="city"]', function () {
            let elem = $(this);
            if (changeCityAction != '') {
                axios({
                    method: 'post',
                    url: ajax,
                    data: {
                        _token: _token,
                        'city_id': elem.val(),
                        'action': changeCityAction
                    },
                })
                    .then(function (response) {
                        let response_data = response.data;
                        if (response_data.status && !response_data.errors) {
                            elem.trigger('city:afterGetData', [response_data])
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
            }
        })
    }

    const getUsers = () => {
        let elem = $(document).find('[data-select="users"]');
        let user_id = elem.data('user_id');
        if (elem.length > 0) {
            elem.select2({
                dir: "rtl",
                ajax: {
                    url: ajax,
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            'action': "getUsers",
                            _token: _token,
                            'user_id': user_id
                        }
                        return query;
                    }
                }
            });
        }

    }

    const getShiftWork = () => {
        let elem = $(document).find('[data-select="shift-work"]');
        let shift_work_id = elem.data('shift_work_id');
        if (elem.length > 0) {
            elem.select2({
                dir: "rtl",
                ajax: {
                    url: ajax,
                    dataType: 'json',
                    data: function (params) {
                        let city = $(document).find('[name="city_id"]');
                        let city_id = 0;
                        if (city.length > 0) {
                            city_id = $(document).find('[name="city_id"]').val()
                        }
                        console.log(city_id)

                        var query = {
                            search: params.term,
                            'action': "getShiftWork",
                            _token: _token,
                            'shift_work_id': shift_work_id,
                            'city_id': city_id,
                        }
                        return query;
                    }
                }
            });
        }

    }

    const getDrivers = () => {
        let elem = $(document).find('[data-select="drivers"]');
        if (elem.length > 0) {
            elem.select2({
                dir: "rtl",
                ajax: {
                    url: ajax,
                    dataType: 'json',
                    data: function (params) {
                        let input = $(document).find('[name="shift_work_id"]');
                        let shiftWorkId = 0;
                        if (input.length > 0) {
                            shiftWorkId = input.val()
                        }
                        var query = {
                            search: params.term,
                            'action': "getDrivers",
                            _token: _token,
                            'shift_work_id': shiftWorkId
                        }
                        return query;
                    }
                }
            });
        }

    }

    return {
        init: function () {
            getCity();
            changeCity();
            getShiftWork();
            getDrivers();
            getUsers();
        }
    }
}()
// On document ready
KTUtil.onDOMContentLoaded(function () {
    if (window.livewire) {
        window.livewire.hook('message.processed', function (message, component) {
            if (component.el.className === 'modal_cred') {
                var myModal = new bootstrap.Modal('#btn_modal_cred')
                myModal.show()
            }
            if (component.el.className === 'modal_import') {
                var myModal = new bootstrap.Modal('#btn_modal_cred')
                myModal.show()
            }
            KTApp.init();
            window.datepicker()
        })
    }

    if ($(document).find("#import_file_zone").length > 0) {
        let elem = $(document).find("#import_file_zone");
        let url = ajax + "?action=" + elem.data('action');
        window.ImportFileDropZone = new Dropzone("#import_file_zone", {
            url: url, // Set the url for your upload script location
            acceptedFiles: ".xls,.xlsx",
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (file, response) {
                createSuccessMessage()
            },
            error: function (file, response) {
                return false;
            }
        });
    }

    globalActions.init();
    window.datepicker()

});
(function ($) {
    $(document).on('click', '.button-ajax', function (e) {
        e.preventDefault();
        var elem = $(this);
        var action = elem.data('action');
        var method = 'post'
        var csrf = elem.data('csrf');
        var reload = elem.data('reload');
        elem.attr('disabled', true);
        elem.attr('data-kt-indicator', 'on');
        axios.request({
            url: ajax,
            method: method,
            data: {
                _token: csrf,
                action: action
            },
        }).then(function (response) {
            elem.trigger('button-ajax:success', {"elem": elem, "response": response});
        })
            .catch(function (error) {
                window.createErrorPage(error.response.data.errors);
            })
            .finally(function () {
                $(this).attr('disabled', false);
                $(this).removeAttr('data-kt-indicator');
                if (reload) {
                    window.location.reload();
                }
            });
    });

    /*******************************
     * Number Text Box
     * */
    $(document).on("keypress", ".text-number", function (e) {
        let mask = /^\d+$/;
        let keyCode = (e.which) ? e.which : e.keyCode;
        let part1 = this.value.substring(0, this.selectionStart);
        let part2 = this.value.substring(this.selectionEnd, this.value.length);

        if (specialChar(e)) return true;
        if (keyCode == 32) return false;
        // if (!mask.test(part1 + String.fromCharCode(keyCode) + part2)) return false;
    });

    /*******************************
     * Currency Text Box
     * */
    $(document).on("keypress", ".text-currency", function (e) {
        let mask = /^\d+$/;
        let keyCode = (e.which) ? e.which : e.keyCode;
        let thisValue = this.value.replace(/,/g, '');
        let part1 = thisValue.substring(0, this.selectionStart.toString().replace(/,/g, ''));
        let part2 = thisValue.substring(this.selectionEnd.toString().replace(/,/g, ''), thisValue.length);

        if (specialChar(e)) return true;
        if (!mask.test(part1 + String.fromCharCode(keyCode) + part2)) return false;
    });

    $(document).on("keyup", ".text-currency", function (e) {
        let thisValue = this.value.replace(/,/gi, '');
        let thisValueLength = thisValue.length;
        if (thisValueLength > 0) this.value = digitSeparator(thisValue);
    });
})(jQuery);

