<div id="bar">
	Lowongan Terbaru 
</div>
<div class="borderleft">
	<ul class="comp_list">
		<?php		
			$par['limit']	= 10;
			$par['status']	= 'publish';
			$q_lowongan		= $this->lowongan_m->q_lowongan($par);
			if($q_lowongan->num_rows() > 0){
				foreach($q_lowongan->result() as $rows){
					$salary	= number_format($rows->vac_salary_min)." - ".number_format($rows->vac_salary_max);
					if($rows->vac_salary_min == 0 && $rows->vac_salary_max == 0){
						$salary	= "negotiable";
					}
				echo "<li><a href='".$base_url."lowongan/detail/".$rows->vac_id."/".url_title($rows->comp_nama)."/".url_title($rows->vac_title).".html'>".$rows->vac_title." - ".$rows->spes_value."</a></li>";
				}
			}
		?>
	</ul>


</div>
<br>
<?php
	$type		= $this->uri->segment(2);
	$type_id	= $this->uri->segment(3);
	$show		= 0;
	
	if($type == 'ragam'){
		$main_p['spes_id']	= $type_id;
		$q_spes	= $this->main_m->q_spes($main_p);
		$r_spes	= $q_spes['q_main_spes']->row();
		$show		= 1;
		
		if($r_spes->spes_level == '0')
			$par['spes_level']	= $r_spes->spes_id;
		else
			$par['spes_level']	= $r_spes->spes_level;
		
		$par['limit']		= 10;
		$par['status']	= 'publish';
		$q_lowongan			= $this->lowongan_m->q_lowongan($par);
	
	}elseif($type == 'kota'){
		$city_p['city_id']		= $type_id;
		$q_state	= $this->main_m->q_city_state($city_p);
		$r_state	= $q_state->row();
		$show		= 1;
		
		$par['state_id']	= $r_state->state_id;
		$par['limit']		= 10;
		$par['status']	= 'publish';
		$q_lowongan			= $this->lowongan_m->q_lowongan($par);
		
	}elseif($type == 'detail'){
		$city_p['city_id']		= $type_id;
		$q_state	= $this->main_m->q_city_state($city_p);
		$r_state	= $q_state->row();
		$show		= 1;
		
		$par['state_id']	= $r_state->state_id;
		$par['limit']		= 10;
		$par['status']	= 'publish';
		$q_lowongan			= $this->lowongan_m->q_lowongan($par);
		
	}

	if($show	== 1){
?>
<div id="bar">
	Lowongan Terkait 
</div>
<div class="borderleft">
	<ul class="comp_list">
		<?php
			if($q_lowongan->num_rows() > 0){
				foreach($q_lowongan->result() as $rows){
					$salary	= number_format($rows->vac_salary_min)." - ".number_format($rows->vac_salary_max);
					if($rows->vac_salary_min == 0 && $rows->vac_salary_max == 0){
						$salary	= "negotiable";
					}
				echo "<li><a href='".$base_url."/lowongan/detail/".$rows->vac_id."/".url_title($rows->comp_nama)."/".url_title($rows->vac_title).".html'>".$rows->spes_value." - ".$rows->vac_title." </a></li>";
				}
			}
		?>
	</ul>


</div>

<?php } ?>