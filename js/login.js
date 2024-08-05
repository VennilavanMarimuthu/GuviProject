$(document).ready(function() {
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: $(this).serialize(),
            success: function(response) {
                if (response === 'success') {
                    localStorage.setItem('username', $('#username').val());
                    window.location.href = 'profile.html';
                } else {
                    alert('Invalid username or password');
                }
            },
            error: function() {
                alert('Error logging in');
            }
        });
    });
});
