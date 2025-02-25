
<script>

    $(document).ready(function() {
        // Validate the form using jQuery validation
        $("#categoryForm").validate({
            rules: {
                categoryName: {
                    required: true,
                    minlength: 2
                }
            },
            messages: {
                categoryName: {
                    required: "Please enter a category name",
                    minlength: "Category name must be at least 2 characters long"
                }
            },
            errorPlacement: function(error, element) {
                error.addClass('text-red-500 text-sm mt-1');
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                // Prevent the default form submission
                event.preventDefault();

                // Get the category name value
                const categoryName = $('#categoryName').val();

                // AJAX request to add category
                $.ajax({
                    type: 'POST', // Ensure the request method is POST
                    url: '/add-category', // Your PHP endpoint
                    data: {
                        categoryName: categoryName
                    },
                    success: function(response) {
                        console.log("AJAX Success:", response);

                        // Check if the response indicates success
                        if (response.status === 'success') {
                            //showToast(response.message, 'success');
                            $('#category-toast').html(response.message || "An error occurred").addClass("bg-green-500").fadeIn().delay(3000).fadeOut();
                            // Clear the form input

                            $('#categoryName').val('');
                            setTimeout(function() {
                                $('#add-category-modal').click();
                            }, 500);
                        } else {

                            $('#category-toast').html(response.message || "An error occurred").addClass("bg-red-500").fadeIn().delay(3000).fadeOut();

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", error);
                        //showToast("Something went wrong. Please try again.", "bg-red-500");
                        $('#category-toast').html(response.message || "An error occurred").addClass("bg-red-500").fadeIn().delay(3000).fadeOut();
                    }
                });

               

            }
        });
    });
</script>
<?php require('toastMessage.php');?>