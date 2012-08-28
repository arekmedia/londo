<table id="rounded-corner" cellspacing="0" cellpadding="0">
	<tbody>
	<?php
		foreach($q_lowongan->result() as $rows){
			$salary	= number_format($rows->vac_salary_min)." - ".number_format($rows->vac_salary_max);
			if($rows->vac_salary_min == 0 && $rows->vac_salary_max == 0){
				$salary	= "negotiable";
			}
		
		$par['vac_id']	= $rows->vac_id;
		$q_loc	= $this->lowongan_m->q_location_lowongan($par);
		$city_list = "";

		foreach($q_loc->result() as $r_loc){
			$city_list .= $r_loc->city_value." ";
		}
	?>
		<tr>
			<td>
			<div id="listLowongan">
				<div class="side-left">
					<a class="title" href="<?php echo base_url()."lowongan/detail/".$rows->vac_id."/".url_title($rows->spes_value)."/".url_title($rows->vac_title).".html"; ?>"><?php echo $rows->vac_title;?><br>
					<a class="company" href="<?php echo base_url()."lowongan/kerja/".$rows->spes_id."/".url_title($rows->spes_value).".html"; ?>"><?php echo $rows->spes_value;?></a> - 
					<a class="company" style="color:#5A9161;" href="<?php echo base_url()."lowongan/perusahaan/".$rows->comp_id."/".url_title($rows->comp_nama).".html"; ?>"><?php echo $rows->comp_nama;?></a>
				</div>
				<div class="side-center">
					<div class="small-detail">Salary IDR <?php echo $salary; ?></div>
					<div class="small-detail">Location <?php echo $city_list;?></div>
				</div>
				<div>
					<a class="buttonOrange" href="<?php echo base_url()."lowongan/detail/".$rows->vac_id."/".url_title($rows->spes_value)."/".url_title($rows->vac_title).".html"; ?>" rel="nofollow">Lihat Detail</a> &nbsp;&nbsp;&nbsp;&nbsp;
					<a class="buttonGreen" onclick="loadfileid('apply','<?php echo $rows->vac_id; ?>')" href="#" rel="nofollow">Kirim Lamaran</a>
				</div>	
			</div>
			</td>		
		</tr>
	<?php
		}
	?>
	</tbody>
</table>
<div class="clear"></div>  
<?php 
	if($q_main_spes->num_rows() > 0){
		$i	= 1;
		foreach($q_main_spes->result() as $spes_rows){
			echo "<div style=\"float:left;width:170px;padding:10px 0 10px 0;\">";
			echo "<b><a href='".base_url()."lowongan/ragam/".$spes_rows->spes_id."/".url_title($spes_rows->spes_value).".html''>".$spes_rows->spes_value."</a></b>";
				foreach($q_main_spes_child[$spes_rows->spes_id]->result() as $spes_crows ){
					echo "<div style=\"float:left;width:180px;padding-left:10px;\">";
					echo "<a href='".base_url()."lowongan/kerja/".$spes_crows->spes_id."/".url_title($spes_crows->spes_value).".html'>".$spes_crows->spes_value."</a>";
					echo "</div>";
			
				}
			echo "</div>";
				
		}
	}
		
?>