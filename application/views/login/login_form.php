<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
		var base_url = "<?php echo base_url();?>";
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
			$('body').addClass("csspinner traditional");
			FB.login(function(response) {
			  statusChangeCallback(response);
			},{ scope: 'email' });
		  }

		  window.fbAsyncInit = function() {
		  FB.init({
			appId      : '642467622561438',
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
			// statusChangeCallback(response);
		  });

		  };
		  function logout_fb()
		  {
			  FB.logout(function(response) {
				  console.log(response);
				});
		  }
			

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
			FB.api('/me?fields=name,email,picture', function(response) {
			console.log(JSON.stringify(response));
			  console.log('Successful login for: ' + response.email);
			  // document.getElementById('status').innerHTML =
				// 'Thanks for logging in, ' + response.name + '!';
				$.ajax({
					url: base_url+"login/login_process",
					type:'POST',
					data:
					{
						email: response.email,
						name: response.name,
						pic: response.picture.data.url,
						fromfb: true
					},
					success: function(msg)
					{
						var result = JSON.parse(msg);
						// $('#vocamodalmsg').html(result.msg);
						// $('#vocadbmodal').modal('show');
						if(result.state)
						{
							var color = 'red';
							if( result.msg == "Logging in.." )
							{
								color = 'green';
							}
							
							$('#login_msg').html(result.msg).css('color',color);
							setTimeout(openUrl(result.link), 4000);
						}
						else
						{
							$('body').removeClass("csspinner traditional");
						}
					}
				});
				
			});
			// $('body').removeClass("csspinner traditional");
		  }
		function openUrl(url)
		{
			window.location = url;
		}
		</script>
<style>
.login_header
{
	background-color: #4486F6;
	border-radius: 3px;
	padding-bottom: 20px;
}
</style>
		<div style="height: 100%; padding: 50px 0; background-color: #2c3037" class="row row-table">
			<div class="col-lg-4 col-md-7 col-sm-8 col-xs-12" align="center">
				<div class="panel panel-default panel-flat" style="max-width:600px; min-width:300px;">
           
					<div id="main">
						<div id="login">
							<p class="login_header text-center mb-lg">
							<br>
								<a href="#">
									<img src="<?php echo base_url()."resources/images/logo_blue_white.png"; ?>" alt="Image" class="block-center img-rounded">
								</a>
							</p>

							<div class="panel-body" style="margin-top: 30px;">	
								<?php 
									echo form_open('login_process'); 
									echo "<div class='error_msg'>";
									if (isset($error_message)) {
										echo $error_message;
									}
									echo validation_errors();
									echo "</div>";
								?>

								<div class="form-group has-feedback">
									<input required type="text" name="email" id="name" placeholder="* Email Address" class="form-control"/>
									
								</div>
								<div class="form-group has-feedback">
									<input required type="password" name="password" id="password" placeholder="* Password" class="form-control"/>
									
								</div>
								<div align="left" id="login_msg"></div>
								<div class="clearfix" height="15px;">
									<!--<div class="checkbox c-checkbox pull-left mt0">
										<label>
										   <input type="checkbox" value="">
										   <span class="fa fa-check"></span>Remember Me</label>							
									</div>-->
									&nbsp;
								</div>
								<button type="submit" class="btn btn-block btn-primary" name="submit"> Login</button>
								<br />
								
								<div class="clearfix">
									<!-- <fb:login-button onlogin="checkLoginState();">Log in using Facebook</fb:login-button> -->
									<div class="pull-left"><a class="addspinner_whenclick" style="position:relative;right:0px;" href="<?php echo base_url().'login/register' ?>">
										<button type="button" class="btn btn-default">Register here!</button>
									</a></div>
									<button type="button" onclick="checkLoginState();" class="btn btn-primary" style="background-color: rgb(69, 97, 157); font-size: 20px;"><span class="fa fa-facebook"></span></button>
									<button type="button" onclick="donothing();" class="btn btn-primary" style="background-color: #5EA9DD; font-size: 20px;"><span class="fa fa-twitter"></span></button>
									<button type="button" onclick="donothing();" class="btn btn-primary" style="background-color: #CC2127; font-size: 20px;"><span class="fa fa-pinterest"></span></button>
									<div class="pull-right"><a id="forgotpass" href="#" class="text-muted">Forgot your password?</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		function donothing()
		{
			return;
		}
		
		$('form').submit(function (e) {
			$('body').addClass("csspinner traditional");
			e.preventDefault();
			var name = $('#name').val();
			var emailregex = /.+@.+/;
			if( !name )//|| !name.match(emailregex)
			{
				$('#name').parent('div').addClass("has-error");
				$('#name').popover('show');
			}
			else
			{
				$('#name').parent('div').removeClass("has-error");
				
				$.ajax({
					url: base_url+"login/login_process",
					type:'POST',
					data:
					{
						email: $("input[name=email]").val(),
						password: $("input[name=password]").val(),
					},
					success: function(msg)
					{
						var result = JSON.parse(msg);
						// $('.modal-footer :first-child').css('display','none');
						// $('#vocamodalmsg').html(result.msg).css('height','20px');
						// $('#myModalLabel').html('Login');
						// $('#vocadbmodal').modal('show');
						var color = 'red';
						if( result.msg == "Logging in.." )
						{
							color = 'green';
						}
						
						$('#login_msg').html(result.msg).css('color',color);
						if(result.state)
						{
							setTimeout(openUrl(result.link), 4000);
						}
						else
						{
							$('#name').parent('div').addClass("has-error");
							$('#password').parent('div').addClass("has-error");
							$('body').removeClass("csspinner traditional");
						}
					}
				});
			}
		});
		
		$('#forgotpass').on('click',function(e){
			e.preventDefault();
			$('#vocamodalmsg').html($('fieldset').html()).css('height',$('fieldset').css('height'));
			$('#myModalLabel').html('Password Recovery');
			$('.modal-footer :first-child').css('display','inline');
			$('#vocadbmodal').modal('show');
		});
		
		$( document ).ready(function(){
			$('.modal-footer :first-child').on('click',function(){
				
				$.ajax({
					url: base_url+"login/forgotpass",
					type:'POST',
					data:
					{
						email: $('#vocamodalmsg input').val(),
					},
					success: function(msg)
					{
						if(msg)
						{
							$('#vocamodalmsg input').parent('div').removeClass('has-error');
							$('#vocamodalmsg input').parent('div').addClass('has-success');
							$('#vocamodalmsg .help-block').html('An email has been sent to your Email address with your login information.');
						}
						else
						{
							//error
							$('#vocamodalmsg input').parent('div').removeClass('has-success');
							$('#vocamodalmsg input').parent('div').addClass('has-error');
							$('#vocamodalmsg .help-block').html('email not yet registered, please proceed to <a href="<?php echo base_url().'login/register' ?>">registration</a>.');
						}
					}
				});
			});
		});
			
		</script>
<!-- Modal for footer -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
        <p id="vocamodalmsg" ></p>
      </div>
      <div class="modal-footer">
		<button style="display: none;" type="button" class="btn btn-primary">Retrieve Password</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<fieldset style="display: none;">
	<div class="form-group">
		<label class="col-sm-2 control-label">Email Address</label>
		<div class="col-sm-10">
			<input type="text" class="form-control">
			<span class="help-block m-b-none">Your login information will be sent into your email address.</span>
		</div>
	</div>
</fieldset>
</body>
