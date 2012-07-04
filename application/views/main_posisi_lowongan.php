<h1>Posisi Lowongan</h1>
<span class="clear"></span>  
<?php
	if($q_main_pos->num_rows() > 0){
		$i	= 1;
		foreach($q_main_pos->result() as $pos_rows){
			if($q_main_pos_child[$pos_rows->pos_id]->num_rows() > 0){
				echo "<div style=\"float:left;width:30%;padding:10px 0 10px 0;\">";
				echo "<b><a href=''>".$pos_rows->pos_level."</a></b>";
				foreach($q_main_pos_child[$pos_rows->pos_id]->result() as $pos_crows ){
						echo "<div style=\"float:left;width:220px;padding-left:10px;\">";
						echo "<a href='".base_url()."/lowongan/posisi/".$pos_rows->pos_id."/".$pos_crows->spes_id."/".url_title($pos_crows->spes_value."-".$pos_rows->pos_level).".html'>".$pos_crows->spes_value." (".$pos_crows->byk.")</a>";
						echo "</div>";
				}
				
				echo "</div>";
			}
		}
	}
?>
