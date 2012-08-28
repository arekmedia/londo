<!DOCTYPE html>
<HTML>
<HEAD>
<TITLE>Jobs</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link href="<?php echo base_url(); ?>media/css/general.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>media/css/switch.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>media/development-bundle/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>media/css/nouislider.css">
<script src="<?php echo base_url(); ?>media/development-bundle/jquery-1.6.2.js"></script>
<script src="<?php echo base_url(); ?>media/js/jalert/jquery.alerts.js"></script>
<script src="<?php echo base_url(); ?>media/js/function.js"></script>
<script src="<?php echo base_url(); ?>media/js/validator.js"></script>
<script src="<?php echo base_url(); ?>media/js/popup.js"></script>

<link href="<?php echo base_url(); ?>media/css/jalert/jquery.alerts.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>media/css/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>media/js/uploadify/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/js/uploadify/swfobject.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>media/js/tiny_mce/jquery.tinymce.js"></script>
<script src="<?php echo base_url(); ?>media/js/jquery.nouislider.js"></script>
<script type="text/javascript">
function load_exper_list(){
	$.ajax({
		url: uri+'pelamar/p_exper_list',
		success: function(data) {
			$('#lp').html(data);
		}
	}) 

}
$(function() {
	$(".cb-enable").click(function(){
		var parent = $(this).parents('.switch');
		$('.cb-disable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', true);
	});
	$(".cb-disable").click(function(){
		var parent = $(this).parents('.switch');
		$('.cb-enable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', false);
	});
	
	$('textarea.tinymce').tinymce({
		// Location of TinyMCE script
		script_url : '<?php echo base_url(); ?>media/js/tiny_mce/tiny_mce.js',

		// General options
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,advhr,|,print,|,ltr,rtl,|,fullscreen,pagebreak",
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

	$('#file_upload').uploadify({
        'uploader'  : uri+'media/js/uploadify/uploadify.swf',
        'script'    : uri+'media/lib/uploadify.php',
        'cancelImg' : '../media/js/uploadify/cancel.png',
        'folder'    : '../media/upload/',
		'fileDesc'  : 'Image Files',
		'fileExt'   : '*.jpg;*.jpeg;*.gif;*.png',
		'sizeLimit' : 100 * 1024 * 1024,
		'multi'		: false,	
        'auto'      : true,
		'scriptData'	 : {"sesid" : "<?php echo $this->session->userdata('sk_id'); ?>"},
		'onComplete': function(event, ID, fileObj, response, data){
	
			$("#uploaded_preview").html("<img class=\"photoProfile\" src=\'" +response+ "\'  />");
			$("input:hidden.image").val(response);
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
			var id		= "#"+i;
			var cid	= "div."+i;
			if(xx == i){
				$(id).addClass("active");  
				$(cid).fadeIn();  
				
				if(xx == 3)
					load_exper_list();

			}else{
				$(id).removeClass("active");  
				$(cid).css("display", "none");  
			}
		}
        return false;  
		
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
					<a class="standart" href="<?php echo base_url();?>pelamar/"><!-- class="regular"-->
						<img src="<?php echo base_url(); ?>media/images/home.png" alt=""> 
						Halaman Pelamar
					</a>
				</div>
				<?php } ?>
		</div>
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
    </div>
	<div id="footer">
	</div>
</div>
</body>
</HTML>