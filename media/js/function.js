var uri	= "http://"+window.location.host+"/londo/";

	function confirm(msg,run){
			jConfirm(msg, 'Konfirmasi Tindakan', function(r) {
				if(r == true)
				run;
			});
	}
	
	$(document).ready(function() {
		$('#msg').click(function(){
			$('#msg').html('');
		});
	});

	function submitform(){
	  document.myform.submit();
	}

	function login_dock(elementID){
		var target1 = document.getElementById(elementID)

		if (target1.style.display == 'none') {
			var options = {};
			$( target1 ).show( 'Bounce');
			//target1.style.display = 'block'
		} else {
			target1.style.display = 'none'
		}
	} 

	function login(form){
		var username	= form.username.value;
		var password	= form.password.value;
		$('#message').html("<img src='"+uri+"media/images/loading.gif'> Loading...");
		$.ajax({
			type: 'POST',
			url: uri+'main/login_jq',
			data: 'username='+username+'&password='+password,
			success: function(data) {
				$('#message').html(data); 				
			}
		}) 
		return false;
	}

	
	function get_city_js(form){
		var stateid_js = form.stateid_js.value;
		$.ajax({
			type: 'POST',
			url: uri+'main/get_city_jq_js',
			data: 'stateid_js='+stateid_js,
			success: function(data) {
				$('#city_js').html(data); 				
			}
		}) 
		return false;

	}

	function get_city_js_search(form){
		var stateid_js = form.stateid_js.value;
		$.ajax({
			type: 'POST',
			url: uri+'main/get_city_jq_js',
			data: 'stateid_js='+stateid_js+'&search=1',
			success: function(data) {
				$('#city_js').html(data); 				
			}
		}) 
		return false;

	}
	
	function get_city_cm(form){
		var stateid_cm		= form.stateid_cm.value;
		$('#city_cm').html('loading... '); 				

		$.ajax({
			type: 'POST',
			url: uri+'main/get_city_jq_cm',
			data: 'stateid_cm='+stateid_cm,
			success: function(data) {
				$('#city_cm').html(data); 				
			}
		}) 
		return false;

	}

	function check_username_jq(form){
		var username		= form.username.value;

		$.ajax({
			type: 'POST',
			url: uri+'main/check_username_jq',
			data: 'username='+username,
			success: function(data) {
				$('#input_message').html(data); 				
			}
		}) 
		return false;

	}
	
	function check_email_jq(form){
		var email		= form.sk_email.value;

		$.ajax({
			type: 'POST',
			url: uri+'main/check_email_jq',
			data: 'email='+email,
			success: function(data) {
				$('#input_message').html(data); 				
			}
		}) 
		return false;

	}

	function load_exper_list(){
		$('#lp').html("<img src='"+uri+"media/images/loading_2.gif'>");			
		$.ajax({
			url: uri+'pelamar/p_exper_list',
			success: function(data) {
			$('#lp').html(data);
			}
		}) 

	}

	function load_ragam_lowongan(){
		$('#ragam_lowongan').html("<img src='"+uri+"media/images/loading_2.gif'>");			
		$.ajax({
			url: uri+'main/ragam_lowongan',
			success: function(data) {
			$('#ragam_lowongan').html(data);
			}
		}) 
	}

	function load_lokasi_lowongan(){
		$('#lokasi_lowongan').html("<img src='"+uri+"media/images/loading_2.gif'>");			
		$.ajax({
			url: uri+'main/lokasi_lowongan',
			success: function(data) {
			$('#lokasi_lowongan').html(data);
			}
		}) 
	}

	function load_posisi_lowongan(){
		$('#posisi_lowongan').html("<img src='"+uri+"media/images/loading_2.gif'>");			
		$.ajax({
			url: uri+'main/posisi_lowongan',
			success: function(data) {
			$('#posisi_lowongan').html(data);
			}
		}) 
	}


