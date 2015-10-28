<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<script type="text/javascript">
    function onVisaCheckoutReady(){
    V.init({ 
	apikey: "9B6V1OSDSH5S63IKF4MC1368Sa3rvt_xmWAwulR-EcPEc_xU8",
	paymentRequest: {
     currencyCode: "USD",
     subtotal: "11.00"
     }
	});
	V.on("payment.success", function(payment) {alert(JSON.stringify(payment)); });
	V.on("payment.cancel", function(payment) {alert(JSON.stringify(payment)); });
	V.on("payment.error", function(payment,error){alert(JSON.stringify(error));});
    }
  </script>


 
<img alt="Visa Checkout" class="v-button" role="button" 
   src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png"/>
   
<script type="text/javascript"
src="https://sandbox-assets.secure.checkout.visa.com/
checkout-widget/resources/js/integration/v1/sdk.js">
</script>