<?php
// var_dump($Nvoca);
?>

<link rel="stylesheet" href="<?php echo base_url().'resources/' ?>vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#income" aria-controls="home" role="tab" data-toggle="tab">Income</a></li>
    <li role="presentation"><a href="#billnow" aria-controls="profile" role="tab" data-toggle="tab">Make Billing</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="income">...</div>
	
    <div role="tabpanel" class="tab-pane" id="billnow">
		<div class="container-fluid row" align="center">
		<form id="billnow_form" method="POST">
			<div class="col-xs-6">
				<input placeholder="From" type='text' class="form-control" id='date_from' />
			</div>
			<div class="col-xs-6">
				<input placeholder="To" type='text' class="form-control" id='date_to' />
			</div>
			<div class="col-xs-12" style="padding: 15px;" align="center">
				<button type="submit" class="btn btn-default" id="bill">Make Billing Now</button>
			</div>
		</form>
		</div>
	</div>
  </div>
</div>
<script src="<?php echo base_url()."resources/" ?>vendor/moment/min/moment-with-langs.min.js"></script>
<script src="<?php echo base_url()."resources/" ?>vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script>
$(document).ready(function(){
	$('#billnow_form').on('submit',function(e){
		e.preventDefault();
		if( $('#date_from').val() != "" && $('#date_to').val() != "" )
		{
			$.ajax({
				url: base_url+"admin/billing_create",
				type:'POST',
				data:{
					date_from: $('#date_from').val(),
					date_to:  $('#date_to').val()
				},
				success: function(res)
				{
					console.log(res);
					// location.reload();
					$('#billnow_form').append('Billing has been created');
				}
			});
		}
		else
		{
			console.log('false/missing');
		}
		
	});
	
	$('#date_from').datetimepicker({
		format: 'YYYY-MM-DD',
		maxDate: "<?php echo $Nvoca['tomorrow']; ?>",
		minDate:	"<?php echo $Nvoca['min_date']; ?>"
		});
	$('#date_to').datetimepicker({
		format: 'YYYY-MM-DD',
		maxDate: "<?php echo $Nvoca['tomorrow']; ?>",
		minDate:	"<?php echo $Nvoca['min_date']; ?>"
		});
	$('.picker-switch').css('display','none');
});
</script>