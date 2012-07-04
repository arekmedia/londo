<div id="right">
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
				echo "<li><a href='".$base_url."/lowongan/detail/".$rows->vac_id."/".url_title($rows->comp_nama)."/".url_title($rows->vac_title).".html'>".$rows->vac_title." - ".$rows->city_value."</a></li>";
				}
			}
		?>
		<li><a href="<?php echo $base_url; ?>/perusahaan/">Lihat Semua Lowongan Terkait</a></li>
	</ul>


</div>

