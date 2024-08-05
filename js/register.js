$(document).ready(function() {
    $('#registerForm').submit(function(event) {
        event.preventDefault();

        let phone = $('#phone').val();
        if (!/^\d{10}$/.test(phone)) {
            alert('Phone number must be a 10-digit number');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'php/register.php',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
            },
            error: function() {
                alert('Error registering');
            }
        });
    });
});
