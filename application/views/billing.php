<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<body>
<div style="height: 100%; padding: 50px 0; background-color: white" class="row row-table">
	<div class="col-lg-3  align-middle">
		<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick">
		<input type="hidden" name="business" value="xavier.valenzuela@gmail.com">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="item_name" value="Teddy Bear">
		<input type="hidden" name="amount" value="12.99">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	</div>
</div>
	
</body>
