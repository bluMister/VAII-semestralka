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

document.addEventListener('DOMContentLoaded', function () {
    const commentForm = document.getElementById('comment-form');


    commentForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Serialize form data
        const formData = new FormData(commentForm);
        const parentId = event.target.getAttribute('data-parent-id');

        // Use AJAX to submit the form data
        fetch('http://localhost?c=Prispevky&a=addComment&id=' + parentId, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Assuming the server responds with the new comment data
                // Update the comments container with the new comment
                const commentsContainer = document.querySelector('.comments-container');
                commentsContainer.innerHTML = data.commentsHtml;
            })
            .catch(error => {
                console.error('Error submitting comment:', error);
            });
    });

    // Event delegation for reply forms
    document.addEventListener('submit', function (event) {
        if (event.target && event.target.matches('.reply-form')) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const parentId = event.target.getAttribute('data-parent-id');

            // Use AJAX to submit the reply form data
            fetch('http://localhost?c=Prispevky&a=addReply&id=' + parentId, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    // Assuming the server responds with the new reply data
                    // Update the replies container with the new reply
                    const repliesContainer = event.target.nextElementSibling;
                    repliesContainer.innerHTML = data.repliesHtml;
                })
                .catch(error => {
                    console.error('Error submitting reply:', error);
                });
        }
    });
});