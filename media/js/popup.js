/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;
//loading popup with jQuery magic!
function loadPopup(file){
	//loads popup only if it is disabled
	refresh	= true;
	if(popupStatus==0){
		
		if(file	== "edu_bahasa"){
			var data = uri+"pelamar/p_lang_edu";
		}
		if(file	== "skill"){
			var data = uri+"pelamar/p_skill";
		}
		if(file	== "profile"){
			var data = uri+"pelamar/p_profile";
		}
		if(file	== "latar_pendidikan"){
			var data = uri+"pelamar/p_data_edu";
		}
		
		$("#contactArea").load(data);
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact").fadeIn("slow");
		popupStatus = 1;
	}
	if(popupStatus==1){

		if(file	== "edu_bahasa"){
			var data = uri+"pelamar/p_lang_edu";
		}
		if(file	== "skill"){
			var data = uri+"pelamar/p_skill";
		}
		if(file	== "profile"){
			var data = uri+"pelamar/p_profile";
		}
		
		
		$("#contactArea").load(data);

	}
}

function loadPopupid(file,id){
	//loads popup only if it is disabled
	refresh	= true;
	if(popupStatus==0){

		if(file	== "edit_exper"){
		refresh	= false;
			var data = uri+"pelamar/p_exper_edit/"+id;
		}
		if(file	== "apply"){
		refresh	= false;
			var data = uri+"lowongan/apply/"+id;
		}

		$("#contactArea").load(data);
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact").fadeIn("slow");
		popupStatus = 1;

	}
	if(popupStatus==1){

		if(file	== "edit_exper"){
			var data = uri+"pelamar/p_exper_edit/"+id;
		}
		if(file	== "apply"){
			var data = uri+"lowongan/apply/"+id;
		}
				
		$("#contactArea").load(data);

	}
	
}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#popupContact").fadeOut("slow");
		popupStatus = 0;
		if(refresh == true){
		location.reload();
		}
	}
}

//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContact").height();
	var popupWidth = $("#popupContact").width();
	//centering
	$("#popupContact").css({
		"position": "fixed",
		"top": '10%',
		"left": windowWidth/2-popupWidth/2
	});
	//only need force for IE6
	
	$("#backgroundPopup").css({
		//"height": windowHeight*3
	});
	
}

function loadfile(file){
		//centering with css
		centerPopup();
		//load popup
		loadPopup(file);
}

function loadfileid(file,id){
		//centering with css
		centerPopup();
		//load popup
		loadPopupid(file,id);
}

//CONTROLLING EVENTS IN jQuery
$(document).ready(function(){
	var	save	= false;
				
	//CLOSING POPUP
	//Click the x event!
	$("#popupContactClose").click(function(){
		disablePopup();
	});
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});

});