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
							
							
							<form action="" method="post" data-toggle="validator">
							<div class="panel-body">
								<div class="form-group has-feedback">
									<input type="text" type="email" required name="email" id="name" placeholder="email address" class="form-control"/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								<div class="form-group has-feedback">
									<input pattern="^[a-zA-Z0-9]*$" type="password" required name="password" id="password" placeholder="Password" class="form-control"/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								<div class="form-group has-feedback">
									<input data-match="#password" type="password" required name="repassword" id="repassword" placeholder="Retype Password" class="form-control"/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
							
								<div class="clearfix">
									<div class="checkbox c-checkbox pull-left mt0">
										<label>
										   <input type="checkbox" required value="">
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
	</body>