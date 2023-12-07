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
        alert('Please select exactly one option.');
        return false;
    }

    return true;
}