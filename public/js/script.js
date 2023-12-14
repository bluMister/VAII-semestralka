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