$(document).ready(function() {
  // Check if Card Element Exist on The Page
  if ( $('#card-element').length ) {
    // Create a Stripe client.
    var stripe = Stripe('pk_test_1llLXi1jGBLQFKoFgSlBJYiv');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };

    var cardElement = elements.create('card', {style: style});
    cardElement.mount('#card-element');

    var cardholderName = document.getElementById('cardholder-name');
    var cardButton = document.getElementById('card-button');
    var clientSecret = cardButton.dataset.secret;

    var isLoading = false;
    var paymentForm = $('#payment-form');
    var cardBtn = $('#card-button');
    var cardIcon = $('.card-button-icon');
    var cardResponse = $('.card-response');
    var successCard  = $('.success-card');

    cardButton.addEventListener('click', function(ev) {
      ev.preventDefault();
      if (isLoading) { return; }

      isLoading = true;
      cardIcon.removeClass('d-none');


      stripe.handleCardPayment(
        clientSecret, cardElement, {
          payment_method_data: {
            billing_details: {name: cardholderName.value}
          }
        }
      ).then(function(result) {
        if (result.error) {
          isLoading = false;
          cardIcon.addClass('d-none');

          cardResponse.removeClass('d-none');
          cardResponse.addClass('alert-danger');
          cardResponse.html(result.error.message);
          
          // Display error.message in your UI.
          console.log('Error');
        } else {
          isLoading = false;
          cardIcon.addClass('d-none');

          cardResponse.removeClass('d-none');
          cardResponse.removeClass('alert-danger');
          cardResponse.addClass('d-none');
          cardResponse.html('');
          paymentForm.addClass('d-none');
          successCard.removeClass('d-none');

          // The payment has succeeded. Display a success message.
          console.log('Success');
        }

        console.log(result);
      });
    });
  }
});
