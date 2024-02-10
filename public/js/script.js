function uncheckOthers(checkboxId) {
    var checkboxes = document.getElementsByName('kat');
    checkboxes.forEach(function (checkbox) {
        if (checkbox.id !== checkboxId) {
            checkbox.checked = false;
        }
    });
}

function validateForm() {
    var checkboxes = document.getElementsByName('kat');
    var checkedCount = 0;

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            checkedCount++;
        }
    });

    if (checkedCount !== 1) {
        alert('Please select exactly one category.');
        return false;
    }

    return true;
}
document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    mobileMenuToggle.addEventListener('click', function () {
        navLinks.classList.toggle('show');
    });
});

function deleteCard(event) {
    event.preventDefault(); // Prevent the default behavior of the link

    var link = event.target; // The clicked link
    var cardContainer = document.getElementById('cardContainer');

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Update the card container with the new content
            cardContainer.innerHTML = xhr.responseText;
        }
    };

    // Get the href attribute from the clicked link
    var deleteUrl = link.getAttribute('href');

    xhr.open('GET', deleteUrl, true);
    xhr.send();
}

function switchForm() {
    var loginForm = document.querySelector('.form-signin');
    var signupForm = document.querySelector('.form-signup');

    if (loginForm.style.display !== 'none') {
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';
    } else {
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';
    }
}


document.addEventListener("DOMContentLoaded", function() {
    // Function to handle form submission via AJAX
    function submitCommentForm(form) {
        var formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Create a new comment element
                var commentElement = document.createElement('div');
                commentElement.classList.add('comment-one');
                commentElement.innerHTML = `
                <h3>${data.author}</h3>
                <p>${data.text}</p>
            `;

                // Append the new comment to the comments container
                var commentsContainer = document.querySelector('.comments-container');
                commentsContainer.appendChild(commentElement);

                // Clear the input field after successful submission
                form.querySelector('input[name="comment"]').value = '';
            })
            .catch(error => console.error('Error:', error));
    }

    // Event listener for comment form submission
    var commentForm = document.getElementById('comment-form');
    if (commentForm) {
        commentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            submitCommentForm(commentForm);
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Function to handle form submission via AJAX
    function submitReplyForm(form) {
        var formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Create a new comment element
                var replyElement = document.createElement('div');
                replyElement.classList.add('reply-one');
                replyElement.innerHTML = `
                <h3>${data.author}</h3>
                <p>${data.text}</p>
            `;

                // Find the corresponding comment container
                var commentContainer = form.closest('.comment-one');

                // Append the new comment to the comments container
                var repliesContainer = commentContainer.querySelector('.replies-container');
                repliesContainer.appendChild(replyElement);

                // Clear the input field after successful submission
                form.querySelector('input[name="reply"]').value = '';
            })
            .catch(error => console.error('Error:', error));
    }

    // Event listener for replies form submission
    var replyForms = document.getElementsByClassName('reply-form');
    Array.from(replyForms).forEach(replyFun);

    function replyFun(replyForm) {
        replyForm.addEventListener('submit', function(event) {
            event.preventDefault();
            submitReplyForm(replyForm);
        });
    }
});

function submitUserUpdateForm(event) {
    event.preventDefault();
    var form = document.getElementById('userUpForm');
    var formData = new FormData(form);
    console.log(formData);

    // Send the form data to the PHP backend using AJAX
    fetch("http://localhost/?c=admin&a=update", {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.json(); // Parse the JSON response
            } else {
                throw new Error('Something went wrong');
            }
        })
        .then(updatedUsers => {
            // Update the displayed table with the updated user data
            updateTable(updatedUsers);
            alert('Changes have been saved successfully.');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
}

function updateTable(users) {
    var table = document.getElementById('userTable');
    table.innerHTML = ''; // Clear the existing table

    // Rebuild the table with the updated user data
    var tableHTML = '<tr><th>Username</th><th>Is Admin</th><th>delete user</th></tr>';
    users.forEach(user => {
        tableHTML += '<tr>';
        tableHTML += '<td>' + user.meno + '</td>';
        tableHTML += '<td><input type="checkbox" name="admin[]" value="' + user.id + '" ' + (user.admin ? 'checked' : '') + '></td>';
        tableHTML += '<td><input type="checkbox" name="delete[]" value="' + user.id + '"></td>';
        tableHTML += '</tr>';
    });
    table.innerHTML = tableHTML;
}