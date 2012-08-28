<div id="DetailLowongan">
<div style="clear:both;"></div>
<div id="popupContact">		
	<p id="contactArea"></p>
</div>
<div id="backgroundPopup"></div>
<div style="clear:both;"></div>
<?php

	if($q_lowongan->num_rows() > 0){
	
		$id	= $this->uri->segment(3);

		$row	= $q_lowongan->row();

		$salary	= "IDR ".number_format($row->vac_salary_min)." s/d ".number_format($row->vac_salary_max);
		
		if($row->vac_salary_min == 0 && $row->vac_salary_max == 0)
			$salary	= "negotiable";
		

		/**********************************
		* Images
		**********************************/
		$images = "";
		//$path	= $_SERVER['DOCUMENT_ROOT']."/bk/media/uploads/logo/thumb/".$row->comp_logo;
		if($row->comp_logo != "" ){
			$images = "<img src='".base_url()."media/upload/logo/thumb/".$row->comp_logo."'>";
		}
		$par['vac_id']	= $row->vac_id;
		$q_loc	= $this->lowongan_m->q_location_lowongan($par);
		$city_list = "";

		foreach($q_loc->result() as $r_loc){
			$city_list .= $r_loc->city_value." ";
		}

		
		$temp_url	= str_replace('%base_url%',base_url(),$row->temp_url);
		$template	= file_get_contents($temp_url);
		$template	= str_replace('%comp_logo%',$images,$template);
		$template	= str_replace('%comp_name%',$row->comp_nama,$template);
		$template	= str_replace('%vac_sdate%',date('d-M-Y',strtotime($row->vac_sdate)),$template);
		$template	= str_replace('%vac_edate%',date('d-M-Y',strtotime($row->vac_edate)),$template);
		$template	= str_replace('%vac_title%',$row->vac_title,$template);
		$template	= str_replace('%comp_desc%',$row->comp_desc,$template);
		$template	= str_replace('%vac_detail%',$row->vac_detail,$template);
		$template	= str_replace('%spes%',$row->spes_value,$template);
		$template	= str_replace('%loc%',$city_list,$template);
		$template	= str_replace('%level%',$row->pos_level,$template);
		$template	= str_replace('%vac_salary%',$salary,$template);
		$template	= str_replace('%apply%',"<a class='buttonGreen' onclick=\"loadfileid('apply','".$id."')\" href='#' rel='nofollow'>Kirim Lamaran</a>",$template);
		$template	= str_replace('%fb-like%',"<div class='fb-like' data-href='http://".$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]."' data-send='true' data-layout='button_count' data-width='450' data-show-faces='true'></div>",$template);
		echo $template;
	}

?>

</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=406219936108364";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="http://ebursakerja.com" data-num-posts="5" data-width="500"></div>