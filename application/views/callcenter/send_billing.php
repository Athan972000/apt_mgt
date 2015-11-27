<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
table, table td
{
	border: 1px solid black;
	width: 100%;
}
</style>
<div style="padding: 30px;">
<div style="word-wrap: break-word;font-size:16px;">
<div align="center">
<table>
	<tr>
		<td>
			&nbsp;
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			From
		</td>
		<td>
			<?php echo date('F j, Y',strtotime($billing_data['date_from'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			To
		</td>
		<td>
			<?php echo date('F j, Y',strtotime($billing_data['date_to'])); ?>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			Definition
		</td>
		<td>
			<?php echo $billing_data['definition'] ?>
		</td>
	</tr>
	<tr>
		<td>
			Text
		</td>
		<td>
			<?php echo $billing_data['text'] ?>
		</td>
	</tr> 
	<tr>
		<td>
			Word
		</td>
		<td>
			<?php echo $billing_data['word'] ?>
		</td>
	</tr>
	<tr >
		<td>
			&nbsp;
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr style="border-bottom: 2px solid black">
		<td>
			Total
		</td>
		<td>
			<?php echo $billing_data['total'] ?>
		</td>
	</tr>
	<tr>
		<td>
			Total Amount
		</td>
		<td>
			<?php echo '$'.$billing_data['amount'] ?>
		</td>
	</tr>
</table>
</div>
<br>
</div>
<div style='border-top:1px solid #9C9C9C; border-bottom:1px solid #F6F6F6;'></div>
<div style='margin:10px; font-family: '맑은 고딕', Arial,ＭＳ Ｐゴシック;  background-color:#4486f6;'>
Smart Dictionary & Translation<br>
Innovative Translation / Book indexing / learning languages<br>
<a href='http://www.vocabdb.com/developer/rest_api'><b>www.vocabdb.com</b></a><br>
vocadb.api@gmail.com<br>

</div>
</div>
