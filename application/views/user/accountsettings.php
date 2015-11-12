<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// var_dump($Nvoca);
// echo $Nvoca['user_info']->email;
// exit();
?><!DOCTYPE html>
<style>
.tab-content
{
	border: 0px;
}
.edit_button, .edit_button:focus
{
	cursor: pointer;
	background: none;
	border: none;
	box-shadow: none;
	font-size: 20px;
	padding: 15px;
	outline:none;
}
.edit_button:hover
{
	background: none;
	color: blue;
	text-decoration: none;
	border: 0px;
}
#gas, #profile
{
	max-width: 100%;
	border: 0px solid black;
}
#gas table, #profile table
{
	width: 100%;
	max-width: 500px;
	
}
.ctr_label
{
	text-align: right;
	padding: 20px;
}
.input_td
{
	max-width: 30%;
}
.button_td
{
	text-align: left;
	// padding: 20px 20px 20xp 0px;
	width: 102px;
}
.disabled, .disabled:hover
{
	cursor: not-allowed;
	background: none;
	color: initial;
}
.as_nav .active
{
	color: white;
}
.as_nav li.active a, .as_nav li.active a:focus
{
	background-color: #4486F6;
}
.save_button
{
	color: #5cb85c;
}
.save_button:hover
{
	color: #5cb85c;
}
.cancel_button
{
	color: #d9534f;
}
.cancel_button:hover
{
	color: #d9534f;
}
#pic_upload_msg
{
	font-size: 11px;
}
#email_confirm_msg
{
	font-size:12px;
	position:absolute;
}
</style>

<br/><br/><br/>
<ul class="as_nav nav nav-tabs nav-justified" role="tablist">
    <li role="presentation"><a href="#gas" aria-controls="home" role="tab" data-toggle="tab">General Account Settings</a></li>
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Account Profile</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade" id="gas">
		<h4>General Account Settings</h4>
		<hr/>
		<table align="center">
		<tr>
			<td class="ctr_label"><label class="control-label">Email</label></td>
			<td class="input_td">
				<input type="text" class="form-control" required data-parsley-type="email"  data-input="email" value="<?php echo $Nvoca['user_info']->email; ?>" readonly>
				<?php 
				if( $Nvoca['user_info']->confirm )
				{
					echo "<p id='email_confirm_msg' style='color: green;'>Email confirmed</p>";
				}
				else
				{
					echo "<p id='email_confirm_msg' style='color: red;'>Not yet confirmed</p>";
				}
				?>
			</td>
			
			<td class="button_td">
				<button class="edit_button" <?php if($Nvoca['user_info']->link == 'vocabdb'){echo 'voca-email="Edit"';}else{echo 'style="cursor:not-allowed"';}?> ><span class="fa fa-edit"></span></button>
				<button style="display: none;" voca-email="Save" class="edit_button save_button"><span class="fa fa-check"></span></button>
				<button style="display: none;" voca-email="Cancel" class="edit_button cancel_button"><span class="fa fa-times"></span></button>	
			</td>
		</tr>
		<tr>
			<td class="ctr_label"><label class="control-label">Password</label></td>
			<td class="input_td"><input type="password" class="form-control" value="asd123" readonly></td>
			<td class="button_td">
				<button class="edit_button" <?php if($Nvoca['user_info']->link == 'vocabdb'){echo 'voca-pass="Edit"';}else{echo 'style="cursor:not-allowed"';}?> ><span class="fa fa-edit"></span></button>
				<!--<button class="edit_button" voca-pass="Edit" ><span class="fa fa-edit"></span></button>-->
			</td>
		</tr>
		</table>
		<hr/>
		<p align="right">*If you logged in/registered using Facebook/Twitter/Pinterest, you cannot edit these fields. Please contact us if you wish to change your email.</p>
	</div>
    <div role="tabpanel" class="tab-pane active" id="profile">
		<h4>Profile</h4>
		<hr/>
		<table align="center">
		<tr>
			<td class="ctr_label"><label class="control-label">Company</label></td>
			<td class="input_td"><input data-input="company" type="text" class="form-control" value="<?php echo $Nvoca['user_info']->company; ?>" readonly></td>
			<td class="button_td">
				<button class="edit_button" title="Edit"><span class="fa fa-edit"></span></button>
				<button style="display: none;" title="Save" class="edit_button save_button"><span class="fa fa-check"></span></button>
				<button style="display: none;" title="Cancel" class="edit_button cancel_button"><span class="fa fa-times"></span></button>		
			</td>
		</tr>
		<tr>
			<td class="ctr_label"><label class="control-label">Name</label></td>
			<td class="input_td"><input data-input="last_name" type="text" class="form-control" value="<?php echo $Nvoca['user_info']->last_name; ?>" readonly></td>
			<td class="button_td">
				<button class="edit_button" title="Edit"><span class="fa fa-edit"></span></button>
				<button style="display: none;" title="Save" class="edit_button save_button"><span class="fa fa-check"></span></button>
				<button style="display: none;" title="Cancel" class="edit_button cancel_button"><span class="fa fa-times"></span></button>	
			</td>
		</tr>
		<tr>
			<td class="ctr_label"><label class="control-label">Profile Picture</label></td>
			<td class="input_td">
				<?php $image = base_url()."resources/app/img/user/noimage.jpg";
				if ( $Nvoca['user_info']->photo_link != NULL )
				{
					$image = $Nvoca['user_info']->photo_link;
					$btn_msg = "Change";
				}
				else
				{
					$btn_msg = "Upload";
				}
				?>
				
				<img width="60" height="60" class="img-thumbnail img-circle" src="<?php echo $image; ?>"/>
				<input type="hidden" name="this_pic" value="<?php echo $Nvoca['user_info']->photo_link; ?>"/>
				<button id="pic_upload" class="btn btn-primary"><?php echo $btn_msg; ?></button>
				<button id="pic_save" style="display: none;" title="Save" class="btn btn-info">Save?</button>
				<p id="pic_upload_msg">
				max file size: 2MB
				</p>
				<input style="display:none;" type="file" accept="image/x-png, image/gif, image/jpeg" />
				
			</td>
			<td class="button_td">
					&nbsp;
			</td>
		</tr>
		<tr>
			<td class="ctr_label"><label class="control-label">Language</label></td>
			<td class="input_td">
				<select data-input="nationality" disabled name='vocadb_lang'  id='vocadb_lang'  class='form-control' >
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
											<option value='en'>English - United States (en)</option>
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
			</td>
			<td class="button_td">
				<button class="edit_button" voca-lang-select="Edit"><span class="fa fa-edit"></span></button>
				<button style="display: none;" voca-lang-select="Save" class="edit_button save_button"><span class="fa fa-check"></span></button>
				<button style="display: none;" voca-lang-select="Cancel" class="edit_button cancel_button"><span class="fa fa-times"></span></button>	
			</td>
		</tr>
		<tr>
			<td class="ctr_label"><label class="control-label">Platform</label></td>
			<td class="input_td"><input data-input="platform" type="text" class="form-control" value="<?php echo $Nvoca['user_info']->platform; ?>" readonly></td>
			<td class="button_td">
				<button class="edit_button" title="Edit"><span class="fa fa-edit"></span></button>
				<button style="display: none;" title="Save" class="edit_button save_button"><span class="fa fa-check"></span></button>
				<button style="display: none;" title="Cancel" class="edit_button cancel_button"><span class="fa fa-times"></span></button>	
			</td>
		</tr>
		<tr>
			<td class="ctr_label"><label class="control-label">How to use</label></td>
			<td class="input_td"><textarea data-input="how" style="resize:none;height:120px" type="text" class="form-control" disabled><?php echo $Nvoca['user_info']->how; ?></textarea></td>
			<td class="button_td">
				<button class="edit_button" voca-lang-text="Edit"><span class="fa fa-edit"></span></button>
				<button style="display: none;" voca-lang-text="Save" class="edit_button save_button"><span class="fa fa-check"></span></button>
				<button style="display: none;" voca-lang-text="Cancel" class="edit_button cancel_button"><span class="fa fa-times"></span></button>
			</td>
		</tr>

		</table>
		<hr/>
		<p align="right">*Please be advised that we will not expose these informations to anyone.</p>
	</div>
</div>
<!-- Modal for footer -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="vocadbmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<form id="changepass">
    <div class="modal-content">
    <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
    </div>
    <div class="modal-body">
		<div class="row">
			<label class="col-sm-3 control-label">Current Password</label>
			<div class="col-sm-9">
				<input type="password" name="changepass_oldpass" class="form-control" required>
				<p id="changepass_msg" style="display:none;color:red;font-size:12px;">Incorrect password.</p>
			</div>
		</div>
		<br/>
		<div class="row">
			<label class="col-sm-3 control-label">New Password</label>
			<div class="col-sm-9">
				<input type="password" name="changepass_newpass" id="changepass_newpass" class="form-control" required data-parsley-type="alphanum">
			</div>
		</div>
		<br/>
		<div class="row">
			<label class="col-sm-3 control-label">Confirm New Password</label>
			<div class="col-sm-9">
				<input type="password" name="changepass_confrmpass" class="form-control" required data-parsley-equalto="#changepass_newpass">
			</div>
		</div>
    </div>
    <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Change Password</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>
	</form>
  </div>
</div>
<script src="<?php echo base_url().'resources/'; ?>vendor/parsley/parsley.min.js"></script>
<script>
var uploaded_pics = {};
$("select").val("<?php echo $Nvoca['user_info']->nationality; ?>");
$("#pic_upload").on('click',function(){
	$(this).siblings("input").trigger("click");
});
$("#pic_upload").siblings("input").change(function(e){
	$("#pic_upload").addClass("csspinner traditional disabled");
	var request = new FormData(); 
	request.append('userfile', $('input[type="file"]')[0].files[0] ); 	
	$.ajax({
		url: base_url+"upload_pic",
		type: "POST",
		data: request,
		contentType: false,
		cache: false,
		processData:false,
		success: function(data)
		{
			var result = JSON.parse(data);
			if(result.status)
			{
				uploaded_pics[result.img_path] = result.img_link;
				$("#pic_upload").siblings('img').attr('src',result.img_link);
				$("#pic_save").css('display','inline');
				$("input[name='this_pic']").val(result.img_path);
			}
			else
			{
				$('#pic_upload_msg').html("upload error, try again");
			}
			$("#pic_upload").removeClass("csspinner traditional disabled");
		}
	});
});
$("#pic_save").on('click',function(e){
	$.ajax({
		url: base_url+"pic_save",
		type:'POST',
		data:{
			pic: $("input[name='this_pic']").val(),
			all_pics: JSON.stringify(uploaded_pics)
		},
		success: function()
		{
			delete uploaded_pics[$("input[name='this_pic']").val()];
			$("#pic_save").css("display","none");
			$(".img-circle").attr('src', $("#pic_upload").siblings('img').attr('src') );
		}			
	});
});
$(window).unload(function(){
   $.ajax({
		url: base_url+"pic_delete",
		type:'POST',
		data:{
			all_pics: JSON.stringify(uploaded_pics)
		}	
	});
});
$("form").on("submit",function(e){
	e.preventDefault();
});
//for inputs
$(".edit_button[title='Edit']").on("click",function(e){
	$(this).siblings('button').css("display","inline");
	$(this).css("display","none");
	$(this).parent('td').siblings('td.input_td').children('input').attr('readonly',false);
	$(this).siblings(".edit_button[title='Save']").attr("old_data", $(this).parent('td').siblings('td.input_td').children('input').val() )
});
$(".edit_button[title='Cancel']").on("click",function(e){
	$(this).siblings('button.edit_button[title="Edit"]').css("display","inline");
	$(this).siblings('button.edit_button[title="Save"]').css("display","none");
	$(this).css("display","none");
	var selected_input = $(this).parent('td').siblings('td.input_td').children('input');
	selected_input.attr('readonly',true);
	selected_input.val( $(this).siblings(".edit_button[title='Save']").attr('old_data') );
});
$(".edit_button[title='Save']").on("click",function(e){
	$(this).siblings('button.edit_button[title="Edit"]').css("display","inline");
	$(this).siblings('button.edit_button[title="Cancel"]').css("display","none");
	$(this).css("display","none");
	var selected_input = $(this).parent('td').siblings('td.input_td').children('input');
	selected_input.attr('readonly',true);

	if( selected_input.val() && selected_input.val() != $(this).attr('old_data') )
	{
		$.ajax({
			url: base_url+"account_save",
			type:'POST',
			data:{
				val: selected_input.val(),
				target: selected_input.attr('data-input')
			},
			success: function(name)
			{
				if( name )
				{
					$('#myname').html( selected_input.val() );
				}
			}
		});
	}
	else
	{
		selected_input.val( $(this).attr('old_data') );
	}
});

//for select
$(".edit_button[voca-lang-select='Edit']").on("click",function(e){
	$(this).siblings('button').css("display","inline");
	$(this).css("display","none");
	var selected_input = $(this).parent('td').siblings('td.input_td').children('select');
	selected_input.attr('disabled',false);
	$(this).siblings(".edit_button[voca-lang-select='Save']").attr("old_data", selected_input.val() );
});
$(".edit_button[voca-lang-select='Cancel']").on("click",function(e){
	$(this).siblings('button.edit_button[voca-lang-select="Edit"]').css("display","inline");
	$(this).siblings('button.edit_button[voca-lang-select="Save"]').css("display","none");
	$(this).css("display","none");
	var selected_input =  $(this).parent('td').siblings('td.input_td').children('select');
	selected_input.attr('disabled',true);
	selected_input.val( $(this).siblings(".edit_button[voca-lang-select='Save']").attr('old_data') );
});
$(".edit_button[voca-lang-select='Save']").on("click",function(e){
	$(this).siblings('button.edit_button[voca-lang-select="Edit"]').css("display","inline");
	$(this).siblings('button.edit_button[voca-lang-select="Cancel"]').css("display","none");
	$(this).css("display","none");
	var selected_input = $(this).parent('td').siblings('td.input_td').children('select');
	selected_input.attr('disabled',true);

	if( selected_input.val() && selected_input.val() != $(this).attr('old_data') )
	{
		$.ajax({
			url: base_url+"account_save",
			type:'POST',
			data:{
				val: selected_input.val(),
				target: selected_input.attr('data-input')
			},
			success: function(name)
			{
				if( name )
				{
					$('#myname').html( selected_input.val() );
				}
			}
		});
	}
	else
	{
		selected_input.val( $(this).attr('old_data') );
	}
});
//for textarea
$(".edit_button[voca-lang-text='Edit']").on("click",function(e){
	$(this).siblings('button').css("display","inline");
	$(this).css("display","none");
	var selected_input = $(this).parent('td').siblings('td.input_td').children('textarea');
	selected_input.attr('disabled',false);
	$(this).siblings(".edit_button[voca-lang-text='Save']").attr("old_data", selected_input.val() );
});
$(".edit_button[voca-lang-text='Cancel']").on("click",function(e){
	$(this).siblings('button.edit_button[voca-lang-text="Edit"]').css("display","inline");
	$(this).siblings('button.edit_button[voca-lang-text="Save"]').css("display","none");
	$(this).css("display","none");
	var selected_input =  $(this).parent('td').siblings('td.input_td').children('textarea');
	selected_input.attr('disabled',true);
	selected_input.val( $(this).siblings(".edit_button[voca-lang-text='Save']").attr('old_data') );
});
$(".edit_button[voca-lang-text='Save']").on("click",function(e){
	$(this).siblings('button.edit_button[voca-lang-text="Edit"]').css("display","inline");
	$(this).siblings('button.edit_button[voca-lang-text="Cancel"]').css("display","none");
	$(this).css("display","none");
	var selected_input = $(this).parent('td').siblings('td.input_td').children('textarea');
	selected_input.attr('disabled',true);

	if( selected_input.val() && selected_input.val() != $(this).attr('old_data') )
	{
		$.ajax({
			url: base_url+"account_save",
			type:'POST',
			data:{
				val: selected_input.val(),
				target: selected_input.attr('data-input')
			},
			success: function(name)
			{
				if( name )
				{
					$('#myname').html( selected_input.val() );
				}
			}
		});
	}
	else
	{
		selected_input.val( $(this).attr('old_data') );
	}
});
//email
$(".edit_button[voca-email='Edit']").on("click",function(e){
	$(this).siblings('button').css("display","inline");
	$(this).css("display","none");
	var selected_input = $(this).parent('td').siblings('td.input_td').children('input');
	selected_input.attr('readonly',false);
	$(this).siblings(".edit_button[voca-email='Save']").attr("old_data", selected_input.val() );
});
$(".edit_button[voca-email='Cancel']").on("click",function(e){
	$(this).siblings('button.edit_button[voca-email="Edit"]').css("display","inline");
	$(this).siblings('button.edit_button[voca-email="Save"]').css("display","none");
	$(this).css("display","none");
	var selected_input =  $(this).parent('td').siblings('td.input_td').children('input');
	selected_input.attr('readonly',true);
	selected_input.val( $(this).siblings(".edit_button[voca-email='Save']").attr('old_data') );
});
$(".edit_button[voca-email='Save']").on("click",function(e){
	$(this).siblings('button.edit_button[voca-email="Edit"]').css("display","inline");
	$(this).siblings('button.edit_button[voca-email="Cancel"]').css("display","none");
	$(this).css("display","none");
	var selected_input = $(this).parent('td').siblings('td.input_td').children('input');
	selected_input.attr('readonly',true);

	if( selected_input.val() && selected_input.val() != $(this).attr('old_data') )
	{
		selected_input.parsley().validate();
		if (selected_input.parsley().isValid()) 
		{
			// console.log("correct email"+selected_input.val());
			$.ajax({
				url: base_url+"account_change_email",
				type:'POST',
				data:{
					val: selected_input.val(),
				},
				success: function()
				{
					location.reload();
				}
			});
		}
		else
		{
			// console.log("invalid email");
			selected_input.val( $(this).attr('old_data') );
		}
	}
	else
	{
		selected_input.val( $(this).attr('old_data') );
	}
});
$(".edit_button[voca-pass='Edit']").on("click",function(e){
	$('#vocadbmodal').modal('show');
});
$("#changepass").on("submit",function(e){
	e.preventDefault();
	var f = $(this);
	f.parsley().validate();
	if (f.parsley().isValid()) 
	{
		$.ajax({
				url: base_url+"account_change_password",
				type:'POST',
				data:{
					old_pass: $("input[name='changepass_oldpass']").val(),
					new_pass: $("input[name='changepass_newpass']").val(),
					cfrm_pass: $("input[name='changepass_confrmpass']").val()
					
				},
				success: function(msg)
				{
					if(msg)
					{
						$("#changepass_msg").html('Change Password Successful').css('color','green');
						$("#changepass_msg").css('display','inline');
						$(".modal-footer button[type='submit']").addClass('disabled');
					}
					else
					{
						$("#changepass_msg").html('Incorrect password').css('color','red');
						$("#changepass_msg").css('display','inline');
					}
				}
			});
	}
});
$('#vocadbmodal').on('hidden.bs.modal',function(){
	$("#changepass input[type='password']").val("");
	$("#changepass").parsley().reset();
});
</script>