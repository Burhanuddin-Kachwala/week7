<script>
$(document).ready(function() {
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
