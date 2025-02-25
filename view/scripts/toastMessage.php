<script>
const SUCCESS_CLASS = 'bg-green-500';
const FAILURE_CLASS = 'bg-red-500';

function showToast(message, status) {
    console.log('Showing toast message:', message, status);
    const bgColor = status === 'success' ? SUCCESS_CLASS : FAILURE_CLASS;

    // Set the toast message text
    $('#toast-message').text(message);

    // Set the background color for success or failure
    $('#toast-message').removeClass(SUCCESS_CLASS + ' ' + FAILURE_CLASS).addClass(bgColor);

    // Show the toast message
    $('#toast-message').removeClass('hidden').fadeIn(400)
        .delay(3000) // Show the message for 3 seconds
        .fadeOut(400, function() {
            $(this).addClass('hidden'); // Hide the toast after fade out
        });
}
</script>
