const inputsForm = document.getElementById('Form');
const titleField = document.getElementById('title');
const titleUl = document.getElementById('titleUl');
const descriptionField = document.getElementById('description');
const descriptionUl = document.getElementById('descriptionUl');
const roomsField = document.getElementById('rooms');
const roomsUl = document.getElementById('roomsUl');
const bedsField = document.getElementById('beds');
const bedsUl = document.getElementById('bedsUl');
const bathroomsField = document.getElementById('bathrooms');
const bathroomsUl = document.getElementById('bathroomsUl');
const mqField = document.getElementById('mq');
const metersUl = document.getElementById('mqUl');
const priceField = document.getElementById('price');
const priceUl = document.getElementById('priceUl');
const services = document.querySelectorAll('.service');
const servicesUl = document.getElementById('servicesUl');
const messagesUl = document.getElementById('messagesUl');
const input = document.getElementById('address');


function validateNumberField(field, min, max, errorMessage, errorsBag) {
  const fieldValue = field.value;
  const numberValue = Number(fieldValue);
  if (isNaN(numberValue) || numberValue < min || numberValue > max) {
    const errors = [errorMessage];
    errorsBag.push(errors);
    return errors;
  }
  return [];
}

function returnError(error, Ul) {
  const listItem = document.createElement("li");
  listItem.innerText = error;
  Ul.appendChild(listItem);
}

inputsForm.addEventListener('submit', event => {
  event.preventDefault();
  const errorsBag = [];

  // Clear previous errors
  titleUl.innerHTML = "";
  descriptionUl.innerHTML = "";
  roomsUl.innerHTML = "";
  bedsUl.innerHTML = "";
  bathroomsUl.innerHTML = "";
  metersUl.innerHTML = "";
  priceUl.innerHTML = "";
  servicesUl.innerHTML = "";

  // Validation calls
  const roomsErrors = validateNumberField(roomsField, 1, 254, 'Il numero delle stanze deve essere compreso tra 1 e 254.', errorsBag);
  const bedsErrors = validateNumberField(bedsField, 1, 254, 'Il numero dei posti letto deve essere compreso tra 1 e 254.', errorsBag);
  const bathroomsErrors = validateNumberField(bathroomsField, 1, 254, 'Il numero dei bagni deve essere compreso tra 1 e 254.', errorsBag);
  const mqErrors = validateNumberField(mqField, 20, 1000, 'La metratura (mq) deve essere compresa tra 20 e 1000.', errorsBag);
  const priceErrors = validateNumberField(priceField, 1, 1000, 'Il prezzo deve essere compreso tra 1€ e 1.000€.', errorsBag);

  returnError(roomsErrors, roomsUl);
  returnError(bedsErrors, bedsUl);
  returnError(bathroomsErrors, bathroomsUl);
  returnError(mqErrors, metersUl);
  returnError(priceErrors, priceUl);

  // Title Validation
  const title = titleField.value;
  const titleErrors = [];
  if (!title) {
    const titleLengthError = 'Il titolo è obbligatorio.';
    titleErrors.push(titleLengthError);
    errorsBag.push(titleErrors);
  }
  if (title.length > 50) {
    const titleLengthError = 'Il titolo deve essere lungo max 50 caratteri.';
    titleErrors.push(titleLengthError);
    errorsBag.push(titleErrors);
  }
  titleErrors.forEach(error => {
    const listItem = document.createElement("li");
    listItem.innerText = error;
    titleUl.appendChild(listItem);
  });

  // Description Validation
  const description = descriptionField.value;
  const descriptionErrors = [];
  if (description.length > 300) {
    const descriptionLengthError = 'La descrizione deve essere lunga max 300 caratteri.';
    descriptionErrors.push(descriptionLengthError);
    errorsBag.push(descriptionErrors);
  }
  descriptionErrors.forEach(error => {
    const listItem = document.createElement("li");
    listItem.innerText = error;
    descriptionUl.appendChild(listItem);
  });

  // Services Validation
  const servicesChecked = [];
  services.forEach(service => {
    if (service.checked) servicesChecked.push('YES');
  });
  if (servicesChecked.length === 0) {
    const servicesLengthError = 'L\'annuncio deve contenere almeno un servizio';
    errorsBag.push([servicesLengthError]);
    const listItem = document.createElement("li");
    listItem.innerText = servicesLengthError;
    servicesUl.appendChild(listItem);
  }
  if (!input.getAttribute("readonly")) {
    // Se non ha l'attributo 'readonly', impedisce l'invio del form
   
    const addressError = 'L\'indirizzo non è valido';
    const messagesLi = document.getElementById("messagesLi");
    errorsBag.push([addressError]);
    messagesLi.innerText = addressError;
}

  if (!errorsBag.length) inputsForm.submit();
});