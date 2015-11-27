<!-- <script src="<?php //echo base_url().'resources/js/Chart.js'?>"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
<style type="text/css">
canvas{
        width: 100% !important;

		max-width: 100%;
		height: 600px;
		max-height: 600px;
        height: auto !important;
    }
.chart_buttons
{
	margin: 0px;
	padding: 40px 20px;
}

.panel-heading:hover{
	cursor:pointer;
}
#datatable1_paginate
{
	position: absolute;
	right: 0px;
	top: 30px;
}
#datatable1_info
{
	position: absolute;
	left: 0px;
	top: 30px;
}

#table_msg, #chart_msg
{
	font-size: 16px;
	text-align: center;
}
.byusage tr
{
		text-align: right;
}
.show_apikey
{
	font-size: 17px;
	text-align: center;
	padding: 15px;
}
.show_apikey input
{
	border: 0px solid black;
	border-bottom: 1px solid black;
	text-align: center;
	
}

</style>
	<div class="show_apikey">
		<label>API Key: <input size="32" class="form-group" type="text" value="<?php echo $Nvoca['api_key']; ?>" readonly="true" />
	</div>
	<div class="panel-group" style="cursor:default;" >
	  <div class="panel panel-primary">
		<div class="panel-heading" align ="center">      
			<h4 id="chart_h4" href="#myChart" class="panel-title">Usage Chart</h4> <!-- <span style="position:absolute;right:30px;"><em class="fa fa-chevron-down"></em></span> -->
		</div>
	   
		<div id="collapse1" class="panel-collapse collapse in" style="padding:10px;text-align: center;"><span id="chart_msg">No Data</span>
		  <canvas id="myChart" class="collapse"></canvas> 
		</div>
	  </div>
	</div>
	<div class="">
        <div class="row graph span6">
            
			<br/>
		
			<div class="container-fluid chart_buttons" style="text-align: center;">
				<div class="col-xs-4 byitem">
					<button data-toggle="tooltip" data-placement="bottom" title="Total usage from specific date" class="btn btn-primary active" id="total">Total</button>
					<button data-toggle="tooltip" data-placement="bottom" title="Text usage from specific date" class="btn btn-default" id="text">Text</button>
					<button data-toggle="tooltip" data-placement="bottom" title="Usage by words from specific date" class="btn btn-default" id="word">Word</button>
					<button data-toggle="tooltip" data-placement="bottom" title="Translation with definition from specific date" class="btn btn-default" id="defi">Definition</button>
					<button data-toggle="tooltip" data-placement="bottom" title="total translation usage from specific date" class="btn btn-default" id="trans">Translation</button>
				</div>
				<div class="col-xs-4 bydate">
					<button class="btn btn-primary active" id="m1">last 1 month</button>
					<button class="btn btn-default" id="m3">Last 3 months</button>
					<button class="btn btn-default" id="m6">Last 6 months</button>
					<br>
					<button class="btn btn-default" id="mall">All</button>
					<button class="btn btn-default" id="bymonth">By Month</button>
					<!--<button class="btn btn-default" id="chart_advance_search">Advance Search</button>-->
				</div>
				<div class="col-xs-4 byusage">

					<label class="radio_usage"><input type="radio" name="amountorcount" checked value="count"/>Calls</label><br>

					<label class="radio_usage"><input type="radio" name="amountorcount" value="amount"/>Bytes</label>

				</div>
			</div>
        </div>


		<div class="row panel-group">
		  <div class="panel panel-primary">
			<div class="panel-heading" align ="center">      
				<h4 href="#datatable1" class="panel-title">Usage Table</h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse in" style="padding:10px 10px 70px">
			  <table id="datatable1" align="center" style="width:50%;position: relative; top: 45px;" class='display table table-striped table-hover'>
			</table>
			<?php
				echo "Searched Time : ".($Nvoca['end_time'] - $Nvoca['start_time'])." Seconds<br>";
				echo "Start Time : ". $Nvoca['start_time'] ."<br>";
				echo "End Time : ". $Nvoca['end_time'];
			?>
			</div>
		  </div>
		</div>
		<!--
		<table align="center" class="display table table-striped table-hover" style="width:50%" id="datatable1">
		<tbody><tr><td>09-30-2015</td><td>16</td></tr><tr><td>10-01-2015</td><td>16</td></tr><tr><td>10-02-2015</td><td>16</td></tr><tr><td>10-03-2015</td><td>16</td></tr><tr><td>10-04-2015</td><td>16</td></tr><tr><td>10-05-2015</td><td>16</td></tr><tr><td>10-06-2015</td><td>16</td></tr><tr><td>10-07-2015</td><td>16</td></tr><tr><td>10-08-2015</td><td>16</td></tr><tr><td>10-09-2015</td><td>16</td></tr><tr><td>10-10-2015</td><td>16</td></tr><tr><td>10-11-2015</td><td>16</td></tr><tr><td>10-12-2015</td><td>16</td></tr><tr><td>10-13-2015</td><td>16</td></tr><tr><td>10-14-2015</td><td>16</td></tr><tr><td>10-15-2015</td><td>16</td></tr><tr><td>10-16-2015</td><td>16</td></tr><tr><td>10-17-2015</td><td>16</td></tr><tr><td>10-18-2015</td><td>16</td></tr><tr><td>10-19-2015</td><td>16</td></tr><tr><td>10-20-2015</td><td>16</td></tr><tr><td>10-21-2015</td><td>16</td></tr><tr><td>10-22-2015</td><td>16</td></tr><tr><td>10-23-2015</td><td>16</td></tr><tr><td>10-24-2015</td><td>16</td></tr><tr><td>10-25-2015</td><td>16</td></tr><tr><td>10-26-2015</td><td>16</td></tr><tr><td>10-27-2015</td><td>16</td></tr><tr><td>10-28-2015</td><td>32</td></tr><tr><td>10-29-2015</td><td>9</td></tr></tbody></table>
		-->
		
	</div>
<!-- Modal for footer -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<form id="changepass">
    <div class="modal-content">
    <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Advance search</h4>
    </div>
    <div class="modal-body">
		<div class="row">
			<div class="col-xs-6">
				<input placeholder="From" type='text' class="form-control" id='date_from' />
			</div>
			<div class="col-xs-6">
				<input placeholder="To" type='text' class="form-control" id='date_to' />
			</div>
		</div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
	</form>
  </div>
</div>
<script type="text/javascript">
// $('body').addClass("csspinner traditional");
var text_result = JSON.parse('<?php echo json_encode($Nvoca['text_result']); ?>');
var ctx = $("#myChart").get(0).getContext("2d");
var vocadbchart;
var amountorcount = 'count';
var current_height = $("#scalingnav").height();
//Total
$('#total').click(function(){
	var ext = 'total';
	var data = construct_data(ext);
	var dateArray = Object.keys(text_result[ext]);
	var lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]][amountorcount] );
	}
	construct_table( dateArray, lengthArray );

	if ($("#myChart").hasClass('collapse in')) {
		if(typeof(vocadbchart) != 'undefined')
			vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data,{showTooltips: false});
	}
	buttonchange( $(this) );
});
//Text
$('#text').click(function(){
	var ext = 'text';
	var data = construct_data(ext);
	var dateArray = Object.keys(text_result[ext]);
	var lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]][amountorcount] );
	}
	construct_table( dateArray, lengthArray );
	if ($("#myChart").hasClass('collapse in')) {
		vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data,{showTooltips: false});
	}
	buttonchange( $(this) );
});

//Word
$('#word').click(function(){
	var ext = 'word';
	var data = construct_data(ext);
	var dateArray = Object.keys(text_result[ext]);
	var lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]][amountorcount] );
	}
	construct_table( dateArray, lengthArray );
	if ($("#myChart").hasClass('collapse in')) {
		vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data,{showTooltips: false});
	}
	buttonchange( $(this) );
});

//Definition
$('#defi').click(function(){
	var ext = 'defi';
	var data = construct_data(ext);
	var dateArray = Object.keys(text_result[ext]);
	var lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]][amountorcount] );
	}
	construct_table( dateArray, lengthArray );
	if ($("#myChart").hasClass('collapse in')) {
		vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data,{showTooltips: false});
	}
	buttonchange( $(this) );
});

//Translation
$('#trans').click(function(){
	var ext = 'trans';
	var data = construct_data(ext);
	var dateArray = Object.keys(text_result[ext]);
	var lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]][amountorcount] );
	}
	construct_table( dateArray, lengthArray );
	if ($("#myChart").hasClass('collapse in')) {
		vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data,{showTooltips: false});
	}
	buttonchange( $(this) );
});

function construct_data(ext)
{
	if( typeof(text_result.total.length) == 'undefined' )
	{
		$("#myChart").addClass('in');
		$("#chart_msg").html('');
	}
	else
	{
		$("#myChart").removeClass('in');
		$("#chart_msg").html('No Data');
	}
	var dateArray = Object.keys(text_result[ext]);
	console.log(dateArray);
	var lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]][amountorcount] );
	}
	if( dateArray.length > 15 )
	{
		var skip_count = Math.round(dateArray.length/20);
		var ctr = 0;
		for( i=1;i<dateArray.length;i++ )
		{
			// var datearray_value = dateArray[i];
			// console.log(datearray_value);
			// var dt  = datearray_value.split(/\-|\s/);
			// var me = dt[2]+'-'+dt[0]+'-'+dt[1];

			// dateArray[i] = new Date( me );
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
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: lengthArray

			},
		]
	};
	if( lengthArray.length <= 0 )
	{
		// $("#myChart").html("No value.");
	}
	
	return data;
}

function construct_table(tblabels,tbdatas)
{
	if( tblabels.length <= 0  && tbdatas.length <= 0 )
	{
		if(typeof(mytable) != 'undefined')
		{
			mytable.destroy();
		}
		$('#datatable1').html("");
		$('#datatable1').html(
			"<thead><tr><th>"+"No Data"+"</th></tr></thead><tbody>&nbsp;</tbody>");
		mytable = $('#datatable1').DataTable();
		$("#datatable1_length").css('display','none');
		$("#datatable1_info").css('display','none');
		$("#datatable1_filter").css('display','none');
		$("#datatable1_paginate").css('display','none');
	}
	else
	{
		var value_thead = 'Bytes';
		if(amountorcount == 'count')
		{
			value_thead = 'Calls';
		}
		$('#datatable1').html("");
		if(typeof(mytable) != 'undefined')
			mytable.destroy();
		$('#datatable1').html(
			"<thead><tr><th>"+"Date"+"</th><th>"+value_thead+"</th></tr></thead><tbody>");
		for( x=0; x < tblabels.length; x++)
		{
			$('#datatable1').append(
			"<tr><td>"+tblabels[x]+"</td><td>"+tbdatas[x]+"</td></tr>");
		}
		$('#datatable1').append("</tbody>");
		mytable = $('#datatable1').DataTable();
	}

	if( $("#scalingcontent").height() > $("#scalingnav").height() )
	{
		$("#scalingnav").height( $("#scalingcontent").height()+40 );
		$("#scalingright").height( $("#scalingcontent").height()+40 );
	}
	else if ( current_height > $("#scalingcontent").height() )
	{
		$("#scalingnav").height( current_height );
		$("#scalingright").height( current_height );
	}
}

$('#count').click(function(){
	amountorcount = 'count';
	buttonchange( $(this) );
	$('.byitem').find('button.active').trigger( 'click' );
});
$('#amnt').click(function(){
	amountorcount = 'amount';
	buttonchange( $(this) );
	$('.byitem').find('button.active').trigger( 'click' );
});

$('input[name="amountorcount"]').change(function(e){
	amountorcount = $(this).val();
	$('.byitem').find('button.active').trigger( 'click' );
});

$('#m1').click(function(){
	$('.panel-group').addClass("csspinner traditional");
	var thisselector = $(this);
	$.ajax({
		url: base_url+"monthstats_users",
		type:'POST',
		data:{num: 1},
		success: function(res)
		{
			// console.log(res);
			text_result = JSON.parse( res );
			$('.byitem').find('button.active').trigger( 'click' );
			buttonchange( thisselector );
		},
		complete: function()
		{
			$('.panel-group').removeClass("csspinner traditional");
		}
	});
	
});

$('#m3').click(function(){
	$('.panel-group').addClass("csspinner traditional");
	var thisselector = $(this);
	$.ajax({
		url: base_url+"monthstats_users",
		type:'POST',
		data:{num: 3},
		success: function(res)
		{
			// console.log(res);
			text_result = JSON.parse( res );
			$('.byitem').find('button.active').trigger( 'click' );
			buttonchange( thisselector );
		},
		complete: function()
		{
			$('.panel-group').removeClass("csspinner traditional");
		}
	});
});

$('#m6').click(function(){
	$('.panel-group').addClass("csspinner traditional");
	var thisselector = $(this);
	$.ajax({
		url: base_url+"monthstats_users",
		type:'POST',
		data: {num: 6},
		success: function(res)
		{
			// console.log(res);
			text_result = JSON.parse( res );
			$('.byitem').find('button.active').trigger( 'click' );
			buttonchange( thisselector );
		},
		complete: function()
		{
			$('.panel-group').removeClass("csspinner traditional");
		}
	});
});

$('#mall').click(function(){
	$('.panel-group').addClass("csspinner traditional");
	var thisselector = $(this);
	$.ajax({
		url: base_url+"monthstats_users",
		type:'POST',
		data: {num: 'all'},
		success: function(res)
		{
			// console.log(res);
			text_result = JSON.parse( res );
			$('.byitem').find('button.active').trigger( 'click' );
			buttonchange( thisselector );
		},
		complete: function()
		{
			$('.panel-group').removeClass("csspinner traditional");
		}
	});
});

$('#bymonth').click(function(){
	$('.panel-group').addClass("csspinner traditional");
	var thisselector = $(this);
	$.ajax({
		url: base_url+"monthstats_users",
		type:'POST',
		data: {num: 'bymonth'},
		success: function(res)
		{
			// console.log(res);
			text_result = JSON.parse( res );
			$('.byitem').find('button.active').trigger( 'click' );
			buttonchange( thisselector );
		},
		complete: function()
		{
			$('.panel-group').removeClass("csspinner traditional");
		}
	});
});


function buttonchange(content)
{
	content.siblings().removeClass('active').removeClass('btn-primary').addClass('btn-default');
	content.addClass('active').removeClass('btn-default').addClass('btn-primary');
}

$("#chart_advance_search").on("click",function(){
	$("#vocadbmodal").modal('show');
});

$(document).ready(function() {
	// console.log(text_result.length);
	if( typeof(text_result.total.length) == 'undefined' )
	{
		// $('#chart_h4').trigger( "click" );
		$("#myChart").addClass('in');
		// console.log('nothing to show');
	}
	$( "#total" ).trigger( "click" );
	mytable = $('#datatable1').DataTable();
	// $("#scalingnav").height( $("#scalingcontent").height() );
	$('[data-toggle="tooltip"]').tooltip(); 
	$('body').removeClass("csspinner traditional");
	
	$('#date_from').datetimepicker({
		format: 'YYYY-MM'
		});
	$('#date_to').datetimepicker({
		format: 'YYYY-MM',
		});
	$('.picker-switch').css('display','none');
});
</script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()."resources/" ?>vendor/moment/min/moment-with-langs.min.js"></script>
<script src="<?php echo base_url()."resources/" ?>vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
