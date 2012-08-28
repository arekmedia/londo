<div id="bar">
	Lowongan Terbaru
</div>
<div class="borderleft">
	<?php
		$lowongan_p['limit']	= 10;
		$lowongan_p['status']	= "publish";
		$lowongan_p['available']	= "yes";
		$lowongan_p['group']	= "v.vac_id";
		$q_lowongan = $this->lowongan_m->q_lowongan($lowongan_p);

		if($q_lowongan->num_rows() > 0){
			echo "<ul>";
			foreach($q_lowongan->result() as $r_lowongan){
				echo "<li><a href='".base_url()."lowongan/detail/".$r_lowongan->vac_id."/".$r_lowongan->spes_value."/".url_title($r_lowongan->vac_title).".html'>".$r_lowongan->vac_title."</a></li>";
			}
			echo "</ul>";
		}
		
	?>
</div>
<br>
<div id="bar">
	Lowongan Favorit
</div>
<div class="borderleft">
	<?php
		$lowongan_p['group']	= "v.vac_id";
		$q_lowongan = $this->lowongan_m->lowongan_stat($lowongan_p);
		if($q_lowongan->num_rows() > 0){
			echo "<ul>";
			foreach($q_lowongan->result() as $r_lowongan){
				echo "<li><a href='".base_url()."lowongan/detail/".$r_lowongan->vac_id."/".$r_lowongan->spes_value."/".url_title($r_lowongan->vac_title).".html'>".$r_lowongan->vac_title."</a></li>";
			}
			echo "</ul>";
		}
		
	
	?>
</div><br>
<div id="bar">
	Perusahaan
</div>
<div class="borderleft">
	<ul >
	<?php
		$lowongan_p['group']	= "jc.comp_id";
		$q_lowongan = $this->lowongan_m->lowongan_stat($lowongan_p);
		if($q_lowongan->num_rows() > 0){
			echo "<ul>";
			foreach($q_lowongan->result() as $rows){
				echo "<li><a href='".$base_url."lowongan/perusahaan/".$rows->comp_id."/".url_title($rows->comp_nama).".html'>".$rows->comp_nama."</a></li>";
			}
			echo "</ul>";
		}
	
	?>
		<li><a href="<?php echo $base_url; ?>main/perusahaan/">Lihat Daftar Perusahaan Lainnya</a></li>
	</ul>
</div>
<br>
