const button = document.getElementById('paymentBtn');
const spinner = document.getElementById('paymentSpinner');
button.classList = '';
spinner.classList.add('d-none');

braintree.dropin.create({
    authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
    selector: '#dropin-container'
}, function (err, instance) {
    button.addEventListener('click', event => {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
            console.log('err: ', err);
            console.log('payload: ', payload);
            if (err != null && payload == undefined){
              console.log('ERROR OCCURRED');
            } else if (err == null && payload != undefined){
              button.classList.add('d-none');
              spinner.classList.remove('d-none');
              button.submit();
            }
        });
    })
});
