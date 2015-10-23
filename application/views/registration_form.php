<?php
	defined('BASEPATH') OR exit('No direct script access allowed');?>
	<body>
		<div style="height: 100%; padding: 50px 0; background-color: #2c3037" class="row row-table">
			<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">
			<div  class="panel panel-default panel-flat">
					<div id="main">
						<div id="login">
						<p class="text-center mb-lg">
							<br>
								<a href="#">
									<img src="<?php echo base_url()."resources/images/logo_blue_white.png"; ?>" alt="Image" class="block-center img-rounded">
								</a>
							</p>
							<p class="text-center mb-lg">
								<strong>FILL IN INFORMATION</strong>
							</p>
							<div class="panel-body">
								<?php 
									echo form_open('new_user_registration'); 
									echo "<div class='error_msg'>";
									if (isset($error_message)) {
										echo $error_message;
									}
									//echo validation_errors();
									echo "</div>";
								?>
							</div>
							
							
							<form id="vocadb_regform" action="" method="post" data-toggle="validator">
							<div class="panel-body">
								<div class="form-group has-feedback">
									<input type="text" type="email" name="email" id="name" placeholder="email address" class="form-control" 
									data-toggle="popover" data-placement="top" data-content="Please enter a valid email address."
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="password" name="password" id="password" placeholder="Password" class="form-control"
									data-toggle="popover" data-placement="top" data-content="Password atleast 6 Alpha-Numeric characters"
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="password" name="repassword" id="repassword" placeholder="Confirm Password" class="form-control"
									data-toggle="popover" data-placement="top" data-content="Password do not match"
									/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
							
								<div class="clearfix">
									<div class="checkbox c-checkbox pull-left mt0">
										<label>
										   <input id="terms" type="checkbox" value="">
										   <span class="fa fa-check"></span>I agree with the <a href="#">terms</label>							
									</div>
								</div>
								
								<div class="form-group has-feedback">
									<button type="submit" class="btn btn-block btn-primary" name="submit"> Register</button>
								</div>
							</div>
							</form>
							
						</div>
					</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url()."resources/vendor/jquery.min.js"; ?>"></script>
		<script type="text/javascript">
		$('#vocadb_regform').submit(function (e) {
			var name = $('#name').val();
			var emailregex = /.+@.+/;
			if( !name || !name.match(emailregex) )
			{
				e.preventDefault();
				$('#name').parent('div').addClass("has-error");
				$('#name').popover('show');
			}
			else
			{
				$('#name').parent('div').removeClass("has-error");
			}
			
			var pword = $('#password').val();
			var cpword = $('#repassword').val();
			if( !pword || !cpword || pword.length < 6 )
			{
				e.preventDefault();
				$('#password').parent('div').addClass("has-error");
				$('#repassword').parent('div').addClass("has-error");
				$('#password').popover('show');
			}
			else
			{
				$('#password').parent('div').removeClass("has-error");
				$('#repassword').parent('div').removeClass("has-error");
			}
			
			if( pword != cpword )
			{
				e.preventDefault();
				$('#repassword').parent('div').addClass("has-error");
				$('#repassword').popover('show');
			}
			else
			{
				$('#repassword').parent('div').removeClass("has-error");
			}
			if( !$('#terms').is(':checked') )
			{
				e.preventDefault();
				$('.clearfix ').addClass("has-error");
			}
			else
			{
				$('.clearfix ').removeClass("has-error");
			}
		});
		</script>
	</body>