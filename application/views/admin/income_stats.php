<?php
// echo "<pre>";
// print_r($Nvoca);
// exit();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<style>
canvas{
    width: 100% !important;
	max-width: 100%;
	height: 400px;
	max-height: 400px;
    height: auto !important;
}
#calendar_year
{
	font-size: 20px;
    padding: 10px;
}
.calendar_year_toggle
{
	font-size: 25px;
	position: relative;
	top: 5px;
	cursor: pointer;
	// border: 1px solid blue;
	padding: 5px 30px;
	// border-radius: 2%;
}
.calendar_year_toggle:hover
{
	color: blue;
}
#calendar_year_value
{
	padding: 0px 30px;
}
#calendar_months button
{
	width: 50px;
	height: 50px;
	margin: 5px;
}
#calendar
{
	margin: 15px;
}
// .modal.large {
    // width: 80%; /* respsonsive width */
// }
</style>
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active"><a href="#income" aria-controls="home" role="tab" data-toggle="tab">Income</a></li>
    <li role="presentation"><a href="#billnow" aria-controls="profile" role="tab" data-toggle="tab">Make Billing</a></li>
  </ul>

	<!-- Tab panes -->
	<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="income">
		<canvas id="myChart"></canvas>
	</div>
	
    <div role="tabpanel" class="tab-pane" id="billnow">
		<div class="container-fluid row" align="center" id="calendar">
			<div class="col-xs-6">
				<h4>Issue Billing</h4>
				<br>
				<div id='calendar_year' class='col-xs-12'>
					<span class="calendar_year_toggle" year='minus'> <span class="fa fa-chevron-left"></span> </span>
					<span id='calendar_year_value'><?php echo date("Y"); ?></span>
					<span class="calendar_year_toggle" year='plus'> <span class="fa fa-chevron-right"></span> </span>
				</div>
				<br>
				<div id="calendar_months" class='col-xs-12'>
					<div class='col-xs-12'>
						<button month='1' class="btn btn-default">Jan</button>
						<button month='2' class="btn btn-default">Feb</button>
						<button month='3' class="btn btn-default">Mar</button>
						<button month='4' class="btn btn-default">Apr</button>
					</div>
					<div class='col-xs-12'>
						<button month='5' class="btn btn-default">May</button>
						<button month='6' class="btn btn-default">Jun</button>
						<button month='7' class="btn btn-default">Jul</button>
						<button month='8' class="btn btn-default">Aug</button>
					</div>
					<div class='col-xs-12'>
						<button month='9' class="btn btn-default">Sep</button>
						<button month='10' class="btn btn-default">Oct</button>
						<button month='11' class="btn btn-default">Nov</button>
						<button month='12' class="btn btn-default">Dec</button>
					</div>
				</div>
				<div id="calendar_button" class='col-xs-12' style="display:none;">
					<button id="resend_billing" class="btn btn-default">Re-Send billing</button>
					<button id="batch_billing_result" class="btn btn-default">Batch billing</button>
				</div>
			</div>
			<div class="col-xs-6">
				<h4>Re-issue Billing</h4>
				<br>
				<button id="reissue_billing" class="btn btn-default">Re-issue billing</button>
			</div>
		</div>
		<br>
		<div class="col-xs-6">
			
		</div>
		<div class="col-xs-6">
			
		</div>
	</div>
	</div>
</div>
<!-- Resend Billing -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Billing</h4>
    </div>
    <div class="modal-body">
		<table id="billing_table">
			<thead>
				<tr>
					<td><input type="checkbox" class="check_all"/> Check</td>
					<td>Name</td>
					<td>Email</td>
					<td>Total Usage</td>
					<td>Amount</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
    </div>
    <div class="modal-footer">
		<button type="button" id="resend_billing_now" class="btn btn-primary">Re-Send Billing</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>
<!-- Batch Billing -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="batch_billing" tabindex="-1" role="dialog" aria-labelledby="batch_billing_label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="batch_billing_label">Billing</h4>
    </div>
    <div class="modal-body">
		<table id="batch_billing_table">
			<thead>
				<tr>
					<td>Name</td>
					<td>Email</td>
					<td>Total Usage</td>
					<td>Amount</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
    </div>
    <div class="modal-footer">
		<button type="button" id="batch_billing_now" class="btn btn-primary">Confirm batch billing</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>
<!-- Re-Issue Billing -->
<div class="modal large fade" data-backdrop="static" data-keyboard="false" id="re_issue" tabindex="-1" role="dialog" aria-labelledby="reissue_billing_label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="reissue_billing_label">Re-Issue Billing</h4>
    </div>
    <div class="modal-body">
		<table id="reissue_billing_table">
			<thead>
				<tr>
					<td><input type="checkbox" class="check_all"/> Check</td>
					<td>Name</td>
					<td>Email</td>
					<td>Total Usage</td>
					<td>Amount</td>
					<td>Billing Month/Year</td>
					<td>Billed Date</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
    </div>
    <div class="modal-footer">
		<button type="button" id="re_issue_now" class="btn btn-primary">Re-Issue billing</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>
<script>
var ctx = $("#myChart").get(0).getContext("2d");
var income_result = JSON.parse('<?php echo $Nvoca['income_result']; ?>');
var unpaid_result = JSON.parse('<?php echo $Nvoca['unpaid_result']; ?>');
var billed_dates = JSON.parse('<?php echo $Nvoca['billed_dates'] ?>');
var data = construct_data(income_result,unpaid_result,billed_dates);
var d = new Date();
var cal_month = d.getMonth()+1;
var cal_year = $("#calendar_year_value").html(),table;
var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

console.log(data);
var vocadbchart = new Chart(ctx).Line(data);
	function construct_data(income_result,unpaid_result,billed_dates)
	{
		var dateArray =[];
		for( i=0; i<billed_dates.length;i++)
		{
			dateArray.push(billed_dates[i].billing_date);
		}
		// console.log(billed_dates);
		// console.log(dateArray);
		var income = [];
		var unpaid = [];
		for( i=0; i<dateArray.length; i++ )
		{
			if( typeof(income_result[i]) != 'undefined' )
			{
				if(income_result[i].billing_date == dateArray[i])
				{
					income.push(income_result[i].total);
				}
				else
				{
					income.push(0);
				}
			}
			else
			{
				income.push(0);
			}
			
			if( typeof(unpaid_result[i]) != 'undefined' )
			{
				if(unpaid_result[i].billing_date == dateArray[i])
				{
					unpaid.push(unpaid_result[i].total);
				}
				else
				{
					unpaid.push(0);
				}
			}
			else
			{
				unpaid.push(0);
			}
		}
		
		if( dateArray.length > 10 )
		{
			var skip_count = Math.round(dateArray.length/10);
			var ctr = 0;
			for( i=1;i<dateArray.length;i++ )
			{
				if(ctr == skip_count)
				{
					ctr = 0;
				}
				else
				{
					if(i+1 != dateArray.length)
					{
						ctr++;
						dateArray[i] = "";
					}
					
				}
			}
		}
		var data = {
			labels: dateArray,
			datasets: [
				{
					fillColor: "rgba(151,187,205,0.2)",
					strokeColor: "rgba(151,187,205,1)",
					pointColor: "rgba(151,187,205,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(151,187,205,1)",
					data: income

				},
				{
					fillColor: "rgba(220,220,220,0.2)",
					strokeColor: "rgba(220,220,220,1)",
					pointColor: "rgba(220,220,220,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					data: unpaid

				}
			]
		};
		return data;
	}
	
$('.check_all').click(function(e){
    var table= $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
});
	
function checkdate()
{
	var thismonth = d.getMonth()+1;
	var thisyear = d.getFullYear();
	if( cal_year < thisyear )
	{
		// console.log('enable all');
		$('#calendar_months button').removeClass('disabled');

	}
	else if ( cal_year == thisyear )
	{
		$('#calendar_months button').removeClass('disabled');
		for(var i=1;i<=12;i++)
		{
			if(i >= thismonth)
			{
				$('#calendar_months button[month='+i+']').addClass('disabled');
			}
		}
	}
	else
	{
		// console.log('disable all');
		$('#calendar_months button').addClass('disabled');
	}
	$('#calendar_months div button').removeClass('btn-primary');
	$('#calendar_months div button').addClass('btn-default');
	$('#calendar_button').css('display','none');
}
$(document).ready(function(){
	checkdate();
	$('.calendar_year_toggle').on('click',function(){
		var year = $("#calendar_year_value").html();
		if ( $(this).attr('year') == 'minus' )
		{
			$("#calendar_year_value").html(year-1);
			cal_year = year-1
		}
		else
		{
			$("#calendar_year_value").html(+year+1);
			cal_year = +year+1;
		}
		checkdate();
	});
	$('#calendar_months div button').on('click',function(){
		$('#calendar_months div button').removeClass('btn-primary');
		$('#calendar_months div button').addClass('btn-default');
		$(this).addClass('btn-primary');
		$(this).removeClass('btn-default');
		cal_month = $('#calendar_months .btn-primary').attr('month');
		$('#calendar_button').css('display','inline');
	});
	
	$('#resend_billing').on('click',function(){
		// console.log(cal_month + cal_year);
		$.ajax({
			url: base_url+"admin/get_billing_info",
			type:'POST',
			data:{
				month: cal_month,
				year: cal_year
			},
			success: function(res)
			{
				var result = JSON.parse(res);
				var tablebody = $('#billing_table tbody');
				// console.log(res);
				if(table)
					table.destroy();
				tablebody.html('');
				
				for(i=0;i<result.length;i++)
				{
					tablebody.append('<tr><td><input type="checkbox" value=\''+JSON.stringify(result[i])+'\'/></td><td> '+result[i].name+' </td><td> '+result[i].email+' </td><td>'+result[i].total+'</td><td>'+result[i].amount+'</td></tr>');
				}
				$('#myModalLabel').html('Billing for '+monthNames[cal_month-1]+' '+cal_year );
				$('#vocadbmodal').modal('show');
				table = $('#billing_table').DataTable({

					"scrollCollapse": true,
					"paging":         false,
					"ordering": false,
					"info":     false,
				});
			}
		});
	});
	$('#resend_billing_now').on("click",function(e){
		e.preventDefault();
		var allVals = [];
		$('#billing_table tbody :checked').each(function() {
			allVals.push( $(this).val() );
		});
		// console.log(allVals);
		$.ajax({
			url: base_url+"admin/billing_resend",
			type:'POST',
			data:{
				bill_info: JSON.stringify(allVals)
			},
			success: function(res)
			{
				$('#vocadbmodal').modal('hide');
				console.log(res);
			}
		});
	});
	$('#batch_billing_now').on("click",function(e){
		e.preventDefault();
		$.ajax({
			url: base_url+"admin/batch_billing",
			type:'POST',
			data:{
				month: cal_month,
				year: cal_year
			},
			success: function(res)
			{
				if(res)
				{
					$('#batch_billing').modal('hide');
				}
				else
				{
					alert('error');
				}
			}
		});
	});
	$('#batch_billing_result').on("click",function(e){
		e.preventDefault();
		$.ajax({
			url: base_url+"admin/batch_billing_result",
			type:'POST',
			data:{
				month: cal_month,
				year: cal_year
			},
			success: function(res)
			{
				var result = JSON.parse(res);
				var tablebody = $('#batch_billing_table tbody');
				// console.log(res);
				if(table)
					table.destroy();
				tablebody.html('');
				for(i=0;i<result.length;i++)
				{
					tablebody.append('<tr><td> '+result[i].name+' </td><td> '+result[i].email+' </td><td>'+result[i].total+'</td><td>'+result[i].amount+'</td></tr>');
				}
				
				if(result.length == 0)
				{
					$("#batch_billing_now").css('display','none');
				}
				else
				{
					$("#batch_billing_now").css('display','inline');
				}
				
				$('#batch_billing_label').html('Billing for '+monthNames[cal_month-1]+' '+cal_year );
				$('#batch_billing').modal('show');

				table = $('#batch_billing_table').DataTable({
					"scrollCollapse": true,
					"paging":         false,
					"ordering": false,
					"info":     false,
					"oLanguage": 
					{
						"sInfo": 'Showing _END_ Sources.',
						"sInfoEmpty": 'Billing already issued.',
						"sEmptyTable": "Billing already issued.",
					}
				});
			}
		});
	});
	
	$('#reissue_billing').on("click",function(e){
		e.preventDefault();
		$.ajax({
			url: base_url+"admin/get_all_billed_users",
			type:'POST',
			// data:{
				// month: cal_month,
				// year: cal_year
			// },
			success: function(res)
			{
				// console.log(res);
				var result = JSON.parse(res);
				var tablebody = $('#reissue_billing_table tbody');
				if(table)
					table.destroy();
				tablebody.html('');
				
				for(i=0;i<result.length;i++)
				{
					var billing_date = result[i].billing_date;
					var billing_date_issue = result[i].billing_date_issue;
					tablebody.append('<tr><td><input type="checkbox" value=\''+JSON.stringify(result[i])+'\'/></td><td> '+result[i].name+' </td><td> '+result[i].email+' </td><td>'+result[i].total+'</td><td>'+result[i].amount+'</td><td>'+billing_date+'</td><td>'+billing_date_issue+'</td></tr>');
				}
				$('#myModalLabel').html('Billing for '+monthNames[cal_month-1]+' '+cal_year );
				$('#re_issue .modal-dialog').width('800px');
				$('#re_issue').modal('show');
				table = $('#reissue_billing_table').DataTable({

					"scrollCollapse": true,
					"paging":         false,
					"ordering": false,
					"info":     false,
				});
			}
		});
	});
	$('#re_issue_now').on("click",function(e){
		e.preventDefault();
		var allVals = [];
		$('#reissue_billing_table tbody :checked').each(function() {
			allVals.push( $(this).val() );
		});
		// console.log(allVals);
		$.ajax({
			url: base_url+"admin/billing_reissue",
			type:'POST',
			data:{
				bill_info: JSON.stringify(allVals)
			},
			success: function(res)
			{
				// $('#vocadbmodal').modal('hide');
				$('#re_issue').modal('hide');
			}
		});
	});
});
</script>