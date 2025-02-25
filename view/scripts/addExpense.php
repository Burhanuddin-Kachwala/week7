<script>
    $(document).ready(function() {
        // Validate the form using jQuery validation
        $("#expenseForm").validate({
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
                    max: new Date().toISOString().split("T")[0] // Limit date to today
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
                // Prevent default form submission
                event.preventDefault();

                // Collect form data
                var formData = $(form).serialize(); // Serialize the form data

                // Send data via AJAX
                $.ajax({
                    type: 'POST',
                    url: '/add-expense', // The PHP endpoint to process the form
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Show success toast message
                            showToast(response.message, 'success');

                            // Optionally, reset the form
                            $('#expenseForm')[0].reset();
                            setTimeout(function() {
                                $('#add-expense-modal').click();
                            }, 500);
                            // Fetch the updated expenses list



                            // Second AJAX Request: Fetch Updated Expenses
                            $.ajax({
                                url: 'fetchExpenses', // Updated to correct PHP file
                                type: 'GET',
                                success: function(response) {
                                    console.log(response);
                                    // // Update the expenses container with the new data
                                     $('.expense-container').html(response);

                                    // Show toast message for success
                                   // showToast(response.errors.join(', '), 'error');
                                },
                                error: function(error) {
                                    // alert('Failed to load expenses.' + error);
                                }
                            });


                        } else if (response.status === 'error') {
                            // Show error toast message
                            showToast('An error occured', 'error');
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