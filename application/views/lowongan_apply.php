<script>
	function login_apply(form){
		var username	= form.username_apply.value;
		var password	= form.password_apply.value;
		var vac_id		= form.vac_id.value;
		$('#message_login').html("<img src='"+uri+"media/images/loading.gif'> Loading...");
		$.ajax({
			type: 'POST',
			url: uri+'main/login_apply',
			data: 'username='+username+'&password='+password,
			success: function(data) {
				if(data == "1"){
					$('#message_login').html("<div class='success'>Please wait...</div>"); 	
					setTimeout(function() {loadfileid('apply',vac_id);},1250);
					
				}else{
					$('#message_login').html("<div class='failed'>Login Gagal</div>");
				}

				//alert(data);		
			}
		}) 
		return false;
	}
	
	function apply(form){
		var vac_id	= form.vac_id.value;
		$.ajax({
			type: 'POST',
			url: uri+'lowongan/do_apply',
			data: 'vac_id='+vac_id,
			success: function(data) {
				if(data == "1"){
					$('#message_apply').html("<div class='success'>Lamaran berhasil terkirim</div>"); 	
				}else{
					$('#message_apply').html("<div class='notify'>Lamaran sudah terkirim</div>");
				}

				//alert(data);		
			}
		}) 
		return false;		
	}

</script>

<form method="POST" id="form" name="form">
	<h2 style="color:#639C27">Ajukan Lamaran Pekerjaan Saya</h2>
	<div style="float:left;width:55%;margin:10px;">
		<div id="message_apply"></div>
		&nbsp;
	</div>
	<div style="float:left;padding:0 10px;border-left: 1px solid #EEEEEE;">
		<?php 

		if($q_pelamar->num_rows() > 0 && $this->session->userdata("priv") == "js"){
			$r_pelamar	= $q_pelamar->row();
		?>
			<input type="hidden" name="vac_id" id="vac_id" value="<?php echo $this->uri->segment(3);?>">
			<h2>Pelamar </h2>
			<div style="padding:5px 0;width:100%;height:30%;">
				<div style="float:left;width:50px;"><img src="<?php echo base_url()."media/upload/photo/icon/".$r_pelamar->sk_photo; ?>"></div> <b><?php echo $r_pelamar->sk_nama; ?></b>
			</div>
			<div style="clear:both"></div>
			<div style=""><a href="<?php echo base_url(); ?>pelamar/">&rarr; Edit Profile Saya</a></div>
			<div style="text-align:center">
				<input type="button" value="Applay Now" class="buttonGreen" onclick="apply(this.form)">
			</div>
		<?php
		}else{
		?>
			<input type="hidden" name="vac_id" id="vac_id" value="<?php echo $this->uri->segment(3);?>">
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