<div id="bar">
	Daftar Perusahaan
</div>
<div class="borderleft">
	<ul class="comp_list">
	<?php
		if($q_main_company->num_rows() > 0){
			foreach($q_main_company->result() as $rows){
				echo "<li><a href='".$base_url."/perusahaan/".$rows->comp_id."/".url_title($rows->comp_nama).".html'>".$rows->comp_nama."</a></li>";
			}
		}
	
	?>
		<li><a href="<?php echo $base_url; ?>/perusahaan/">Lihat Daftar Perusahaan Lainnya</a></li>
	</ul>


</div>

