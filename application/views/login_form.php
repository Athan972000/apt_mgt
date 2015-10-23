
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');?>
	<body>
		<div style="height: 100%; padding: 50px 0; background-color: #2c3037" class="row row-table">
			<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">
				<?php
					if (isset($logout_message)) {
						echo "<div class='message'>";
						echo $logout_message;
						echo "</div>";
					}
				?>
				<?php
					if (isset($message_display)) {
						echo "<div class='message'>";
						echo $message_display;
						echo "</div>";
					}
				?>
				<div  class="panel panel-default panel-flat">
           
					<div id="main">
						<div id="login">
							<p class="text-center mb-lg">
							<br>
								<a href="#">
									<img src="resources/images/logo_blue_white.png" alt="Image" class="block-center img-rounded">
								</a>
							</p>
							<p class="text-center mb-lg">
								<strong>SIGN IN TO CONTINUE.</strong>
							</p>
							<div class="panel-body">	
								<?php 
									//echo form_open('user_authentication/user_login_process'); 
									echo "<div class='error_msg'>";
									if (isset($error_message)) {
										echo $error_message;
									}
									//echo validation_errors();
									echo "</div>";
								?>
								<div align = "right">
									<a href="<?php echo base_url().'register' ?>">To SignUp Click Here</a>
								</div>
								
								<div class="form-group has-feedback">
									<input type="text" name="email" id="name" placeholder="email address" class="form-control"/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="password" name="password" id="password" placeholder="Password" class="form-control"/>
									<span class="fa fa-lock form-control-feedback text-muted"></span>
								</div>
								
								<div class="clearfix">
									<div class="checkbox c-checkbox pull-left mt0">
										<label>
										   <input type="checkbox" value="">
										   <span class="fa fa-check"></span>Remember Me</label>							
									</div>
									<div class="pull-right"><a href="#" class="text-muted">Forgot your password?</a>
									</div>
								</div>
								<button type="submit" class="btn btn-block btn-primary" name="submit"> Login</button><br />
								
		
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
