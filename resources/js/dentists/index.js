const dentist = function () {
    let tableID = "#dentists_table";
    let table, editBtn, removeBtn;

    let redirect = function (elem) {
        let rows = table.querySelector('tr.selected');
        let id = '-id-';
        if (rows) {
            id = rows.getAttribute('id');
        }

        let editUrl = elem.getAttribute('data-url').replace('-id-', id);

        if (id !== '-id-') {
            window.location.href = editUrl;
        } else {
            alert('هیچ ردیفی انتخاب نشده است')
        }
    }
    let onClickEdit = function () {
        editBtn.addEventListener('click', function (e) {
            redirect(this)

        })
    }
    let onClickRemove = function () {
        if (removeBtn){
            removeBtn.addEventListener('click', function (e) {
                redirect(this)
            })
        }

    }

    let birthDate = function () {
        let birthdate = $('#birth_date');
        birthdate.pDatepicker({
            "inline": false,
            "format": "YYYY/MM/DD",
            "viewMode": "year",
            "initialValue": true,
            "minDate": null,
            "maxDate": null,
            "autoClose": false,
            "position": "auto",
            "onlyTimePicker": false,
            "onlySelectOnDate": false,
            "calendarType": "persian",
            "inputDelay": 800,
            "observer": true,
            "calendar": {
                "persian": {
                    "locale": "fa",
                    "showHint": true,
                    "leapYearMode": "algorithmic"
                },
                "gregorian": {
                    "locale": "en",
                    "showHint": true
                }
            },
            "navigator": {
                "enabled": true,
                "scroll": {
                    "enabled": true
                },
                "text": {
                    "btnNextText": "<",
                    "btnPrevText": ">"
                }
            },
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
                "step": 1,
                "hour": {
                    "enabled": true,
                    "step": null
                },
                "minute": {
                    "enabled": true,
                    "step": null
                },
                "second": {
                    "enabled": true,
                    "step": null
                },
                "meridian": {
                    "enabled": true
                }
            },
            "dayPicker": {
                "enabled": true,
                "titleFormat": "YYYY MMMM"
            },
            "monthPicker": {
                "enabled": true,
                "titleFormat": "YYYY"
            },
            "yearPicker": {
                "enabled": true,
                "titleFormat": "YYYY"
            },
            "responsive": true
        });
    }

    return {
        'init': () => {
            table = document.querySelector(tableID);
            editBtn = document.querySelector('.edit-dentists');
            removeBtn = document.querySelector('.remove-dentists');
            onClickEdit();
            onClickRemove();
            birthDate();
        }
    }
}();

document.addEventListener("DOMContentLoaded", function (event) {
    dentist.init();


});
