
<?php
	function selected($a,$b,$c){
		if($a == $b)
			return $c;
	}

	if($q_data_diri->num_rows() > 0){
		$row_dd	= $q_data_diri->row();
	
		$sk_nama	= $row_dd->sk_nama;
		$email		= $row_dd->email;
		$sk_no_tlp	= $row_dd->sk_no_tlp;
		$sk_no_hp	= $row_dd->sk_no_hp;
		$sk_tgl_lahir	= $row_dd->sk_tgl_lahir;
		$sk_alamat		= $row_dd->sk_alamat;
		$sk_alamat		= $row_dd->sk_alamat;
		$state_value		= $row_dd->state_value;
		$city_value			= $row_dd->city_value;
		$stateid			= $row_dd->state_id;
	}else{
		$sk_nama		= "";
		$email			= "";
		$sk_no_tlp		= "";
		$sk_no_hp		= "";
		$sk_tgl_lahir	= "";
		$sk_alamat		= "";
		$sk_alamat		= "";
		$state_value	= "";
		$city_value		= "";
		$stateid		= "";
	}

	
?>
<script src="<?php echo $base_url; ?>media/js/function.js"></script>
	<div style="clear:right;padding-top:10px;"></div>
	<div style="float:left;padding-left:20px">
		<table width="100%">
			<tr>
				<td width="150px">Nama Lengkap</td>
				<td>: <input type="text" name="nama" value="<?php echo $sk_nama; ?>"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td>: <input type="text" name="email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr>
				<td>No. Telephone</td>
				<td>: <input type="text" name="phone" value="<?php echo $sk_no_tlp; ?>"></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td>: <input type="text" name="mobile" value="<?php echo $sk_no_hp; ?>"></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>: <input type="text" name="alamat" value="<?php echo $sk_alamat; ?>"></td>
			</tr>
			<tr>
				<td>Provinsi</td>
				<td>: 
					<select name="stateid_js" onClick="get_city_js(this.form)" >
					<?php 
						echo "<option value=''>--Pilih Propinsi--</option>";
						foreach($q_state->result() as $rows){
							echo "<option value='".$rows->state_id."' ".selected($rows->state_id,$stateid,"selected").">".$rows->state_value."</option>";
						}
					?></select>
			</tr>
			<tr>
				<td>Provinsi</td>
				<td>: 
					<div id="city_js">
						<select>
						<?php 
							echo "<option value=''>--Pilih Kota--</option>";
						?>
						</select>
					</div> 
				</td>
			</tr>
			<tr>
				<td>Tgl Lahir</td>
				<td>: <?php echo date("d-M-Y", strtotime($sk_tgl_lahir))." (".floor((time() - strtotime($sk_tgl_lahir))/31556926).") tahun"; ?></td>
			</tr>
			
		</table>
	</div>						

	<div style="clear:both;height:20px;"></div>
