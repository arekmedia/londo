<h1>Ragam Lowongan</h1>
<span class="clear"></span>  
<?php 
	if($q_main_spes->num_rows() > 0){
		$i	= 1;
		foreach($q_main_spes->result() as $spes_rows){
			echo "<div style=\"float:left;width:180px;padding:10px 0 10px 0;\">";
			echo "<b><a href=''>".$spes_rows->spes_value."</a></b>";
				foreach($q_main_spes_child[$spes_rows->spes_id]->result() as $spes_crows ){
					echo "<div style=\"float:left;width:200px;padding-left:10px;\">";
					echo "<a href='".base_url()."/lowongan/kerja/".$spes_crows->spes_id."/".url_title($spes_crows->spes_value).".html'>".$spes_crows->spes_value."</a>";
					echo "</div>";
			
				}
			echo "</div>";
				
		}
	}
		
?>