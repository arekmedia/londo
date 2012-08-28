<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE>Jobs</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link href="<?php echo base_url(); ?>media/css/general.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>media/development-bundle/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>media/css/nouislider.css">
<link href="<?php echo base_url(); ?>media/css/jalert/jquery.alerts.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>media/development-bundle/jquery-1.6.2.js"></script>
<script src="<?php echo base_url(); ?>media/js/function.js"></script>
<script src="<?php echo base_url(); ?>media/js/validator.js"></script>
<script src="<?php echo base_url(); ?>media/js/popup.js"></script>
<script src="<?php echo base_url(); ?>media/js/jalert/jquery.alerts.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.tabs.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.effects.bounce.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>media/js/tiny_mce/jquery.tinymce.js"></script>
<script src="<?php echo base_url(); ?>media/js/jquery.nouislider.js"></script>


<script type="text/javascript">
var currentTime = new Date();
var month = currentTime.getMonth() + 1;
var day = currentTime.getDate();
var year = currentTime.getFullYear()+1;
var nextyear = currentTime.getFullYear()+2;

$(function() {
	$('textarea.tinymce').tinymce({
		// Location of TinyMCE script
		script_url : '<?php echo base_url(); ?>media/js/tiny_mce/tiny_mce.js',

		// General options
		mode: "textareas",
		theme : "advanced",
		editor_selector : "tinymce",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|link,unlink,anchor,image,|,forecolor,backcolor",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
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

  jQuery('#datepicker').datepicker({
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
		
		<?php 
			if($this->session->userdata('logged_in') == TRUE){
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
				<?php if($this->session->userdata('priv') == 'cm'){?>
				<div class="buttons" id="link_button">
					<a class="standart" href="<?php echo base_url();?>perusahaan/"><!-- class="regular"-->
						<img src="<?php echo base_url(); ?>media/images/home.png" alt=""> 
						Halaman Perusahaan
					</a>
				</div>
				<?php }else if($this->session->userdata('priv') == 'js'){?>

				<div class="buttons" id="link_button">
					<a class="standart" href="<?php echo base_url();?>Pelamar/"><!-- class="regular"-->
						<img src="<?php echo base_url(); ?>media/images/home.png" alt=""> 
						Halaman Pelamar
					</a>
				</div>
				<?php } ?>
			</div>
		<?php
			}
		?>
		<div id="box">
			<div style="clear:both;">
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
</BODY>
</HTML>