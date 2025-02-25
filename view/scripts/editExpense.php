<script>
$(document).ready(function() {
    // Attach click event handler to the 'Edit' button
    jQuery(document).on('click', '#editBtn', function(event) {
        event.preventDefault();

        // Clear the form fields
        $('#id').val('');
        $('#amount').val('');
        $('#category').val('');
        $('#description').val('');
        $('#date').val('');

        // Get data attributes
        var expenseId = $(this).data('expense-id');
        var id = $(this).data('id');
        var amount = $(this).data('amount');
        var category = $(this).data('category');
        var description = $(this).data('description');
        var date = $(this).data('date');

        // Populate form fields with data
        $('#id').val(id);
        $('#amount').val(amount);
        $('#category').val(category);
        $('#description').val(description);
        $('#date').val(date);
        console.log('Edit expense modal opened with data:', {
            expenseId,
            id,
            amount,
            category,
            description,
            date
        });

        // Select category based on the data
        $('#category option').each(function() {
            if ($(this).text().trim() === category) {
                $('#category').val($(this).val());
            }
        });
    });

    // Form validation and AJAX form submission
    $(".expenseForm").validate({
        rules: {
            amount: {
                required: true,
                number: true,
                min: 0
            },
            category: {
                required: true
            },
            description: {
                required: true
            },
            date: {
                required: true,
                date: true,
                max: new Date().toISOString().split("T")[0]
            }
        },
        messages: {
            amount: {
                required: "Please enter an amount",
                number: "Please enter a valid number",
                min: "Amount cannot be negative"
            },
            category: {
                required: "Please select a category"
            },
            description: {
                required: "Please enter a description"
            },
            date: {
                required: "Please select a date",
                date: "Please enter a valid date",
                max: "Date cannot be in the future"
            }
        },
        errorPlacement: function(error, element) {
            error.addClass('text-red-500 text-sm mt-1');
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            // Collect form data
            var formData = $(form).serialize();

            // Send the form data via AJAX
            $.ajax({
                type: 'POST',
                url: '/edit-expense', // PHP endpoint to handle the request
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                       
                        // Show success toast message
                        showToast(response.message, 'success');

                        // Optionally reset the form
                        $('#expenseForm')[0].reset();

                        // Close modal or reset after success
                        setTimeout(function() {
                            $('#edit-expense-modal').click(); // Example: Hide the modal
                        }, 500);
                        // Fetch the updated expenses list (optional)
                    } else if (response.status === 'error') {
                        // Show error toast message
                        showToast(response.errors.join(', '), 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                    showToast("Something went wrong. Please try again.", 'error');
                }
            });
        }
    });

   
});

</script>
<?php require('toastMessage.php') ?>