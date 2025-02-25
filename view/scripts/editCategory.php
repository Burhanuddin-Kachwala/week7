<script>
    $(document).ready(function() {
        $(document).on('click', '#editCategoryBtn', function(event) {
            event.preventDefault();

            var category = $(this).data('old');
            var oldCategory = $(this).data('old');
        
        // Set the old category value in the hidden input field
            $('#old').val(oldCategory);
        
            $('#edit_categoryName').val(category);
            console.log(category);
        });

        $('#editCategoryForm').validate({
            rules: {
                edit_categoryName: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                edit_categoryName: {
                    required: "Please enter a category name",
                    minlength: "Category name must be at least 3 characters long"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: '/edit-category',
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            $('#categorys-toast').html(response.message || "An error occurred").addClass("bg-green-500").fadeIn().delay(3000).fadeOut();
                            // Clear the form input

                            $('#categoryName').val('');
                            setTimeout(function() {
                                $('#edit-category-modal').click();
                            }, 500);
                        } else {

                            showToast(response.message || "An error occurred", "failure");
                            $('#categorys-toast').html(response.message || "An error occurred").addClass("bg-red-500").fadeIn().delay(3000).fadeOut();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        $('#categorys-toast').html(response.message || "An error occurred").addClass("bg-red-500").fadeIn().delay(3000).fadeOut();
                    }
                });
            }
        });
    });

    
</script>
<?php require('toastMessage.php');?>