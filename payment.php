<?php

session_start();

if (isset($_POST['order_pay_ptn'])) {

  $order_status = $_POST['order_status'];
  $order_total_price = $_POST['order_total_price'];
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include('layouts/header.php'); ?>

<!-- Payment -->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold" style="font-family: Poppins;">Payment</h2>
    <hr class="mx-auto" style="border: 4px solid coral; width: 3%;">
  </div>
  <div class="mx-auto container text-center">
    <?php if (isset($_SESSION['total']) && ($_SESSION['total'] != 0)) { ?>
      <?php $amount = strval($_SESSION['total']); ?>
      <p>Total Payment: $<?php echo $_SESSION['total']; ?></p>
      <div style="padding: 0px 0px 0px 270px;" id="paypal-button-container"></div>
      <!-- <input class="btn btn-primary" type="submit" value="Pay Now"> -->

    <?php } elseif (isset($_POST['order_status']) && ($_POST['order_status'] == "not paid")) { ?>
      <?php $amount = strval($_POST['order_total_price']); ?>
      <p>Total Payment: $<?php echo $_POST['order_total_price']; ?></p>
      <div style="padding: 0px 0px 0px 270px;" id="paypal-button-container"></div>
      <!-- <input class="btn btn-primary" type="submit" value="Pay Now"> -->


    <?php } else { ?>
      <p>You don't have an order</p>
    <?php } ?>

  </div>
</section>



  <script
  data-sdk-integration-source="integrationbuilder_sc"
  src="https://www.paypal.com/sdk/js?client-id=AQlyJTAOkfSmgF7peuK4IQNEwu8Z45KGZP03DaAm7prSedNuD6ni9bKPKiD58JjcWIb6t8DrdU5gGj7e&components=buttons&enable-funding=venmo,paylater"></script>
<script>
  console.log("Hello I am Under the Water 1");
    const FUNDING_SOURCES = [
      // EDIT FUNDING SOURCES
        paypal.FUNDING.PAYPAL,
        paypal.FUNDING.CARD
    ];
    FUNDING_SOURCES.forEach(fundingSource => {
      paypal.Buttons({
        fundingSource,

        style: {
          layout: 'vertical',
          shape: 'rect',
          color: (fundingSource == paypal.FUNDING.PAYLATER) ? 'gold' : '',
        },

        createOrder: async (data, actions) => {
          console.log(data);
          try {
            console.log("Hello I am Under the Water 6");
            const response = await fetch("http://localhost:3306/orders", {
              method: "POST"
            });
            if (!response.ok) {
      throw new Error(`Failed to create order. Status: ${response.status}`);
    }

        
            const details = await response.json();
            return details.id;
          } catch (error) {
            console.error(error);
            // Handle the error or display an appropriate error message to the user
          }
        },

        

        onApprove: async (data, actions) => {
          console.log(data);
          try {
            console.log("Hello I am Under the Water 10");
            const response = await fetch(`http://localhost:3306/orders/${data.orderID}/capture`, {
              method: "POST"
            });

            const details = await response.json();
            // Three cases to handle:
            //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
            //   (2) Other non-recoverable errors -> Show a failure message
            //   (3) Successful transaction -> Show confirmation or thank you message

            // This example reads a v2/checkout/orders capture response, propagated from the server
            // You could use a different API or structure for your 'orderData'
            const errorDetail = Array.isArray(details.details) && details.details[0];

            if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
              return actions.restart();
              // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
            }

            if (errorDetail) {
              let msg = 'Sorry, your transaction could not be processed.';
              msg += errorDetail.description ? ' ' + errorDetail.description : '';
              msg += details.debug_id ? ' (' + details.debug_id + ')' : '';
              alert(msg);
            }

            // Successful capture! For demo purposes:
            console.log('Capture result', details, JSON.stringify(details, null, 2));
            const transaction = details.purchase_units[0].payments.captures[0];
            alert('Transaction ' + transaction.status + ': ' + transaction.id + 'See console for all available details');
          } catch (error) {
            console.error(error);
            // Handle the error or display an appropriate error message to the user
          }
        },
      }).render("#paypal-button-container");
    })
  </script>



<?php include('layouts/footer.php'); ?>