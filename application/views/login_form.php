
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');?>
	<body>
		
		<script>
		  // This is called with the results from from FB.getLoginStatus().
		  function statusChangeCallback(response) {
			console.log('statusChangeCallback');
			console.log(response);
			// The response object is returned with a status field that lets the
			// app know the current login status of the person.
			// Full docs on the response object can be found in the documentation
			// for FB.getLoginStatus().
			if (response.status === 'connected') {
			  // Logged into your app and Facebook.
			  testAPI();
			} else if (response.status === 'not_authorized') {
			  // The person is logged into Facebook, but not your app.
			  document.getElementById('status').innerHTML = 'Please log ' +
				'into this app.';
			} else {
			  // The person is not logged into Facebook, so we're not sure if
			  // they are logged into this app or not.
			  document.getElementById('status').innerHTML = 'Please log ' +
				'into Facebook.';
			}
		  } 

		  // This function is called when someone finishes with the Login
		  // Button.  See the onlogin handler attached to it in the sample
		  // code below.
		  function checkLoginState() {
			FB.getLoginStatus(function(response) {
			  statusChangeCallback(response);
			});
		  }

		  window.fbAsyncInit = function() {
		  FB.init({
			appId      : '421425981381311',
			cookie     : true,  // enable cookies to allow the server to access 
								// the session
			xfbml      : true,  // parse social plugins on this page
			version    : 'v2.5' // use version 2.2
		  });

		  // Now that we've initialized the JavaScript SDK, we call 
		  // FB.getLoginStatus().  This function gets the state of the
		  // person visiting this page and can return one of three states to
		  // the callback you provide.  They can be:
		  //
		  // 1. Logged into your app ('connected')
		  // 2. Logged into Facebook, but not your app ('not_authorized')
		  // 3. Not logged into Facebook and can't tell if they are logged into
		  //    your app or not.
		  //
		  // These three cases are handled in the callback function.

		  FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		  });

		  };

		  // Load the SDK asynchronously
		  (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));

		  // Here we run a very simple test of the Graph API after login is
		  // successful.  See statusChangeCallback() for when this call is made.
		  function testAPI() {
			console.log('Welcome!  Fetching your information.... ');
			FB.api('/me', function(response) {
			  console.log('Successful login for: ' + response.email);
			  document.getElementById('status').innerHTML =
				'Thanks for logging in, ' + response.email + '!';
			});
		  }
		</script>
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
									<a href="<?php echo base_url().'index.php/register' ?>">To SignUp Click Here</a>
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
								
								<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
