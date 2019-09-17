<?php 
  if ( isset( $_GET['package'] ) && isset( $_GET['price'] )  ) {
    require_once('class/lib/stripe-php/init.php');
    \Stripe\Stripe::setApiKey('sk_test_ThtWdQUcALTiuiWJtRRORL3J');

    $price = $_GET['price'];
    $intent = \Stripe\PaymentIntent::create([
      'amount' => $price * 100,
      'currency' => 'usd',
    ]);
?>
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <form action="#" id="payment-form">
          <div class="receipt text-center">
            <h4><?php echo $_GET['package']; ?></h4>
            <p><?php echo $_GET['price']; ?> USD</p>
          </div>

          <div class="form-group">
            <input id="cardholder-name" class="form-control" type="text" placeholder="Full Name">
          </div>
          
          <div class="form-group">
            <!-- placeholder for Elements -->
            <div id="card-element" class="form-control"></div>
          </div>
          
          <div class="text-center">
            <button id="card-button" class="btn btn-primary btn-block" data-secret="<?= $intent->client_secret ?>">
              <span class="card-button-icon d-none"><i class="fas fa-spinner fa-spin"></i></span>
              Pay Now
            </button>

            <div class="alert alert-danger my-4 card-response d-none"></div>
          </div>
        </form>

        <div class="success-card d-none">
          <div class="card-icon"><i class="fas fa-check"></i></div>
          <div class="card-text">Payment Compleated Successfully</div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="section">
  <div class="container">
    <div class="section-header">
      <h2>Chose a Package</h2>
    </div>
    
    <div class="row">
      <div class="col-md-4">
        <!-- package-box -->
        <div class="package-box">
          <div class="package-header">
            <h4 class="package-title">Basic</h4>
            <p class="package-price">100 USD</p>
          </div>
          <div class="package-body">
            <ul class="feature-list">
              <li class="list-item">Feature A</li>
              <li class="list-item">Feature B</li>
              <li class="list-item">Feature C</li>
              <li class="list-item">Feature D</li>
              <li class="list-item">Feature E</li>
            </ul>
          </div>

          <div class="package-footer">
            <a href="./?price=100&package=Basic" class="btn btn-primary btn-block">Buy</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <!-- package-box -->
        <div class="package-box recommended">
          <div class="package-header">
            <h4 class="package-title">Pro</h4>
            <p class="package-price">200 USD</p>
          </div>

          <div class="package-body">
            <ul class="feature-list">
              <li class="list-item">Feature A</li>
              <li class="list-item">Feature B</li>
              <li class="list-item">Feature C</li>
              <li class="list-item">Feature D</li>
              <li class="list-item">Feature E</li>
            </ul>
          </div>

          <div class="package-footer">
            <a href="./?price=200&package=Pro" class="btn btn-primary btn-block">Buy</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <!-- package-box -->
        <div class="package-box">
          <div class="package-header">
            <h4 class="package-title">Gold</h4>
            <p class="package-price">300 USD</p>
          </div>

          <div class="package-body">
            <ul class="feature-list">
              <li class="list-item">Feature A</li>
              <li class="list-item">Feature B</li>
              <li class="list-item">Feature C</li>
              <li class="list-item">Feature D</li>
              <li class="list-item">Feature E</li>
            </ul>
          </div>

          <div class="package-footer">
          <a href="./?price=300&package=Gold" class="btn btn-primary btn-block">Buy</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>