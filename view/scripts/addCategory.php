<script>
$(document).ready(function() {
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
            // Show success toast message
            $('<div class="toast">Category added successfully!</div>').appendTo('body').fadeIn(400).delay(3000).fadeOut(400, function() {
                $(this).remove();
            });
            form.submit();
        }
    });

   
});
</script>