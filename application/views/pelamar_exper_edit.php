<script>
function edit_exper(id){
	$.ajax({
		type: 'POST',
		url: uri+'pelamar/p_exper_edit/'+id,
		data: $('#exper_edit').serialize(),
		success: function(data) {
			$('#exper_status').html(data);
			load_exper_list();
			$('#msg').show('slow');
		}
	}) 
}

</script>
<?php

function selected($a,$b,$c){
	if($a == $b)
		return $c;
}

	if($q_exper_list->num_rows() > 0){
	
		$r_exper	= $q_exper_list->row();

?>
<div id="exper_status" style="clear:both"></div>
<form method="post" id="exper_edit">
	<table>
		<tr>
			<td width="25%">Nama Perusahaan </td>
			<td>: <input type="text" name="exper_comp" value="<?php echo $r_exper->exper_comp; ?>"></td>
		</tr>
		<tr>
			<td width="25%">Posisi/Jabatan </td>
			<td>: <input type="text" name="exper_position" value="<?php echo $r_exper->exper_position; ?>"></td>
		</tr>
		<tr>
			<td width="25%">Lama Bekerja</td>
			<td>: 
				<select name="bln1">
					<?php
						for($b=1;$b<=12;$b++){
							
						if($b == 1) $bulan = "januari";
						elseif($b == 2) $bulan = "febuari";
						elseif($b == 3) $bulan = "maret";
						elseif($b == 4) $bulan = "april";
						elseif($b == 5) $bulan = "mei";
						elseif($b == 6) $bulan = "juni";
						elseif($b == 7) $bulan = "juli";
						elseif($b == 8) $bulan = "agustus";
						elseif($b == 9) $bulan = "september";
						elseif($b == 10) $bulan = "oktober";
						elseif($b == 11) $bulan = "november";
						elseif($b == 12) $bulan = "desember";
					?>
					<option value="<?php echo $b; ?>" <?php echo selected($b,date('m',strtotime($r_exper->date_start)),'selected'); ?>><?php echo $bulan; ?></option>
					<?php
						}
					?>
				</select>
				<select name="thn1">
					<?php
						for($c=1990;$c<=date("Y");$c++){
					?>
					<option value="<?php echo $c; ?>" <?php echo selected($c,date('Y',strtotime($r_exper->date_start)),'selected'); ?>><?php echo $c; ?></option>
					<?php
						}
					?>
				</select> Sampai
				<select name="bln2">
					<?php
						for($b=1;$b<=12;$b++){
							
						if($b == 1) $bulan = "januari";
						elseif($b == 2) $bulan = "febuari";
						elseif($b == 3) $bulan = "maret";
						elseif($b == 4) $bulan = "april";
						elseif($b == 5) $bulan = "mei";
						elseif($b == 6) $bulan = "juni";
						elseif($b == 7) $bulan = "juli";
						elseif($b == 8) $bulan = "agustus";
						elseif($b == 9) $bulan = "september";
						elseif($b == 10) $bulan = "oktober";
						elseif($b == 11) $bulan = "november";
						elseif($b == 12) $bulan = "desember";
					?>
					<option value="<?php echo $b; ?>" <?php echo selected($b,date('m',strtotime($r_exper->date_out)),'selected'); ?>><?php echo $bulan; ?></option>
					<?php
						}
					?>
				</select>
				<select name="thn2">
					<?php
						for($c=1990;$c<=date("Y");$c++){
					?>
					<option value="<?php echo $c; ?>" <?php echo selected($c,date('Y',strtotime($r_exper->date_out)),'selected'); ?>><?php echo $c; ?></option>
					<?php
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Jenis Perusahaan/Industri</td>
			<td>: 	
				<select name="comp_type_id">
				<?php 
					echo "<option value=''>--Pilih Industri--</option>";
					foreach($q_industri->result() as $rows){
						echo "<option value='".$rows->comp_type_id."'  ".selected($rows->comp_type_id,$r_exper->comp_type_id,"selected").">".$rows->comp_type_value."</option>";
					
					}
				?></select>
			</td>
		</tr>
		<tr>
			<td>Spesialisasi / Posisi </td>
			<td>&nbsp; 	
				<select name="spes" id="spes">
				<?php
					if($q_main_spes->num_rows() > 0){
						$i	= 1;
						foreach($q_main_spes->result() as $spes_rows){
							echo "<optgroup label='".$spes_rows->spes_value."'>";
							foreach($q_main_spes_child[$spes_rows->spes_id]->result() as $spes_crows ){
								echo "<option value='".$spes_crows->spes_id."' ".selected($spes_crows->spes_id,$r_exper->spes_id,'selected')." >".$spes_crows->spes_value."</option>";			
							}				
						}
					}

				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Gaji per Bulan (Rp.)</td>
			<td>: <input type="text" name="exper_salary"  value="<?php echo $r_exper->exper_salary; ?>"></td>
		</tr>
		<tr>
			<td>Deskripsi Pekerjaan</td>
			<td>&nbsp;&nbsp;<textarea name="exper_jobdesc"><?php echo $r_exper->exper_jobdesc; ?></textarea></td>
		</tr>
		<tr>
			<td>Alasan Keluar</td>
			<td>&nbsp;&nbsp;<textarea name="alasan_keluar"><?php echo $r_exper->alasan_keluar; ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<div class="buttons" id="link_button">
					<a href="#" class="positive" onclick="edit_exper('<?php echo $r_exper->exper_id; ?>')"><!-- class="regular"-->
						<img src="<?php echo base_url(); ?>media/images/save.png" alt=""> 
						Simpan Pengalaman Kerja
					</a>
				</div>
			</td>
		</tr>
	</table>
	<input type="hidden" name="update" value="1">
	<input type="hidden" name="exper_id" value="<?php echo $r_exper->exper_id; ?>">
</form>
<?php } ?>