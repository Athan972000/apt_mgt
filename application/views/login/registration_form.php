<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
$link = "vocabdb";
$confirm = 0;
if( isset($Nvoca['fb_link']) )
{
	$link = $Nvoca['fb_link'];
}
if( isset($Nvoca['fb_confirm']) )
{
	$confirm = $Nvoca['fb_confirm'];
}
echo "<script type='text/javascript'>
var link = '".$link."';
var confirm = ".$confirm.";	
</script>";
?>
<style>
.login_header
{
	background-color: #4486F6;
	border-radius: 3px;
	padding-bottom: 20px;
}
</style>
		<div style="height: 100%; padding: 50px 0; background-color: #2c3037" class="row row-table">
			<div style="padding:0px;" class="col-lg-4 col-md-7 col-sm-8 col-xs-12">
			<div class="panel panel-default panel-flat" style="max-width:600px; min-width:300px;">
					<div id="main">
						<div id="login">
						<p class="login_header text-center mb-lg">
							<br>
								<a href="#">
									<img src="<?php echo base_url()."resources/images/logo_blue_white.png"; ?>" alt="Image" class="block-center img-rounded">
								</a>
							</p>
							<p class="text-center mb-lg">
								<strong>FILL IN INFORMATION</strong>
							</p>
							
							<form id="vocadb_regform" action="" method="post" data-toggle="validator" data-parsley-validate novalidate>
							<div class="panel-body">
								
								<div class="form-group has-feedback">
									<input type="text" type="company" name="company" id="company" placeholder="Company" class="form-control" 
									required 
									/>
									
								</div>
							
								<div class="form-group has-feedback">
									<input <?php if(isset($Nvoca['fb_email'])){echo $Nvoca['fb_email'];}?>  type="text" type="email" name="email" id="name" placeholder="Email address" class="form-control" 
									required data-parsley-type="email" 
									/>
									
								</div>

								<div class="form-group has-feedback">
									<input <?php if(isset($Nvoca['fb_name'])){echo $Nvoca['fb_name'];}?> type="text" type="lname" name="lname" id="lname" placeholder="Name" class="form-control" 
									required 
									/>
									
								</div>
								
								
								
								<div class="form-group has-feedback">
									<input type="text" type="platform" name="platform" id="platform" placeholder="Platform? e.g. iOS,Android" class="form-control" 
									required 
									/>
									
								</div>
								
								<div class="form-group has-feedback">
									<textarea style="resize: none;" class="form-control" required type="search" name="how" placeholder="How to use? e.g. App and/or Web"></textarea>
									
								</div>
								
								<div class="form-group has-feedback">
									<select required name='vocadb_lang'  id='vocadb_lang'  class='form-control' >
										<option value='af' >Afrikaans - Afrikaans (af)</option>
										<option value='sh' >Albanian - shqiptar (sh)</option>
										<option value='ar'>Arabic - ‫العربية‬ (ar)</option>
											<option value='hy'>Armenian - հայերեն (hy)</option>
										<option value='az'>Azerbaijani - Azərbaycan (az)</option>
										<option value='ek'>Basque - Euskal (ek)</option>
										<option value='be'>Belarusian - беларускі (be)</option>
										<option value='bn'>Bengali - বাঙালি (bn)</option>
										<option value='bo'>Bosnian - bosanski (bo)</option>
											<option value='bg'>Bulgarian - ‪български (bg)</option>
										<option value='ca'>Catalan - Català (ca)</option>
										<option value='ce'>Cebuano - Cebuano (ce)</option>
										<option value='ch'>Chichewa - Chichewa (ch)</option>
											<option value='zh-CN'>Chinese Simplified  - ‪简体中文(zh-CN)</option>
											<option value='zh-TW'>Chinese Traditional - ‪繁體中文(zh-TW)</option>
											<option value='hr'>Croatian - ‪Hrvatski (hr)</option>
											<option value='cs'>Czech - ‪Čeština (cs)</option>
											<option value='da'>Danish - ‪Dansk (da)</option>
											<option value='nl'>Dutch - ‪Nederlands (nl)</option>
											<option selected value='en'>English - United States (en)</option>
										<option value='ep'>Esperanto - Esperanton (ep)</option>
										<option value='et'>Estonian - eesti (et)</option>
											<option value='tl'>Filipino - Pilipino (tl)</option>
											<option value='fi'>Finnish - ‪Suomi (fi)</option>
											<option value='fr'>French - ‪Français (fr)</option>
										<option value='ga'>Galician - galego (ga)</option>
											<option value='ka'>Georgian - ქართული(ka)</option>
											<option value='de'>German - ‪Deutsch (de)</option>
											<option value='el'>Greek - ‪Ελληνικά (el)</option>
											<option value='gj'>Gujarati - ગુજરાતી (gj)</option>
											<option value='hc'>Haitian Creole - kreyòl ayisyen (ka)</option>
											<option value='ha'>Hausa - Hausa (ha)</option>
											<option value='he'>Hebrew - עברית (he)</option>
											<option value='hi'>Hindi - ‪हिन्दी (hi)</option>
											<option value='hm'>Hmong - Hmong (hm)</option>
											<option value='hu'>Hungarian - ‪magyar (hu)</option>
											<option value='ic'>Icelandic - íslenska (ic)</option>
											<option value='ig'>Igbo - Igbo (ig)</option>
											<option value='id'>Indonesian - ‪Bahasa Indonesia (id)</option>
											<option value='ir'>Irish - Gaeilge (ir)</option>
											<option value='it'>Italian - ‪Italiano (it)</option>
											<option value='ja'>Japanese - ‪日本語 (ja)</option>
											<option value='jv'>Javanese - Jawa (jv)</option>
											<option value='kn'>Kannada - ಕನ್ನಡ (kn)</option>
											<option value='kz'>Kazakh - Қазақ (kz)</option>
											<option value='kh'>Khmer ខ្មែរ (kh)</option>
											<option value='ko'>Korean - ‪한국어 (ko)</option>
											<option value='lo'>Lao - ລາວ (lo)</option>
											<option value='lt'>Latin - Latine (lt)</option>
											<option value='lj'>Latvian - Latvijā (lj)</option>
											<option value='lv'>Lithuanian - Lietuvos (lv)</option>
											<option value='mc'>Macedonian - македонски (mc)</option>
											<option value='ml'>Malagasy - Malagasy (ml)</option>
											<option value='ms'>Malay - ‪Bahasa Melayu (ms)</option>
											<option value='my'>Malayalam - മലയാളം (my)</option>
											<option value='me'>Maltese - Malti (me)</option>
											<option value='ma'>Maori - Maori (ma)</option>
											<option value='mr'>Marathi - मराठी (mr)</option>
											<option value='mo'>Mongolian - Монгол (mo)</option>
											<option value='mm'>Myanmar (Burmese) (mm)</option>
											<option value='np'>Nepali - नेपाली (np)</option>
											<option value='no'>Norwegian - ‪norsk (no)</option>
											<option value='fa'>Persian - فارسی (fa)</option>
											<option value='pl'>Polish - ‪polski (pl)</option>
											<option value='pt'>Portuguese - ‪português  (pt)</option>
											<option value='pu'>Punjabi - ਪੰਜਾਬੀ ਦੇ (pu)</option>
											<option value='ro'>Romanian - ‪română (ro)</option>
											<option value='ru'>Russian - ‪Русский (ru)</option>
											<option value='sb'>Serbian - Srpski (sb)</option>
											<option value='se'>Sesotho - Sesotho (se)</option>
											<option value='si'>Sinhala - සිංහල (si)</option>
											<option value='sk'>Slovak - slovenský (sk)</option>
											<option value='sl'>Slovenian - ‪slovenščina (sl)</option>
											<option value='so'>Somali - Soomaali (so)</option>
											<option value='es'>Spanish - ‪Español (es)</option>
											<option value='su'>Sundanese - Sunda (su)</option>
											<option value='sw'>Swahili - Kiswahili (sw)</option>
											<option value='sv'>Swedish - ‪Svenska (sv)</option>
											<option value='tj'>Tajik - тоҷик (tj)</option>
											<option value='ta'>Tamil - தமிழ்(ta)</option>
											<option value='te'>Telugu - తెలుగు (te)</option>
											<option value='th'>Thai - ‪ไทย (th)</option>
											<option value='tr'>Turkish - ‪Türkçe (tr)</option>
											<option value='uk'>Ukrainian - ‪Українська (uk)</option>
											<option value='ur'>Urdu - اردو (ur)</option>
											<option value='uz'>Uzbek - O'zbekiston (uz)</option>
											<option value='vi'>Vietnamese - ‪Tiếng Việt(vi)</option>
											<option value='we'>Welsh - Cymraeg (we)</option>
											<option value='yi'>Yiddish - ייִדיש (yi)</option>
											<option value='yo'>Yoruba - yorùbá (yo)</option>
											<option value='zu'>Zulu - Zulu (zu)</option>
									</select>
								<input type="hidden" name="nvoca_pic" value="<?php echo $Nvoca['fb_pic']; ?>"/>
									
								</div>
<?php if( isset($Nvoca['cancel_pass']) )
{
	echo '
			<input type="hidden" name="password" id="password" value="0"/>
	';
}
else
{
	echo '<div class="form-group has-feedback">
			<input type="password" name="password" id="password" placeholder="Password" class="form-control" required data-parsley-type="alphanum"/>
		</div>
		<div class="form-group has-feedback">
			<input type="password" name="repassword" id="repassword" placeholder="Confirm Password" class="form-control"required data-parsley-equalto="#password"/>
		</div>';
}
?>
								<div class="clearfix">
									<div class="checkbox c-checkbox pull-left mt0">
										<label>
										   <input required id="terms" type="checkbox" value="">
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
		<script type="text/javascript">
		function openUrl()
		{
			window.location = base_url;
		}
		
		var base_url = "<?php echo base_url().'login/';?>";
		$('#vocadb_regform').on("submit",function (e) {
			$('body').addClass("csspinner traditional");
			var f = $(this);
			f.parsley().validate();

			if (f.parsley().isValid()) 
			{
				e.preventDefault();
				$.ajax({
					url: base_url+"new_user_registration",
					type:'POST',
					data:
					{
						company: $("input[name=company]").val(),
						email: $("input[name=email]").val(),
						password: $("input[name=password]").val(),
						name: $("input[name=lname]").val(),
						platform: $("input[name=platform]").val(),
						how: $("textarea[name=how]").val(),
						vocadb_lang: $("select[name=vocadb_lang]").val(),
						confirm: confirm,
						link: link,
						pic: $("input[name=nvoca_pic]").val()
					},
					success: function(check)
					{
						if( !check )
						{					
							$('#vocamodalmsg').html("Email already registered");
						}
						else
						{
							if(confirm)
							{
								$('#vocamodalmsg').html("Registration Successful.");
								setTimeout(openUrl, 3000);
							}
							else
							{
								$('#vocamodalmsg').html("Confirmation email sent!");
								setTimeout(openUrl, 3000);
							}
							
						}
						$('body').removeClass("csspinner traditional");
						$('#vocadbmodal').modal('show');
					}               
				});
			}
				
		});
		
		</script>
		<script src="<?php echo base_url().'resources/'; ?>vendor/parsley/parsley.min.js"></script>
<!-- Modal for footer -->
<div class="modal fade" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Your VocaDB Registration</h4>
      </div>
      <div class="modal-body">
        <p id="vocamodalmsg" ></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	</body>