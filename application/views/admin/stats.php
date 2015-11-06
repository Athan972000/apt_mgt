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
	padding: 0px 20px;
}
.byitem
{
	text-align:left;
	z-index: 9999;
	position: relative;
	margin-right:25%;
}

.byusage
{
	text-align: right;
	position:relative;
	bottom: 46px;
}
.bydate
{
	text-align: center;
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
</style>
	
	<div class="panel-group">
	  <div class="panel panel-primary">
		<div class="panel-heading" align ="center">      
			<h4 id="chart_h4" data-toggle="collapse" href="#myChart" class="panel-title">Usage Chart<span style="position:absolute;right:30px;"><em class="fa fa-chevron-down"></em></span></h4>
		</div>
	   
		<div id="collapse1" class="panel-collapse collapse in" style="padding:10px">
		  <canvas id="myChart" class="collapse in"></canvas> 
		</div>
	  </div>
	</div>
	<div class="row container-fluid">
        <div class="graph span6">
            
			<br/>
		
			<div class="chart_buttons">
				<div class="byitem">
					<button class="btn btn-primary btn-lg active" id="total">Total</button>
					<button class="btn btn-default btn-lg" id="text">Text</button>
					<button class="btn btn-default btn-lg" id="word">Word</button>
					<button class="btn btn-default btn-lg" id="defi">Definition</button>
				</div>
				<div class="byusage">
					<button class="btn btn-primary btn-lg active" id="count">Count</button>
					<button class="btn btn-default btn-lg" id="amnt">Amount</button>
				</div>
				<div class="bydate">
					<button class="btn btn-primary btn-lg active" id="m1">1 month</button>
					<button class="btn btn-default btn-lg" id="m3">3 months</button>
					<button class="btn btn-default btn-lg" id="m6">6 months</button>
				</div>
			</div>
        </div>
		<br/>
		
		<div class="panel-group">
		  <div class="panel panel-primary">
			<div class="panel-heading" align ="center">      
				<h4 href="#datatable1" class="panel-title">Usage Table</h4>
			</div>
		   
			<div id="collapse1" class="panel-collapse collapse in" style="padding:10px 10px 70px">
			  <table id="datatable1" align="center" style="width:50%;position: relative; top: 45px;" class='display table table-striped table-hover'>
			</table>
			</div>
		  </div>
		</div>
		<!--
		<table align="center" class="display table table-striped table-hover" style="width:50%" id="datatable1">
		<tbody><tr><td>09-30-2015</td><td>16</td></tr><tr><td>10-01-2015</td><td>16</td></tr><tr><td>10-02-2015</td><td>16</td></tr><tr><td>10-03-2015</td><td>16</td></tr><tr><td>10-04-2015</td><td>16</td></tr><tr><td>10-05-2015</td><td>16</td></tr><tr><td>10-06-2015</td><td>16</td></tr><tr><td>10-07-2015</td><td>16</td></tr><tr><td>10-08-2015</td><td>16</td></tr><tr><td>10-09-2015</td><td>16</td></tr><tr><td>10-10-2015</td><td>16</td></tr><tr><td>10-11-2015</td><td>16</td></tr><tr><td>10-12-2015</td><td>16</td></tr><tr><td>10-13-2015</td><td>16</td></tr><tr><td>10-14-2015</td><td>16</td></tr><tr><td>10-15-2015</td><td>16</td></tr><tr><td>10-16-2015</td><td>16</td></tr><tr><td>10-17-2015</td><td>16</td></tr><tr><td>10-18-2015</td><td>16</td></tr><tr><td>10-19-2015</td><td>16</td></tr><tr><td>10-20-2015</td><td>16</td></tr><tr><td>10-21-2015</td><td>16</td></tr><tr><td>10-22-2015</td><td>16</td></tr><tr><td>10-23-2015</td><td>16</td></tr><tr><td>10-24-2015</td><td>16</td></tr><tr><td>10-25-2015</td><td>16</td></tr><tr><td>10-26-2015</td><td>16</td></tr><tr><td>10-27-2015</td><td>16</td></tr><tr><td>10-28-2015</td><td>32</td></tr><tr><td>10-29-2015</td><td>9</td></tr></tbody></table>
		-->
		
	</div>
<script type="text/javascript">
var text_result = JSON.parse('<?php echo json_encode($Nvoca['text_result']); ?>');
var ctx = $("#myChart").get(0).getContext("2d");
var vocadbchart;
var amountorcount = 'count';
//Total
$('#total').click(function(){
	var data = construct_data('total');
	construct_table( data.labels, data.datasets[0].data );

	if ($("#myChart").hasClass('collapse in')) {
		if(typeof(vocadbchart) != 'undefined')
			vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data);
	}
	buttonchange( $(this) );
});
//Text
$('#text').click(function(){
	var data = construct_data('text');
	construct_table( data.labels, data.datasets[0].data );
	if ($("#myChart").hasClass('collapse in')) {
		vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data);
	}
	buttonchange( $(this) );
});

//Word
$('#word').click(function(){
	var data = construct_data('word');
	construct_table( data.labels, data.datasets[0].data );
	if ($("#myChart").hasClass('collapse in')) {
		vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data);
	}
	buttonchange( $(this) );
});

//Definition
$('#defi').click(function(){
	var data = construct_data('defi');
	construct_table( data.labels, data.datasets[0].data );
	if ($("#myChart").hasClass('collapse in')) {
		vocadbchart.destroy();
		vocadbchart = new Chart(ctx).Line(data);
	}
	buttonchange( $(this) );
});

function construct_data(ext)
{
	if( typeof(text_result.total.length) == 'undefined' )
	{
		$("#myChart").addClass('in');
	}
	else
	{
		$("#myChart").removeClass('in');
	}
	var dateArray = Object.keys(text_result[ext]);
	var lengthArray = [];
	for( i=0; i<dateArray.length; i++ )
	{
		lengthArray.push( text_result[ext][dateArray[i]][amountorcount] );
	}
	var data = {
		labels: dateArray,
		datasets: [
			{
				
				label: "My First dataset",
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
	$('#datatable1').html("");
	if(typeof(mytable) != 'undefined')
		mytable.destroy();
	$('#datatable1').html(
		"<thead><tr><th>"+"Date"+"</th><th>"+"Amount/Count"+"</th></tr></thead><tbody>");
	for( x=0; x < tblabels.length; x++)
	{
		$('#datatable1').append(
		"<tr><td>"+tblabels[x]+"</td><td>"+tbdatas[x]+"</td></tr>");
	}
	$('#datatable1').append("</tbody>");
	mytable = $('#datatable1').DataTable();
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

$('#m1').click(function(){
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
		}
	});
	
});

$('#m3').click(function(){
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
		}
	});
});

$('#m6').click(function(){
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
		}
	});
});

function buttonchange(content)
{
	content.siblings().removeClass('active').removeClass('btn-primary').addClass('btn-default');
	content.addClass('active').removeClass('btn-default').addClass('btn-primary');
}

$(document).ready(function() {
	// console.log(text_result.length);
	if( typeof(text_result.total.length) != 'undefined' )
	{
		$('#chart_h4').trigger( "click" );
	}
	$( "#total" ).trigger( "click" );
	mytable = $('#datatable1').DataTable();
	// $("#scalingnav").height( $("#scalingcontent").height() );
	} );

</script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
