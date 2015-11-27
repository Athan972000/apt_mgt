<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->model('computation_model');
// echo "<pre>";
// print_r($Nvoca['billing_history']);
// echo "</pre>";
// exit();
$bill_history = '';
$bill_details = '';
foreach( $Nvoca['billing_history'] as $v )
{
	$status = "Not Paid";
	if($v['amount_paid'])
	{
		$status = "Paid";
	}
	$bill_history .= "
		<tr bill_id='".$v['billing_id']."'>
			<td>
				".date('F Y',strtotime($v['billing_date']))."
			</td>
			<td>
				".$v['amount']."
			</td>
			<td>
				".$status."
			</td>
		</tr>
	";
	$bill_details .= "<div style='width: 100%;display:none;' id='".$v['billing_id']."'>
		<table>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					Billing no.
				</td>
				<td>
					".$v['billing_id']."
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					From
				</td>
				<td>
					".date('F Y',strtotime($v['billing_date']))."
				</td>
			</tr>
			<tr>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr style='border:1px solid black;'>
				<td>
					Service
				</td>
				<td>
					Usage
				</td>
				<td>
					Price
				</td>
			</tr>
			<tr>
				<td>
					Definition
				</td>
				<td>
					".$v['definition']."
				</td>
				<td>
					".$this->computation_model->compute_length($v['definition'])."
				</td>
			</tr>
			<tr>
				<td>
					Text
				</td>
				<td>
					".$v['text']."
				</td>
				<td>
					".$this->computation_model->compute_length($v['text'])."
				</td>
			</tr>
			<tr>
				<td>
					Word
				</td>
				<td>
					".$v['word']."
				</td>
				<td>
					".$this->computation_model->compute_length($v['word'])."
				</td>
			</tr>
			<tr>
				<td>
					Translation
				</td>
				<td>
					".$v['word']."
				</td>
				<td>
					".$this->computation_model->compute_length($v['trans'])."
				</td>
			</tr>
			<tr style='border-top:1px solid black;'>
				<td>
					Total
				</td>
				<td>
					".$v['total']."
				</td>
				<td>
					".$v['amount']."
				</td>
			</tr>
		</table>
	</div>
	";
}//end foreach

// echo $bill_details['22'];
// exit();

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
					Billing date
				</th>
				<th>
					Amount
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
<?php echo $bill_details; ?>
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<form id="changepass">
    <div class="modal-content">
    <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Billing no.<span id="bill_no"></span></h4>
    </div>
    <div class="modal-body" id="bill_content">
		
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
	</form>
  </div>
</div>
<script>
$(document).ready(function(){
    var table =  $('#billing_history').DataTable({
        "scrollCollapse": true,
        "paging":         false,
		"info":     false,
    });
	$('#billing_history tbody').on( 'click', 'tr', function () {
        // if ( $(this).hasClass('selected') ) {
            // $(this).removeClass('selected');
        // }
        // else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
			var this_id = $(this).attr('bill_id');
			$('#bill_content').html( $('#'+this_id).html() );
			$('#bill_content').children('table').width('100%');
			$('#bill_no').html(this_id);
			$('#vocadbmodal').modal('show');
			// $(this).removeClass('selected');
        // }
    } );
	$('#vocadbmodal').on('hide.bs.modal', function (e) {
		table.$('tr.selected').removeClass('selected');
	})
});
</script>