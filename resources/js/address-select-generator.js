const input = document.getElementById('address');
const autocomplete = document.getElementById('autocomplete');
const resetAddress = document.getElementById('reset-address');
const Form = document.getElementById("Form");
const addressError = document.getElementById("addressError")

let timeoutId = null;

// Reset input value
resetAddress.addEventListener('click', function() {
    input.value = '';
    input.setAttribute("readonly", "readonly");
    input.removeAttribute("readonly", "readonly");
})


// Pick searched address input after 3 char
input.addEventListener('input', function (e) {
  
    clearTimeout(timeoutId);
  
    timeoutId = setTimeout(() => {
        const query = e.target.value;
        if (query.length < 3) {
            autocomplete.innerHTML = '';
            return;
        }
    
        // Pick endpoint from backend
        const endpoint = `/proxy/${query}`;
    
        // AXIOS API Call
        axios.get(endpoint)
            .then(response => {
                console.log(endpoint);
                const results = response.data.results;
                autocomplete.innerHTML = '';
    
                results.forEach(element => {
                    const div = document.createElement('div');
                    div.textContent = element.address.freeformAddress;
                    autocomplete.classList.remove('d-none');
    
                    div.addEventListener('click', function () {
                        input.value = element.address.freeformAddress;
                        autocomplete.innerHTML = '';
                        autocomplete.classList.add('d-none');
                        input.setAttribute("readonly", "readonly");
                    });
                    autocomplete.appendChild(div);
                });
    
            }).catch(err => {
                console.error(err)
            })
          
    }, 200);
    
});