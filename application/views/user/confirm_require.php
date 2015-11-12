<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div align="center">
Please confirm you email address<br/>
a confirmation email has been sent to <span id="email"><?php echo $Nvoca['email']; ?></span><br/><br/>
If you don't see this email you can :<br/>
<ul>
	<li>Check you spam folder</li>
	<li><a id="resend" href="">Resend confirmation email</a></li>
</ul>
<span id="msg"></span>
</div>
<script type="text/javascript">
var base_url = '<?php echo base_url();?>';
// console.log($("#email").html());
$('#resend').on("click", function(e){
	e.preventDefault();
	$.ajax({
		url: base_url+"login/resend_confirm",
		type:'POST',
		data:
		{
			email: $("#email").html()
		},
		success: function(msg)
		{
			// console.log(msg);
			// $('#msg').html(msg);
			$('#msg').html("Confirmation Email Sent");
		}
	});
});
</script>