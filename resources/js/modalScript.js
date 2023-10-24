const deleteForm = document.querySelectorAll('.deleteForm');
const modalMessage = document.getElementById('modalMessage');
const confirmDropBtn = document.getElementById('confirmDropBtn');

let activeForm = null;

deleteForm.forEach(form => {
    form.addEventListener('submit', event => {
        event.preventDefault();
        const title = form.dataset.name;

        let question;

        if (form.classList.contains('trashEstate'))
        {
            question = `Vuoi davvero spostare '${title}' nel cestino?`;
        } else if (form.classList.contains('dropEstate'))
        {
            question = `Vuoi davvero cancellare definitivamente '${title}' ?\nL'azione è irreversibile!`;
        } else if (form.classList.contains('dropAllEstates'))
        {
            question = `Vuoi davvero cancellare tutti gli annunci definitivamente?\nL'azione è irreversibile!`;
        }

        modalMessage.innerText = question;
        activeForm = form;
    });
});

confirmDropBtn.addEventListener('click', () => {
    if (activeForm) activeForm.submit();
});

modalMessage.addEventListener('hidden-bs-modal', () => {
    activeForm = null;
});
