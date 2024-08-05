$(document).ready(function() {
    const username = localStorage.getItem('username');
    if (!username) {
        window.location.href = 'index.html';
        return;
    }

    $.ajax({
        url: 'php/profile.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            const profileDiv = $('#profileData');
            profileDiv.html(`
                <p>Name: ${data.name}</p>
                <p>Username: ${data.username}</p>
                <p>Phone: ${data.phone}</p>
                <p>Date of Birth: ${data.dob}</p>
                <p>Age: ${data.age}</p>
            `);
        },
        error: function() {
            alert('Error fetching profile data');
        }
    });
});
