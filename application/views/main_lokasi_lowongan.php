		<h1>Lokasi Lowongan</h1>
		<div align="center">
			<img  usemap="#maps" src="<?php echo base_url()."media/images/ina.png" ?>">
		</div>
<map id="maps" name="maps">
		<?php
			if($q_main_state->num_rows() > 0){
				$i	= 1;
				foreach($q_main_state->result() as $state_rows){
					echo "<area onMouseOver=\"this.style.backgroundColor='#00FFFF'\" onMouseOut=\"this.style.backgroundColor='#ff0000'\" title='".$state_rows->state_value."' href='".base_url()."lowongan/provinsi/".$state_rows->state_id."/".url_title($state_rows->state_value).".html' coords='".$state_rows->coor."' shape=\"poly\">";

				}
			}
		?>

  </map>
		<span class="clear"></span>  
		<?php
			if($q_main_state->num_rows() > 0){
				$i	= 1;
				foreach($q_main_state->result() as $state_rows){
					echo "<div style=\"float:left;width:170px;padding:10px 0 10px 0;\">";
					echo "<b><a href='".base_url()."lowongan/provinsi/".$state_rows->state_id."/".url_title($state_rows->state_value).".html'>".$state_rows->state_value."</a></b>";

						foreach($q_main_state_child[$state_rows->state_id]->result() as $state_crows ){
							echo "<div style=\"float:left;width:200px;padding-left:10px;\">";
							echo "<a href='".base_url()."lowongan/kota/".$state_crows->city_id."/".url_title($state_rows->state_value."-".$state_crows->city_value).".html'>".$state_crows->city_value."</a>";
							echo "</div>";
				
						}
					
					echo "</div>";
				}
			}
		?>
