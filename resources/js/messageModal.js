document.addEventListener('DOMContentLoaded', function () {
    // Get the modal and the modalMessage element
    const modal = document.getElementById('myModal');
    const modalMessage = modal.querySelector('#modalMessage');
    const dropBtn = modal.querySelector('#confirmDropBtn');
    const btnClose = modal.querySelector('.btn-close');
    const modalTitle = modal.querySelector('.modal-title');


    // Convert PC date to human date
    function formatDateToHuman(computerDate) {
        const date = new Date(computerDate);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // +1 perché i mesi iniziano da 0 in JavaScript
        const year = date.getFullYear();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${day}/${month}/${year} ${hours}:${minutes}`;
    }

    // Add event listener to show data when modal is about to be shown
    modal.addEventListener('show.bs.modal', function (event) {
        // Button (or div in this case) that triggered the modal
        const button = event.relatedTarget;

        // Extract the data from the div's data-* attributes
        const message = JSON.parse(button.getAttribute('data-content'));
        const title = button.getAttribute('data-title');
        const name = message.name;
        const email = message.email;;
        const text = message.text;;
        const date = formatDateToHuman(message.created_at);;

        // Update the modal's content
        modalMessage.innerHTML = `
            <ul class="mb-0">
                <li><strong>Annuncio: </strong>${title}</li>
                <li><strong>Nome: </strong>${name}</li>
                <li><strong>Email: </strong>${email}</li>
                <li><strong>Data e Ora: </strong>${date}</li>
                <li><strong>Testo: </strong>${text}</li>
            </ul>
        `;
        modalTitle.innerText = `Messaggio da: ${name}`;
        dropBtn.classList.add('d-none');
        btnClose.classList.add('d-none');
    });
});