// Function to submit payment method
$('#addPaymentMethodForm').on('submit', function (e) {
    e.preventDefault();  // Prevent default form submission

    // Collect form data
    const paymentType = $('#paymentType').val();
    let formData = {
        paymentType: paymentType
    };

    // Validate fields based on payment type
    if (paymentType === 'bank') {
        formData.accountName = $('#accountName').val();
        formData.swift = $('#swift').val();
        formData.iban = $('#iban').val();

        // Check required bank fields
        if (!formData.accountName || !formData.swift || !formData.iban) {
            Swal.fire({
                icon: 'error',
                title: 'Missing Fields',
                text: 'Please fill in all required bank account fields.'
            });
            return;
        }
    } else if (paymentType === 'credit') {
        formData.cardNumber = $('#cardNumber').val();
        formData.expirationDate = $('#expirationDate').val();
        formData.cvv = $('#cvv').val();

        // Check required credit card fields
        if (!formData.cardNumber || !formData.expirationDate || !formData.cvv) {
            Swal.fire({
                icon: 'error',
                title: 'Missing Fields',
                text: 'Please fill in all required credit card fields.'
            });
            return;
        }
    }
    
    function isValidExpirationDate(date) {
        if (!/^\d{2}\/\d{2}$/.test(date)) {
            return false;
        }
        const [month, year] = date.split('/');
        const currentYear = new Date().getFullYear() % 100;  // Last two digits of the current year
    
        return month >= 1 && month <= 12 && year >= currentYear;
    }
    
    // Example usage before form submission
    if (!isValidExpirationDate($('#expirationDate').val())) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Expiration Date',
            text: 'Please enter a valid expiration date in the format MM/YY.'
        });
        return;
    }

    // Display loading spinner
    Swal.fire({
        title: 'Processing...',
        text: 'Please wait while we save the payment method.',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // AJAX request to submit form
    $.ajax({
        url: '/organizer/paymentmethod/insert',  // Update with your CodeIgniter route
        type: 'POST',
        dataType: 'json',
        data: formData,
        success: function (response) {
            if (response.success) {
                // Close the modal and show success message
                $('#addPaymentMethodModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Payment method has been added successfully!'
                });

                // Optionally, reload the page or update the payment list dynamically
                $('#bankAccountTable').DataTable().ajax.reload(null, false);
                $('#creditCardTable').DataTable().ajax.reload(null, false);
            } else {
                let errorMessage = response.message;
                
                // If the error message is an object (e.g., validation errors), format it
                if (typeof errorMessage === 'object') {
                    errorMessage = Object.values(errorMessage).join('<br>'); // Concatenate errors into a single string
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: errorMessage || 'An error occurred while saving the payment method.'
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again later.'
            });
        }
    });
});


$(document).ready(function () {
    // Initialize DataTable
    var table = $('#bankAccountTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/organizer/paymentmethod/bankAccountTable",
            "type": "GET"
        },
        "columns": [
            { "data": "account_name" },
            {
                "data": "swift",
                "render": function (data, type, row) {
                    // Mask all but the last 3 characters of the swift code
                    return data.slice(0, -3).replace(/./g, 'x') + data.slice(-3);
                }
            },
            {
                "data": "iban",
                "render": function (data, type, row) {
                    // Mask all but the last 3 characters of the IBAN
                    return data.slice(0, -3).replace(/./g, 'x') + data.slice(-3);
                }
            },
            {
                "data": "active",
                "render": function (data, type, row) {
                    // Create a switcher for active/inactive state
                    var checked = data ? 'checked' : '';
                    return `
                        <div class="checkbox checbox-switch switch-success">
                            <label>
                                <input type="checkbox" class="toggle-active" value="enabled" data-id="${row.payment_method_id}" ${checked} />
                                <span></span>
                                Active
                            </label>
                        </div>`;
                }
            },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `<a href="javascript:void(0);" title="Edit" class="edit-btn" data-id="${row.payment_method_id}" style="color: blue;">
                                <i class="fa fa-edit" style="font-size: 18px;"></i></a>
                            <a href="#" title="Delete" class="delete-btn" data-id="${row.payment_method_id}" style="color: red;">
                                <i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
                }
            }
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.payment_method_id);
        },
        "initComplete": function (settings, json) {
            $(this).trigger('dt-init-complete');
        }
    });

    var creditCardTable = $('#creditCardTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/organizer/paymentmethod/creditCardTable",
            "type": "GET"
        },
        "columns": [
            {
                "data": "card_number",
                "render": function (data, type, row) {
                    // Mask all but the last 3 characters of the swift code
                    return data.slice(0, -3).replace(/./g, 'x') + data.slice(-3);
                }
            },
            { "data": "expiration_date" },
            { "data": "cvv" },
            {
                "data": "card_status",
                "render": function (data, type, row) {
                    // Create a switcher for active/inactive state
                    var checked = data ? 'checked' : '';
                    return `
                        <div class="checkbox checbox-switch switch-success">
                            <label>
                                <input type="checkbox" class="toggle-active" value="enabled" data-id="${row.payment_method_id}" ${checked} />
                                <span></span>
                                Active
                            </label>
                        </div>`;
                }
            },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `<a href="javascript:void(0);" title="Edit" class="edit-btn" data-id="${row.payment_method_id}" style="color: blue;">
                                <i class="fa fa-edit" style="font-size: 18px;"></i></a>
                            <a href="#" title="Delete" class="delete-btn" data-id="${row.payment_method_id}" style="color: red;">
                                <i class="fa fa-trash" style="font-size: 18px;"></i></a>`;
                }
            }
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data.payment_method_id);
        },
        "initComplete": function (settings, json) {
            $(this).trigger('dt-init-complete');
        }
    });

    // Toggle active status switch
    $(document).on('change', '.toggle-active', function () {
        var id = $(this).data('id');
        var active = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: '/organizer/paymentmethod/toggleActive/' + id,
            method: 'POST',
            data: { active: active },
            success: function (response) {
                if (response.status !== 'success') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update active status.'
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while updating status.'
                });
            }
        });
    });

    // Handle delete button click
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/organizer/paymentmethod/delete/' + id,
                    method: 'DELETE',
                    success: function (response) {
                        if (response.status === 'success') {
                            table.row(row).remove().draw(false);
                            creditCardTable.row(row).remove().draw(false);
                            Swal.fire(
                                'Deleted!',
                                'Payment method has been deleted.',
                                'success'
                            );
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong with the request!'
                        });
                    }
                });
            }
        });
    });
    $(document).ready(function() {
        $('#expirationDate').on('input', function(e) {
            let input = $(this).val();
            
            // Remove any non-digit characters except "/"
            input = input.replace(/[^0-9\/]/g, '');
    
            // Automatically add "/" after the first two digits, if necessary
            if (input.length > 2 && input[2] !== '/') {
                input = input.slice(0, 2) + '/' + input.slice(2);
            }
    
            // If the user is deleting the year and hits the "/" character
            if (e.originalEvent.inputType === 'deleteContentBackward') {
                if (input.length === 3) {
                    // If deleting and we're at the position of "/"
                    input = input.substring(0, 2); // Remove the "/"
                }
            }
    
            // Ensure the input does not exceed 5 characters (MM/YY)
            $(this).val(input.slice(0, 5));
        });
    
        // Optional: Handle backspace specifically to allow deletion of "/"
        $('#expirationDate').on('keydown', function(e) {
            let key = e.key;
            let input = $(this).val();
    
            // Allow backspacing through the "/" by manually adjusting the caret
            if (key === 'Backspace' && input.length === 3) {
                $(this).val(input.substring(0, 2)); // Remove the "/" on backspace
                e.preventDefault();  // Prevent default behavior to avoid further deletion
            }
        });
    });
    
});
function togglePaymentFields() {
    var paymentType = document.getElementById('paymentType').value;
    var bankFields = document.getElementById('bankFields');
    var creditCardFields = document.getElementById('creditCardFields');

    if (paymentType === 'bank') {
        bankFields.style.display = 'block';
        creditCardFields.style.display = 'none';
    } else if (paymentType === 'credit') {
        bankFields.style.display = 'none';
        creditCardFields.style.display = 'block';
    }
}

function submitPaymentMethod() {
    var form = document.getElementById('addPaymentMethodForm');
    // You can perform form validation or handle submission here
    form.submit();
}
