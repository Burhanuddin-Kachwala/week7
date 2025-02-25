<script>
    $(document).ready(function() {
        // Validate the form using jQuery validation

        // AJAX request to add category
        $('#deleteCategory').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission          
            var form = $(this);
            var formData = form.serialize(); // Serialize the form data

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                dataType: 'json', // Expecting JSON response
                success: function(response) {
                    console.log("AJAX Success:", response);

                    if (response.status === 'success') {
                        $('#dashboard-toast').html(response.message || "An error occurred").addClass("bg-green-500").fadeIn().delay(3000).fadeOut();
                        showToast("Data Deleted successfully!", 'success');

                    } else {
                        $('#dashboard-toast').html(response.message || "An error occurred").addClass("bg-red-500").fadeIn().delay(3000).fadeOut();
                        showToast(response.message || "An error occurred", "failure");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                    $('#dashboard-toast').html(response.message || "An error occurred").addClass("bg-red-500").fadeIn().delay(3000).fadeOut();
                    showToast("Something went wrong. Please try again.", "bg-red-500");
                }
            });
        });
    });
</script>
<?php require('toastMessage.php'); ?>