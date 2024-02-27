"use strict";
let DataTableActions = function () {
    // Define shared variables
    var table = $('#admins_table');
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    var initTable = () => {
        if ($.fn.dataTable.isDataTable('#admins_table')) {
            datatable = $('#admins_table').DataTable();
        }
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = $('[data-table-filter="search"]');
        filterSearch.on('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    var handleFilterDatatable = () => {
        // Select filter options
        const filterForm = $('[data-kt-user-table-filter="form"]');
        const filterButton = filterForm.find('[data-kt-user-table-filter="filter"]');
        const selectOptions = filterForm.find('select');

        // Filter datatable on submit
        filterButton.on('click', function () {
            var filterString = '';

            // Get filter values
            selectOptions.each((index, item) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }

                    // Build filter value options
                    filterString += item.value;
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search(filterString).draw();
        });
    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = $('[data-kt-user-table-filter="reset"]');

        // Reset datatable
        resetButton.on('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.each(function (index, select) {
                {
                    $(select).val('').trigger('change');
                }
            });

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search('').draw();
        });
    }

// Delete Row
    const handleDeleteRow = () => {
        $(document).on('click','#data-table-remove',function(){
            let elem = $(this);
            let id = elem.closest('tr').attr('id');
            Swal.fire({
                text: trans('cpanel.delete_action_question'),
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: trans('cpanel.yes'),
                cancelButtonText: trans('cpanel.no'),
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    axios({
                        method: 'get',
                        url   : route_destroy.replace('-id-', id),
                        data  : {
                            _token: _token
                        },
                    }).then(function (response) {
                        if (response.data.status){
                            Swal.fire({
                                text: trans("cpanel.The deletion was successful"),
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: trans('cpanel.Ok, got it!'),
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                // Remove current row
                                datatable.row($(parent)).remove().draw();
                            })
                        }else {
                            Swal.fire({
                                text: response.data.message,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: trans('cpanel.Ok, got it!'),
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            })
                        }

                    })

                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: trans("cpanel.Operation failed"),
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: cpanel("cpanel.Ok, got it!"),
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        })

    }

    // Init toggle toolbar
    var initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.find('[type="checkbox"]');

        // Select elements
        toolbarBase = $('[data-admin-table-toolbar="base"]');
        toolbarSelected = $('[data-admin-table-toolbar="selected"]');
        selectedCount = $('[data-table-select="selected_count"]');
        const deleteSelected = $('[data-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.each(function (index, item) {
            $(item).on('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.on('click', function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: trans('cpanel.delete_action_question'),
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: trans('cpanel.yes'),
                cancelButtonText: trans('cpanel.no'),
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    let rows = [];
                    let selected = $('input[name="check-child[]"]')

                    $.each(selected, function (index, item) {
                        let elem = $(item);
                        if (elem.prop('checked')) {
                            rows.push(elem.val())
                        }

                    })
                    axios({
                        method: 'post',
                        url: ajax,
                        data: {
                            _token: _token,
                            action: "remove_rows",
                            rows: rows
                        },
                    })
                        .then(function (response) {
                            var response_data = response.data;

                            if (response_data.status && !response_data.errors) {
                                createSuccessMessage();
                                datatable.ajax.reload();
                                window.LaravelDataTables[table].ajax.reload();

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
                        }).finally(function () {
                        toggleToolbars();
                    })
                }
            });
        });
    }

    // Toggle toolbars
    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements
        const allCheckboxes = table.find('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.each(function (index, item) {
            if ($(item).prop('checked')) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.addClass('d-none');
            toolbarSelected.removeClass('d-none');
        } else {
            toolbarBase.removeClass('d-none');
            toolbarSelected.addClass('d-none');
        }
    }

    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }
            initTable();
            initToggleToolbar();
            handleSearchDatatable();
            handleResetForm();
            handleFilterDatatable();
            handleDeleteRow();

        }
    }
}();
KTUtil.onDOMContentLoaded(function () {


});
