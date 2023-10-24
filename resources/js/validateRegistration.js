const endpoint = 'http://localhost:8000/api/users/';

const registrationForm = document.getElementById('registrationForm');

const emailField = document.getElementById('email');
const emailUl = document.getElementById('emailUl');
const emailJsValidationExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

const passwordField = document.getElementById('password');
const confirmPasswordField = document.getElementById('password-confirm');
const passwordUl = document.getElementById('passwordUl');

const nameField = document.getElementById('name');
const nameUl = document.getElementById('nameUl');


let output;

axios.get(endpoint)
.then(res => {
    output = res.data;
    console.log(output);
})
.catch(err => {
    console.error(err);
})

registrationForm.addEventListener('submit', event => {
    event.preventDefault();

    const emailErrors = [];
    const passwordErrors = [];
    const nameErrors = [];
    emailUl.innerHTML = "";
    passwordUl.innerHTML = "";
    nameUl.innerHTML = "";

    // Email validation
    const email = emailField.value;

    if (!email)
    {
        const emailRequiredError = 'L\'email è obbligatoria';
        emailErrors.push(emailRequiredError);
    } else if (!email.match(emailJsValidationExp))
    {
        const emailRegexError = 'L\'email inserita non è valida';
        emailErrors.push(emailRegexError);
    }
    if (typeof email !== 'string')
    {
        const emailStringError = 'L\'email deve essere una stringa';
        emailErrors.push(emailStringError);
    }

    if (email.length > 255)
    {
        const emailLengthError = 'L\'email inserita supera i 255 caratteri';
        emailErrors.push(emailLengthError);
    }

    let i = 0;
    let found = false;
    while (i < output.length && !found)
    {
        if (email == output[i].email) found = true;
        i += 1;
    }
    if (found)
    {
        const emailUniqueError = 'L\'email inserita è già utilizzata da un altro utente';
        emailErrors.push(emailUniqueError);
    }

    // Password validation
    const password = passwordField.value;
    const confirmation = confirmPasswordField.value;

    if (!password)
    {
        const passwordRequiredError = 'La password è obbligatoria';
        passwordErrors.push(passwordRequiredError);
    } else if (password != confirmation)
    {
        const passwordConfirmationError = 'La conferma della password non coincide';
        passwordErrors.push(passwordConfirmationError);
    }
    if (password.length < 8)
    {
        const passwordLengthError = 'La password deve contenere almeno 8 caratteri';
        passwordErrors.push(passwordLengthError);
    }

    // Name Validation
    const name = nameField.value;

    if (name.length > 50)
    {
        const nameLengthError = 'Il nome inserito supera i 50 caratteri';
        nameErrors.push(nameLengthError);
    }



    

    emailErrors.forEach(error => {
        console.log(error);
        const listItem = document.createElement("li");
        listItem.innerText = error;
        emailUl.appendChild(listItem);
    })

    passwordErrors.forEach(error => {
        console.log(error);
        const listItem = document.createElement("li");
        listItem.innerText = error;
        passwordUl.appendChild(listItem);
    })

    nameErrors.forEach(error => {
        console.log(error);
        const listItem = document.createElement("li");
        listItem.innerText = error;
        nameUl.appendChild(listItem);
    })

    if (!emailErrors.length && !passwordErrors.length && !nameErrors.length) registrationForm.submit();
});
