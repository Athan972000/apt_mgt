<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style type="text/css">
.due{
	font-weight:900;
}

.panel-heading:hover {
  cursor:pointer;
 }

</style>
<body>

<div style="padding-left:100px">

<div class="panel-group" align="center">
  <div class="panel panel-primary">
    <div class="panel-heading">      
       <h4 data-toggle="collapse" href="#pricing"style="font-color:white;" class="panel-title">Pricing</h4>
    </div>
    <div id="pricing" class="panel-collapse collapse">
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

<div class="panel-group" align="center">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title" data-toggle="collapse" href="#balance">
        Balance
      </h4>
    </div>
    <div id="balance" class="panel-collapse in">
       <div class="row">
	   <br>
				<div class="col-xs-12 col-sm-8 col-md-8">
					<p>Remaining balance from previous bill</p>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<p class="value">P0.00</p>
				</div>
                </div>
                <br class="clear">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <p>Current bill charges</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <p class="value">P0.00</p>
                    </div>
                </div>
                <br class="clear">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <p class="due">Total Amount Due</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <p class="due value">$1,312.99</p>
                    </div>
                </div>
                <br class="clear">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <p class="due">Payment due date</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <p class="due value">November 16, 2015</p>
                    </div>
                </div>
                <br class="clear">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <p>Minimum amount due</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <p class="value">P0.00</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <p>Unbilled usage</p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <p class="value">$1,225.99</p>
                    </div>
                </div>
            <br class="clear">
            <div >
 
                <div class="panel-footer">
					<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="xavier.valenzuela@gmail.com">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="item_name" value="VocaDB Billing">
					<input type="hidden" name="amount" value="1312.99">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
                </div>
            </div>
    </div>
  </div>
</div>

</div>
	
	
   
</body>

