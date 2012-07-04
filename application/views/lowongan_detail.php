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
		$path	= $_SERVER['DOCUMENT_ROOT']."media/uploads/perusahaan/thumb/".$row->comp_logo;
		if($row->comp_logo != "" && file_exists($path)){
			$images = "<img src='".base_url()."media/uploads/perusahaan/thumb/".$row->comp_logo."'>";
		}
			
		$template	= file_get_contents($row->temp_url);
		$template	= str_replace('%comp_logo%',$images,$template);
		$template	= str_replace('%comp_name%',$row->comp_nama,$template);
		$template	= str_replace('%vac_sdate%',date('d-M-Y',strtotime($row->vac_sdate)),$template);
		$template	= str_replace('%vac_edate%',date('d-M-Y',strtotime($row->vac_edate)),$template);
		$template	= str_replace('%vac_title%',$row->vac_title,$template);
		$template	= str_replace('%comp_desc%',$row->comp_desc,$template);
		$template	= str_replace('%vac_detail%',$row->vac_detail,$template);
		$template	= str_replace('%vac_salary%',$salary,$template);
		$template	= str_replace('%apply%',"<a class='buttonGreen' onclick=\"loadfileid('apply','".$id."')\" href='#' rel='nofollow'>Kirim Lamaran</a>",$template);
		echo $template;
	}

?>

