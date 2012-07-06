<HTML>
<HEAD>
<TITLE>Jobs</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />

<link href="<?php echo base_url(); ?>media/css/general.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>media/development-bundle/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url(); ?>media/development-bundle/jquery-1.6.2.js"></script>
<script src="<?php echo base_url(); ?>media/js/function.js"></script>
<script src="<?php echo base_url(); ?>media/js/validator.js"></script>
<script src="<?php echo base_url(); ?>media/js/popup.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.tabs.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.effects.bounce.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
$(function() {
load_ragam_lowongan();
	$('textarea.tinymce').tinymce({
		// Location of TinyMCE script
		script_url : '<?php echo base_url(); ?>media/js/tiny_mce/tiny_mce.js',

		// General options
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
				username : "Some User",
				staffid : "991234"
		}
	});

	var xx	= $('.active').attr('id');
	for(i=1; i<6; i++){
		var	id	= "#"+i;
		var cid	= "div."+i;
		if(xx == i){
			$(id).addClass("active");  
            $(cid).fadeIn();  
		}else{
			$(id).removeClass("active");  
            $(cid).css("display", "none");  
		}	
	}
	

    $(".menu > li").click(function(e){ 
		var xx	= e.target.id;

		for(i=1; i<6; i++){
				var	id	= "#"+i;
				var cid	= "div."+i;
			if(xx == i){
				$(id).addClass("active");  
				$(cid).fadeIn(); 
			
			var tab1	= $('#tab1').val();
			var tab2	= $('#tab2').val();
			var tab3	= $('#tab3').val();


			if(xx == 1 && tab1 == 0){
				$('#tab1').val('1');
				load_ragam_lowongan();
			}if(xx == 2 && tab2 == 0){
				$('#tab2').val('1');
				load_lokasi_lowongan();
			}if(xx == 3 && tab3 == 0){
				$('#tab3').val('1');
				load_posisi_lowongan();
			} 

			}else{
				$(id).removeClass("active");  
				$(cid).css("display", "none");  
			}
		}
        return false;  
		
    });  
});  


jQuery(document).ready(function() {
  jQuery('#datepicker').datepicker({
    minDate: new Date(1900, 0, 1),
    maxDate: new Date(2000,0,1),
    constrainInput: true,
	changeMonth: true,
	changeYear: true

	});
});

</script>
</HEAD>

<?php

function selected($a,$b,$c){
	if($a == $b)
		return $c;
}

?>
<BODY>
<div id="centered">
	<div id="container">
	</div>
	<div style="clear:both"></div>
	<div id="content">
		<div class="submain">SPACE BANNER TOP</div>
		
		<?php 
			if($this->session->userdata('logged_in') == FALSE){
		?>
		<div class="subside">
			<div style="float:left;margin-left:50px;">
				<ul id="menu">
					<li class="login" >
						<img style="float:left;" alt="" src="<?php echo base_url(); ?>/media/images/menu_left.png" onClick="login_dock('main')"/>
						<ul id="main" style="display:none">
							<li>
							<div id="message"></div>
								<form method="post" name="loginForm" id="loginForm">
									<div style="">Username</div>
									<div style=""><input type="text" name="username"></div>
									<div style="">Password</div>
									<div style=""><input name="password" type="password"></div>
									<input type="button" value="login" class="button_login" onclick="login(this.form)">
								</form>
							</li>
							<li class="last">
								<img class="corner_left" alt="" src="<?php echo base_url(); ?>/media/images/corner_blue_left.png"/>
								<img class="middle" alt="" src="<?php echo base_url(); ?>/media/images/dot_blue.png"/>
								<img class="corner_right" alt="" src="<?php echo base_url(); ?>/media/images/corner_blue_right.png"/>
							</li>
						</ul>
						
					</li>
					<li>
						<a href="<?php echo base_url(); ?>/main/register"><img style="float:right;" alt="" src="<?php echo base_url(); ?>/media/images/register.png"/></a>
					</li>
				</ul>
			</div>
		</div>
		
		<?
			}else{
		?>
		<!-- Logout Button -->
			<div style="float:right;padding-right:20px;">
				<div class="buttons" id="link_button">
					<a class="standart" href="<?php echo base_url();?>main/logout/"><!-- class="regular"-->
						<img src="<?php echo base_url(); ?>media/images/key.png" alt=""> 
						Log Out Account
					</a>
				</div>
			</div>
			<div style="float:right;">
				<div class="buttons" id="link_button">
					<a class="standart" href="<?php echo base_url();?>pelamar/"><!-- class="regular"-->
						<img src="<?php echo base_url(); ?>media/images/home.png" alt=""> 
						Halaman Pelamar
					</a>
				</div>
			</div>
		<?php
			}
		?>
		<div id="box">
			<div style="clear:both;"></div>
			<div id="container">	
				<?php $this->load->view($content); ?>
			</div>
			
			<div id="cright">
				<?php $this->load->view($side); ?>
			</div>
		</div> 
    </div>
	<div id="footer">
	</div>
	</div>
</body>
</HTML>