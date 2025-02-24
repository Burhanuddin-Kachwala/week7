<script>
    $(document).ready(function() {
        // Attach a click event handler to the anchor element

        jQuery(document).on('click', '#editBtn', function(event) {
            event.preventDefault();
            // Refresh the form fields
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

            // Populate the form fields with the data
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

            $('#category option').each(function() {
                if ($(this).text().trim() === category) {
                    $('#category').val($(this).val());
                }
            });
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
                // Show success toast message
                $('<div class="toast">Expense added successfully!</div>').appendTo('body').fadeIn(400).delay(3000).fadeOut(400, function() {
                    $(this).remove();
                });
                form.submit();
            }
        });
        }
    );
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
                // Show success toast message
                $('<div class="toast">Expense added successfully!</div>').appendTo('body').fadeIn(400).delay(3000).fadeOut(400, function() {
                    $(this).remove();
                });
                form.submit();
            }
        });
    });
</script>