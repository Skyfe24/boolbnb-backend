const rows = document.querySelectorAll('.dynamic-tr');
const deleteButtons = document.querySelectorAll('.delete');

rows.forEach(row => {
    const estate = JSON.parse(row.getAttribute('data-estate'));
    const estate_id = estate.id;

    row.addEventListener('click', function (e) {
        window.location.href = `/admin/estates/${estate_id}`;
    });
});


deleteButtons.forEach(button => {
    button.addEventListener('click', function (event) {
        event.stopPropagation();
    });
});