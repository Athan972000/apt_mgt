<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div align="center">
Please confirm you email address<br/>
a confirmation email has been sent to <span id="email"><?php echo $email; ?></span><br/><br/>
If you don't see this email you can :<br/>
<ul>
	<li>Check you spam folder</li>
	<li><a id="resend" href="">Resend confirmation email</a></li>
</ul>
<span id="msg"></span>
</div>
<script type="text/javascript" src="<?php echo base_url()."resources/vendor/jquery.min.js"; ?>"></script>
<script type="text/javascript">
$('#resend').on("click", function(e){
	e.preventDefault();
	$.ajax({
		url: base_url+"login_process",
		type:'POST',
		data:
		{
			email: $("#email").val()
		},
		success: function(msg)
		{
			$('#msg').html(msg);
		}
	});
});
</script>