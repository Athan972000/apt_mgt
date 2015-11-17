<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo "<pre>";
// print_r($Nvoca['billing_history']);
// echo "</pre>";
// exit();
$bill_history = '';
foreach( $Nvoca['billing_history'] as $v )
{
	$status = "Not Paid";
	if($v['api_billing_id'])
	{
		$status = "Paid";
	}
	$bill_history .= "
		<tr>
			<td>
				".date('F j, Y',strtotime($v['date_from']))."
			</td>
			<td>
				".date('F j, Y',strtotime($v['date_to']))."
			</td>
			<td>
				".$status."
			</td>
		</tr>
	";
}


?><!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
<style type="text/css">
.due{
	font-weight:900;
}

.panel-heading:hover {
  cursor:pointer;
 }
.value
{
	font-size: 14px;
}
.breakdown
{
	font-size: 12px;
	// text-align: right;
	display: none;
}
.tab-content
{
	border: 0px;
}
.as_nav li.active a, .as_nav li.active a:focus {
    background-color: #4486f6;
	color: white;
}
#billing_history
{
	width: 100%;
}
div.dataTables_sort_wrapper{white-space:nowrap !important;} th{white-space:nowrap !important;}
</style>

<br/><br/><br/>
<div>


<ul class="as_nav nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#balance" aria-controls="home" role="tab" data-toggle="tab">Balance</a></li>
    <li role="presentation"><a href="#history" aria-controls="profile" role="tab" data-toggle="tab">History</a></li>
    <li role="presentation"><a href="#pricing" aria-controls="profile" role="tab" data-toggle="tab">Pricing</a></li>
</ul>

<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="balance">
		<h4>
			Balance
		</h4>

	<div id="balance" class="panel-collapse in">
		<div class="row">
			<br>
					<div class="col-xs-12 col-sm-8 col-md-8">
						<p>Remaining balance from previous bill</p>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<p class="value"><?php echo '$'.$Nvoca['remaining_bal']; ?></p>
					</div>
				</div>
						<br class="clear">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8">
						<p>Current bill charges</p>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<p class="value"><?php echo '$'.$Nvoca['current']; ?></p>
					</div>
				</div>
					   
			<div class="breakdown">
			 <br class="clear">
				 <div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8">
						<p>Text total</p>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<p class="value"><?php echo '$'.$Nvoca['text_amount']; ?></p>
					</div>
				</div>
						<br class="clear">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8">
						<p>Word total</p>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<p class="value"><?php echo '$'.$Nvoca['definition_amount']; ?></p>
					</div>
				</div>
						<br class="clear">
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8">
						<p>Definition total</p>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<p class="value"><?php echo '$'.$Nvoca['word_amount']; ?></p>
					</div>
				</div>
						<br class="clear">
			</div>
			<hr>
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-8">
						<p class="due">Total Amount Due</p>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<p class="due value"><?php echo '$'.($Nvoca['total_amount']); ?></p>
							</div>
						</div>
						<br class="clear">
					<br class="clear">
					<br class="clear">
					<div align="center" >
		 
						<?php if( $Nvoca['total_amount'] > 0 ):  ?>
							<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input type="hidden" name="cmd" value="_xclick">
								<input type="hidden" name="business" value="athan17@gmail.com">
								<input type="hidden" name="lc" value="US">
								<input type="hidden" name="item_name" value="Billing - VocaDB API">
								<input type="hidden" name="amount" value="<?php echo $Nvoca['total_amount']; ?>">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="button_subtype" value="services">
								<input type="hidden" name="no_note" value="1">
								<input type="hidden" name="no_shipping" value="1">
								<input type="hidden" name="rm" value="1">
								<input type="hidden" name="return" value="<?php echo base_url().'billing_complete' ?>">
								<input type="hidden" name="cancel_return" value="<?php echo base_url().'billing' ?>">
								<input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHosted">
								<input type="hidden" name="custom" value='<?php echo $Nvoca['notpaid_bill']; ?>'>
								<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
								<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
							<?php endif; ?>
					</div>
			</div>
	</div>
    <div role="tabpanel" class="tab-pane fade" id="history">
		<h4>History</h4>
		<table id="billing_history">
		<thead width="100%">
			<tr>
				<th>
					From
				</th>
				<th>
					To
				</th>
				<th>
					Status
				</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $bill_history; ?>
		</tbody>
		</table>
	</div>
	<div role="tabpanel" class="tab-pane fade" id="pricing">
		<h4>Pricing</h4>
		<div align="left"  >
			  <div>
				<p style="padding-left:40px;">vocaDB API pricing is based on usage. Extraction of words usage is calculated in millions of characters (M), where 1 M = 106 characters.</p>
					
				<p style="padding-left:40px;">When charging in local currency, vocaDB will convert the prices listed into applicable local currency pursuant to the conversion rates published by leading financial institutions.</p>
			 </div>
			 <ul>
			  <li><strong>Usage fees:</strong>
				<ul>
				  <li><strong>Extraction:</strong>
					<ul>
					  <li>$20 per <strong>1 M characters</strong> of text, where the charges are adjusted in proportion to the number of characters actually provided. For example, if you were to extract 500K characters, you would be billed $10.</li>
					</ul>
				  </li>
				  <li><strong>Dictionary:</strong>
					<ul>
					  <li>$20 per <strong>1 M characters</strong> of searched word, where the charges are adjusted in proportion to the number of characters actually provided.</li>
					</ul>
				  </li>
				</ul>
			  </li><br>
			  <li><strong>Usage limits:</strong>
				<ul>
				  <li>vocaDB API has a default limit of 2 M chars/day. </li>
				  <li> If you need to search or extract words more than 50 M chars/day, please <a href="http://www.vocabdb.com/developer/rest_api/applytous">contact us</a></li>
			 
				</ul>
			  </li>
			</ul>
		</div>
	</div>
</div>
</div>
<script>
$(document).ready(function(){
    var table =  $('#billing_history').DataTable({
        "scrollY":        "300px",
        "scrollCollapse": true,
        "paging":         false,
		"info":     false,
    });
});
</script>