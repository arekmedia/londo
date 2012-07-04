 <div id="fb-root"></div>
 <script src="http://connect.facebook.net/en_US/all.js"></script>
 <script>
FB.init({
	appId  : '337893626237880',
	status : true, // check login status
	cookie : true, // enable cookies to allow the server to access the session
	xfbml  : true  // parse XFBML
});
</script>
<form method="POST" id="form" name="form">
	<h2 style="color:#639C27">Ajukan Lamaran Pekerjaan Saya</h2>
	<div style="float:left;width:60%;margin:10px;">
<!-- <fb:registration 
	fields="[
		{'name':'name'},
		{'name':'email'},
		{'name':'location'},
		{'name':'gender'},
		{'name':'birthday'},
		{'name':'newsletter',       'description':'Subscribe to Our Newsletter ', 'type':'checkbox',  'default':'checked'},

	]"
	redirect-uri="http://lowongan.biruku.com//main/register"
	width="530">
</fb:registration>-->

		&nbsp;
	</div>
	<div style="float:left;padding:10px;border-left: 1px solid #EEEEEE;">
		<?php 

		if($q_pelamar->num_rows() > 0 && $this->session->userdata("priv") == "js"){
			$r_pelamar	= $q_pelamar->row();
		?>
			<h2>Melamar Pekerjaan Sebagai</h2>
			<img src="<?php echo $r_pelamar->sk_photo; ?>">
		<?php
		}else{
		?>

		<h2>Login </h2>
		<div id="message_login"></div>
		<div style="float:left;width:29%">Username</div>
		<div style="float:left;"><input type="text" name="username_apply"></div>
		<div style="clear:both"></div>
		<div style="float:left;width:29%">Password</div>
		<div style="float:left;"><input name="password_apply" type="password"></div>
		<div style="clear:both"></div>
		<input type="button" value="login" class="buttonOrange" onclick="login_apply(this.form)">
		<div style="clear:both"></div>
		<a href="<?php echo base_url(); ?>main/register">&rarr; Register New Account</a>

		<?php
		}
		?>
	</div>
</form>